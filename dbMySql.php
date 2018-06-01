<?php

require_once('DB.php');
require_once('usuario.php');

class dbMySql extends DB{

  private $pdo;  // ver si private o protected
  private $message;
  private $migrationStatus;


  public function __construct(){
    $this->pdo = new PDO('mysql:host=localhost',"root", '');
    $this->archivo = 'usuarios.json';                            // este hay que eliminarlo
  }

  public function getMessage(){
    return $this->message;
  }

  public function getMigrationStatus(){
    return $this->migrationStatus;
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

  public function my_db(){
    $consultaDeVerificacion_db = $this->pdo->prepare("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'basedeprueba'");
    $consultaDeVerificacion_db->execute();
    $resultadoDeVerificacion = $consultaDeVerificacion_db->fetchAll(PDO::FETCH_ASSOC);
    if(count($resultadoDeVerificacion)==0)
    {
      $crear_db = $this->pdo->prepare('CREATE DATABASE IF NOT EXISTS baseDePrueba');
      $crear_db->execute();

      if($crear_db){
        $use_db = $this->pdo->prepare('USE baseDePrueba');
        $use_db->execute();
      }
      /*header('location: script.php?cdb=ok');
      exit;*/  $this->message = "¡Base de datos creada exitosamente!";
    } else {
      $this->message = "¡La base de datos ya ha sido creada previamente!";

    }
  }

  public function createTable(){

    $consultaDeVerificacion_db = $this->pdo->prepare("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'basedeprueba'");
    $consultaDeVerificacion_db->execute();
    $resultadoDeVerificacion = $consultaDeVerificacion_db->fetchAll(PDO::FETCH_ASSOC);
    if(count($resultadoDeVerificacion) == 0){
      $this->message = "¡Debe crear la base de datos primero!";

    } else {
      $use_db = $this->pdo->prepare('USE baseDePrueba');
      $use_db->execute();


      $consultaDeVerif_db = $this->pdo->prepare("SELECT TABLE_NAME FROM information_schema.tables WHERE table_schema = 'basedeprueba' AND table_name = 'users'");
      $consultaDeVerif_db->execute();
      $resultadoDeVerif = $consultaDeVerif_db->fetchAll(PDO::FETCH_ASSOC);

      if(count($resultadoDeVerif) == 0) {
        try {
          $this->pdo->beginTransaction();
          $crear_table = $this->pdo->prepare('CREATE TABLE IF NOT EXISTS users (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            nameComplete VARCHAR(60) NOT NULL,
            username VARCHAR(30) NOT NULL,
            email VARCHAR(50),
            country VARCHAR(30),
            registration_date TIMESTAMP,
            password VARCHAR(60),
            imagen VARCHAR(60))');
            $crear_table->execute();

            $crear_profile_table = $this->pdo->prepare('CREATE TABLE IF NOT EXISTS profile_user (
              id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              ciudadDeNacimiento VARCHAR(60) NOT NULL,
              ocupacion VARCHAR(30),
              idiomas VARCHAR(50),
              fechaDeNacimiento VARCHAR(10),
              intereses VARCHAR(60),
              usuario_id INT unsigned NOT NULL,
              FOREIGN KEY (usuario_id) REFERENCES users (id) )');


            $crear_profile_table->execute();

            $this->message = "¡Tablas creadas exitosamente!";
            $this->pdo->commit();
          } catch (PDOException $e) {
            $this->pdo->rollBack();
            $this->message= 'upsss  error en bd '.$e->getMessage();
          }

      } else {
        $this->message = "¡La tabla ya ha sido creada previamente!";
      }

    }



      }

      public function migrationToMySql(){
        $usuariosJson = file_get_contents($this->archivo);
        $usuariosArray = explode(PHP_EOL, $usuariosJson);
        array_pop($usuariosArray);
        foreach ($usuariosArray as $usuarioParaDecode) {
          $usuarios[] = json_decode($usuarioParaDecode, true);
        }
        if ($this->chequeoBase_Tabla() == 0){
          $this->message = "¡Primero debe crear la base de datos y la tabla loooserrrr!";
        } else if($this->chequeoMigracion() == 1){
          $this->message = "¡Ya se ha realizado la migracion!";
        }else{
          $use_db = $this->pdo->prepare('USE baseDePrueba');
          $use_db->execute();
          foreach ($usuarios as $usuarios) {
            $consultaPrevia= " SELECT email FROM users WHERE email = :email";
            $query=$this->pdo->prepare($consultaPrevia);
            $query->bindValue(':email',$usuarios['email'],PDO::PARAM_STR);
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            if(count($resultado) == 0)
            {
              $consulta= " INSERT INTO users (nameComplete, username, email, country, password, imagen)
              VALUES (:name, :username, :email, :country, :password, :imagen)";
              $query=$this->pdo->prepare($consulta);
              $query->bindValue(':name',$usuarios['name'],PDO::PARAM_STR);
              $query->bindValue(':username',$usuarios['username'],PDO::PARAM_STR);
              $query->bindValue(':email',$usuarios['email'],PDO::PARAM_STR);
              $query->bindValue(':country',$usuarios['pais'],PDO::PARAM_STR);
              $query->bindValue(':password',$usuarios['pass'],PDO::PARAM_STR);
              $query->bindValue(':imagen',$usuarios['imagen'],PDO::PARAM_STR);
              $query->execute();
              $this->message = "¡Migracion de datos exitosa!";
            }
          }
        }
      }


      public function chequeoMigracion(){
        $use_db = $this->pdo->prepare('USE baseDePrueba');
        $use_db->execute();
        $consultaPrevia = "SELECT * FROM users";
        $query = $this->pdo->prepare($consultaPrevia);
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);

        if(count($resultado)>0){
          return $this->migrationStatus = 1;
        }
      }

      public function chequeoBase_Tabla(){
        $consultaDeVerificacion_db = $this->pdo->prepare("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'basedeprueba'");
        $consultaDeVerificacion_db->execute();
        $resultadoDeVerificacion = $consultaDeVerificacion_db->fetchAll(PDO::FETCH_ASSOC);


        $consultaDeVerif_db = $this->pdo->prepare("SELECT TABLE_NAME FROM information_schema.tables WHERE table_schema = 'basedeprueba' AND table_name = 'users'");
        $consultaDeVerif_db->execute();
        $resultadoDeVerif = $consultaDeVerif_db->fetchAll(PDO::FETCH_ASSOC);

        if(count($resultadoDeVerificacion) == 0 && count($resultadoDeVerif) == 0)
        {
          return 0;
        }
        else {
          {
            return 1;
          }
        }
      }


      public function guardarUsuario(Usuario $usuario){

        $use_db = $this->pdo->prepare('USE baseDePrueba');
        $use_db->execute();

        $consulta= " INSERT INTO users (nameComplete, username, email, country, password, imagen)
        VALUES (:name, :username, :email, :country, :password, :imagen)";
        $query=$this->pdo->prepare($consulta);
        $query->bindValue(':name', $usuario->getName(),PDO::PARAM_STR);
        $query->bindValue(':username',$usuario->getUsername(),PDO::PARAM_STR);
        $query->bindValue(':email', $usuario->getEmail(),PDO::PARAM_STR);
        $query->bindValue(':country', $usuario->getPais(),PDO::PARAM_STR);
        $query->bindValue(':password',$usuario->getPassword(),PDO::PARAM_STR);
        $query->bindValue(':imagen',$usuario->getImagen(),PDO::PARAM_STR);
        $query->execute();

        // return $usuario;
      }


      public function existeMail($email){


        $use_db = $this->pdo->prepare('USE baseDePrueba');
        $use_db->execute();

        $consultaDeVerificacion_db = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $consultaDeVerificacion_db->bindValue(':email', $email ,PDO::PARAM_STR);
        $consultaDeVerificacion_db->execute();
        $resultado = $consultaDeVerificacion_db->fetchAll(PDO::FETCH_ASSOC);
        if(count($resultado)> 0)
        {
          foreach ($resultado as $unUsuario) {

            $usuarioEncontrado = new Usuario($unUsuario['name'], $unUsuario['email'], $unUsuario['pais'], $unUsuario['username'], $unUsuario['password'], $unUsuario['imagen']);
            $usuarioEncontrado->setId($unUsuario['id']);
            return $usuarioEncontrado;
          }
          // ACA DEVUELVO UN USUARIO VER COMO LO BUSCO
        }
        return false;
      }

      public function traerPorId($id){

        $use_db = $this->pdo->prepare('USE baseDePrueba');
        $use_db->execute();

        $consultaDeVerificacion_db = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $consultaDeVerificacion_db->bindValue(':id', $id ,PDO::PARAM_INT);
        $consultaDeVerificacion_db->execute();
        $resultado = $consultaDeVerificacion_db->fetchAll(PDO::FETCH_ASSOC);

        if (count($resultado)>0) {
          foreach ($resultado as $unUsuario) {
            $usuarioEncontrado = new Usuario($unUsuario['nameComplete'], $unUsuario['email'], $unUsuario['country'], $unUsuario['username'], $unUsuario['password'], $unUsuario['imagen']);
            $usuarioEncontrado->setId($unUsuario['id']);
            return $usuarioEncontrado;
          }
        }
        return false;
      }


      public function backupJson(){
        $use_db = $this->pdo->prepare('USE baseDePrueba');
        $use_db->execute();

        $consultaDeVerificacion_db = $this->pdo->prepare("SELECT * FROM users");
        $consultaDeVerificacion_db->execute();
        $resultado = $consultaDeVerificacion_db->fetchAll(PDO::FETCH_ASSOC);


        foreach ($resultado as $usuario) {

          $usuarioArray =[
            'id' => $usuario['id'],
            'name' => $usuario['nameComplete'],
            'username' => $usuario['username'],
            'email' => $usuario['email'],
            'pais' => $usuario['country'],
            'pass' => $usuario['password'],
            'imagen'=> $usuario['imagen']
          ];
          $usuarioJSON = json_encode($usuarioArray);
          file_put_contents($this->archivo, $usuarioJSON . PHP_EOL, FILE_APPEND);

        }
      }


public function saveProfile($id, $errores,$data){
  if(empty($errores)){

    $use_db = $this->pdo->prepare('USE baseDePrueba');
    $use_db->execute();
    $consulta = "INSERT INTO profile_user (ciudadDeNacimiento, ocupacion, fechaDeNacimiento, intereses, usuario_id)
    VALUES (:ciudad, :ocupacion, :fechaDeNacimiento, :intereses, :usuario_id)";
    $query = $this->pdo->prepare($consulta);
    $query->bindValue(':ciudad', $data['ciudadNacimiento'], PDO::PARAM_STR);
    $query->bindValue(':ocupacion', $data['ocupacion'], PDO::PARAM_STR);
    $query->bindValue(':fechaDeNacimiento', $data['fechaNacimiento'], PDO::PARAM_STR);
    $query->bindValue(':intereses', $data['intereses'], PDO::PARAM_STR);
    $query->bindValue(':usuario_id', $id, PDO::PARAM_INT);
    $query->execute();
    $this->message = "Gracias por completar tu perfil";

  }
}
    }

    //    Illuminate\Database\QueryException  : SQLSTATE[HY000] [1049] Unknown database 'basedelaravel' (SQL: select * from information_schema.tables where table_schema = basedelaravel and table_name = migrations)   ver esto si sirve de algo fue un error de laravel

    ?>
