<?php
require_once('acceso.php');

	if (!$auth->estaLogueado()) {  /*esta logueado devuelve si la session[id] esta seteada o no */
		header('location: inicio-sesion.php');
		exit;
	}
//  	$usuario = $dbJSON->traerPorId($_SESSION['id']);   							ESTA LINEA VA SI QUIERO GUARDAR EN JSON
	$usuario = $dbMYSQL->traerPorId($_SESSION['id']);
 ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Voyager - Planificá tu viaje</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        p {
            font-size: 1.2em;
        }

				.item2 { grid-area: menu; }
		.item3 { grid-area: main; }
		.item4 { grid-area: right; }
		.grid-container {
			display: grid;
			grid-template-areas:
				'header header header header header header'
				'menu main main main right right'
				'menu main main main right right	';
			grid-gap: 10px;
			background-color: white;
			padding: 10px;
		}
		.grid-container > div {
		 <!-- text-align: right; -->
			padding: 50px 0;
			font-size: 1.2em;
		}
		.bg-white {
			background-color: white;
		}


    </style>
</head>


<body>
	<!-- le saque el fixed-top al header -->
  <header class="bg-blue justify-content-md-between mb-3 p-1 pl-2 d-flex align-items-center">
      <div class="col-12 col-sm-6 col-md-2 col-lg-3 ">
          <img alt="logotipo" src="imagenes/logo.png" class="d-block logotipo">
          </div>
      <div>

				<div class="input-group">
				  <div class="input-group-prepend">
				    <button class="btn btn-primary btn-sm" type="button">Explorar</button>
				  </div>
				  <input type="text" class="form-control form-control-sm" placeholder="Busca un destino" aria-label="Destinos" aria-describedby="basic-addon1">
				</div>


      </div>
      <div class="col-12 col-sm-6 col-md-3 col-lg-3">
          <div>
              <button class="toggle-nav d-md-none d-lg-none mt-2">
                                <span class="ion-navicon-round"></span>
                              </button>
              <nav class="main-nav d-md-none d-lg-none" style="display: none;">
                  <ul>
                      <li><a href="faq.php">preguntas frecuentes</a></li>
                      <li><a href="#">seguridad</a></li>
                      <li><a href="#ancla-contacto">contacto</a></li>
                      <li><a href="#">idioma</a></li>
                    </ul>
              </nav>
              <a href="configperfil.php" class="btn btn-outline-light mt-1">Configuración</a>
	              <a href="logout.php" class="btn btn-outline-light  mt-1">Cerrar Sesión</a>

          </div>
      </div>

  </header>
<!-- PROFILE PROFILE PROFILE -->

<!--   sheiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii -->

<div class="grid-container p-5 ">
<div class="row">
	<div class="item2 text-center   col-12 col-sm-6 col-md-5 col-lg-4">
		<h1>Perfil </h1>
		<h2><?=$usuario->getName()?></h2>
			<img src="<?=$usuario->getImagen()?>" width="200">
<br>
			<h4><?= $usuario->getPais()?></h4>
		</div>
<div class='item3 p-2 bg-white col-12 col-sm-6 col-md-7 col-lg-8'>
	<?php var_dump ($dbMYSQL->getMessage());
	?>

<br><br><br>
<em>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</em>
</div>
</div>

</div>
<!-- FOOTER FOOTER FOOTER FOOTERFOOTER FOOTERFOOTER -->
  <footer class="bg-blue margin mt-3 text-white text-center ">
    <a name="ancla-contacto"></a>
      <p class="pt-2">SEGUINOS</p>
      <a href="https://www.facebook.com/" target="_blank"><span class="ion-social-facebook-outline m-2"></span></a>
      <a href="https://twitter.com/?lang=es" target="_blank"><span class="ion-social-twitter-outline m-2"></span></a>
      <a href="https://www.instagram.com/" target="_blank"><span class="ion-social-instagram-outline m-2"></span></a>
      <a href="https://www.tumblr.com/" target="_blank"><span class="ion-social-tumblr-outline m-2"></span></a>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
      /* global $ */
      $('.toggle-nav').click(function() {
          $('.main-nav').slideToggle('fast');
      });
      window.onscroll = function() {
          myFunction()
      };
  </script>

</body>

</html>
