<!-- Header -->
<?php if( !in_array('administrator', $user->roles) ){ ?>
<nav class="navbar navbar-fixed-top">
  <header class="header" data-header="" role="banner">
      <div class="header__container" data-header-container="">
          <div class="header__slogan-container">
            <?php if($cat) { ?>
                <div class="header__slogan"> Actuem pels drets humans arreu del món. </div>
            <?php } else { ?>
                  <div class="header__slogan"> Actuamos por los derechos humanos en todo el mundo </div>
            <?php } ?>
          </div>
          <?php if($cat){ ?>
            <h1 class="logo" data-logo=""><a class="logo__link" href="https://www.amnistiacatalunya.org">Amnistia Internacional Catalunya</a></h1>
          <?php }else{ ?>
            <h1 class="logo" data-logo=""><a class="logo__link" href="https://www.es.amnesty.org">Amnistía Internacional España</a></h1>
          <?php } ?>
          <!-- Dropdown menu con Bootstrap -->
          <div class="container" id="logout">
              <div class="nav-mobile">
                <a id="nav-toggle" href="#!"><span></span></a>
              </div>
              <div class="dropdown dropdown-menu-right">
                <button class="btn btn-lg btn-warning dropdown-toggle" id="user-menu" type="button" data-toggle="dropdown">
                  <?php echo "Hola, " . $user->name . " "; ?>
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                  <!--li role="presentation"><a role="menuitem" tabindex="-1" href="area-privada">Mi cuenta</a></li>
                  <li role="presentation" class="divider"></li-->
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="area-privada-certificado">Descargar certificado IRPF</a></li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="area-privada-acceso">Cambiar contraseña</a></li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="user/logout/?destination=area-privada-certificado">Cerrar sesión</a></li>
                </ul>
             </div>
        </div>
      </div>
  </header>
</nav>
<?php } ?>

<!-- Image after header-->
<div class="image-header image-header--has-credits-sm image-header--actua">
    <div id="pixel"></div>
    <div style="background-image: url('<?php print $images_path.$img_header; ?>?anchor=topcenter');" class="responsive--bg <?php print $extra_class; ?> lazyloaded"
          data-bgset="<?php print $images_path.$img_header; ?>?anchor=topcenter">
      </div>
      <noscript>
          <img src="<?php print $images_path.$img_header; ?>?anchor=topcenter" class=responsive__img>
      </noscript>

    <div class="image-header__content--medium">
        <div class="image-headline--full">
            <h2 class="image-headline__actua-title">
              <!--a href="area-privada"-->
                <span class="heading--tape--dark"><?php  $title = explode('#',$node->title); echo $title[0];  ?></span>
              <!--/a-->
            </h2>
        </div>
    </div>
</div><!-- Image after header -->
