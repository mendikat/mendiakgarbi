<?php

namespace AmfFam\MendiakGarbi\Model;

use AmfFam\MendiakGarbi\Model\Entity as Entity;

/**
 * The class Access
 * 
 * @author Javier Urrutia
 */
class Access extends Entity {

    /**
     * @var int             User constant
     */
    public const USER  = 1;
    
    /**
     * @var int             Admin constant
     */
    public const ADMIN = 2;

    /**
     * @var string          The description
     */
    protected $_description;

    /**
     * The constructor
     * 
     * @param   array       An array of values
     * 
     * @return void   
     */
    public function __construct( array $values=[]) {

        if( empty( $values)) return;

        parent::__construct( $values[ 'id']);
        $this->_description= $values[ 'description'];

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
     * Get the description
     * 
     * @return string                   The description
     */ 
    public function get_description()
    {
        return $this->_description;
    }

    /**
     * Set the description
     *
     * @param   string  $description    The desxcription
     * 
     * @return  self
     */ 
    public function set_description( string $description)
    {
        $this->_description= $_description;

        return $this;
    }

    /**
     * The toString method
     * 
     * @return string                     A string
     */
    public function __toString() {

        return '#' . $this->_id. ' : ' . $this->_description;

    }

}

?>