<?php
/**
* @file
* Custom page with site settings
*/
function midwest_custom_site_setings_form() {
  $form = array();
  $form['header_info'] = array(
    '#type' => 'fieldset',
    '#title' => t('Header info'),
    '#weight' => 1,
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );
  $form['header_info']['contactus'] = array(
    '#type' => 'textarea',
    '#title' => t('Contact info'),
    '#default_value' => variable_get('contactus', ''),
    '#size' => 60,
  );
  //return $form;
  return system_settings_form($form);
}