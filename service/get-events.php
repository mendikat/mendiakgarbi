<?php

/**
 * Get the events
 * 
 * The response is JSON
 * 
 * @author Javier Urrutia
 */

include '../config.php';

use AmfFam\MendiakGarbi\Util\Request          as Request;
use AmfFam\MendiakGarbi\Util\StringValidator  as StringValidator;

use AmfFam\MendiakGarbi\DAO\EventDAO          as EventDAO;

use AmfFam\MendiakGarbi\Exception\UserNotFoundException as UserNotFoundException;

// Get the user hash
try {

    $hash= Request::get( 'hash', new StringValidator([
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

// Cnovert in array
$array= array_map( function( $event) { 
    return $event->toArray(); 
}, $events);

header( Request::MIMETYPE_JSON );
echo json_encode( $array);

?>