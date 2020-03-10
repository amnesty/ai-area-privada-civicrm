// URL Vars
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

function donativo(){

  jQuery(function($) {

    /* recoger el valor del donativo */
    var checked = $('.donativo input[type="radio"]:checked').val();
    if ( checked > 0 ){
        $("[name='submitted[caja_quiero_hacer_un_donativo][fila_2_donativo][civicrm_1_contribution_1_contribution_total_amount]']").val(checked);
    }
    else { // otra cantidad
      $("[name='submitted[caja_quiero_hacer_un_donativo][fila_2_donativo][civicrm_1_contribution_1_contribution_total_amount]']").val( $(".donativo-amount").val() );
    }
    var donativo = $("[name='submitted[caja_quiero_hacer_un_donativo][fila_2_donativo][civicrm_1_contribution_1_contribution_total_amount]']").val();

    /* comprobaciones con el valor del donativo */
    if(donativo == "" || donativo == '0'){
        $("#dialog-amount").dialog("open");
    }
    else if(/^([0-9])+$/.test(donativo) == 0){
        $("#dialog-numeric").dialog("open");
    }
    else {
        var parrafo = $("#dialog-confirm p");
        var texto = parrafo.text();
        if( /[0-9]+€/.test(texto) )
        {
            var match = texto.match(/[0-9]+€/);
            texto = texto.replace(match, donativo+"€");
        } else {
            texto = texto.replace("#donativo", donativo);
        }
        parrafo.text(texto);
        $("#dialog-confirm").dialog("open");
    }

  });
}

function cuota(){

  /*jQuery(function($) {

    // comprobamos que hay algun valor superior a 0 en cuota marcada o casilla de otra cuota
    var cuota_id = $(".cuotas input:checked").attr("id");
    var cuota_label = $("label[for='"+cuota_id+"']").text();
    var cuota_amount = cuota_label.substr(0, cuota_label.length-1);
    var otra_cuota = $(".otra_cuota").val();

    if(cuota_amount > 0 || otra_cuota > 0 ){
      $("#cuota-confirm").dialog("open");
    }
    else {
      $("#cuota-amount").dialog("open");
    }

  });*/
}

jQuery(function($) {

    /* ***************** ORIGEN ************************ */

    // Recogemos variable GET
    var urlVars = getUrlVars();
    var get_source = urlVars["origen"];

    if( get_source != '' && get_source ){
      $("[name='submitted[civicrm_1_contact_1_contact_source]']").val(get_source);
      $("[name='submitted[caja_quiero_hacer_un_donativo][civicrm_1_contribution_1_contribution_source]']").val(get_source);
    }
    else {
      $("[name='submitted[civicrm_1_contact_1_contact_source]']").val('area_privada');
      $("[name='submitted[caja_quiero_hacer_un_donativo][civicrm_1_contribution_1_contribution_source]']").val('area_privada');
    }

    // Vaciar campos de donativo y cuota al inicio
    $(".donativo-amount").val("");
    $(".otra_cuota").val("");

    // Acciones antes del submit
    $(".webform-submit").click(function(){

        // Vaciar valor del donativo y desmarcar, solo se hace un donativo mediante su propio boton
        $(".donativo-amount").val("");
        $('.donativos [type="radio"]:checked').prop("checked", false);

        // Vaciar el campo cuota y desmarcar la opcion, solo se hace con su propio boton
        /*$(".otra_cuota").val("");
        var cuota_old = $("[name='submitted[caja_cuota][fila_2_nueva_periodicidad][cuota_actual_oculta]']").val();
        //$("[name='submitted[caja_cuota][fila_2_nueva_periodicidad][civicrm_1_contact_1_cg6_custom_17]']").val(cuota_old); //local
        $("[name='submitted[caja_cuota][fila_2_nueva_periodicidad][civicrm_1_contact_1_cg15_custom_101]']").val(cuota_old);
        $('.cuota input[type="radio"]:checked').prop("checked", false);*/

    });

    /* -- POP-UPS de donación -- */

    $( "#dialog-confirm" ).dialog({
        autoOpen: false,
        resizable: false,
        height:200,
        modal: true,
        buttons: {
          Cancel: function() {
            $(".donativo-amount").val("");
            $("[name='submitted[caja_quiero_hacer_un_donativo][fila_2_donativo][civicrm_1_contribution_1_contribution_total_amount]']").val("");
            $( this ).dialog( "close" );
          },
          "Estoy de acuerdo": function() {
            $(".webform-client-form").submit();
            $( this ).dialog( "close" );
          }
        }
      });
      $( "#dialog-amount" ).dialog({
          autoOpen: false,
          resizable: false,
          modal: true,
          height:180,
          buttons: {
            Ok: function() {
              $( this ).dialog( "close" );
            }
          }
      });
      $( "#dialog-numeric" ).dialog({
          autoOpen: false,
          resizable: false,
          modal: true,
          height:180,
          buttons: {
            Ok: function() {
              $( this ).dialog( "close" );
            }
          }
      });

    /* -- POP-UPS de cuota -- */

    /*$( "#cuota-confirm" ).dialog({
        autoOpen: false,
        resizable: false,
        height:200,
        modal: true,
        buttons: {
          Cancel: function() {
            $(".otra_cuota").val("");
            $( this ).dialog( "close" );
          },
          "Estoy de acuerdo": function() {
            $(".webform-client-form").submit();
            $( this ).dialog( "close" );
          }
        }
      });
      $( "#cuota-amount" ).dialog({
          autoOpen: false,
          resizable: false,
          modal: true,
          height:180,
          buttons: {
            Ok: function() {
              $( this ).dialog( "close" );
            }
          }
      });*/

    // Funciones que resaltan los bloques en amarillo cuando se pasa el cursor por encima

    if( $('.webform-client-form').hasClass('webform-conditional-processed') ){

        if( $(".content-datos-acceso").length > 0 ){
          $(".content-datos-acceso").hover( function(){
              $(".caja-content").not('.caja-visible').removeClass('active');
              $(this).addClass('active');

          });
        }
        if( $(".content-colaborar").length > 0 ){
          $(".content-colaborar").hover( function(){
              $(".caja-content").not('.caja-visible').removeClass('active');
              $(this).addClass('active');

          });
        }
        if( $(".content-datos").length > 0 ){
          $(".content-datos").hover( function(){
              $(".caja-content").not('.caja-visible').removeClass('active');
              $(this).addClass('active');

          });
        }
        if( $(".content-direccion").length > 0 ){
          $(".content-direccion").hover( function(){
              $(".caja-content").not('.caja-visible').removeClass('active');
              $(this).addClass('active');

          });
        }
        if( $(".content-cuenta").length > 0 ){
          $(".content-cuenta").hover( function(){
              $(".caja-content").not('.caja-visible').removeClass('active');
              $(this).addClass('active');

          });
        }
        if( $(".content-idioma").length > 0 ){
          $(".content-idioma").hover( function(){
              $(".caja-content").not('.caja-visible').removeClass('active');
              $(this).addClass('active');

          });
        }
        if( $(".content-donativo").length > 0 ){
          $(".content-donativo").hover( function(){
              $(".caja-content").not('.caja-visible').removeClass('active');
              $(this).addClass('active');

          });
        }
        if( $(".content-certificado").length > 0 ){
          $(".content-certificado").hover( function(){
              $(".caja-content").not('.caja-visible').removeClass('active');
              $(this).addClass('active');

          });
        }
        if( $(".content-historial").length > 0 ){
          $(".content-historial").hover( function(){
              $(".caja-content").not('.caja-visible').removeClass('active');
              $(this).addClass('active');

          });
        }
        if( $(".content-preferencias").length > 0 ){
          $(".content-preferencias").hover( function(){
              $(".caja-content").not('.caja-visible').removeClass('active');
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
    if( $(".provincia").length > 0 ){
      $('.provincia option[value=""]').text("-Provincia-");
    }

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

      // device detection
      var isMobile = false;
      if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
          || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))
      ){
        isMobile = true;
      }

      if(!isMobile){
        $('a.popup_little').colorbox({iframe:true, width:"50%", height:"20%", "scrolling":false});
      }
      else {
        $('a.popup_little').colorbox({iframe:true, width:"80%", height:"80%", "scrolling":false});
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

      // cerrar cuando se clica donde sea
      function closeIFrame(){
          $(".cboxIframe").close();
      }

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

    // Inicializar las cajas con sus clases CSS correspondientes
    // y los bloques plegados o no según convenga
    attachVisibilityClassesToBoxes();

    // Función que cambia las clases CSS de los bloques cada vez que se clica
    // en uno de ellos y los pliega o despliega
    toggleBoxVisibility();

    // Función que asigna las flechas de bloque cerrado o abierto
    // y que las cambia cada vez que se clica un bloque
    masMenos();

    function attachVisibilityClassesToBoxes() {
        var $boxes = $('.node-type-webform .webform-client-form .caja-content');
        var bloqueDatosPersonalesIndex = -1; //ningún bloque abierto
        $boxes.each(function(index) {
            var boxClass = index == bloqueDatosPersonalesIndex ? 'caja-visible' : 'caja-hidden';
            var $box = $(this);
            $box.addClass(boxClass);
        });
        // Excepción para caja donativo en AP
        $(".content-donativo").removeClass('caja-hidden').addClass('caja-visible');
        // Excepción para página de modificación de contraseña
        $(".content-datos-acceso").removeClass('caja-hidden').addClass('caja-visible');
        // Excepción para página de bajada del certificado
        $(".content-certificado-download").removeClass('caja-hidden').addClass('caja-visible');
        // Excepción para datos personales en formulario premium
        $(".content-datos-premium").removeClass('caja-hidden').addClass('caja-visible');
    }

    function toggleBoxVisibility() {
        $('.node-type-webform .webform-client-form .caja-content > .form-item.webform-component').on('click', function (event){
            $containerBox = $(this).parent();
            if ($containerBox.hasClass('caja-visible')) {
                $containerBox.removeClass('caja-visible').removeClass('active').addClass('caja-hidden');
            }
            else {
              var $boxes = $('.node-type-webform .webform-client-form .caja-content');
              $boxes.each(function(index) {
                  var $box = $(this);
                  $box.removeClass('caja-visible').removeClass('active').addClass('caja-hidden');
              });
              $containerBox.removeClass('caja-hidden').addClass('caja-visible').addClass('active');
              event.preventDefault();
              $('html,body').animate(
                  {
                      scrollTop: $(this).offset().top - 55
                  },
                  0
              );
            }
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

    /* Funciones al cargar la página. Esto hace que tambien se ejecute si vuelve de un error en las validaciones */
    $( document ).ready(function() {

      // Borrar campos de nueva contraseña

      if( $(".password").length > 0 ){
            $(".password").val("");
            $(".password").text("");
      }

      // Mover boton de submit al footer

      if( $(".webform-conditional-processed").length > 0 ){
        var submit = $(".form-actions");
        $(".footer").after(submit);

        $(".form-submit").click(function(){
            $(".webform-client-form").submit();
        });
      }

      // Eliminar boton de footer cuando es la descarga del certificado
      if( $(".content-certificado-download").length > 0 ){
          $(".form-actions").hide();
      }

      /******* Cálculo de la cuota actual y de las cuotas sugeridas *********/

      if( $(".cuota_actual").length > 0 ){

        // campo donde va a ir la cuota defitiva
        var cantidad_actual = $("[name='submitted[caja_cuota][civicrm_1_contact_1_cg15_fieldset][civicrm_1_contact_1_cg15_custom_101]']").val();
        var frec_actual = $("[name='submitted[caja_cuota][civicrm_1_contact_1_cg15_fieldset][civicrm_1_contact_1_cg15_custom_43]']").val();

        // Calculamos la cuota, la pasamos de anual a fraccionada
        var cuota_act = Math.round(cantidad_actual/Math.round(frec_actual));

        // Calculamos frecuencia
        var period_act = '';
        switch(frec_actual){
          case '1':
            period_act = 'anual';
            break;
          case '2':
            period_act = 'semestral';
            break;
          case '4':
            period_act = 'trimestral';
            break;
          case '12':
            period_act = 'mensual';
            break;
        }

        // Pintamos cuota y frecuancia
        $(".cuota_actual").val(cuota_act+' €');
        $(".period_actual").val(period_act);

      }

      /******* Fecha de alta y estado *********/

      if( $(".fecha_actual").length > 0 ){
          var fecha_actual = $("[name='submitted[caja_cuota][civicrm_1_contact_1_cg15_fieldset][civicrm_1_contact_1_cg15_custom_68]']").val();
          var estado_actual = $("[name='submitted[caja_cuota][civicrm_1_contact_1_cg15_fieldset][civicrm_1_contact_1_cg15_custom_67]']").val();
          var est_act = '';
          switch(estado_actual){
            case 'NORMAL':
              est_act = 'al corriente';
              break;
            case 'DEVO 1':
              est_act = 'recibo devuelto';
              break;
            case 'DEVO 2':
              est_act = 'recibo devuelto';
              break;
            case 'DEVO 3':
              est_act = 'recibo devuelto';
              break;
            case 'PREBAJA':
              est_act = 'recibo devuelto';
              break;
          }
          var alta = fecha_actual.split(" ");
          var fecha = alta[0].split("-");
          $(".fecha_actual").val(fecha[2]+"-"+fecha[1]+"-"+fecha[0]);
          $(".estado_actual").val(est_act);
      }

      /******** Fecha de baja **********/
      var fecha_baja = $("[name='submitted[caja_cuota][civicrm_1_contact_1_cg15_fieldset][civicrm_1_contact_1_cg15_custom_69]']").val();
      console.log(fecha_baja);
      if( fecha_baja ){
        // Bloquear todos los campos
        $('.content-datos input, .content-direccion input, .content-cuenta input, .content-idioma input, .content-preferencias input,'+
        '.content-datos select, .content-direccion select, .content-cuenta select, .content-idioma select, .content-preferencias select').each(
          function(){
            $(this).attr("readonly", true);
            $(this).css("background-color", "#eee");
          }
        );
        // Quitar elementos de cuota y añadir fecha de baja
        var baja = fecha_baja.split(" ");
        var bajastr = baja[0].split("-");
        $(".content-colaborar .fila-1").each(function(){
            $(this).css("visibility", "hidden");
            $(this).css("height","0px");
        });
        $(".content-colaborar").append(
          "<p style='font-size:20px;margin-top:-30px;'>Te diste de baja de la organización el <b>"+bajastr[2]+"-"+bajastr[1]+"-"+bajastr[0]+"</b>.</p></br>"+
          "<p style='font-size:18px;margin-top:20px;'>Si quieres volver a colaborar con Amnistía Internacional rellena el <a href='https://crm.es.amnesty.org/unete-a-amnistia' target='_blank'>siguiente formulario</a> o escríbenos a <a href='mailto:sociosysocias@es.amnesty.org'>sociosysocias@es.amnesty.org</a>. ¡Gracias!"
        )
      }

  });

});
