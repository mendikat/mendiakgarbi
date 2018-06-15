<?php

/**
 * Create a new user if not exists
 * 
 * Ex:
 * 
 *   url  : '/service/set-user.php'     
 *   data : 'eve&email=eve@mendiakgarbi.org&hash=24d41cbb3921de48891673a1add2940d'
 *   type : 'post'
 * 
 * The response is JSON : 'ok' or an error
 *  
 * @author Javier Urrutia
 */

include '../app.php';

use AmfFam\MendiakGarbi\Util\Request          as Request;
use AmfFam\MendiakGarbi\Util\StringValidator  as StringValidator;
use AmfFam\MendiakGarbi\Util\EmailValidator   as EmailValidator;

use AmfFam\MendiakGarbi\model\User            as User;
use AmfFam\MendiakGarbi\DAO\UserDAO           as UserDAO;

/** Required exceptions */
use AmfFam\MendiakGarbi\Exception\UserNotFoundException     as UserNotFoundException;
use AmfFam\MendiakGarbi\Exception\InvalidDataException      as InvalidDataException;
use AmfFam\MendiakGarbi\Exception\InvalidArgumentException  as InvalidArgumentException;


// Get the user properties
try {

    $name= Request::post( 'name', new StringValidator([
        'size'      => 50,
        'nullable'  => false
    ]));

    $email= Request::post( 'email', new EmailValidator([
        'size'      => 70,
        'nullable'  => false
    ]));

    $hash= Request::post( 'hash', new StringValidator([
        'size'      => 32,
        'nullable'  => false
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

// Verify the email agains the hash value
// for verify the concordance 
if ( $hash != md5( $email)) {

    Request::setStatus( Request::HTTP_BAD_REQUEST);
    header( Request::MIMETYPE_JSON );
    echo json_encode( [
        'message' => 'No se ha proporcionado un conjunto de datos válido para esta solicitud.'
    ]);
    die();
}


// Create a new user

$user = new User([
    'name'   => $name,
    'email'  => $email,
    'hash'   => $hash,
    'access' => 1
]);

// Check if user exists
$userDAO = new userDAO;

try {  
    
    $userDAO->findByHash( $hash);

} catch( UserNotFoundException $e) {

    $userDAO->save( $user);

}

// Send JSON response

Request::setStatus( Request::HTTP_OK);
header( Request::MIMETYPE_JSON );
echo json_encode( 'ok');

?>