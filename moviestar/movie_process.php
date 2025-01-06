<?php
   require_once("globals.php");
   require_once("db.php");
   require_once("models/Movie.php");
   require_once("models/Message.php");
   require_once("dao/UserDAO.php");
   require_once("dao/MovieDAO.php");
 
   $message = new Message($BASE_URL);
   $userDao = new UserDAO($conn, $BASE_URL);
   $movieDao = new MovieDAO($conn, $BASE_URL);
 
   // Resgata o tipo do formulário
   $type = filter_input(INPUT_POST, "type");
 
   // Resgata dados do usuário
   $userData = $userDao->verifyToken();

  
    //Atualizar usuario
    if($type === "create"){
        $title = filter_input(INPUT_POST, "title");
        $description = filter_input(INPUT_POST, "description");
        $trailer = filter_input(INPUT_POST, "trailer");
        $category = filter_input(INPUT_POST, "category");
        $length = filter_input(INPUT_POST, "length");

        $movie = new Movie();

        if(!empty($title) && !empty($description) && !empty($category)){
            $movie->title = $title;    
            $movie->description = $description;
            $movie->trailer = $trailer;
            $movie->category = $category;
            $movie->length = $length;
            $movie->users_id = $userData->id;
            //Upload de imagem
            if(!empty($title) && !empty($description) && !empty($category)) {
                $image = $_FILES["image"];
                $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
                $jpgArray = ["image/jpeg", "image/jpg"];
                //echo $image["type"]; exit;
                // Checagem de tipo de imagem
                if(in_array($image["type"], $imageTypes)) {

                    // Checar se jpg
                    if(in_array($image["type"], $jpgArray)) {
                      $imageFile = imagecreatefromjpeg($image["tmp_name"]);
                    // Imagem é png
                    } else {
                      $imageFile = imagecreatefrompng($image["tmp_name"]);
                    }
                    $imageName = $movie->imageGerateName();
                    imagejpeg($imageFile, "./img/movie/". $imageName, 100);

                    $movie->image = $imageName;
                }else{
                    $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "back");     
                }

            }
            $movieDao->create($movie);

        }else{
            $message->setMessage("Informações invalidas!", "error", "back");        
        }
          
    }else{
        $message->setMessage("Informações invalidas!", "error", "back");
    }
    