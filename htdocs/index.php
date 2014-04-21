<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = (bool) getenv('DEBUG');

$app['yaml.loader'] = new Symfony\Component\Yaml\Yaml();

$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => '../views/'
]);
$app['twig']->addExtension(new KNorbert\Twig\Extension\KeywordHighlighter());

$app->get('/', function () use ($app) {
    $cv = $app['yaml.loader']->parse('../data/cv.yml');
    return $app['twig']->render('cv.twig', $cv);
});

$app->run();
