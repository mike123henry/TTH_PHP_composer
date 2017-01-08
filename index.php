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
//Define a HTTP GET route
$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});
//run the app
$app->run();



?>