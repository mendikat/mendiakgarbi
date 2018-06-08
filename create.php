<?php

/**
 * Create Controller
 * 
 * @author Javier Urrutia
 */

include 'app.php';

use AmfFam\MendiakGarbi\Util\Lang           as Lang;
use AmfFam\MendiakGarbi\Util\ModelAndView   as ModelAndView;

/** Required DAO */
use AmfFam\MendiakGarbi\DAO\EventDAO        as EventDAO;


$eventDAO = new EventDAO;


/** Load the home view */
$mav= new ModelAndView( 'create');

/** Render the page */
$mav->show( [
    'page_title'    => Lang::get( 'app.create.title'),
]);

?>