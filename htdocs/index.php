<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$config = include __DIR__ . '/../src/Resources/config/config.php';
foreach ($config as $k => $v) {
    $app[$k] = $v;
}

$app['yaml.loader'] = function() {
    return new Symfony\Component\Yaml\Yaml();
};

$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => '../src/Resources/views/',
    'twig.options' => [
        'debug' => $app['debug'],
        'cache' => __DIR__ . '/../cache/twig',
        'strict_variables' => $app['debug']
    ]
]);
$app['twig']->addExtension(new KNorbert\Twig\Extension\KeywordHighlighter());
$app['twig']->addExtension(new KNorbert\Twig\Extension\Analytics($app['uaCode']));

$app->get('/', function () use ($app) {
    $file = '../' . $app['cv'];
    if (!file_exists($file)) {
        throw new RuntimeException("Cannot find the data file, '$file'. Did you create it?");
    }
    $cv = $app['yaml.loader']->parse($file);
    return $app['twig']->render('cv.twig', $cv);
});

$app->run();
