
<?
if ($_POST['senha'] == teste){
	if($local == "n�o selecionado" || $file == "none"){
		 if($local == "n�o selecionado"){
			$frasel = "Selecione um local para o arquivo ser guardado!";
		 }
		 if($file == none){
			$frasef = "Voc� n�o selecionou nenhum arquivo para enviar!";
		 }
		header("location: form-up.php?frasel=$frasel&frasef=$frasef");
		exit;
	}

	//Vari�vel que guardar� o local onde o arquivo ser� enviado
	$dest = $local."/".$file_name;
	 
	//	MOVE_UPLOADED_FILE: Esta fun��o checa para ter certeza que o arquivo
	//	designado por $file � um arquivo v�lido uploadeado (significando	que 
	//	ele foi uploadeado pelo mecanismo do PHP de HTTP POST). Se o arquivo
	//	for v�lido, ele ser� movido para o $dest dado pelo destino.
	//	Executa o comando do upload no servidor
	if(!move_uploaded_file($file, $dest)) {
		 $frase = "<font color=FF0000>N�o foi poss�vel fazer upload! Arquivo inv�lido.</font>";
		} else {
			$frase = "Arquivo enviado com sucesso! em " .date("d/m/Y H:i:s");
		}

	}
	

?>