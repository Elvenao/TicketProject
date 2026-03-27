<?php 
    class homeController{
        public function renderContent(){
            include "view/users/home.html.php";
        }

        public function renderCSS(){
            //TODO
        }

        public function renderJS(){
            include "js/users/home.js";
        }
    }