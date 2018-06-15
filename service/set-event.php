<?php

/**
 * Set a new event
 * 
 * Ex:
 * 
 *   url  : '/service/set-event.php'     
 *   data : 'hash=24d41cbb3921de48891673a1add2940d&id=1&name=test&description=test&type=1&lat=43&lng=-2.5'
 *   type : 'post'
 * 
 * Ex:
 * 
 *     <form name="send" action="service/set-event.php" method="post" enctype="multipart/form-data">
 *       <input type="hidden" name="hash" value="24d41cbb3921de48891673a1add2940d" />
 *       <input type="hidden" name="name" value="xxxx" />
 *       <input type="hidden" name="description" value="xxxxxxxxxxxxxxxx" />
 *       <input type="hidden" name="type" value="1" />
 *       <input type="hidden" name="lat" value="43" />
 *       <input type="hidden" name="lng" value="-3" />
 *       <input type="file" name="images[]" multiple />
 *       <input type="submit" value="Enviar" />
 *      </form>  
 * 
 * The response is JSON : 'ok' or an error
 *
 * @author Javier Urrutia
 */

include '../app.php';

use AmfFam\MendiakGarbi\Util\Request          as Request;
use AmfFam\MendiakGarbi\Util\StringValidator  as StringValidator;
use AmfFam\MendiakGarbi\Util\FloatValidator   as FloatValidator;

use AmfFam\MendiakGarbi\Util\ImageProcess     as ImageProcess;

/** Required models */
use AmfFam\MendiakGarbi\Model\Event           as Event;
use AmfFam\MendiakGarbi\Model\Image           as Image;

/** Required DAO */
use AmfFam\MendiakGarbi\DAO\EventDAO          as EventDAO;
use AmfFam\MendiakGarbi\DAO\UserDAO           as UserDAO;
use AmfFam\MendiakGarbi\DAO\ImageDAO          as ImageDAO;

/** Rqueired Exceptions */
use AmfFam\MendiakGarbi\Exception\UserNotFoundException    as UserNotFoundException;
use AmfFam\MendiakGarbi\Exception\InvalidArgumentException as InvalidArgumentException;
use AmfFam\MendiakGarbi\Exception\InvalidDataException     as InvalidDataException;

// Get the user hash
try {

    $hash= Request::post( 'hash', new StringValidator([
        'size'      => 32,
        'nullable'  => false
    ]));

} catch( InvalidDataException $e) {

    Request::setStatus( Request::HTTP_BAD_REQUEST);
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

    $images= Request::files( 'images');

    foreach( $images as $index => $image) {

        $target =  DIRECTORY_SEPARATOR . ( APP_FOLDER == '' ? '' : APP_FOLDER  ) . 
                DIRECTORY_SEPARATOR . STORE_FOLDER . 
                DIRECTORY_SEPARATOR . 'img' . 
                DIRECTORY_SEPARATOR . md5( time()) . Request::JPG_EXTENSION;

        Request::move_file( $image, $target);

        $images[ $index]= $target;

    }
        
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
$event_id = $eventDAO->save( $event);

// Save the images
    
foreach( $images as $image) {
    
    // Save the image
    $imageDAO = new ImageDAO;
    $image_id=$imageDAO->save( new Image([
        'event' => $event_id,
        'image' => basename( $image)
    ]));

    // Create thumbnail
    ImageProcess::get_thumb( $image);

}


?>