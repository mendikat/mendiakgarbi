<?php

/**
 * Get the events
 * 
 * Ex:
 * 
 *   url  : '/service/get-events.php'     
 *   data : 'hash=76c74798dd9dedbc2afb8dd4c67a813d'
 *   type : 'post'
 *   
 * 
 * The response is JSON
 * 
 * @author Javier Urrutia
 */

include '../app.php';

use AmfFam\MendiakGarbi\Util\Request          as Request;
use AmfFam\MendiakGarbi\Util\StringValidator  as StringValidator;

/** Required DAO */
use AmfFam\MendiakGarbi\DAO\EventDAO          as EventDAO;

/** Requires Exceptions */
use AmfFam\MendiakGarbi\Exception\UserNotFoundException as UserNotFoundException;

// Get the user hash
try {

    $hash= Request::post( 'hash', new StringValidator([
        'size'      => 32,
        'nullable'  => false
    ]));

} catch( InvalidDataException $e) {

    Request::setStatus( Request::HTTP_BAD_REQUEST);
    header( Request::MIMETYPE_JSON );
    echo $e->toJSON();
    die();
}

// Get the events
$eventDAO = new EventDAO;

try {
    $events = $eventDAO->findByUserHash( $hash);
} catch( UserNotFoundException $e) {
    
    Request::setStatus( Request::HTTP_BAD_REQUEST);
    header( Request::MIMETYPE_JSON );
    echo $e->toJSON();
    die();
}

// Convert in array
$array= array_map( function( $event) { 
    return $event->toArray(); 
}, $events);

header( Request::MIMETYPE_JSON );
echo json_encode( $array);

?>