<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$host='localhost';
$db='api_test_db';
$user='root';
$password='Hijabi01!';

$conn= new mysqli($host, $user, $password, $db);

if($conn -> connect_error){
    die(json_encode(["error" => "Connection failed"]));

}

$method= $_SERVER['REQUEST_METHOD'];

switch($method){

    case'GET':
        if(isset($_GET['id'])){
            $id= $_GET['id'];
            $result= $conn -> query("SELECT * FROM users WHERE id=$id");
            echo json_encode($result -> fetch_assoc());
        }else{
            $result= $conn -> query("SELECT * FROM users");
            $users= [];
            while($row = $result -> fetch_assoc()){
                $users[]= $row;
            }
            echo json_encode($users);
        }
        break;

        case 'POST':
            $data= json_decode(file_get_contents("php://input"), true);
            $name= $conn-> real_escape_string($data['name']);
            $email= $conn-> real_escape_string($data['email']);
             $conn->query("INSERT INTO users (name, email) VALUES ('$name', '$email')");
             echo json_encode(["Message"=> "User created"]);
        break;
        case 'PUT':
            $data= json_decode(file_get_contents("php://input"), true);
            $id= $data['id'];
            $name= $conn-> real_escape_string($data['name']);
            $email= $conn->real_escape_string($data['email']);
            
            $conn ->query("UPDATE users SET name='$name', email='$email' WHERE id=$id");
            echo json_encode(["Message" => "User Updated"]);
        break;

        case 'DELETE':
            $id= $_GET['id'];
            $conn-> query("DELETE FROM users WHERE id=$id");
            echo json_encode(["message" => "User deleted"]);
            break;

            default:
            echo jscon_decode(["error"=> "Invalid request"]);
            break;
}

$conn->close();
?>