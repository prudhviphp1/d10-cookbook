<?php

namespace Drupal\firstmodule\Routing;

use Symfony\Component\Routing\Route;

class CustomRoutes {
  public function routes() {
    $routes = [];
    // Create mypage route programmatically
    $routes['firstmodule.mypage'] = new Route(
    // Path definition
      'mypage',
      // Route defaults
      [
        '_controller' =>
          '\Drupal\firstmodule\Controller\HelloDrupalController::customPage',
        '_title' => 'First custom page',
      ],
      // Route requirements
      [
        '_permission' => 'access content',
      ]
    );
    return $routes;
  }
}
