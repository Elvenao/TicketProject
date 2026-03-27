<?php
    session_start();
    require_once __DIR__ . "/../../model/mainModel.php";
    header('Content-Type: application/json');

    $data = json_decode(file_get_contents("php://input"), true);

    $user = $data['userName'] ?? '';
    $pass = $data['password'] ?? '';

    
    if($user == '' || $pass == ''){
        echo json_encode([
            "status" => "error",
            "message" => "Values are empty",
            "code" => 2
        ]);
        exit;
    }
    
    $model = new mainModel();
    $res = $model->getData("usuarios",['username','password'], 'username = ?;',[$user]);
    if(!isset($res)){
        echo json_encode([
            "status" => "error",
            "message" => "Wrong Credentials: ",
            "code" => 1,
            "array" => $res
        ]);
    }
    
    
    $hash = $res[0]['password'];

    if(password_verify($pass,$hash)){
        echo json_encode([
            "status" => "ok",
            "message" => "Welcome",
            "code" => 0
        ]);
        $_SESSION["user"] = $user;
        $_SESSION["login"] = true;
        session_regenerate_id(true);
    }else{
        echo json_encode([
            "status" => "error",
            "message" => "Wrong Credentials: ",
            "code" => 1,
            "array" => $res
        ]);
    }
