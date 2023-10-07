<?php
namespace Drupal\custom_config_override\Config;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Config\ConfigFactoryOverrideInterface;
use Drupal\Core\Config\StorageInterface;

/**
 * Example configuration override.
 */
class ConfigExampleOverrides implements ConfigFactoryOverrideInterface {

    /**
     * {@inheritdoc}
     * Defining the loadOverrides() method where we want to change the 'system.site' name
     * core config to our required custom_name
     */
    public function loadOverrides($names) {
        $overrides = array();
        if (in_array('system.site', $names)) {
            $overrides['system.site'] = ['name' => 'My site name!'];
        }
        return $overrides;
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheSuffix() {
        return 'ConfigExampleOverrider';
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheableMetadata($name) {
        return new CacheableMetadata();
    }

    /**
     * {@inheritdoc}
     */
    public function createConfigObject($name, $collection = StorageInterface::DEFAULT_COLLECTION) {
        return NULL;
    }

}
