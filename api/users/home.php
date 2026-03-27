<?php
    session_start();
    if($_GET['logout']){
        session_destroy();
    }
    echo json_encode([
        "status" => "ok",
        "message" => "Logged Out",
        "code" => 0
    ]);