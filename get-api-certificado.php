<?php

/***************************************************
******* Inserción de datos vía llamada POST *******
**************************************************/

try {

  #include_once("province_country.php"); // cargamos las provincias y paises
  #shell_exec('sudo rm -r /var/www/html/drupal/sites/default/files/civicrm/templates_c/es_ES/');
  set_include_path(get_include_path() . PATH_SEPARATOR .'/var/www/html/drupal/');
  define('DRUPAL_ROOT', '/var/www/html/drupal/');
  require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
  drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
  civicrm_initialize(); // conectamos con Civi

  // ******* Recogemos los datos de $_POST *********

  $contact_id = $_GET['contact_id'];
  #$contact_id = 458327;

  $result = civicrm_api3('Contact', 'get', [
    'sequential' => 1,
    'return' => ["first_name","last_name","middle_name","display_name", "custom_2", "street_address", "postal_code", "city", "state_province", "custom_111"],["city"],
    'id' => $contact_id,
  ]);

  #var_dump($result["values"][0]["custom_111"]);
  #echo ($result["values"][0]["display_name"]);
  #die;

  // Leemos las variables
  $destinatario = $result["values"][0]["first_name"].' '.$result["values"][0]["last_name"].' '.$result["values"][0]["middle_name"];
  $dni = $result["values"][0]["custom_2"];
  $domicilio = $result["values"][0]["street_address"];
  $codigo_postal = $result["values"][0]["postal_code"];
  $poblacion = $result["values"][0]["city"];
  $anyo = '2021';
  $importe = $result["values"][0]["custom_111"];
  #$provincia = $result["values"][0]["state_province_name"];
  #require_once("provinces.php");
  $provincia_def = $result["values"][0]["state_province_name"];

 # echo ('destinatario: '.$destinatario.'<br>importe: '.$importe.'<br>dni: '.$dni.'<br>domicilio:  '.$domicilio.'<br>codigo postal: '.$codigo_postal.'<br> poblacion: '.$poblacion.'<br>año:  '.$anyo.'<br> provincia '.$provincia);
 # die;

  require_once("certificado.php");


    // 6. Logging

    $log .= "\nContact id: " . $contact_id .
            "\nCreate: " . print_r($create,1) .
            "\nUpdate: " . print_r($update,1) .
            "\nCreate email: " . print_r($email_create,1) .
            "\nCreate phone (fijo): " . print_r($phone_create,1) .
            "\nCreate phone (movil): " . print_r($phone_create2,1) .
            "\nCreate address: " . print_r($address_create,1) .
            "\nContribución: " . print_r($create_contribution,1) .
            "\nEntity tag: " . print_r($create_entity_tag,1) .
            "\nNueva membresia: " . print_r($create_activity,1) .
            "\nActividad: " . print_r($create_activity,1);

    print_r( 'Success: sent contact with id '.$contact_id );
    return 'OK';


} catch (CiviCRM_API3_Exception $e) {

      print_r( "Error sending data. Error sending data. See log file for more info.\n" . $e->getMessage() );

      // Si hay un error, lo escribimos en el log
      $log .= "Error en API CiviCRM: " . $e->getMessage() .
              "\nContact id: " . $contact_id .
              "\nCreate: " . print_r($create,1) .
              "\nUpdate: " . print_r($update,1) .
              "\nCreate email: " . print_r($email_create,1) .
              "\nCreate phone: " . print_r($phone_create,1) .
              "\nCreate address: " . print_r($address_create,1) .
              "\nContribución: " . print_r($create_contribution,1) .
              "\nEntity tag: " . print_r($create_entity_tag,1) .
              "\nNueva membresia: " . print_r($create_activity,1) .
              "\nActividad: " . print_r($create_activity,1);

      // Mandamos mail de error
      $to      = 'postm@es.amnesty.org';
      $to      .= ',frodriguez@es.amnesty.org';
      $subject = '[TEST-CIVI-API] ERROR en la generacion del Certificado IRPF';
      $message = $log;
      $headers = 'From: sender@es.amnesty.org' . "\r\n" .
      #$headers = 'From: frodriguez@es.amnesty.org' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();

      mail($to, $subject, $message, $headers);
}

?>
