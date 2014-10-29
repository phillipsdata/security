<?php
namespace PhillipsData\Security\Storage;

/**
 * Cipher String
 *
 * Portable cipher string storage for rotation policies
 */
class CipherString
{
    private $delimiter;
    private $id;
    private $z;
    private $iv;
    
    /**
     * Initialize
     *
     * @param string $id The key policy ID
     * @param string $z The cipher text
     * @param string $iv The initialization vectory
     * @param string $delimiter The delimiter character
     */
    public function __construct($id = null, $z = null, $iv = null, $delimiter = '$')
    {
        $this->id = $id;
        $this->z = $z;
        $this->iv = $iv;
        $this->delimiter = $delimiter;
    }
    
    /**
     * Parses a cipher string
     *
     * @param string $str The cipher string
     * @param string $delimiter The delimiter used in the cipher string
     * @return CipherString
     * @throws \InvalidArgumentException
     */
    public static function parse($str, $delimiter = '$')
    {
        $parts = explode($delimiter, $str, 3);
        if (count($parts) != 3) {
            throw new \InvalidArgumentException('The $str parameter does not contain the proper delimiters.');
        }
        
        return new CipherString($parts[0], $parts[2], $parts[1], $delimiter);
    }
    
    /**
     * Returns the cipher string
     *
     * @return string The cipher string
     */
    public function __toString()
    {
        return $this->id . $this->delimiter . $this->iv . $this->delimiter . $this->z;
    }
    
    /**
     * Returns CipherString properties
     *
     * @param string $name The name of the property
     * @return mixed The property value
     * @throws \InvalidArgumentException
     */
    public function __get($name)
    {
        if (!property_exists($this, $name)) {
            throw new \InvalidArgumentException($name . ' is an invalid property.');            
        }
        return $this->$name;
    }
}
