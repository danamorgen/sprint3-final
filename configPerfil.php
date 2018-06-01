<?php

require_once ('acceso.php');
require_once ('validaciones.php');
//require_once('soporte.php');
if (!$auth->estaLogueado()) {
  header('location: inicio-sesion.php');
  exit;
}
// $usuario = $dbJSON->traerPorId($_SESSION['id']);                     ESTA LINEA VA SI GUARDO EN JSON
$usuario = $dbMYSQL->traerPorId($_SESSION['id']);
$ciudadNacimiento = "";
$ocupacion = "";
$fechaDeNac = "";
$intereses = "";

if ($_POST){
  $ciudadNacimiento = trim($_POST['ciudadNacimiento']);
  $ocupacion = trim($_POST['ocupacion']);
  $fechaDeNac = trim($_POST['fechaNacimiento']);
  $intereses = trim ($_POST['intereses']);
  $errores= Validaciones::validarConfigPerfil($_POST);
  $dbMYSQL->saveProfile($usuario,  $errores , $_POST);
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
    'menu main main main main right'
    'menu main main main main right	';
    grid-gap: 10px;
    background-color: white;
    padding: 10px;
  }
  .grid-container > div {
    <!-- text-align: right; -->
    padding: 50px 0;
    font-size: 1.2em;
  }
  </style>
</head>

<body>
  <header class="fixed-top row bg-blue justify-content-md-between mb-3 p-1 pl-2 d-flex align-items-center">
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

        <a href="configperfil.php" class="btn  btn-outline-light mt-1">Configuración</a>
        <a href="logout.php" class="btn  btn-outline-light  mt-1">Cerrar Sesión</a>

      </div>
    </div>

  </header>

  <!-- PROFILE PROFILE PROFILE -->

  <div class="fluicontainer p-5 mt-5 ">
    <div class="row">
      <div class="text-center col-12 col-md-3 col-lg-4">
        <h1>Perfil </h1>
        <h2><?=$usuario->getName()?></h2>
        <img class="img-fluid"style="" src="<?=$usuario->getImagen()?>" width="250">
        <br>
        <h4><?= $usuario->getPais() ?></h4>
      </div>
      <div class='p-2 col-12 col-md-8 col-lg-8'>
        <form class="form-control m-2 p-5 margin-auto" method="post" >

          <!-- <label class="input-group input-group-lg"><strong>Nombre y apellido</strong></label>
          <input type="text" name="name" class="w-100 mb-3 mt-2 form-control"  value=""> -->

          <label class="input-group input-group-lg "><strong>Ciudad de nacimiento</strong></label>
          <input type="text" name="ciudadNacimiento" class="w-100 mb-3 mt-2 form-control"  value="<?=$ciudadNacimiento?>">
          <?php if (isset($errores['ciudadNacimiento'])): ?>
            <span style="color: red;"><?=$errores['ciudadNacimiento'];?></span>
          <?php endif; ?>

          <label class="input-group input-group-lg "><strong>Ocupación</strong></label>
          <input type="text" name="ocupacion" class="w-100 mb-3 mt-2 form-control"  value="<?=$ocupacion?>">
          <?php if (isset($errores['ocupacion'])): ?>
            <span style="color: red;"><?=$errores['ocupacion'];?></span>
          <?php endif; ?>

          <label class="input-group input-group-lg "><strong>Fecha de nacimiento</strong></label>
          <input type="date" name="fechaNacimiento" class="w-100 mb-3 mt-2 form-control" value="<?=$fechaDeNac?>">
          <?php if (isset($errores['fechaNacimiento'])): ?>
            <span style="color: red;"><?=$errores['fechaNacimiento'];?></span>
          <?php endif; ?>
<br>
          <span class="pseudo-label"><strong>Idiomas que hablo</strong></span>
          <div class="container-inline actions">
            <select name='language'>
              <option value="español" selected>Español</option>
              <option value="afr">Inglés</option>
              <option value="frances">Francés</option>
              <option value="portugues">Portugués</option>
              <option value="chino">Chino</option>
              <option value="japones">Japonés</option>
              <option value="koreano">Koreano</option>
              <option value="aleman">Alemán</option>
              <option value="arabe">Arabe</option>
              <option value="italiano">Italiano</option>
              <option value="hebreo">Hebreo</option>
              <option value="polaco">Polaco</option>
              <option value="turco">Turco</option>
              <option value="guarani">Guaraní</option>
              <option value="noruego">Noruego</option>
              <option value="rumano">Rumano</option>
            </select>
            <a href="#!" class="badge badge-primary">Añadir idioma</a>
          </div>
          <br>
          <div>
            <label class="input-group input-group-lg "><strong>Intereses</strong></label>
            <input type="text" name="intereses" class="w-100 mb-3 mt-2 form-control"  value=" <?=$intereses?>" placeholder="Agrega tus intereses separados por una coma">
            <?php if (isset($errores['intereses'])): ?>
              <span style="color: red;"><?=$errores['intereses'];?></span>
            <?php endif; ?>
          </div>
          <div>
            <label class="input-group input-group-lg"><strong>Otros</strong></label>
            <textarea cols="82%"  rows="6"class="form-control">
            </textarea>
          </div>

          <div>
            <!--  <a href="perfil.php" class="btn btn-lg btn-primary btn-block btn-signin mt-3 mb-3">Guardar cambios</a> -->
            <button type="submit" name="changeConfigProfile" class="btn btn-lg btn-primary btn-block btn-signin mt-3 mb-3">Guardar cambios</button>
          </div>

        </form>

      </div>

    </div>

  </div>
</div>
<!-- FOOTER FOOTER FOOTER FOOTERFOOTER FOOTERFOOTER -->
<footer class="bg-blue margin mt-3 text-white text-center">
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
