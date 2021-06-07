<script language="Javascript">
function validateFormOnSubmit(theForm) {
var reason = "";

  reason += validateEmpty(theForm.NOME);
  reason += validateEmpty(theForm.EMAIL);
  reason += validateEmpty(theForm.OBS);

  if (reason != "") { alert("Por favor, preencha os campos em amarelo.\n" + reason); return false;}
  return true;
}

function validateEmpty(fld) {
    var error = "";
    if (fld.value.length == 0) {
        fld.style.background = '#FFEC1D';
        error = " "
    } else {
        fld.style.background = 'White';
    }
    return error;
}
</script>
<br>
<div class="miolo" style="padding:10px;"><b class="f00">FALE COM O IEDC </b></div>
<ul>
<div class="campoautor">Escreva ao email: <a href="mailto:<? echo ascii_encode($GLOBALS[EMAIL_DESTINO]); ?>" title="Fale com o IEDC" target="_blank"><b><? echo ascii_encode($GLOBALS[EMAIL_DESTINO]); ?></b></a>
<br><br>Ou utilize o formulário abaixo:<br></div>
<form method="post" ACTION="WMpost.php" class="cmxform" onsubmit="return validateFormOnSubmit(this)">
<fieldset class="form_fieldset">
<legend>Informações para contato:</legend>

<label for="NOME">NOME:<br>
<input id="NOME" name="NOME" type="text" size="50" />
</label>
<br>

<label for="EMPRESA">ENTIDADE:<br>
<input id="EMPRESA" name="ENTIDADE" type="text" size="50" />
</label>
<br>

<label for="TELEFONE">TELEFONE:<br>
<input id="TELEFONE" name="TELEFONE" type="text" size="16" />
</label>

<br>

<label for="EMAIL">EMAIL:<br>
<input id="EMAIL" name="EMAIL" type="text" size="50" />
</label>
</fieldset>

<br>
<fieldset class="form_fieldset">
<legend>Observações:</legend>

<textarea rows="15" name="OBS" cols="40"></textarea>
	  <br><br><div align="center"><input type="submit" value="Enviar mensagem">
	  <br><br></div>
</fieldset>

</form>

