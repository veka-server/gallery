<?php
/**
 * Created by PhpStorm.
 * User: nvanhaezebrouck
 * Date: 30/10/2017
 * Time: 20:46
 */

namespace App\controller;

use App\classe\GalleryUtils;
use VekaServer\Config\Config;
use VekaServer\Container\Container;
use VekaServer\Interfaces\RendererInterface;

class Gallery
{

    public function accueil(){

        // recuperation de la liste des images du dossier
        $Gu = new GalleryUtils();
        $path = (Config::getInstance())->getSetting('images_uploaded_image');
        $images = $Gu->parseDirectory($path);

        /** @var RendererInterface $renderer */
        $renderer = Container::getInstance()->get('Renderer');
        echo $renderer->render('test.twig',
            [
                'images'=>$images,
                'title' => 'Simple image viewer'
            ]
        );
    }

}