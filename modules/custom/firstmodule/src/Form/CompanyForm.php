<?php

namespace Drupal\firstmodule\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * We can also extend ConfigFormBase for retrieving the config data by using getEditableConfigNames()  method
 * rather than using getEditable() method
 */
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
      #Adding the pattern which allows numbers(i.e 0-9) and dashes and paranthesis without
      # any regular alphabetic characters
      '#pattern' => '^[0-9-+\s()]*s',
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
   * Validating the Input Form elements
   *
   * @param array $form
   * @param FormStateInterface $form_state
   * @return void
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    //parent::validateForm($form, $form_state);
    $company_name = $form_state->getValue('company_name');
    //Checking if the company_name is set to boo then it should give the error
    if(str_contains($company_name, 'boo')) {
      $form_state->setErrorByName('company_name','Name cannot contain "boo"' );
    }
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
    $this->messenger()->addStatus('Updated Company Information');
  }
}
