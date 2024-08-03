<?php
    include_once("config/url.php");
    include_once("config/process.php");

    //liampa a mensg
    if(isset($_SESSION['msg'])){
        $printMsg = $_SESSION['msg'];
        $_SESSION['msg'] = "";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGENDA CONTATOS</title>
    
    <!-- BOTSTRAP -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- FONTE DE ICONES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="<?=$BASE_URL?>css/style.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="<?=$BASE_URL?>index.php">
                <img src="<?=$BASE_URL?>img/logo.svg" alt="Agenda">
            </a>
            <div>
                <div class="navbar-nav">
                    <a href="<?=$BASE_URL?>index.php" class="nav-link active" id="home-link" >Agenda</a>
                    <a href="<?=$BASE_URL?>create.php" class="nav-link active" id="create-link" >Adicionar contato</a>

                </div>
            </div>
        </nav>
    </header>
