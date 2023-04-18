<?php

namespace Drupal\firstmodule\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Url;
use Drupal\node\NodeInterface;

/**
 * @param Request $request
 * @return JsonResponse
 *
 * Creating the content for article nodes by using POST method in the routing file
 */
class ArticleController extends ControllerBase {

  public function store(Request $request): JsonResponse {

    $content = $request()->getContent();

    // Getting the content and then serializing it into JSON
    $json = \Drupal\Component\Serialization\Json::decode($content);

    $entity_type_manager = $this->entityTypeManager();
    $node_content = $entity_type_manager->getStorage('node');

    // Creating the article nodes with the above JSON content
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

  /**
   * @param Request $request
   * @return JsonResponse
   *
   * Getting the article nodes & checking the access_checks and then sorting the content with DESC at top
   * by using GET method in routing file
   */
  public function index(Request $request): JsonResponse {

    // Getting the content and then sorting it out
    $sort = $request->query->get('sort', 'DESC');

    $entity_type_manager = $this->entityTypeManager();
    $node_content = $entity_type_manager->getStorage('node');

    // Checking the access_check for the node_content
    $query = $node_content->getQuery()
      ->accessCheck('TRUE');

    // Checking the Entity Query Conditions
    $query->condition('type','article');
    $query->condition('status','TRUE');
    $query->sort('created',$sort);
    $node_id = $query->execute();

    $nodes = $node_content->loadMultiple($node_id);
    $nodes = array_map(function (\Drupal\node\NodeInterface $node) {
      return $node->toArray();
    }, $nodes);

    return new JsonResponse($nodes);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   *
   * Checking the user_access for the node route parameter in the routing file
   */
  public function get(\Drupal\node\NodeInterface $node): JsonResponse {

    $entity_type_manager = $this->entityTypeManager();
    // Checking whether user has access for viewing the node
    $access_handler = $entity_type_manager->getAccessControlHandler('node');

    $node_access = $access_handler->access($node, 'view');

    // Show 404 page if the user doesn't have the access
    if (!$node_access) {
      return new JsonResponse(NULL,404);
    }

    return new JsonResponse(
      $node->toArray(),
    );
  }

  /**
   * @param Request $request
   * @return JsonResponse
   *
   * Updating the content in the node
   */
  public function update(Request $request, NodeInterface $node): JsonResponse {

    $content = $request->getContent();
    $json = \Drupal\Component\Serialization\Json::decode($content);

    if(isset($json['title'])) {
      $node->setTitle($json['title']);
    }

    if(isset($json['body'])) {
      $node->set('body', $json['body']);
    }

    // Checking whether the updated node have any voilations
    $constraint_voilations = $node->validate();
    if(count($constraint_voilations) > 0) {
      $errors[] = 0;
      foreach($constraint_voilations as $voilations){
        $errors[] = $voilations->getPropertyPath() .': ' . $voilations->getMessage();
      }
      return new JsonResponse($errors, 400);
    }
    $node->save();
    return new JsonResponse(
      $node->toArray(),
    );
  }

  /**
   * @param Request $request
   * @return JsonResponse
   *
   * Deleting the node
   */
  public function delete( NodeInterface $node): JsonResponse {

    $node->delete();
    return new JsonResponse(null, 404);
  }
}
