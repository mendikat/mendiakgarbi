<?php

namespace AmfFam\MendiakGarbi\DAO;

/** Required models */
use AmfFam\MendakGarbi\Model\Entity       as Entity;

/** The PDO connection manager  */
use AmfFam\MendiakGarbi\DAO\PDOConnection as PDOConnection;

/**
 *  The AbstractDAO class
 * 
 *  @author Javier Urrutia
 *  @abstract
 */
abstract class AbstractDAO {

    /**
     * @var string                                   $_table       The Table
     */
    protected $_table;
    
    /**
     * @var string                                   $_entity      The Entity
     */
    protected $_entity;

    /**
     * @var AmfFam\MendiakGarbi\DAO\PDOConnection   $_pdo         The PDO Connection
     */
    protected $_pdo;

    /**
     * The contructor.
     * 
     * @param string   $table          The table
     * @param string   $object         The entity
     */
    public function __construct( string $table, string $entity) {

        $this->_pdo     = PDOConnection::get();
        $this->_table   = $table;
        $this->_entityt = $entity;
    
    }

    /**
     * Get the value of table
     * 
     * @return string                  The table
     */ 
    public function get_table()
    {
        return $this->_table;
    }

    /**
     * Set the value of table
     *
     * @return  self
     */ 
    public function set_table( string $table)
    {
        $this->_table = $table;

        return $this;
    }

    /**
     * Get the value of entity
     * 
     * @return string                The entity class
     */ 
    public function get_entity()
    {
        return $this->_entity;
    }

    /**
     * Set the value of entity
     *
     * @return  self
     */ 
    public function set_entity( string $entity)
    {
        $this->_entity = $entity;

        return $this;
    }

    /**
     * Get an entity instance
     * 
     * @return AmfFam\MendakGarbi\Model\Entity             An instance of entity class
     */
    public function get_instance() {

        $class= $this->_entity;
        return new $class;
    }

    /**
     * Get PDO
     * 
     * @return  AmfFam\MendiakGarbi\DAO\PDOConnection      An PDOConnection isntaance 
     */ 
    public function get_pdo()
    {
        return $this->_pdo;
    }

    /**
     * Return the entity by id
     * 
     * @param  int      $id                               The entity id
     * 
     * @return AmfFam\MendakGarbi\Model\Entity
     */
    public abstract function findById( int $id);

}

?>