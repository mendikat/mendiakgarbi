<?php

/**
 * The application configuration file
 * 
 * @author Javier Urrutia
 * 
 */

// Server Debug
//ini_set( 'display_errors', 1);
//error_reporting( E_ALL);

// Direct access to this file is forbidden
if ( !defined( 'APP_KEY')) {
    header( 'HTTP/1.0 403 Forbidden');
    exit;
}

/**
 * Application Name
 */
define( 'APP_NAME', 'MendiakGarbi');  // WARNING: if change, namespace must be changed too!

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
define( 'DB_USERNAME', '****');
define( 'DB_PASSWORD', '**********');
define( 'DB_CHARSET', 'utf8');          // 'utf8' is the recommended value ( vs. 'latin1' )

/**
 * DateTime Formats
 */
define( 'DATE_FORMAT', 'd-m-Y');
define( 'DATETIME_FORMAT', 'd-m-Y H:i:s');
define( 'MYSQL_DATETIME_FORMAT', 'Y-m-d H:i:s');

/**
 * Mailer condiguration
 */
define( 'MAIL_ENABLE', true );
define( 'MAIL_NAME', '***** Mendiak Garbi');
define( 'MAIL_MAIL', 'app@*****.org');
define( 'MAIL_HOST', 'smtp.*****.org');
define( 'MAIL_USER', 'app.*****.org');
define( 'MAIL_PASSWORD', '*****');
define( 'MAIL_SMTP_PORT', 25);
define( 'MAIL_TIMEOUT',   60);
define( 'MAIL_LIST', ['*****@*****.org','*****@*****.net'] );

/**
 * Define Admin name and password
 */
define( 'ADMIN_USERNAME', 'admin');
define( 'ADMIN_PASSWORD', 'admin');


?>