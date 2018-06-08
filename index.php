<?php

include 'app.php';

use AmfFam\MendiakGarbi\Model\User    as User;
use AmfFam\MendiakGarbi\Model\Event   as Event;

use AmfFam\MendiakGarbi\DAO\EventDAO  as EventDAO;
use AmfFam\MendiakGarbi\DAO\UserDAO   as UserDAO;

use AmfFam\MendiakGarbi\Util\Request  as Request;
use AmfFam\MendiakGarbi\Util\Lang     as Lang;

use AmfFam\MendiakGarbi\Util\IntegerValidator    as IntegerValidator;
use AmfFam\MendiakGarbi\Util\StringValidator     as StringValidator;

use AmfFam\MendiakGarbi\Exception\InvalidDataException     as InvalidDataException;
use AmfFam\MendiakGarbi\Exception\InvalidArgumentException as InvalidArgumentException;

use Jenssegers\Blade\Blade;

/*
$user = new User;

$user->set_name( 'Joe Smith');
$user->set_email( 'joe@test.io');
$user->set_access( 1);

$userDAO = new UserDAO;

$userDAO->save( $user);

$theUser= $userDAO->findById( 1);

echo $theUser;

$theUser->set_name( 'lucas');

$userDAO->save( $theUser);

$anotherUser= $userDAO->findById( 1);

echo "<br />".$anotherUser;


$newUser= $userDAO->findByHash( '2cff30acaedf9d4975211f1dcf00caa6');

echo '<br />'.$newUser;
*/


/*
$userDAO = new UserDAO;

$event = new Event([
    'name'          => 'Example Name',
    'description'   => 'Example Description',
    'user'          =>  $userDAO->findById( 3),
    'type'          =>  1,
    'status'        =>  1
]);

echo $event;

$eventDAO = new EventDAO;

echo "<br>Descr = ".$event->get_description();

//$last_id= $eventDAO->save( $event);

echo "<div>Last id = ".$last_id."</div>";

*/

/*
$eventDAO = new EventDAO;

$events = $eventDAO->findByUserid( 3);

foreach ( $events as $event) {
    echo "<br />".$event;
}
*/


/*
$id= Request::get( 'id', new IntegerValidator([
    'min' => 1,
    'max' => 20,
    'default' => 109
]));
*/

//$id= Request::get( 'id');

/*
try {

    $id= Request::get( 'id', new StringValidator([
        'size' => 20
    ]));

} catch( InvalidDataException $e) {

    echo "Error : ".$e->get_message();
    die( "END");
}

echo "id=".$id;
*/

/*
$eventDAO = new EventDAO();

$events= $eventDAO->findByUserId(1);

foreach( $events as $event)
    echo "<br />".$event;
*/

/*
$userDAO = new userDAO;

$user= $userDAO->findByHash( '21020');

echo $user;
*/

/** Load the home view */
$blade = new Blade( 'resources/views', 'cache');

echo $blade->make( 'home', [
    'title' => Lang::get( 'app.title'),
    'collaborate_now' => 'Con'
]);

?>