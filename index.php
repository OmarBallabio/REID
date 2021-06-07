<?
$WMK=1;
require_once "/home/reidorg/public_html/.globals.php";

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="pt-br"><head>
<title><? echo $TITULO?></title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="content-language" content="pt-br">
<meta name="Description" content="Revista Eletrônica Internacional de Cidadania">
<meta name="Keywords" content="Revista jurídica de direitos humanos, direitos fundamentais e cidadania">
<link rel="STYLESHEET" type="text/css" href="/.REIDstyle.css">
<style type="text/css">
BODY{background-color:<? echo $GLOBALS[background-color]?>;}
</style>
</HEAD>
<BODY bgColor="#eeeeee" text="#444444" link="#0000ff" vlink="#0000ee">
<div align="center">
	<div class="minitop">Revista jurídica de direitos humanos, direitos fundamentais e cidadania</div>
<TABLE width="1000" border="0" cellPadding="0" cellSpacing="2">
	<TR><td colspan="2">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff"  class="top_logo trounded tshadowed">
	 		<tr>
		<TD width="100"><a href="<? echo $GLOBALS[URL]?>" target="_top">
		<img src="<? echo $GLOBALS[URL]?>/screen/REIDlogomarca.jpg" title="REID - Revista jurídica de direitos humanos, direitos fundamentais e cidadania"  alt="REID - Revista jurídica de direitos humanos, direitos fundamentais e cidadania" border="0"></a>
		</TD>
		<td>
		<div style="width:750px;text-align:right;">
		<a class="TOPtitulo" href="" target="_top"><b><? echo $TITULO?></b></a>
		<br><span style="font-size : 10px;"><b>ISSN n&ordm; 1983-1811</b></span></div>
		<br>
		
		<div class="rounded" style="font-size : 20px;color:#cccccc;background-color:#cc0000;width:650px;text-align:center;">   
		<span><b>CONVOCAÇÃO DE ASSEMBLÉIA GERAL EXTRAORDINÁRIA</b>
		<br><span style="font-size : 12px;">BAIXE em PDF : </span>	
		<a  style="font-size : 18px;color:#ffffFF" href="arquivos/ata_convocação1_201306.pdf"><b>ATA 1</b></a>  
		 | 
		<a  style="font-size : 18px;color:#ffffff" href="arquivos/ata_convocação2_201306.pdf"><b>ATA 2</b></span>	
		</div>
		
		
		</td></tr></table>
	</td></TR>

	<TR>
		<td  width="780">
<?
    include "INCmenu.php";
?></td>
<!--BLOG!-->
		<TD  width="180" class="vmenu" <? echo $mouseover?> title="NOTÍCIAS, CURSOS e EVENTOS">
		<b><a href="http://www.iedc.org.br/index.php?topico=blog" class="fffmenu" target="_blank">
		<b>BLOG</b> - Últimas notícias</a></TD>
<!--BLOG!-->
	</TR>

	<TR><td valign="top" bgcolor="#ffffff" class="rounded">

		<table width="100%" border="0" cellpadding="2" cellspacing="2">
		<tr><td height="350" valign="top">
		<!-- Inc -->


<?
if(!$topico){

include "INCREVISTA.php";

}
else include 		"INC".$topico.".php";

?>
		<!-- Inc -->
		</td></tr></table>



<div align="center">

<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script><a class="twitter-share-button" data-via="reid" href="http://twitter.com/share" rel="nofollow" title="tweet"></a>
<iframe src="http://www.facebook.com/plugins/like.php?href=/conto/'.$categoria.'/'.$field[ID].'-'.$titulink.'.html&amp;layout=button_count&amp;show_faces=false&amp;width=80&amp;action=like&amp;locale=pt_BR" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:110px; height:20px"></iframe>
		<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
		{lang: ‘pt-BR’}
		</script>
		<g:plusone></g:plusone>

</div><br />



	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
	<td align="center" class="foot">
	Reprodução autorizada conforme <a href="http://creativecommons.org/licenses/by-nc-nd/2.5/br/" target="_blank"><b>Licença Creative Commons 2.5</b><br><br><img src="http://creativecommons.org/images/public/somerights20.png" alt="creativecommons.org" border="0"></a>
	<br></td>
	</tr>
	</table>


<!-- Main --></td>
<td valign="top" align="center" width="180">

<?
    include "INC_col2.php";
?>


<!-- Main --></TD></tr></table>
</div>
</body>
</html>

<?
// echo $_SERVER[REMOTE_ADDR];
 if($_SERVER[REMOTE_ADDR] == $IP2debug ){ include $htdocs.".debug.php";}
?>

