<?
$WMK=1;
require_once ".globals.php";

$GLOBALS[table] = 'REIC.USRDB';

$GLOBALS[email] 	= trim(addslashes(ereg_replace("[^-a-zA-Z0-9_@.]","", $_POST['email'])));
$GLOBALS[boletim] 	= trim(addslashes(ereg_replace("[^a-zA-Z0-9_@.]","", $_POST['boletim'])));
$GLOBALS[parceiro] 	= trim(addslashes(ereg_replace("[^a-zA-Z0-9_@.]","", $_POST['parceiro'])));
$GLOBALS[chave] 	= trim(addslashes(ereg_replace("[^a-zA-Z0-9]","", $_GET['k'])));
$GLOBALS[content] 	= '';
$GLOBALS[msg_falha] = '';

$GLOBALS[texto_assinar]='<span style="font-family:Verdana,Arial,Helvetica,sans-serif;color:#0000FF;font-size:12px;font-weight:bold;text-align:center;">Receba notícias periodicamente.<br>Informe seu email e clique "Assinar"</span><br>';


$GLOBALS['form_assinar'] = '
<form id=form_assinar action="assinar.php?act=assinar" method="post" target="_self">
<input type="text" size="12" id="email" name="email" title="Preencha aqui com seu endereço de email" value="">
<input type="submit" value="Assinar" title="Clique aqui para enviar">
<input type="hidden" name="boletim" value="REID">
<input type="hidden" name="parceiro" value="id_parceiro"></form>
';

$GLOBALS[msg_sucesso] = '<h3>Grato por sua inscrição.<br>Confirme o endereço acessando o link que foi enviado a <b>'. $GLOBALS[email] .'</b></h3>Não esqueça de liberar o domíno IEDC.ORG.BR em seu antispam.';

$GLOBALS[msg_mail_confirmado] = '<h3><br>Seu endereço foi confirmado.<br>Bem-vindo!</h3>';
$GLOBALS[msg_mail_removido] = '<h3><br>Seu endereço foi removido e não receberá mais notícias.</h3>';
$GLOBALS[msg_mail_invalido] = '<div align="center" style="padding:4px;color:#bb0000;">Email inválido. <br>Tente novamente:</div>' . $form_assinar;

//$id $email, $boletim, $parceiro, $confirmado, $suspenso, $ip_assina, $ip_confirma, $chave, $timestamp,

function sendmail($case,$chave){
	include $GLOBALS[ADM]."MSGnews.php";
	return mail($GLOBALS[email], $subj[$case], $messg[$case], $headers[$case]);
}

function is_email_valid($email) { // echo "email $email<br>\n";

  if(eregi("^[a-z0-9\._-]+@+[a-z0-9\._-]+\.+[a-z]{2,3}$", $email)) return TRUE;
  else return FALSE;
}

function assina($email){

	$chave = md5($_SERVER['REMOTE_ADDR'] . date( "d.M.Y H:i:s", time()));
		$WMemail = $GLOBALS[email];
		$WMagent = $_SERVER[HTTP_USER_AGENT];
		$WMip  = $_SERVER[REMOTE_ADDR];
		$origem="REID";
		$lista="REID";
		$confirmado= -1; // pendente

		$IF_ROWS = " email=('$WMemail'), chave=('$chave'), origem=('$origem'), lista=('$lista'),  confirmado=('$confirmado'), ip=('$WMip'), agent=('$WMagent'), time=NOW()";

	$res=mysql_query("INSERT $GLOBALS[table] SET $IF_ROWS");
			if ( mysql_errno() > 0){ $Merro = mysql_error() ;
				$GLOBALS[msg_falha] 	= '<br><b>Desculpe.</b> Ocorreu um erro na base de dados:<br><br>INSERT -'. $Merro.'<br><br>';
				if ( mysql_errno() == 1062)	{$GLOBALS[msg_sucesso] 	= '<h3>' .$WMemail. ' já existe no cadastro.<br>Notícias serão enviadas a este endereço.</h3>' . $GLOBALS['form_assinar'];
					$case = 'confirmado';
					return sendmail($case,$chave);}

			} else {
				$case = 'confirmar';
				return sendmail($case,$chave);
			}
}

function confirma($email){

		$res=mysql_query("UPDATE $GLOBALS[table] SET confirmado = '1' WHERE chave = '$GLOBALS[chave]'");
		$getmail=mysql_query("SELECT email FROM $GLOBALS[table] WHERE chave = '$GLOBALS[chave]'");
		$GLOBALS[email] = mysql_result($getmail,0);

			if ((mysql_errno()==0)&&(mysql_affected_rows()>0)){
					$case = 'confirmado';
					return sendmail($case,'0');
			} else {
		 		$Merro = mysql_error() ;
				$GLOBALS[msg_falha] 	= '<br><b>Desculpe.</b> Ocorreu um erro na base de dados:<br><br>'. $Merro.'<br><br>';
			}
}

function suspende($email){

		$res=mysql_query("DELETE from $GLOBALS[table] WHERE email = '$email'");
			if ((mysql_errno()==0)&&(mysql_affected_rows()>0)){
					$case = 'suspenso';
			} else {
		 		$Merro = mysql_error() ;
				$GLOBALS[msg_falha] 	= '<b>Desculpe.</b> Ocorreu um erro na base de dados:<br><br>'. $Merro.'<br><br>';
			}


}

function retorna($email,$boletim,$chave){

		$res=mysql_query("UPDATE $GLOBALS[table] SET USRsuspenso = 0 WHERE USRchave = '$GLOBALS[chave]'");
		$getmail=mysql_query("SELECT email FROM $GLOBALS[table]WHERE USRchave = '$GLOBALS[chave]'");
		$GLOBALS[email] = mysql_result($getmail,0);

			if ((mysql_errno()==0)&&(mysql_affected_rows()>0)){
					$case = 'retorno';
					return sendmail($case,'0');
			} else {
		 		$Merro = mysql_error() ;
				$GLOBALS[msg_falha] 	='<br><b>Desculpe.</b> Ocorreu um erro na base de dados:<br><br>'. $Merro.'<br><br>';
			}

}




switch ($_GET[act]) {
case 'assinar':
		if(is_email_valid($GLOBALS[email])){
  			$mailed = assina($GLOBALS[email]);
				if($mailed>0)$GLOBALS[content] = $GLOBALS[msg_sucesso];
				else $GLOBALS[content] = $GLOBALS[msg_falha];
		}else{
			$GLOBALS[content] = $GLOBALS[msg_mail_invalido];
		}
   break;
case 'confirmar':
  			$mailed = confirma($GLOBALS[email]);
				if($mailed>0)$GLOBALS[content] = $GLOBALS[msg_mail_confirmado]. $aviso;
				else $GLOBALS[content] = $GLOBALS[msg_falha];
   break;
case 'remover':
  			$mailed = suspende($_POST[email]);
				if($mailed>0)$GLOBALS[content] = $GLOBALS[msg_mail_removido];
				else $GLOBALS[content] = $GLOBALS[msg_falha];
   break;
case 'retorno':
  			$mailed = retornar($GLOBALS[email]);
				if($mailed>0)$GLOBALS[content] = $GLOBALS[msg_mail_confirmado];
				else $GLOBALS[content] = $GLOBALS[msg_falha];
   break;
default:
	$GLOBALS[content] =$GLOBALS[form_assinar].$GLOBALS[texto_assinar];
}




?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head><title>ASSOCIAR</title>

</head>
<body  bgcolor="#FBC635">
<div align="center">
<? print $GLOBALS[content]?>
</div>
</body>
</html>
