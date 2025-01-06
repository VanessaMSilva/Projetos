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
          
    }else if($type === "delete"){
        //Receber os dados dos usuarios
        $id = filter_input(INPUT_POST, "id");
        $movie =$movieDao->findById($id);
        if($movie){
            //Verifica se o filme é do usuario
            if($movie->users_id === $userData->id){
                $movieDao->destroy($movie->id);
            }else{
                $message->setMessage("Informações invalidas!", "error", "back");
            }
        }
        else{
            $message->setMessage("Informações invalidas!", "error", "back");
        }
    }else if($type === "update"){
        $title = filter_input(INPUT_POST, "title");
        $description = filter_input(INPUT_POST, "description");
        $trailer = filter_input(INPUT_POST, "trailer");
        $category = filter_input(INPUT_POST, "category");
        $length = filter_input(INPUT_POST, "length");
        $id = filter_input(INPUT_POST, "id");

        $movieData  = $movieDao->findById($id);
        if($movieData){
            //Verifica se o filme é do usuario
            if($movieData->users_id === $userData->id){
                //Edição filme
                if(!empty($title) && !empty($description) && !empty($category)){
                    $movieData->title = $title;    
                    $movieData->description = $description;
                    $movieData->trailer = $trailer;
                    $movieData->category = $category;
                    $movieData->length = $length;
                    $image = $_FILES["image"];
                    $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
                    $jpgArray = ["image/jpeg", "image/jpg"];
                    if(in_array($image["type"], $imageTypes)) {

                        // Checar se jpg
                        if(in_array($image["type"], $jpgArray)) {
                          $imageFile = imagecreatefromjpeg($image["tmp_name"]);
                        // Imagem é png
                        } else {
                          $imageFile = imagecreatefrompng($image["tmp_name"]);
                        }
                        $imageName = $movieData->imageGerateName();
                        imagejpeg($imageFile, "./img/movie/". $imageName, 100);
    
                        $movieData->image = $imageName;
                    }else{
                        $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "back");     
                    }
                    $movieDao->update($movieData);

                }else{
                    $message->setMessage("Informações invalidas! Precisa adicionar titulo, categoria e/ou descrição", "error", "back");  
                }


            }else{
                $message->setMessage("Informações invalidas!", "error", "back");
            }
        }else{
            $message->setMessage("Informações invalidas!1", "error", "back");
        }

    }else{
        $message->setMessage("Informações invalidas!", "error", "back");
    }
    