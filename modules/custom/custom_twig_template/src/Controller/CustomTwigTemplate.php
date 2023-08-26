<?php

namespace Drupal\custom_twig_template\Controller;

class CustomTwigTemplate {

   public function customTwigTemplate() {

     return [
       '#theme' => 'custom_twig_template',
       '#text' => 'Welcome to our Custom Twig Template layer',
     ]
   }
}
