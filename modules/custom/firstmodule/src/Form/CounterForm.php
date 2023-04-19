<?php

namespace Drupal\firstmodule\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class CounterForm extends FormBase {

  /**
   * Implement getFormId() method
   * @return string|void
   */
  public function getFormId()
  {
    return 'firstmodule_counter_form';
  }

  /**
   * Implements buildForm() method
   *
   * @param array $form
   * @param FormStateInterface $form_state
   * @return array
   *
   * Creating the Counter form and incrementing it whenever we hit the increment button
   * using ajaxRefresh callback method
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $count = $form_state->get('count') ?: 0;

    $form['counter'] = [
      '#markup' => "<p>Total count: $count",
      '#prefix' => '<div id="counter">',
      '#suffix' => '</div>',
    ];

    $form['increment'] = [
      '#type' => 'submit',
      '#value' => 'Increment',
      '#ajax' => [
        'callback' => [$this, 'ajaxRefresh'],
        'wrapper' => 'counter',
      ],
    ];

    return $form;
  }

  /**
   * Implements ajaxRefresh callback method
   * @param array $form
   * @param FormStateInterface $form_state
   * @return mixed
   */
  public function ajaxRefresh(array $form, FormStateInterface $form_state)
  {
   return $form['count'];
  }

  /**
   * Implements submitForm() method
   * @param array $form
   * @param FormStateInterface $form_state
   * @return void
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $count = $form_state->get('count') ?: 0;
    $count++;
    $form_state->set('count', $count);
    $form_state->setRebuild();
  }
}
