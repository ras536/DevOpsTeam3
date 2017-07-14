<?php
require_once './php_server_credentials';
$connection = new mysqli($hn, $un, $pw, $db):
if ($connection -> connect_error) die($connection->connect_error);

//session_start();
//
//if (isset($_SESSION['username'])) {
//    $username = $_SESSION['username'];
//}
//else die("ERROR: USERNAME MISSING FROM SESSION");

if(isset($_GET['get_username'])){
    $status = $_GET['get_username'];
    if($status == "true"){
        echo $username;
    }
}

//Return Email upon request
if(isset($_GET['get_email'])){
    $status = $_GET['get_email'];
    if($status == "true"){
        $query = "SELECT email FROM `users` WHERE username='$username';";
        $result = $connection->query($query);
        if(!$result) die($connection->error);
        $rows = $result->num_rows;
        $result->data_seek(0);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo $row['email'];
    }
}

//Return Location Array upon request
if(isset($_GET['get_locations'])){
    $status = $_GET['get_location'];
    if($status == "true"){
        $query = "SELECT location FROM `users` WHERE username='$username';";
        $result = $connection->query($query);
        if(!$result) die($connection->error);
        $rows = $result->num_rows;
        $result->data_seek(0);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo $row['location'];
    }
}

if(isset($_POST['set_email'])){
    $email_address = $_POST['set_email'];
    $query = "UPDATE users SET email='$email_address' WHERE username='$username';";
    $result = $connection->query($query);
    if(!$result) die($connection->error);
    echo "true";
}

if(isset($_POST['set_location'])){
    $location = $_POST['set_location'];
    $query = "UPDATE users SET location='$location' WHERE username='$username';";
    $result = $connection->query($query);
    if(!$result) die($connection->error);
    echo "true";
}

?>
