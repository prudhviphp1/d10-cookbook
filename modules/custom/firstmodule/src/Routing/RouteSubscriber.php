<?php

namespace Drupal\firstmodule\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

class RouteSubscriber extends RouteSubscriberBase {
  /**
   * {@inheritdoc}
   */
  public function alterRoutes(RouteCollection $collection) {
    // Change path of firstmodule.hello_drupal to just 'hello'
    if ($route = $collection->get('firstmodule.hello_drupal')) {
      $route->setPath('/hello');
    }
  }
}
