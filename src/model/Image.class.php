<?php

namespace AmfFam\MendiakGarbi\Model;

use AmfFam\MendiakGarbi\Model\Entity as Entity;

/**
 * The class Image
 * 
 * @author Javier Urrutia
 */
class Image extends Entity {

    /**
     * @var int             The id of the event
     */
    protected $_event;

    /**
     * @var string          The image
     */
    protected $_image;

    /**
     * The constructor
     * 
     * @param   array       An array of values
     * 
     * @return void   
     */
    public function __construct( array $values=[]) {

        if( empty( $values)) return;

        parent::__construct( $values[ 'id'] ?? null);
        $this->_event= $values[ 'event'] ?? null;
        $this->_image= $values[ 'image'] ?? null;

    }

    /**
     * Get the value of event id
     * 
     * @return int                      The id of the event
     */ 
    public function get_event()
    {
        return $this->_event;
    }

    /**
     * Set the value of id
     *
     * @param   int     $event         The id of the event
     * @return  self
     */ 
    public function set_event( int $event)
    {
        $this->_event = $event;

        return $this;
    }

    /**
     * Get the image
     * 
     * @return string                   The image
     */ 
    public function get_image()
    {
        return $this->_image;
    }

    /**
     * Set the image
     *
     * @param   string  $image           The image
     * 
     * @return  self
     */ 
    public function set_image( string $image)
    {
        $this->_image = $image;

        return $this;
    }

    /**
     * The toString method
     * 
     * @return string                     A string
     */
    public function __toString() {

        return '#' . $this->_id;

    }

}

?>