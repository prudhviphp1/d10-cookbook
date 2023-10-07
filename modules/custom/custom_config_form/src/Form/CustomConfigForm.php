<?php

namespace Drupal\custom_config_form\Form;

use Drupal\Core\Form\CustomConfigForm;
use Drupal\Core\Form\FormStateInterface;

class CustomConfigForm extends CustomConfigForm {

    /**
     * Settings Variables
     */
     CONST CONFIGNAME = "custom_config_form.settings";

     /**
      * {@inheritdoc}
      * Defining the custom_form_id name for this form
      */
      public function getFormId() {
       return "custom_config_form_settings";
      }

      /**
       * {@inheritdoc}
       */
       public function getEditableConfigNames() {
         return [
           staticname::CONFIGNAME,
         ];
       }

       /**
        * {@inheritdoc}
        * Defining the buildForm() method
        * To grab the values from 'custom_config_form_settings.yml' and setting them
        * as the default values and then giving the flexibility of updating the
        * values in the fields
        */
        public function buildForm(array $form, FormStateInterface $form_state) {
          $configform = $this->config(static::CONFIGNAME);
          $form['firstname'] = [
            '#type' => 'textfield',
            '#title' => 'First Name',
            '#default_value' => $configform->getValue('firstname');
          ];
          $form['lastname'] = [
             '#type' => 'textfield',
             '#title' => 'Last Name',
             '#default_value' => $configform->getValue('lastname');
          ];
          $targetids = $config->get("contents");
          $contents = [];
          // loading the node data based on the target_id using the 'entity_type.manager' service
          foreach ($targetids as $k => $value) {
             $contents[] = \Drupal::service("entity_type.manager")->getStorage('node')->load($value['target_id']);
          }
          // defining the 'contents' filed as entity_autocomplete
          $form['contents'] = [
             '#type' => "entity_autocomplete",
             '#title' => "Nodes",
             '#target_type' => "node",
             '#selection_settings' => [
             'target_bundles' => ["page", "article"],
             ],
             '#tags' => TRUE,
             '#description' => "Contains node reference",
             '#default_value' => $contents,
          ];
          return parent::buildForm($form,$form_state);
        }

        /**
         * {@inheritdoc}
         * Defining the submitForm method
         * To grab the values from the buildForm() $form_state and setting them
         * to the following fields while submitting the form
         */
        public function submitForm(array &$form, FormStateInterface $form_state) {

         $configform = $this->config(static::CONFIGNAME);
         $configform->set('firstname', $this->config->getValue('firstname');
         $configform->set('lastname', $this->config->getValue('lastname');
         $configform->set('contents', $this->config->getValue('contents');
         $configform->save();

         /**
          * We can also use the following code instead of using the above code
         $configform = $this->config(static::CONFIGNAME);
                 ->set('firstname', $this->config->getValue('firstname');
                 ->set('lastname', $this->config->getValue('lastname');
                 ->set('lastname', $this->config->getValue('contents');
                 ->save();
         */
        }
}
