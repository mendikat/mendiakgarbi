<?php

/**
 * The application configuration file
 * 
 * @author Javier Urrutia
 * 
 */

use AmfFam\MendiakGarbi\Util\Lang  as Lang;

// Direct access to this file is forbidden
if ( !defined( 'APP_KEY')) {
    header( 'HTTP/1.0 403 Forbidden');
    exit;
}

/**
 * Application Name
 */
define( 'APP_NAME', 'MendiakGarbi');

/**
 * Database Connection Configuration 
 */

define( 'DB_TYPE', 'mysql');
define( 'DB_HOST', 'localhost');
define( 'DB_NAME', 'mendiakgarbi');
define( 'DB_USERNAME', 'root');
define( 'DB_PASSWORD', 'Altia.2018');

define( 'DATETIME_FORMAT', 'd-m-Y H:i:s');
define( 'MYSQL_DATETIME_FORMAT', 'Y-m-d H:i:s');

// Create an instance of Lang class object
// for managing the trasnlations
$lang = new Lang;

?>