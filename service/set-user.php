<?php

/**
 * Create a new user if not exists
 * 
 * @author Javier Urrutia
 */

include '../config.php';

use AmfFam\MendiakGarbi\Util\Request          as Request;
use AmfFam\MendiakGarbi\Util\StringValidator  as StringValidator;

use AmfFam\MendiakGarbi\model\User            as User;
use AmfFam\MendiakGarbi\DAO\UserDAO           as UserDAO;

use AmfFam\MendiakGarbi\Exception\UserNotFoundException as UserNotFoundException;
use AmfFam\MendiakGarbi\Exception\InvalidDataException  as InvalidDataException;

// Get the user properties
try {

    $name= Request::get( 'name', new StringValidator([
        'size'      => 50,
        'nullable'  => false
    ]));

    $email= Request::get( 'email', new StringValidator([
        'size'      => 70,
        'nullable'  => false
    ]));

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

// Verify the email agains the hash value
// for verify the concordance 
if ( $hash != md5( $email)) {

    Request::setStatus( Request::HTTP_BAD_REQUEST);
    header( Request::MIMETYPE_JSON );
    json_encode( [
        'message' => 'Bad Request'
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