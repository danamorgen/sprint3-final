<?php
//require_once('soporte.php');
require_once('acceso.php');
require_once('usuario.php');
require_once('usuarios.php');
require_once('validaciones.php');



$data=$_POST;

if ($auth->estaLogueado()) {
		header('location: perfil.php');
		exit;
	}

$paises = ['Argentina', 'Brasil', 'Colombia', 'Chile', 'Uruguay', 'Paraguay', 'Bolivia', 'Ecuador', 'Guyana', 'Perú', 'Surinam', 'Venezuela'];

$name = '';
$email = '';
$pais = '';
$username= '';

$errores = [];

if ($_POST) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pais = trim($_POST['pais']);
    $username = trim($_POST['username']);
    $imagen = $_FILES["imagen"];

    //$errores = Validaciones::validarDatos($_POST, $imagen, $dbJSON);
    $errores = Validaciones::validarDatos($_POST, $imagen, $dbMYSQL);

    if (empty($errores)) {
      //  $dbJSON->guardarImagen($imagen);   estas lineas van si guardo en json
      $dbMYSQL->guardarImagen($imagen);
      $ext = pathinfo($imagen['name'], PATHINFO_EXTENSION);
			$picture = 'imagenUsuarios/' . $email . '.' . $ext;
      $usuario = new Usuario($data['name'], $data['email'], $data['pais'], $data['username'], password_hash($data['pass'], PASSWORD_DEFAULT), $picture);


    //   $usuario->setId($dbJSON->traerUltimoId());  estas lineas van si guardo en json
   //    $dbJSON->guardarUsuario($usuario);

      	$dbMYSQL->guardarUsuario($usuario);

			header('location: inicio-sesion.php?primeraVez=ok');
			exit;
    }
}

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
    </style>
</head>

<body>
  <header class="fixed-top row bg-blue justify-content-md-between mb-3 p-1 pl-2 d-flex align-items-center"> <!--     style="display: none !important;"    ACA JAVI LE PUSO DISPLAY NONE PARA QUE PODAMOS VER LOS ERRORES SINO EL HEADER LO TAPA Y NO PODEMOS LEER -->
      <div class="col-12 col-sm-6 col-md-2 col-lg-3 ">
          <img alt="logotipo" src="imagenes/logo.png" class="d-block logotipo">
          </div>
      <div class="select-dropdown d-none d-md-inline col-md-5 col-lg-6">
          <select class="select-dropdown__language">
          <option value="en_US">English</option>
          <option selected="selected" value="es_ES">Español</option>
          <option value="fr_FR">Français</option>
          <option value="pt_BR">Portugués</option>
          <option value="de_DE">Deutsch</option></select>
          <a href="faq.php" class="p-2"> PREGUNTAS FRECUENTES </a>
          <a href="#" class="p-2"> SEGURIDAD </a>
          <a href="#ancla-contacto" class="p-2"> CONTACTO </a>
      </div>
      <div class="col-12 col-sm-6 col-md-3 col-lg-3">
          <div>
              <button class="toggle-nav d-md-none d-lg-none mt-2">
                                <span class="ion-navicon-round"></span>
                              </button>
              <nav class="main-nav d-md-none d-lg-none" style="display: none;"> <!-- aca hay otro display none que no se porque -->
                  <ul>
                      <li><a href="faq.php">preguntas frecuentes</a></li>
                      <li><a href="#">seguridad</a></li>
                      <li><a href="#ancla-contacto">contacto</a></li>
                      <li><a href="#">idioma</a></li>
                    </ul>
              </nav>

              <a href="inicio-sesion.php" class="btn btn-outline-light mt-1">Iniciar Sesión</a>
              <a href="index.php" class="btn btn-outline-light mt-1">Volver al Inicio</a>

          </div>
      </div>

  </header>
    <div class="contenido">

<!-- FORMULARIOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO -->
<!-- FORMULARIOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO
-->
<!-- FORMULARIOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO -->
<!-- FORMULARIOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO
-->
        <div class="contenedor-registracion container-fluid imgFondo d-flex flex-column justify-content-center align-items-center w-100">
            <div class="p-4">

                <form class="form-control p-5 margin-auto" enctype="multipart/form-data"  method="post">
									<h2 class="mb-3 text-center">Registro</h2>

                  <label class="input-group input-group-lg "> Nombre y Apellido</label>
                  <input type="text" name="name" class="w-100 mb-3 mt-2"  value="<?=$name?>">
                  <?php if (isset($errores['name'])): ?>
      				<span style="color: red;"><?=$errores['name'];?></span>
      			<?php endif; ?>

                    <label class="input-group input-group-lg "> Ingresa tu e-mail</label>
                    <input type="email" name="email" class="w-100 mb-3 mt-2"  value="<?=$email?>">
                    <?php if (isset($errores['email'])): ?>
        				<span style="color: red;"><?=$errores['email'];?></span>
        			<?php endif; ?>

                    <label class="input-group input-group-lg "> Crear nombre de usuario</label>
                    <input type="text" name="username" class="w-100 mb-3 mt-2" value="<?=$username?>">

                    <?php if (isset($errores['username'])): ?>
        				<span style="color: red;"><?=$errores['username'];?></span>
        			<?php endif; ?>

                    <label class="input-group input-group-lg ">Ingresa una contraseña</label>
                    <input type="password" name="pass" class="w-100 mb-3 mt-2" value="">
                    <?php if (isset($errores['pass'])): ?>
                <span style="color: red;"><?=$errores['pass'];?></span>
              <?php endif; ?>

                    <label class="input-group input-group-lg">Confirma la contraseña</label>
                    <input type="password" name="rpass" class="w-100 mb-3 mt-2" value="">
                    <?php if (isset($errores['pass'])): ?>
                <span style="color: red;"><?=$errores['pass'];?></span>
              <?php endif; ?>
                    <div class="align-items-center">
                      <div class="form-group">
                          País
                          <select class="form-control input-group input-group-lg" name="pais">
                              <option value="">Elegi País</option>
                              <?php foreach ($paises as $value): ?>
                                  <?php if ($value == $pais): ?>
                                      <option selected value="<?=$value?>"><?=$value?></option>
                                  <?php else: ?>
                                      <option value="<?=$value?>"><?=$value?></option>
                                  <?php endif; ?>
                              <?php endforeach; ?>
                          </select>
                          <?php if (isset($errores['pais'])): ?>
                      <span style="color: red;"><?=$errores['pais'];?></span>
                      <?php endif; ?>
                      </div>

                  <label for="">Subí tu foto de perfil </label><br>
                  <input type="file" name="imagen" value="">
                  <?php if (isset($errores['imagen'])): ?>
              <span style="color: red;"><?=$errores['imagen'];?></span>
            <?php endif; ?>


                        <button type="submit" name="button" class="btn btn-lg btn-primary btn-block btn-signin mt-3 mb-3">Registrar</button>
                        <div class="d-flex justify-content-center">
                            <p><a href="#!" class="btn btn-outline-dark">
											<span class="ion-social-facebook mr-2"></span>
												Registrate con Facebook</a>     ó
												<a href="index.php" class="text-dark">
											Volver al Inicio</a>
																</p>
                        </div>
                </form>

                </div>

            </div>
        </div>

        <footer class="bg-blue margin mt-3 text-white text-center">
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
