<?php include_once('inc/config.php');
require_once('inc/odbcss_c.php');
session_start();


$user = $_SESSION["user"];
//echo 'USER:';
//echo $user;
//echo '<br />';
$ced = $_SESSION["ced"];
//echo 'ID:';
//echo $ced;
//Buscamos usuario en tblaca007
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT nombre,apellido FROM tblaca007 WHERE ci='$ced'";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$nombre=$result[0][0];
$apellido=$result[0][1];

switch ($user){

case 0:
//URACE user 
//include('enc0.php');
$c_asignad=' ';

break;

case 1:
//Servicio Comunitario user //listo
//include('enc1.php');
$c_asignad='300622';
break;

case 2:
//Mecanica user
$c_asignad='322040';
break;

case 3:
//Electrica user
$c_asignad='311040';
break;

case 4:
//Metalurgica user
$c_asignad='333040';
break;

case 5:
//Electronica user
$c_asignad='355959';
break;

case 6:
//Industrial user
$c_asignad='344040';
break;

case 7:
//Entrenamiento Industrial user

break;

}
?>