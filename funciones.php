<?php
session_start();

if (isset($_COOKIE['id'])) {
		$_SESSION['id'] = $_COOKIE['id'];
	}

function crearUsuario($data, $imagen){
    $usuario = [
        'id' => traerUltimoId(),
        'name' => $data['name'],
        'email' => $data['email'],
        'username' => $data['username'],
        'pass' => password_hash($data['pass'], PASSWORD_DEFAULT),
        'pais' => $data['pais'],
        'imagen' => 'imagenUsuarios/' . $data['email'] . '.' . pathinfo($imagen['name'], PATHINFO_EXTENSION)

    ];

    return $usuario;
}



function guardarUsuario($data, $imagen){  /*ACA HAY ALGO PARA PREGUNTAR*/
      $usuario = crearUsuario($data, $imagen);
   		$usuarioJSON = json_encode($usuario);
   		file_put_contents('usuarios.json', $usuarioJSON . PHP_EOL, FILE_APPEND);
   		// Devuelvo al usuario para poder auto loguearlo después del registro   MIRAR ACAAAAAAAAAAAAAAAAAAAAAAAAAAA
   		return $usuario;
}

function traerTodos(){ /*trae todos los usuarios que estan en el json*/
  		$todosJson = file_get_contents('usuarios.json');
  		// Esto me arma un array con todos los usuarios
  		$usuariosArray = explode(PHP_EOL, $todosJson);    // creo que usuariosArray tiene solo 2 posiciones la ultima es vacia
  		// Saco el último elemento que es una línea vacia
  		array_pop($usuariosArray);
  		// Creo un array vacio, para guardar los usuarios
  		$todosPHP = [];
  		// Recorremos el array y generamos por cada usuario un array del usuario
  		foreach ($usuariosArray as $usuario) {
  			$todosPHP[] = json_decode($usuario, true);   // PREGUNTAR PORQUE HACEMOS ESTO EN UN foreach !!!!!!!!!!!!!!!!!!!!!!!!!!!
  		}
  		return $todosPHP;
}

function traerUltimoId(){
  $arrayDeUsuarios=traerTodos();
  if(empty($arrayDeUsuarios)){
      return 1;
  }
  $elUltimo = array_pop($arrayDeUsuarios);
  $id = $elUltimo['id'];
  return $id + 1;
}

function existeMail($email){
  $todos = traerTodos();
  foreach ($todos as $unUsuario) {
  			if ($unUsuario['email'] == $email) {
  																					return $unUsuario;
  																				 }
  	                              }
	return false;
}  /* SI EXISTE ME DEVUELVE EL USUARIO*/

function validar($data, $imagen){
  global $errores;     // ME CONVIENE ESTO O SIMPLEMENTE DECLARAR UNA VARIABLE LOCAL??? PREG
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
  } elseif (existeMail($email)) {
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
            else {
                guardarImagen($imagen);
                }
   }
   return $errores;
 }

   /*function validarLogin($data){  // ACA HAY ALGO QUE TENGO QUE PREGUNTAR
  $arrayADevolver = [];
		$email = trim($data['e-mail']);
		$pass = trim($data['password']);
		if ($email == '') {
								$arrayADevolver['email'] = 'Completá tu email';
											} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
																										$arrayADevolver['email'] = 'Poné un formato de email válido';
																									} elseif (!$usuario= existeMail($email)) {   //  <--- MIRAR ACA ME GENERA DUDA
              																		/*  SI NO EXISTE EL MAIL   !false= false
																										$arrayADevolver['email'] = 'Este email no está registrado';
																																						} else {
																											// Si el mail existe, me guardo al usuario dueño del mismo
																										 // $usuario = existeMail($email);   //Esta demas esta creo
/* el $usuario=existeMail se ejecuta igual no?		  	if (!password_verify($pass, $usuario["pass"])) {
																	         	$arrayADevolver['pass'] = "Credenciales incorrectas";
																	      	}
																				}
		return $arrayADevolver;
}  */

function loguear($usuario) {
		// Guardo en $_SESSION el ID del USUARIO
		setcookie('id', $usuario['id'], time() + 3600 * 24 * 30);
	  $_SESSION['id'] = $usuario['id'];
		header('location: perfil.php');
		exit;
	}


  function estaLogueado() {
		return isset($_SESSION['id']);
	}

  function traerPorId($id){
		$todos = traerTodos();
		// Recorro el array de todos los usuarios
		foreach ($todos as $usuario) {
			if ($id == $usuario['id']) {
				return $usuario;
			}
		}
		return false;
	}
 ?>
