<?php

/**
 * Set the event status
 * 
 * @author Javier Urrutia
 */

include '../app.php';

/** Utils */
use AmfFam\MendiakGarbi\Util\Request            as Request;
use AmfFam\MendiakGarbi\Util\StringValidator    as StringValidator;
use AmfFam\MendiakGarbi\Util\IntegerValidator   as IntegerValidator;

/** Required models */
use AmfFam\MendiakGarbi\Model\Event             as Event;

/** Required DAO */
use AmfFam\MendiakGarbi\DAO\EventDAO            as EventDAO;
use AmfFam\MendiakGarbi\DAO\UserDAO             as UserDAO;
use AmfFam\MendiakGarbi\DAO\StatusDAO           as StatusDAO;

/** Required Exceptions */
use AmfFam\MendiakGarbi\Exception\UserNotFoundException as UserNotFoundException;
use AmfFam\MendiakGarbi\Exception\InvalidDataException  as InvalidDataException;
use AmfFam\MendiakGarbi\Exception\EventNotFoundException as EventNotFoundException;


// Get the user hash, the event id and the new status
try {

    $hash= Request::post( 'hash', new StringValidator([
        'size'      => 32,
        'nullable'  => false
    ]));

    $id  = Request::post( 'id', new IntegerValidator([
        'min' => 1
    ]));

    $statusDAO = new StatusDAO;

    $status  = Request::post( 'status', new IntegerValidator([
        'min' => 1,
        'max' => $statusDAO->findMaxId()
    ]));

} catch( InvalidDataException $e) {

    Request::setStatus( Request::HTTP_BAD_REQUEST);
    header( Request::MIMETYPE_JSON );
    echo $e->toJSON();
    die();

}

// Get the user
$userDAO = new UserDAO;

try {
    $user= $userDAO->findByHash( $hash);
} catch( UserNotFoundException $e) {
   
    Request::setStatus( Request::HTTP_BAD_REQUEST);   
    header( Request::MIMETYPE_JSON );
    echo $e->toJSON();
    die();
}

if ( ! $user->is_admin()) {
    die( 'Forbidden');
}

// Get the event status

$eventDAO = new EventDAO;

try {
    $event = $eventDAO->findById( $id);
} catch( EventNotFoundException $e) {

    Request::setStatus( Request::HTTP_BAD_REQUEST);   
    header( Request::MIMETYPE_JSON );
    echo $e->toJSON();
    die();

}


// Change the status and save

$event->set_status( $statusDAO->findById( $status));
$eventDAO->save( $event);

?>