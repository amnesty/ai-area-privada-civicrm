<?php include_once("strings.php"); ?>

<div class="container--wide"><!-- Page content -->
    <div class="grid"><!-- Bootstrap Grid -->
   	    <div id="content-area">
            <div class="content-form clearfix"><!-- Formulario -->
                  <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
  		            <div class="box-form-es">
                      <?php print $messages; ?> <!-- Errors -->
                      <?php print render($page['content']); ?>

                      <!-- Botones de share -->
                      <!--div id="share-buttons" class="ai-accion-firma-compartir">
                                <h4 class="ai-accion-firma-compartir__header">Comparte esta campaña entre tus contactos:</h4>
                                <?php if($cat){ ?>
                                  <a class="ai-accion-firma-compartir__facebook" href="javascript:">
                                      Compartir a <span class="ai-accion-firma-compartir__facebook-icon"></span><span class="sr-only">Facebook</span>
                                  </a>
                                  <a class="ai-accion-firma-compartir__twitter" href="javascript:">
                                      Compartir a <span class="ai-accion-firma-compartir__twitter-icon"></span><span class="sr-only">Twitter</span>
                                  </a>
                              <?php }else{ ?>
                                <a class="ai-accion-firma-compartir__facebook" href="javascript:">
                                    Compartir en <span class="ai-accion-firma-compartir__facebook-icon"></span><span class="sr-only">Facebook</span>
                                </a>
                                <a class="ai-accion-firma-compartir__twitter" href="javascript:">
                                    Compartir en <span class="ai-accion-firma-compartir__twitter-icon"></span><span class="sr-only">Twitter</span>
                                </a>
                              <?php } ?>
                      </div-->

                    </div><!-- Box FORM_ES -->
                    <!-- ********************************** CAJAS LATERALES ******************** -->
                    <div class="box-es-right col-xs-12 col-sm-12 col-md-3 col-lg-3 margin-top-20px-element"> <!-- box-es-right -->
                              <div class="three-column buenas-noticias bloques-x4 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                   <img src="<?php print $images_path; ?>icon-good-news.png" alt="imagen cara sonriente" />
                                   <?php
                                      echo $titulo_caja_buenas_noticias;
                                      echo $texto_caja_buenas_noticias;
                                    ?>
                              </div>
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
                                   </p>
                              </div>
                              <div class="three-column formas-pago bloques-x4 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                   <img src="<?php print $images_path; ?>cartera.png" alt="cartera"/>
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
