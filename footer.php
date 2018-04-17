<!-- Footer -->
<footer class="footer print-hidden">
    <div class="footer__container">
        <div class="grid footer__bottom">
            <div class="footer__col--left">
                <p class="footer-legal">
                  <?php if($cat){ ?>
                    <a href="https://www.es.amnesty.org/contacto/" class="footer-legal__link" target="_blank">Contacte</a> &nbsp;&nbsp;|&nbsp;&nbsp;
                    <a href="https://www.es.amnesty.org/politica-de-privacidad/" class="footer-legal__link" target="_blank">Política de privacitat</a> &nbsp;&nbsp;|&nbsp;&nbsp;
                    <a href="https://www.es.amnesty.org/mapa-del-sitio/" class="footer-legal__link" target="_blank">Mapa del lloc</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                    <a href="#" class="footer-legal__link" target="_blank">Baixa</a>
                  <?php }else{ ?>
                    <a href="https://www.es.amnesty.org/contacto/" class="footer-legal__link" target="_blank">Contacto</a> &nbsp;&nbsp;|&nbsp;&nbsp;
                    <a href="https://www.es.amnesty.org/politica-de-privacidad/" class="footer-legal__link" target="_blank">Política de privacidad</a> &nbsp;&nbsp;|&nbsp;&nbsp;
                    <a href="https://www.es.amnesty.org/mapa-del-sitio/" class="footer-legal__link" target="_blank">Mapa del sitio</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                  <?php } ?>
                </p>
                <p class="footer-copyright">©<?php echo date("Y"); ?> Amnistía Internacional España</p>
            </div>
            <div class="footer__col--right">
                <ul class="social-list print-hidden">
                  <?php if($cat){ ?>
                    <li class="social-list__item"><a href="http://www.facebook.com/amnistia.internacional.catalunya" target="_blank" class="social-list__link--facebook" data-ga="event,Social,click,facebook">Haznos Me Gusta en Facebook</a></li>
                    <li class="social-list__item"><a href="http://twitter.com/amnistiaCAT" target="_blank" class="social-list__link--twitter" data-ga="event,Social,click,amnestytwitter">Síguenos en Twitter</a></li>
                    <li class="social-list__item"><a href="http://www.youtube.com/amnistiaespana" target="_blank" class="social-list__link--youtube" data-ga="event,Social,click,youtube">Suscríbete a nuestro canal de YouTube</a></li>
                    <li class="social-list__item"><a href="http://instagram.com/amnistiacat/" target="_blank" class="social-list__link--instagram" data-ga="event,Social,click,instagram">Síguenos en Instagram</a></li>
                  <?php }else{ ?>
                    <li class="social-list__item"><a href="http://www.facebook.com/amnistia.internacional.espana" target="_blank" class="social-list__link--facebook" data-ga="event,Social,click,facebook">Haznos Me Gusta en Facebook</a></li>
                    <li class="social-list__item"><a href="http://twitter.com/amnistiaespana" target="_blank" class="social-list__link--twitter" data-ga="event,Social,click,amnestytwitter">Síguenos en Twitter</a></li>
                    <li class="social-list__item"><a href="http://www.youtube.com/amnistiaespana" target="_blank" class="social-list__link--youtube" data-ga="event,Social,click,youtube">Suscríbete a nuestro canal de YouTube</a></li>
                    <li class="social-list__item"><a href="http://instagram.com/amnistiaespana/" target="_blank" class="social-list__link--instagram" data-ga="event,Social,click,instagram">Síguenos en Instagram</a></li>
                  <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</footer>
