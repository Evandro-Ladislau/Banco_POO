<?php

require_once "config.php";
require_once 'usuario.php';
require_once 'conta.php';


$usuario_logado = new Usuario(
    $_SESSION['nome'],
    $_SESSION['email'],
    $_SESSION['telefone'],
    $_SESSION['logradouro'],
    $_SESSION['numero'],
    $_SESSION['cidade'],
    $_SESSION['bairro'],
    $_SESSION['cep'],
    $_SESSION['senha'],
    $_SESSION['conf_senha']
);
$usuario_logado->setId($_SESSION['id']);

$result_conta = $usuario_logado->AcessarConta($usuario_logado->getId());


if($result_conta){

    foreach($result_conta as $value) {

        $result_conta_usuario = $value;
    }

    
    $conta_usuario_logado = new Conta($result_conta_usuario['empresa_id'],
                                  $result_conta_usuario['usuario_id'],
                                  $result_conta_usuario['senha'],
                                  $result_conta_usuario['saldo']
                                    );
    
}else{
        $_SESSION['msg'] = "<div class='alert alert-danger'> Você Não tem conta Aberta! </div>";
        $url_destino = $base.'/home.php';
        header("Location: $url_destino");
}

$fechar_conta = $conta_usuario_logado->FecharConta($usuario_logado->getId());

if (!$fechar_conta) {
        
        $_SESSION['msg'] = "<div class='alert alert-danger'> Você precisa sacar o saldo antes de fechar a conta! </div>";
        $url_destino = $base.'/movimentacao.php';
        header("Location: $url_destino");

}else{
    $_SESSION['msg'] = "<div class='alert alert-danger'> Conta Fechada com sucesso! </div>";
        $url_destino = $base.'/logout.php';
        header("Location: $url_destino");
}

