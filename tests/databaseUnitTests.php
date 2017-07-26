<?php
require_once "./app/php/functions.php";
require_once './app/php/SQL_Testing_cred.php';
use PHPUnit\Framework\TestCase;

final class DatabaseTest extends TestCase
{
    public function testloginFunction()
    {
        $hn = $GLOBALS['hnlogin'];
        $un = $GLOBALS['unlogin'];
        $pw = $GLOBALS['pwlogin'];
        $db = $GLOBALS['dblogin'];
        
        $c = new mysqli($hn, $un, $pw, $db);
        if ($c-> connect_error) die($c->connect_error);
        
        $q = "insert into users (username, password, email, location) values
            ('usernametest', 'passwordtest', 'emailtest', 'locationtest');";
        $r = $c->query($q);
        if(!$r) die($c->error);
        
        $r = loginFunction('usernametest', 'passwordtest', $hn, $un, $pw, $db);
        
        session_start();
        
        if(isset($_SESSION['username']) && isset($_SESSION['location']))
        {
            $u = $_SESSION['username'];
            $l = $_SESSION['location'];
        }
        
        $q = "delete from users where username = 'usernametest';";
        $r = $c->query($q);
        if(!$r) die($c->error);
        
        $c->close();
        session_destroy();
        
        $this->assertEquals($r, 'locationtest');
        $this->assertEquals($u, 'usernametest');
        $this->assertEquals($l, 'locationtest');
    }
    public function testpageStartSuccess()
    {
        session_start();
        $_SESSION['username'] = 'usernametest';
        $_SESSION['location'] = 'locationtest';
        
        $r = pageStart();
        
        $this->assertEquals($r, 'usernametest%locationtest');
        session_destroy();
    }
    public function testpageStartFail()
    {
        session_start();
        
        $r = pageStart();
        
        $this->assertEquals($r, 'error');
        
        session_destroy();
    }
    public function testdbCreateUser()
    {
        $hn = $GLOBALS['hnlogin'];
        $un = $GLOBALS['unlogin'];
        $pw = $GLOBALS['pwlogin'];
        $db = $GLOBALS['dblogin'];
        
        $c = new mysqli($hn, $un, $pw, $db);
        if ($c-> connect_error) die($c->connect_error);
        
        //create testing table
//        $q = "drop table if exists usersTest;"; 
//        $r = $c->query($q);
//        if(!$r) die($c->error);
        
        dbCreateUser('usernametest', 'passwordtest', 'emailtest', 'locationtest', $hn, $un, $pw, $db);
        
        $q = "select * from users where username = 'usernametest';";
        $r = $c->query($q);
        if(!$r) die($c->error);
        
        $r->data_seek(0);
        $row = $r->fetch_array(MYSQLI_ASSOC);
        
        $q = "delete from users where username = 'usernametest';";
        $r = $c->query($q);
        if(!$r) die($c->error);
		
//        $q = "drop table if exists usersTest;";
//        $r = $c->query($q);
//        if(!$r) die($c->error);
        $c->close();
        
        $this->assertEquals('usernametest', $row['username']);
        $this->assertEquals('passwordtest', $row['password']);
        $this->assertEquals('emailtest', $row['email']);
        $this->assertEquals('locationtest', $row['location']);
    }

    public function testdbGetUser()
    {
        $hn = $GLOBALS['hnlogin'];
        $un = $GLOBALS['unlogin'];
        $pw = $GLOBALS['pwlogin'];
        $db = $GLOBALS['dblogin'];
        
        $c = new mysqli($hn, $un, $pw, $db);
        if ($c-> connect_error) die($c->connect_error);
        
        //create testing table
//        $q = "drop table if exists usersTest;"; 
//        $r = $c->query($q);
//        if(!$r) die($c->error);

//        $q = "create table usersTest(username varchar(30),password varchar(120),email varchar(120),location varchar(120), primary key (username) );";
//        $r = $c->query($q);
//        if(!$r) die($c->error);
        
        $q = "insert into users (username, password, email, location) values
            ('usernametest', 'passwordtest', 'emailtest', 'locationtest');";
        $r = $c->query($q);
        if(!$r) die($c->error);
        
        $row = dbGetUser('usernametest', $hn, $un, $pw, $db);
		
//        $q = "drop table if exists usersTest;";
//        $r = $c->query($q);
//        if(!$r) die($c->error);
        $q = "delete from users where username = 'usernametest';";
        $r = $c->query($q);
        if(!$r) die($c->error);
        
        $c->close();
        
        $this->assertEquals('usernametest', $row['username']);
        $this->assertEquals('passwordtest', $row['password']);
        $this->assertEquals('emailtest', $row['email']);
        $this->assertEquals('locationtest', $row['location']);
    }

    public function testdbDeleteUser()
    {
        $hn = $GLOBALS['hnlogin'];
        $un = $GLOBALS['unlogin'];
        $pw = $GLOBALS['pwlogin'];
        $db = $GLOBALS['dblogin'];
        
        $c = new mysqli($hn, $un, $pw, $db);
        if ($c-> connect_error) die($c->connect_error);
        
        //create testing table
//        $q = "drop table if exists usersTest;"; 
//        $r = $c->query($q);
//        if(!$r) die($c->error);
//
//        $q = "create table usersTest(username varchar(30),password varchar(120),email varchar(120),location varchar(120), primary key (username) );";
//        $r = $c->query($q);
//        if(!$r) die($c->error);
        
        $q = "insert into users (username, password, email, location) values
            ('usernametest', 'passwordtest', 'emailtest', 'locationtest');";
        $r = $c->query($q);
        if(!$r) die($c->error);
        
        $n = dbDeleteUser('usernametest', $hn, $un, $pw, $db);
        
        $q = "select * from users where username = 'usernametest';";

        $r = $connection->query($q);
        if(!$r) die($c->error);
        $numrows = $r->num_rows;
        
//        $q = "drop table if exists usersTest;";
//        $r = $c->query($q);
//        if(!$r) die($c->error);
        
        $q = "delete from users where username = 'usernametest';";
        $r = $c->query($q);
        if(!$r) die($c->error);
        
        $c->close();
        
        $this->assertEquals($numrows, 0);
    }

    public function testdbEditLocation()
    {
        $hn = $GLOBALS['hnlogin'];
        $un = $GLOBALS['unlogin'];
        $pw = $GLOBALS['pwlogin'];
        $db = $GLOBALS['dblogin'];
        
        $c = new mysqli($hn, $un, $pw, $db);
        if ($c-> connect_error) die($c->connect_error);
        
        //create testing table
//        $q = "drop table if exists usersTest;"; 
//        $r = $c->query($q);
//        if(!$r) die($c->error);
//
//        $q = "create table usersTest(username varchar(30),password varchar(120),email varchar(120),location varchar(120), primary key (username) );";
//        $r = $c->query($q);
//        if(!$r) die($c->error);
        
        $q = "insert into users (username, password, email, location) values
            ('usernametest', 'passwordtest', 'emailtest', 'locationtest');";
        $r = $c->query($q);
        if(!$r) die($c->error);
        
        dbEditLocation('usernametest', 'locationchanged', $hn, $un, $pw, $db);
        
        $q = "select * from usersTest where username = 'usernametest';";
        $r = $c->query($q);
        if(!$r) die($c->error);
        
        $r->data_seek(0);
        $row = $r->fetch_array(MYSQLI_ASSOC);
		
//        $q = "drop table if exists usersTest;";
//        $r = $c->query($q);
//        if(!$r) die($c->error);
        
        $q = "delete from users where username = 'usernametest';";
        $r = $c->query($q);
        if(!$r) die($c->error);
        
        $c->close();
        
        $this->assertEquals('usernametest', $row['username']);
        $this->assertEquals('passwordtest', $row['password']);
        $this->assertEquals('emailtest', $row['email']);
        $this->assertEquals('locationchanged', $row['location']);
    }
}
?>
