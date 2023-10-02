<?php
print $noCache; 
print $noJavaScript; 


include_once("inc/vImage.php");
include_once('../inc/odbcss_c.php');
include_once ('inc/config.php');
include_once ('../inc/activaerror.php');

//$lista = array();

//if(isset($_POST['acta']) && isset($_POST['cedula'])) {
	
	//$acta=26;
	//$cedula=13982186;
	/*print $acta;
	print $cedula;*/
//}

/*$Cmat = new ODBC_Conn("DACEPPPP","N","N");
$mSQL = "select a.exp_e,a.apellidos,a.nombres,b.acta,b.c_asigna,";
$mSQL= $mSQL."c.asignatura,b.seccion,e.ci,e.apellido,e.nombre ";
$mSQL= $mSQL."from dace002 a,dace006 b,tblaca008 c,tblaca007 e,tblaca004 f ";
$mSQL= $mSQL."where b.lapso='2007-2' and a.exp_e=b.exp_e ";
$mSQL= $mSQL."and  b.acta ='16' and b.c_asigna=c.c_asigna and f.ci='13982186' ";
$mSQL= $mSQL."and b.c_asigna=f.c_asigna and b.lapso=f.lapso and b.seccion=f.seccion ";
$mSQL= $mSQL."and b.acta=f.acta and f.ci=e.ci order by 2";
$Cmat->ExecSQL($mSQL);
$lista_e=$Cmat->result;

$nro=0;

foreach ($lista_e as $est){
	$exp_e = $est[0];
	$ape_e = $est[1];
	$nomb_e = $est[2];

	$nro=$nro+1;	
	print $exp_e;
	//print $nro;
	//break;
}*/

//if( isset($_POST['acta']) && isset($_POST['lista']) && isset($_POST['nota']) && isset($_POST['exp']) ) {

//if( isset($_POST['exp']) && isset($_POST['apellido']) && isset($_POST['nombre']) && isset($_POST['nota']) ) {	
	
	
	foreach ($_POST('nota') as $nota){
		print $nota;
	}
	
		
	/*$numero=$_POST['numero'];
	$exp=$_POST['exp'];
	$apellido=$_POST['apellido'];
	$nombre=$_POST['nombre'];
	$nota=$_POST['nota'];
	//$acta=$_POST['acta'];

	/*print $numero;	
	print $exp;
	print $apellido;
	print $nombre;
	print $nota;
//	print $acta;

	
	/*foreach ($lista as $est){
		$exp_e = $est[];
		$ape_e = $est[1];
		$nomb_e = $est[2];

		print $exp_e;
	}*/
	
	


	/*$acta = $est[3];
	$c_asigna = $est[4];
	$asig = $est[5];
	$secc = $est[6];
	$cidoc = $est[7];
	$apedoc = $est[8];	
	$nombdoc = $est[9];*/


?>