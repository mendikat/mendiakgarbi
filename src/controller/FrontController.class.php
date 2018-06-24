<?php

namespace AmfFam\MendiakGarbi\Controller;

use AmfFam\MendiakGarbi\Controller\AbstractController       as AbstractController;

/** Required Exceptions */
use AmfFam\MendiakGarbi\Exception\ApplicationException     as ApplicationException;

/**
 *  The FrontController class
 * 
 *  @author Javier Urrutia
 */
class FrontController extends BaseController {

    /**
     * @var string                          The controller
     */
    protected $_controller;

    /**
     * The constructor.
     * 
     * @param array  $options               An options array
     * 
     */
    public function __construct( array $options) {

        parent::__construct( $options);

        $this->_controller= $options[ 'controller'];

    }

    /**
     * Get the controller
     *  
     * @return string                      The controller
     */
    public function get_controller() {

        return $this->_controller;
    }

    /**
     * Set the controller
     * 
     * @param   string  $controller         The controller
     * 
     * @return  self
     */
    public function set_controller( string $controller) {
        $this->_controller= $controller;
        return self;
    }

    /**
     * Execute the controller code
     * 
     * @return  void
     */
    public function execute() {
        $this->default();
    }

    /**
     * The Default action
     * 
     * @return void
     */
    public function default() {

        if ( !$this->_controller) 
            throw new ApplicationException( 'Null Controller exception.');

        $class_name= $this->_controller;
        $class_path= $_SERVER[ 'DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . ( APP_FOLDER == '' ? '' : APP_FOLDER .  DIRECTORY_SEPARATOR ) . SRC_FOLDER . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . $this->_controller . '.class.php';

        if( ! file_exists( $class_path)) {
            throw new ApplicationException( 'Controller ' . $class_name . ' not found at ' . $class_path . '.');
        }
    
        $class= 'AmfFam\MendiakGarbi\Controller\\' . $class_name;
        $controller = new $class( [
            'action' => $this->_action,
            'args'   => $this->_args  
        ]);
        
        $controller->execute();

    }

}

?>