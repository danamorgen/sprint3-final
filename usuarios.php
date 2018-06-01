<?php

class Usuarios{

/*public function traerTodos(){
        /*trae todos los usuarios que estan en el json
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
  }*/


 /*public function traerUltimoId(){

  $arrayDeUsuarios=self::traerTodos();
  if(empty($arrayDeUsuarios)){
      return 1;
  }
  $elUltimo = array_pop($arrayDeUsuarios);
  $id = $elUltimo['id'];
  //$id = $elUltimo->id;                                                        //   MODIFIQUE ACAAAAAAAAAAA
  //$id = $elUltimo->getId();
  return $id + 1;
  }

public function traerPorId(){

}*/

/* public function existeMail($email){

    $todos = self::traerTodos();

    foreach ($todos as $unUsuario) {
    			if ($unUsuario['email'] == $email) {                                               // ACAAAAAAAAAAAAAAA
    																					return $unUsuario;
    																				 }
    	                              }
  	return false;
  }  /* SI EXISTE ME DEVUELVE EL USUARIO*/
}
