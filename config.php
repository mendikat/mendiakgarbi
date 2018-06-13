<?php

/**
 * The application configuration file
 * 
 * @author Javier Urrutia
 * 
 */

/**
 * Debug mode
 */
define( 'DEBUG_MODE', true);

if ( DEBUG_MODE) 
    ini_set('display_errors', 'On');

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
define( 'APP_FOLDER', '' );

/**
 * Source Code Folder
 *      'src'   => PHP source code
 */
define( 'SRC_FOLDER', 'src');

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
define( 'DATE_FORMAT', 'd-m-Y');
define( 'DATETIME_FORMAT', 'd-m-Y H:i:s');
define( 'MYSQL_DATETIME_FORMAT', 'Y-m-d H:i:s');

/**
 * Mailer condiguration
 */
define( 'MAIL_ENABLE', false );
define( 'MAIL_NAME', 'AMF-FAM Mendiak Garbi');
define( 'MAIL_MAIL', 'app@amf-fam.org');
define( 'MAIL_HOST', 'smtp.amf-fam.org');
define( 'MAIL_USER', 'app.amf-fam.org');
define( 'MAIL_PASSWORD', 'amf-fam2016');
define( 'MAIL_SMTP_PORT', 25);
define( 'MAIL_TIMEOUT',   60);
define( 'MAIL_LIST', ['javi@mendikat.net','ingurumena@amf-fam.org','amf@amf-fam.org'] );

/**
 * Define Admin name and password
 */
define( 'ADMIN_USERNAME', 'admin');
define( 'ADMIN_PASSWORD', 'admin');

?>