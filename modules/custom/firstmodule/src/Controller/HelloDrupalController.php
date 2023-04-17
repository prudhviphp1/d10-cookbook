<?php

namespace Drupal\firstmodule\Controller;

use Drupal\Core\Controller\ControllerBase;

class HelloDrupalController extends ControllerBase {

  /**
   * Returns markup for our custom page.
   *
   * @returns array
   *   The render array.
   * Defining Controller for the routing
   */
  public function page(): array {
    return [
      '#markup' => '<p>Hello Drupal10!</p>'
    ];
  }

}
