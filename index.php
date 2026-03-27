<?php
    
    require_once "config/requirements.php";

    $queryString = isset($_GET["querystring"]) ? $_GET["querystring"] : " ";   
    switch(controller::tryFrom($queryString)){
        case controller::LOG_IN:
            $title = titlesEnum::LOG_IN->value;
            require_once "controller/users/logInController.php";
            $ctrl = new logInController();
            break;
        case controller::SIGN_UP:
            $title = titlesEnum::SIGN_UP->value;
            require_once "controller/users/signUpController.php";
            $ctrl = new signUpController();
            break;
        default:
            include "view/error.html.php";
            die();
            
    }
    include "view/index.html.php";
?>