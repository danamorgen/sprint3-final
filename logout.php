<?php
  session_start();
  session_destroy();
  setcookie('id', ' ', time() - 10);
  header('location: index.php');
