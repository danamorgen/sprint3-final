<?php
require_once ('acceso.php');
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
    </style>
</head>

<body>
  <header class="fixed-top row bg-blue justify-content-md-between mb-3 p-1 pl-2 d-flex align-items-center">
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
          <a href="index.php" class="p-2"> INICIO </a>
          <a href="#" class="p-2"> SEGURIDAD </a>
          <a href="#ancla-contacto" class="p-2"> CONTACTO </a>
      </div>
      <div class="col-12 col-sm-6 col-md-3 col-lg-3">
          <div>
              <button class="toggle-nav d-md-none d-lg-none mt-2">
                                <span class="ion-navicon-round"></span>
                              </button>
              <nav class="main-nav d-md-none d-lg-none" style="display: none;">
                  <ul>
                      <li><a href="index.html">inicio</a></li>
                      <li><a href="#">seguridad</a></li>
                      <li><a href="#ancla-contacto">contacto</a></li>
                      <li><a href="#">idioma</a></li>
                    </ul>
              </nav>
              <a href="registro.php" class="btn btn-outline-light mt-1">Registrarse</a>
              <a href="inicio-sesion.html" class="btn btn-outline-light mt-1">Iniciar Sesión</a>

          </div>
      </div>

  </header>
  <div class="container-fluid d-inline d-md-none d-lg-none mt-150px">
      <div class="box" style="margin-top: 150px">
          <div class="overlay">
              <div class="text"> Voyager es el sitio ideal para que los viajeros compartan su itinerario de viaje. </div>
          </div>
          <h3 class="text-xs-center text-white">¿Qué es Voyager?</h3>
      </div>
      <div class="box ">
          <div class="overlay ">
              <div class="text">Cualquier usuario mayor de 18 años puede registrarse y comenzar a utilizar la web.</div>
          </div>
          <h3 class="text-xs-center text-white">¿Quién puede usar Voyager?</h3>
      </div>
      <div class="box">
          <div class="overlay">
              <div class="text">Los usuarios pueden registrarse en nuestra web gratis.</div>
          </div>
          <h3 class="text-xs-center text-white">¿Cuánto cuesta usar Voyager?</h3>
      </div>
      <div class="box">
          <div class="overlay">
              <div class="text">Voyager te permite filtrar la búsqueda basado en un amplio rango de criterios: edad, género , nacionalidad, destino y más.</div>
          </div>
          <h3 class="text-xs-center text-white">¿Qué pasa si no quiero compartir mi itinerario con todos los usuarios?</h3>

      </div>

      <div class="box">
          <div class="overlay">
              <div class="text">¡Para nada! También podes compartir experiencias con otros viajeros para ayudarlos a armar sus itinerarios.</div>
          </div>
          <h3 class="text-xs-center text-white">¿Voyager es sólo para viajeros planeando un viaje?</h3>
        </div>

          <div class="box">
              <div class="overlay">
                  <div class="text">Además de seleccionar quién verá tus itinerarios, podes bloquear/reportar a un usuario en caso de que actue inapropiadamente.</div>
              </div>
            <h3 class="text-xs-center text-white">¿Soy una mujer viajando sola, la web es segura ?</h3>
            </div>

              <div class="box">
                  <div class="overlay">
                      <div class="text"> Sí. Podes utilizar tu usuario de Facebook para loguearte.</div>
                  </div>
                  <h3 class="text-xs-center text-white">¿Puedo conectarme con Facebook?</h3>

      </div>
  </div>
  </div>

    <div class="container-fluid contenido d-none d-md-block d-lg-block">
        <div class="box1">
            <h2> ¿Qué es Voyager?</h2>
            <br>
            <p> Voyager es el sitio ideal para que los viajeros compartan su itinerario de viaje.  </p>

        </div>
        <div class="box1">
            <h2> ¿Quién puede usar Voyager? </h2>
            <br>
            <p> Cualquier usuario mayor de 18 años puede registrarse y comenzar a utilizar la web. </p>

        </div>
        <div class="box1">
            <h2> ¿Cuánto cuesta usar Voyager? </h2>
            <br>
            <p> Los usuarios pueden registrarse en nuestra web gratis. </p>

        </div>
        <div class="box1">
            <h2> ¿Qué pasa si no quiero compartir mi itinerario con todos los usuarios? </h2>
            <br>
            <p>  Voyager te permite filtrar la búsqueda basado en un amplio rango de criterios. Podes buscar en Voyager por tipo de viajero, edad, género , nacionalidad, destino y más. Estos parámetros de búsqueda se guardarán como preferencias
                hasta que los quieras cambiar en la próxima búsqueda. Esta web está diseñada para que puedas adaptarla a tus necesidades de viaje. Y por supuesto, descubrir en las sugerencias de otros viajeros, experiencias increíbles para incorporar
                en tu itinerario de viaje. </p>


        </div>
        <div class="box1">
            <h2> ¿Qué tipo de viajero soy? </h2>
            <br>
            <p> Hay muchos tipos de viajeros diferentes y por supuesto no queremos limitar a Voyager a ninguna categoría restrictiva. Como guía, acá tenemos algunos de los tipos de viajero más frecuentes. Pero recordá que podes seleccionar más de una categoría
                (o todas las que apliquen) para describirte. Esta guía te ayudará a descubrir qué tipo de viajeros podes encontrar en la aplicación.
            </p>
            <ul>
                <li>Mochilero - De cualquier edad, en busca de aventura. Con presupuesto limitado.</li>
                <li>Nomade digital - Si disfrutas trabajar remoto o la playa es tu oficina.</li>
                <li>Aventurero – Excursiones, Escalar, Montañismo, Ski, Rafting… Todo de tipo de aventura al aire libre.</li>
                <li>Viajero en pareja– Dos amigos o una pareja viajando juntos.</li>
                <li>Viajero en familia– Familias viajeras buscando compartir experiencias con otras familias en viaje.</li>
            </ul>
            </p>

        </div>
        <div class="box1">
            <h2> ¿Voyager es sólo para viajeros planeando un viaje? </h2>
            <br>
            <p> ¡Para nada! Si ya finalizaste tu viaje, también podes compartir experiencias con otros viajeros para ayudarlos a armar sus itinerarios. </p>


        </div>
        <div class="box1">
            <h2> ¿Soy una mujer viajando sola, la web es segura ? </h2>
            <br>
            <p> Voyager te permite seleccionar quien verá tus itinerarios. También te brinda la posibilidad de bloquear o reportar algún usuario en caso de que actue inapropiadamente. Inmediatamente serán suspendidos en nuestra web. </p>


        </div>
        <div class="box1">
            <h2> ¿Puedo conectarme con Facebook?</h2>
            <br>
            <p> Sí. Podes utilizar tu usuario de Facebook para loguearte. </p>


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
