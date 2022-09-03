<?php
require_once 'config.php';
require_once 'conexao.php';
require_once 'usuario.php';

$SendLogin = filter_input(INPUT_POST, 'SendLogin');
if($SendLogin){

    $email = filter_input(INPUT_POST, 'email');
    $email_usuario = str_ireplace(" ", "", $email);

    $senha = filter_input(INPUT_POST, 'senha');
    $senha_usuario = str_ireplace(" ", "", $senha);

    $conn = new Conexao();
    $dados_usuario = $conn->LogarUsuario($email_usuario);

    foreach ($dados_usuario as $value) {
        $dados_usuario_login = $value;
    }
    
    if (password_verify($senha, $dados_usuario_login['senha'])) {

        $usuario_logado = new Usuario($dados_usuario_login['nome'], 
        $dados_usuario_login['email'], 
        $dados_usuario_login['telefone'], 
        $dados_usuario_login['logradouro'], 
        $dados_usuario_login['numero'],
        $dados_usuario_login['cidade'],
        $dados_usuario_login['bairro'],
        $dados_usuario_login['cep'],
        $dados_usuario_login['senha'],
        $dados_usuario_login['conf_senha']);
        $usuario_logado->setId($dados_usuario_login['id']);

        $_SESSION['id'] = $usuario_logado->getId();
        $_SESSION['nome'] = $usuario_logado->getNome();
        $_SESSION['email'] = $usuario_logado->getEmail();
        $_SESSION['telefone'] = $usuario_logado->getTelefone();
        $_SESSION['logradouro'] = $usuario_logado->getLogradouro();
        $_SESSION['numero'] = $usuario_logado->getNumero();
        $_SESSION[ 'cidade'] = $usuario_logado->getCidade();
        $_SESSION['bairro'] = $usuario_logado->getBairro();
        $_SESSION['cep'] = $usuario_logado->getCep();
        $_SESSION['senha'] = $usuario_logado->getSenha();
        $_SESSION['conf_senha'] = $usuario_logado->getConf_senha();
      
       $url_destino = $base.'/home.php';
       echo $url_destino;
       header("Location: $url_destino");
    }else{
        $_SESSION['msg'] = "<div class='alert alert-danger'> Usuário ou Senha inválida!</div>";
        $url_destino = $base.'/login.php';
        header("Location: $url_destino");
    }
}else{

        $url_destino = $base.'/index.php';
        header("Location: $url_destino");
}

