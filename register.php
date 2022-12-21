<?php 
include_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    $fname= $data->firstname;
    $lname= $data->lastname;
    $uname = $data->username;
    $pass = $data->password;

    // hash password
    $hashed = password_hash($pass, PASSWORD_DEFAULT);

    
    $sql = $koneksi->query("INSERT INTO users (firstname, lastname, username, password) VALUES ('$fname', '$lname', '$uname', '$hashed')");

    if($sql){
        http_response_code(201);
        echo json_encode(array("message" => "User was created."));
    }else{
        http_response_code(500);
        echo json_encode(array("message" => "Unable to create user."));
    }
}else{
    http_response_code(404);
}

?>