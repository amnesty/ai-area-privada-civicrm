<?php

// Funciones para el cambio de contraseña
function areaprivada_form_webform_client_form_alter(&$form, &$form_state, $form_id) {

  require_once("config.php");

  if ($form_id == $form_cambio_contrasena) {
    global $user;
    $currentUser = user_load($user->uid);
    $form['submitted']['caja_datos_acceso']['fila_1_acceso']['usuario']['#value'] = $currentUser->name;
    $form['#submit'][] = 'custom_settings_form_submit';

    $form['#validate'][] = 'validate_custom';
  }

  /*$form['submitted']['caja_mi_certificado_fiscal']['fila_1_certificado']['boton_certificado2'] = array(
      '#type' => 'button',
      '#name' => 'descargar_certificado2',
      '#value' => t('Descargar2'),
      '#executes_submit_callback' => TRUE,
      '#submit' => array('descargar_certificado2'),
      '#attributes' => array('class' => array('btn-certificado')),
      '#id' => 'boton_certificado2',
  );*/

    // Crear botón para descargar el certificado si hay algún año sleeccionado
    $form['submitted']['caja_mi_certificado_fiscal']['fila_1_certificado']['boton_certificado'] = array(
        '#type' => 'button',
        '#name' => 'descargar_certificado',
        '#value' => t('Descargar'),
        '#executes_submit_callback' => TRUE,
        '#submit' => array('descargar_certificado'),
        '#attributes' => array('class' => array('btn-certificado')),
        '#id' => 'boton_certificado',
    );

  $form['submit'] = array(
        '#value' => 'Guardar',
        '#type'  => 'submit',
        '#executes_submit_callback' => TRUE,
        '#name' => 'guardar_datos',
  );

  //$form['submitted'] += drupal_get_form('webform_client_form_62');

}

function areaprivada_form_webform_client_form_submit($form_id,$form_values) {
    drupal_set_message(t('Your form has been saved.'));
}

function descargar_certificado2(&$form, &$form_state){

    //$node = node_load(57);

    //need to set the submitted key in the values, as this is required by webform
    //$form_state['values'] = $form_state['values']['submitted'];

    //print("<pre>".print_r($form_state,true)."</pre>");
    //exit(1);

    //drupal_form_submit($form['#form_id'], $form_state);

    return $form;

    /*if (form_get_errors() != '') {
      print 'Webform_Error';
      print ''.print_r(form_get_errors(), 1).'';
    }
    else print 'Webform_Success';*/
}

function descargar_certificado(&$form, &$form_state){

  // Solo si está el año seleccionado
  if( $form['submitted']['caja_mi_certificado_fiscal']['fila_1_certificado']['ano_certificado']['#value'] != '' ){

      // Leemos las variables
      $destinatario = $form['submitted']['caja_datos_personales']['fieldset_fila_1']['civicrm_1_contact_1_contact_first_name']["#value"];
      $dni = $form['submitted']['caja_datos_personales']['fieldset_fila_2']['margin_medium_nif']['civicrm_1_contact_1_cg1_custom_2']["#value"];
      $domicilio = $form['submitted']['caja_direccion']['fieldset_fila_1_b']['civicrm_1_contact_1_address_street_address']["#value"] . ' '
        . $form['submitted']['caja_direccion']['fieldset_fila_1_b']['margin_medium_bloque']['civicrm_1_contact_1_address_supplemental_address_1']["#value"];
      $codigo_postal = $form['submitted']['caja_direccion']['fieldset_fila_2_b_2']['civicrm_1_contact_1_address_postal_code']["#value"];
      $poblacion = $form['submitted']['caja_direccion']['fieldset_fila_2_b_2']['civicrm_1_contact_1_address_city']["#value"];
      $provincia = $form['submitted']['caja_direccion']['fieldset_direccion_3']['margin_medium_prov']['civicrm_1_contact_1_address_state_province_id']['#value']; // falta traduccion
      $anyo = $form['submitted']['caja_mi_certificado_fiscal']['fila_1_certificado']['ano_certificado']['#value'];
      switch( $anyo ){
        case '2017':
          $importe = 10; //coger el valor que toca
          break;
        default:
          $importe = 0;
          break;
      }

      require_once("certificado.php");

    }

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
}

?>
