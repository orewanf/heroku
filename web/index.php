<?php

require("../app/bootstrap.php");

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application();
$app['debug'] = true;


// Register some services here
$app->register(new Silex\Provider\TwigServiceProvider(), array(
  "twig.path" => __DIR__.'/views'
));

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
// --- End of service definition ---


// Define some middleware function in here
$app["middleware.mustBeLogged"] = $app->protect(function(Request $request, Silex\Application $app) {
  $userSession = false;
  if (!$userSession) {
    return $app->redirect($app["url_generator"]->generate("login"));
  }
});

$app["middleware.mustBeGuest"] = function(Request $request, Silex\Application $app) {
  // todo
};
// --- End of middleware function definition ---


// Mount the required controller
$app->mount("/", new Adi\Controllers\HomeController());
$app->mount("/login", new Adi\Controllers\LoginController());
// --- End of mounting ---

// Last run the application
$app->run();
// --- End ---

// putenv("DATABASE_URL=postgres://mnfkzlhnihtmhc:DuetOyhHbhK9o7bDbGIT5CpAFX@ec2-107-21-223-110.compute-1.amazonaws.com:5432/dcvecfgg12j7um");

// // Register the monolog logging service
// $app->register(new Silex\Provider\MonologServiceProvider(), array(
//   'monolog.logfile' => 'php://stderr',
// ));

// // Register view rendering
// $app->register(new Silex\Provider\TwigServiceProvider(), array(
//     'twig.path' => __DIR__.'/views',
// ));

// $dbopts = parse_url(getenv('DATABASE_URL'));
// $app->register(new Herrera\Pdo\PdoServiceProvider(),
//   array(
//     'pdo.dsn' => 'pgsql:dbname='.ltrim($dbopts["path"],'/').';host='.$dbopts["host"],
//     'pdo.port' => $dbopts["port"],
//     'pdo.username' => $dbopts["user"],
//     'pdo.password' => $dbopts["pass"]
//   )
// );

// // Our web handlers

// $app->get('/', function() use($app) {
//   // $app['monolog']->addDebug('logging output.');
//   // return $app['twig']->render('index.twig');
//   return "hello";
// });

// // $app->get('/', function() use($app) {
// //   $app['monolog']->addDebug('logging output.');
// //   return str_repeat('Hello', getenv('TIMES'));
// // });

// $app->get('/cowsay', function() use($app) {
//   $app['monolog']->addDebug('cowsay');
//   return "<pre>".\League\Cowsayphp\Cow::say("Cool beans")."</pre>";
// });

// $app->get('/db/', function() use($app) {
//   $st = $app['pdo']->prepare('SELECT name FROM test_table');
//   $st->execute();

//   $names = array();
//   while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
//     $app['monolog']->addDebug('Row ' . $row['name']);
//     $names[] = $row;
//   }

//   return $app['twig']->render('database.twig', array(
//     'names' => $names
//   ));
// });
