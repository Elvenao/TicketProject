<?php
    require_once __DIR__ . "/../class/mainClass.php";
    class mainModel{
        public function getData($table, $fields, $condition = null, $params = null){
            $pgsql = new mainClass("TicketsDataBase","localhost","postgres","169c4bd1ba018");
            $cursor = $pgsql->getData($table, $fields,$condition, $params);
            return $cursor;
        }

        public function insertData($table, $fields, $params){
            $pgsql = new mainClass("TicketsDataBase","localhost","postgres","169c4bd1ba018");
            $lastId = $pgsql->insertData($table,$fields,$params);
            return $lastId;
        }
    }