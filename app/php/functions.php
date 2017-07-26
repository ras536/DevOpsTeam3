<?php

function pageStart()
{
    session_start();
    if(isset($_SESSION['username']) && isset($_SESSION['location']))
    {
        $u = $_SESSION['username'];
        $l = $_SESSION['location'];
        return "$u%$l";
    }
    else
    {
        return 0;
    }
}

function loginFunction($username, $password, $hn, $un, $pw, $db)
{
    $r = dbGetUser($username, $hn, $un, Spw, $db);
    
    if($r == 0) return 0;
    
    if($password == $r['password'])
    {
        session_start();
        $_SESSION['username'] = $r['username'];
        $_SESSION['location'] = $r['location'];
        
        return $r['location'];
    }
}

function logoutFunction()
{
    session_start();
    session_destroy();
    return 1;
    
}

function dbCreateUser($username, $password, $email, $location, $hn, $un, $pw, $db)
{
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection -> connect_error) return ($connection->connect_error);

    if(dbGetUser($username, $hn, $un, $pw, $db) != 0)
    {
        //echo 'fail';
        $connection->close();
        return;
    };

    $q = "insert into users (username, password, email, location) values
            ('$username', '$password', '$email', '$location');";

    $r = $connection->query($q);

    if(!$r) return ($connection->error);
    $connection->close();
    return $r;
}

function dbGetUser($username, $hn, $un, $pw, $db)
{
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection -> connect_error) die($connection->connect_error);

    $q = "select * from users where username = '$username';";

    $r = $connection->query($q);
    $connection->close();
    if(!$r) return 0;
    if($r->num_rows == 0) return 0;
    $r->data_seek(0);
    $row = $r->fetch_array(MYSQLI_ASSOC);
    //$connection->close();
    return $row;
}

function dbDeleteUser($username, $hn, $un, $pw, $db)
{
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection -> connect_error) die($connection->connect_error);
    
    $q = "delete from users where username = '$username';";
    
    $r = $connection->query($q);
    $connection->close();
    if(!$r) return 0;
    return 1;

}


function dbEditLocation($username, $location, $hn, $un, $pw, $db)
{
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection -> connect_error) die($connection->connect_error);
    
    if (dbGetUser($username, $hn, $un, $pw, $db) == 0)
    {
        $connection->close();
        return 0;
    }
    $q = "update users set location = '$location' where username = '$username';";
    
    $r = $connection->query($q);
    $connection->close();
    return 1;
}

function createAccount($username, $password, $email, $location, $hn, $un, $pw, $db)
{
    require_once "function.php";
    
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

//Strips string of mysql stuff then html stuff
function fix_string($connection, $string)
{
    return htmlentities(mysql_fix_string($connection, $string));
}

function mysql_fix_string($connection, $string)
{
    if(get_magic_quotes_gpc()) $string = stripslashes($string);
    return $connection->real_escape_string($string);
}

?>
