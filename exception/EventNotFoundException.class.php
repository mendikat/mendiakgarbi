<?php

namespace AmfFam\MendiakGarbi\Exception;

/**
 * The class EventNotFoundException
 * 
 * @author Javier Urrutia
 * 
 */
class EventNotFoundException extends ApplicationException implements JSONSerializableException {

    /**
     * @var int         The event id
     */
    protected $_id;

    /**
     * The constructor.
     * 
     * @param  array $options   The values
     * 
     * @return void   
     */
    public function __construct( array $values=[]) {

        if( empty( $values)) return;

        $this->_message = $values[ 'message'];
        $this->_id= $values[ 'id'];
   
    }

    /**
     * Get the event id
     *
     * @return  int         The event id
     */ 
    public function get_id()
    {
        return $this->_id;
    }

    /**
     * Set the event id
     *
     * @param  int  $id     The event id
     *
     * @return  self
     */ 
    public function set_id(int $id)
    {
        $this->_id = $id;

        return $this;
    }

    /**
     * Serialize the exception to JSON
     * 
     * @return string                       A JSON object 
     */
    public function toJSON() {

        return json_encode( [
            'message' => $this->get_message(),
            'id'      => $this->get_id()
        ]);

    }
}

?>