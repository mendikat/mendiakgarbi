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
use AmfFam\MendiakGarbi\DAO\HistDAO             as HistDAO;
use AmfFam\MendiakGarbi\DAO\ImageDAO            as ImageDAO;

/** Required Excpections */
use AmfFam\MendiakGarbi\Exception\InvalidArgumentException as InvalidArgumentException;

/** Check the Auth cookie */
$session= Request::getCookie( 'session', null);
$user_agent = Request::getUserAgent();

if ( !$session || ( $session != sha1( ADMIN_USERNAME . ADMIN_PASSWORD . $user_agent ) ) )
    header( 'location: login.php');
 
/** Load the required DAO */
$eventDAO  = new EventDAO;
$statusDAO = new StatusDAO;
$typeDAO   = new TypeDAO;
   
try {
    $action= Request::get( 'action');
} catch( InvalidArgumentException $e) {
    $action= null;
}

switch ( $action) {

    /**
     *  Show all events
     * 
     */
    case null:

        $events = $eventDAO->findAll();
        $types  = $typeDAO->findAll();
        $status = $statusDAO->findAll();

        /** Load the admin view */
        $mav= new ModelAndView( 'admin');

        /** Render the page */
        $mav->show( [
            'page_title'    => Lang::get( 'app.admin.title'),
            'events'        => $events,
            'status'        => $status,
            'types'         => $types
        ]);

        break;

     /**
      *  Change the status of the event
      *  Required:
      *         id      : The event  id
      *         status  : The status id
      */   
    case 'status':
    
        $id   = Request::post( 'id');
        $status = Request::post( 'status');
 
        $event= $eventDAO->findById( $id);
        $event->set_status( $statusDAO->findById( $status));    

        $eventDAO->save( $event);

        die ( 'ok');

        break;

     /**
      *  Change the text in the last historial entry
      *  Required:
      *         text  : The text
      */   
      case 'text':
  
        $text   = Request::post( 'text');

        $histDAO = new HistDAO;
      
        $histDAO->update_text( $text);

        die ( 'ok');

        break;

    /**
      *  Save the event
      *  Required:
      *         id      : The event  id
      */   
    case 'save':

        $id= Request::post( 'id');
  
        $event= $eventDAO->findById( $id);

        $name= Request::post( 'name');
        $description= Request::post( 'description');
        $type= Request::post( 'type');
 
        $event->set_name( $name);
        $event->set_description( $description);
        $event->set_type(  $typeDAO->findById( $type));

        $eventDAO->save( $event);

        die( 'ok');

        break;

    /**
     *  Get the event history
     *  Required:
     * 
     *         id      : The event  id
     */           
    case 'hist':
    
        $id = Request::post( 'id');

        $histDAO = new HistDAO;
        $hists= $histDAO->findByEvent( $id, true);    
       
        echo json_encode( $hists);
        die();
        
        break;

    /**
     *  Get the event images
     *  Required:
     * 
     *         id      : The event  id
     */           
    case 'image':
    
        $imageDAO = new ImageDAO;

        $id = Request::post( 'id');

        $images= [];
        foreach( $imageDAO->findByEvent( $id) as $image)
            $images[]= Request::getFullUrl( ( APP_FOLDER != '' ? '/' .APP_FOLDER . '/' : '/' ) . STORE_FOLDER . '/img/thumbs/'. $image->get_image());

        echo json_encode( $images);
        die();
        
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