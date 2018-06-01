<?php
require_once ('soporte.php');
if($dbMYSQL->chequeoMigracion()!= 1){
  header('location: script.php');
}
?>
