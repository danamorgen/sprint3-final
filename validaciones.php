<?php
class Validaciones{

  public function validarDatos($data, $imagen, $db){
    $errores=array();
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pais = trim($_POST['pais']);
    $pass = trim($_POST['pass']);
    $rpass = trim($_POST['rpass']);
    $username = trim($_POST['username']);


    if ($name == '') {
      $errores['name'] = "Completa tu nombre";
    }
    if ($username == '') {
      $errores['username'] = "Completa tu nombre de usuario";
    }
    if ($pais == '') {
      $errores['pais'] = "Completa tu país de origen";
    }
    if ($email == '') {
      $errores['email'] = "Completa tu email";
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errores['email'] = "El email indicado es incorrecto";
    } elseif ($db->existeMail($email)) {
      $errores['email'] = "Este mail ya se encuentra registrado";
    }
    if ($pass == '' || $rpass == '') {
      $errores['pass'] = "Por favor completa tu password";
    }elseif ($pass != $rpass) {
      $errores['pass'] = "Las contraseñas no coinciden";
    }

    if($imagen["error"] !== UPLOAD_ERR_OK){
      $errores["imagen"] = 'Por favor subí tu foto de perfil';
    } else {
      $ext = strtolower(pathinfo($imagen["name"], PATHINFO_EXTENSION)); // VAMOS A PASAR A MINUSCULA

      if ($ext !== "jpg" && $ext !== "jpeg" && $ext !== "png")  {
        $errores["imagen"]= "Formato no reconocido, subi solamente jpg, jpeg, JPG o png: La extension subida es: $ext";
      }
      /*else {
      //             PREGUNTAR ACA   guardarImagen($imagen);
    }*/
  }
  return $errores;
}

public function validarLogin($data, $db){
  $arrayADevolver = [];
  $email = trim($data['e-mail']);
  $pass = trim($data['password']);
  if ($email == '') {
    $arrayADevolver['email'] = 'Completá tu email';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $arrayADevolver['email'] = 'Poné un formato de email válido';
  } elseif (!$usuario = $db->existeMail($email)) {   //  <--- MIRAR ACA ME GENERA DUDA
    /*  SI NO EXISTE EL MAIL   !false= false*/
    $arrayADevolver['email'] = 'Este email no está registrado';
  } else {
    // Si el mail existe, me guardo al usuario dueño del mismo
    // $usuario = existeMail($email);   //Esta demas esta creo
    /* el $usuario=existeMail se ejecuta igual no?*/		  	if (!password_verify($pass, $usuario->getPassword())) {
    $arrayADevolver['pass'] = "Credenciales incorrectas";
  }
}

return $arrayADevolver;

}

public function validarConfigPerfil($data){
  $arrayADevolver = [];
  $ciudadNacimiento = trim($data['ciudadNacimiento']);
  $ocupacion = trim($data['ocupacion']);
  $fechaDeNac = trim($data['fechaNacimiento']);
  $intereses = trim ($data['intereses']);

  if ($ciudadNacimiento == '') {
    $arrayADevolver['ciudadDeNacimiento'] = 'Completá tu ciudad de nacimiento';
  }
  if ($ocupacion == '') {
    $arrayADevolver['ocupacion'] = 'Completá tu ocupacion';
  }

  if ($fechaDeNac == '') {
    $arrayADevolver['fechaNacimiento'] = 'Completá tu fechaNacimiento';
  }
  if ($intereses == '') {
    $arrayADevolver['intereses'] = 'Completá tu intereses';
  }

  return $arrayADevolver;
}

} ?>
