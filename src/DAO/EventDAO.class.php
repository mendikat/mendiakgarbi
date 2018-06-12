<?php

namespace AmfFam\MendiakGarbi\DAO;

//** Required models */
use AmfFam\MendiakGarbi\Model\Event     as Event;
use AmfFam\MendiakGarbi\Model\Access    as Access;
use AmfFam\MendiakGarbi\Model\Hist      as Hist;

/** Required DAO */
use AmfFam\MendiakGarbi\DAO\AbstractDAO as AbstractDAO;
use AmfFam\MendiakGarbi\DAO\UserDAO     as UserDAO;
use AmfFam\MendiakGarbi\DAO\StatusDAO   as StatusDAO;
use AmfFam\MendiakGarbi\DAO\TypeDAO     as TypeDAO;
use AmfFam\MendiakGarbi\DAO\HistDAO     as HistDAO;

/** Required Exceptions */
use AmfFam\MendiakGarbi\Exception\EventNotFoundException as EventNotFoundException;

/**
 *  The class EventDAO
 * 
 *  @author Javier Urrutia
 */
class EventDAO extends AbstractDAO {

    /** 
     *  The table constant
     */
    const TABLE  = 'mg_events';
    
    /** 
     *  The entity class constant 
     */
    const ENTITY = 'AmfFam\MendiakGarbi\Model\Event';

    /**
     * The Constructor
     */
    public function __construct() {
        
        parent::__construct( self::TABLE, self::ENTITY);
      
    }

    /**
     * Get a SQL result object and get an event
     * 
     * @param  object $result                           A SQL result object
     * 
     * @return \AmfFma\MendiakGarbi\Model\Event         An event        
     */
    private static function asEvent( $result) {

        $userDAO   = new UserDAO;
        $statusDAO = new StatusDAO;
        $typeDAO   = new TypeDAO;

        $event = new Event( [
            'id'             => $result->id,
            'name'           => $result->name,
            'description'    => $result->description,
            'date_c'         => new \DateTime( $result->date_c),
            'date_m'         => new \DateTime( $result->date_m),
            'user'           => $userDAO->findById( $result->user),
            'status'         => $statusDAO->findById( $result->status),
            'type'           => $typeDAO->findById( $result->type),
            'lat'            => $result->lat,
            'lng'            => $result->lng
        ]);

        return $event;

    }

    /**
     * Find the event by id
     * 
     * @param   int   $id                            The event id
     * @return  AmfFma\MendiakGarbi\Model\Event      The event
     */
    public function findById( int $id) {

        $pdo= $this->get_pdo();

        $sql= 'select * from '.$this->get_table().' where id= :id';

        $result= $pdo->first( $sql, [ ':id' => $id]);

        if ( !$result)
            throw new EventNotFoundException( [
                'message' => 'Event not found',
                'id'      => $id
            ]);
    
        return self::asEvent( $result);

    }

    /**
     * Find events by user hash
     * 
     * @param   string  $hash                        The user hash
     * @return  array                                An array of events
     */
    public function findByUserHash( string $hash) {

        $pdo= $this->get_pdo();

        $userDAO = new UserDAO;

        // If user is Admin get all events
        if ( $userDAO->findByHash( $hash)->get_access() == Access::ADMIN) {

            $sql= 'select * from '.$this->get_table();

            $results= $pdo->fetch( $sql);

        } else {

            $sql= 'select * from '.$this->get_table().' 
                        inner join
                            mg_users
                        on
                            mg_events.user = mg_users.id     
                    where mg_users.hash= :hash';

            $results= $pdo->fetch( $sql, [ ':hash' => $hash]);      
        
        }

        $events = [];

        foreach( $results as $result)
            $events[] = self::asEvent( $result);

        return $events;

    }

    /**
     * Find events by user id
     * 
     * @param   int  $int                        The user id
     * @return  array                            An array of events
     */
    public function findByUserId( int $id) {

        $pdo= $this->get_pdo();

        $userDAO = new UserDAO;

        // If user is Admin get all events

        if ( $userDAO->findById( $id)->get_access() == Access::ADMIN) {

            $sql= 'select * from '.$this->get_table();

            $results= $pdo->fetch( $sql);
    

        } else {

            $sql= 'select * from '.$this->get_table().' where user= :user';

            $results= $pdo->fetch( $sql, [ ':user' => $id]);
    
        }
    
        $events = [];

        foreach( $results as $result)
            $events[] = self::asEvent( $result);

        return $events;

    }

    /**
     * Find all events
     * 
     * @return array                            An array of events
     * 
     */
    public function findAll() {

        $pdo= $this->get_pdo();

        $sql= 'select * from '.$this->get_table().' order by date_c desc, status asc';

        $results= $pdo->fetch( $sql);

        $events = [];

        foreach( $results as $result)
            $events[] = self::asEvent( $result);
            
        return $events;

    }

    /**
     * Returns the number of events
     * 
     * @return int                              The number of events
     */
    public function count() {

        $pdo= $this->get_pdo();

        $sql= 'select count(*) as num from '.$this->get_table();

        return $pdo->first( $sql)->num;        
    }

    /**
     * Find all events in progress ( not finished ) 
     * 
     * @return array                            An array of events
     * 
     */
    public function findInProgress() {

        $pdo= $this->get_pdo();

        $sql= 'select mg_events.* from '.$this->get_table().' 
                    inner join mg_status 
                on
                    mg_events.status = mg_status.id
                where
                    mg_status.progress < 100';

        $results= $pdo->fetch( $sql);

        $events = [];

        foreach( $results as $result)
            $events[] = self::asEvent( $result);
            
        return $events;

    }

    /**
     * Delete the event
     * 
     * @param int       $id                     The event id
     * 
     * @return void
     */
    public function delete( int $id) {

        $pdo= $this->get_pdo();

        // Delete the event and the images
        $sql = 'delete from '. $this->get_table() . ' where id= :id; delete from mg_images where event= :id';
        $pdo->execute( $sql, [ ':id' => $id]);
    
    }

     /**
     * Save the event
     * 
     * @param  \AmfFam\MendiakGarbi\Model\Event       $event             The event
     * 
     * @return int                                                       The id
     */
    public function save( Event $event) {

        $histDAO = new HistDAO;

        $pdo= $this->get_pdo();

        if ( $event->get_id()) {

            $sql = 'update '. $this->get_table() . ' set
                        name= :name,
                        description = :description,
                        date_c= :date_c,
                        date_m= :date_m,
                        user= :user,
                        type= :type,
                        status= :status,
                        lat= :lat,
                        lng= :lng
                    where id= :id';
  
            $id= $pdo->execute( $sql, [
                ':id'            => $event->get_id(),
                ':name'          => $event->get_name(),
                ':description'   => $event->get_description(),
                ':date_c'        => $event->get_date_c()->format( MYSQL_DATETIME_FORMAT),
                ':date_m'        => (new \DateTime)->format( MYSQL_DATETIME_FORMAT),
                ':user'          => $event->get_user()->get_id(),
                ':type'          => $event->get_type()->get_id(),
                ':status'        => $event->get_status()->get_id(),
                ':lat'           => $event->get_lat(),
                ':lng'           => $event->get_lng()                              
            ]);

            $hist= new Hist([
                'event'  => $event->get_id(),
                'status' => $event->get_status()->get_id()
            ]);

            $histDAO->save( $hist);            

            return $event->get_id();
        
        } else {

            $sql = 'insert into '. $this->get_table() . '( name, description, date_c, date_m, user, type, status, lat, lng) values(
                        :name, :description, :date_c, :date_m, :user, :type, :status, :lat, :lng)';

            $id= $pdo->execute( $sql, [
                ':name'          => $event->get_name(),
                ':description'   => $event->get_description(),
                ':date_c'        => $event->get_date_c() ? $event->get_date_c()->format( MYSQL_DATETIME_FORMAT) : (new \DateTime)->format( MYSQL_DATETIME_FORMAT),
                ':date_m'        => $event->get_date_m() ? $event->get_date_m()->format( MYSQL_DATETIME_FORMAT) : (new \DateTime)->format( MYSQL_DATETIME_FORMAT),
                ':user'          => $event->get_user()->get_id(),
                ':type'          => $event->get_type(),
                ':status'        => $event->get_status() ?? 3,
                ':lat'           => $event->get_lat(),
                ':lng'           => $event->get_lng()
            ]);

            $histDAO->save( new Hist([
                'event'  => $id,
                'status' => 3
            ]));

            return $id;
                                
        }


    }

}

?>