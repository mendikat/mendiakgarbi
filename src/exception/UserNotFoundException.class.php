<?php

namespace AmfFam\MendiakGarbi\Exception;

use AmfFam\MendiakGarbi\Exception\ApplicationException    as ApplicationException;

/**
 * The class UserNotFoundException
 * 
 * @author Javier Urrutia
 * 
 */
class UserNotFoundException extends ApplicationException {

    /**
     * @var int         The user id
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

        parent::__construct( $values[ 'message']);
        $this->_id= $values[ 'id'];
   
    }

    /**
     * Get the user id
     *
     * @return  int         The event id
     */ 
    public function get_id()
    {
        return $this->_id;
    }

    /**
     * Set the user id
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