// URL Vars
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

jQuery(function($) {

    // Scrolling the active block of fields

    if( $('.webform-client-form').hasClass('webform-conditional-processed') ){

        if( $(".content-datos-acceso").length > 0 ){
          $(".content-datos-acceso").hover( function(){
              $(".caja-content").removeClass('active');
              $(this).addClass('active');

          });
          $(".content-datos-acceso").keyup( function(){
              $(".caja-content").removeClass('active');
              $(this).addClass('active');

          });
        }

        if( $(".content-colaborar").length > 0 ){
          $(".content-colaborar").hover( function(){
              $(".caja-content").removeClass('active');
              $(this).addClass('active');

          });
          $(".content-colaborar").keyup( function(){
              $(".caja-content").removeClass('active');
              $(this).addClass('active');

          });
        }

        if( $(".content-datos").length > 0 ){
          $(".content-datos").hover( function(){
              $(".caja-content").removeClass('active');
              $(this).addClass('active');

          });
          $(".content-datos").keyup( function(){
              $(".caja-content").removeClass('active');
              $(this).addClass('active');

          });
        }

        if( $(".content-direccion").length > 0 ){
          $(".content-direccion").hover( function(){
              $(".caja-content").removeClass('active');
              $(this).addClass('active');

          });
          $(".content-direccion").keyup( function(){
              $(".caja-content").removeClass('active');
              $(this).addClass('active');
          });
        }

        if( $(".content-cuenta").length > 0 ){
          $(".content-cuenta").hover( function(){
              $(".caja-content").removeClass('active');
              $(this).addClass('active');

          });
          $(".content-cuenta").keyup( function(){
              $(".caja-content").removeClass('active');
              $(this).addClass('active');

          });
        }

        if( $(".content-idioma").length > 0 ){
          $(".content-idioma").hover( function(){
              $(".caja-content").removeClass('active');
              $(this).addClass('active');

          });
          $(".content-idioma").keyup( function(){
              $(".caja-content").removeClass('active');
              $(this).addClass('active');

          });
        }

        if( $(".content-donativo").length > 0 ){
          $(".content-donativo").hover( function(){
              $(".caja-content").removeClass('active');
              $(this).addClass('active');

          });
          $(".content-donativo").keyup( function(){
              $(".caja-content").removeClass('active');
              $(this).addClass('active');

          });
        }

        if( $(".content-certificado").length > 0 ){
          $(".content-certificado").hover( function(){
              $(".caja-content").removeClass('active');
              $(this).addClass('active');

          });
          $(".content-certificado").keyup( function(){
              $(".caja-content").removeClass('active');
              $(this).addClass('active');

          });
        }

        if( $(".content-historial").length > 0 ){
          $(".content-historial").hover( function(){
              $(".caja-content").removeClass('active');
              $(this).addClass('active');

          });
          $(".content-historial").keyup( function(){
              $(".caja-content").removeClass('active');
              $(this).addClass('active');

          });
        }

        if( $(".content-preferencias").length > 0 ){
          $(".content-preferencias").hover( function(){
              $(".caja-content").removeClass('active');
              $(this).addClass('active');

          });
          $(".content-preferencias").keyup( function(){
              $(".caja-content").removeClass('active');
              $(this).addClass('active');

          });
        }

    }
    else {
        $(".caja-content").removeClass('active');
    }

    // Sort the countries
    $( document ).ready(function() {
      if( $(".pais").length > 0 ){
          var options = $('.pais option');
          var selected = $('.pais option:selected').val();
          var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
          arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
          options.each(function(i, o) {
            o.value = arr[i].v;
            $(o).text(arr[i].t);
          });
          $(".pais").val(selected);
      }
    });

    // Province label
    //$('.provincia option[value=""]').text("-Provincia-");

    // Etiquetas de fecha de nacimiento
    url = window.location.href;
    if(url.indexOf("/cat") > -1){ // AmnistiaCAT
      $('.day option[value=""]').text("Dia");
      $('.month option[value=""]').text("Mes");
      $('.year option[value=""]').text("Any");
    }

    // Make the IBAN fields to automatically move the cursor through when any field is fullfilled.
    if( $(".country").length > 0 ){
        $(".country").keyup( function(){
          if($(".country").val().length >= 2){
              $(".entity").focus();
          }
        });

        $(".entity").keyup( function(){
          if($(".entity").val().length >= 4){
              $(".office").focus();
          }
        });

        $(".office").keyup( function(){
          if($(".office").val().length >= 4){
              $(".check").focus();
          }
        });

        $(".check").keyup( function(){
          if($(".check").val().length >= 2){
              $(".account").focus();
          }
        });
    }

    // Mark errors in select boxes
    $(".error").not(".messages").each( function(){
      if ($(this).is("select")){
          $(this).parent().addClass("form-error");
          $(this).parent().css("border", "#f00 2px solid");
      }
      else {
          $(this).css("border", "#f00 2px solid");
      }
    });

    // Cuenta entera en rojo
    if($('.account').hasClass('error') || $('.dc').hasClass('error') ){
            $('.entity').css("border", "#f00 2px solid");
            $('.office').css("border", "#f00 2px solid");
            $('.dc').css("border", "#f00 2px solid");
            $('.account').not(".first").css("border", "#f00 2px solid");
    }

    // Popups
    if( $("a.popup").length > 0 ){
      $('a.popup').colorbox({iframe:true, width:"50%", height:"50%"});
      $('a.popup_little').colorbox({iframe:true, width:"50%", height:"20%", "scrolling":false});
    }

    $(document).bind('cbox_complete', function() {
        setTimeout(function () {
            var y = $('.cboxIframe').height($('.cboxIframe').contents().height());
            $('a.popup_little').resize({ width:"50%", height: y });
        }, 500);
    });

    // refrescar popups colorbox
    function refresh_popups(){
        var y = $('.cboxIframe html').height();
        $('a.popup_little').resize({ width:"50%", height:y });
    }

    // 0 del DNI
    if( $(".number-dni").length > 0 ){
      $('.number-dni').first().focusout(function(){
          var dni = String($(this).val());
          if(dni.substring(0,1)=='0'){
              $(this).val(dni.substring(1));
          }
      });
    }

    // Redes sociales

    function share(title, summary, url, image) {
        //var sharer="https://www.facebook.com/sharer/sharer.php?u=example.org";
        window.open(
            'https://www.facebook.com/sharer.php?u=' + encodeURIComponent(url)
            + '&t=' + encodeURIComponent(title),
            'accionafacebook',
            'width=800,height=600,scrollbars=yes,menubar=yes,resizable=yes,location=yes'
        );
    }
    $(".ai-accion-firma-compartir__facebook").each(function() {
        var n = $(this),
            i = n.data("ai-share-url") || urlActualFB,
            a = n.data("ai-share-title") || tituloActual,
            s = n.data("ai-share-summary-html") || resumen,
            l = n.data("ai-share-image") || imagen;
        n.click(function() {
            return share(a, s, i, l), !1
        });
    });

    function tw(e, t, v) {
        window.open("https://twitter.com/intent/tweet?text=" + encodeURIComponent(e) + "&url=" + encodeURIComponent(t) + "&via=" + encodeURIComponent(v), "accionatwitter", "width=800,height=600,scrollbars=yes,menubar=yes,resizable=yes,location=yes")
    }
    $(".ai-accion-firma-compartir__twitter").each(function() {
        var n = $(this),
            r = n.data("ai-share-url") || urlActualTW,
            o = n.data("ai-share-summary-html") || tituloActual,
            v = n.data("ai-share-via") || compartirViaTW;
            n.click(function() {
                return tw(o, r, v), !1
            });
    });

    // ??????????
    //$('.webform-component--caja-preferncias-comunicacion--fila-1-preferencias--civicrm-1-contact-1-cg10-custom-26 label').removeClass('element-invisible');

    // Bloques plegables
    attachVisibilityClassesToBoxes();
    function attachVisibilityClassesToBoxes() {
        var $boxes = $('.node-type-webform .webform-client-form .caja-content');
        var bloqueDatosPersonalesIndex = 0;
        $boxes.each(function(index) {
            var boxClass = index == bloqueDatosPersonalesIndex ? 'caja-visible' : 'caja-hidden';
            var $box = $(this);
            $box.addClass(boxClass);
        });
    }

    toggleBoxVisibility();
    masMenos();

    function toggleBoxVisibility() {
        $('.node-type-webform .webform-client-form .caja-content > .form-item.webform-component').on('click', function (event){
            $containerBox = $(this).parent();
            if ($containerBox.hasClass('caja-visible')) {

                return;
            }

            var $boxes = $('.node-type-webform .webform-client-form .caja-content');
            $boxes.each(function(index) {
                var $box = $(this);
                $box.removeClass('caja-visible');
                $box.addClass('caja-hidden');
            });
            $containerBox.removeClass('caja-hidden').addClass('caja-visible');
            event.preventDefault();
            $('html,body').animate(
                {
                    scrollTop: $(this).offset().top - 55
                },
                0
            );

            masMenos();
        });
    }

    // Cambiar los símbolos con el despliegue de los bloques
    function masMenos() {
      // Botones de + y de -
      $(".mas").remove();
      $(".menos").remove();
      $(".caja-content").each(function(){
        if($(this).hasClass("caja-hidden")){
            $(this).find("h2").after('<img alt="+" src="sites/all/themes/ai-area-privada-civicrm/images/arrow.png" class="mas" />');
        }
        else {
            $(this).find("h2").after('<img alt="+" src="sites/all/themes/ai-area-privada-civicrm/images/arrowup.png" class="menos" />');
        }
      });
    }

    // Borrar campos de nueva contraseña
    if( $(".password").length > 0 ){
      $( document ).ready(function() {
          $(".password").val("");
      });
    }

    // Mover texto del pie a la barra del boton
    //if( $(".webform-conditional-processed").length > 0 ){
      var submit = $(".form-actions");
      $(".footer").after(submit);

      $(".form-submit").click(function(){
          $(".webform-client-form").submit();
      });
    //}

    if( $(".cuota_actual").length > 0 ){

      // Rellenar la cuota actual
      var cuota_act = $(".cuota input:checked").val();
      var period_act = $(".frecuencia option:selected").text();
      $(".cuota_actual").val(cuota_act+' €');
      $(".period_actual").val(period_act);

      // Calcular cuotas sugeridas x 1.2, 1.5 y 2
      var cuota_uno_dos = Math.round(cuota_act*1.2);
      $(".cuotas div div:first-child input").val(cuota_uno_dos);
      $(".cuotas div div:first-child label").text(cuota_uno_dos+"€");

      var cuota_uno_cinco = Math.round(cuota_act*1.5);
      $(".cuotas div div:nth-child(2) input").val(cuota_uno_cinco);
      $(".cuotas div div:nth-child(2) label").text(cuota_uno_cinco+"€");

      var cuota_dos = Math.round(cuota_act*2);
      $(".cuotas div div:nth-child(3) input").val(cuota_dos);
      $(".cuotas div div:nth-child(3) label").text(cuota_dos+"€");
    }


})
