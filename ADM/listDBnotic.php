<?
	$offset = isset($_GET['offset'])?$_GET['offset']:0;
	$limit = isset($_GET['limit'])?$_GET['limit']:30;
	$ord = isset($_GET['ord'])?$_GET['ord']:"CONTid";
	$Qlimit = $limit;

require "../.htdbini.php";


$result  =  mysql_query("SELECT * FROM CONT order by $ord DESC LIMIT $offset,$Qlimit");
$Tresult  =  mysql_query("SELECT * FROM CONT");

$totalR = mysql_num_rows($result);
$totalQ = mysql_num_rows($Tresult);
$end = $offset + $limit;
if($end > $totalQ) $end = $totalQ;

print '	<center>
Listando ' .$totalR. ' de ' .$totalQ. ' resultados: <i>' .($offset +1). ' a ' .$end. '</i><br>
<table class="mini" border="1" width="100%" cellspacing="0" cellpadding="2">
<tr bgcolor="#000080" style="color : #ffffff;">
<td class="butd">&nbsp;<b>EDIT</b></b></td>
<td class="butd">&nbsp;<b>DEL</b></b></td>
<td class="butd">&nbsp;<b>Div</b></td>
<td class="butd">&nbsp;<b>Tipo</b></td>
<td class="butd">&nbsp;<b>Tópico</b></td>
<td class="butd">&nbsp;<b>Autor</b></td>
<td class="butd">&nbsp;<b>Título</b></td>
</tr>';

				 $RC = 1;
				 while  ($field=mysql_fetch_array($result))
				 {
							if($RC == 1){  echo "<tr>";  $RC = 0;}else {echo "<tr bgcolor=\"#F0F0F0\">"; $RC = 1;}

			print '
			<td>&nbsp;<a href ="' .$PHP_SELF. '?t=DBnotic&act=EditNews&Nid=' . $field[CONTid] . '" title="Editar notícia"><b>' . $field[CONTid] . '</b></a></td>
			<td>&nbsp;<a href ="' .$PHP_SELF. '?t=DBnotic&act=RemoveNews&Nid=' . $field[CONTid] . '"><b style="color:#ff0000">DEL</b></a></td>
					<td>&nbsp;' . $field[CONTdiv] . '</td>
					<td>&nbsp;' . $field[CONTtipo] . '</td>
					<td>&nbsp;' . $field[CONTtopic] . '</td>
					<td>&nbsp;' . $field[CONTautor] . '</td>
					<td>&nbsp;' . $field[CONTtit] . ' </td>
				 	</tr>';

				 }
echo "</table></center>\n";

$G = $totalQ -1;
$next = $offset + $limit;
$colspan = $TDporTR-2;
$pgs = ($G / $limit);

print '<table align="center" class="mini" border="1" width="80%" cellspacing="0" cellpadding="2"><tr><td align="left" nowrap>';


if($offset > 0) echo '<a href="javascript:history.back()">&laquo; Anterior</a>';

print '&nbsp;</td><td align="center" colspan="' .$colspan. '"><small> Página</small> ';

if($G > ($pgs * $limit)) $pgs++;
		$pg = 0;
		while ($pg <= $pgs){
				$im = $pg * $limit;
			if(strlen($pg) < 2) $pg = "0".$pg;
			if($offset == $im)print ' &nbsp;' .$pg. ' &nbsp; ';
				else print ' &nbsp; <a href="?t=DBnotic&amp;act=list&amp;limit=' .$limit. '&amp;offset=' .$im. '" class="f00">' .$pg. '</a> &nbsp; ';
				echo "\n";
				$pg++;
		}
echo "</td>\n<td align='right' nowrap>&nbsp;";
if($next < $G+1)echo '<a href="?t=DBnotic&amp;act=list&amp;limit=' .$limit. '&amp;offset=' .$next. '">Próxima &raquo;</a>';
echo "</td></tr></table><br>\n";

?>

<br><br><br><br>