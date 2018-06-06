<?php

namespace AmfFam\MendiakGarbi\Exception;

use AmfFam\MendiakGarbi\Exception\ApplicationException    as ApplicationException;

/**
 * The class InvalidArgumentException
 * 
 * @author Javier Urrutia
 * 
 */

class InvalidArgumentException extends ApplicationException {

    /**
     * @var string              The argument name
     */
    protected $_argument;
    
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

        $this->_argument = $values[ 'argument'];
   
    }

    /**
     * Get the argument name
     *
     * @return  string                  The argument name
     */ 
    public function get_argument()
    {
        return $this->_argument;
    }

    /**
     * Set the variable name
     *
     * @param  string  $argument         The argument name
     *
     * @return  self
     */ 
    public function set_argument(string $varname)
    {
        $this->_argument = $varname;

        return $this;
    }

    /**
     * Serialize the exception to JSON
     * 
     * @return string                       A JSON object 
     */
    public function toJSON() {

        return json_encode( [
            'message'  => $this->get_message(),
            'argument' => $this->get_argument()
        ]);

    }

}

?>