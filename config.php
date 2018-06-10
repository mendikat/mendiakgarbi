<?php

/**
 * The application configuration file
 * 
 * @author Javier Urrutia
 * 
 */

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
define( 'DB_PASSWORD', 'Gorbeia1481');

/**
 * DateTime Formats
 */
define( 'DATETIME_FORMAT', 'd-m-Y H:i:s');
define( 'MYSQL_DATETIME_FORMAT', 'Y-m-d H:i:s');

/**
 * Mailer condiguration
 */
define( 'MAIL_ENABLE', true );
define( 'MAIL_NAME', 'Mendikat');
define( 'MAIL_MAIL', 'mendikat@mendikat.net');
define( 'MAIL_HOST', 'mail.mendikat.net');
define( 'MAIL_USER', 'javi@mendikat.net');
define( 'MAIL_PASSWORD', 'Gorbeia1481');
define( 'MAIL_SMTP_PORT', 25);
define( 'MAIL_TIMEOUT',   60);
define( 'MAIL_LIST', ['javi@mendikat.net'] );

?>