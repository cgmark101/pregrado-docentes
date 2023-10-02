<?php
$inscHabilitada		= true; // define si el modulo esta habilitado
$enProduccion		= true; // define si esta en produccion o en pruebas

$acceso_user0		= true; // define el acceso a los usuarios para carga de notas (URACE)
$acceso_user1		= true; // define el acceso a los usuarios para (SERVICIO COMUNITARIO)
$acceso_user2		= true; // define el acceso a los usuarios para carga de notas (TRABAJO DE GRADO)
$acceso_user7		= true; // define el acceso a los usuarios para carga de notas (ENT. INDUSTRIAL)

$tProceso	= 'Trabajo de Grado y Practica Profesional'; // titulo del modulo
$tLapso		= '2023-1'; // lapso en el que se esta usando el modulo
$lapsoProceso = '2023-1'; // lapso de uso interno

//----------------------------------------------------------------------------------------------------------

//$ODBC_name = "DACEPOZ"; // nombre del origen de datos
$ODBC_name = "CENTURA-DACE"; // nombre del origen de datos
$usuario_db = "c"; // usuario de la db
$password_db = "c"; // password de la db

$ODBC_user = "USERDOC"; // origen de datos usuarios
$usuario_user = "c"; // usuario de la db usuarios
$password_user = "c"; // password de la db usuarios

$raiz="http://".$_SERVER['SERVER_NAME']."/web/"; // 
$log="log/carga-pptg_".date('m-Y').".log";// registro de transacciones


$vicerrectorado		= "Puerto Ordaz";
$nombreDependencia = 'Unidad Regional de Admisi&oacute;n y Control de Estudios';

// Proteccion de las paginas contra boton derecho, no javascript y navegadores no soportados:
if ($enProduccion){
	$botonDerecho = 'oncontextmenu="return false"';
	$noJavaScript = '<noscript><meta http-equiv="REFRESH" content="0;URL=no-javascript.php"></noscript>';
	$noCache	  = "<meta http-equiv=\"Pragma\" content=\"no-cache\">\n";
	$noCache	 .= '<meta http-equiv="Expires" content="-1">';
	$noCacheFin	  = '<head><meta http-equiv="Pragma" content="no-cache"></head>';
}
else {
	$botonDerecho = '';
	$noJavaScript = '';
	$noCache	  = '';
	$noCacheFin	  = '';
}
?>
