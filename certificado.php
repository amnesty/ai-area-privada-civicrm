<?php

// conversion HTML => PDF
require_once('lib/html2pdf/html2pdf.class.php');

$html2pdf = new HTML2PDF( 'P','A4', 'es' );
$html2pdf->WriteHTML( $content );
$html2pdf->Output('certificado.pdf', 'D');




?>
