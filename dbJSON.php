<?php
require_once('DB.php');

class dbJSON extends DB{

  public function __construct(){
    $this->archivo = 'usuarios.json';
  }

  public function guardarUsuario(Usuario $usuario){
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
    return $usuario;
  }


  public function traerTodos(){
    $todosJson = file_get_contents($this->archivo);
    $usuariosArray = explode(PHP_EOL, $todosJson);
    array_pop($usuariosArray);
    $todosPHP = [];
    foreach ($usuariosArray as $usuario) {
      $usuarioJSON = json_decode($usuario, true);
      $usuario = new Usuario($usuarioJSON["name"], $usuarioJSON["email"], $usuarioJSON["pais"], $usuarioJSON["username"], $usuarioJSON["pass"], $usuarioJSON["imagen"]);
      $usuario->setId($usuarioJSON["id"]);
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

}
}




} ?>
