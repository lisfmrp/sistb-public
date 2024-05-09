<?php
  
  /* Verifica se o usuário está logado */
	if (!isset($_SESSION["cod_profissional"])) {
		die("<script> alert('window.location.href = 'index.html'; </script>");
	}
	/* Importa-se a classe Security */
	require_once 'classes/Security.php';
	$_GET = Security::filter($_GET);
	$_POST = Security::filter($_POST);
	/* Importa-se o namespace (caminho do arquivo) da clase banco e 
	* cria-se um aliase (apelido) para ele */
	use Uteis\banco as banco;

	/* Importa-se a classe banco */
	require_once 'classes/banco.php';
	
	date_default_timezone_set('America/Sao_Paulo');
	//$data=date("dmY"); //aqui pegamos a data pois foi ela quem usamos como valor da sessao logado
	
	/* Cria um objeto da classe banco, voltado para o sistb 
		* e realiza a conexão */
		$db = banco::connectToTB();
  
	$i=1;
	
	if ($i==1){
       
	   //$sql = mysql_query("SELECT paciente.*, tratamento.cod_tratamento, tratamento.un_supervisao from paciente, tratamento where paciente.cod_paciente=tratamento.cod_paciente and tratamento.un_supervisao = '$_SESSION[cod_unidade]' and tratamento.encerrado=0");
		//$sql = ("SELECT paciente.*, tratamento.* from paciente, tratamento where paciente.cod_paciente=tratamento.cod_paciente and tratamento.un_supervisao = '$_SESSION[cod_unidade]' and tratamento.encerrado=0");
		$sql = ("SELECT paciente.cod_paciente,paciente.nome, paciente.mae, paciente.idade, tratamento.cod_tratamento from paciente, tratamento where paciente.cod_paciente=tratamento.cod_paciente and tratamento.un_supervisao = '$_SESSION[cod_unidade]' and tratamento.encerrado=0");
        $infos = $db->selectQuery($sql);
		//print $infos;
		foreach ($infos as $info) {
					$result2[]=$info;									
         }                                               
	   
	  // while ($linha = mysql_fetch_assoc($sql)) $result2[]=$linha;
       $res = json_encode($result2);
	   echo json_encode($result2); //não mostra (servidor)
	   
       //print_r ($result2);  //$result2 ok
       print_r ($res);    //não mostra (servidor)
       //$filename = 'paciente.json';
       $filename = 'paciente.json';
	   chmod($filename,0777); 
       escrever($filename, $res);
	   
       substituir();
    }
	
	function escrever($filename, $res){
            
             // Primeiro vamos ter certeza de que o arquivo existe e pode ser alterado
            //if (is_writable($filename)) {

            // Em nosso exemplo, nós vamos abrir o arquivo $filename
            // em modo de adição. O ponteiro do arquivo estará no final
            // do arquivo, e é pra lá que $conteudo irá quando o 
            // escrevermos com fwrite(). //w+ = Leitura e escrita,ponteiro no começo do arquivo, criando caso não exista.
                if (!$handle = fopen($filename, 'w+')) { ///fopen($filename, 'a') append, não escreve por cima
                    echo "Não foi possível abrir o arquivo ($filename)";
					echo 'fopen failed. reason: ', $php_errormsg;
                    exit;
                }

                // Escreve $conteudo no nosso arquivo aberto.
                if (fwrite($handle, $res) === FALSE) {
                    echo "Não foi possível escrever no arquivo ($filename)";
                    exit;
                }
                else{
                    //echo "Sucesso: Escrito ($res) no arquivo ($filename)";
                    //echo "Sucesso: Escrito no arquivo ($filename)";
              
                    fclose($handle);
                }

           // } else {
             //   echo "O arquivo $filename não pode ser alterado";
          //  }
            
            
        }
		
		function substituir(){
            /*
            //$arquivo = "nomedoarquivo.txt";   // Arquivo para abrir
            $procurar = "null";   // Palavra que sera substituida
            $substituir = "";   // Palavra que ficara no lugar

            //Obtem o conteudo do arquivo
            $obter = file_get_contents($arquivo);
            $novo = str_replace($procurar, $substituir, $obter);

            //Exibe o novo texto (modificado)
            echo $novo;

            //Grava o novo texto (modificado) no arquivo
            $gravar = fopen($arquivo, "w");
            fwrite($gravar, $novo);
            fclose($gravar);
            */
            
            
            //**************************************************
            
            //le o arquivo aux1.txt que no caso conterá um dos arquivos listado
            $file=file('paciente.json');
            //verifica a quantidade de linhas do arquigo listado
            $contador=count($file);
			//echo $contador;
			//if ($contador!=0){
			
				//cria um novo arquivo  e se ja existir sobrescreve
				$arquivo=fopen("temp.txt","w");
				for($j=0;$j<$contador;$j++)
				{  //echo ($file[$i]);
					//procura por uma ocorrencia da palavra null
					$pos=strpos($file[$j],'null');
					// caso encontre  substitui por ""
					if($pos!==false)
					{
						$novo=str_replace('null','"" ',$file[$j]);
						//echo $novo;
					}
					else
						$novo=$file[$j];
					//escreve o conteudo da variavel novo no arquivo aberto
					fwrite($arquivo,$novo);

				}
				//fecha o arquivo
				fclose($arquivo);
				//por fim renomeia ele pro nome original que era.. ou seja com a extensado json
				//rename("temp.txt","paciente.json");
				
				echo "Sucesso: Escrito no arquivo (paciente.json)";
				
				
				?>
				<html>  
				<a href="baixar.php?arquivo=paciente.json">Baixar Arquivo</a>
				</html>
		<?php		
				
            //}else{
			//echo "Erro ao escrever, arquivo vazio"}
            
            
        }
    

?>
        