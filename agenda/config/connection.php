<?php 
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "Agenda";

    try{
        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

        //Ativar moos de erro
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        //erro na conexao
        $error = $e->getMessage();
        echo "Erro: $error";    
    }

   