<?php

namespace AmfFam\MendiakGarbi\Util;

use AmfFam\MendiakGarbi\Util\Request             as Request;
use AmfFam\MendiakGarbi\Util\StringValidator     as StringValidator;

/** Required exceptions */
use AmfFam\MendiakGarbi\Exception\InvalidDataException     as InvalidDataException;

/**
 * The class Lang
 * Provide simple translations
 * 
 * @author Javier Urrutia
 */
class Lang {

    /** Constants for languages */
    public const LANG_ES = 'es';
    public const LANG_EU = 'eu';

    /**
     * A singleton instance
     * 
     * @var self                        A singleton instance 
     */
    protected static $_instance = null;

    /**
     * An associative array with the translations
     * Is the dictionary
     * 
     * @var string                      An associative array used as dictionnary
     */
    protected $_dict;    

    /**
     * Hide constructor
     * 
     * @param  string  $lang            The language
     * 
     * @return void
     */
    private function __construct( string $lang = self::LANG_ES) {

        /** Load the dictionary */
        $lines= preg_split ( '/$\R?^/m', file_get_contents( 'resources/lang/' . $lang . '/messages.properties'));

        foreach( $lines as $line) {
            list( $key, $value) = explode ( '=' , $line); 
            $this->_dict[ $key]= $value;
        }

    }

    /**
     * Create an instance
     * 
     * @return  self                    An instance
     */
    private static function create() {

        if ( !isset( self::$_instance ) ) {
            
            $lang = Request::getCookie( 'lang');

            if ( !$lang) {
                $lang= self::LANG_ES;
                Request::setCookie( 'lang', $lang, 24);
            }
            
            self::$_instance = new Self( $lang);

        }

        return  self::$_instance;

    }

     /**
     * Create the singleton instance of this class
     * if not exists an returns the translation for the key
     * 
     * @param  string   $key            The key
     * 
     * @return string                   The translation for the given key 
     */
    public static function get( string $key) {
        
        self::create();
        
        return self::$_instance->_dict[ $key] ?? '{'.$key.'}';
    
    }

    /**
     * Generate an array with translations
     * 
     * @return array                    An array
     */
    public static function translate() {

        self::create();
        
        $arr=[];

        foreach( self::$_instance->_dict as $key => $value){
            // Replace . by _  Ex: app.name => app_name
            $arr[ str_replace( '.', '_', $key)]= $value;
        }

        return $arr;

    }

}

?>