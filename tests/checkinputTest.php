<?php
require_once "../app/php/weatherapp.php";

use PHPUnit\Framework\TestCase;

class checkinputTest extends TestCase {
    public function testcheckUsername(){
        $this->assertTrue(checkUsername("Devops1"));
        $this->assertFalse(checkUsername("st"));
        $this->assertFalse(checkUsername("stuff^$$%"));
    }
    
    public function testPassword(){
        $this->assertTrue(checkPassword("PASSWORDPASSWORD"));
        $this->assertFalse(checkPassword("1234"));
    }

}

?>
