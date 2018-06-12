<?php

namespace AmfFam\MendiakGarbi\DAO;

/** Required models */
use AmfFam\MendiakGarbi\Model\Status as Status;

/** Required DAO */
use AmfFam\MendiakGarbi\DAO\AbstractDAO as AbstractDAO;

/**
 *  The class StatusDAO
 * 
 *  @author Javier Urrutia
 */
class StatusDAO extends AbstractDAO {

    /** 
     *  The table constant
     */
    const TABLE  = 'mg_status';
    
    /** 
     *  The entity class constant 
     */
    const ENTITY = 'AmfFam\MendiakGarbi\Model\Status';

    /**
     * The Constructor
     */
    public function __construct() {
        
        parent::__construct( self::TABLE, self::ENTITY);
  
    }

    /**
     * Find the status by id
     * 
     * @param   int   $id                            The status id
     * @return  AmfFma\MendiakGarbi\Model\Status     The status
     */
    public function findById( int $id) {

        $pdo= $this->get_pdo();

        $sql= 'select * from '.$this->get_table().' where id= :id';

        $result= $pdo->first( $sql, [ ':id' => $id]);
    
        return self::asStatus( $result);

    }

    /**
     * Get a SQL result object and get a status
     * 
     * @param  object $result                           A SQL result object
     * 
     * @return \AmfFma\MendiakGarbi\Model\Status        A status        
     */
    private static function asStatus( $result) {

        $status = new Status( [
            'id'             => $result->id,
            'nameES'         => $result->nameES,
            'nameEU'         => $result->nameEU,
            'progress'       => $result->progress
        ]);
        
        return $status;

    }

     /**
     * Find all status
     * 
     * @return  array                                All the status
     */
    public function findAll () {

        $pdo= $this->get_pdo();

        $sql= 'select * from '.$this->get_table();

        $results= $pdo->fetch( $sql);
    
        $status= [];
        foreach( $results as $result)
            $status[] = self::asStatus( $result);

        return $status;    

    }    

    /**
     *  Get max status id
     * 
      * @return  int                                 The max id value
     */
    public function findMaxId() {

        $pdo= $this->get_pdo();

        $sql= 'select max(id) as max_id from '.$this->get_table();

        $result= $pdo->first( $sql);
    
        return $result->max_id;

    }


}

?>