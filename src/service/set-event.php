<?php

/**
 * Set a new event
 * 
 * @author Javier Urrutia
 */

include '../app.php';

use AmfFam\MendiakGarbi\Util\Request          as Request;
use AmfFam\MendiakGarbi\Util\StringValidator  as StringValidator;
use AmfFam\MendiakGarbi\Util\FloatValidator   as FloatValidator;

/** Required models */
use AmfFam\MendiakGarbi\Model\Event           as Event;


/** Required DAO */
use AmfFam\MendiakGarbi\DAO\EventDAO          as EventDAO;
use AmfFam\MendiakGarbi\DAO\UserDAO           as UserDAO;

/** Rqueired Exceptions */
use AmfFam\MendiakGarbi\Exception\UserNotFoundException    as UserNotFoundException;
use AmfFam\MendiakGarbi\Exception\InvalidArgumentException as InvalidArgumentException;
use AmfFam\MendiakGarbi\Exception\InvalidDataException     as InvalidDataException;

// Get the user hash
try {

    $hash= Request::get( 'hash', new StringValidator([
        'size'      => 32,
        'nullable'  => false
    ]));

} catch( InvalidDataException $e) {

    //http_response_code( 400);
    header( Request::MIMETYPE_JSON );
    echo json_encode( $e->get_message());
    die();
}

// Get the user

$userDAO = new UserDAO;

$user= $userDAO->findByHash( $hash);

// Get the event values

try {

    $name= Request::post( 'name', new StringValidator([
        'size'      => 50,
        'nullable'  => false
    ]));

    $description= Request::post( 'description', new StringValidator([
        'size'      => 255,
        'nullable'  => false
    ]));

    $type= Request::post( 'type');
    
    $lat= Request::post( 'lat', new FloatValidator([
        'min'       => -90,
        'max'       => +90,
        'default'   => 0
    ]));

    $lng= Request::post( 'lng', new FloatValidator([
        'min'       => -180,
        'max'       => +180,
        'default'   =>    0
    ]));

} catch( InvalidDataException $e) {

    Request::setStatus( Request::HTTP_BAD_REQUEST);
    header( Request::MIMETYPE_JSON );
    echo $e->toJSON();
    die();

} catch(  InvalidArgumentException $e) {

    Request::setStatus( Request::HTTP_BAD_REQUEST);
    header( Request::MIMETYPE_JSON );
    echo $e->toJSON();
    die();
  
}

// Create a new event

$event= new Event([
    'name'          => $name,
    'description'   => $description,
    'type'          => $type,
    'user'          => $user,
    'lat'           => $lat, 
    'lng'           => $lng
]);

// Save the new event

$eventDAO = new EventDAO;
$eventDAO->save( $event);

?>