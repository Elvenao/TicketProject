<?php
    require_once __DIR__ . "/../../model/mainModel.php";
    header('Content-Type: application/json');

    $data = json_decode(file_get_contents("php://input"), true);
    $options = [
        'memory_cost' => 1 << 18, 
        'time_cost'   => 8,       
        'threads'     => 2        
    ];
    $user = $data['userName'] ?? '';
    $pass = $data['password'] ?? '';
    $name = $data['name'] ?? '';
    $email = $data['email'] ?? '';
    $model = new mainModel();
    $pass = password_hash($pass,PASSWORD_ARGON2ID,$options);
    $lastId = $model->insertData("usuarios",['name','username','password','email'], [$name,$user,$pass,$email]);

    if($lastId){
        echo json_encode([
            "status" => "ok",
            "message" => "SignUp correcto $lastId"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "No fue posible hacer el registro"
           
        ]);
    }
