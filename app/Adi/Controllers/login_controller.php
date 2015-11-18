<?php
namespace Adi\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;
use Silex\ControllerProviderInterface;

class LoginController implements ControllerProviderInterface
{
  public function connect(Application $app) {
    $login = $app["controllers_factory"];

    $login->get("/", function(Request $request) use ($app) {
      return $app["twig"]->render("index.twig");
    })->bind("login");

    $login->post("/", function(Request $request) use ($app) {});

    // $login->before($mustBeGuest);

    return $login;
  }
}
