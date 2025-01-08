<?php
    require_once("templates/header.php");
    //Verifica se o usuario esta autenticado
    require_once("models/Movie.php");
    require_once("dao/MovieDAO.php");
    require_once("dao/ReviewDAO.php");
    //Pegar o id do filme
    $id = filter_input(INPUT_GET, "id"); 
    $movie;
    $movieDAO = new MovieDAO($conn, $BASE_URL);
    $reviewDao = new ReviewDAO($conn, $BASE_URL);
    if(empty($id)){
        $message->setMessage("O filme não foi encontrado", "error", "index.php");
    }else{
        $movie = $movieDAO->findById($id);
        if(!$movie){
            $message->setMessage("O filme não foi encontrado", "error", "index.php");
        }
    }

//Checar se o filme tem imagem
if($movie->image == ""){
    $movie->image = "movie_cover.jpg";
}

//Checar se o filme é do usuario
   $userOwnsMovie = false;
   
   if(!empty($userData)){
        if($userData->id === $movie->users_id){
            $userOwnsMovie = true;
        }
    //Resgatar review do filme
     $alreadyReviewed = $reviewDao->hasAlreadyReviewed($id, $userData->id);
   }

  #print_r($movie);exit;

   // Resgatar as reviews do filme
  $movieReviews = $reviewDao->getMoviesReview($movie->id);
 

?>

<div id="main-container" class="container-fluid">
    <div class="row">
        <div class="offset-md-1 col-md-6 movie-conatiner">
            <h1 class="page-title"><?=$movie->title ?></h1>
            <p class="movie-details"></p>
            <span>Duração: <?=$movie->length ?></span>
            <span class="pipe"></span>
            <span><?=$movie->category ?></span>
            <span class="pipe"></span>
            <p><i class="fas fa-star"></i><?= $movie->rating ?></p>
            <iframe src="<?=$movie->trailer ?>" width="560" height="315" frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encryted-media; gyroscope;
            picture-in-picture" allowfullscreen></iframe>
            <p><?=$movie->description ?></p>
            <div class="col-md-4">
                <div class="movie-image-container" style="background-image: url('<?= $BASE_URL ?>img/movie/<?= $movie->image ?>')"></div>
            </div>
        </div>
        <div class="offset-md-1 col-md-10" id="reviews-container">
        <h3 id="reviews-title">Avaliações: </h3>
        
        <?php if(!empty($userData) && !$userOwnsMovie && !$alreadyReviewed): ?>

        <div class="col-md-12" id="review-form-container">
            <h4>Envie sua avaliação</h4>
            <p class="page-description">Preencha o formulario com a nota e comentario sobre o filme</p>
            <form action="<?= $BASE_URL ?>review_process.php" id="review-form" method="POST">
                <input type="hidden" name="type" value="create">
                <input type="hidden" name="movies_id" value="<?= $movie->id ?>">
                <div class="form-group">
                    <label for="rating">Nota do filme: </label>
                    <select name="rating" id="rating" class="form-control">
                        <option value="">Selecione</option>
                        <option value="10">10</option>
                        <option value="9">9</option>
                        <option value="8">8</option>
                        <option value="7">7</option>
                        <option value="6">6</option>
                        <option value="5">5</option>
                        <option value="4">4</option>
                        <option value="3">3</option>
                        <option value="2">2</option>
                        <option value="1">1</option>
                      
                    </select>
                </div>
                <div class="form-group">
                    <label for="review">Seu comentario: </label>
                    <textarea name="review" id="review" rows="3" class="form-control"
                    placeholder="O que você achou do filme?"></textarea>
                </div>
                <input type="submit" class="btn card-btn" value="Enviar comentario">
            </form>
        </div>
        <?php endif; ?>
        <!--Comentarios-->
        <?php foreach($movieReviews as $review): ?>
            <?php require("templates/user_review.php"); ?>
        <?php endforeach; ?>
        <?php if(count($movieReviews) == 0): ?>
            <p class="empty-list">Não há comentarios para este filme ainda...</p>
        <?php endif; ?>
       

        </div>
    </div>
</div>

 