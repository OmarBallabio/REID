<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD>

<title>REID - REVISTA ELETRÔNICA INTERNACIONAL DIREITO e CIDADANIA</title>
<META content="text/html; charset=iso-8859-1" http-equiv="Content-Type">
<META content="Omar Ballabio - web@nave.net" name="Author">
<link rel="STYLESHEET" type="text/css" href=".Nstyle.css">
<style type="text/css">
BODY	{scrollbar-face-color: #ffffff;background-color:#ffffff;font-family:Arial,Helvetica,sans-serif;margin:14;}
form,select{font-size:8pt;}
</style>
<script language="JavaScript" type="text/javascript">
function printWindow(){bV = parseInt(navigator.appVersion);if (bV >= 4) window.print();}
function stylus(){siz=(document.styletex.styl.options[document.styletex.styl.selectedIndex].value);tex.style.fontSize=siz;}
function face(){fon=(document.styletex.facef.options[document.styletex.facef.selectedIndex].value);tex.style.fontFamily=fon;}
//By javascript@nave.net @ http://webmonster.com.br - Thanks for check our code !
</script>
</HEAD>
<BODY bgColor="#ffffff" text="#000000" link="#000000" vlink="#000000">
<hr>
<table width="100%" border="0" cellpadding="3" cellspacing="0">
<tr><td align="justify">
<font face="Verdana,Geneva,Arial,Helvetica,sans-serif" color="#000080" size="2">
<b><big>REID</big> - REVISTA ELETRÔNICA INTERNACIONAL DIREITO e CIDADANIA</b>
</font>
</td>
<form name="styletex"><td align="right"><select name="styl" onchange="stylus()" title="ZoomText&copy; : by omar@webmonster.com.br"><option value="8">8<option value="10">10<option value="12"selected>12<option value="14">14<option value="16">16<option value="18">18<option value="20">20<option value="24">24<option value="28">28<option value="32">32<option value="40">40<option value="50">50<option value="70">70<option value="100">100<option value="200">200</select>
<select name="facef" onchange="face()" title="ZoomText&copy; : by omar@webmonster.com.br"><option value="Arial" selected>Arial<option value="Verdana">Verdana<option value="Times">Times<option value="Serif">Serif<option value="Sans Serif">Sans Serif<option value="Cursive">Cursive<option value="Fantasy">Fantasy<option value="Monospace">Monospace</select>
<input type="button" value="Imprimir" onclick="printWindow()">
</td></form>
</tr></table>	
<br>
<table border=0 cellpadding=0 cellspacing=0><tr>
<?
function mysql_data($mysql_date){ 
	$year = substr( $mysql_date, 0, 4 );$month = substr( $mysql_date, 4, 2 );$day = substr( $mysql_date, 6, 2 );$hour = substr( $mysql_date, 8, 2 );$min = substr( $mysql_date, 10, 2 );$sec = substr( $mysql_date, 12, 2 );$php_timestamp = mktime( $hour, $min, $sec, $month, $day, $year );
$d1=date('d/m/Y H:i',($php_timestamp));
$d2=date('d/m/Y',($php_timestamp));
return array ($d1, $d2);
}


require ".htdbini.php";

if(isset($_GET[CONT])){
$CONT=$_GET[CONT];
$CONTresult = mysql_query("select * from CONT WHERE CONTid = '$CONT'");
$CONTfield=mysql_fetch_array($CONTresult);
$Cdata=mysql_data($CONTfield[CONTtime]);

	print '<tr class="cont">
		<td align="justify">
		<div id="tex" align="justify">
		<br><b class="tit00C">' .$CONTfield[CONTtit]. '</b>
		<br><br>' .nl2br($CONTfield[CONTtex]). '
		</div>
		</td></tr>
		';
}else if(isset($_GET[CLIP])){
$CLIP=$_GET[CLIP];
$CLIPresult = mysql_query("select * from CLIP WHERE CLIPid = '$CLIP'");
$CLIPfield=mysql_fetch_array($CLIPresult);
$Cdata=mysql_data($CLIPfield[CLIPtime]);

	
	print '<tr class="cont">
		<td align="justify">
		<div id="tex" align="justify">
		<span class="tit00C"><small>' .$CLIPfield[CLIPtopic]. '</small></span>  <small>' .$Cdata[1]. '</small>
		<br><b class="f00">' .$CLIPfield[CLIPtit]. '</b>
		<br><br>' .nl2br($CLIPfield[CLIPtex]). '
		<br><br><center></center>
		<br><br>
		</div>
		</td></tr>
		';
}

?>
<td></td></tr></table><hr>

