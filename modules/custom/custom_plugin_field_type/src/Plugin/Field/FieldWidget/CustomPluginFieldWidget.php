<?php

namespace Drupal\custom_plugin_field_type\Plugin\Field\FieldWidget;

use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defining the "custom plugin field widget".
 * As per the Drupal Community Guidelines, we need to specify the annotation for all
 * the plugin types
 *
 * @FieldWidget(
 *   id = "custom_plugin_field_widget",
 *   label = @Translation("Custom Plugin Field Widget"),
 *   description = @Translation("Description for Custom Field Widget"),
 *   field_types = {
 *     "custom_plugin_field_type"
 *   }
 * )
 */

class CustomPluginFieldWidget extends WidgetBase {

    /**
     * {@inheritdoc}
     * Defining formElement() method
     */

     public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
        $value = isset($items[$delta]->value) ? $items[$delta]->value : "";
        $element = $element + [
            '#type' => 'textfield',
            '#suffix' => "<span>" . $this->getFieldSetting("moreinfo") . "</span>",
            '#default_value' => $value,
            '#attributes' => [
                'placeholder' => $this->getSetting('placeholder'),
            ],
        ];
        return ['value' => $element];
     }

     /**
      * {@inheritdoc}
      * Defining defaultSettings() method
      */
      public static function defaultSettings() {
        return [
            'placeholder' => 'default',
        ] + parent::defaultSettings();
      }

      /**
       * {@inheritdoc}
       * Defining settingsForm() method and defining the 'placeholder' value here
       */
      public function settingsForm(array $form, FormStateInterface $form_state) {
        $element['placeholder'] = [
            '#type' => 'textfield',
            '#title' => 'Placeholder Text',
            '#default_value' => $this->getSetting('placeholder'),
        ];
        return $element;
      }

      /**
       * {@inheritdoc}
       * Defining the settingsSummary() method so that it can show the summary with below business logic by grabbing
       * the 'placeholder' value from the above method
       */
      public function settingsSummary() {
        $summary = [];
        $summary[] = $this->t("placeholder Text: @placeholder", array("@placeholder" => $this->getSetting("placeholder")));
        return $summary;
      }


}
