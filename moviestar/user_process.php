<?php
    require_once("globals.php");
    require_once("db.php");
    require_once("models/User.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");

    $message = new Message($BASE_URL);
    $userDAO = new UserDAO($conn, $BASE_URL);
    ///Verifica tipo form
    $type= filter_input(INPUT_POST, "type");
    //Atualizar usuario
    if($type === "update"){
        //Resgata dados do usuario
        $userdata = $userDAO->verifyToken();

        //Recebe dados dopost
        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $email = filter_input(INPUT_POST, "email");
        $bio = filter_input(INPUT_POST, "bio");

        // Criar um novo objeto de usuário
        $user = new User();

        //Preencher dados usuario
        $userdata->name = $name;
        $userdata->lastname = $lastname;
        $userdata->email = $email;
        $userdata->bio = $bio;

        // Upload da imagem
    if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
      
        $image = $_FILES["image"];
        //echo $image["type"] ."<br>";
        $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
        $jpgArray = ["image/jpeg", "image/jpg"];
  
        // Checagem de tipo de imagem
        if(in_array($image["type"], $imageTypes)) {
  
          // Checar se jpg
          if(in_array($image["type"], $jpgArray)) {
  
            $imageFile = imagecreatefromjpeg($image["tmp_name"]);
  
          // Imagem é png
          } else {
  
            $imageFile = imagecreatefrompng($image["tmp_name"]);
  
          }
  
          $imageName = $user->imageGenerateName();
  
          imagejpeg($imageFile, "./img/users/" . $imageName, 100);
  
          $userdata->image = $imageName;
  
        } else {
  
          $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "back");
  
        }
  
      }
       
        $userDAO->update($userdata);
    }else if($type === "changepassword"){
        //Recebe dados dopost
        $id = filter_input(INPUT_POST, "id");
        $password = filter_input(INPUT_POST, "password");
        $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

        if($password === $confirmpassword){
          // Criar um novo objeto de usuário
          $user = new User();

          //Preencher senha usuario
          $finalpassword = $user->generatePassword($password);
          $user->password = $password;
            //Resgata dados do usuario
          $userdata = $userDAO->verifyToken();
          $user->id = $userdata->id;

          $userDAO->changePassword($user);
        }else{
          $message->setMessage("Senhas não são iguais!", "error", "back");
        
        }
    }else{
        $message->setMessage("Informações invalidas!", "error", "back");
    }
