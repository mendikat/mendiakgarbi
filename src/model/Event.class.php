<?php

namespace AmfFam\MendiakGarbi\Model;

use AmfFam\MendiakGarbi\Model\Entity as Entity;

use AmfFam\MendiakGarbi\Model\Status as Status;
use AmfFam\MendiakGarbi\Model\User   as User;
use AmfFam\MendiakGarbi\Model\Type   as Type;

/**
 * The class Event
 * 
 * @author Javier Urrutia
 */
class Event extends Entity {

    /**
     * @var string                                     The name
     */
    protected $_name;

    /**
     * @var string                                     The description
     */
    protected $_description;

    /**
     * @var \DateTime                                  The creation date
     */
    protected $_date_c;

    /**
     * @var \DateTime                                  The modification date
     */
    protected $_date_m;    

     /**
     * @var AmfFam\MendiakGarbi\Model\User             The user
     */   
    protected $_user;
    
     /**
     * @var AmfFam\MendiakGarbi\Model\Type             The event type
     */
    protected $_type;

    /**
     * @var AmfFam\MendiakGarbi\Model\Status           The event status
     */
    protected $_status;

    /**
     * @var double                                     The ETRS89 latitude
     */
    protected $_lat;
   
    /**
     * @var double                                     The ETRS89 longitude
     */
    protected $_lng;
  
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
        $this->_name= $values[ 'name'];
        $this->_description= $values[ 'description'];  
        $this->_date_c= $values[ 'date_c'] ?? new \DateTime;
        $this->_date_m= $values[ 'date_m'] ?? new \DateTime;
        $this->_user= $values[ 'user'];
        $this->_type= $values[ 'type'];
        $this->_status= $values[ 'status'] ?? 1;
        $this->_lat= $values[ 'lat'] ?? null;
        $this->_lng= $values[ 'lng'] ?? null;

    }

    /**
     * Get the value of name
     * 
     * @return string               The name
     */ 
    public function get_name()
    {
        return $this->_name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function set_name( string $name)
    {
        $this->_name = $name;

        return $this;
    }

    /**
     * Get the description
     *
     * @return  string              The desscription
     */ 
    public function get_description()
    {
        return $this->_description;
    }

    /**
     * Set the description
     *
     * @param  string  $description  The description
     *
     * @return  self
     */ 
    public function set_description( string $description)
    {
        $this->_description = $description;

        return $this;
    }

    /**
     * Get the creation date
     *
     * @return  \DateTime           The date
     */ 
    public function get_date_c()
    {
        return $this->_date_c;
    }

    /**
     * Set the creation date
     *
     * @param  \DateTime  $date     The date
     *
     * @return  self
     */ 
    public function set_date_c( \DateTime $date)
    {
        $this->_date_c = $date;

        return $this;
    }

    /**
     * Get the modification date
     *
     * @return  \DateTime           The date
     */ 
    public function get_date_m()
    {
        return $this->_date_m;
    }

    /**
     * Set the modification date
     *
     * @param  \DateTime  $date     The date
     *
     * @return  self
     */ 
    public function set_date_m( \DateTime $date)
    {
        $this->_date_m = $date;

        return $this;
    }

    /**
     * Get the user
     * 
     * @return AmfFam\MendiakGarbi\Model\User           The user
     */ 
    public function get_user()
    {
        return $this->_user;
    }

    /**
     * Set the user
     *
     * @param   AmfFam\MendiakGarbi\Model\User  $user    The user
     * 
     * @return  self
     */ 
    public function set_user( User $user)
    {
        $this->_user = $user;

        return $this;
    }

    /**
     * Get the event type
     *
     * @return  AmfFam\MendiakGarbi\Model\Type          The event type
     */ 
    public function get_type()
    {
        return $this->_type;
    }

    /**
     * Set the event type
     *
     * @param  AmfFam\MendiakGarbi\Model\Type  $type     The event type
     *
     * @return  self
     */ 
    public function set_type( Type $type)
    {
        $this->_type = $type;

        return $this;
    }

    /**
     * Get the event status
     *
     * @return  \AmfFam\MendiakGarbi\Model\Status            The event status
     */ 
    public function get_status()
    {
        return $this->_status;
    }

    /**
     * Set the event status
     *
     * @param  \AmfFam\MendiakGarbi\Model\Status  $status    The event status
     *
     * @return  self
     */ 
    public function set_status( Status $status)
    {
        $this->_status = $status;

        return $this;
    }

    /**
     * Get the ETRS89 latitude
     *
     * @return  float              The ETRS89 latitude
     */ 
    public function get_lat()
    {
        return $this->_lat;
    }

    /**
     * Set the ETRS89 latitude
     *
     * @param  float  $lat         The ETRS89 latitude
     *
     * @return  self
     */ 
    public function set_lat( float $lat)
    {
        $this->_lat = $lat;

        return $this;
    }

    /**
     * Get the ETRS89 longitude
     *
     * @return  float              The ETRS89 longitude
     */ 
    public function get_lng()
    {
        return $this->_lng;
    }

    /**
     * Set the ETRS89 longitude
     *
     * @param  float  $lng         The ETRS89 longitude
     *
     * @return  self
     */ 
    public function set_lng( float $lng)
    {
        $this->_lng = $lng;

        return $this;
    }

    /**
     * toString method
     * 
     * @return  string              A String
     */
    public function __toString()
    {
        return '#'. $this->_id .' name= '. $this->_name . ' user= '. $this->_user .' creation date= ' . $this->_date_c->format( DATETIME_FORMAT);

    }

    /**
     * toArray method
     * 
     * @return array               An array
     */
    public function toArray() {
        
        return [
            'name'        => $this->get_name(),
            'description' => $this->get_description(),
            'date_c'      => $this->get_date_c()->format( MYSQL_DATETIME_FORMAT),
            'date_m'      => $this->get_date_m()->format( MYSQL_DATETIME_FORMAT),
            'user'        => $this->get_user()->get_id(),
            'type'        => $this->get_type(),
            'status'      => $this->get_status(),
            'lat'         => $this->get_lat(),
            'lng'         => $this->get_lng()
        ];
    
    }

}

?>