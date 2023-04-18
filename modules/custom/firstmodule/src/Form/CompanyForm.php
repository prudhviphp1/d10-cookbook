<?php

namespace Drupal\firstmodule\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class CompanyForm extends FormBase {

  /**
   * Implement getFormId() method.
   * @return string|void
   */
  public function getFormId()
  {
    return 'company_form';
  }

  /**
   * Implement buildForm() method.
   *
   * @param array $form
   * @param FormStateInterface $form_state
   * @return array|void
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $company_settings = $this->config('firstmodule.company_settings');
    $form['company_name'] = [
      '#type' => 'textfield',
      '#title'=> 'Company Name',
      '#default_value' => $company_settings->get('company_name'),
    ];

    $form['company_telephone'] = [
      '#type' => 'tel',
      '#title' => 'Company Telephone number',
      '#default_value' => $company_settings->get('company_telephone'),
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions'] = [
      '#submit' => 'submit',
      '#value' => 'Submit',
    ];
    return $form;
  }

  /**
   * Implement submitForm() method.
   *
   * @param array $form
   * @param FormStateInterface $form_state
   * @return void
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    // TODO: Implement submitForm() method.
  }
}
