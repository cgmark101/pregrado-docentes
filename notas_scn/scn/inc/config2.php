<?php
$inscHabilitada		= true; // define si el modulo esta habilitado
$enProduccion		= false; // define si esta en produccion o en pruebas

$tProceso	= 'Trabajo de Grado y Practica Profesional'; // titulo del modulo
$tLapso		= '2012-1'; // lapso en el que se esta usando el modulo

//----------------------------------------------------------------------------------------------------------

$ODBC_name = "claves"; // nombre del origen de datos
$usuario_db = "root"; // usuario de la db
$password_db = "123qwe123"; // password de la db
$raiz="http://".$_SERVER['SERVER_NAME']."/web/"; // 
$log="pptg.log";// registro de transacciones
$lapsoProceso='2012-1'; // lapso de uso interno

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
