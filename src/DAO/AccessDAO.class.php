<?php

namespace AmfFam\MendiakGarbi\DAO;

/** Required DAO */
use AmfFam\MendiakGarbi\DAO\AbstractDAO as AbstractDAO;

/**
 *  The class AccessDAO
 * 
 *  @author Javier Urrutia
 */
class AccessDAO extends AbstractDAO {

    /** 
     *  The table constant
     */
    const TABLE  = 'mg_access';
    
    /** 
     *  The entity class constant 
     */
    const ENTITY = 'AmfFam\MendiakGarbi\Model\Access';

    /**
     * The Constructor
     */
    public function __construct() {
        
        parent::__construct( self::TABLE, self::ENTITY);
  
    }

    /**
     * Find the type by id
     * 
     * @param   int   $id                            The access id
     * @return  AmfFma\MendiakGarbi\Model\Access     The access
     */
    public function findById( int $id) {

        $pdo= $this->get_pdo();

        $sql= 'select * from '.self::TABLE.' where id= :id';

        $result= $pdo->first( $sql, [ ':id' => $id]);
    
        $access = new Access( [
            'id'             => $result->id,
            'access'         => $result->access
        ]);

        return $access;

    }

}

?>