<?php

/**
 * Home Controller
 * 
 * @author Javier Urrutia
 */

include 'app.php';

use AmfFam\MendiakGarbi\Util\Lang           as Lang;
use AmfFam\MendiakGarbi\Util\ModelAndView   as ModelAndView;

/** Required DAO */
use AmfFam\MendiakGarbi\DAO\EventDAO        as EventDAO;
use AmfFam\MendiakGarbi\DAO\UserDAO         as UserDAO;


/** Get the number of events */
$eventDAO = new EventDAO;
$numEvents= $eventDAO->count();

/** Get the number of users */
$userDAO = new UserDAO;
$numUsers = $userDAO->count();

/** Load the home view */
$mav= new ModelAndView( 'home');

/** Render the page */
$mav->show( [
    'page_title'    => Lang::get( 'app.home'),
    'event_count'   => $numEvents,
    'user_count'    => $numUsers
]);

?>