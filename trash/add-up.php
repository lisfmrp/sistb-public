
<?
if ($_POST['senha'] == teste){
	if($local == "não selecionado" || $file == "none"){
		 if($local == "não selecionado"){
			$frasel = "Selecione um local para o arquivo ser guardado!";
		 }
		 if($file == none){
			$frasef = "Você não selecionou nenhum arquivo para enviar!";
		 }
		header("location: form-up.php?frasel=$frasel&frasef=$frasef");
		exit;
	}

	//Variável que guardará o local onde o arquivo será enviado
	$dest = $local."/".$file_name;
	 
	//	MOVE_UPLOADED_FILE: Esta função checa para ter certeza que o arquivo
	//	designado por $file é um arquivo válido uploadeado (significando	que 
	//	ele foi uploadeado pelo mecanismo do PHP de HTTP POST). Se o arquivo
	//	for válido, ele será movido para o $dest dado pelo destino.
	//	Executa o comando do upload no servidor
	if(!move_uploaded_file($file, $dest)) {
		 $frase = "<font color=FF0000>Não foi possível fazer upload! Arquivo inválido.</font>";
		} else {
			$frase = "Arquivo enviado com sucesso! em " .date("d/m/Y H:i:s");
		}

	}
	

?>