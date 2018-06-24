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
    const HTTP_OK          = 200;
    const HTTP_FOUND       = 302;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_NOT_FOUND   = 404;

    const MIMETYPE_JSON    = 'Content-Type: application/json';
    const MIMETYPE_JPEG    = 'Content-Type: image/jpeg';

    const JPG_EXTENSION = '.jpg';
    
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
     * 
     * @return void
     */
    public static function setCookie( string $name, string $value, int $hours) {

        setcookie( $name, $value, time() + $hours * 60 * 60, '/' );

    }

    /**
     * Remove teh cookie
     * 
     * @param   string  $name           The name
     * 
     * @return void
     */
    public static function removeCookie( $name) {
        setcookie( $name, null, -1, '/');
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
     * Get user agent
     * 
     * @return string                  The user agent
     */
    public static function getUserAgent() {
        
        return $_SERVER[ 'HTTP_USER_AGENT'];
    
    }

    /**
     * Get the upload file an move to target
     * 
     * @param  string    $source        The source for the uploaded file
     * @param  string    $target        The target to save the uploaded file
     * 
     * @return void
     */
    public static function move_file( string $source, string $target) {

        move_uploaded_file( $source,  $_SERVER[ 'DOCUMENT_ROOT'] . $target );

    }

    /**
     * Get the upload files
     * 
     * @param  string    $varname        The varname
     * 
     * @return array                     A lis of files
     */
    public static function files( string $varname ) {

        if ( isset( $_FILES[ $varname])) {

            if( empty( $_FILES[ $varname]['tmp_name'][0]))
                return [];
            else   
                return $_FILES[ $varname][ 'tmp_name'];

        } else
            return null;

    }

    /**
     * Get the current URL.
     * 
     * @return string                       The current URL
     */
    public static function getCurrentUrl() {

        return $_SERVER[ 'REQUEST_URI'];
    }

    /**
     * Get the full url
     * 
     * @param  string $url               An Url
     * 
     * @return string
     */
    public static function getFullUrl( string $url)
    {

        if ( isset( $_SERVER['HTTPS']))  {
            $protocol = ( $_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        } else {
            $protocol = 'http';
        }
        
        return $protocol . "://" . $_SERVER['HTTP_HOST'] . str_replace( '\\', '/', $url);

    }

    /**
     * Analize current request
     * and get the controller, the action, and the arguments
     * 
     * Examples:
     * 
     *              route                      Controller           Action          Args
     *              ============================================================================================
     *              /                          HomeController       default         []
     *              /create                    CreateController     default         []
     *              /event/list                EventController      list            []
     *              /event/edit/1              EventController      edit            [ 'id' => 1 ]
     *              /event/edit/name/lucas     EventController      edit            [ 'name' => 'lucas' ]      
     * 
     * @return array                        Returns an array
     *                                      [ 
     *                                          'controller' => $controller,
     *                                          'action'     => $action,
     *                                          'args'       => $args
     *                                      ]
     */
    public static function getCurrentRequest() {

        $current_uri = Request::getCurrentUrl();

        // Explode the url
        $uri_parts= explode( '/', $current_uri);

        $controller = ( $uri_parts[1] ? ucfirst( $uri_parts[1]) : 'Home' ) . 'Controller';
        $action     = $uri_parts[2] ?? 'default';

        $args= [];
        for( $i=3; $i < count( $uri_parts); $i+=2)
            if ( isset( $uri_parts[$i+1]))
                $args[$uri_parts[$i]]= $uri_parts[$i+1];
            else
                $args['id']= $uri_parts[3];
            
        return [ 
            'controller' => $controller,
            'action'     => $action,
            'args'       => $args
        ];
    }

    /**
     * Redirect to view
     * 
     * @param  string $url
     * 
     * @return void
     */
    public static function redirect( string $url) {
        Request::setStatus( self::HTTP_FOUND);
        header( 'location: '.$url);
    }

}

?>