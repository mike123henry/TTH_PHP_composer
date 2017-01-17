<?php
//require('/vendor/autoload.php');
require __DIR__ . '/vendor/autoload.php';

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
})->name('home');

//Define a contact HTTP GET route
$app->get('/contact', function () use($app) {
    $app->render('contact.twig');
})->name('contact');

$app->post('/contact', function () use($app) {
    $name = $app->request->post('name');
    $email = $app->request->post('email');
    $msg = $app->request->post('msg');
    if(!empty($name) && !empty($email) && !empty($msg)){
        //clean up entries
        $cleanName = filter_var($name, FILTER_SANITIZE_STRING);
        $cleanEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
        $cleanMsg = filter_var($msg, FILTER_SANITIZE_STRING);

    } else {
        //flag for empty field
        $app->redirect('contact');
    }


    $transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
    $mailer = \Swift_Mailer::newInstance($transport);

    $message = \Swift_Message::newInstance();
    $message -> setSubject('Email From TTH_PHP_composer website');
    $message -> setFrom(array(
        $cleanEmail => $cleanName
        ));
    $result = $mailer->send($message);

    if($result > 0 ){
        //send a thank you message
        $app->redirect('/');
    } else {
        //send email not sent error message
        $app->redirect('contact');
    }
});
//run the app
$app->run();



?>