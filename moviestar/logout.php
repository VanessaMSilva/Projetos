<?php
    require_once("templates/header.php");
    if($userdao){
        $userdao->destroyToken();
    }

?>