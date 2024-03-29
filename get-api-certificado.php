<?php

/***************************************************
******* get certificado IRPF via API        *******
**************************************************/

try {

  set_include_path(get_include_path() . PATH_SEPARATOR .'/var/www/html/drupal/');
  define('DRUPAL_ROOT', '/var/www/html/drupal/');
  require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
  drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
  civicrm_initialize(); // conectamos con Civi

  // ******* Recogemos los datos de $_POST *********
  $contact_id = $_GET['contact_id'];
  $checksum= $_GET['cs'];

  $result = civicrm_api3('Contact', 'validatechecksum', [
    'id' => $contact_id,
    'checksum' => $checksum,
  ]);

  $validarChecksum = $result["values"];

  //Validamos que el Checksum no ha cadudado para poder mostrar el certificado IRPF
  if ($validarChecksum == 1){

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
    $anyo = date('Y')-1;
    $importe = $result["values"][0]["custom_111"];
    $provincia_def = $result["values"][0]["state_province_name"];

    # echo ('destinatario: '.$destinatario.'<br>importe: '.$importe.'<br>dni: '.$dni.'<br>domicilio:  '.$domicilio.'<br>codigo postal: '.$codigo_postal.'<br> poblacion: '.$poblacion.'<br>año:  '.$anyo.'<br> provincia '.$provincia);
    # die;

    // Optenemos certificado
    require_once("certificado.php");
  }

  // Logging
  $log = "";
  $log .= "\nContact id: " . $contact_id .
  "\ndestinatario: " . print_r($destinatario,1) .
  "\ndni: " . print_r($dni,1) .
  "\ndomicilio: " . print_r($domicilio,1) .
  "\ncodigo_postal: " . print_r($codigo_postal,1) .
  "\npoblacion: " . print_r($poblacion,1) .
  "\nanyo: " . print_r($anyo,1) .
  "\nimporte: " . print_r($importe,1) .
  "\nprovincia_def: " . print_r($provincia_def,1);

  #print_r( 'Success: sent contact with id '.$contact_id );
  return 'OK';


} catch (CiviCRM_API3_Exception $e) {

  print_r( "Error sending data. Error sending data. See log file for more info.\n" . $e->getMessage() );

  // Si hay un error, lo escribimos en el log
  $log .= "Error en API CiviCRM: " . $e->getMessage() .
  "\nContact id: " . $contact_id .
  "\ndestinatario: " . print_r($destinatario,1) .
  "\ndni: " . print_r($dni,1) .
  "\ndomicilio: " . print_r($domicilio,1) .
  "\ncodigo_postal: " . print_r($codigo_postal,1) .
  "\npoblacion: " . print_r($poblacion,1) .
  "\nanyo: " . print_r($anyo,1) .
  "\nimporte: " . print_r($importe,1) .
  "\nprovincia_def: " . print_r($provincia_def,1);


  foreach($_REQUEST as $key=>$val) {
    $log .= "\n".$key.": ".$val;
  }


  // Mandamos mail de error
  $to      = 'postm@es.amnesty.org';
  $to      .= ',frodriguez@es.amnesty.org';
  $subject = '[TEST-CIVI-API] ERROR en la generacion del Certificado IRPF';
  $message = $log;
  $headers = 'From: sender@es.amnesty.org' . "\r\n" .
  #$headers = 'From: frodriguez@es.amnesty.org' . "\r\n" .
  'X-Mailer: PHP/' . phpversion();

  //mail($to, $subject, $message, $headers);
}

?>
