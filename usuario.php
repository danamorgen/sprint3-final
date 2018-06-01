<?php

class Usuario{

private $id;   // si pongo private no olvidarme que debo usar setters y getters
private $name;
private $email;
private $pais;
private $username; // ver si public o public
private $password;
private $imagen;


public function __construct ($name, $email, $pais, $username, $password, $imagen){
  $this->name= $name;
  $this->email= $email;
  $this->pais= $pais;
  $this->username= $username;
  $this->password= $password;
  //$this->password = password_hash($password, PASSWORD_DEFAULT);
  $this->imagen= $imagen;

}

// setters y getters
public function setId($id){
  $this->id=$id;
}

public function getId(){
  return $this->id;
}

public function setName($name){
  $this->name=$name;
}

public function getName(){
  return $this->name;
}

public function setEmail($email){
  $this->email=$email;
}

public function getEmail(){
  return $this->email;
}

public function setPais($pais){
  $this->pais=$pais;
}

public function getPais(){
  return $this->pais;
}

public function setUsername($username){
  $this->username=$username;
}

public function getUsername(){
  return $this->username;
}

public function setPassword($password){
  $this->password = password_hash($pasword, PASSWORD_DEFAULT);
}

public function getPassword(){
  return $this->password;
}
public function setImagen($rutaImagen){
  $this->imagen=$rutaImagen;
}

public function getImagen(){
  return $this->imagen;
}


/*public function guardar(Usuario $usuario){    le saque el static
  // podria darle forma de array asoc al objeto aca de ultima  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

   $usuarioArray =[
                    'id' => $usuario->getId(),
                    'name' => $usuario->getName(),
                    'username' => $usuario->getUsername(),
                    'email' => $usuario->getEmail(),
                    'pais' => $usuario->getPais(),
                    'pass' => $usuario->getPassword()
   ];
  $usuarioJSON = json_encode($usuarioArray);
  file_put_contents('usuarios.json', $usuarioJSON . PHP_EOL, FILE_APPEND);
  // Devuelvo al usuario para poder auto loguearlo después del registro   MIRAR ACAAAAAAAAAAAAAAAAAAAAAAAAAAA
  return $usuario;
}


  //      'imagen' => 'imagenUsuarios/' . $data['email'] . '.' . pathinfo($imagen['name'], PATHINFO_EXTENSION)

*/

} ?>
