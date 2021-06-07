<?

$palavra =$buscaq;

require ".htdbini.php";

		print '<table width="100%" border="0" cellpadding="10" cellspacing="2">';

$CONTconta = mysql_query("SELECT count(*) FROM CONT WHERE MATCH(CONTtit,CONTresumo,CONTautor,CONTtex,CONTcred) AGAINST ('$palavra' IN BOOLEAN MODE) ");
$CONTresult = mysql_query("SELECT * FROM CONT WHERE MATCH(CONTtit,CONTresumo,CONTautor,CONTtex,CONTcred) AGAINST ('$palavra' IN BOOLEAN MODE) ");

$conta = mysql_result($CONTconta,0);

	
	if(strlen($palavra)<=3)$resmsg = 'Palavra muito curta. <br>Tente uma busca mais específica.';
	else if($conta<=0)	$resmsg =  'Não foram encontrados artigos contendo a palavra "' .$palavra . '"';
	else $resmsg =  'Listando ' .$conta. ' artigos contendo a palavra "<b>' .$palavra . '</b>":';

print '<tr><td class="miolo"><hr>' .$resmsg. '</td></tr>';

		$nit = 0;
		while($CONTfield=mysql_fetch_array($CONTresult)) {
		$nit++;
		$Cdata=mysql_data($CONTfield[CONTtime]);
		
		$Titulomat = (strlen($CONTfield[CONTtit])>0)? $CONTfield[CONTtit] : "Sem título";
		
			print '<tr>
			<td class="cont"><b>' .$nit. '</b> - <a href="/?CONT=' .$CONTfield[CONTid]. '" class="f00">' .$Titulomat. '</a>';
			
			if(strlen($CONTfield[CONTautor])>3)print '<br> &nbsp; &nbsp; &nbsp; Por <span class="campoautor"> ' .$CONTfield[CONTautor]. '</span>';
			
			print '<div class="minimenu">
			<a href="/?CONT=' .$CONTfield[CONTid]. '" class="f00">ARTIGO</a> '.linkfile($CONTfield[CONTid]).'';
	
			if(strlen($CONTfield[CONTresumo])>3)print '| <a href="' .$GLOBALS[URL]. '/?CONT=' .$CONTfield[CONTid]. '&mode=resumo" class="f00">RESUMO</a>';
	
		print '</div></td></tr>';
	}
			print '<tr><td><hr></td></tr>';
			print '</table>';
?>		



