<?php

namespace AmfFam\MendiakGarbi\Controller;

use AmfFam\MendiakGarbi\Util\Lang               as Lang;
use AmfFam\MendiakGarbi\Util\ModelAndView       as ModelAndView;
use AmfFam\MendiakGarbi\Util\Request            as Request;

/** Required DAO */
use AmfFam\MendiakGarbi\DAO\EventDAO            as EventDAO;
use AmfFam\MendiakGarbi\DAO\TypeDAO             as TypeDAO;
use AmfFam\MendiakGarbi\DAO\StatusDAO           as StatusDAO;
use AmfFam\MendiakGarbi\DAO\HistDAO             as HistDAO;
use AmfFam\MendiakGarbi\DAO\ImageDAO            as ImageDAO;

/** Required Excpections */
use AmfFam\MendiakGarbi\Exception\InvalidArgumentException as InvalidArgumentException;

/**
 *  The AdminController class
 * 
 *  @author Javier Urrutia
 */
class AdminController extends BaseController {

    /** The view. */
    const VIEW = 'admin';

    protected $_eventDAO;
    protected $_statusDAO;
    protected $_typeDAO;
    protected $_histDAO;
    protected $_imageDAO;

    /**
     * The constructor.
     * 
     * @param  array    $options            An array of options
     * 
     */
    public function __construct( array $options) {
                
        /** Load the required DAO */
        $this->_eventDAO  = new EventDAO;
        $this->_statusDAO = new StatusDAO;
        $this->_typeDAO   = new TypeDAO;
        $this->_histDAO   = new HistDAO;
        $this->_imageDAO  = new ImageDAO;
        
        parent::__construct( $options);


        /** Check the Auth cookie */
        $session= Request::getCookie( 'session', null);
   
        $user_agent = Request::getUserAgent();

        if ( !$session || ( $session != sha1( ADMIN_USERNAME . ADMIN_PASSWORD . $user_agent ) ) ) {
            //Request::removeCookie( 'session');
            //Request::redirect( '/login');
            die( "NO hay sesión");
        }


    }

    /**
     * The default action
     * 
     * @return void
     */
    public function default() {

        $events = $this->_eventDAO->findAll();
        $types  = $this->_typeDAO->findAll();
        $status = $this->_statusDAO->findAll();

        /** Load the admin view */
        $mav= new ModelAndView( self::VIEW);

        /** Render the page */
        $mav->show( [
            'page_title'    => Lang::get( 'app.admin.title'),
            'events'        => $events,
            'status'        => $status,
            'types'         => $types
        ]);
    }

    /**
     * Change the status of the event
     * 
     * @return void
     */
    public function status() {

        $id     = Request::post( 'id');
        $status = Request::post( 'status');
 
        $event= $this->_eventDAO->findById( $id);
        $event->set_status( $this->_statusDAO->findById( $status));    

        $this->_eventDAO->save( $event);

        die ( 'ok');

    }

    /**
     * Set the text for the historic
     * 
     * @return void
     */
    public function text() {

        $text   = Request::post( 'text');

        $this->_histDAO->update_text( $text);

        die ( 'ok');

    }

    /**
     * Save of the event
     * 
     * @return void
     */
    public function save() {

        $id= Request::post( 'id');
  
        $event= $this->_eventDAO->findById( $id);

        $name= Request::post( 'name');
        $description= Request::post( 'description');
        $type= Request::post( 'type');
 
        $event->set_name( $name);
        $event->set_description( $description);
        $event->set_type(  $this->_typeDAO->findById( $type));

        $this->_eventDAO->save( $event);

        die( 'ok');

    }

    /**
     * Get the event history
     * 
     * @return void
     */
    public function hist() {

        $id = Request::post( 'id');

        $hists= $this->_histDAO->findByEvent( $id, true);    
       
        echo json_encode( $hists);
        die();

    }


    /**
     * Get the images of event
     * 
     * @return void
     */
    public function image() {

        $id = Request::post( 'id');

        $images= [];
        foreach( $this->_imageDAO->findByEvent( $id) as $image)
            $images[]= Request::getFullUrl( ( APP_FOLDER != '' ? '/' .APP_FOLDER . '/' : '/' ) . STORE_FOLDER . '/img/thumbs/'. $image->get_image());

        echo json_encode( $images);
        die();

    }

    /**
     * Delete the event
     * 
     * @return void
     */
    public function delete() {

        $id    = Request::post( 'id');
        $event = $this->_eventDAO->delete( $id);

        die ( 'ok');

    }



}

?>