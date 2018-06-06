<?php


namespace AmfFam\MendiakGarbi\Util;

use AmfFam\MendiakGarbi\Util\SimpleValidator as SimpleValidator;
use AmfFam\MendiakGarbi\Util\Validator       as Validator;

use AmfFam\MendiakGarbi\Exception\InvalidDataException as InvalidDataException;

/**
 * The class StringValidator
 * 
 * @author Javier Urrutia
 * 
 */
 class StringValidator extends SimpleValidator implements Validator {

    /**
     * @var int         The size value
     */
    protected $_size;

     /**
     * @var bool         The nullable value
     */
    protected $_nullable;

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

        $this->_size     = $options[ 'size'] ?? null;
        $this->_nullable = $options[ 'nullable'] ?? false;
    
    }

    /**
     * Validate string values
     *
     *  @param  mixed  $value            The value
     *  
     *  @return mixed                    The value
     */
    public function validate( $value) {

        if ( !$value && !$this->_nullable )
            throw new InvalidDataExceptionException( [
                'message' => 'Invalid value. '.$value. ' must be not null.',
                'value'    => $value
            ]);
            
        if ( $this->_size && strlen( $value) > $this->_size )
           throw new InvalidDataException( [
               'message' => 'Invalid value. '.$value. ' too long. Only '.$this->_size.' characters are allowed.',
               'value'   => $value
            ]);    

        return !$value ? $this->get_default() : $value;   

    }
    
}   

?>