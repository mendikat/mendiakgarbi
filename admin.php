<?php

/**
 * Admin Controller
 * 
 * @author Javier Urrutia
 */

include 'app.php';

use AmfFam\MendiakGarbi\Util\Lang               as Lang;
use AmfFam\MendiakGarbi\Util\ModelAndView       as ModelAndView;
use AmfFam\MendiakGarbi\Util\Request            as Request;

/** Required DAO */
use AmfFam\MendiakGarbi\DAO\EventDAO            as EventDAO;
use AmfFam\MendiakGarbi\DAO\TypeDAO             as TypeDAO;
use AmfFam\MendiakGarbi\DAO\StatusDAO           as StatusDAO;

/** Required Excpections */
use AmfFam\MendiakGarbi\Exception\InvalidArgumentException as InvalidArgumentException;

/** Load the required DAO */
$eventDAO  = new EventDAO;
$statusDAO = new StatusDAO;

try {
    $action= Request::get( 'action');
} catch( InvalidArgumentException $e) {
    $action= null;
}

/** Get the status */
$status = $statusDAO->findAll();

switch ( $action) {

    /**
     *  Show all events
     * 
     */
    case null:

        $events = $eventDAO->findAll();

        /** Load the admin view */
        $mav= new ModelAndView( 'admin');

        /** Render the page */
        $mav->show( [
            'page_title'    => Lang::get( 'app.admin.title'),
            'events'        => $events,
            'status'        => $status
        ]);

        break;

     /**
      *  Change the status of the event
      *  Required:
      *         id      : The event  id
      *         status  : The status id
      */   
    case 'status':
    
        $id     = Request::post( 'id');
        $status = Request::post( 'status');

        $event= $eventDAO->findById( $id);
        $event->set_status( $statusDAO->findById( $status));    

        $eventDAO->save( $event);

        die ( 'ok');

        break;

    /**
      *  Show the event
      *  Required:
      *         id      : The event  id
      */   
    case 'show':

        $id= Request::get( 'event');

        break;

    /**
     *  Delete the event
     *  Required:
     * 
     *         id      : The event  id
     */   
    case 'delete':

        $id     = Request::post( 'id');

        $event= $eventDAO->delete( $id);

        die ( 'ok');

        break;

}



?>