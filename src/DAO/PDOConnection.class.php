<?php

namespace AmfFam\MendiakGarbi\DAO;

/**
 * The class PDOConnection
 * Is a Singleton
 * 
 * @author Javier Urrutia
 */
class PDOConnection {

    /**
     *  BBDD Connection configuration
     * 
     *  Constants
     */
    const TYPE       = DB_TYPE;
    const HOST       = DB_HOST;
    const DBNAME     = DB_NAME;
    const USERNAME   = DB_USERNAME;
    const PASSWORD   = DB_PASSWORD;
    const CHARSET    = DB_CHARSET;
    const DSN        = self::TYPE . ':host=' . self::HOST . ';dbname=' . self::DBNAME . ';charset=' . self::CHARSET;

    /**
     * A singleton instance
     * 
     * @var self 
     */
    protected static $_instance = null;

    /**
     * Returns singleton instance of this class
     * 
     * @return self
     */
    public static function get() {
        
        if ( !isset( self::$_instance ) ) {
            
            self::$_instance = new PDOConnection();

        }
        
        return self::$_instance;
    }
    
    /**
     * Hide constructor, protected so only subclasses and self can use
     * 
     * @return void
     */
    protected function __construct() {}
        
    /**
     * Return a PDO connection using the dsn and credentials provided
     * 
     * @return \PDO                         Returns connection to the database
     * 
     * @throws \PDOException
     * @throws \Exception
     */
    public function getConnection() {
        
        $conn = null;

        try {
            
            $conn = new \PDO( self::DSN, self::USERNAME, self::PASSWORD);
            
            //Set common attributes
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            
            return $conn;
            
        } catch ( \PDOException $e) {
            
            echo $e->getMessage();
            throw $e;
            
        }
        catch( \Exception $e) {
            
            echo $e->getMessage();
            throw $e;
            
        }
    }
    
    /** 
     *  To ensure true singleton
     * 
     *  @return bool
     */
    public function __clone()
    {
        return false;
    }

    /** 
     *  To ensure true singleton
     * 
     *  @return bool
     */
    public function __wakeup()
    {
        return false;
    }


    /**
     * Execute a SQL command
     * 
     * @param  string  $sql                  A Sql command
     * @param  array   $parameters           The parameters
     * 
     * @return int                           The last id
     */
    public static function execute( string $sql, array $parameters=[])
    {

        $pdo=self::get()->getConnection();

        // Prepares a statement for execution and returns a statement object
        $statement= $pdo->prepare( $sql);

        try {

            $statement->execute( $parameters);

            return $pdo->lastInsertId();

        } catch( \PDOException $e) {

            echo $e->getMessage();

            throw $e;

        }

    }

    /**
     *  Returns an array of objects containing all of the result set rows
     * 
      * @param  string  $sql                 A Sql command
     *  @param  array   $parameters          The parameters
     *
     *  @return array                        An array of objects                      
     */
    public static function fetch( string $sql, array $parameters= []) 
    {

        $pdo=self::get()->getConnection();

        // Prepares a statement for execution and returns a statement object
        $statement=$pdo->prepare( $sql);

        try {

            $statement->execute( $parameters);

        } catch( \PDOException $e) {

            echo $e->getMessage();

            throw $e;

        }

        return $statement->fetchAll( \PDO::FETCH_OBJ);

    }            

    /**
     *  Returns an objects containing  the first result
     * 
      * @param  string  $sql                 A Sql command
     *  @param  array   $parameters          The parameters
     *
     *  @return object                       An Object                      
     */
    public static function first( string $sql, array $parameters= []) 
    {

        $pdo=self::get()->getConnection();

        // Prepares a statement for execution and returns a statement object
        $statement=$pdo->prepare( $sql);

        try {

            $statement->execute( $parameters);

        } catch( \PDOException $e) {

            echo $e->getMessage();

            throw $e;

        }

        return $statement->fetch( \PDO::FETCH_OBJ);

    }          
    
}