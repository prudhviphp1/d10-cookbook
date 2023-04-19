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

    //Grabbing the config from the already existing firstmodule.company_settings
    //for showing it in the deafult_value placeholder
    $company_settings = $this->config('firstmodule.company_settings');
    $form['company_name'] = [
      '#type' => 'textfield',
      '#title'=> 'Company Name',
      '#required' => TRUE,
      '#default_value' => $company_settings->get('company_name'),
    ];

    $form['company_telephone'] = [
      '#type' => 'tel',
      '#title' => 'Company Telephone number',
      '#required' => TRUE,
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
    //Saving the above data to firstmodule.company_settings config
    $config = $this->configFactory->getEditable('firstmodule.company_settings');

    $config->set('company_name', $form_state->getValue('company_name'));
    $config->set('company_telephone', $form_state->getValue('company_telephone'));
    $config->save();
    $this->messenger()->addStatus('Updated Copany Information');
  }
}
