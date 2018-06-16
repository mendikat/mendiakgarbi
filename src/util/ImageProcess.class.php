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
     * If thumnbail does not exists create,
     * else return the thumbnail path
     * 
     * @param  string    $filename          The filename
     * 
     * @return string                       The thumbnail path
     */
    public static function get_thumb( string $filename) {

        $dest = $_SERVER[ 'DOCUMENT_ROOT'] . str_replace( 'img', 'img' . DIRECTORY_SEPARATOR . 'thumbs', $filename);
        if ( file_exists( $dest)) return $dest;

        $src  = imagecreatefromjpeg( $_SERVER[ 'DOCUMENT_ROOT'] . $filename);


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

        return $dest;

    }

 }