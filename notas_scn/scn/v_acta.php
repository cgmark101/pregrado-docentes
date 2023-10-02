<?php 
include_once('user2.php');

error_reporting(E_ALL);
include_once('inc/config.php');
require_once('inc/odbcss_c.php');
setlocale(LC_ALL,"es_ES@euro","es_ES","esp"); 

if(empty($_POST['acta'])):
echo "<script languaje='javascript'>
alert('ALERTA: NO HA SELECCIONADO UN ACTA');
window.close();
</script>";
else:
$acta=$_POST['acta'];

$alc=explode('_',$acta);

$acta=$alc[0];
$lap=$alc[1];
$cod=$alc[2];
?>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</HEAD>
<?php
//se consulta la asignatura (el acta de servicio comunitario es diferente)
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL = "SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.status, a.afec_indice ";
$mSQL.= "FROM dace004 a,tblaca009 b,tblaca008 c,his_act d ";
$mSQL.= "WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and ";
$mSQL.= "b.obligatoria='1' and b.c_asigna=c.c_asigna and a.acta='$acta' and a.lapso='$lap' and a.c_asigna='$cod' ";
$mSQL.= "UNION ";
$mSQL.= "SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.status, a.afec_indice ";
$mSQL.= "FROM dace004 a,tblaca009 b,tblaca008 c,his_act d ";
$mSQL.= "WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and ";
$mSQL.= "a.c_asigna='300622' and b.c_asigna=c.c_asigna and a.acta='$acta' and a.lapso='$lap' ";
$mSQL.= "ORDER BY 4 ASC";     

//echo $mSQL;

$conex->ExecSQL($mSQL,__LINE__,false);
$fila = $conex->filas;

$result = $conex->result;
$codigo=$result[0][0];
$status=$result[0][4];
$afec_indice=$result[0][5];

//echo "afec: ".$afec_indice;

if($codigo=='300622'):
include('v_acta_sc.php');
elseif($afec_indice == '9'):
include('v_acta_exp.php');
else:
//Se consultan los datos en his_act 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT his_ced, his_lap, his_cod, his_sec, his_fec FROM his_act WHERE his_act='$acta' and his_cod='$codigo' AND his_lap='$lap' ";     
$conex->ExecSQL($mSQL,__LINE__,false);

//print_r($conex->result);

$result = $conex->result;
$ci=$result[0][0];
$lapso=$result[0][1];
$c_asigna=$result[0][2];
$sec=$result[0][3];
$fec=$result[0][4];
$fec=implode('/',array_reverse(explode('-',$fec)));

//Se busca nombre de la asignatura
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT ASIGNATURA FROM TBLACA008 WHERE C_ASIGNA='$c_asigna'";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$asigna=$result[0][0];
?>



<?php
//consultar alumnos en dace004
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT a.exp_e,a.acta,a.c_asigna,a.lapso,a.calificacion,b.apellidos,b.apellidos2,b.nombres,b.nombres2, c.letras FROM dace004 a, dace002 b, letras c WHERE a.acta='$acta' and a.exp_e=b.exp_e and c.nota=a.calificacion and a.c_asigna='$codigo' AND lapso='$lapso' 
UNION
SELECT a.exp_e,a.acta,a.c_asigna,a.lapso,a.calificacion,b.apellidos,b.apellidos2,b.nombres,b.nombres2, c.letras FROM dace004_grad a, dace002_grad b, letras c WHERE a.acta='$acta' and a.exp_e=b.exp_e and c.nota=a.calificacion and a.c_asigna='$codigo' AND lapso='$lapso' ORDER BY 6,7,8,9 ASC";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
//vacio result en exp_e como un array 
for($i=0; $i < count($result); $i++) {
	$exp_e[$i]=$result[$i][0];
	$apellidos[$i]=$result[$i][5];
	$apellidos2[$i]=$result[$i][6];
	$nombres[$i]=$result[$i][7];
	$nombres2[$i]=$result[$i][8];
	$nota[$i]=$result[$i][4];
	$letras[$i]=$result[$i][9];


	//se genera la observacion 
	if($nota[$i] >= 5){
	$obs[$i]='APROBADO';
	$status[$i]='1';}
	else{
	$obs[$i]='APLAZADO';
	$status[$i]='1';}

}

//Busco datos profesor para mostrar
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT ci,nombre,apellido FROM tblaca007 WHERE ci='$ci'";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;

$ci = "";
$nombre = "";
$apellido = "";

if (count($result) > 0){
	$ci=$result[0][0];
	$nombre=$result[0][1];
	$apellido=$result[0][2];
} 


$desde=0;
$hasta=count($exp_e);
include('v_acta_head.php');

include('v_acta_body0.php');

include('v_acta_foot.php');


endif;
endif;
?>



