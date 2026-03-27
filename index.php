<?php
    session_start();
    require_once "config/requirements.php";
    if(!isset($_SESSION["login"])){
        $queryString = isset($_GET["querystring"]) ? $_GET["querystring"] : DEFAULT_PATH_UNLOGGED;
    }else{
        $queryString = isset($_GET["querystring"]) ? $_GET["querystring"] : DEFAULT_PATH_LOGGED;
    }
    $queryString = str_ends_with($queryString, "/") ? $queryString : $queryString."/";   
    $query = explode("/",$queryString);
    $controller = $query[0] ?? " ";
    if(!isset($_SESSION["login"])){
        switch(controller::tryFrom($controller)){
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
    }else{
        switch(controller::tryFrom($controller)){
            case controller::HOME:
                $title = titlesEnum::HOME->value;
                require_once "controller/users/homeController.php";
                $ctrl = new homeController();
                break;
            default:
                include "view/error.html.php";
                die();
        }
    }
    
    include "view/index.html.php";
?>