<?php 
require_once 'classes/Security.php';
$_GET = Security::filter($_GET);
$_POST = Security::filter($_POST);
   $arquivo = $_GET["arquivo"];
   if(isset($arquivo) && file_exists($arquivo)){ // faz o teste se a variavel n�o esta vazia e se o arquivo realmente existe
      switch(strtolower(substr(strrchr(basename($arquivo),"."),1))){ 
		// verifica a extens�o do arquivo para pegar o tipo
		 case "json": $tipo="application/json"; break;
         case "pdf": $tipo="application/pdf"; break;
         case "jpg": $tipo="image/jpg"; break;
         case "mp3": $tipo="audio/mpeg"; break;
		}
      header("Content-Type: ".$tipo); // informa o tipo do arquivo ao navegador
      header("Content-Length: ".filesize($arquivo)); // informa o tamanho do arquivo ao navegador
      header("Content-Disposition: attachment; filename=".basename($arquivo)); // informa ao navegador que � tipo anexo e faz abrir a janela de download, tambem informa o nome do arquivo
      readfile($arquivo); // l� o arquivo
      exit; // aborta p�s-a��es
	}
?>