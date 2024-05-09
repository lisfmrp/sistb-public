 <?php		
require("autenticacao.php");

if(isset($_GET["token"])) {
	if(!empty($_GET["codTratamento"])) {
		$cod_tratamento = $_GET["codTratamento"];
		
		$sql = "SELECT comparecimento, data_supervisionamento, observacoes FROM supervisionamento WHERE cod_tratamento = $cod_tratamento ORDER BY data_supervisionamento ASC";
		$result = $db->selectQuery($sql);							
	} else {
		die("Informe um parâmetro válido");
	}		
}
?>								

<html>
<head></head>
<body>
<?php foreach ($result as $row) { ?>
<div style="" itemscope="" itemtype="http://sistb-dev.ddns.net/d2rq/vocab/Supervisionamento">
	<p>			
		<span itemprop="tipo_supervisionamento"><?=$row["comparecimento"]?></span> -
		<span itemprop="data_supervisionamento"><?=$row["data_supervisionamento"]?></span> -
		<span itemprop="supervisionamento_observacoes"><?=$row["observacoes"]?></span>
	</p>
</div>
<?php } ?>		
</body>
</html>