<?php

namespace AmfFam\MendiakGarbi\Util;

use AmfFam\MendiakGarbi\Util\Validator as Validator;

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
                throw new \Exception(  'Argument (' . $varname . ') undefined');

            if ( $validator->get_default() != null )
                return $validator->get_default();
            else
                throw new \Exception(  'Argument (' . $varname . ') undefined');
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

}

?>