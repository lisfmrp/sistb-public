<?php

function insertLog($codTipoLog,$codProfissional,$db) {
	$sql = "INSERT INTO `log` (`cod_log_tipo`, `cod_profissional`) VALUES ($codTipoLog,$codProfissional);";
	$db->insertQuery($sql);
}

?>