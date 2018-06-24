<?php

namespace AmfFam\MendiakGarbi\Controller;

use AmfFam\MendiakGarbi\Controller\AbstractController       as AbstractController;

use AmfFam\MendiakGarbi\Util\Lang                           as Lang;
use AmfFam\MendiakGarbi\Util\ModelAndView                   as ModelAndView;

/** Required DAO */
use AmfFam\MendiakGarbi\DAO\EventDAO        as EventDAO;
use AmfFam\MendiakGarbi\DAO\UserDAO         as UserDAO;

/**
 *  The HomeController class
 * 
 *  @author Javier Urrutia
 */
class HomeController extends BaseController {

    /** The view. */
    const VIEW = 'home';

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

        /** Get the number of events */
        $eventDAO = new EventDAO;

        $numEvents= $eventDAO->count();

        /** Get the number of users */
        $userDAO = new UserDAO;
        $numUsers = $userDAO->count();

        /** Load the home view */
        $mav= new ModelAndView( self::VIEW);

        /** Render the page */
        $mav->show( [
            'page_title'    => Lang::get( 'app.home.title'),
            'event_count'   => $numEvents,
            'user_count'    => $numUsers
        ]);

    }

}

?>