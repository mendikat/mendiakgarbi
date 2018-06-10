<?php

namespace AmfFam\MendiakGarbi\Util;

/**
 * Managing the views
 * 
 * We use the Blade system template
 * @see https://laravel.com/docs/5.6/blade
 * 
 * @author Javier Urrutia
 */

use AmfFam\MendiakGarbi\Util\Lang as Lang;

use Jenssegers\Blade\Blade        as Blade;

class ModelAndView extends Blade {

    /**
     * @var string                      The name of the view
     */
    protected $_view;

    /**
     * The constructor
     * 
     * @param  string  $name            The name of the view
     *                                  the file can found in the apllication views folder as name.balde.php
     * @return void
     */
    public function __construct( string $view) {

        $this->_view= $view;
        parent::__construct( APP_VIEWS_FOLDER, 'cache');

    }

    /**
     * Render the view
     * 
     * @param  array   $model            An associative array with the values to inject into the view
     * 
     * @return void
     */
    public function show( array $model=[]) {
        
        echo parent::make( $this->_view, array_merge( 
            [ 'lang' =>  Request::getCookie( 'lang', Lang::LANG_ES) ] , 
            Lang::translate(), 
            $model
        ));
        
    }

    /**
     * Get the result of the processed view
     * 
     * @param array   $model            An associative array with the values to inject into the view
     */
    public function get( array $model=[]) {

        return parent::make( $this->_view, array_merge( 
            Lang::translate(), 
            [ 
                'lang'         => Request::getCookie( 'lang', Lang::LANG_ES), 
                'url' => '/' . APP_FOLDER
            ] , 
            $model
        ));

    }

    /**
     * Get the name of the view
     *
     * @return  string                  The name of the view
     */ 
    public function get_view()
    {
        return $this->_view;
    }

    /**
     * Set the name of the view
     *
     * @param  string  $view            The name of the view
     *
     * @return  self
     */ 
    public function set_view(string $view)
    {
        $this->_view = $view;

        return $this;
    }
}

?>