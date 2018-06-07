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
     * Serialize the excpetion to JSON
     * 
     * @return string                       A JSON object 
     */
    function toJSON();
    
}

?>