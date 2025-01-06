<?php
    require_once("templates/header.php");
    //Verifica se o usuario esta autenticado
    require_once("models/User.php");
    require_once("dao/UserDAO.php");

    $user = new User();
    $userdao = new UserDAO($conn, $BASE_URL);

    $userdata = $userdao->verifyToken(true);
?>

<div id="main-container" class="container-fluid">
    <div class="offset-md-4 col-md-4 new-movie-container">
        <h1 class="page-title">Adicione Filme</h1>
        <p class="page-description">Adicione sua critica e compartilhe com o mundo!</p>
        <form action="<?=$BASE_URL?>/movie_process.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="create">
            <div class="form-group">
                <label for="title">Título:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Digite o titulo do filme">
            </div>
            <div class="form-group">
                <label for="image">Foto:</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="length">Duração:</label>
                <select type="text" class="form-control" id="category" name="category">
                    <option value="Acao">Acao</option>
                    <option value="Drama">Drama</option>
                    <option value="Comedia">Comedia</option>
                    <option value="Ficcao">Ficcao</option>
                    <option value="Terro">Terro</option>
                    <option value="Romance">Romance</option>
                </select>
            
            </div>
            <div class="form-group">
                <label for="trailer">Trailer:</label>
                <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Digite link do trailer do filme">
            </div>
            <div class="form-group">
                <label for="description">Descrição do filme:</label>
                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Descreva o filme"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" class="btn card-btn" value="Adicione um filme">
            </div>
        </form>
    </div>
</div>

<?php
    require_once("templates/footer.php");

?>