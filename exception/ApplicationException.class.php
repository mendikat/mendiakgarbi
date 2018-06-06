<?php

namespace AmfFam\MendiakGarbi\Exception;

/**
 * The class ApplicationException
 * 
 * @author Javier Urrutia
 * 
 */
class ApplicationException extends \Exception implements JSONSerializableException {

    /**
     * @var string          The message
     */
    protected $_message;

    /**
     * The constructor.
     * 
     * @param  string   $message            The message
     * 
     * @return void
     */
    public function __construct( string $message) {

        $this->_message= $message;
    }
    
    /**
     * Serialize the exception to JSON
     * 
     * @return string                       A JSON object 
     */
    public function toJSON() {

        return json_encode( [
            'message' => $this->getMessage()
        ]);

    }

    /**
     * Get the message
     *
     * @return  string             The message
     */ 
    public function get_message()
    {
        return $this->_message;
    }

    /**
     * Set the message
     *
     * @param  string  $_message  The message
     *
     * @return  self
     */ 
    public function set_message( string $message)
    {
        $this->_message = $message;

        return $this;
    }
}

?>