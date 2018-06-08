<?php

include 'app.php';

use AmfFam\MendiakGarbi\Util\Lang           as Lang;
use AmfFam\MendiakGarbi\Util\ModelAndView   as ModelAndView;

/** Load the home view */
$mav= new ModelAndView( 'home');

/** Render the page */
$mav->render( [
    'page_title' => Lang::get( 'app.home')
]);

?>