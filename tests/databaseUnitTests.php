<?php
require_once "../app/php/weatherapp.php";
require_once '../app/php/loginDevOps.php';
use PHPUnit\Framework\TestCase;

final class DatabaseTest extends TestCase
{

    public function testdbCreateUser()
    {
        
        //$c = new mysqli($hn, $un, $pw, $db);
        $c = new mysqli("104.197.171.13", "root", "qwqwqwopl3", "devopsteam3");
        if ($c-> connect_error) die($c->connect_error);
        
        //create testing table
        $q = "drop table if exists usersTest;" 
                . "create table usersTest(username varchar(30),password varchar(120),email varchar(120),location varchar(120), primary key (username) );";
        
        $r = $c->query($q);
        if(!$r) die($c->error);
        
        dbCreateUser('usernametest', 'passwordtest', 'emailtest', 'locationtest', "104.197.171.13", "root", "qwqwqwopl3", "devopsteam3");
        
        $q = "select * from usersTest where username = 'usernametest';";
        $r = $c->query($q);
        if(!$r) die($c->error);
        
        $r->data_seek(0);
        $row = $r->fetch_array(MYSQLI_ASSOC);
        
        $this->assertEquals('usernametest', $row['username']);
        $this->assertEquals('passwordtest', $row['password']);
        $this->assertEquals('emailtest', $row['email']);
        $this->assertEquals('locationtest', $row['location']);
        
        $q = "drop table if exists usersTest;";
        $r = $c->query($q);
        if(!$r) die($c->error);
    }
}
?>
