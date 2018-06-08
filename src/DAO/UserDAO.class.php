<?php

namespace AmfFam\MendiakGarbi\DAO;

/** Required models */
use AmfFam\MendiakGarbi\Model\User      as User;

/** Required DAO */
use AmfFam\MendiakGarbi\DAO\AbstractDAO as AbstractDAO;

use  AmfFam\MendiakGarbi\Exception\UserNotFoundException as UserNotFoundException;

/**
 *  The class UserDAO
 * 
 *  @author Javier Urrutia
 */
class UserDAO extends AbstractDAO {

    /** The table */
    private const TABLE  = 'mg_users';
    /** The entity class */
    private const ENTITY = 'AmfFam\MendiakGarbi\Model\User';

    /**
     * The Constructor
     */
    public function __construct() {
        parent::__construct( self::TABLE, self::ENTITY);
    }

    /**
     * Find the user by id
     * 
     * @param   int   $id                            The user id
     * @return  \AmfFam\MendiakGarbi\Model\User       The user
     */
    public function findById( int $id) {

        $pdo= $this->get_pdo();

        $sql= 'select * from '.$this->get_table().' where id= :id';

        $result= $pdo->first( $sql, [ ':id' => $id]);
    
        $user = new User( [
            'id'     => $result->id,
            'name'   => $result->name,
            'email'  => $result->email,
            'hash'   => $result->hash,
            'access' => $result->access
        ]);

        return $user;

    }

    /**
     * Returns the number of users
     * 
     * @return int                                  The number of users
     */
    public function count() {

        $pdo= $this->get_pdo();

        $sql= 'select count(*) as num from '.$this->get_table();

        return $pdo->first( $sql)->num;

    }    

    /**
     * Find the user by hash
     * 
     * @param   string  $hash                        The user hash
     * @return  \AmfFam\MendiakGarbi\Model\User      The user
     */
    public function findByHash( string $hash) {

        $pdo= $this->get_pdo();

        $sql= 'select * from '.$this->get_table().' where hash= :hash';

        $result= $pdo->first( $sql, [ ':hash' => $hash]);

        if ( ! $result) {

            throw new UserNotFoundException([
                'message' => 'User not found',
                'id'      => $hash
            ]);

        }
    
        $user = new User( [
            'id'     => $result->id,
            'name'   => $result->name,
            'email'  => $result->email,
            'hash'   => $result->hash,
            'access' => $result->access
        ]);

        return $user;

    }

    /**
     * Delete user
     * 
     * @param AmfFam\MendiakGarbi\Model\User       $user             The user
     * 
     * @return void
     */
    public function delete( \AmfFam\MendiakGarbi\Model\User $user) {

        $id= $user->id;

        $pdo= $this->get_pdo();

        $sql = 'delete from '. $this->get_table() . ' where id= :id';
        $pdo->prepare( $sql);
        $pdo->execute( [ ':id' => $id]);
    
    }

     /**
     * Save the user
     * 
     * @param  \AmfFam\MendiakGarbi\Model\User       $user             The user
     * 
     * @return int                                                     The last insert id
     */
    public function save( \AmfFam\MendiakGarbi\Model\User $user) {

        $pdo= $this->get_pdo();

        if ( $user->get_id()) {

            $sql = 'update '. $this->get_table() . ' set
                        name= :name,
                        email = :email,
                        hash= :hash,
                        access= :access
                    where id= :id';
  
            return $pdo->execute( $sql, [
                ':id'     => $user->get_id(),
                ':name'   => $user->get_name(),
                ':email'  => $user->get_email(),
                ':hash'   => $user->get_hash(),
                ':access' => $user->get_access()                
            ]);
        
        } else {

            $sql = 'insert into '. $this->get_table() . '( name, email, hash, access) values(
                        :name,
                        :email,
                        :hash,
                        :access )';
    
            return $pdo->execute( $sql, [ 
                ':name'   => $user->get_name(),
                ':email'  => $user->get_email(),
                ':hash'   => md5( $user->get_email()),
                ':access' => $user->get_access()
            ]);
                                
        }


    }

}

?>