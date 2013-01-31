<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../resources/twig'
));

$app->register(new SilexAssetic\AsseticExtension(), array(
    'assetic.path_to_web' => __DIR__,
    'assetic.options' => array(
        'auto_dump_assets' => true,
        'debug' => false
    ),
    'assetic.filters' => $app->protect(function($fm) {
        $fm->set('cssmin', new Assetic\Filter\CssMinFilter());
    })
));

$app->get('/', function() use ($app) {
    return $app['twig']->render('hello.twig');
});

$app->run();
