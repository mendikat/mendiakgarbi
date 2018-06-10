<?php

/**
 *  Application File
 * 
 * @author Javier Urrutia
 */

ini_set( 'display_errors', 1);
error_reporting( E_ALL);

 /** Define an Application Key */
define( 'APP_KEY', 'b1159826507f4dba6f832fdc275d257c');

define( 'SRC_FOLDER', 'src');

 /** Vendor Autoload classes */
require_once 'src/vendor/autoload.php';

/**
 *  Register a new autoload function
 */
spl_autoload_register( 

    /**
     * @param string    $class         The class to load
     *
     */
    function( string $class) 
    {

        $class_name   = substr( $class, strrpos( $class, '\\') + 1) . '.class.php';
        $class_folder = str_replace( [ 'amffam\\', strtolower( APP_NAME), '\\'], [ '', 'mg/'. SRC_FOLDER, DIRECTORY_SEPARATOR ], strtolower( substr( $class, 0,  strrpos( $class, '\\') + 1)));

        $class_path   = $_SERVER[ 'DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $class_folder .  $class_name;

        if ( file_exists( $class_path))
            include $class_path;
        else
            die( "KKK");
            //throw new \Exception ( $class. ' not found at ' . $class_path);

    }
);

/** Load the configuration file */
require_once 'config.php';

?>