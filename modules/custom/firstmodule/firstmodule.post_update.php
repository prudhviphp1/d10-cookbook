<?php
/**
 * Update "Contact Us" form to have a custom reply message.
 */
function firstmodule_post_update_change_contactus_reply {
  $contactus_form = \Drupal\contact\Entity\ContactForm::load('contactus');
  $contactus_form->setReply(t('Thanks for contacting us, we will get back to you shortly'));
  $contactus_form->save();
}
