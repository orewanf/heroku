<?php
namespace Adi\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;
use Silex\ControllerProviderInterface;
use Adi\Middlewares\Middleware;

class HomeController implements ControllerProviderInterface
{
  public function connect(Application $app) {
    $global = $app["controllers_factory"];

    $global->get("/", function() use ($app) {
      return "Home page";
    });

    $global->before($app["middleware.mustBeLogged"]);

    return $global;
  }
}
