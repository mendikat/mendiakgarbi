<?php

namespace AmfFam\MendiakGarbi\Util;

/**
 * The class ImageProcess
 * 
 * @author Javier Urrutia
 * 
 */
 class ImageProcess {

    /**
     * Get thumbnail
     * 
     * @param  string    $filename          The filename
     * 
     * @return string                       the thumbnail
     */
    public static function get_thumb( string $filename) {

        $src  = imagecreatefromjpeg( $_SERVER[ 'DOCUMENT_ROOT'] . $filename);
        $dest = $_SERVER[ 'DOCUMENT_ROOT'] . str_replace( 'img', 'img' . DIRECTORY_SEPARATOR . 'thumbs', $filename);

        /* Read the source image an create a new virtual image */
        $width  = imagesx( $src);
        $height = imagesy( $src);

        $new_width  = 640;
        $new_height = floor( $height * $new_width / $width );

	    $new = imagecreatetruecolor( $new_width, $new_height);
	
        /* copy source image at a resized size */
        imagecopyresampled( $new, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        
        /* create the physical thumbnail image to its destination */
        imagejpeg( $new, $dest);

    }

 }