<?php
require __DIR__ . '/vendor/autoload.php';

date_default_timezone_set ( 'America/Chicago');

//setup logger module
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// $log = new Logger('name');
// $log->pushHandler(new StreamHandler('app.log', Logger::WARNING));
// $log->addWarning('Fooxxx');

//Instantiate a Slim application:
$app = new \Slim\Slim();
//Define a Home HTTP GET route
$app->get('/', function () use($app) {
    $app->render('index.html');
});

//Define a contact HTTP GET route
$app->get('/contact', function () use($app) {
    $app->render('contact.html');
});

//run the app
$app->run();



?>