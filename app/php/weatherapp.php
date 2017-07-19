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
        //echo 'fail';
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

function dbDeleteUser($username, $hn, $un, $pw, $db)
{
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection -> connect_error) die($connection->connect_error);
    
    $q = "delete from users where username = '$username';";
    
    $r = $connection->query($q);
    if(!$r) return 0;
    return 1;

}

function dbEditLocation($username, $location, $hn, $un, $pw, $db)
{
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection -> connect_error) die($connection->connect_error);
    
    if (dbGetUser($username, $hn, $un, $pw, $db) == 0) return 0;
    
    $q = "update users set location = '$location' where username = '$username';";
    
    $r = $connection->query($q);
    return 1;
}

function createAccount($username, $password, $email, $location, $hn, $un, $pw, $db)
{
    require_once "weatherapp.php";
    
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection -> connect_error) die($connection->connect_error);
    
    $u = fix_string($connection, trim($username));
    $p = fix_string($connection, trim($password));
    $e = fix_string($connection, trim($email));
    $l = fix_string($connection, trim($location));
    
    if(!checkUsername($u))
    {
        return "A username must be entered with 5-30 characters consisting only of upper/lowercase letters, numbers, '@', and underscores.";
    }
    if(!checkPassword($p))
    {
        return "A password must be entered with 8-120 characters consisting only of upper/lowercase letters, numbers, '@', '!', '-', and underscores.";
    }
    if(!checkEmail($e))
    {
        return "A valid email must be entered.";
    }
    if(!checkLocation($l))
    {
        return "A valid location with both city and state must be selected.";
    }
    
    dbCreateUser($u, $p, $e, $l, $hn, $un, $pw, $db);
    return 1;
    
}

function checkUsername($username)
{
    $check = preg_match("/^[a-zA-Z0-9_@]*$/", $username);
    $len = strlen($username);
    if($check && $len >= 5 && $len <= 30) return true;
    else return false;
    
}

function checkPassword($password)
{
    $check = preg_match("/^[a-zA-Z0-9_!-@]*$/", $password);
    $len = strlen($password);
    if($check && $len >= 8 && $len <=120) return true;
    else return false;
}

function checkEmail($email)
{
    $check = filter_var($email, FILTER_VALIDATE_EMAIL);
    $len = strlen($email);
    if($check && $len <=120) return true;
    else return false;
}

function checkLocation($location)
{
    $check = preg_match("/^[a-zA-Z0-9_!-@.,]*$/", $location);
    $len = strlen($location);
    if($check && $len <=120 && $len >= 4) return true;
    else return false;
}

function fix_string($connection, $string)
{
    return htmlentities(mysql_fix_string($connection, $string));
}

function mysql_fix_string($connection, $string)
{
    if(get_magic_quotes_gpc()) $string = stripslashes($string);
    return $connection->real_escape_string($string);
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
