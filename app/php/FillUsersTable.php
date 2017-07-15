
<?php

	echo "wtf";

	//require_once "loginDevOps.php";
	require_once "weatherapp.php";
	require_once "loginDevOps.php";
	
	//$conn = new mysqli($hn, $un, $pw, $db);
	//if ($conn->connect_error) die($conn->connect_error);
	//else echo "Success";

	dbCreateUser("user1", "password1", "email1@gmail.com", "location1",
	$hn, $un, $pw, $db);
	dbCreateUser("user2", "password2", "email2@gmail.com", "location2",
	$hn, $un, $pw, $db);
	dbCreateUser("user3", "password3", "email3@gmail.com", "location3",
	$hn, $un, $pw, $db);

	echo "Sucess and stuff";
	
?>
