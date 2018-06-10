<?php

namespace AmfFam\MendiakGarbi\Model;

/**
 * The Entity class
 * 
 * @author Javier Urrutia
 */
class Entity {

    /** 
     * @var int|null     $_id          The entity id
     */
    protected $_id;

    /**
     * The constructor.
     * 
     * @param int|null       $id        The entity Id
     * 
     */
    public function __construct( $id) {
        $this->_id= $id;
    }

    /**
     * Get the value of id
     * 
     * @return int|null                 The entity id
     */ 
    public function get_id()
    {
        return $this->_id;
    }

    /**
     * Set the value of id
     *
     * @param   int|null    $id         The Entity id 
     * 
     * @return  self
     */ 
    public function set_id( $id = null)
    {
        $this->_id = $id;

        return $this;
    }

}

?>