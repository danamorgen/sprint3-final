<?php
require_once('dbMySql.php');
require_once('soporte.php');
//$dbMYSQL = new dbMySql
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

     section {
         margin-top: 100px;
         padding:140px;
         background-image: url("imagenes/airport.jpg");
         background-position: center;
         background-repeat: no-repeat;
       }

     section ul {
       padding-top: 25px 25px;
       margin-left: -150px;
     }

     section ul a, button {
       width: 500px;
       display:block;
       font-size: 20px;
       background-color: rgb(51, 84, 201);
       margin-bottom:20px;
       padding:10px 20px 10px 40px;
       border-radius:15px;
       transition:background .6s, margin-left -6s, margin-right .6s;
     }

     section ul a:hover{
       margin-right:-50px;
       margin-left:20px;
       background-color:#00BFFF;
     }
   </style>
</head>

<body>

   <header class="fixed-top row bg-blue justify-content-md-between mb-3 p-1 pl-2 d-flex align-items-center">
       <div class="col-12 col-sm-6 col-md-2 col-lg-3 ">
           <img alt="logotipo" src="imagenes/logo.png" class="d-block logotipo">
       </div>

   </header>

<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->

<section class="menu">
 <ul>
 <li>  <a href="script.php?cdb=ok">CREAR BASE DE DATOS</a> </li>
 <?php if (isset($_GET['cdb'])) {
    $dbMYSQL->my_db();
    echo "<div class='alert alert-info text-center'>
        <strong><h3>¡".$dbMYSQL->getMessage()."!</h3></strong>
        </div>";
       } ?>
 <li>  <a href="script.php?lalala=ok">CREAR TABLAS</a> </li>
 <?php if (isset($_GET['lalala'])) {
   $dbMYSQL->createTable();
    echo "<div class='alert alert-info text-center'>
        <strong><h3>¡".$dbMYSQL->getMessage()."!</h3></strong>
        </div>";
       } ?>
 <li>  <a href="script.php?lol=ok">MIGRAR USUARIOS</a> </li>
 <?php if (isset($_GET['lol'])) {
    $dbMYSQL->migrationToMySql();
    echo "<div class='alert alert-info text-center'>
        <strong><h3>¡".$dbMYSQL->getMessage()."!</h3></strong>
        </div>";
       }?>

 <li>  <a href="script.php?go">IR AL HOME</a> </li>
       <?php if (isset($_GET['go'])) {
       if($dbMYSQL->chequeoMigracion() == 1){
         header('location:index.php');
       }
     }?>


 </ul>
</section>

   <footer class="bg-blue margin mt-3 text-white text-center fixed-bottom">

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
