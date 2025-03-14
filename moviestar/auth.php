<?php
    require_once("templates/header.php");

?>
    <div id="main-container" class="container-fluid">
        <div class="col-md-12">
            <div class="row" id="auth-row">
                <div class="col-md-4" id="login-container">
                    <h2>Entrar</h2>
                    <form action="<?=$BASE_URL?>auth_process.php" method="POST">
                        <input type="hidden" name="type" value="login">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email"
                             name="email" placeholder="Digite seu email">
                        </div>
                        <div class="form-group">
                            <label for="password">Senha:</label>
                            <input type="password" class="form-control" id="password"
                             name="password" placeholder="Digite sua Senha">
                        </div>
                        <input type="submit" class="btn card-btn" value="Entrar">
                    </form>
                </div>
                <div class="col-md-4" id="login-container">
                    <h2>Criar conta</h2>
                    <form action="<?=$BASE_URL?>auth_process.php" method="POST">
                        <input type="hidden" name="type" value="register">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email"
                             name="email" placeholder="Digite seu email">
                        </div>
                        <div class="form-group">
                            <label for="name">Nome:</label>
                            <input type="text" class="form-control" id="name"
                             name="name" placeholder="Digite seu nome">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Sobrenome:</label>
                            <input type="text" class="form-control" id="lastname"
                             name="lastname" placeholder="Digite seu sobrenome">
                        </div>
                        <div class="form-group">
                            <label for="password">Senha:</label>
                            <input type="password" class="form-control" id="password"
                             name="password" placeholder="Digite sua Senha">
                        </div>
                        <div class="form-group">
                            <label for="confirmpassword">Cofirme sua senha:</label>
                            <input type="password" class="form-control" id="confirmpassword"
                             name="confirmpassword" placeholder="Digite sua Cofirmação de senha">
                        </div>
                        <input type="submit" class="btn card-btn" value="Entrar">
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php
    require_once("templates/footer.php");

?>