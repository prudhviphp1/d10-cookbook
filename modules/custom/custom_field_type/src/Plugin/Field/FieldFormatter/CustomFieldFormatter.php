<?php

namespace Drupal\custom_field_type\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;


/**
 * Define the "custom field formatter".
 * As per the Drupal Community Guidelines, we need to specify the annotation for all
 * the plugin types
 *
 * @FieldFormatter(
 *   id = "custom_field_formatter",
 *   label = @Translation("Custom Field Formatter"),
 *   description = @Translation("Description for Custom Field Formatter"),
 *   field_types = {
 *     "custom_field_type"
 *   }
 * )
 */


class CustomFieldFormatter extends FormatterBase {

    /**
     * {@inheritdoc}
     * Defining defaultSettings() method
     */
    public static function defaultSettings() {
        return [
            'concat' => 'Concat with ',
        ] + parent::defaultSettings();
    }

    /**
     * {@inheritdoc}
     * Defining settingsForm() method
     */

    public function settingsForm(array $form, FormStateInterface $form_state) {
        $form['concat'] =[
            '#type' => 'textfield',
            '#title' => 'Concatenate with',
            '#default_value' => $this->getSetting('concat'),
        ];
        return $form;
    }

    /**
     * {@inheritdoc}
     * Defining settingsSummary() method
     */
    public function settingsSummary() {
        $summary = [];
        $summary[] = $this->t("concatenate with : @concat", ["@concat" => $this->getSetting('concat')]);
        return $summary;
    }

    /**
     * {@inheritdoc}
     * Defining viewElements() method
     */

     public function viewElements(FieldItemListInterface $items, $langcode) {
        $element = [];

        foreach ( $items as $delta => $item) {
            $element[$delta] = [
                '#markup' => $this->getSetting('concat') . $item->value,
            ];
        }
        return $element;
     }

}
