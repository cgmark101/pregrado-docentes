<?php
include_once 'usuarios.class.php';

$usuario = new Usuarios();
    
echo json_encode($usuario->buscarUsuario(utf8_decode($_GET['term'])));
  