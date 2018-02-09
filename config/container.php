<?php
/**
 * A utiliser avec la classe de container de veka-server/container
 */

use Intervention\Image\ImageManager;

$config = \VekaServer\Config\Config::getInstance();

return array(

    /**
     * Instancie et parametre le Renderer TWIG
     */
    'Renderer'  => function() use($config) {
        return new VekaServer\TwigRenderer\TwigRenderer(
            $config->getSetting('view.path'),
            $config->getSetting('cache.path')
        );
    },

    /**
     * Le gestionnaire de retouche d'image
     */
    'Image'  => function() {
        return new ImageManager(array('driver' => 'gd'));
    }



);






