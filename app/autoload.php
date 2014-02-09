<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;


/**
 * @var ClassLoader $loader
 */
$loader = require __DIR__.'/../vendor/autoload.php';

//custom for Application
$loader->add("Application", __DIR__);

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

// Add mongo DB annotation
AnnotationDriver::registerAnnotationClasses();

return $loader;
