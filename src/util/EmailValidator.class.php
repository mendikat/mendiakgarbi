<?php


namespace AmfFam\MendiakGarbi\Util;

use AmfFam\MendiakGarbi\Util\StringValidator as StringValidator;
use AmfFam\MendiakGarbi\Util\Validator       as Validator;

use AmfFam\MendiakGarbi\Exception\InvalidDataException as InvalidDataException;

/**
 * The class StringValidator
 * 
 * @author Javier Urrutia
 * 
 */
 class EmailValidator extends StringValidator implements Validator {

    /**
     *  The construct
     * 
     * @param  array     $options        An array of options
     * 
     * @return void
     * 
     */
    public function __construct( array $options=[]) {

        parent::__construct(  $options);
      
      
    }

    /**
     * Validate email values
     *
     *  @param  mixed  $value            The value
     *  
     *  @return mixed                    The value
     */
    public function validate( $value) {

        parent::validate( $value);

        if ( ! filter_var( $value, FILTER_VALIDATE_EMAIL))
            throw new InvalidDataException( [
                'message' => 'Invalid value. '.$value. ' is not a valid email address',
                'value'    => $value
            ]);
            
        return !$value ? $this->get_default() : $value;   

    }
    
}   

?>