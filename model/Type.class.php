<?php

namespace AmfFam\MendiakGarbi\Model;

use AmfFam\MendiakGarbi\Model\Entity as Entity;

/**
 * The class Type
 * 
 * @author Javier Urrutia
 */
class Type extends Entity {

    /**
     * @var string            The name (ES)
     */
    protected $_nameES;

    /**
     * @var string            The name (EU)
     */
    protected $_nameEU;


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
        $this->_nameES= $values[ 'nameES'];
        $this->_nameEU $values[ 'nameEU'];

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
     * Get the name (ES)
     * 
     * @return string                   The name (ES)
     */ 
    public function get_nameES()
    {
        return $this->_nameES;
    }

    /**
     * Set the name (ES)
     *
     * @param   string  $name           The name (ES)
     * 
     * @return  self
     */ 
    public function set_name( string $nameES)
    {
        $this->_nameES = $nameES;

        return $this;
    }

    /**
     * Get the name (EU)
     * 
     * @return string                   The name (EU)
     */ 
    public function get_nameEU()
    {
        return $this->_nameEU;
    }

    /**
     * Set the name (EU)
     *
     * @return  self
     */ 
    public function set_nameEU( string $nameEU)
    {
        $this->_nameEU = $nameEU;

        return $this;
    }


    /**
     * The toString method
     * 
     * @return string                     A string
     */
    public function __toString() {

        return '#' . $this->_id. ' : ' . $this->_nameES. ' ' . $this->_nameEU;

    }

}

?>