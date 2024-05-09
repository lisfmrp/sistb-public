<?php

session_start(); //iniciamos a sessão
date_default_timezone_set('America/Sao_Paulo');
$data = date("dmY");



$con = mysql_connect("localhost", "tuberculose", "senha");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("tuberculose", $con);



if (isset($_POST)) {


    if (isset($_POST["data_comparecimento"])) {
        $data_comparecimento = $_POST["data_comparecimento"];
        $data_comparecimento = implode("-", array_reverse(explode("/", $data_comparecimento))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento2"])) {
        $data_comparecimento2 = $_POST["data_comparecimento2"];
        $data_comparecimento2 = implode("-", array_reverse(explode("/", $data_comparecimento2))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento3"])) {
        $data_comparecimento3 = $_POST["data_comparecimento3"];
        $data_comparecimento3 = implode("-", array_reverse(explode("/", $data_comparecimento3))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento4"])) {
        $data_comparecimento4 = $_POST["data_comparecimento4"];
        $data_comparecimento4 = implode("-", array_reverse(explode("/", $data_comparecimento4))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento5"])) {
        $data_comparecimento5 = $_POST["data_comparecimento5"];
        $data_comparecimento5 = implode("-", array_reverse(explode("/", $data_comparecimento5))); //revertemos a data para inserção no banco
    }
    
  
    

    $sql = "SELECT cod_tratamento FROM tratamento WHERE cod_paciente = '$_POST[cod_paciente]' AND tratamento.encerrado = 0";
    $querysql = @mysql_query($sql) or die(mysql_error());
    $lsql = mysql_fetch_array($querysql);
    $cod_tratamento = ucfirst($lsql[0]);


    if ($_POST["cod_unidade"] != "" && $_POST["cod_unidade"] != NULL) {

        $select = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento', '$_POST[comparecimento]', '$_POST[observacoes]')";
    
        
        $select2 = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento2', '$_POST[comparecimento2]', '$_POST[observacoes]')";
    
        
        $select3 = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento3', '$_POST[comparecimento3]', '$_POST[observacoes]')";
    
        
        $select4 = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento4', '$_POST[comparecimento4]', '$_POST[observacoes]')";
    
        
        $select5 = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento5', '$_POST[comparecimento5]', '$_POST[observacoes]')";
    
        
             
        
        
    } else {
        $select = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]','$cod_tratamento', '$data_comparecimento', '$_POST[comparecimento]', '$_POST[observacoes]')";
    }

//ver como vai salvar o codigo do paciente, prof, unidade, trat, ******************************


    if (!mysql_query($select, $con)) {
        die('Error: ' . mysql_error());
    }
    if (!mysql_query($select2, $con)) {
        die('Error: ' . mysql_error());
    }
    if (!mysql_query($select3, $con)) {
        die('Error: ' . mysql_error());
    }
    if (!mysql_query($select4, $con)) {
        die('Error: ' . mysql_error());
    }if (!mysql_query($select5, $con)) {
        die('Error: ' . mysql_error());
    }
    
    
    
    

    $op2 = "INSERT INTO `tuberculose`.`atualizacao` (`cod_atualizacao`, `tipo_atualizacao`, `numero_atualizacao`, `usuario`, `data_hora`)
        VALUES (NULL, ' Cadastrou um supervisionamento ', NULL, '$_SESSION[nome]', CURRENT_TIMESTAMP)";


    if (!mysql_query($op2, $con)) {
        die('Error: ' . mysql_error());
    }

    echo "Operação realizada com sucesso!";
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='3; URL=index.php?acao=dash+menu'>";



    //<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?acao=paciente+buscar">
}
mysql_close($con);
?>