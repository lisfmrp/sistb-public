<?php

session_start(); //iniciamos a sess�o
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
        $data_comparecimento = implode("-", array_reverse(explode("/", $data_comparecimento))); //revertemos a data para inser��o no banco
    }
    
    if (isset($_POST["data_comparecimento2"])) {
        $data_comparecimento2 = $_POST["data_comparecimento2"];
        $data_comparecimento2 = implode("-", array_reverse(explode("/", $data_comparecimento2))); //revertemos a data para inser��o no banco
    }
    
    if (isset($_POST["data_comparecimento3"])) {
        $data_comparecimento3 = $_POST["data_comparecimento3"];
        $data_comparecimento3 = implode("-", array_reverse(explode("/", $data_comparecimento3))); //revertemos a data para inser��o no banco
    }
    
    if (isset($_POST["data_comparecimento4"])) {
        $data_comparecimento4 = $_POST["data_comparecimento4"];
        $data_comparecimento4 = implode("-", array_reverse(explode("/", $data_comparecimento4))); //revertemos a data para inser��o no banco
    }
    
    if (isset($_POST["data_comparecimento5"])) {
        $data_comparecimento5 = $_POST["data_comparecimento5"];
        $data_comparecimento5 = implode("-", array_reverse(explode("/", $data_comparecimento5))); //revertemos a data para inser��o no banco
    }
    
    if (isset($_POST["data_comparecimento6"])) {
        $data_comparecimento6 = $_POST["data_comparecimento6"];
        $data_comparecimento6 = implode("-", array_reverse(explode("/", $data_comparecimento6))); //revertemos a data para inser��o no banco
    }
    
    if (isset($_POST["data_comparecimento7"])) {
        $data_comparecimento7 = $_POST["data_comparecimento7"];
        $data_comparecimento7 = implode("-", array_reverse(explode("/", $data_comparecimento7))); //revertemos a data para inser��o no banco
    }
    
    if (isset($_POST["data_comparecimento8"])) {
        $data_comparecimento8 = $_POST["data_comparecimento8"];
        $data_comparecimento8 = implode("-", array_reverse(explode("/", $data_comparecimento8))); //revertemos a data para inser��o no banco
    }
    
    if (isset($_POST["data_comparecimento9"])) {
        $data_comparecimento9 = $_POST["data_comparecimento9"];
        $data_comparecimento9 = implode("-", array_reverse(explode("/", $data_comparecimento9))); //revertemos a data para inser��o no banco
    }
    
    if (isset($_POST["data_comparecimento10"])) {
        $data_comparecimento10 = $_POST["data_comparecimento10"];
        $data_comparecimento10 = implode("-", array_reverse(explode("/", $data_comparecimento10))); //revertemos a data para inser��o no banco
    }
    
    if (isset($_POST["data_comparecimento11"])) {
        $data_comparecimento11 = $_POST["data_comparecimento11"];
        $data_comparecimento11 = implode("-", array_reverse(explode("/", $data_comparecimento11))); //revertemos a data para inser��o no banco
    }
    
    if (isset($_POST["data_comparecimento12"])) {
        $data_comparecimento12 = $_POST["data_comparecimento12"];
        $data_comparecimento12 = implode("-", array_reverse(explode("/", $data_comparecimento12))); //revertemos a data para inser��o no banco
    }
    
    if (isset($_POST["data_comparecimento13"])) {
        $data_comparecimento13 = $_POST["data_comparecimento13"];
        $data_comparecimento13 = implode("-", array_reverse(explode("/", $data_comparecimento13))); //revertemos a data para inser��o no banco
    }
    
    if (isset($_POST["data_comparecimento14"])) {
        $data_comparecimento14 = $_POST["data_comparecimento14"];
        $data_comparecimento14 = implode("-", array_reverse(explode("/", $data_comparecimento14))); //revertemos a data para inser��o no banco
    }
    if (isset($_POST["data_comparecimento15"])) {
        $data_comparecimento15 = $_POST["data_comparecimento15"];
        $data_comparecimento15 = implode("-", array_reverse(explode("/", $data_comparecimento15))); //revertemos a data para inser��o no banco
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
    
        
        $select6 = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento6', '$_POST[comparecimento6]', '$_POST[observacoes]')";
    
        
        $select7 = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento7', '$_POST[comparecimento7]', '$_POST[observacoes]')";
    
        
        $select8 = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento8', '$_POST[comparecimento8]', '$_POST[observacoes]')";
    
        
        $select9 = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento9', '$_POST[comparecimento9]', '$_POST[observacoes]')";
    
        
        $select10 = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento10', '$_POST[comparecimento10]', '$_POST[observacoes]')";
    
        
        $select11 = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento11', '$_POST[comparecimento11]', '$_POST[observacoes]')";
    
        
        $select12 = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento12', '$_POST[comparecimento12]', '$_POST[observacoes]')";
    
        
        $select13 = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento13', '$_POST[comparecimento13]', '$_POST[observacoes]')";
    
        
        $select14 = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento14', '$_POST[comparecimento14]', '$_POST[observacoes]')";
    
        
        $select15 = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento15', '$_POST[comparecimento15]', '$_POST[observacoes]')";
    
        
        
        
        
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
    }if (!mysql_query($select6, $con)) {
        die('Error: ' . mysql_error());
    }if (!mysql_query($select7, $con)) {
        die('Error: ' . mysql_error());
    }if (!mysql_query($select8, $con)) {
        die('Error: ' . mysql_error());
    }if (!mysql_query($select9, $con)) {
        die('Error: ' . mysql_error());
    }
    if (!mysql_query($select10, $con)) {
        die('Error: ' . mysql_error());
    }
    if (!mysql_query($select11, $con)) {
        die('Error: ' . mysql_error());
    }
    if (!mysql_query($select12, $con)) {
        die('Error: ' . mysql_error());
    }if (!mysql_query($select13, $con)) {
        die('Error: ' . mysql_error());
    }
    if (!mysql_query($select14, $con)) {
        die('Error: ' . mysql_error());
    }if (!mysql_query($select15, $con)) {
        die('Error: ' . mysql_error());
    }
    
    
    
    
    
    
    

    $op2 = "INSERT INTO `tuberculose`.`atualizacao` (`cod_atualizacao`, `tipo_atualizacao`, `numero_atualizacao`, `usuario`, `data_hora`)
        VALUES (NULL, ' Cadastrou uma supervisionamento ', NULL, '$_SESSION[nome]', CURRENT_TIMESTAMP)";


    if (!mysql_query($op2, $con)) {
        die('Error: ' . mysql_error());
    }

    echo "Opera��o realizada com sucesso!";
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='3; URL=index.php?acao=dash+menu'>";



    //<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?acao=paciente+buscar">
}
mysql_close($con);
?>