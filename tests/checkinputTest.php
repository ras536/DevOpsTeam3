<?php
require "./app/php/functions.php";
require './app/php/SQL_Testing_cred.php';
use PHPUnit\Framework\TestCase;

class checkinputTest extends TestCase {

    public function testcheckUsername(){
        $this->assertTrue(checkUsername("Devops1"));
        $this->assertFalse(checkUsername("st"));
        $this->assertFalse(checkUsername("stuff^$$%"));
    }
    
    public function testcheckPassword(){
        $this->assertTrue(checkPassword("PASSWORDPASSWORD"));
        $this->assertFalse(checkPassword("1234"));
    }

    public function testcheckEmail(){
        $this->assertTrue(checkEmail("user@info.com"));
        $this->assertFalse(checkEmail("user.com"));
    }

    public function testcheckLocation(){
        $this->assertFalse(checkLocation("no"));
        $this->assertTrue(checkLocation("Tupelo,MS"));
    }

    public function testmysql_fix_string(){
        // Setting login credentials
        $hn = $GLOBALS['hnlogin'];
        $un = $GLOBALS['unlogin'];
        $pw = $GLOBALS['pwlogin'];
        $db = $GLOBALS['dblogin'];

        //Creating connection to database
        $c = new mysqli($hn, $un, $pw, $db);
        if ($c-> connect_error) die($c->connect_error);

        //running the test
        $this->assertEquals("\' drop tables;",mysql_fix_string($c,"' drop tables;"));
    }

    public function testfix_string(){
        // Setting login credentials
        $hn = $GLOBALS['hnlogin'];
        $un = $GLOBALS['unlogin'];
        $pw = $GLOBALS['pwlogin'];
        $db = $GLOBALS['dblogin'];

        //Creating connection to database
        $c = new mysqli("172.25.0.3", $un, $pw, $db);
        if ($c-> connect_error) die($c->connect_error);

        // Running Test
        $this->assertEquals("&lt;h&gt;Stuff&lt;/h&gt;",fix_string($c,"<h>Stuff</h>"));
    }


}

?>
