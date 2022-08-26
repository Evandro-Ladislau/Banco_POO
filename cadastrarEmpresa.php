<?php

include_once 'include\head.php';
include_once 'config.php';
?>

<body style="min-width:372px;">
    <div class="d-flex flex-column wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark bg-danger border-bottom shadow-sm mb-3">
            <div class="container">
                <a class="navbar-brand" href="<?php echo $base."/index.php" ?>">
                    <strong>Banco Renderize</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target=".navbar-collapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav flex-grow-1">
                        <li class="nav-item">
                        <a href="<?php echo $base."/index.php" ?>" class="nav-link text-white">Cadastrar Usuario</a>
                        </li>
                        <li class="nav-item">
                        
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
                                    <svg class="bi" width="24" height="24" fill="currentColor">
                                        <use xlink:href="/bi.svg#cart3" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-fill">
            <div class="container">
                <h1>Cadastro de Empresa</h1>
                <hr>
                <form method="POST" action="procCadEmpresa.php" class="mt-3">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <fieldset class="row gx-3">
                                <legend>Dados da Empresa</legend>
                                <div class="form-floating mb-3">
                                    <input name="nome" class="form-control" type="text" id="txtNome" placeholder=" " autofocus />
                                    <label for="txtNome">Nome</label>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-floating mb-3 col-md-8">
                                    <input name="cnpj" class="form-control" type="text" id="txtEmail" placeholder=" " />
                                    <label for="txtEmail">CNPJ</label>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-floating mb-3 col-md-8">
                                    <input name="ramo_atuacao" class="form-control" type="text" id="txtEmail" placeholder=" " />
                                    <label for="txtEmail">Ramo de Atuação</label>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-floating mb-3 col-md-8">
                                    <input name="telefone" class="form-control" type="text" id="txtEmail" placeholder=" " />
                                    <label for="txtEmail">Telefone</label>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-floating mb-3 col-md-8">
                                    <input name="logradouro" class="form-control" type="text" id="txtEmail" placeholder=" " />
                                    <label for="txtEmail">Logradouro</label>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <hr />
                    <div class="form-check mb-3">
                        <input name="" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Desejo receber informações sobre promoções.
                        </label>
                    </div>
                    <div class="mb-3 text-left">
                        <a class="btn btn-lg btn-light btn-outline-danger" href="/">Cancelar</a>
                        <input name="SendCadEmpresa" type="submit" class="btn btn-success" value="Cadastrar">
                </form>
            </div>
        </main>

<?php

	include_once 'include\footer.php';
