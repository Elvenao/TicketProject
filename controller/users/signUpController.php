<?php 
    class signUpController{
        public function renderContent(){
            include "view/users/signUp.html.php";
        }

        public function renderCSS(){
            //TODO
        }

        public function renderJS(){
            include "js/users/signUp.js";
        }
    }