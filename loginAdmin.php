<?php 
include_once 'koneksi.php';
require_once __DIR__ . '/vendor/autoload.php';

use \Firebase\JWT\JWT;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"));

	$uname = $data->username;
    $pass = $data->password;

    $sql = $koneksi->query("SELECT * FROM admins WHERE username = '$uname'"); 
    if ($sql->num_rows > 0) {
        $admin = $sql->fetch_assoc();
        if (password_verify($pass, $admin['password'])) {
            $key = "YOUR_SECRET_KEY";  // JWT KEY
            $payload = array(
			    'admin_id' => $admin['id'],
			    'username' => $admin['username'],
			    'firstname' => $admin['firstname'],
			    'lastname' => $admin['lastname']
            );

            $token = JWT::encode($payload, $key, 'HS256');
            http_response_code(200);
            echo json_encode(array('token' => $token));
        } else {
            http_response_code(400);
            echo json_encode(array('message' => 'Login Failed!'));
        }
    } else {
        http_response_code(400);
        echo json_encode(array('message' => 'Login Failed!'));
    }
}

?>