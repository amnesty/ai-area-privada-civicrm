<?php

// libreria de conversion HTML => PDD
require_once('lib/html2pdf/html2pdf.class.php');

$meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
$fecha = date ("j")." de ".$meses[date("n")-1]." de ".date ("Y")  ;

// Montar el HTML
global $base_url;
$certificado = file_get_contents($base_url . "/sites/all/themes/ai-area-privada-civicrm/plantilla_certificado.html");
$certificado = str_replace("@destinatariofiscal@",$destinatario, $certificado);
$certificado = str_replace("@dni@",$dni,$certificado);
$certificado = str_replace("@domiciliofiscal@", htmlentities( $domicilio, ENT_QUOTES, "UTF-8" ), $certificado);
$certificado = str_replace("@codposfiscal@",$codigo_postal,$certificado);
$certificado = str_replace("@poblacfiscal@", htmlentities( $poblacion, ENT_QUOTES, "UTF-8" ), $certificado);
$certificado = str_replace("@provinfiscal@", htmlentities( $provincia, ENT_QUOTES, "UTF-8" ),$certificado);
$certificado = str_replace("@importenumero@",$importe,$certificado);
$certificado = str_replace("@fecha@",$fecha,$certificado);
$certificado = str_replace("@anyo@",$anyo,$certificado);
ob_start();
echo $certificado;
$content = ob_get_clean();
ob_end_clean();
//$content = $certificado;

$html2pdf = new HTML2PDF( 'P','A4', 'es' );
$html2pdf->WriteHTML( $content );

/*drupal_add_http_header('Content-Type', 'application/pdf');
drupal_add_http_header('Content-Length', strlen($content));
drupal_add_http_header('Content-Disposition', 'attachment; filename="certificado.pdf"');*/

$html2pdf->Output('certificado.pdf', 'D');
/*$content = $pdf->Output('', true);
$file = fopen($filename, "w");
fwrite($file, $content);
fclose($file);*/

?>
