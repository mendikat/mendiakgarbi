<?php

namespace AmfFam\MendiakGarbi\Controller;

/** Required Exceptions */
use AmfFam\MendiakGarbi\Exception\ApplicationException     as ApplicationException;

/**
 *  The BaseController class
 * 
 *  @author Javier Urrutia
 *  @abstract
 */
abstract class BaseController {

    /**
     * @var string                  An action
     */
    protected $_action;

    /**
     * @var array                   An array of arguments
     */
    protected $_args;

    /**
     * The constructor
     * 
     * @param  array                An options array
     *                              [
     *                                  'action' => $action,
     *                                  'args'   => $args
     *                              ]
     */
    public function __construct( array $options) {

        $this->_action= $options[ 'action'];
        $this->_args= $options[ 'args'];

    }

    /**
     * Get the action
     * 
     * @return string               The action
     */
    public function get_action() {

        return $this->_action;
    }

    /**
     * Set the action
     * 
     * @param   string  $action     The action
     * 
     * @return  self
     */
    public function set_action( string $action) {
        $this->_action= $action;
        return self;
    }

    /**
     * Get the arguments
     * 
     * @return array                An array with the action arguments
     */
    public function get_args() {

        return $this->_args;
    }

    /**
     * Set the arguments
     * 
     * @param   array  $args        The arguments
     * 
     * @return  self
     */
    public function set_args( array $args) {

        $this->_args= $args;
        return self;
    }

    /**
     * Execute the controller code
     * 
     * @return void
     */
    public function execute() {

        $action = $this->get_action();

        if ( $action == null || empty( $action))
            $this->default( $this->get_args());
        else 
            if ( method_exists( $this, $action ))
                $this->$action( $this->get_args());
            else
                throw new ApplicationException( 'Action '.$action.' not defined for '.get_class( $this).' controller');
    }

    /**
     * The default action
     * 
     * @return void
     */
    public abstract function default();

}

?>