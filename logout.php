<?php
session_start();
use Uteis\banco as banco;
require_once 'classes/banco.php';
require_once 'functions.php';
$db = banco::connectToTB();
insertLog(2,$_SESSION["cod_profissional"],$db);
$db->endConnection();
unset($_SESSION['nome']);
unset($_SESSION['login']);
unset($_SESSION["cod_profissional"]);
unset($_SESSION["conselho"]);
unset($_SESSION["cod_unidade"]);
unset($_SESSION["nome_unidade"]);
session_destroy();
header( 'location: ./',true);
?>