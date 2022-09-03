<?php

require_once 'conta.php';
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
        $_SESSION['msg'] = "<div class='alert alert-danger'> Você Não tem conta Aberta! </div>";
        $url_destino = $base.'/home.php';
        header("Location: $url_destino");
}




?>

<body>
    <div class="d-flex flex-column wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark bg-danger border-bottom shadow-sm mb-3">
            <div class="container">
                <a class="navbar-brand" href="#"><b>Banco Renderize</b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav flex-grow-1">
                        <li class="nav-item">
                            <a href="#" class="nav-link text-white"><?php echo "Bem-Vindo " . $usuario_logado->getNome(); ?> </a>
                        </li>

                    </ul>
                    <ul class="navbar-nav flex-grow-1">
                        <li class="nav-item">
                            <a href="#" class="nav-link text-white"><?php echo "Saldo Atual R$ " . $conta_usuario_logado->getSaldo(); ?> </a>
                        </li>

                    </ul>
                    <ul class="navbar-nav flex-grow-1">
                        <li class="nav-item">
                            <a href="<?php echo $base . "/logout.php" ?>" class="nav-link text-white"> Fechar Conta </a>
                        </li>

                    </ul>
                    <div class="align-self-end">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="<?php echo $base . "/logout.php" ?>" class="nav-link text-white">Sair</a>
                            </li>
                            <li class="nav-item">
                                <span class="badge rounded-pill bg-light text-danger position-absolute ms-4 mt-0" title="5 produto(s) no carrinho"><small>5</small></span>
                                <a href="/carrinho.html" class="nav-link text-white">
                                    <i class="bi-cart" style="font-size:24px;line-height:24px;"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-fill">
            <div class="container">
                <div class="row justify-content-center">
                    <form method="POST"  class="col-sm-10 col-md-8 col-lg-6">
                        <h1>Movimentação Bancária</h1>
                        
                        <div class="form-floating mb-3">

                        <div class="form-floating mb-3">
                        <select name="id" id="" class="form-control">
                                <option selected>Selecione</option>
                                
                                <?php
                                $conn = new Conexao();
                                $transacao = $conn->BuscarTransacao();
                                foreach ($transacao as $value) {
                                    $transacao_bancaria = $value;
                                ?>    
                                <option value="<?php echo $transacao_bancaria['id']?>"><?php echo $transacao_bancaria['nome'] ?></option>
                                <?php
                                 }
                                 ?>
                            </select>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="valor" type="number" id="txtdeposito" class="form-control" placeholder=" ">
                            <label for="txtSenha">Valor da transação</label>
                        </div>
                        
                        <input name="SendTransacao" type="submit" class="btn btn-lg btn-danger">
                        </div>
                    </form>
                    <?php
                        $SendTransacao = filter_input(INPUT_POST, 'SendTransacao');
                        
                        if($SendTransacao){

                            $transacao_id = filter_input(INPUT_POST, 'id');
                            $transacao_valor = filter_input(INPUT_POST, 'valor');
                            
                            switch ($transacao_id) {
                                case 1:
                                    $_SESSION['msg'] = $conta_usuario_logado->Depositar($transacao_valor);
                                    $conta_usuario_logado->CadastrarConta($transacao_id);
                                    
                                    $conta_usuario_logado->HistoricoMovimentacao($transacao_id, $transacao_valor);

                                    $url_destino = $base.'/movimentacao.php';
                                    echo $url_destino;
                                    header("Location: $url_destino");
                                    break;

                                    case 2:
                                        $reuslt_sacar = $conta_usuario_logado->Sacar($transacao_valor);
                                        if ($reuslt_sacar == false) {
                                            $_SESSION['msg'] = "Você não tem saldo suficiente! ";
                                        }else{
                                           
                                            $conta_usuario_logado->CadastrarConta($transacao_id);
                                            $conta_usuario_logado->HistoricoMovimentacao($transacao_id, $transacao_valor);
                                            $_SESSION['msg'] = "Saque de R$". number_format($transacao_valor, 2, ',', ' ') . " Efetuado com Sucesso!"."<br>";
                                        }

                                        $url_destino = $base.'/movimentacao.php';
                                        echo $url_destino;
                                        header("Location: $url_destino");
                                        break;    
                                
                                        case 3:
                                            $result_fechar_conta = $conta_usuario_logado->FecharConta();
                                            if($result_fechar_conta){
                                                $_SESSION['msg'] = "<div class='alert alert-danger'> Conta Fechada com Sucesso! </div>";
                                            }else{
                                                $_SESSION['msg'] = "<div class='alert alert-danger'> Retire o dinheiro antes de fechar a conta!</div>";
                                            }

                                            $url_destino = $base.'/movimentacao.php';
                                            echo $url_destino;
                                            header("Location: $url_destino");
                                            break;
                                default:
                                    $_SESSION['msg'] = "Nenhuma das opções são válidas, por favor entre em contato com o SAC!";
                                    break;
                            }

                        }
                    ?>  
                    <div class="form-floating mb-8">
                        <?php
                        if(isset($_SESSION['msg'] )){
                            echo $_SESSION['msg'];
                        }
                        $historico_contas = $conta_usuario_logado->BuscarHistoricoMovimentacao($usuario_logado->getId());
                         
                        ?>
                    </div>
                    
                    <div class="form-floating mb-3">  
                    <table class="table ">
                                <thead>
                                    <tr>
                                        <th scope="col">Histótico</th>
                                        <th scope="col">Transação</th>
                                        <th scope="col">Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        
                                        foreach ($historico_contas as $value) {
                                            $historico_conta_usuario = $value;
                                           ?>
                                           
                                            <tr>
                                            <th scope="row"><?php echo date('d/m/y H:i:s', strtotime($historico_conta_usuario['created']))?></th>
                                            <td><?php echo $historico_conta_usuario['nome']?></td>
                                            <td><?php echo $historico_conta_usuario['valor']?></td>
                                        </tr>

                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </main>

        <footer class="border-top text-muted bg-light">
            <div class="container">
                <div class="row py-3">
                    <div class="col-12 col-md-4 text-center">
                        &copy; 2020 - Banco Renderize Ltda ME<br>
                        Rua Virtual Inexistente, 171, Compulândia/PC <br>
                        CPNJ 99.999.999/0001-99
                    </div>
                    <div class="col-12 col-md-4 text-center">
                        <a href="/privacidade.html" class="text-decoration-none text-dark">
                            Política de Privacidade
                        </a><br>
                        <a href="/termos.html" class="text-decoration-none text-dark">
                            Termos de Uso
                        </a><br>
                        <a href="/quemsomos.html" class="text-decoration-none text-dark">
                            Quem Somos
                        </a><br>
                        <a href="/trocas.html" class="text-decoration-none text-dark">
                            Trocas e Devoluções
                        </a>
                    </div>
                    <div class="col-12 col-md-4 text-center">
                        <a href="/contato.html" class="text-decoration-none text-dark">
                            Contato pelo Site
                        </a><br>
                        E-mail: <a href="mailto:email@dominio.com" class="text-decoration-none text-dark">
                            email@dominio.com
                        </a><br>
                        Telefone: <a href="phone:28999990000" class="text-decoration-none text-dark">
                            (28) 99999-0000
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>