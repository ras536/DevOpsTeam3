<?php
//require_once "loginDevOps.php";



/*if(isset($_GET['get_username'])){
    $status = $_GET['get_username'];
    if($status == "true"){
        echo $username;
    }
}*/

//Return Email upon request

function dbCreateUser($username, $password, $email, $location, $hn, $un, $pw, $db)
{
	$connection = new mysqli($hn, $un, $pw, $db);
	if ($connection -> connect_error) die($connection->connect_error);

	if(dbGetUser($username, $hn, $un, $pw, $db) != 0)
	{
		echo 'fail';
		return;
	};
	
	$q = "insert into users (username, password, email, location) values
		('$username', '$password', '$email', '$location');";
	
	$r = $connection->query($q);

	if(!$r) die ($connection->error);
	return $r;
}

function dbGetUser($username, $hn, $un, $pw, $db)
{
	$connection = new mysqli($hn, $un, $pw, $db);
	if ($connection -> connect_error) die($connection->connect_error);

	$q = "select * from users where username = '$username';";
	
	$r = $connection->query($q);
	if(!$r) return 0;
	if($r->num_rows == 0) return 0;
	$r->data_seek(0);
	$row = $r->fetch_array(MYSQLI_ASSOC);
	return $row;
}
/*
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
