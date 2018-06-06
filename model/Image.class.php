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
     * @var int             The event
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

        parent::__construct( $values[ 'id']);
        $this->_image= $values[ 'image'];
     
    }

    /**
     * Get the value of id
     * 
     * @return int                      The id value
     */ 
    public function get_id()
    {
        return $this->_id;
    }

    /**
     * Set the value of id
     *
     * @param   int|null     $id         The id value
     * @return  self
     */ 
    public function set_id( ?int $id)
    {
        $this->_id = $id;

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