<?php
    require_once("templates/header.php");
    require_once("dao/MovieDAO.php");

    //DAO dos filmes
    $movieDAO = new MovieDAO($conn, $BASE_URL);

    $latestMovies = $movieDAO->getLatestMovie();

    $actionMovies = $movieDAO->getMoviesByCategorie("Ação");

    $comedyMovies = $movieDAO->getMoviesByCategorie("Comédia");

?>
    <div id="main-container" class="container-fluid">
        <h2 class="section-title">Filmes novos</h2>
        <p class="section-description">Veja as criticas dos ultimos filmes adicionados no moviestar</p>
        <div class="movies-container">
            <?php foreach($latestMovies as $movie):?>
                <?php 
                require("templates/movie_card.php");
                ?>
            <?php endforeach;?>
            <?php if(count($latestMovies) === 0):?>
                <p class="empty-list">Ainda não há filmes cadastrados</p>
            <?php endif; ?>
            
        </div>
        <h2>Ação</h2>
        <p class="section-description">Veja os melhores filmes de ação</p>
        <div class="movies-container">
        <?php foreach($actionMovies as $movie):?>
                <?php 
                require("templates/movie_card.php");
                ?>
            <?php endforeach;?>
            <?php if(count($actionMovies) === 0):?>
                <p class="empty-list">Ainda não há filmes cadastrados</p>
            <?php endif; ?>
        </div>
            
        <h2>Comedia</h2>
        <p class="section-description">Veja os melhores filmes de Comedia</p>
        <div class="movies-container">
            <?php foreach($comedyMovies as $movie):?>
                <?php 
                require("templates/movie_card.php");
                ?>
            <?php endforeach;?>
            <?php if(count($comedyMovies) === 0):?>
                <p class="empty-list">Ainda não há filmes cadastrados</p>
            <?php endif; ?>
        </div>
        <!-- <h2>Drama</h2>
        <p class="section-description">Veja os melhores filmes de Drama</p>
        <div class="movies-container">  <?php foreach($latestMovies as $movie):?>
                <?php 
                require("templates/movie_card.php");
                ?>
            <?php endforeach;?>
            <?php if(count($latestMovies) === 0):?>
                <p class="empty-list">Ainda não há filmes cadastrados</p>
            <?php endif; ?>
        </div>

        <h2>Terror</h2>
        <p class="section-description">Veja os melhores filmes de Terror</p>
        <div class="movies-container">
            <?php foreach($latestMovies as $movie):?>
                <?php 
                require("templates/movie_card.php");
                ?>
            <?php endforeach;?>
            <?php if(count($latestMovies) === 0):?>
                <p class="empty-list">Ainda não há filmes cadastrados</p>
            <?php endif; ?>
        </div> -->
        
    </div>


<?php
    require_once("templates/footer.php");

?>