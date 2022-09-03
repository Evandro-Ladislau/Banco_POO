<?php
require_once 'usuario.php';
require_once 'config.php';

$SendCadUsuario = filter_input(INPUT_POST, 'SendCadUsuario');
if($SendCadUsuario){

    $dados_cadastro_usuario = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    $senha_usuario = password_hash($dados_cadastro_usuario['senha'], PASSWORD_DEFAULT);
    $usuario = new Usuario($dados_cadastro_usuario['nome'], 
    $dados_cadastro_usuario['email'], 
    $dados_cadastro_usuario['telefone'], 
    $dados_cadastro_usuario['logradouro'], 
    $dados_cadastro_usuario['numero'],
    $dados_cadastro_usuario['cidade'],
    $dados_cadastro_usuario['bairro'],
    $dados_cadastro_usuario['cep'],
    $senha_usuario,
    $dados_cadastro_usuario['conf_senha']);

    $result = $usuario->BuscarEmail($usuario->getEmail());

    if (!$result) {
        $usuario->CadastrarUsuario();
        $_SESSION['msg'] = "<div class='alert alert-success'> Usuario Cadastrado com Sucesso!</div>";
        $url_destino = $base.'/login.php';
        header("Location: $url_destino");
    }else{
        echo "<div class='alert alert-danger'> Email já existe no cadastro!</div>";
    }
    

}