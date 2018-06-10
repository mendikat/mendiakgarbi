<?php

namespace AmfFam\MendiakGarbi\Util;

use AmfFam\MendiakGarbi\Util\SimpleValidator as SimpleValidator;
use AmfFam\MendiakGarbi\Util\Validator       as Validator;

use AmfFam\MendiakGarbi\Exception\InvalidDataException as InvalidDataException;

/**
 * The class FloatValidator
 * 
 * @author Javier Urrutia
 * 
 */
 class FloatValidator extends SimpleValidator implements Validator {

    /**
     * @var int         The min value
     */
    protected $_min;

    /**
     * @var int         The max value
     */
    protected $_max;

    /**
     *  The construct
     * 
     * @param  array     $options        An array of options
     * 
     * @return void
     * 
     */
    public function __construct( array $options=[]) {

        parent::__construct(  $options[ 'default'] ?? null );

        $this->_min   = $options[ 'min'];
        $this->_max   = $options[ 'max'];
    
    }

    /**
     * Validate float values
     *
     *  @param  mixed  $value            The value
     *  
     *  @return mixed                    The value
     */
    public function validate( $value) {

        if( filter_var( $value, FILTER_VALIDATE_FLOAT) === false)
            throw new InvalidDataException( [
                'message' => 'Value. '.$value. ' must be a float.',
                'value'   => $value
            ]);    
        
        if ( $value < $this->_min || $value > $this->_max )
            throw new InvalidDataException( [
                'message' => 'Value. '.$value. ' out of range ('.$this->_min.','.$this->_max.').',
                'value'   => $value
            ]);    
            
        return !$value ? $this->get_default() : $value;   

    }
    
}   

?>