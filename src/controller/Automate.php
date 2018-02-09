<?php
/**
 * Created by PhpStorm.
 * User: nvanhaezebrouck
 * Date: 09/11/2017
 * Time: 20:25
 */

namespace App\controller;


use App\classe\GalleryUtils;
use Intervention\Image\Image;
use VekaServer\Config\Config;
use VekaServer\Container\Container;

class Automate
{


    public function AnalyseImageFolder(){

        ini_set('memory_limit','256M');

        // recuperation de la liste des images du dossier
        $Gu = new GalleryUtils();
        $path = (Config::getInstance())->getSetting('images_directory');
        $images = $Gu->parseDirectory($path);

        $path_destination = (Config::getInstance())->getSetting('images_uploaded_image');

        /* @var Image*/
        $manager_image = Container::getInstance()->get('Image');

        $nb_image_added = 0;
        $nb_image_ignored = 0;
        foreach ($images as $image_path) {

            // use md5 as name
            $name = md5_file($image_path).'.jpg';

            // si image deja presente ou passe a la suivante
            if($this->is_already_added($path_destination.$name)) {
                $nb_image_ignored++;
                continue;
            }

            // open image source
            $img = $manager_image->make($image_path);

            // resize image and keep ratio
            $img->resize(220, 165, function ($constraint) {
                $constraint->aspectRatio();
            });

            // save image in desired format
            $img->save($path_destination.$name);

            $nb_image_added++;
        }

        echo $nb_image_added.' image(s) added<br/>';
        echo $nb_image_ignored.' image(s) ignored';
    }

    private function is_already_added($file){
        return is_file($file);
    }

}