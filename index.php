<?php

error_reporting(E_ALL);
ini_set("display_errors",1);

/***
 * This function will generate a thumnail in png format for a pdf document using
 * ImageMagick -  http://php.net/imagick
 * Ghostscript -  https://sourceforge.net/projects/ghostscript/
 * @param $source - string - relative path to the source pdf (for example : ./originals/lorem-ipsum.pdf ) 
 * @param $destination - string - relative path to the directory where you want to place the generated thumbnail (for example : './thumnails')
 * @param $fileName - string - file name of the  thumbnail with out extension (for example : pdfthumbdemo )
 * @param width - number - width of the thumbnail
 * @param height  - number - height of the thumbnail 
 */


function generateThumbnail($source, $destination, $fileName, $width, $height)
{
    try {
        $source = realpath($source);
        $destination = realpath($destination) . DIRECTORY_SEPARATOR . $fileName . ".png";

        $imagick = new Imagick();
        $imagick->readImage($source . "[0]");
        $imagick->thumbnailimage($width, $height);
        $imagick->setIteratorIndex(0);
        $imagick->writeImages($destination, false);
        $imagick->clear();
        $imagick->destroy();
        return true;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}


/*

Usage example : 

var_dump(generateThumbnail('./originals/lorem-ipsum.pdf','./thumnails','pdfthumbdemo',500,500));

*/



?>