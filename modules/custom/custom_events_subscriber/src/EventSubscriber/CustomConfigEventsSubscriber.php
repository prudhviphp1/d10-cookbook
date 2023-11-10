<?php

namespace Drupal\custom_events_subscriber\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Core\Config\ConfigEvents;
use Drupal\Core\Config\ConfigCrudEvent;

class CustomConfigEventsSubscriber implements EventSubscriberInterface {
  /**
   * {@inheritdoc}
   *
   * @return array
   * Defining the getSubscribedEvents method
   */
  public static function getSubscribedEvents() {
    $events[ConfigEvents::SAVE][] = ['configSave', -100];
    $events[ConfigEvents::SAVE][] = ['configDelete', 100];
    return $events;
    }

    /**
     * Defining the configSave method which is called above
     *
     */
      public function configSave(ConfigCrudEvent $event) {
        $config = $event->getConfig();
        \Drupal::messenger()->addStatus('Saved config: ' . $config->getName());
      }

      /**
      * Defining the configDelete method which is called above
      *
      */
      public function configDelete(ConfigCrudEvent $event) {
        $config = $event->getConfig();
        \Drupal::messenger()->addStatus('Deleted config: ' . $config->getName());
      }

}
