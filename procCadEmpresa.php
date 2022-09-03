<?php
require_once 'config.php';
require_once 'banco.php';

$SendCadEmpresa = filter_input(INPUT_POST, 'SendCadEmpresa');
if($SendCadEmpresa){
    $dados_empresa = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    $empresa = new Banco($dados_empresa['nome'], 
                            $dados_empresa['cnpj'], 
                            $dados_empresa['ramo_atuacao'], 
                            $dados_empresa['telefone'], 
                            $dados_empresa['logradouro']
                        );

$result = $empresa->BuscarCnpj($empresa->getCnpj());

if (!$result) {
    $empresa->CadastrarEmpresa();

    $url_destino = $base.'/login.php';
    header("Location: $url_destino");

}else{
    echo "<div class='alert alert-danger'> Empresa já cadastrada!</div>";
}

}

