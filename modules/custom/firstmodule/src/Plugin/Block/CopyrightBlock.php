<?php

namespace Drupal\firstmodule\Plugin;

use Drupal\Core\Block\BlockBase;

/**
 * @Block(
 *   id = "copyright_block",
 *   admin_label = @Translation("CopyrightBlock"),
 *   category = @Translation("Custom"),
 * )
 */
class CopyrightBlock extends BlockBase {

  /**
   * {@inheritDoc}
   */
  public function build()
  {
    $date = new \DateTime();
    return [
      '#markup' => $this->t('Copyright @year&copy; My Company',[
        '@year'=> $date->format('Y'),
      ]),
    ];
  }
}
