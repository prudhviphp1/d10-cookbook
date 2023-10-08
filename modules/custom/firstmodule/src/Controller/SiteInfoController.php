<?php

namespace Drupal\firstmodule\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Cache\CacheableDependencyInterface

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

    // Adding the below line to cache the above config response so that config can only be invalidated
    // if there is any config change
    $response->addCacheableDependency($config);
    return $response;
  }
}
