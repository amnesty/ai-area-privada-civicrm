<?php

function areaprivada_form_webform_client_form_alter(&$form, &$form_state, $form_id) {

  require_once("config.php");

  if ($form_id == $form_cambio_contrasena) {
      global $user;
      $currentUser = user_load($user->uid);
      $form['submitted']['caja_datos_acceso']['fila_1_acceso']['usuario']['#value'] = $currentUser->name;
      $form['#submit'][] = 'custom_settings_form_submit';

      $form['#validate'][] = 'validate_custom';
  }

  if ($form_id == $form_descarga_certificado) {
      // Crear botón para descargar el certificado si hay algún año seleccionado
      $form['submitted']['caja_mi_certificado_fiscal']['fila_2_certificado']['boton_certificado'] = array(
          '#type' => 'button',
          '#name' => 'descargar_certificado',
          '#value' => 'Descargar',
          '#executes_submit_callback' => TRUE,
          '#submit' => array('descargar_certificado'),
          '#attributes' => array('class' => array('btn-certificado', 'btn-certificado-download')),
      );
  }

}

/*
  Función que crea un PDF con el certificado y lo rellena con los datos actuales del formulario
  y los datos ecnonómicos del año seleccionado
*/
function descargar_certificado(&$form, &$form_state){
  // Solo si está el año seleccionado
  if( $form['submitted']['caja_mi_certificado_fiscal']['fila_1_certificado']['ano_certificado']['#value'] != '' ){
      // Leemos las variables
      $destinatario = $form['submitted']['caja_datos_personales']['fieldset_fila_1']['civicrm_1_contact_1_contact_first_name']["#value"];
      $destinatario .= ' '.$form['submitted']['caja_datos_personales']['fieldset_fila_1']['civicrm_1_contact_1_contact_last_name']["#value"];
      $destinatario .= ' '.$form['submitted']['caja_datos_personales']['fieldset_fila_1']['civicrm_1_contact_1_contact_middle_name']["#value"];
      $dni = $form['submitted']['caja_datos_personales']['fieldset_fila_2']['margin_medium_nif']['civicrm_1_contact_1_cg1_custom_2']["#value"];
      $domicilio = $form['submitted']['caja_direccion']['fieldset_fila_1_b']['civicrm_1_contact_1_address_street_address']["#value"] . ' '
        . $form['submitted']['caja_direccion']['fieldset_fila_1_b']['margin_medium_bloque']['civicrm_1_contact_1_address_supplemental_address_1']["#value"];
      $codigo_postal = $form['submitted']['caja_direccion']['fieldset_fila_2_b_2']['civicrm_1_contact_1_address_postal_code']["#value"];
      $poblacion = $form['submitted']['caja_direccion']['fieldset_fila_2_b_2']['civicrm_1_contact_1_address_city']["#value"];
      $anyo = $form['submitted']['caja_mi_certificado_fiscal']['fila_1_certificado']['ano_certificado']['#value'];
      /*switch( $anyo ){
        case '2017':
          $importe = 10; //coger el valor que toca
          break;
        default:
          $importe = 0;
          break;
      }*/
      $importe = $form['submitted']['civicrm_1_contact_1_cg15_custom_111']['#value'];
      $provincia = $form['submitted']['caja_direccion']['fieldset_direccion_3']['margin_medium_prov']['civicrm_1_contact_1_address_state_province_id']['#value'];
      require_once("provinces.php");
      $provincia_def = $provinces[$provincia];

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
