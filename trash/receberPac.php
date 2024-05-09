
<?php


/*
    $con = mysql_connect("localhost", "tuberculose", "senha");
    if (!$con) {
        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("tuberculose", $con);
    //$nome = $conteudo[2];

       $sql = mysql_query("SELECT * from profissional");
       while ($linha = mysql_fetch_assoc($sql)) $result[]=$linha;
       $res = json_encode($result);
       print($res);
       
      // $dec = json_decode($res);
      // print($dec);
       
       
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

       
       
       
       mysql_close();
    
       
      */ 
       
       //*******************************************

    $con = mysql_connect("localhost", "tuberculose", "senha");
    if (!$con) {
        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("tuberculose", $con);

    $codPacNovo=0;
    $codTratNovo=0;
    
    $tipo=3;
    
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
    
    
    if ($tipo==3){ 
       
        $arquivo = fopen('pacientet.json','r');
        $string = file_get_contents('pacientet.json');
        //echo $string;
        fclose($arquivo);       
        $arr = json_decode($string, true);
        $s=0;  
        $s=count($arr);
        
       // echo $string;
       
    
        for($i=0;$i<$s;$i++){

           $cod_paciente=  $arr[$i]["_id"];
           $nome=  $arr[$i]["nome"];
           $cpf=  $arr[$i]["cpf"];
           $cns=  $arr[$i]["cns"];
           $nro_prontuario=  $arr[$i]["nro_prontuario"];
           $data_nascimento=  $arr[$i]["data_nascimento"];
           $idade=  $arr[$i]["idade"];
           $sexo=  $arr[$i]["sexo"];
           $gestante=  $arr[$i]["gestante"];
           $mae=  $arr[$i]["mae"];
           $etnia=  $arr[$i]["etnia"];
           $endereco=  $arr[$i]["endereco"];
           $telefone=  $arr[$i]["telefone"];
           $cidade=  $arr[$i]["cidade"];
           $estado=  $arr[$i]["estado"];
           $escolaridade=  $arr[$i]["escolaridade"];
           $tipo_ocupacao=  $arr[$i]["tipo_ocupacao"];
           $ocupacao=  $arr[$i]["ocupacao"];
           $observacoes=  $arr[$i]["observacoes"];
           $nro_fie=  $arr[$i]["nro_fie"];
           $naturalidade=  $arr[$i]["naturalidade"];
           $nro_hygia=  $arr[$i]["nro_hygia"];
           $cep=  $arr[$i]["cep"];
           $data_hora=  $arr[$i]["data_hora"]; 
            
          /* echo ("$cod_paciente,$nome, $cpf,$cns, $nro_prontuario, 
                $data_nascimento, $idade, $sexo, $gestante, $mae,$etnia,
                $endereco, $telefone, $cidade, $estado, $escolaridade, $tipo_ocupacao,
                $ocupacao, $observacoes, $nro_fie, $naturalidade, $nro_hygia, $cep, $data_hora"); 
         */
           //***colocar a data de nascimento no select abaixo, verificar como ela está sendo enviada no json
           //ideia colocar um campo "tipo" no mobile, se tipo=editado precisa fazer um update olhando todos os campos, se tipo=novo cadastra o paciente, caso contrario nao fazer update (ou nem coloca no arquivo)
            
           $procura = mysql_query("select * from paciente where nome = '$nome' and mae= '$mae'");
           $contar = mysql_num_rows($procura);
           
           if($contar == 0){
                //faz o insert caso o paciente não esteja cadastrado
               
               $select = "INSERT INTO `paciente` (`cod_paciente`,`nome`, `cpf`, `cns`, `nro_prontuario`,`data_nascimento`, `idade`, `sexo`,
                `gestante`, `mae`, `etnia`, `endereco`, `telefone`, `cidade`,`estado`, `escolaridade`, `tipo_ocupacao`,
                `ocupacao`, `observacoes`, `nro_fie`, `naturalidade`, `nro_hygia`, `cep`, `data_hora` )
                VALUES (NULL,'$nome', '$cpf','$cns', '$nro_prontuario', 
                '$data_nascimento', '$idade', '$sexo', '$gestante', '$mae','$etnia',
                '$endereco', '$telefone', '$cidade', '$estado', '$escolaridade', '$tipo_ocupacao',
                '$ocupacao', '$observacoes', '$nro_fie', '$naturalidade', '$nro_hygia', '$cep', '$data_hora' )";
                       
                if (!mysql_query($select, $con)) {
                    die('Error: ' . mysql_error());
                }
               
                echo "Paciente $nome cadastrado com sucesso ";
                /*$inserir = mysql_query("insert into admin('login') values('$nome')");
                if($inserir == true){
                        echo "Nao existe registro entao foi criado um com o seguinte nome ".$nome."";
                }*/
           }
          /* else{   
               //update
                $update = mysql_query("update admin set 'login' = '$login'");
                if($update == true){
                        echo "Ja existia registro por tanto foi feito update";
                }
           }*/
        }//for
       /* 
        $select = "INSERT INTO `paciente` (`cod_paciente`,`nome`, `cpf`, `cns`, `nro_prontuario`,`data_nascimento`, `idade`, `sexo`,
                `gestante`, `mae`, `etnia`, `endereco`, `telefone`, `cidade`,`estado`, `escolaridade`, `tipo_ocupacao`,
                `ocupacao`, `observacoes`, `nro_fie`, `naturalidade`, `nro_hygia`, `cep`, `data_hora` )
        VALUES ('$cod_paciente','$nome', '$cpf','$cns', '$nro_prontuario', 
                '$data_nascimento', '$idade', '$sexo', '$gestante', '$mae','$etnia',
                '$endereco', '$telefone', '$cidade', '$estado', '$escolaridade', '$tipo_ocupacao',
                '$ocupacao', '$observacoes', '$nro_fie', '$naturalidade', '$nro_hygia', '$cep', '$data_hora' )";

        
        if (!mysql_query($select, $con)) {
            die('Error: ' . mysql_error());
        }
        
        */
    
    }
    
    
    
    
    //*******************************************
    
     if ($tipo==4){ 
       
        $arquivo = fopen('tratamentot.json','r');
        $string = file_get_contents('tratamentot.json');
        //echo $string;
        fclose($arquivo);       
        $arrt = json_decode($string, true);
        $st=0;  
        $st=count($arrt);
        
       // echo $string;
       
    
        for($i=0;$i<$st;$i++){

           
           $outra_unidade_recebe = $arrt[$i]["outra_unidade_recebe"];
           $outra_unidade = $arrt[$i]["outra_unidade"];
           $encerrado = $arrt[$i]["encerrado"];
           $data_rx_outro = $arrt[$i]["data_rx_outro"];
           $cod_tratamento = $arrt[$i]["cod_tratamento"];
           $observacoest = $arrt[$i]["observacoes"];
           $anti_hiv = $arrt[$i]["anti_hiv"];
           $pirazinamida = $arrt[$i]["pirazinamida"];
           $resultado_cultura_outro = $arrt[$i]["resultado_cultura_outro"];
           $resultado_outro = $arrt[$i]["resultado_outro"];
           $resultado_escarro = $arrt[$i]["resultado_escarro"];
           $izoniazida = $arrt[$i]["izoniazida"];
           $outros = $arrt[$i]["outros"];
           $data_notificacao = $arrt[$i]["data_notificacao"];
           $cod_paciente = $arrt[$i]["cod_paciente"];
           $etambutol = $arrt[$i]["etambutol"];
           $cod_profissional = $arrt[$i]["cod_profissional"];
           $resultado_cultura_escarro = $arrt[$i]["resultado_cultura_escarro"];
           $tempo_inicio_sintomas = $arrt[$i]["tempo_inicio_sintomas"];
           $tratamento_anterior = $arrt[$i]["tratamento_anterior"];
            $rifampicina = $arrt[$i]["rifampicina"];
           $un_notificante = $arrt[$i]["un_notificante"];
           $resultado_rx_outro = $arrt[$i]["resultado_rx_outro"];
           $doenca_associada3 = $arrt[$i]["doenca_associada3"];
           $doenca_associada1 = $arrt[$i]["doenca_associada1"];
           $data_necropsia = $arrt[$i]["data_necropsia"];
           $doenca_associada2 = $arrt[$i]["doenca_associada2"];
           $outro_profissonal = $arrt[$i]["outro_profissonal"];
           $data_cultura_outro = $arrt[$i]["data_cultura_outro"];
           $resultado_outros = $arrt[$i]["resultado_outros"];
           $forma_clinica3 = $arrt[$i]["forma_clinica3"];
           $data_outros = $arrt[$i]["data_outros"];
            $forma_clinica1 = $arrt[$i]["forma_clinica1"];
           $tipo_descoberta = $arrt[$i]["tipo_descoberta"];
           $forma_clinica2 = $arrt[$i]["forma_clinica2"];
           $recebido = $arrt[$i]["recebido"];
           $data_cultura_escarro = $arrt[$i]["data_cultura_escarro"];
           $tempo_tratamento_anterior = $arrt[$i]["tempo_tratamento_anterior"];
            $data_tratamento_atual = $arrt[$i]["data_tratamento_atual"];
           $un_atendimento = $arrt[$i]["un_atendimento"];
           $resultado_histopatologico = $arrt[$i]["resultado_histopatologico"];
           $data_alta_tratamento = $arrt[$i]["data_alta_tratamento"];
           $resultado_rx_torax = $arrt[$i]["resultado_rx_torax"];
            $resultado_necropsia = $arrt[$i]["resultado_necropsia"];
           $data_escarro = $arrt[$i]["data_escarro"];
           $servico_descobriu = $arrt[$i]["servico_descobriu"];
           $data_outro = $arrt[$i]["data_outro"];
           $droga_tratamento = $arrt[$i]["droga_tratamento"];
           $data_histopatologico = $arrt[$i]["data_histopatologico"];
            $tipo_tratamento_atual = $arrt[$i]["tipo_tratamento_atual"];
           $etionamida = $arrt[$i]["etionamida"];
           $motivo_alta = $arrt[$i]["motivo_alta"];
           $estreptomicina = $arrt[$i]["estreptomicina"];
           $data_rx_torax = $arrt[$i]["data_rx_torax"];
           
           
            
          /* echo ("$cod_paciente,$nome, $cpf,$cns, $nro_prontuario, 
                $data_nascimento, $idade, $sexo, $gestante, $mae,$etnia,
                $endereco, $telefone, $cidade, $estado, $escolaridade, $tipo_ocupacao,
                $ocupacao, $observacoes, $nro_fie, $naturalidade, $nro_hygia, $cep, $data_hora"); 
         */
           //***colocar a data de nascimento no select abaixo, verificar como ela está sendo enviada no json
           //ideia colocar um campo "tipo" no mobile, se tipo=editado precisa fazer um update olhando todos os campos, se tipo=novo cadastra o paciente, caso contrario nao fazer update (ou nem coloca no arquivo)
            
           $procura = mysql_query("select * from paciente where nome = '$nome' and mae= '$mae'");
           $contar = mysql_num_rows($procura);
           
           if($contar == 0){
                //faz o insert caso o paciente não esteja cadastrado
               
               $select = "INSERT INTO `paciente` (`cod_paciente`,`nome`, `cpf`, `cns`, `nro_prontuario`,`data_nascimento`, `idade`, `sexo`,
                `gestante`, `mae`, `etnia`, `endereco`, `telefone`, `cidade`,`estado`, `escolaridade`, `tipo_ocupacao`,
                `ocupacao`, `observacoes`, `nro_fie`, `naturalidade`, `nro_hygia`, `cep`, `data_hora` )
                VALUES (NULL,'$nome', '$cpf','$cns', '$nro_prontuario', 
                '$data_nascimento', '$idade', '$sexo', '$gestante', '$mae','$etnia',
                '$endereco', '$telefone', '$cidade', '$estado', '$escolaridade', '$tipo_ocupacao',
                '$ocupacao', '$observacoes', '$nro_fie', '$naturalidade', '$nro_hygia', '$cep', '$data_hora' )";
                       
                if (!mysql_query($select, $con)) {
                    die('Error: ' . mysql_error());
                }
               
                echo "Paciente $nome cadastrado com sucesso ";
                /*$inserir = mysql_query("insert into admin('login') values('$nome')");
                if($inserir == true){
                        echo "Nao existe registro entao foi criado um com o seguinte nome ".$nome."";
                }*/
           }
          /* else{   
               //update
                $update = mysql_query("update admin set 'login' = '$login'");
                if($update == true){
                        echo "Ja existia registro por tanto foi feito update";
                }
           }*/
        }//for
       /* 
        $select = "INSERT INTO `paciente` (`cod_paciente`,`nome`, `cpf`, `cns`, `nro_prontuario`,`data_nascimento`, `idade`, `sexo`,
                `gestante`, `mae`, `etnia`, `endereco`, `telefone`, `cidade`,`estado`, `escolaridade`, `tipo_ocupacao`,
                `ocupacao`, `observacoes`, `nro_fie`, `naturalidade`, `nro_hygia`, `cep`, `data_hora` )
        VALUES ('$cod_paciente','$nome', '$cpf','$cns', '$nro_prontuario', 
                '$data_nascimento', '$idade', '$sexo', '$gestante', '$mae','$etnia',
                '$endereco', '$telefone', '$cidade', '$estado', '$escolaridade', '$tipo_ocupacao',
                '$ocupacao', '$observacoes', '$nro_fie', '$naturalidade', '$nro_hygia', '$cep', '$data_hora' )";

        
        if (!mysql_query($select, $con)) {
            die('Error: ' . mysql_error());
        }
        
        */
    
    }
    
    //*********************************************    
    
    
    echo "Importação realizada com sucesso";
    mysql_close($con);
    
?>
                                    