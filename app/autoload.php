<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/**
 * @var ClassLoader $loader
 */
$loader = require __DIR__.'/../vendor/autoload.php';

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

// $loader->add(
//     'Ivory\\CKEditorBundle' , __DIR__.'/../vendor/bundles'

// );
// $loader->add(
//	 	'PHPExcel' , __DIR__.'/../vendor/phpexcel/Classes'  // Amigo para el exportar excel (http://stackoverflow.com/questions/6402839/how-to-use-phpexcel-correctly-with-symfony-2)
// );

return $loader;
