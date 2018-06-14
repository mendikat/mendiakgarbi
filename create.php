<?php

/**
 * Create Controller
 * 
 * @author Javier Urrutia
 */

include 'app.php';

use AmfFam\MendiakGarbi\Util\Lang             as Lang;
use AmfFam\MendiakGarbi\Util\ModelAndView     as ModelAndView;
use AmfFam\MendiakGarbi\Util\Request          as Request;
use AmfFam\MendiakGarbi\Util\StringValidator  as StringValidator;
use AmfFam\MendiakGarbi\Util\EmailValidator   as EmailValidator;
use AmfFam\MendiakGarbi\Util\FloatValidator   as FloatValidator;
use AmfFam\MendiakGarbi\Util\Mail             as Mail;
use AmfFam\MendiakGarbi\Util\ImageProcess     as ImageProcess;

/** Required models */
use AmfFam\MendiakGarbi\Model\User          as User;
use AmfFam\MendiakGarbi\Model\Event         as Event;
use AmfFam\MendiakGarbi\Model\Image         as Image;

/** Required DAO */
use AmfFam\MendiakGarbi\DAO\UserDAO         as UserDAO;
use AmfFam\MendiakGarbi\DAO\EventDAO        as EventDAO;
use AmfFam\MendiakGarbi\DAO\TypeDAO         as TypeDAO;
use AmfFam\MendiakGarbi\DAO\ImageDAO        as ImageDAO;


/** Required exceptions */
use AmfFam\MendiakGarbi\Exception\UserNotFoundException     as UserNotFoundException;
use AmfFam\MendiakGarbi\Exception\InvalidDataException      as InvalidDataException;
use AmfFam\MendiakGarbi\Exception\InvalidArgumentException  as InvalidArgumentException;

if ( Request::isPost()) {

    /** Controller : POST request */

    // Get the form values
    try {

        $name= Request::post( 'name', new StringValidator([
            'size'      => 50,
            'nullable'  => false
        ]));

        $email= Request::post( 'email', new EmailValidator([
            'size'      => 70,
            'nullable'  => false
        ]));

        $event= Request::post( 'event', new StringValidator([
            'size'      => 50,
            'nullable'  => false
        ]));

        $type= Request::post( 'type');

        $description= Request::post( 'description', new StringValidator([
            'size'      => 255,
            'nullable'  => false
        ]));
        
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

    // Get the hash value
    $hash= md5( $email);

    // Create a new user if not exists
    $user = new User([
        'name'   => $name,
        'email'  => $email,
        'hash'   => $hash,
        'access' => 1
    ]);
    
    // Check if user exists
    $userDAO = new userDAO;
    
    try {  
        
        $user= $userDAO->findByHash( $hash);
    
    } catch( UserNotFoundException $e) {
    
        $id= $userDAO->save( $user);
        $user->set_id( $id);
    }

    // Create a new event

    $event= new Event([
        'name'          => $event,
        'description'   => $description,
        'type'          => $type,
        'user'          => $user,
        'status'        => 3,
        'lat'           => $lat, 
        'lng'           => $lng
    ]);

    // Save the new event

    $eventDAO = new EventDAO;
    $event_id = $eventDAO->save( $event);

    // Save the images
    $imageDAO = new ImageDAO;
          
    foreach( $images as $image) {
        
        // Save the image
        $image_id=$imageDAO->save( new Image([
            'event' => $event_id,
            'image' => basename( $image)
        ]));

        // Create thumbnail
        ImageProcess::get_thumb( $image);

    }
  
    // Send mail
    
    if ( MAIL_ENABLE) {

        $typeDAO = new typeDAO;

        $mail = new Mail;
        $mail->set_subject( 'Nueva incidencia registrada en Mendiak Garbi'); // Only ES
     
        $mav= new ModelAndView( 'mail/event');

        $mail->set_message( 
            $mav->get([
                'user'  => $user,
                'event' => $event,
                'type'  => $typeDAO->findById( $type)
            ])
        );

        $mail->add_recipient( MAIL_LIST);

        foreach( $images as $image) 
            $mail->add_attachment( ImageProcess::get_thumb( $image), 'mg-image-'.$image_id.'.jpg');
    

        $mail->is_HTML( true);

        $mail->send();
    
    }

    die( 'ok');
    
} else {

    /** Controller : GET request */

    // Get the types
    $typeDAO  = new TypeDAO;
    $types= $typeDAO->findAll();

    // Load the home view
    $mav= new ModelAndView( 'create');

    // Render the page
    $mav->show( [
        'page_title'    => Lang::get( 'app.create.title'),
        'lang'          => Lang::getLang(),
        'types'         => $types
    ]);

}

?>