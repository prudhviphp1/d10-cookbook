<?php

namespace Drupal\thirdmodule\Entity;

use Drupal\node\Entity\Node;
use Drupal\Core\Field\EntityReferenceFieldItemListInterface;

class Recipe extends Node {

  public function getTags(): array {
    /** @var \Drupal\Core\Field\EntityReferenceFieldItemListInterface $field_tags */
    // Grabbing the taxonomy terms
    $field_tags = $this->get('field_tags');
    return $field_tags->referencedEntities();
  }

  public function getPrepTime(): int {
  // Grabbing the value in 'field_preparation_time' field
    return (int) $this->get('field_preparation_time')->value;
  }

  public function getCookTime(): int {
  // Grabbing the value in 'field_cooking_time' field
    return (int) $this->get('field_cooking_time')->value;
  }

}
