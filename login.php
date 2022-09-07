<?php
session_start(); //incializando a sessão.
ob_start(); //iniciallizando o buffer de saida.

include_once 'include\head.php';
include_once 'config.php';
?>

<body>
    <div class="d-flex flex-column wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark bg-danger border-bottom shadow-sm mb-3">
            <div class="container">
                <a class="navbar-brand" href="<?php echo $base."/index.php" ?>"><b>Banco Renderize</b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target=".navbar-collapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav flex-grow-1">
                        <li class="nav-item">
                        <a href="<?php echo $base."/index.php" ?>" class="nav-link text-white">Cadastrar Usuario</a>
                        </li>
                    </ul>
                    <div class="align-self-end">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo $base."/login.php" ?>" class="nav-link text-white">Entrar</a>
                            </li>
                            <li class="nav-item">
                                <span class="badge rounded-pill bg-light text-danger position-absolute ms-4 mt-0"
                                    title="5 produto(s) no carrinho"><small>5</small></span>
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
                    <form method="POST" action="procLogin.php" class="col-sm-10 col-md-8 col-lg-6">
                        <h1>Identifique-se, por favor</h1>
                        <?php
                        if(isset($_SESSION['msg'])){
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                        ?>
                        <div class="form-floating mb-3">
                            <input name="email" type="email" id="txtEmail" class="form-control" placeholder=" " autofocus>
                            <label for="txtEmail">E-mail</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input name="senha" type="password" id="txtSenha" class="form-control" placeholder=" ">
                            <label for="txtSenha">Senha</label>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" value="" id="chkLembrar">
                            <label for="chkLembrar" class="form-check-label">Lembrar de mim</label>
                        </div>

                        <input name="SendLogin" type="submit"
                            class="btn btn-lg btn-danger">

                        <p class="mt-3">
                            Ainda não é cadastrado? <a href="<?php echo $base."/index.php" ?>">Clique aqui</a> para se cadastrar.
                        </p>
                    </form>
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