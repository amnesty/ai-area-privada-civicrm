<?php

// Global vars and parameters for the theme
global $base_url;
$theme_path = $base_url . "/sites/all/themes/ai-area-privada-civicrm";
$images_path = $theme_path . "/images/"; // directorio donde se encuentran las imágenes dentro del tema del formulario

$img_header = "header.jpg"; // Por defecto
$extra_class = ""; // Por defecto

//Idioma
$cat = 0;
$url = $_SERVER['REQUEST_URI'];
if (preg_match('/\/cat/',$url)){
  $cat = 1;
}

?>
