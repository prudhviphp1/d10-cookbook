<?php

namespace Drupal\firstmodule\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;

class SiteInfoController extends ControllerBase {

  /**
   * Returns siteinfo in a JSON response.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   The JSON response.
   */
  public function page(): JsonResponse {
    $config = $this->config('system.site');
    return new JsonResponse([
      'name' => $config->get('name'),
      'slogan' => $config->get('slogan'),
      'email' => $config->get('email')
    ]);
  }
}
