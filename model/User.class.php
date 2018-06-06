<?php

namespace AmfFam\MendiakGarbi\Model;

use AmfFam\MendiakGarbi\Model\Entity as Entity;
use AmfFam\MendiakGarbi\Model\Access as Access;

/**
 * The class User
 * 
 * @author Javier Urrutia
 */
class User extends Entity {

    /**
     * @var string            The name
     */
    protected $_name;

    /**
     * @var string            The email
     */
    protected $_email;

     /**
     * @var string            The hash value
     *                        MD5 from email
     */   
    protected $_hash;
    
     /**
     * @var int               The access type
     */
    protected $_access;

    /**
     * The constructor
     * 
     * @param   array       An array of values
     * 
     * @return void   
     */
    public function __construct( array $values=[]) {

        if( empty( $values)) return;

        parent::__construct( $values[ 'id'] ?? null);
        $this->_name= $values[ 'name'];
        $this->_email= $values[ 'email'];
        $this->_hash= $values[ 'hash'];
        $this->_access= $values[ 'access'];

    }

    /**
     * Get the value of id
     * 
     * @return int                      The id value
     */ 
    public function get_id()
    {
        return $this->_id;
    }

    /**
     * Set the value of id
     *
     * @param   int|null     $id         The id value
     * @return  self
     */ 
    public function set_id( ?int $id)
    {
        $this->_id = $id;

        return $this;
    }

    /**
     * Get the value of name
     * 
     * @return string                   The name
     */ 
    public function get_name()
    {
        return $this->_name;
    }

    /**
     * Set the value of name
     *
     * @param   string  $name           The name
     * 
     * @return  self
     */ 
    public function set_name( string $name)
    {
        $this->_name = $name;

        return $this;
    }

    /**
     * Get the value of email
     * 
     * @return string                   The email
     */ 
    public function get_email()
    {
        return $this->_email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function set_email( string $email)
    {
        $this->_email = $email;

        return $this;
    }

    /**
     * Get the value of hash
     * 
     * @return string                    The hash value
     */ 
    public function get_hash()
    {
        return $this->_hash;
    }

    /**
     * Set the value of hash
     *
     * @param string   $hash             The hash value
     * 
     * @return  self
     */ 
    public function set_hash( string $hash)
    {
        $this->_hash = $hash;

        return $this;
    }

    /**
     * Get the value of access
     * 
     * @return int                       The access value
     */ 
    public function get_access()
    {
        return $this->_access;
    }

    /**
     * Set the value of access
     *
     * @param   int     $valur           The access value   
     * @return  self
     */ 
    public function set_access( int $access)
    {
        $this->_access = $access;

        return $this;
    }

    /**
     * Returns true if user is admin
     * 
     * @return bool
     */
    public function is_admin() {

        return $this->_access == Access::ADMIN;
    }

    /**
     * The toString method
     * 
     * @return string                     A string
     */
    public function __toString() {

        return '#' . $this->_id. ' : ' . $this->_name . ' ('.$this->_email.') hash: '.$this->get_hash();

    }

}

?>