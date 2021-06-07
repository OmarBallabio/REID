<?


function ThisfileExtension($file) {
    $fileExp = explode('.', $file);
    $filetype = $fileExp[count($fileExp) -1];
	return strtolower($filetype);
}


function valida_filename($filename){
	$extension = ThisfileExtension($filename);
	if(eregi('[^a-zA-Z0-9_.-]', $filename)) {
		
		print "<b>".htmlentities($filename)."</b> Não é um nome de arquivo válido. Use somente letras, números e hífen, sem espaços ou acentuação.<br><br><br>";
		return false;
	}
	
	else if( $extension == "doc" || $extension == "pdf") return true;
	else  {
		print "<b>".$extension ."</b> não é uma extensão válida. Use somente PDF ou DOC<br><br><br>";
		return false;
	}
}

$filename = $_FILES['userfile']['name'];


if (valida_filename($filename)=== true){

		$uploaddir = $GLOBALS[htdocs].'arquivos/';
		$uploadfile = $uploaddir. $_FILES['userfile']['name'];
		

	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . $id."-".$_FILES['userfile']['name'])) {
		   $nome = basename($uploadfile);
		   Echo "Arquivo $nome enviado com sucesso!<br><br>";
		      } else {
		          print "Não foi possivel enviar o arquivo:<br><br>";
		         // print_r($_FILES);
	}
} else {




}

?>