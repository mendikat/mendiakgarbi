<?php

/**
 * Get the markers
 * 
 * Ex:
 * 
 *   url  : '/service/get-markers.php'     
 *   
 * 
 * The response is JSON
 * 
 * @author Javier Urrutia
 */

/** Utils */
use AmfFam\MendiakGarbi\Util\Request          as Request; 

/** Required DAO */
use AmfFam\MendiakGarbi\DAO\EventDAO          as EventDAO;

include '../app.php';

$eventDAO = new EventDAO;

// Send JSON response

Request::setStatus( Request::HTTP_OK);
header( Request::MIMETYPE_JSON );
header( 'Access-Control-Allow-Origin: *');
echo json_encode( $eventDAO->findMarkers());

?>