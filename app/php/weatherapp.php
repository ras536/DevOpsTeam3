<?php
//require_once "SQL_Testing_cred.php";
require_once "SQL_Gcloud_cred.php";
require_once "functions.php";

if(isset($_GET['user_login'])){
    if($_GET['user_login'] == "true"){
        $user = $_GET['user'];
        $pass = $_GET['pass'];
        $loc = loginFunction($user,$pass,$hn,$un,$pw,$db);
        echo $loc;
    }
}

if(isset($_GET['pageStart'])){
    if($_GET['pageStart'] == "true"){
        $result = pageStart();
        echo $result;
    } 
}

if(isset($_POST['createUser'])){
    if($_POST['createUser'] == "true"){
        $user = $_POST['user']; 
        $pass = $_POST['pass'];
        $loc  = $_POST['loc'];
        $email = $_POST['email_address'];
        $output = dbCreateUser($user,$pass,$email,$loc,$hn,$un,$pw,$db);
        echo $output;
    }
}

if(isset($_POST['editLocation'])){
    if($_POST['editLocation'] == "true"){
        $user = $_POST['user']; 
        $loc  = $_POST['loc'];
        $output = dbEditLocation($user,$loc,$hn,$un,$pw,$db);
        echo $output;
    }
}
if(isset($_POST['logout']))
{
    if($_POST['logout'] == "true")
    {
        $r = logoutFunction();
        echo $r;
    }
}

/*
if(isset($_GET['get_username'])){
    $status = $_GET['get_username'];
    if($status == "true"){
        echo $username;
    }
}

//Return Location upon request
if(isset($_GET['get_location'])){
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
 */

?>
