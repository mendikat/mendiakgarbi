<?php

namespace AmfFam\MendiakGarbi\Controller;

use AmfFam\MendiakGarbi\Util\Lang               as Lang;
use AmfFam\MendiakGarbi\Util\ModelAndView       as ModelAndView;
use AmfFam\MendiakGarbi\Util\Request            as Request;

/** Required Excpections */
use AmfFam\MendiakGarbi\Exception\InvalidArgumentException as InvalidArgumentException;

/**
 *  The LoginController class
 * 
 *  @author Javier Urrutia
 */
class LoginController extends BaseController {

    /** The view. */
    const VIEW_LOGIN = 'login';
    const VIEW_ADMIN = 'admin';

    /**
     * The constructor.
     * 
     * @param  array    $options            An array of options
     * 
     */
    public function __construct( array $options) {
                
        parent::__construct( $options);

    }

    /**
     * The default action
     * 
     * @return void
     */
    public function default() {

        /** Check the auth cookie */
        $session= Request::getCookie( 'session', null);
        if ( $session)
            Request::redirect( '/admin');
    
        /** Load the view */
        $mav= new ModelAndView( self::VIEW_LOGIN);

        /** Render the page */
        $mav->show( [
            'page_title'    => Lang::get( 'app.admin.title')
        ]);
       
    }

    /**
     * Login action
     * 
     * @return void
     */
    public function login() {

        /** Check the auth cookie */
        $session= Request::getCookie( 'session', null);
            
        try {
            $username= Request::post( 'username');
            $password= Request::post( 'password');
        } catch( InvalidArgumentException $e) {
            Request::redirect( '/login');
        }

        if ( $username == ADMIN_USERNAME && $password == ADMIN_PASSWORD) {

            $user_agent = Request::getUserAgent();

            Request::setCookie( 'session', sha1( ADMIN_USERNAME . ADMIN_PASSWORD . $user_agent ), 24*7, '/' );
            Request::redirect( '/admin');
        
        } else
            Request::redirect( '/login');
    

    }

    /**
     * Logout action
     * 
     * @return void
     * 
     */
    public function logout() {

        Request::removeCookie( 'session');
        Request::redirect( '/login');
   
    }

}

?>