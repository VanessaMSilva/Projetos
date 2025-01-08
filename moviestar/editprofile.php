<?php
    require_once("templates/header.php");
    require_once("models/User.php");
    require_once("dao/UserDAO.php");

    $user = new User();
    $userdao = new UserDAO($conn, $BASE_URL);

    $userData = $userdao->verifyToken(true);

    $fullname = $user->getFullName($userData);

    if($userData->image == ""){
        $userData->image = "user.png";
    }
?>
    <div id="main-container" class="container-fluid edit-profile-create">
        <div class="col-md-12">
            <form action="<?=$BASE_URL?>user_process.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="type" value="update">
                <div class="row">
                    <div class="col-md-4">
                        <h1><?=$fullname?></h1>
                        <p class="page-description">Altere seus dados no formulario</p>
                        <div class="form-group">
                            <label for="name">Nome:</label>
                            <input type="text" class="form-control" id="name" name="name" 
                            placeholder="Digite seu nome" value="<?= $userData->name?>">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Sobrenome:</label>
                            <input type="text" class="form-control" id="lastname"
                             name="lastname" placeholder="Digite seu sobrenome"  value="<?= $userData->lastname?>">
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="text" readonly class="form-control disable" id="email"
                             name="email" placeholder="Digite seu email" value="<?= $userData->email?>">
                        </div>
                        <input type="submit" class="btn card-btn" value="Alterar">
                        
                    </div>
                    <div class="col-md-4">
                        <div class="profile-image-container" id="profile-image-container" style="background-image: url('<?= $BASE_URL?>img/users/<?=$userData->image ?>')">
                            
                        </div>
                        <div class="form-group">
                            <label for="image">Foto:</label>
                            <input type="file" class="form-control-file" id="image"
                             name="image" placeholder="Digite seu nome">
                        </div>
                        <div class="form-group">
                            <label for="bio">Sobre você:</label>
                            <textarea class="form-control" id="bio" name="bio" rows="5" placeholder="Conte sobre voce"><?= $userData->bio ?></textarea>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-4">
                    <h2>Alterar senha</h2>
                    <p class="page-description">Altere e confirme sua senha no formulario</p>
                    <form action="<?=$BASE_URL?>user_process.php" method="POST">
                        <input type="hidden" name="type" value="changepassword">

                        <div class="form-group">
                            <label for="password">Senha:</label>
                            <input type="password" class="form-control" id="password"
                             name="password" placeholder="Digite sua nova Senha">
                        </div>
                        <div class="form-group">
                            <label for="confirmpassword">Cofirme sua senha:</label>
                            <input type="password" class="form-control" id="confirmpassword"
                             name="confirmpassword" placeholder="Digite sua Cofirmação de senha">
                        </div>
                        <input type="submit" class="btn card-btn" value="Alterar senha">
                    </form>

                </div>
            </div>
        </div>
    </div>


<?php
    require_once("templates/footer.php");

?>