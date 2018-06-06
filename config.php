<?php

/**
 *  Application Config File
 * 
 * @author Javier Urrutia
 */


/**
 *  Database Connection Configuration 
 * 
 */

define( 'DB_TYPE', 'mysql');
define( 'DB_HOST', 'localhost');
define( 'DB_NAME', 'mendiakgarbi');
define( 'DB_USERNAME', 'root');
define( 'DB_PASSWORD', 'Altia.2018');

define( 'DATETIME_FORMAT', 'd-m-Y H:i:s');
define( 'MYSQL_DATETIME_FORMAT', 'Y-m-d H:i:s');

/**
 *  Autoload Method
 * 
 * @param string    $class         The class to load
 */
function __autoload( string $class) 
{

    $class_name   = substr( $class, strrpos( $class, '\\') + 1) . '.class.php';
    $class_folder = str_replace( [ 'amffam\\', '\\'], [ '', DIRECTORY_SEPARATOR ], strtolower( substr( $class, 0,  strrpos( $class, '\\') + 1)));
    $class_path   = $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . $class_folder . $class_name;
   
    if ( file_exists( $class_path))
        include $class_path;
    else
        throw new \Exception ( $class. ' not found at ' . $class_path);

}

?>