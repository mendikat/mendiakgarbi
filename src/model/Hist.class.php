<?php

namespace AmfFam\MendiakGarbi\Model;

use AmfFam\MendiakGarbi\Model\Entity as Entity;

/**
 * The class Hist
 * An historial for the events
 * 
 * @author Javier Urrutia
 */
class Hist extends Entity {

    /**
     * @var int                 The event id
     */

    protected $_event;

    /**
     * @var int                 The status
     */
    protected $_status;

    /**
     * @var \DateTime           The date
     */
    protected $_date;

    /**
     * @var string              The description
     */
    protected $_text;


    /**
     * The constructor.
     * 
     * @param  array $values     The values
     * 
     * @return void
     */
    public function __construct( array $values= []) {

        parent::__construct( $values[ 'id'] ?? null );
    
        $this->_event  = $values[ 'event'];
        $this->_status = $values[ 'status'];           
        $this->_date   = $values[ 'date'] ?? new \DateTime;
        $this->_text   = $values[ 'text'] ?? null;
  
    }

    /**
     * Get the value of event
     * 
     * @return void
     */ 
    public function get_event()
    {
        return $this->_event;
    }

    /**
     * Set the value of event
     * 
     * @param  int              The event
     *
     * @return  self
     */ 
    public function set_event( int $event)
    {
        $this->_event = $event;

        return $this;
    }

    /**
     * Get the date
     *
     * @return  \DateTime
     */ 
    public function get_date()
    {
        return $this->_date;
    }

    /**
     * Set the date
     *
     * @param  \DateTime  $date   The date
     *
     * @return  self
     */ 
    public function set_date( \DateTime $date)
    {
        $this->_date = $date;

        return $this;
    }

    /**
     * Get the description
     *
     * @return  string
     */ 
    public function get_text()
    {
        return $this->_text;
    }

    /**
     * Set the description
     *
     * @param  string  $text      The description
     *
     * @return  self
     */ 
    public function set_text( string $text)
    {
        $this->_text = $text;

        return $this;
    }

    /**
     * Get the status
     *
     * @return  int                The status
     */ 
    public function get_status()
    {
        return $this->_status;
    }

    /**
     * Set the status
     *
     * @param  int  $status         The status
     *
     * @return  self
     */ 
    public function set_status(int $status)
    {
        $this->_status = $status;

        return $this;
    }

    /**
     * The toString method.
     * 
     * @return string               A string
     */
    public function __toString() {

        return '#'. $this->get_id(). ' event= ' . $this->get_event(). ' status= '.$this->get_status(). ' @ '. $this->get_date()->format( DATETIME_FORMAT);
    }
}