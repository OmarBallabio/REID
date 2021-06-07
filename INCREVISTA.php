<?php

// ARTIGO

if(isset($_GET[CONT])){

	$CONT=$_GET[CONT];
	$CONTresult = mysql_query("select * from CONT WHERE CONTid = '$CONT'");
	$CONTfield=mysql_fetch_array($CONTresult);
	$Cdata=mysql_data($CONTfield[CONTtime]);


	if($_GET[mode]=="resumo"){

		print '	<table width="100%" border="0" cellpadding="2" cellspacing="2"><tr><td>
		<tr><td><div class="miolo"><br>' .nl2br($CONTfield[CONTresumo]). '</div><br><div class="minimenu" align="center"><br>
		<b>&#171; <a href="javascript:history.back();">VOLTAR</a> '.linkfile($CONTfield[CONTid]).' | <a href="/?CONT=' .$CONTfield[CONTid]. '" class="f00">ARTIGO</a> &#187;<br><br><br><br>
		</td></tr></table>';
	} else {
		print '<div align="right">';
			include "INCzoom.php";
		print'</div>';
		print '	<table width="100%" border="0" cellpadding="2" cellspacing="2"><tr><td>
		<tr><td><div id="tex" class="miolo"><br>' .nl2br($CONTfield[CONTtex]). '</div><br><div class="nota"><br>' .nl2br($CONTfield[CONTcred]). '</div>
		<br><br><b class="tit00C">'.linkfile($CONTfield[CONTid]).'	</b> &nbsp; <a href="#" onclick="window.open(\'print.php?CONT=' .$CONTfield[CONTid]. '\',\'POP\',\'height=350,width=550,menubar,toolbar,scrollbars,resizable\');" class="tit00C">Imprimir</a>
		</td></tr></table><hr><br><br>';
	}

}else{


// Carrega edição
$LDIV= $numero ;

// titulo da EDIÇÃO
print '<span class="tit_edicao">'. getconfs('titulo_'.$LDIV) ."</span>";

$TIT_EDICAO = mysql_query("select CONTid,CONTtipo, CONTtopic, CONTtit, CONTautor,CONTresumo from CONT WHERE CONTdiv LIKE '$LDIV' ORDER BY CONTtipo, CONTtopic, CONTid ASC");
while($row = mysql_fetch_assoc($TIT_EDICAO)){$EDICAO[$row[CONTtipo]][]  = $row;}

//Apresentação
$CONTfield = $EDICAO['Apresentacao'][0];
print '<table width="100%" border="0" cellpadding="10" cellspacing="2">';
print '<tr class="cont"><td><a href="/?CONT=' .$CONTfield[CONTid]. '" class="f00"><b>' .$CONTfield[CONTtit]. '</b></a>
		<br><span class="campoautor">' .$CONTfield[CONTautor]. '</span> ';
	if(strlen($CONTfield[CONTresumo])>3)print '<br>' .$CONTfield[CONTresumo]. '	 &nbsp; <a href="/?CONT=' .$CONTfield[CONTid]. '" class="f00">Leia mais &raquo;</a>';
		print '</td></tr>';



// LISTA ARTIGOS ordenados por autor

$CONTartigo= $EDICAO['Artigo'];
		while($CONTfield = @each($CONTartigo)) {
			print '<tr><td class="cont">';
if($topictop!=$CONTfield[1][CONTtopic])print '<br><span class="campoautor"><b>' .strtoupper($CONTfield[1][CONTtopic]). '</b></span><br>';
print '	<br><a href="/?CONT=' .$CONTfield[1][CONTid]. '" class="f00">' .$CONTfield[1][CONTtit]. '</a>
			<br><br><span class="campoautor"> ' .$CONTfield[1][CONTautor]. '</span>';
			print '<div class="minimenu">
			<a href="/?CONT=' .$CONTfield[1][CONTid]. '" class="f00">ARTIGO</a> '.linkfile($CONTfield[1][CONTid]).'';
			if(strlen($CONTfield[1][CONTresumo])>3)print ' | <a href="' .$GLOBALS[URL]. '/?CONT=' .$CONTfield[1][CONTid]. '&mode=resumo" class="f00">RESUMO</a>';
		print '</div></td></tr>';
		$topictop = $CONTfield[1][CONTtopic];
		}

// LISTA textos ordenados por tópico

$CONTTopico= $EDICAO['Topico'];
		while($CONTfield = @each($CONTTopico)) {
			print '<tr><td class="cont">';
if($topictop!=$CONTfield[1][CONTtopic])print '<br><span class="campoautor"><b>' .$CONTfield[1][CONTtopic]. '</b></span><br>';
print '	<br><a href="/?CONT=' .$CONTfield[1][CONTid]. '" class="f00">' .$CONTfield[1][CONTtit]. '</a>
			<br><br><span class="campoautor"> ' .$CONTfield[1][CONTautor]. '</span>';
			print '<div class="minimenu">
			<a href="/?CONT=' .$CONTfield[1][CONTid]. '" class="f00">ARTIGO</a> '.linkfile($CONTfield[1][CONTid]).'';
			if(strlen($CONTfield[1][CONTresumo])>3)print ' | <a href="' .$GLOBALS[URL]. '/?CONT=' .$CONTfield[1][CONTid]. '&mode=resumo" class="f00">RESUMO</a>';

if(strlen($CONTfield[1][CONTresumo])>3)print '<br>' .$CONTfield[1][CONTresumo]. '	 &nbsp; <a href="/?CONT=' .$CONTfield[1][CONTid]. '" class="f00">Leia mais &raquo;</a>';
		print '<br></td></tr>';
		$topictop = $CONTfield[1][CONTtopic];
	}

//Colaboradores
$CONTfield = $EDICAO['Colabora'][0];
print '<tr class="cont"><td><hr><a href="/?CONT=' .$CONTfield[CONTid]. '" class="f00"><b>' .$CONTfield[CONTtit]. '</b></a> ';
	if(strlen($CONTfield[CONTresumo])>3)print '<br>' .$CONTfield[CONTresumo]. '	 &nbsp; <a href="/?CONT=' .$CONTfield[CONTid]. '" class="f00">Leia mais &raquo;</a>';
		print '</td></tr>';



			print '<tr><td><hr></td></tr>';
			print '</table>';
}
?>

