<?php
require_once 'conta.php';
require_once 'usuario.php';
include_once 'config.php';
include_once 'include\head.php';require_once 'conta.php';
require_once 'usuario.php';
include_once 'config.php';
include_once 'include\head.php';

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
        $_SESSION['msg'] = "Você Não tem conta Aberta!";
        $url_destino = $base.'/home.php';
        header("Location: $url_destino");
}





$SendTransacao = filter_input(INPUT_POST, 'SendTransacao');

if ($SendTransacao) {

    $transacao_id = filter_input(INPUT_POST, 'id');
    $transacao_valor = filter_input(INPUT_POST, 'valor');

    switch ($transacao_id) {
        case 1:
            $_SESSION['msg'] = $conta_usuario_logado->Depositar($transacao_valor);
            $conta_usuario_logado->CadastrarConta();
            break;

        case 2:
            $reuslt_sacar = $conta_usuario_logado->Sacar($transacao_valor);
            if ($reuslt_sacar == false) {
                $_SESSION['msg'] = "Você não tem saldo suficiente! ";
            } else {

                $conta_usuario_logado->CadastrarConta();
                $_SESSION['msg'] = "Saque de R$" . number_format($transacao_valor, 2, ',', ' ') . " Efetuado com Sucesso!" . "<br>";
            }
            break;

        case 3:
            $result_fechar_conta = $conta_usuario_logado->FecharConta();
            if ($result_fechar_conta) {
                $_SESSION['msg'] = "Conta Fechada com Sucesso!";
            } else {
                $_SESSION['msg'] = "Retire o dinheiro antes de fechar a conta!";
            }
            break;
        default:
            $_SESSION['msg'] = "Nenhuma das opções são válidas, por favor entre em contato com o SAC!";
            break;
    }

    $url_destino = $base.'/movimentacao.php';
    header("Location: $url_destino");

}else{
    $_SESSION['msg'] = "Você Não tem conta Aberta!";
    $url_destino = $base.'/home.php';
    header("Location: $url_destino");
}
