<?php

namespace Drupal\firstmodule\Form;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ApprovalRequiredForm extends FormBase {

  /**
   * Implement getFormId() method
   * @return string|void
   */
  public function getFormId()
  {
   return 'firstmodule_approval_form';
  }

  /**
   * Implements buildForm() method
   *
   * @param array $form
   * @param FormStateInterface $form_state
   * @return array
   *
   * Creating the Approval form and having the Submit button with disabled state
   * when the Approval checkbox is not checked
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $form['approval'] = [
      '#type' => 'checkbox',
      '#title' => 'I acknowledge',
      '#required' => TRUE,
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions'] = [
      '#type' => 'submit',
      '#title' => 'Submit',
      '#states' => [
        'disabled' => [
          ':input[name="approval"]' => ['checked' => FALSE]
        ],
      ],
    ];

    return $form;
  }

  /**
   * Implements submitForm() method
   * @param array $form
   * @param FormStateInterface $form_state
   * @return void
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {

  }
}
