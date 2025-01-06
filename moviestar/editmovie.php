<?php
    require_once("templates/header.php");
    //Verifica se o usuario esta autenticado
    require_once("models/User.php");
    require_once("dao/UserDAO.php");
    require_once("dao/MovieDAO.php");

    $user = new User();
    $userDao = new UserDAO($conn, $BASE_URL);
    
    $userData = $userdao->verifyToken(true);

    $movieDao = new MovieDAO($conn, $BASE_URL);

    $id = filter_input(INPUT_GET, "id");
    if(empty($id)){
        $message->setMessage("O filme não foi encontrado", "error", "index.php");
    }else{
        $movie = $movieDao->findById($id);
        if(!$movie){
            $message->setMessage("O filme não foi encontrado", "error", "index.php");
        }
    }
    //Checar se o filme tem imagem
    if($movie->image == ""){
        $movie->image = "movie_cover.jpg";
    }


?>

<div id="main-container" class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 offset-md-1">
                <h1><?= $movie->title ?></h1>
                <p class="page-description">Altere os dados do filme no formulário abaixo: </p>
                <form  id="edit-movie-form" action="<?= $BASE_URL ?>movie_process.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="type" value="update">
                    <input type="hidden" name="id" value="<?= $movie->id ?>">
                    <div class="form-group">
                        <label for="title">Título:</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= $movie->title ?>" placeholder="Digite o titulo do filme">
                    </div>
                    <div class="form-group">
                        <label for="image">Foto:</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <label for="length">Duração:</label>
                        <input type="text" class="form-control" id="length" name="length" placeholder="Digite a duração do filme" value="<?= $movie->length ?>">
                    </div>
                    <div class="form-group">
                        <label for="category">Categoria:</label>
                        
                        <select type="text" class="form-control" id="category" name="category">
                            <option value="Comedia" <?= $movie->category === "Comedia" ? "selected" : "" ?> >Comedia</option>
                            <option value="Acao"    <?= $movie->category === "Ação"    ? "selected" : "" ?> >Acao</option>
                            <option value="Drama"   <?= $movie->category === "Drama"   ? "selected" : "" ?> >Drama</option>
                            <option value="Ficcao"  <?= $movie->category === "Ficção"  ? "selected" : "" ?> >Ficcao</option>
                            <option value="Terro"   <?= $movie->category === "Terror"  ? "selected" : "" ?> >Terro</option>
                            <option value="Romance" <?= $movie->category === "Romance" ? "selected" : "" ?> >Romance</option>
                        </select>
                    
                    </div>
                    <div class="form-group">
                        <label for="trailer">Trailer:</label>
                        <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Digite link do trailer do filme" value="<?= $movie->trailer ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição do filme:</label>
                        <textarea class="form-control" id="description" name="description" rows="5" placeholder="Descreva o filme">
                        <?= $movie->description ?>
                        </textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn card-btn" value="Editar filme">
                    </div>
                </form>
            </div>
            <div class="col-md-3">
                <div class="movie-image-container" style="background-image: url('<?= $BASE_URL?>img/movie/<?= $movie->image ?>');"></div>
            </div>        
        </div>
    </div>
    
</div>

<?php
    require_once("templates/footer.php");

?>