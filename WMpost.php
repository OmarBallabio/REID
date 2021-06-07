<?
$WMK=1;
require_once ".globals.php";

$to= $GLOBALS[EMAIL_DESTINO];
$subject = "Mensagem via REID";

	foreach ($_POST as $varnm =>$value) {
		// Mail injection exploit?  http://br2.php.net/manual/pt_BR/ref.mail.php
		if (stristr($value,"MIME-Version")) {die();}
	}


function is_valid($email) {
  if(eregi("^[a-z0-9\._-]+@+[a-z0-9\._-]+\.+[a-z]{2,3}$", $email)) return $email;
  else return 'email@invalido.xxx';
}

reset($_POST);
if (isset($_POST)){
    	$body = $subject .": \r\n\r\n";
         while (list($key, $value) = each($_POST)){
$body .= utf8_decode($key) . "\t" . utf8_decode($value) . "\r\n\r\n";
         }
         $body .= "\r\n\r\n--------------------------------\r\nSuporte: sos@nave.net 0..12 3842 3353";

			$toaddress = 	"To: REID <" .$to. ">\n" ;
			$headers = "From: " .is_valid($_POST[EMAIL]). "\r\n";


$fp = mail($to, $subject, $body, $headers);

// echo $to, $subject, $body, $headers;

			 if(!$fp) { echo "Desculpe.<br>Devido a problemas técnicos não foi possível enviar sua mensagem.<br>Por favor, envie mensagem por e-mail <a href='mailto:" .$to. "'>clicando aqui</a>"; exit;}

$hed1 = "Location: " .$GLOBALS[MSGOKurl]. "";

header ($hed1);
exit();

}
?>