<?php

/**
 * Home Controller
 * 
 * @author Javier Urrutia
 */

include 'app.php';

use AmfFam\MendiakGarbi\Util\Lang           as Lang;
use AmfFam\MendiakGarbi\Util\ModelAndView   as ModelAndView;
use AmfFam\MendiakGarbi\Util\Request        as Request;

/** Required DAO */
use AmfFam\MendiakGarbi\DAO\EventDAO        as EventDAO;
use AmfFam\MendiakGarbi\DAO\UserDAO         as UserDAO;

use AmfFam\MendiakGarbi\Controller\FrontController         as FrontController;

/** Required Exceptions */
use AmfFam\MendiakGarbi\Exception\ApplicationException     as ApplicationException;

/** 
 * Get the controller, the action and the args
 *
 * Examples:
 * 
 *              route                      Controller           Action          Args
 *              ============================================================================================
 *              /                          HomeController       default         []
 *              /create                    CreateController     default         []
 *              /event/list                EventController      list            []
 *              /event/edit/1              EventController      edit            [ 'id' => 1 ]
 *              /event/edit/name/lucas     EventController      edit            [ 'name' => 'lucas' ]
 */

$request= Request::getCurrentRequest();

try{ 
    
    $frontController = new FrontController( [
        'controller' => $request['controller'],
        'action'     => $request['action'],
        'args'       => $request['args']  
    ]);

    $frontController->execute();

} catch( \Exception $e) {

    Request::setStatus( Request::HTTP_NOT_FOUND);
    echo $e->get_message();
    exit();
}

?>