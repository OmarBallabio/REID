

<?php

$action = "InsertNews";
$Tdate = "dd/mm/aaaa";

require "../.htdbini.php";
$Nid = $_GET[Nid];
$id=$_POST[Nid];
$act = isset($_POST[act]) ? $_POST[act] : $_GET[act];
unset($msg);

if($act == "list"){
	include "listDBnotic.php";
} else if($act == "RemoveNews"){
	mysql_query("DELETE FROM CONT WHERE CONTid = '$Nid'");

	if((mysql_affected_rows()>0)&&(mysql_errno() == 0)){

	$msg = '<br><h4 style="color:#00cc00;"><b>Notícia removida da base de dados.<br><a href="http://www.reid.org.br" target="_blank">Checar </a></h4>
			';
	}
} else if($act == "InsertFile"){
	include "INCupload.php";
} else if($act == "InsertNews"){

extract($_POST); // sanear!!



$CONTtopic= mysql_real_escape_string($_POST[CONTtopic]);
$CONTtit= mysql_real_escape_string($_POST[CONTtit]);
$CONTautor= mysql_real_escape_string($_POST[CONTautor]);
$CONTresumo= mysql_real_escape_string($_POST[CONTresumo]);
$CONTtex = mysql_real_escape_string($_POST[CONTtex]);
$CONTcred= mysql_real_escape_string($_POST[CONTcred]);


	$ip = getenv ("REMOTE_ADDR");
	$newentry = "$ip|$date|$user\n";

	if(!$_POST[Nid]){
	mysql_query("insert into CONT SET
		CONTdestq=('$CONTdestq'),
		CONTdate=('$CONTdate'),
		CONTdiv=('$CONTdiv'),
		CONTtipo=('$CONTtipo'),
		CONTtopic=('$CONTtopic'),
		CONTtit=('$CONTtit'),
		CONTautor=('$CONTautor'),
		CONTresumo=('$CONTresumo'),
		CONTtex=('$CONTtex'),
		CONTcred=('$CONTcred'),
		CONTuser=('$Uid')
		");
	$CONTid = mysql_insert_id();
	$fase = "INSERIDO";
	}else{
	mysql_query("UPDATE CONT SET
		CONTdestq=('$CONTdestq'),
		CONTdate=('$CONTdate'),
		CONTdiv=('$CONTdiv'),
		CONTtipo=('$CONTtipo'),
		CONTtopic=('$CONTtopic'),
		CONTtit=('$CONTtit'),
		CONTautor=('$CONTautor'),
		CONTresumo=('$CONTresumo'),
		CONTtex=('$CONTtex'),
		CONTcred=('$CONTcred'),
		CONTuser=('$Uid')
		WHERE CONTid = '$Nid'
		");
		$fase = "ALTERADO";
	}
	if((mysql_affected_rows()>0)&&(mysql_errno() == 0)){

			$msg = '<br><h4 style="color:#00cc00;"><b>Artigo ' .$fase. ' na base de dados. <br><a href="' .$GLOBALS[URL]."/index.php?n=".$CONTdiv .'" target="_blank">Checar </a></h4>
			';
	}else{
		$msg = '<br><h4 style="color:#cc0000;">Não houve alteração.<br>Erros:' . $Merro .' / '. $Mnun .'</h4>';
	}

		if ( mysql_errno() > 0){
		$Merro = mysql_errno() ;	$Mnun = mysql_error() ;
		$ms = "Ocorreu um erro na base de dados:<br>". $Merro ." = ". $Mnun ;
		echo "<SMALL>$ms</SMALL><BR>\n";
		}
}

if($_POST[Nid]||$_GET[Nid]){
$Cedit = mysql_query("SELECT * FROM CONT WHERE CONTid='$Nid' ");
$UCedit = mysql_fetch_array($Cedit);
$Tdate = $UCedit[CONTdate];
}

$form =  '
<div align="center" style="font-size:12px;">
<form name="send" action="' .$PHP_SELF. '?t=DBnotic&" method="post">
<input type="Hidden" name="act" value="InsertNews">
<input type="Hidden" name="Nid" value="' .$Nid. '">
<table border="0" cellpadding="4" cellspacing="0" width="400" bgcolor="#ececec" class="cmxform">
<tr><td align="RIGHT"><b>EDIÇÃO</b> &nbsp;</TD>
<td title="Obrigatório. Edição na qual o texto deve aparecer.">
<select name="CONTdiv">
	<option value="' .$UCedit[CONTdiv]. '" SELECTED>' .$UCedit[CONTdiv]. '</option>
	<option value="ESP00002" title="ESP00002">Especial 2</option>
	<option value="NUM00013" title="NUM00013">Número 13</option>
	<option value="NUM00014" title="NUM00014">Número 14</option>
	<option value="NUM00015" title="NUM00015">Número 15</option>
	<option value="NUM00016" title="NUM00016">Número 16</option>
	<option value="NUM00017" title="NUM00017">Número 17</option>
	<option value="NUM00018" title="NUM00018">Número 18</option>

</select>
</td></TR>
<tr><td align="RIGHT"><b>SEÇÃO</b> &nbsp;</TD>
<td title="Obrigatório. Onde o texto deve ser listado na edição.">
<select name="CONTtipo">
	<option value="' .$UCedit[CONTtipo]. '" SELECTED>' .$UCedit[CONTtipo]. '</option>
		<option value="" title="Primeiro item da edição">Oculto</option>
	<option value="Apresentacao" title="Primeiro item da edição">Apresentacão</option>
	<option value="Artigo" title="O texto será listado por ordem de autor">Artigo</option>
	<option value="Topico" title="O texto será listado abaixo dos artigos, por ordem de Tópicos, agrupado por tópico">Destaque</option>
	<option value="Colabora" title="O texto será listado abaixo dos destaques">Colaboradores</option>
	<option value="Fixo" title="Páginas fixas do menu">Fixo</option>
</select>

</td></TR>
<td align="RIGHT">
<b>Tópico</b> &nbsp;
</TD><td title="Deixe em branco se for um artigo regular. Novos tópicos aparecem após os artigos. Tópicos repetidos são agrupados.">
<input type="Text" name="CONTtopic" size="30" value="' .$UCedit[CONTtopic]. '">
</td></TR>

<td align="center" colspan=2>
<hr>
</td></TR>


<tr><td align="RIGHT">
<b>Título</b> &nbsp;
</TD><td title="Título que aparece listado com link para o texto">
<input type="Text" name="CONTtit" size="60" value="' .$UCedit[CONTtit]. '">
</td></TR>

<tr><td align=center colspan=2 title="Opcional, aparece na listagem"><b>Autor</b><br>
<textarea name=CONTautor rows=5 cols=60>' .$UCedit[CONTautor]. '</textarea>
</td></tr>

<tr><td align=center colspan=2 title="Opcional, aparece na listagem"><b>Resumo</b><br>
<textarea name=CONTresumo rows=5 cols=60>' .$UCedit[CONTresumo]. '</textarea>
</td></tr>


<tr><td align=center colspan=2 title="Corpo do texto. Pode ser formatado em HTML"><b>Texto</b><br>
<textarea name=CONTtex rows=15 cols=60>' .$UCedit[CONTtex]. '</textarea>
</td></tr>

<tr><td align=center colspan=2 title="Opcional. Aparece no fim de um texto, com formatação diferente."><b>Rodapé</b><br>
<textarea name=CONTcred rows=5 cols=60>' .$UCedit[CONTcred]. '</textarea>
</td></tr>


<tr><td colspan="2" align="CENTER">
<input name="submit" type="submit" value=" ENVIAR "></form>
</td></tr>


<tr><td align=center colspan=2> <b>Associar arquivo</b><br>
<form name="send" action="' .$PHP_SELF. '?t=DBnotic&" method="post"  enctype="multipart/form-data">
<input type="Hidden" name="act" value="InsertFile">

<input type="hidden" name="MAX_FILE_SIZE" value="3000000" style="width: 300px; font-family: verdana;  font-size: 12px; color: 000000; ">
<input type="Hidden" name="Nid" value="' .$Nid. '">
              <input name="userfile" type="file" size="64"><br><br>
		  <input name="submit" type="submit" value=" ENVIAR ">
		  </form>


</td></tr>

</table>
<br>

</div>


Suporte: <a href="mailto:SOS@nave.net.br">omar@nave.net.br</a>

';




print '<div align="center"><a href="http://reid.org.br/?CONT=' .$Nid. '" name="VISUALIZAR" target="_blank"><strong>[ Visualizar publicação ]</strong></a></div>';

print '' .$msg. '<hr>	';

if($act != "list"){
print "<div align='center'><b>Para inserir artigo na base de dados REID,<br>
preencha os campos abaixo e clique em <i><b>Enviar</b></i>.
<br><br></div>";
print $form;
}



?>

<!-- INCDBnotic.php -->


