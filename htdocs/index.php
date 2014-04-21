<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = (bool) getenv('DEBUG');

$app['yaml.loader'] = new Symfony\Component\Yaml\Yaml();

$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => '../src/Resources/views/'
]);
$app['twig']->addExtension(new KNorbert\Twig\Extension\KeywordHighlighter());

$app->get('/', function () use ($app) {
    $file = '../src/Resources/data/cv.yml';
    if (!file_exists($file)) {
        throw new RuntimeException("Cannot find the data file, '$file'. Did you create it?");
    }
    $cv = $app['yaml.loader']->parse($file);
    return $app['twig']->render('cv.twig', $cv);
});

$app->run();
