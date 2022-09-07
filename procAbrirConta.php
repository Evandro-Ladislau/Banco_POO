<?php
session_start(); //incializando a sessão.
ob_start();
require_once 'config.php';
require_once 'conta.php';
require_once 'conexao.php';


$SendAbrirConta = filter_input(INPUT_POST, 'SendAbrirConta');

if($SendAbrirConta){
    $result_conta = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if ($result_conta['deposito'] > 0) {

        $nova_conta = new Conta($result_conta['id'], 
        $_SESSION['id'],
         password_hash($result_conta['senha'], PASSWORD_DEFAULT),
         $result_conta['deposito']
         );

        $conta_ativa = $nova_conta->BuscarContas($_SESSION['id']);

        if($conta_ativa){
        $_SESSION['msg'] = "<div class='alert alert-danger' Você já possiu conta ativa! </div>";
        $url_destino = $base.'/home.php';
        header("Location: $url_destino");

        }else{

        $result_cadastro_conta = $nova_conta->CadastrarConta(1);
        
        $_SESSION['msg'] = "<div class='alert alert-success'> A conta foi criada com sucesso!</div>";
        $url_destino = $base.'/movimentacao.php';
        header("Location: $url_destino");
        }
    
    }else{
        $_SESSION['msg'] = "<div class='alert alert-danger'> Informe um valor de deposito para abrir conta!</did>";
        $url_destino = $base.'/home.php';
        header("Location: $url_destino");
    }

}