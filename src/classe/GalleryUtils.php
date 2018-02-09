<?php
/**
 * Created by PhpStorm.
 * User: nvanhaezebrouck
 * Date: 30/10/2017
 * Time: 17:57
 */

namespace App\classe;

class GalleryUtils
{

    private static $granted_format = [IMAGETYPE_GIF,IMAGETYPE_JPEG,IMAGETYPE_PNG] ;

    /**
     * Retourne la liste des images du dossier
     * @param $dir string Chemin vers le dossier a lire
     * @return array
     */
    public function parseDirectory($dir){
        $dh  = opendir($dir);
        $files = [];
        while (false !== ($filename = readdir($dh))) {

            if($this->isImage($dir.$filename)){
                $files[] = $dir.$filename;
            }

        }
        return $files;
    }


    /**
     * Verifie que le fichier a un format autorisé
     * @param $filename string Chemin vers le fichier
     * @return bool
     */
    private function isImage($filename){
        if(is_file($filename))
            return in_array(getimagesize($filename)[2], self::$granted_format);
    }

}