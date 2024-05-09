<?php
/*     
        $filename = 'teste.json';
        
        // Primeiro vamos ter certeza de que o arquivo existe e pode ser alterado
        if (is_writable($filename)) {

        // Em nosso exemplo, nós vamos abrir o arquivo $filename
        // em modo de adição. O ponteiro do arquivo estará no final
        // do arquivo, e é pra lá que $conteudo irá quando o 
        // escrevermos com fwrite().
            if (!$handle = fopen($filename, 'a')) {
                echo "Não foi possível abrir o arquivo ($filename)";
                exit;
            }

            // Escreve $conteudo no nosso arquivo aberto.
            if (fwrite($handle, $res) === FALSE) {
                echo "Não foi possível escrever no arquivo ($filename)";
                exit;
            }

            echo "Sucesso: Escrito ($res) no arquivo ($filename)";

            fclose($handle);

        } else {
            echo "O arquivo $filename não pode ser alterado";
        }
     */ 
       
       //*******************************************

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
	
	/* Cria um objeto da classe banco, voltado para o sistb e realiza a conexão */
	$db = banco::connectToTB();
       
    //$tipo=99;
    $tipo = 3;
    //echo "$tipo";
    
    if ($tipo==1){
        
        $arquivo = fopen('profissional.json','r');
        $string = file_get_contents('profissional.json');
        //echo $string;
        fclose($arquivo);       
        $arr = json_decode($string, true);
        $s=0;  
        $s=count($arr);

        //profissional
        for($i=0;$i<$s;$i++){
            $cod =  $arr[$i]["cod_profissional"];
            $nome = $arr[$i]["nome"];
            $login =  $arr[$i]["login"];
            $senha = $arr[$i]["senha"];
            $email =  $arr[$i]["email"];
            $nro = $arr[$i]["numero_conselho"];
            $ocup =  $arr[$i]["ocupacao"];
            //echo ("$cod , $nome , $login , $senha , $email,  $nro , $ocup");
        }
        
       /* IF (SELECT COUNT(*) FROM beta WHERE name = 'John' > 0)
        UPDATE alfa SET c1=(SELECT id FROM beta WHERE name = 'John')
        ELSE
        BEGIN
        INSERT INTO beta (name) VALUES ('John')
        INSERT INTO alfa (c1) VALUES (LAST_INSERT_ID())
        END
        */
        
        $select = "INSERT INTO `profissional` (`cod_profissional`, `nome`, `login`, `senha`, `email`, `numero_conselho`,`ocupacao`)
            VALUES ('$cod','$nome','$login', '$senha', '$email', '$nro','$ocup')";
        if (!mysql_query($select, $con)) {
            die('Error: ' . mysql_error());
        }    
    }
   if ($tipo==2){ 
       
        $arquivo = fopen('supervisaot.json','r');
        $string = file_get_contents('supervisaot.json');
        //echo $string;
        fclose($arquivo);       
        $arr = json_decode($string, true);
        $s=0;  
        $s=count($arr);
        //echo ($s);
       
    //supervisao
        for($i=0;$i<$s;$i++){
            $cod_paciente =  $arr[$i]["cod_paciente"];
            $cod_profissional = $arr[$i]["cod_profissional"];
            $cod_unidade =  $arr[$i]["cod_unidade"];
            $cod_tratamento = $arr[$i]["cod_tratamento"];
            $data_supervisionamento =  $arr[$i]["data_supervisionamento"];
            $comparecimento = $arr[$i]["comparecimento"];
            $observacao =  $arr[$i]["observacao"];
            //echo ("$cod , $nome , $login , $senha , $email,  $nro , $ocup");
            
            //echo $data_supervisionamento; print("::");
            $data_supervisionamento = implode("-", array_reverse(explode("/", $data_supervisionamento))); //revertemos a data para inserção no banco
           // $data = array_reverse(explode("\/", $data_supervisionamento));
            //echo $data_supervisionamento;print("::");
            
            if ($comparecimento==("Supervisionado em Visita Domiciliar")){
                $comparecimento = "SVD";
            } else if ($comparecimento==("Supervisionado na Unidade")){
                $comparecimento = "SU";
            }else if ($comparecimento==("Autoadministrado")){
                $comparecimento = "AA";
            }else if ($comparecimento==("Outro")){
                $comparecimento = "O";
            }else {
                $comparecimento = "N";
            }
            
            echo ("$cod_paciente, $cod_profissional, $cod_unidade, $cod_tratamento, $data_supervisionamento, $comparecimento");
        
        
            $select = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                        `data_supervisionamento`, `comparecimento`, `observacoes`)
                VALUES ('$cod_paciente', '$cod_profissional', '$cod_unidade','$cod_tratamento', '$data_supervisionamento', '$comparecimento', '$observacao')";
            if (!mysql_query($select, $con)) {
                    die('Error: ' . mysql_error());
            }           
        }//for
    }

    function verificaImportacao($verificador, $db){

      $checkn = "SELECT verifica_importacao FROM importacao WHERE verifica_importacao = '$verificador'";
      $rowsn = sizeof($db->selectQuery($checkn));

          if ($rowsn == 0) {

            return true;

          } else {
            return false;
          }
    }
    
    if ($tipo==99){
      echo "99";
      $arqmod = 'amb/supervisaot.json';
      if (file_exists($arqmod)) {
        $datamod = date ("F d Y H:i:s", filemtime($arqmod));
          echo "$arqmod foi modificado em " . date ("F d Y H:i:s.", filemtime($arqmod));
          echo "************* $datamod";

          $arquivo = fopen('amb/supervisaot.json','r');
          $string = file_get_contents('amb/supervisaot.json');
          //echo $string;
          fclose($arquivo);       
          $arr = json_decode($string, true);
          $s=0;  
          $s=count($arr);
          echo $s;
          print_r($arr[0]);
          print_r($arr[$s-1]);

          $data_supervisionamento = implode("", array_reverse(explode("/", $arr[0]['data_supervisionamento']))); 
          $data_supervisionamento2 = implode("", array_reverse(explode("/", $arr[$s-1]['data_supervisionamento']))); 
          $concat = $arr[0]['cod_supervisionamento'].$arr[0]['cod_paciente'].$data_supervisionamento."-".$arr[$s-1]['cod_supervisionamento'].$arr[$s-1]['cod_paciente'].$data_supervisionamento2;

          //echo "$concat";
          $vi = verificaImportacao($concat, $db);
          if ($vi){
              echo "não existe";
              $op = "INSERT INTO `tuberculose`.`importacao` (`cod_importacao`, `cod_profissional`, `data_importacao`, `verifica_importacao`)
                VALUES (NULL, '$_SESSION[cod_profissional]', CURRENT_TIMESTAMP, '$concat')";

              $db->insertQuery($op);
          }else{
              echo "já existe";
          }

      }else {
        echo "else";
      }      
    }
    
    if ($tipo==3){ 
      
       
        $arquivo = fopen('amb/pactratamt.json','r');
        $string = file_get_contents('amb/pactratamt.json');
        //echo $string;
        fclose($arquivo);       
        $arr = json_decode($string, true);
        $s=0;  
        $s=count($arr);
        //$arrCod = array();
        //$arrCodT = array();
        $ok1=1;
        $ok2=1;
        $ok3=1;
        $ok4=1;
        
        $arquivoS = fopen('amb/supervisaot.json','r');
        $stringS = file_get_contents('amb/supervisaot.json');
        //echo $string;
        fclose($arquivoS);       
        $arrS = json_decode($stringS, true);
        $ss=0;  
        $ss=count($arrS);
        /*echo "***ss** $ss *****";
        print_r($arrS);
        echo $stringS;*/

        $verifica_data = implode("", array_reverse(explode("/", $arrS[0]['data_supervisionamento']))); 
        $verifica_data2 = implode("", array_reverse(explode("/", $arrS[$ss-1]['data_supervisionamento']))); 
        $concat = $arrS[0]['cod_supervisionamento'].$arrS[0]['cod_paciente'].$verifica_data."-".$arrS[$ss-1]['cod_supervisionamento'].$arrS[$ss-1]['cod_paciente'].$verifica_data2;

        //echo "$concat";
        $vi = verificaImportacao($concat, $db);
        if ($vi){
            //echo "não existe";
            
            $parada = 0;
            echo ($ss);
            $nomeAnterior = "lala";
    
            for($i=0;$i<$s;$i++){
            
                $nome=  $arr[$i]["nome"];
                //echo $nome; print ( "\n");
                $mae=  $arr[$i]["mae"];
                $cod_pacientet=  $arr[$i]["_id"];
                $cod_tratamentot = $arr[$i]["cod_tratamento"];
                    
                $cod_pacienten = $cod_pacientet;
                $cod_tratamenton = $cod_tratamentot;
           
                if ($nomeAnterior != $nome){
            		    $procura = "select * from paciente where nome = '$nome' and mae= '$mae'";
            		    $contar = sizeof($db->selectQuery("select * from paciente where nome = '$nome' and mae= '$mae'"));

                    $nomeAnterior = $nome;
           
                    if($contar == 0){
                    //echo "entrou";
           
                        $cpf=  $arr[$i]["cpf"];
                        $cns=  $arr[$i]["cns"];
                        $nro_prontuario=  $arr[$i]["nro_prontuario"];
                        $data_nascimento=  $arr[$i]["data_nascimento"];
                        $idade=  $arr[$i]["idade"];
                        $sexo=  $arr[$i]["sexo"];
                        $gestante=  $arr[$i]["gestante"];
                        
                        $etnia=  $arr[$i]["etnia"];
                        $endereco=  $arr[$i]["endereco"];
                        $telefone=  $arr[$i]["telefone"];
                        $cidade=  $arr[$i]["cidade"];
                        $estado=  $arr[$i]["estado"];
                        $escolaridade=  $arr[$i]["escolaridade"];
                        $tipo_ocupacao=  $arr[$i]["tipo_ocupacao"];
                        $ocupacao=  $arr[$i]["ocupacao"];
                       
                        $nro_fie=  $arr[$i]["nro_fie"];
                        $naturalidade=  $arr[$i]["naturalidade"];
                        $nro_hygia=  $arr[$i]["nro_hygia"];
                        $cep=  $arr[$i]["cep"];
                        $data_hora=  $arr[$i]["data_hora"]; 
                       
                        $outra_unidade_recebe = $arr[$i]["outra_unidade_recebe"];
                        $outra_unidade = $arr[$i]["outra_unidade"];
                        $encerrado = $arr[$i]["encerrado"];
                        $data_rx_outro = $arr[$i]["data_rx_outro"];
                      
                        $observacoest = $arr[$i]["observacoes"];
                        $anti_hiv = $arr[$i]["anti_hiv"];
                        $pirazinamida = $arr[$i]["pirazinamida"];
                        $resultado_cultura_outro = $arr[$i]["resultado_cultura_outro"];
                        $resultado_outro = $arr[$i]["resultado_outro"];
                        $resultado_escarro = $arr[$i]["resultado_escarro"];
                        $izoniazida = $arr[$i]["izoniazida"];
                        $outros = $arr[$i]["outros"];
                        $data_notificacao = $arr[$i]["data_notificacao"];
                       //$cod_paciente = $arr[$i]["cod_paciente"];
                        $etambutol = $arr[$i]["etambutol"];
                        $cod_profissional = $arr[$i]["cod_profissional"];
                        $resultado_cultura_escarro = $arr[$i]["resultado_cultura_escarro"];
                        $tempo_inicio_sintomas = $arr[$i]["tempo_inicio_sintomas"];
                        $tratamento_anterior = $arr[$i]["tratamento_anterior"];
                        $rifampicina = $arr[$i]["rifampicina"];
                        $un_notificante = $arr[$i]["un_notificante"];
                        $resultado_rx_outro = $arr[$i]["resultado_rx_outro"];
                        $doenca_associada3 = $arr[$i]["doenca_associada3"];
                        $doenca_associada1 = $arr[$i]["doenca_associada1"];
                        $data_necropsia = $arr[$i]["data_necropsia"];
                        $doenca_associada2 = $arr[$i]["doenca_associada2"];
                        $outro_profissonal = $arr[$i]["outro_profissonal"];
                        $data_cultura_outro = $arr[$i]["data_cultura_outro"];
                        $resultado_outros = $arr[$i]["resultado_outros"];
                        $forma_clinica3 = $arr[$i]["forma_clinica3"];
                        $data_outros = $arr[$i]["data_outros"];
                        $forma_clinica1 = $arr[$i]["forma_clinica1"];
                        $tipo_descoberta = $arr[$i]["tipo_descoberta"];
                        $forma_clinica2 = $arr[$i]["forma_clinica2"];
                        $recebido = $arr[$i]["recebido"];
                        $data_cultura_escarro = $arr[$i]["data_cultura_escarro"];
                        $tempo_tratamento_anterior = $arr[$i]["tempo_tratamento_anterior"];
                        $data_tratamento_atual = $arr[$i]["data_tratamento_atual"];
                        $un_atendimento = $arr[$i]["un_atendimento"];
                        $resultado_histopatologico = $arr[$i]["resultado_histopatologico"];
                        $data_alta_tratamento = $arr[$i]["data_alta_tratamento"];
                        $resultado_rx_torax = $arr[$i]["resultado_rx_torax"];
                        $resultado_necropsia = $arr[$i]["resultado_necropsia"];
                        $data_escarro = $arr[$i]["data_escarro"];
                        $servico_descobriu = $arr[$i]["servico_descobriu"];
                        $data_outro = $arr[$i]["data_outro"];
                        $droga_tratamento = $arr[$i]["droga_tratamento"];
                        $data_histopatologico = $arr[$i]["data_histopatologico"];
                        $tipo_tratamento_atual = $arr[$i]["tipo_tratamento_atual"];
                        $etionamida = $arr[$i]["etionamida"];
                        $motivo_alta = $arr[$i]["motivo_alta"];
                        $estreptomicina = $arr[$i]["estreptomicina"];
                        $data_rx_torax = $arr[$i]["data_rx_torax"];
            
                        /* echo ("$cod_paciente,$nome, $cpf,$cns, $nro_prontuario, 
                              $data_nascimento, $idade, $sexo, $gestante, $mae,$etnia,
                              $endereco, $telefone, $cidade, $estado, $escolaridade, $tipo_ocupacao,
                              $ocupacao, $observacoes, $nro_fie, $naturalidade, $nro_hygia, $cep, $data_hora"); 
                       */
                         //***colocar a data de nascimento no select abaixo, verificar como ela está sendo enviada no json
                         //ideia colocar um campo "tipo" no mobile, se tipo=editado precisa fazer um update olhando todos os campos, se tipo=novo cadastra o paciente, caso contrario nao fazer update (ou nem coloca no arquivo)
                        
                        //faz o insert caso o paciente não esteja cadastrado
               
                        $select = "INSERT INTO `paciente` (`cod_paciente`,`nome`, `cpf`, `cns`, `nro_prontuario`,`data_nascimento`, `idade`, `sexo`,
                        `gestante`, `mae`, `etnia`, `endereco`, `telefone`, `cidade`,`estado`, `escolaridade`, `tipo_ocupacao`,
                        `ocupacao`,  `nro_fie`, `naturalidade`, `nro_hygia`, `cep`, `data_hora` )
                        VALUES (NULL,'$nome', '$cpf','$cns', '$nro_prontuario', 
                        '$data_nascimento', '$idade', '$sexo', '$gestante', '$mae','$etnia',
                        '$endereco', '$telefone', '$cidade', '$estado', '$escolaridade', '$tipo_ocupacao',
                        '$ocupacao',  '$nro_fie', '$naturalidade', '$nro_hygia', '$cep', '$data_hora' )";
               
                				$db->doAutoCommit(false);
                				$ok1 = $db->insertQuery($select);
               
                        $selectp = "SELECT cod_paciente FROM paciente ORDER BY cod_paciente DESC LIMIT 1";
                
				        $infos = $db->selectQuery($selectp);
                        $cod_pacienten = $infos[0]['cod_paciente'];
                
                
                        $selecttr = "INSERT INTO `tratamento`(`tratamento_anterior`, `tempo_tratamento_anterior`, `forma_clinica1`, 
                            `forma_clinica2`, `forma_clinica3`, `tipo_descoberta`, `recebido`, `tempo_inicio_sintomas`, `data_escarro`, 
                            `resultado_escarro`, `outros`, `data_rx_torax`, `resultado_rx_torax`, `data_rx_outro`, `resultado_rx_outro`, 
                            `data_histopatologico`, `resultado_histopatologico`, `data_necropsia`, `resultado_necropsia`, `data_outros`, 
                            `resultado_outros`, `doenca_associada1`, `doenca_associada2`, `doenca_associada3`, `anti_hiv`, `data_tratamento_atual`, 
                            `tipo_tratamento_atual`, `droga_tratamento`, `rifampicina`, `izoniazida`, `estreptomicina`, `pirazinamida`, 
                            `etambutol`, `etionamida`, `observacoes`, `cod_paciente`, `data_outro`, `resultado_outro`, 
                            `data_cultura_escarro`, `resultado_cultura_escarro`, `data_cultura_outro`, `resultado_cultura_outro`, 
                            `servico_descobriu`, `data_alta_tratamento`, `motivo_alta`, `un_notificante`, `un_atendimento`, `data_notificacao` )
                           VALUES ('$tratamento_anterior', '$tempo_tratamento_anterior','$forma_clinica1', 
                            '$forma_clinica2', '$forma_clinica3','$tipo_descoberta','$recebido','$tempo_inicio_sintomas', '$data_escarro',
                            '$resultado_escarro', '$outros' ,  '$data_rx_torax','$resultado_rx_torax','$data_rx_outro','$resultado_rx_outro' ,
                            '$data_histopatologico' ,'$resultado_histopatologico','$data_necropsia','$resultado_necropsia', '$data_outros', 
                            '$resultado_outros','$doenca_associada1',  '$doenca_associada2','$doenca_associada3' , '$anti_hiv', '$data_tratamento_atual',
                            '$tipo_tratamento_atual' ,'$droga_tratamento' ,  '$rifampicina','$izoniazida' ,'$estreptomicina','$pirazinamida',
                            '$etambutol','$etionamida' ,'$observacoest' , '$cod_pacienten', '$data_outro', '$resultado_outro', 
                            '$data_cultura_escarro','$resultado_cultura_escarro', '$data_cultura_outro',  '$resultado_cultura_outro', 
                            '$servico_descobriu', '$data_alta_tratamento', '$motivo_alta','$un_notificante' ,  '$un_atendimento', '$data_notificacao'
                         )";
                 
                        
              
			                  $ok2 = $db->insertQuery($selecttr);
               
                        $selectt = "SELECT cod_tratamento FROM tratamento ORDER BY cod_paciente DESC LIMIT 1";
                  
              					$infot = $db->selectQuery($selectt);
              					$cod_tratamenton = $infot[0]['cod_tratamento'];
                    
				
                				if ($ok1 && $ok2 ) {
                					$db->doCommit();
                					//$db->endConnection();
                				    echo "$nome cadastrado com sucesso.  ";
                				} else {
                					$db->doRollback();
                					$db->endConnection();
                					echo "<br><br><b>Problema ao inserir informações, transação cancelada!</b>";
                					die('<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php>');
                				} 
                
                
                    }// if -> insert de pac não cadastrado
                }//nome anterior
     
            //supervisao
            for($j=$parada;$j<$ss;$j++){
                $cod_pacienteS =  $arrS[$j]["cod_paciente"];
                //echo "<br /> ***"; 
                //echo $j; echo "-";
                //echo $cod_pacienteS; echo "-";
                
                //echo $cod_pacientet;
                
                if ($cod_pacienteS==$cod_pacientet){
                
                    $cod_profissional = $arrS[$j]["cod_profissional"];
                    $cod_unidade =  $arrS[$j]["cod_unidade"];
                  //  $cod_tratamentoS = $arrS[$i]["cod_tratamento"];
                    $data_supervisionamento =  $arrS[$j]["data_supervisionamento"];
                    $comparecimento = $arrS[$j]["comparecimento"];
                    $observacao =  $arrS[$j]["observacao"];
                    

                    //echo $data_supervisionamento; print("::");
                    $data_supervisionamento = implode("-", array_reverse(explode("/", $data_supervisionamento))); //revertemos a data para inserção no banco
                    // $data = array_reverse(explode("\/", $data_supervisionamento));
                    echo $data_supervisionamento;print("::");

                    if ($comparecimento==("Supervisionado em Visita Domiciliar")){
                        $comparecimento = "SVD";
                    } else if ($comparecimento==("Supervisionado na Unidade")){
                        $comparecimento = "SU";
                    }else if ($comparecimento==("Autoadministrado")){
                        $comparecimento = "AA";
                    }else if ($comparecimento==("Outro")){
                        $comparecimento = "O";
                    }else {
                        $comparecimento = "N";
                    }
                    
                    $selects = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                                `data_supervisionamento`, `comparecimento`, `observacoes`)
                        VALUES ('$cod_pacienten', '$cod_profissional', '$cod_unidade','$cod_tratamenton', '$data_supervisionamento', '$comparecimento', '$observacao')";
                   
            				$db->doAutoCommit(false);
            				$ok3 = $db->insertQuery($selects);
            				if ($ok3) {
            					$db->doCommit();
            					echo ("$cod_pacienteS, $cod_profissional, $cod_unidade, $cod_tratamenton, $data_supervisionamento, $comparecimento ");
            				   // echo "Operação realizada com sucesso!";
            				} else {
            					$db->doRollback();
            					$db->endConnection();
            					echo "<br><br><b>Problema ao inserir supervisão, transação cancelada!</b>";
            					die('<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php>');
            				} 
                       
                }//if ps = pt 
                else break;
                        
            }//for supervisao
         
        $parada = $j;  
             
        }//for paciente/tratamento
        
        $op = "INSERT INTO `tuberculose`.`importacao` (`cod_importacao`, `cod_profissional`, `data_importacao`, `verifica_importacao`)
              VALUES (NULL, '$_SESSION[cod_profissional]', CURRENT_TIMESTAMP, '$concat')";
        $db->doAutoCommit(false);

        $ok4 = $db->insertQuery($op);
        if ($ok1 && $ok2 && $ok3 && $ok4) {
          $db->doCommit();
          echo ("Arquivo importado com sucesso. ");
           // echo "Operação realizada com sucesso!";
        } else {
          $db->doRollback();
          $db->endConnection();
          echo "<br><br><b>Problema ao inserir supervisão, transação cancelada!</b>";
          die('<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php>');
        } 
        
        //if do verifica arquivo
        }else{

            echo "Arquivo já importado anteriormente. ";
             echo "<META HTTP-EQUIV='REFRESH' CONTENT='3; URL=index.php?acao=dash+menu'>";
        }
         
    }//if tipo=3;
    
    
   /*echo "Cadastrado com sucesso";*/
	 echo "<META HTTP-EQUIV='REFRESH' CONTENT='3; URL=index.php?acao=dash+menu'>";
   
   
    
?>
                                    