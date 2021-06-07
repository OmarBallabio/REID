<?

if(isset($_POST[newbg])){
require "../.htdbini.php";
$GLOBALS[table] = 'REID.CONF';
$result  =  mysql_query("UPDATE `REID`.`CONF` SET `valor`='$_POST[newbg]' WHERE `chave`='bgcolor';");

print '<script language="JavaScript"> top.location.href = location.href;</script>';

}
?>


<h3>Cor de fundo:</h3>

<hr>

<SCRIPT LANGUAGE="JavaScript">
var myColor, decColor, pctColor="" ;

function GetColor( myColor, decColor, pctColor ) {
     	document.forms[0].newbg.value = "#" + myColor ;
}

function GetClick( ) {
  document.forms[0].submit();
}

</SCRIPT>


<center>
<form id=form_assinar action="?t=aparencia&act=novacor" method="post">
<input type="text" id="newbg" name="newbg" value="#eeeeee";>
<input type="submit" value="Alterar cor">
</form>
<br><br>
Mais cores:<a href="http://www.pagetutor.com/common/bgcolors1536.png" target="_blank">Expanded Color Chart</a>
</center>

<br><br>






