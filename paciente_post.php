<?php
require_once("autenticacao.php");
if (isset($_POST) && $_SESSION["escrita"] == 1) {
	$data_nascimento = "NULL";
    if (isset($_POST["data_nascimento"]) && !empty($_POST["data_nascimento"])) {
        $data_nascimento = "'".implode("-", array_reverse(explode("/", $_POST["data_nascimento"])))."'";
    }    
	if (!isset($_POST["cod_paciente"])) { //INSERIR
		$tipoLog = 4;
		$sql = "INSERT INTO `paciente` (`nome`, `cpf`, `cns`, `nro_prontuario`,`data_nascimento`, `idade`, `sexo`,
					`gestante`, `mae`, `etnia`, `endereco`, `telefone`, `cidade`,`estado`, `escolaridade`, `cod_tipo_ocupacao`,
					`ocupacao`, `observacoesp`, `naturalidade`, `nro_hygia`, `cep`, `sinan`)
			VALUES (UPPER('$_POST[nome]'), '$_POST[cpf]','$_POST[cns]', '$_POST[nro_prontuario]', 
					$data_nascimento, '$_POST[idade]', '$_POST[sexo]', '$_POST[gestante]', UPPER('$_POST[mae]'),'$_POST[etnia]',
					'$_POST[endereco]', '$_POST[telefone]', '$_POST[cidade]', '$_POST[estado]', '$_POST[escolaridade]', '$_POST[tipo_ocupacao]',
					'$_POST[ocupacao]', '$_POST[observacoes]', '$_POST[naturalidade]', '$_POST[nro_hygia]', '$_POST[cep]', '$_POST[sinan]')";
		//echo $sql."<br/><br/><br/><br/>";
		$result = $db->insertQuery(utf8_decode($sql));
		$cod = $db->lastInsertedId();
	} else { //ATUALIZAR
		$tipoLog = 15;
		$cod = $_POST["cod_paciente"];
		$sql = "UPDATE `paciente` SET 
					`nome` = '$_POST[nome]',
					`cpf` = '$_POST[cpf]',
					`cns` = '$_POST[cns]', 
					`nro_prontuario` =  '$_POST[nro_prontuario]', 
					`data_nascimento` = $data_nascimento,
					`idade` = '$_POST[idade]', 
					`sexo` = '$_POST[sexo]',
					`gestante` = '$_POST[gestante]',
					`mae` = '$_POST[mae]',
					`etnia` =  '$_POST[etnia]',
					`endereco` =  '$_POST[endereco]',
					`telefone` = '$_POST[telefone]',
					`cidade` = '$_POST[cidade]',
					`estado` =  '$_POST[estado]',
					`escolaridade` =  '$_POST[escolaridade]',
					`cod_tipo_ocupacao` = '$_POST[tipo_ocupacao]',
					`ocupacao` = '$_POST[ocupacao]',  
					`observacoesp` = '$_POST[observacoes]',
					`sinan` = '$_POST[sinan]', 
					`naturalidade` = '$_POST[naturalidade]',
					`nro_hygia` = '$_POST[nro_hygia]'  
			WHERE `paciente`.`cod_paciente` =  $cod";
		$result = $db->updateQuery(utf8_decode($sql));
	}        	
	$redirectTo = "acao=paciente_form&cod_paciente=$cod";
	if ($result && $db->error() == "") {
		$sql = "INSERT INTO `log` (`cod_log_tipo`,`cod_profissional`,`cod_item`) VALUES ($tipoLog,$_SESSION[cod_profissional],$cod);";
		$db->insertQuery($sql);	
		header("Location: index.php?acao=msg&t=ok&m=".base64_encode("Operação realizada com sucesso!")."&r=".base64_encode($redirectTo));
	} else {
		header("Location: index.php?acao=msg&t=erro&m=".base64_encode("Erro ao registrar/editar o Paciente")."&r=".base64_encode($redirectTo));
	} 
} else {
	header("Location: index.php?acao=msg&t=erro&m=".base64_encode("Acesso negado!"));
}
?>