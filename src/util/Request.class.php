<?php

namespace AmfFam\MendiakGarbi\Util;

use AmfFam\MendiakGarbi\Util\Validator                     as Validator;

/** Required exceptions */
use AmfFam\MendiakGarbi\Exception\InvalidDataException     as InvalidDataException;
use AmfFam\MendiakGarbi\Exception\InvalidArgumentException as InvalidArgumentException;

/**
 * The class Request
 * 
 * @author Javier Urrutia
 * 
 */
class Request {

    /** HTTP status codes */
    public const HTTP_OK          = 200;
    public const HTTP_BAD_REQUEST = 400;

    public const MIMETYPE_JSON    = 'Content-Type: application/json';

    /**
     *  Get the value of a varible sended GET via
     * 
     *  @param string       $varname                    The variable name
     *  @param \AmfFam\MendiakGarbi\Util\Validator      A Validator object
     * 
     *  @return mixed                                   The value
     */
    public static function get( string $varname, Validator $validator = null) {
       
        if ( !isset( $_GET[ $varname])) 
        {

            if ( !$validator)
                throw new InvalidArgumentException( [ 
                    'message'  => 'Argument undefined',
                    'argument' => $varname

                ]);

            if ( !is_null( $validator->get_default())  )
                return $validator->get_default();
            else
                throw new InvalidArgumentException( [ 
                    'message'  => 'Argument undefined',
                    'argument' => $varname
                ]);
        } 
        else 
        {
            try 
            {
                return  $validator ? $validator->validate( $_GET[ $varname]) :  $_GET[ $varname];
            } 
            catch ( InvalidDataException $e) 
            {     
                // Re-throw the exception addind the varname 
                throw new InvalidDataException( [
                    'message' => $e->get_message(),
                    'varname' => $varname,
                    'value'   => $e->get_value()
                ]);

            }
        }

    }
    
    /**
     *  Get the value of a varible sended POST via
     * 
     *  @param string       $varname                    The variable name
     *  @param \AmfFam\MendiakGarbi\Util\Validator      A Validator object
     * 
     *  @return mixed                                   The value
     */
    public static function post( string $varname, Validator $validator = null) {
       
        if ( !isset( $_POST[ $varname])) 
        {

            if ( !$validator)
                throw new InvalidArgumentException( [ 
                    'message'  => 'Argument undefined',
                    'argument' => $varname
                ]);

            if ( $validator->get_default() != null )
                return $validator->get_default();
            else
                throw new InvalidArgumentException( [ 
                    'message'  => 'Argument undefined',
                    'argument' => $varname
                ]);
        } 
        else 
        {
            try 
            {
                return  $validator ? $validator->validate( $_POST[ $varname]) :  $_POST[ $varname];
            } 
            catch ( InvalidDataException $e) 
            {
                $e->set_varname( $varname);
        
                http_response_code( self::HTTP_BAD_REQUEST);
                echo $e->toJSON();
                die();
                
            }
        }

    }

    /**
     * Returns true if the request type is POST
     *
     * @return bool
     */
    public static function isPost() {

        return $_SERVER[ 'REQUEST_METHOD'] === 'POST'; 
    }
    
    /**
     * Set the HTTP response status code
     * 
     * @param  int       $code                  The HTTP status code. Use: Request::HTTP_OK, Request::HTTP_BAD_REQUEST  
     * 
     * @return void
     */
    public static function setStatus( int $code)
    {
        http_response_code( $code);
    }

    /**
     * Set the cookie
     * 
     * @param  string   $name           The name
     * @param  string   $value          The value
     * @param  int      $lifetime       The lifetime in hours
     */
    public static function setCookie( string $name, string $value, int $hours) {

        setcookie( $name, $value, time() + $hours * 60 * 60 );

    }

    /**
     * Get the cookie
     * 
     * @param  string                  The name of the cookie              
     * @param  string                  The defaul valur for teh cookie
     * 
     * @return string                  The value
     */
    public static function getCookie( string $name, string $default = null) {

        return $_COOKIE[ $name] ?? $default;

    }

    /**
     * Get the upload file
     * 
     * @param  string    $varname       The varname
     * 
     * @return string                   The file
     */
    public static function file( string $varname) {

        if ( isset( $_FILES[ $varname]))
            return $_FILES[ 'file'][ 'tmp_name'];
        else
            return null;
    }

}

?>