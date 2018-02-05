<?php

/*function areaprivada_form_webform_client_form_alter(&$form, &$form_state, $form_id) {
  //if ($form_id == 'webform_client_form_148' || $form_id == 'webform_client_form_169') {
    global $user;
    $currentUser = user_load($user->uid);
    $form['submitted']['caja_datos_acceso']['fila_1_acceso']['usuario']['#value'] = $currentUser->name;
    $form['#submit'][] = 'custom_settings_form_submit';

    $form['#validate'][] = 'validate_custom';
  //}
}

function custom_settings_form_submit($form, &$form_state) {
  global $user;
  $currentUser = user_load($user->uid);
  $currentUser->pass = $form['submitted']['caja_datos_acceso']['fila_1_acceso']['nueva_contrasena']['#value'];
  user_save((object) array('uid' => $currentUser->uid), (array) $currentUser);
}


function validate_custom($form, &$form_state) {
  if ($form_state['values']['submitted']['caja_datos_acceso']['fila_1_acceso']['nueva_contrasena'] != $form_state['values']['submitted']['caja_datos_acceso']['fila_1_acceso']['repite_contrasena']) {
    form_set_error('submitted][caja_datos_acceso][fila_1_acceso][repite_contrasena', t('Las contraseñas deben coincidir.'));
  }
}*/

/*function areaprivada_theme() {
    $items = array();
    // create custom user-login.tpl.php

    $items['user_login'] = array(
    'render element' => 'form',
    'path' => drupal_get_path('theme', 'areaprivada') . '/templates',
    'template' => 'user-login',
    'preprocess functions' => array(
      'areaprivada_preprocess_user_login'
      ),
  );
  $items['user_register_form'] = array(
    'render element' => 'form',
    'path' => drupal_get_path('theme', 'areaprivada') . '/templates',
    'template' => 'user-register-form',
    'preprocess functions' => array(
      'areaprivada_preprocess_user_register_form'
    ),
  );
  $items['user_pass'] = array(
    'render element' => 'form',
    'path' => drupal_get_path('theme', 'areaprivada') . '/templates',
    'template' => 'user-pass',
    'preprocess functions' => array(
      'areaprivada_preprocess_user_pass'
    ),
  );
  return $items;
}

function areaprivada_preprocess_user_login(&$vars) {
  $vars['intro_text'] = t('This is my awesome login form');
}

function areaprivada_preprocess_user_register_form(&$vars) {
  $vars['intro_text'] = t('This is my super awesome reg form');
}

function areaprivada_preprocess_user_pass(&$vars) {
  $vars['intro_text'] = t('This is my super awesome request new password form');
}*/
