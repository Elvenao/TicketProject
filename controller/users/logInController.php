<?php 
    class logInController{
        public function renderContent(){
            include "view/users/logIn.html.php";
        }

        public function renderCSS(){
            //TODO
        }

        public function renderJS(){
            include "js/users/logIn.js";
        }
    }