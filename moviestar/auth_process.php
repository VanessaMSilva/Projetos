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

    if($type === "register"){
        $name= filter_input(INPUT_POST, "name");
        $lastname= filter_input(INPUT_POST, "lastname");
        $email= filter_input(INPUT_POST, "email");
        $password= filter_input(INPUT_POST, "password");
        $confirmpassword= filter_input(INPUT_POST, "confirmpassword");
        //Verificaoao de dados minimos
        if($name && $lastname && $email && $password){
            //Vericar se as senhas batem

            if($password === $confirmpassword){
                //verificar se email ja esta cadastrado
                if($userDAO->findByEmail($email)==false){
                    $user = new User();

                    //Criaçãode token
                    $userToken = $user->generateToken();
                    $finalPassword = $user->generatePassword($password);

                    $user->name = $name;
                    $user->lastname = $lastname;
                    $user->email = $email;
                    $user->password = $finalPassword;
                    $user->token = $userToken;
                    $auth = true;
                    $userDAO->create($user, $auth);

                }else{
                    $message->setMessage("Usuario já cadastrado", "error", "back");
                }
            }else{
                $message->setMessage("Senhas não são iguais", "error", "back");
            }

        }else{
          
            //Enviar mns de erro de dados faltantes
            $message->setMessage("Por favor preencha todos os campos", "error", "back");
        }

    }else if($type === "login"){
        $email= filter_input(INPUT_POST, "email");
        $password= filter_input(INPUT_POST, "password");

        //Tenta autenticar usuario
        if($userDAO->authenticateUser($email, $password)){
            $message->setMessage("Seja bem vindo!.", "success", "editpofile.php");

        }else{
            $message->setMessage("Usuario e/ou senha incorretos.", "error", "back");
        }
    }else{
        $message->setMessage("Informações invalidas.", "error", "back");

    }

    echo $type;


?>