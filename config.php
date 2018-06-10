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
define( 'DB_HOST', '*********');
define( 'DB_NAME', '**********');
define( 'DB_USERNAME', '********');
define( 'DB_PASSWORD', '******');

/**
 * DateTime Formats
 */
define( 'DATETIME_FORMAT', 'd-m-Y H:i:s');
define( 'MYSQL_DATETIME_FORMAT', 'Y-m-d H:i:s');

/**
 * Mailer condiguration
 */
define( 'MAIL_ENABLE', true );
define( 'MAIL_NAME', 'AMF-FAM Mendiak Garbi');
define( 'MAIL_MAIL', '***@***');
define( 'MAIL_HOST', 'smtp.******');
define( 'MAIL_USER', '****@****');
define( 'MAIL_PASSWORD', '**********');
define( 'MAIL_SMTP_PORT', 25);
define( 'MAIL_TIMEOUT',   60);
define( 'MAIL_LIST', ['*****@****','*****@****','*****@****'] );

?>