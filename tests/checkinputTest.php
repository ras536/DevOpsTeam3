<?php
require_once "./app/php/weatherapp.php";

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

    public function testfix_string(){
        $this->assertEquals("Stuff",fix_string("<h>Stuff</h>"));
    }

    public function testmysql_fix_string(){
        $this->assertEquals(" ",testmysql_fix_string("drop tables;"));
    }

}

?>
