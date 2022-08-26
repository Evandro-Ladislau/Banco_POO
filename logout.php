<?php
require_once 'config.php';

unset($_SESSION['id'], 
$_SESSION['nome'],
$_SESSION['email'],
$_SESSION['telefone'],
$_SESSION['logradouro'],
$_SESSION['numero'],
$_SESSION[ 'cidade'],
$_SESSION['bairro'],
$_SESSION['cep'],
$_SESSION['senha'],
$_SESSION['conf_senha'],
);

$_SESSION['msg'] = "<div class='alert alert-danger'> Deslogado com Sucesso! </div>";
$url_destino = $base.'/login.php';
header("Location: $url_destino");

