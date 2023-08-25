<?php

namespace Drupal\custom_general\Controller;

use Drupal\user\UserInterface;

/**
 * Welcome message to the user.
 */

class WelcomePage {
    /**
     * WelcomePage message.
     */
    public function welcomePage(UserInterface $user)
    {
       $username =  $user->getAccountName();
       //$username =  $user->label();
       return [
        '#markup' => 'Hello ' . $username .  ', Welcome to our custom website!!',
       ];
    }
}
