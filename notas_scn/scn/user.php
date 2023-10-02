<?php session_start();
include_once('inc/config.php');
require_once('inc/odbcss_c.php');



$user = $_SESSION["user"];
$ced = $_SESSION["ced"];
/*echo 'USER:';
echo $user;
echo '<br />';
echo 'ID:';
echo $ced;*/

//Buscamos usuario en tblaca007
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT nombre,apellido FROM tblaca007 WHERE ci='$ced'";     
$conex->ExecSQL($mSQL,__LINE__,false);
if ($conex->filas > 0) {
	$result = $conex->result;
	$nombre=$result[0][0];
	$apellido=$result[0][1];
} else {
	$conex = new ODBC_Conn("FDOCENTE",$usuario_db,$password_db,TRUE,$log);
	$mSQL = "SELECT nombres,apellidos FROM dpersonales WHERE ci='$ced' "; 

	$conex->ExecSQL($mSQL,__LINE__,false);

	if ($conex->filas > 0){
		$result = $conex->result;
		$nombre=$result[0][0];
		$apellido=$result[0][1];
	}
}

switch ($user){

case 0:
//URACE user 
include('enc0.php');
//$c_asignad=' ';

break;

case 75:
//Servicio Comunitario user //listo
include('enc1.php');
$c_asignad='300622';
break;

case 21: case 22:
//Mecanica user
include('enc2.php');
$c_asignad='322040';
break;

case 31: case 32:
//Electrica user
include('enc2.php');
$c_asignad='311040';
break;

case 41: case 42:
//Metalurgica user
include('enc2.php');
$c_asignad='333040';
break;

case 51: case 52:
//Electronica user
include('enc2.php');
$c_asignad='355959';
break;

case 61: case 62:
//Industrial user
include('enc2.php');
$c_asignad='344040';
break;

case 700:
//Entrenamiento Industrial user
include('enc7.php');

break;

}
?>