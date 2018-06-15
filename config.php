<?php

/**
 * The application configuration file
 * 
 * @author Javier Urrutia
 * 
 */

// Server Debug
define( 'DEBUG_MODE', false);

if ( defined( DEBUG_MODE)) {
    ini_set( 'display_errors', 1);
    error_reporting( E_ALL);
}

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
 * Application Folder
 * Relative to Root. 
 *      ''      => Empty for root server
 *      'mg'    => mg folder
 */     
define( 'APP_FOLDER', 'mendiakgarbi' );

/**
 * Source Code Folder
 *      'src'   => PHP source code
 */
define( 'SRC_FOLDER', 'src');


/**
 * Store folder
 *      'store'   => Store folder
 */
define( 'STORE_FOLDER', 'store');


/**
 * Application views folder
 */
define( 'APP_VIEWS_FOLDER', 'resources/views');

/**
 * Database Connection Configuration 
 */
define( 'DB_TYPE', 'mysql');
define( 'DB_HOST', 'localhost');
define( 'DB_NAME', 'mendiakgarbi');
define( 'DB_USERNAME', 'root');
define( 'DB_PASSWORD', 'Altia.2018');

/**
 * DateTime Formats
 */
define( 'DATE_FORMAT', 'd-m-Y');
define( 'DATETIME_FORMAT', 'd-m-Y H:i:s');
define( 'MYSQL_DATETIME_FORMAT', 'Y-m-d H:i:s');

/**
 * Mailer condiguration
 */
define( 'MAIL_ENABLE', false );
define( 'MAIL_NAME', 'Javier Urrutia');
define( 'MAIL_MAIL', 'javi@mendika.net');
define( 'MAIL_HOST', 'smtp.mendikat.net');
define( 'MAIL_USER', 'javi@mendikat.net');
define( 'MAIL_PASSWORD', 'Gorbeia1481');
define( 'MAIL_SMTP_PORT', 25);
define( 'MAIL_TIMEOUT',   60);
define( 'MAIL_LIST', ['javi@mendikat.net'] );

/**
 * Define Admin name and password
 */
define( 'ADMIN_USERNAME', 'admin');
define( 'ADMIN_PASSWORD', 'admin');

?>