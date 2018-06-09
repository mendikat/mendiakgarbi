<?php

namespace AmfFam\MendiakGarbi\DAO;

/** Required Models */
use AmfFam\MendiakGarbi\Model\Type      as Type;

/** Required DAO */
use AmfFam\MendiakGarbi\DAO\AbstractDAO as AbstractDAO;

/**
 *  The class TypeDAO
 * 
 *  @author Javier Urrutia
 */
class TypeDAO extends AbstractDAO {

    /** 
     *  The table constant
     */
    private const TABLE  = 'mg_types';
    
    /** 
     *  The entity class constant 
     */
    private const ENTITY = 'AmfFam\MendiakGarbi\Model\Type';

    /**
     * The Constructor
     */
    public function __construct() {
        
        parent::__construct( self::TABLE, self::ENTITY);
  
    }

    /**
     * Find the type by id
     * 
     * @param   int   $id                            The type id
     * @return  AmfFma\MendiakGarbi\Model\Type       The type
     */
    public function findById( int $id) {

        $pdo= $this->get_pdo();

        $sql= 'select * from '.$this->get_table().' where id= :id';

        $result= $pdo->first( $sql, [ ':id' => $id]);
    
        $type = new Type( [
            'id'             => $result->id,
            'nameES'         => $result->nameES,
            'nameEU'         => $result->nameEU
        ]);

        return $type;

    }

    /**
     * Get all types
     * 
     * @return  \AmfFma\MendiakGarbi\Model\Type       The type
     */
    public function findAll() {

        $pdo= $this->get_pdo();

        $sql= 'select * from '.$this->get_table();

        $result= $pdo->fetch( $sql);

        $types=[];
        foreach( $result as $row) {
            $types[] = new Type( [
                'id'             => $row->id,
                'nameES'         => utf8_encode( $row->nameES),
                'nameEU'         => utf8_encode( $row->nameEU)
            ]);
        }

        return $types;

    }


}

?>