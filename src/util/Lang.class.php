<?php

namespace AmfFam\MendiakGarbi\Util;

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
     * An associative array with the translations
     * Is the dictionary
     * 
     * @var string   $lang          The language. Use Lang::LANG_ES | Lang::LANG_EU 
     */
    protected $_dict;

    public function __construct( string $lang = self::LANG_EU) {

        /** Load the dictionary */
        foreach( file( 'resources/lang/' . $lang . '/messages.properties') as $line) {
            list( $key, $value) = explode ( '=' , $line); 
            $this->_dict[ $key]= $value;
        }

    }

    /**
     * Get the translation
     * 
     * @param  string   $key        The key
     */
    public function _( string $key) {
        return $this->_dict[ $key] ?? '{'.$key.'}';
    }

}

?>