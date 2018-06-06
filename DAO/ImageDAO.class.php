<?php

namespace AmfFam\MendiakGarbi\DAO;

/** Required DAO */
use AmfFam\MendiakGarbi\DAO\AbstractDAO as AbstractDAO;

/**
 *  The class ImageDAO
 * 
 *  @author Javier Urrutia
 */
class ImageDAO extends AbstractDAO {

    /** 
     *  The table constant
     */
    private const TABLE  = 'mg_images';
    
    /** 
     *  The entity class constant 
     */
    private const ENTITY = 'AmfFam\MendiakGarbi\Model\Image';

    /**
     * The Constructor
     */
    public function __construct() {
        
        parent::__construct( self::TABLE, self::ENTITY);
  
    }

    /**
     * Find the image by id
     * 
     * @param   int   $id                            The image id
     * @return  AmfFma\MendiakGarbi\Model\Image      The image
     */
    public function findById( int $id) {

        $pdo= $this->get_pdo();

        $sql= 'select * from '.$this->get_table().' where id= :id';

        $result= $pdo->first( $sql, [ ':id' => $id]);
    
        $status = new Image( [
            'id'             => $result->id,
            'image'          => $result->image
        ]);

        return $image;

    }

    


}

?>