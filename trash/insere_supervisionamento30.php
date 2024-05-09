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
    
    if (isset($_POST["data_comparecimento6"])) {
        $data_comparecimento6 = $_POST["data_comparecimento6"];
        $data_comparecimento6 = implode("-", array_reverse(explode("/", $data_comparecimento6))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento7"])) {
        $data_comparecimento7 = $_POST["data_comparecimento7"];
        $data_comparecimento7 = implode("-", array_reverse(explode("/", $data_comparecimento7))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento8"])) {
        $data_comparecimento8 = $_POST["data_comparecimento8"];
        $data_comparecimento8 = implode("-", array_reverse(explode("/", $data_comparecimento8))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento9"])) {
        $data_comparecimento9 = $_POST["data_comparecimento9"];
        $data_comparecimento9 = implode("-", array_reverse(explode("/", $data_comparecimento9))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento10"])) {
        $data_comparecimento10 = $_POST["data_comparecimento10"];
        $data_comparecimento10 = implode("-", array_reverse(explode("/", $data_comparecimento10))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento11"])) {
        $data_comparecimento11 = $_POST["data_comparecimento11"];
        $data_comparecimento11 = implode("-", array_reverse(explode("/", $data_comparecimento11))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento12"])) {
        $data_comparecimento12 = $_POST["data_comparecimento12"];
        $data_comparecimento12 = implode("-", array_reverse(explode("/", $data_comparecimento12))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento13"])) {
        $data_comparecimento13 = $_POST["data_comparecimento13"];
        $data_comparecimento13 = implode("-", array_reverse(explode("/", $data_comparecimento13))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento14"])) {
        $data_comparecimento14 = $_POST["data_comparecimento14"];
        $data_comparecimento14 = implode("-", array_reverse(explode("/", $data_comparecimento14))); //revertemos a data para inserção no banco
    }
    if (isset($_POST["data_comparecimento15"])) {
        $data_comparecimento15 = $_POST["data_comparecimento15"];
        $data_comparecimento15 = implode("-", array_reverse(explode("/", $data_comparecimento15))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento16"])) {
        $data_comparecimento16 = $_POST["data_comparecimento16"];
        $data_comparecimento16 = implode("-", array_reverse(explode("/", $data_comparecimento16))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento17"])) {
        $data_comparecimento17 = $_POST["data_comparecimento17"];
        $data_comparecimento17 = implode("-", array_reverse(explode("/", $data_comparecimento17))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento18"])) {
        $data_comparecimento18 = $_POST["data_comparecimento18"];
        $data_comparecimento18 = implode("-", array_reverse(explode("/", $data_comparecimento18))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento19"])) {
        $data_comparecimento19 = $_POST["data_comparecimento19"];
        $data_comparecimento19 = implode("-", array_reverse(explode("/", $data_comparecimento19))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento20"])) {
        $data_comparecimento20 = $_POST["data_comparecimento20"];
        $data_comparecimento20 = implode("-", array_reverse(explode("/", $data_comparecimento20))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento21"])) {
        $data_comparecimento21= $_POST["data_comparecimento21"];
        $data_comparecimento21= implode("-", array_reverse(explode("/", $data_comparecimento21))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento22"])) {
        $data_comparecimento22= $_POST["data_comparecimento22"];
        $data_comparecimento22= implode("-", array_reverse(explode("/", $data_comparecimento22))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento23"])) {
        $data_comparecimento23 = $_POST["data_comparecimento23"];
        $data_comparecimento23 = implode("-", array_reverse(explode("/", $data_comparecimento23))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento24"])) {
        $data_comparecimento24 = $_POST["data_comparecimento24"];
        $data_comparecimento24 = implode("-", array_reverse(explode("/", $data_comparecimento24))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento25"])) {
        $data_comparecimento25 = $_POST["data_comparecimento25"];
        $data_comparecimento25 = implode("-", array_reverse(explode("/", $data_comparecimento25))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento26"])) {
        $data_comparecimento26 = $_POST["data_comparecimento26"];
        $data_comparecimento26 = implode("-", array_reverse(explode("/", $data_comparecimento26))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento27"])) {
        $data_comparecimento27 = $_POST["data_comparecimento27"];
        $data_comparecimento27 = implode("-", array_reverse(explode("/", $data_comparecimento27))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento28"])) {
        $data_comparecimento28 = $_POST["data_comparecimento28"];
        $data_comparecimento28 = implode("-", array_reverse(explode("/", $data_comparecimento28))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_comparecimento29"])) {
        $data_comparecimento29 = $_POST["data_comparecimento29"];
        $data_comparecimento29 = implode("-", array_reverse(explode("/", $data_comparecimento29))); //revertemos a data para inserção no banco
    }
    if (isset($_POST["data_comparecimento30"])) {
        $data_comparecimento30 = $_POST["data_comparecimento30"];
        $data_comparecimento30 = implode("-", array_reverse(explode("/", $data_comparecimento30))); //revertemos a data para inserção no banco
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
    
        
        $select16 = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento16', '$_POST[comparecimento16]', '$_POST[observacoes]')";
    
        
        $select17= "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento17', '$_POST[comparecimento17]', '$_POST[observacoes]')";
    
        
        $select18= "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento18', '$_POST[comparecimento18]', '$_POST[observacoes]')";
    
        
        $select19= "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento19', '$_POST[comparecimento19]', '$_POST[observacoes]')";
    
        
        $select20= "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento20', '$_POST[comparecimento20]', '$_POST[observacoes]')";
    
        
        $select21= "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento21', '$_POST[comparecimento21]', '$_POST[observacoes]')";
    
        
        $select22= "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento22', '$_POST[comparecimento22]', '$_POST[observacoes]')";
    
        
        $select23= "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento23', '$_POST[comparecimento23]', '$_POST[observacoes]')";
    
        
        $select24= "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento24', '$_POST[comparecimento24]', '$_POST[observacoes]')";
    
        
        $select25 = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento25', '$_POST[comparecimento25]', '$_POST[observacoes]')";
    
        
        $select26 = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento26', '$_POST[comparecimento26]', '$_POST[observacoes]')";
    
        
        $select27 = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento27', '$_POST[comparecimento27]', '$_POST[observacoes]')";
    
        
        $select28 = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento28', '$_POST[comparecimento28]', '$_POST[observacoes]')";
    
        
        $select29 = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento29', '$_POST[comparecimento29]', '$_POST[observacoes]')";
    
        
        $select30 = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
                `data_supervisionamento`, `comparecimento`, `observacoes`)
    VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento30', '$_POST[comparecimento30]', '$_POST[observacoes]')";
    
        
        
        
        
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
    
    
    
    
    if (!mysql_query($select16, $con)) {
        die('Error: ' . mysql_error());
    }
    if (!mysql_query($select17, $con)) {
        die('Error: ' . mysql_error());
    }
    if (!mysql_query($select18, $con)) {
        die('Error: ' . mysql_error());
    }
    if (!mysql_query($select19, $con)) {
        die('Error: ' . mysql_error());
    }if (!mysql_query($select20, $con)) {
        die('Error: ' . mysql_error());
    }if (!mysql_query($select21, $con)) {
        die('Error: ' . mysql_error());
    }if (!mysql_query($select22, $con)) {
        die('Error: ' . mysql_error());
    }if (!mysql_query($select23, $con)) {
        die('Error: ' . mysql_error());
    }if (!mysql_query($select24, $con)) {
        die('Error: ' . mysql_error());
    }
    if (!mysql_query($select25, $con)) {
        die('Error: ' . mysql_error());
    }
    if (!mysql_query($select26, $con)) {
        die('Error: ' . mysql_error());
    }
    if (!mysql_query($select27, $con)) {
        die('Error: ' . mysql_error());
    }if (!mysql_query($select28, $con)) {
        die('Error: ' . mysql_error());
    }
    if (!mysql_query($select29, $con)) {
        die('Error: ' . mysql_error());
    }if (!mysql_query($select30, $con)) {
        die('Error: ' . mysql_error());
    }
    
    
    
    
    
    

    $op2 = "INSERT INTO `tuberculose`.`atualizacao` (`cod_atualizacao`, `tipo_atualizacao`, `numero_atualizacao`, `usuario`, `data_hora`)
        VALUES (NULL, ' Cadastrou uma supervisionamento ', NULL, '$_SESSION[nome]', CURRENT_TIMESTAMP)";


    if (!mysql_query($op2, $con)) {
        die('Error: ' . mysql_error());
    }

    echo "Operação realizada com sucesso!";
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='3; URL=index.php?acao=dash+menu'>";



    //<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?acao=paciente+buscar">
}
mysql_close($con);
?>