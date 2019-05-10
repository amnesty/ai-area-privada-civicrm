<?php include_once("strings.php"); ?>

<div class="container--wide"><!-- Page content -->
    <div class="grid"><!-- Bootstrap Grid -->
   	    <div id="content-area">
            <div class="content-form clearfix"><!-- Formulario -->
                  <?php print $messages; ?> <!-- Mensajes de error y de estado -->
                  <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
  		            <div class="box-form-es">
                      <?php print render($page['content']); ?>
                  </div><!-- Box FORM_ES -->

                  <!-- ********************************** CAJAS LATERALES ******************** -->
                  <div class="box-es-right col-xs-12 col-sm-12 col-md-3 col-lg-3 margin-top-20px-element"> <!-- box-es-right -->
                      <?php //if( in_array('agf2019', $user->roles) ){ ?>
                          <!--div class="three-column buenas-noticias bloques-x4 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                             <img src="<?php print $images_path; ?>icon-altavoz2.png" alt="imagen altavoz" />
                             <?php
                                echo $titulo_caja_agf;
                                echo $texto_caja_agf;
                              ?>
                          </div-->
                      <?php //} else { ?>
                          <div class="three-column buenas-noticias bloques-x4 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                   <img src="<?php print $images_path; ?>icon-good-news.png" alt="imagen cara sonriente" />
                                   <?php
                                      echo $titulo_caja_buenas_noticias;
                                      echo $texto_caja_buenas_noticias;
                                    ?>
                                    <img style="width: 100%; max-width: 200px; margin-top: 20px;"src="<?php print $images_path; ?>buenas_noticias.png" />
                          </div>
                      <?php //} ?>
                          <div class="three-column ventajas bloques-x4 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                   <img src="<?php print $images_path; ?>pig.png" alt="pig"/>
                                   <?php
                                   if($cat){
                                      echo $titulo_caja_ventajas_cat;
                                      echo $texto_caja_ventajas_cat;
                                   } else {
                                      echo $titulo_caja_ventajas;
                                      echo $texto_caja_ventajas;
                                   }
                                   ?>
                          </div>
                          <div class="three-column formas-pago bloques-x4 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                   <img src="<?php print $images_path; ?>whatsapp_icon.png" alt="cartera"/>
                                   <?php
                                    if($cat){
                                      echo $titulo_caja_formas_pago_cat;
                                      echo $texto_caja_formas_pago_cat;
                                    } else {
                                      echo $titulo_caja_formas_pago;
                                      echo $texto_caja_formas_pago;
                                    }
                                   ?>
                          </div>
                          <div class="three-column compromiso bloques-x4 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                  <img src="<?php print $images_path; ?>ventana.png" alt="ventana"/>
                                  <?php
                                    if($cat){
                                        echo $titulo_caja_transparencia_cat;
                                        echo $texto_caja_transparencia_cat;
                                    } else {
                                        echo $titulo_caja_transparencia;
                                        echo $texto_caja_transparencia;
                                    }
                                  ?>
                          </div>
                      </div><!-- /box-es-right -->
                  </div>
	          </div>
      </div>
</div>
