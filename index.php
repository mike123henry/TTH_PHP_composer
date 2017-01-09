<?php
require '/vendor/autoload.php';
//require __DIR__ . '/vendor/autoload.php';

date_default_timezone_set ( 'America/Chicago');

//setup logger module
//use Monolog\Logger;
//use Monolog\Handler\StreamHandler;

// $log = new Logger('name');
// $log->pushHandler(new StreamHandler('app.log', Logger::WARNING));
// $log->addWarning('Fooxxx');

//Instantiate a Slim applicationn and use the Views\Twig switch
$app = new \Slim\Slim(array(
    'view' => new \Slim\Views\Twig()
));
$view = $app->view();
$view->parserOptions = array(
    'debug' => true
);
$view->parserExtensions = array(
    new \Slim\Views\TwigExtension()
);

//Define a Home HTTP GET route
$app->get('/', function () use($app) {
    $app->render('about.twig');
});

//Define a contact HTTP GET route
$app->get('/contact', function () use($app) {
    $app->render('contact.html');
});

//run the app
$app->run();



?>