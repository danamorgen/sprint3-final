<?php
require_once 'usuario.php';

abstract class DB {

protected $archivo;

public abstract function guardarUsuario(Usuario $usuario);
public abstract function existeMail($email);
// public abstract function traerTodos();
}
 ?>
