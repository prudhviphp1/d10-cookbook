<?php

namespace Drupal\firstmodule\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Url;

class ArticleController extends ControllerBase {

  public function store(Request $request): JsonResponse {

    $content = $request()->getContent();
    $json = \Drupal\Component\Serialization\Json::decode($content);

    $entity_type_manager = $this->entityTypeManager();
    $node_content = $entity_type_manager->getStorage('node');

    $article = $node_content->create([
      'type'  => 'article',
      'title' => $json['title'],
      'body'  => $json['body'],
      ]);
    $article->save();

    $article_url = $article->toUrl()->setAbsolute()->toString();
    return new JsonResponse(
      $article->toArray(),
      201,
      ['Location' => $article_url ],
    );
  }

}
