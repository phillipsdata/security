<?php
use PhillipsData\Security\Storage\CipherString;

/**
 * @coversDefaultClass PhillipsData\Security\Storage\CipherString
 */
class CipherStringTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     * @covers ::__get
     */
    public function test__construct()
    {
        $id = "ID";
        $z = "Z";
        $iv = "IV";
        $delimiter = "%";
        $cipher_string = new CipherString($id, $z, $iv, $delimiter);
        
        $this->assertEquals($id, $cipher_string->id);
        $this->assertEquals($z, $cipher_string->z);
        $this->assertEquals($iv, $cipher_string->iv);
        $this->assertEquals($delimiter, $cipher_string->delimiter);
    }

    /**
     * @covers ::__construct
     * @covers ::parse
     * @covers ::__get
     * @covers ::__toString
     */    
    public function testParse()
    {
        $cipher_string = new CipherString();
        $str = 'ID$IV$Z';
        $cipher_string = $cipher_string->parse($str, '$');
        
        $this->assertEquals("ID", $cipher_string->id);
        $this->assertEquals("Z", $cipher_string->z);
        $this->assertEquals("IV", $cipher_string->iv);
        $this->assertEquals("$", $cipher_string->delimiter);
        
        $this->assertEquals($str, $cipher_string->__toString());
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testParseException()
    {
        $cipher_string = new CipherString();
        $str = 'ID$IV$Z';
        $cipher_string = $cipher_string->parse($str, '%');
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function test__getException()
    {
        $cipher_string = new CipherString("ID", "Z", "IV");
        $invalid_property = $cipher_string->invalid_property;
    }
}
