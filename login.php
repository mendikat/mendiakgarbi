<?php

/**
 * Login Controller
 * 
 * @author Javier Urrutia
 */

include 'app.php';

use AmfFam\MendiakGarbi\Util\Lang               as Lang;
use AmfFam\MendiakGarbi\Util\ModelAndView       as ModelAndView;
use AmfFam\MendiakGarbi\Util\Request            as Request;

/** Required Excpections */
use AmfFam\MendiakGarbi\Exception\InvalidArgumentException as InvalidArgumentException;

/** Check the auth cookie */
$session= Request::getCookie( 'session', null);

if ( $session) header( 'location: admin.php'); 

try {
    $action= Request::get( 'action');
} catch( InvalidArgumentException $e) {
    $action= null;
}

switch ( $action) {

    /**
     * Login Window
     * 
     */
    case null:

        /** Load the admin view */
        $mav= new ModelAndView( 'login');

        /** Render the page */
        $mav->show( [
            'page_title'    => Lang::get( 'app.admin.title')
        ]);

        break;

    /**
     *  Login
     * 
     */
    case 'login':
         
        $username= Request::post( 'username');
        $password= Request::post( 'password');

        if ( $username == ADMIN_USERNAME && $password == ADMIN_PASSWORD) {

            $user_agent = Request::getUserAgent();

            Request::setCookie( 'session', sha1( ADMIN_USERNAME . ADMIN_PASSWORD . $user_agent ), 24*7 );
            header( 'location: admin.php');
        
        } else
            header( 'location:login.php');
               
        break;

   /**
     *  Logout
     * 
     */
    case 'logout':

        Request::setCookie( 'session', '', -1 );
        header( 'location:login.php');
        break;


}
