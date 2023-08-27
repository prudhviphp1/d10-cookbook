<?php

namespace Drupal\custom_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class CustomUserDetails extends FormBase {
    /**
     * {@inheritdoc}
     **/
    public function getFormId() {
        return "custom_user_details_form";
    }

    /**
     * {@inheritdoc}
     * Defining the buildForm() method
     **/
    public function buildForm(array $form, FormStateInterface $form_state) {
        // Adding the customjsform library to be only applied to this form.
        $form['#attached']['library'][] = "custom_form/customjsform";
        $form['username'] = [
            '#type' => 'textfield',
            '#title' => 'User Name',
            '#required' => true,
        ];
        $form['usermail'] = [
            '#type' => 'email',
            '#title' => 'Email',
            '#required' => true,
        ];
        $form['usergender'] = [
            '#type' => 'select',
            '#title' => 'Gender',
            '#options' => [
                'male' => 'Male',
                'female' => 'Female',
                'other' => 'Other'
            ],
        ];
        $form['submit'] = [
            '#type' => 'submit',
            '#value' => 'Submit',
        ];
        return $form;
    }

    /**
     * Defining the validateForm() method
     * Enforcing the rules for the username length
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
        // Enforcing the username length to be more than 6 characters
        if (strlen($form_state->getValue('username')) < 7) {
            $form_state->setErrorByname('username', "please make sure your username length is more than 6 characters");
        }
    }

    /**
     * {@inheritdoc}
     * Enforcing the submitForm() method
     **/
    public function submitForm(array &$form, FormStateInterface $form_state) {
        \Drupal::messenger()->addMessage("User Details Submitted Successfully");
        $values = $form_state->getValues();
        // Pushing the user details into the database & executing it
        \Drupal::database()->insert('user_details')->fields([
            'name' => $values['username'],
            'mail' => $values['usermail'],
            'gender' => $values['usergender'],
        ])->execute();
    }
}
