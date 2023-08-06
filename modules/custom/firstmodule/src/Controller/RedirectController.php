<?php

namespace Drupal\firstmodule\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RedirectController extends ControllerBase {

  /**
   * Returns redirect to home or user login form based on the login status of user profile.
   *
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   *   The redirect response.
   */
  public function page(): RedirectResponse {
    if ($this->currentUser()->isAuthenticated()) {
      $route_name = '<front>';
    }
    else {
      $route_name = 'user.login';
    }
    $url = \Drupal\Core\Url::fromRoute($route_name);
    return new RedirectResponse($url->toString());
  }

}
