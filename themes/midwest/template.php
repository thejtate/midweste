<?php

/**
 * @file
 * template.php
 *
 * Contains theme override functions and preprocess functions for the theme.
 */


/**
 * Override or insert variables into the html template.
 */
function midwest_preprocess_html(&$vars) {
  $html5 = array(
    '#tag' => 'script',
    '#attributes' => array(
      'src' => base_path() . drupal_get_path('theme', 'midwest') . '/js/lib/html5.js',
    ),
    '#prefix' => '<!--[if (lt IE 9) & (!IEMobile)]>',
    '#suffix' => '</script><![endif]-->',
  );
  drupal_add_html_head($html5, 'midwest_html5');
  if ($node = menu_get_object()) {
    $vars['classes_array'][] = 'page';
    switch ($node->type) {
      case 'home':
        $vars['classes_array'][] = 'page-home';
//        $vars['classes_array'][] = 'with-bg-animation';
        break;
      case 'about':
        $vars['classes_array'][] = 'page-about';
        break;
      case 'qualification':
        $vars['classes_array'][] = 'page-qualification';
        break;
      case 'contact_us':
        $vars['classes_array'][] = 'page-contact';
        break;
      case 'equipment':
        $vars['classes_array'][] = 'page-ourequipment';
        break;
      case 'services':
        $vars['classes_array'][] = 'page-services';
        break;
      case 'gallery':
        $vars['classes_array'][] = 'page-gallery';
        break;
      default :
        $vars['classes_array'][] = 'common-page';
        break;
    }
  }

  if (in_array("html__node__add__card", $vars['theme_hook_suggestions'])) {
    $vars['classes_array'][] = "page-create-your-card";
  }

  if (in_array("html__trading_cards", $vars['theme_hook_suggestions'])) {
    $vars['classes_array'][] = "page";
    $vars['classes_array'][] = "page-trading-cards";
    drupal_add_js(drupal_get_path("theme", "paintpro") . "/js/lib/jquery.scrollTo.min.js");
  }

}

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function midwest_preprocess_page(&$vars, $hook) {
  $vars['contact_us'] = variable_get('contactus', '');
}


/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
function midwest_preprocess_node(&$vars) {
  $node = $vars['node'];
  $vars['theme_hook_suggestions'][] = "node__" . $node->type . "__" . $vars['view_mode'];

  switch ($node->type) {
    case 'equipment':
      $vars['asset_recovery'] = views_embed_view('asset_recovery', 'block');
      break;
    case 'about':
    case 'services':
      $vars['title'] = '';
      break;
  }
}

/**
 * Theme preprocess function for theme_field() and field.tpl.php.
 *
 * @see theme_field()
 * @see field.tpl.php
 */
function midwest_preprocess_field(&$vars, $hook) {
  switch ($vars['element']['#field_name']) {
    case 'field_services_slider' :
      $field_obj = $vars['items'];
      $list = array(
        'items' => array(),
        // Leave the title element empty to omit the title.
        'title' => '',
        'type' => 'ul',
        'attributes' => array('class' => array('slides')),
      );
      foreach ($field_obj as $key => $value) {
        $list['items'][] = l($vars['items'][$key]['entity']['field_collection_item'][$vars['element']['#items'][$key]['value']]['field_services_slider_title']['0']['#markup'], '#', array('html' => TRUE, 'external' => TRUE));
      }
      $vars['slider_list'] = !empty($list['items']) ? theme('item_list', $list) : '';
      break;
  }
}


/**
 * Implements hook_form_FORM_ID_alter().
 */
function midwest_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == "views_exposed_form") {
    if (isset($form['search_api_views_fulltext'])) {
      $form['search_api_views_fulltext']['#form_placeholder'] = TRUE;
    }
  }
}

