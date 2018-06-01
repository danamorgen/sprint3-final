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
            <a href="faq.php" class="p-2"> PREGUNTAS FRECUENTES </a>
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
                        <li><a href="faq.html">preguntas frecuentes</a></li>
                        <li><a href="#">seguridad</a></li>
                        <li><a href="#ancla-contacto">contacto</a></li>
                        <li><a href="#">idioma</a></li>
                      </ul>
                </nav>
                <a href="registro.php" class="btn btn-outline-light mt-1">Registrarse</a>
                <a href="inicio-sesion.php" class="btn btn-outline-light mt-1">Iniciar Sesión</a>

            </div>
        </div>

    </header>

    <div class="contenido">

    </div>
    <div class="jumbotron">
        <div class="jumbotron1 p-5">
            <h1 class="display-3">¡Unite!</h1>
            <p class="lead">Contactá con viajeros en todo el mundo y planificá tu viaje con ellos.</p>
            <p>Prepará tu agenda de viaje o colaborá en las agendas de otros viajeros.</p>
            <p class="lead">
                <a href="#!" class="btn btn-outline-dark mt-1">
              <span class="ion-social-facebook mr-2"></span>
                Registrate con Facebook</a>
                <a href="#!" class="btn btn-outline-dark mt-1">
              <span class="ion-ios-email mr-2"></span>
                Registrate con tu email</a>

            </p>
        </div>
    </div>

    <div class="container-fluid">
        <div class="box text-center">
            <div class="overlay d-none d-lg-inline">
                <div class="text">Armá tu agenda con los lugares que queres visitar, tus fechas disponibles y tu presupuesto. Buscá opciones de vuelos, traslados y hospedajes.</div>
            </div>
            <span class="ion-clipboard"></span>
            <h3 class="text-xs-center text-white">Armá tu itinerario</h3>
        </div>
        <div class="box text-center">
            <div class="overlay d-none d-lg-inline">
                <div class="text">Compartí tu plan con el resto de la comunidad para conocer a otras personas interesadas en tu viaje.</div>
            </div>
            <span class="ion-paper-airplane"></span>
            <h3 class="text-xs-center text-white">Compartí tu viaje</h3>
        </div>
        <div class="box text-center">
            <div class="overlay d-none d-lg-inline">
                <div class="text">Mirá los planes de viaje de otros viajeros y descubrí nuevas ideas y actividades.</div>
            </div>
            <span class="ion-earth"></span>
            <h3 class="text-xs-center text-white">Contactá con viajeros de todo el mundo</h3>
        </div>
        <div class="box text-center">
            <div class="overlay d-none d-lg-inline">
                <div class="text">Armá una agenda compartida para planificar tu viaje con otras personas.</div>
            </div>
            <span class="ion-android-happy mr-1"></span><span class="ion-android-happy mr-1"></span><span class="ion-android-happy mr-1"></span>
            <h3 class="text-xs-center text-white">Planificá en equipo</h3>

        </div>
    </div>
    </div>

    <footer class="bg-blue margin mt-3 text-white text-center">

        <p class="pt-2">SEGUINOS</p>
        <a name="ancla-contacto"></a>
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
    </script>
</body>

</html>
