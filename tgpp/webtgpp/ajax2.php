<?php
include_once 'usuarios2.class.php';

$usuario = new Usuarios();
    
echo json_encode($usuario->buscarUsuario(utf8_decode($_GET['term'])));
  