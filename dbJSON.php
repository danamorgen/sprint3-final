<?php
require_once('DB.php');
class dbJSON extends DB{

  public function __construct(){
     $this->archivo = 'usuarios.json';
  }

 public function guardarUsuario(Usuario $usuario){      // NUEVO METODO QUE MOVI ACA DESDE USUARIO.PHP
    $usuarioArray =[
                     'id' => $usuario->getId(),
                     'name' => $usuario->getName(),
                     'username' => $usuario->getUsername(),
                     'email' => $usuario->getEmail(),
                     'pais' => $usuario->getPais(),
                     'pass' => $usuario->getPassword(),
                     'imagen'=> $usuario->getImagen()
    ];
   $usuarioJSON = json_encode($usuarioArray);
   file_put_contents($this->archivo, $usuarioJSON . PHP_EOL, FILE_APPEND);
   // Devuelvo al usuario para poder auto loguearlo después del registro   MIRAR ACAAAAAAAAAAAAAAAAAAAAAAAAAAA
   return $usuario;    // DEVUELVO EL MISMO USUARIO QUE ME LLEGO OSEA UN OBJETO
  }


 public function traerTodos(){
        /*trae todos los usuarios que estan en el json */
    		$todosJson = file_get_contents($this->archivo);
    		// Esto me arma un array con todos los usuarios
    		$usuariosArray = explode(PHP_EOL, $todosJson);    // creo que usuariosArray tiene solo 2 posiciones la ultima es vacia
    		// Saco el último elemento que es una línea vacia
    		array_pop($usuariosArray);
    		// Creo un array vacio, para guardar los usuarios
    		$todosPHP = [];
    		// Recorremos el array y generamos por cada usuario un array del usuario
    		foreach ($usuariosArray as $usuario) {
    			$usuarioJSON = json_decode($usuario, true);   // PREGUNTAR PORQUE HACEMOS ESTO EN UN foreach !!!!!!!!!!!!!!!!!!!!!!!!!!!
          $usuario = new Usuario($usuarioJSON["name"], $usuarioJSON["email"], $usuarioJSON["pais"], $usuarioJSON["username"], $usuarioJSON["pass"], $usuarioJSON["imagen"]);
        	$usuario->setId($usuarioJSON["id"]);
          //  var_dump($usuario);
          $todosPHP[] =$usuario;
        }
        return $todosPHP;
  }

public function traerUltimoId(){

    $arrayDeUsuarios = $this->traerTodos();
    if(empty($arrayDeUsuarios)){
        return 1;
    }
    $elUltimo = array_pop($arrayDeUsuarios);
    //$id = $elUltimo['id'];
    //$id = $elUltimo->id;                                                        //   MODIFIQUE ACAAAAAAAAAAA
    $id = $elUltimo->getId();
    return $id + 1;
  }

   /*public function traerPorId(){

   }*/

   public function existeMail($email){

       $todos = $this->traerTodos();

       foreach ($todos as $unUsuario) {
       		//	if ($unUsuario['email'] == $email) {                                               // ACAAAAAAAAAAAAAAA
       	 if ($unUsuario->getEmail() == $email) 	{
           	                                  return $unUsuario;
       																				 }
       	                              }
     	return false;
    }  /* SI EXISTE ME DEVUELVE EL USUARIO                             UN USUARIO DE TIPO ARRAY*/


  public function traerPorId($id){
      $todos = $this->traerTodos();
      // Recorro el array de todos los usuarios
      foreach ($todos as $usuario) {
        if ($id == $usuario->getid()) {
          return $usuario;
        }
      }
      return false;
    }
   public function guardarImagen($imagen){   // aca modifique $imagen antes estaba $_FILES[$imagen]
       // $errores = [];
      if ($imagen['error'] == UPLOAD_ERR_OK) {
   				     $nombreArchivo = $imagen['name'];
   				     $ext = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
   				     $archivoFisico = $imagen['tmp_name'];
   				     // Pregunto si la extensión es la deseada
   				    // if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png') {   VAMOS A ELIMINAR ESTO PORQUE EN TEORIA YA LO COMPRUEBA EN LA FUNCION VALIDAR
   				       // Armo la ruta donde queda gurdada la imagen
   				       $direccionReal = dirname(__FILE__);
   				       $rutaFinalConNombre = $direccionReal . '/imagenUsuarios/' . $_POST['email'] . '.' . $ext;
   				       // Subo la imagen definitivamente
   				       move_uploaded_file($archivoFisico, $rutaFinalConNombre);
   				                  /* } else {
   				                       $errores['imagen'] = 'El formato tiene que ser JPG, JPEG, PNG o GIF';
   				                     }
   				                   } else {
   				                     // Genero error si no se puede subir
   				                     $errores['imagen'] = 'No subiste nada';
   				                   }
   				                    return $errores;*/
   				                    // VAMOS A PROBAR HACIENDO QUE guardarImagen no devuelva nada simplemente se dedique a guardar la imagen

    }
   }




} ?>
