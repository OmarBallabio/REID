<?
$WMK=1;
require_once "../.globals.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD>
<title>ADM REID</title>
<META content="text/html; charset=utf-8" http-equiv="Content-Type">
<META content="Omar Ballabio - web@nave.net" name="Author">
<link rel="STYLESHEET" type="text/css" href="../.Nstyle.css">
<style type="text/css">
BODY{background-color:<? echo $GLOBALS[background-color]?>;}
BODY{background-color:#990000;}
</style>
</HEAD>
<BODY>
<div align="center">
<TABLE width="700" border="0" cellPadding="0" cellSpacing="2" bgcolor="#ffffff">
	<TR><td colspan="2">
	<table width="100%" border="0" cellpadding="3" cellspacing="0">
	 	<tr>
	<TD width="100"><a href="<? echo $GLOBALS[URL]?>" target="_top">
	<img src="<? echo $GLOBALS[URL]?>screen/REIDlogomarca.jpg" alt="REID" border="0"></a>
	</td>
	<td align="right">
	<font face="Verdana,Geneva,Arial,Helvetica,sans-serif" size="3" color="#003E7B">
	<b><? echo $TITULO?></b>
	<br><br><b>ADMINISTRAÇÃO</b></font>
	 	</td></tr></table>
	<hr>

	<!-- Inc --><table width="90%" border="0" cellpadding="2" cellspacing="2">
	<!-- Inc --><tr><td class="miolo" align="center" height="350" valign="top">

	<div align="center"><b style="font-size:12px;">
	<a href="<? echo $GLOBALS[URL]?>ADM/?t=DBnotic">[ Inserir texto ]</a> &nbsp;
	<a href="<? echo $GLOBALS[URL]?>ADM/?t=DBnotic&act=list">[ Listar textos]</a> &nbsp;
<!--	<a href="<? echo $GLOBALS[URL]?>ADM/?t=editor">[ Editor HTML ]</a> &nbsp;-->
	<a href="<? echo $GLOBALS[URL]?>ADM/?t=assinantes">[ Assinantes News ]</a>
	<a href="<? echo $GLOBALS[URL]?>ADM/?t=aparencia">[ Aparência ]</a>
	</b>
	<br><br></div>
<?
$ADMK=1;
print $msg;
if(!$topico)	include "DBnotic.php";
else 	include "INC".$topico.".php";
?>
	<!-- Inc --></td></tr></table>
<?

if($_SERVER[REMOTE_ADDR] == $IP2debug ){include $GLOBALS[htdocs].".debug.php";}

?>




<!-- Main --></td></tr></table>

</body>
</html>

