<h3>Newsletter REID</h3>
Remover assinante: 

<form id=form_assinar action="../assinar.php?act=remover" method="post" target="_blank">
<input type="text" class="textbox_REID" id="email" name="email" title="Preencha aqui com endereço de email a remover" value="";>
<input type="submit" class="submit_REID" value="REMOVER" title="Clique aqui para remover">
<input type="hidden" name="act" value="remover"></form>

<hr>
Assinantes confirmados:<br><br><br>

<?

require "../.htdbini.php";
$GLOBALS[table] = 'REIC.USRDB';
$result  =  mysql_query("SELECT * FROM $GLOBALS[table] WHERE confirmado >0 ");


				 $RC = 1; 
				 while  ($field=mysql_fetch_array($result))   
				 { 
			print $field[email] . '<br>';
				 }





?>


