<?php

namespace AmfFam\MendiakGarbi\Exception;

/**
 * The interface JSONSerializableException
 * 
 * @author Javier Urrutia
 * 
 */
interface JSONSerializableException
{

    /**
     * Serialize the exception to JSON
     * 
     * @return string                       A JSON object 
     */
    function toJSON();
    
}

?>