<?php

namespace Drupal\firstmodule\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\user\UserInterface;

class HelloDrupalController extends ControllerBase {

  /**
   * Returns markup for our custom page.
   *
   * @returns array
   *   The render array.
   * Defining Controller for the routing "/hello-drupal" path page
   */
  public function page(): array {
    return [
      '#markup' => '<p>Hello Drupal10!</p>'
    ];
  }

  /**
   * Returns markup for our custom page.
   *
   * @param \Drupal\user\UserInterface $user
   *   The user parameter
   *
   * @returns array
   *   The render array.
   * Defining Controller for routing with the user route parameter (i.e '/hello-drupal/{user}') path.
   */
  public function user(UserInterface $user): array {
    return [
      '#markup' => sprintf('<p>Hello %s!</p>', $user->getEmail()),
    ];
  }

}
