<?php

namespace AmfFam\MendiakGarbi\Util;

/**
 * The SimpleValicator class
 * 
 * @author Javier Urrutia
 * 
 */
class SimpleValidator {

    /**
     * @var mixed           The value
     */
    protected $_default;

    /**
     * The constructor.
     * 
     * @param mixed  $default       The deafult value
     */
    protected function __construct( $default = null) {

        $this->_default= $default;
    } 

    /**
     * Get the default value
     *
     * @return  mixed               The deafult value
     */ 
    public function get_default()
    {
        return $this->_default;
    }

    /**
     * Set the default value
     *
     * @param  mixed  $default      The default value
     *
     * @return  self
     */ 
    public function set_default( $default)
    {
        $this->_default = $default;

        return $this;
    }

}

?>