<?php


namespace AmfFam\MendiakGarbi\Util;

use AmfFam\MendiakGarbi\Util\SimpleValidator as SimpleValidator;
use AmfFam\MendiakGarbi\Util\Validator       as Validator;

use AmfFam\MendiakGarbi\Exception\InvalidDataException as InvalidDataException;

/**
 * The class IntegerValidator
 * 
 * @author Javier Urrutia
 * 
 */
 class IntegerValidator extends SimpleValidator implements Validator {

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
     *                                      min     => Min value 
     *                                      max     => Max value
     *                                      default => Default value
     * @return void
     * 
     */
    public function __construct( array $options=[]) {

        parent::__construct(  $options[ 'default'] ?? null );

        $this->_min   = $options[ 'min'] ?? PHP_INT_MIN;
        $this->_max   = $options[ 'max'] ?? PHP_INT_MAX;
    
    }

    /**
     * Validate integer values
     *
     *  @param  mixed  $value            The value
     *  
     *  @return mixed                    The value
     */
    public function validate( $value) {

        if( filter_var( $value, FILTER_VALIDATE_INT) === false)
            throw new InvalidDataException( [
                'message' => 'The value '.$value. ' must be integer.',
                'value'   => $value
            ]);    
        
        if ( $value < $this->_min || $value > $this->_max )
            throw new InvalidDataException( [
                'message' => 'The Value '.$value. 'out of range ['.$this->_min.', '.$this->_max.'].',
                'value'   => $value
            ]);    
            
        return !$value ? $this->get_default() : $value;   

    }
    
}   

?>