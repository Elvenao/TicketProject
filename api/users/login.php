<?php
    require_once __DIR__ . "/../../model/mainModel.php";
    header('Content-Type: application/json');

    $data = json_decode(file_get_contents("php://input"), true);

    $user = $data['userName'] ?? '';
    $pass = $data['password'] ?? '';
    $model = new mainModel();
    $res = $model->getData("usuarios",['username','password'], 'username = ?;',[$user]);
    $hash = $res[0]['password'];

    if($res && $res[0]['username'] == $user && password_verify($pass,$hash)){
        echo json_encode([
            "status" => "ok",
            "message" => "Login correcto"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Credenciales incorrectas: ". $res[0]['username'] . " y " . $res[0]['password'],
           
        ]);
    }
