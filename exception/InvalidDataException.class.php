<?php

namespace AmfFam\MendiakGarbi\Exception;

use AmfFam\MendiakGarbi\Exception\ApplicationException    as ApplicationException;

/**
 * The class InvalidDataException
 * 
 * @author Javier Urrutia
 * 
 */

class InvalidDataException extends ApplicationException {

    /**
     * @var string              The variable name
     */
    protected $_varname;

    /**
     * @var mixed               The value
     */
    protected $_value;
    
    /**
     * The constructor.
     * 
     * @param  array $options   The values
     * 
     * @return void   
     */
    public function __construct( array $values=[]) {

        if( empty( $values)) return;

        parent::__construct( $values[ 'message']);

        $this->_varname = $values[ 'varname'] ?? null;
        $this->_value   = $values[ 'value'] ?? null;

    }

    /**
     * Get the variable name
     *
     * @return  string                  The variable name
     */ 
    public function get_varname()
    {
        return $this->_varname;
    }

    /**
     * Set the variable name
     *
     * @param  string  $varname         The variable name
     *
     * @return  self
     */ 
    public function set_varname(string $varname)
    {
        $this->_varname = $varname;

        return $this;
    }

    /**
     * Get the value
     *
     * @return  mixed                   The value
     */ 
    public function get_value()
    {
        return $this->_value;
    }

    /**
     * Set the value
     *
     * @param  mixed  $value            The value
     *
     * @return  self
     */ 
    public function set_value( $value)
    {
        $this->_value = $value;

        return $this;
    }

    /**
     * Get the exception in JSON Format
     * 
     * @return string                   A JSON object
     */
    public function toJSON()
    {

        return json_encode( [
            'message' => $this->get_message(),
            'varname' => $this->get_varname(),
            'value'   => $this->get_value()
        ]);

    }


}

?>