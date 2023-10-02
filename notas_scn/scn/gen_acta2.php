<?php //Generador de Nros de Actas
error_reporting(E_ALL);
include_once('inc/config.php');
require_once('inc/odbcss_c.php');

require('funciones.php');


 //clasificacion de los estudiantes por lapso academico en donde inscribieron la asignatura
 //en esta rutina se debe de establacer un numero de acta para cada grupo de alumnos que poseen la asignatura 
 //inscrita en un mismo lapso

//1ro. consulto la cantidad de lapsos que hay en la lista donde se cargan las notas
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT DISTINCT lapso,c_uni_ca FROM sc_tg_temp";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;

//vacio los resultados en un array 
for($i=0; $i < count($result); $i++) {
	$lap[$i]=$result[$i][0];
}
//2do. genero un acta para cada sección encontrada 


//aqui empieza gen_acta2.php



//consulto Nro de acta en tg_temp, si el nro de inscritos en tblaca004 es igual al nro de alumnos a procesar 
//se deja el mismo numero de acta y se elimina la inscripción 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT DISTINCT acta2,c_uni_ca,lapso,c_asigna FROM sc_tg_temp ORDER BY acta DESC";     
$conex->ExecSQL($mSQL,__LINE__,false);
$resulta = $conex->result;
$fila = $conex->filas;
//vacio los resultados en un array 

for($i=0; $i < count($result); $i++) {
	$acta[$i]=$result[$i][0];

	//echo $acta[$i];
	//echo '<br />';
	//echo $inscritos[$i];
	//echo '<br />';
}

//echo $fila."<br><br>";

for($i=0; $i < count($resulta); $i++) { 

	$bCarrera = $resulta[$i][1];
	$bLapso = $resulta[$i][2];
	$bAsigna = $resulta[$i][3];

	/*echo $i;
	echo '<br>';*/

	//consulta Nro de acta mayor en his_act
	$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
	$mSQL  = "SELECT MAX(@VALUE(his_act)) FROM his_act WHERE his_lap='$bLapso'";     
	$conex->ExecSQL($mSQL,__LINE__,false);
	$result = $conex->result;
	$fila = $conex->filas;
	$acta_m1=$result[0][0];
	
	//incializo sc_temp1
	/*$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
	$mSQL  = "INSERT INTO sc_temp1 (acta,ci) VALUES ('$acta_m1','1')";     
	$conex->ExecSQL($mSQL,__LINE__,true);*/
	
	//consulto Nro de acta mayor en dace006
	$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
	$mSQL  = "SELECT MAX(@VALUE(ACTA)) FROM TBLACA004 WHERE LAPSO='$bLapso'";     
	$conex->ExecSQL($mSQL,__LINE__,true);
	$result = $conex->result;
	$fila = $conex->filas;
	$acta_m2=$result[0][0];
	
	//consulto Nro de acta mayor en sc_temp1
	$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
	$mSQL  = "SELECT MAX(acta) FROM sc_temp1";
	$conex->ExecSQL($mSQL,__LINE__,false);
	$result = $conex->result;
	$fila = $conex->filas;
	
	/*if($fila==0):
	$acta_m3=' ';
	else:
	$acta_m3=$result[0][0];
	endif;*/

	$acta_m3 = ($fila==0) ? ' ' : $result[0][0]; //GENERA ACTA DISTINTA POR ESPECIALIDAD

	//$acta_m3 = " ";

	$nacta[$i] = generar_acta($acta_m1,$acta_m2,$acta_m3);
	
	//ingreso el numero de acta generado en sc_temp1
	$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
	$mSQL = "INSERT INTO sc_temp1 (acta,ci,lapso,c_asigna) ";
	$mSQL.= "VALUES ('$nacta[$i]','".$_SESSION['ced']."','".$bLapso."','".$bAsigna."')";
	$conex->ExecSQL($mSQL,__LINE__,true);
	$ok=$conex->fmodif;

	$mSQL  = "UPDATE sc_tg_temp SET acta='".$nacta[$i]."' WHERE lapso='".$bLapso."' AND c_uni_ca='".$bCarrera."' ";
	$conex->ExecSQL($mSQL,__LINE__,true);
}

//3ro. actualizo estudiantes de cada lapso con numero de acta nuevo 

/*for($i=0; $i < count($lap); $i++) { 

	$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
	$mSQL  = "SELECT DISTINCT lapso,c_uni_ca FROM sc_tg_temp ORDER BY lapso ASC";     
	$conex->ExecSQL($mSQL,__LINE__,false);
	$result = $conex->result;

	$lapso[$i]=$result[$i][0];
	$c_uni_ca[$i]=$result[$i][1];
	//echo $lapso[$i];
	//echo '<br>';
	//echo $c_uni_ca[$i];
	//echo '<br>';

	$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
	$mSQL  = "UPDATE sc_tg_temp SET acta='$nacta[$i]' WHERE lapso='$lapso[$i]' and c_uni_ca='$c_uni_ca[$i]'";     
	$conex->ExecSQL($mSQL,__LINE__,true);
	$ok=$conex->fmodif;
}*/

 

 
//aqui termina gen_acta2.php

//comparo los inscritos para dejarles la misma acta en casao de que la seccion quedo vacia 
//consulto Nro de acta en tg_temp, si el nro de inscritos en tblaca004 es igual al nro de alumnos a procesar 
//se deja el mismo numero de acta y se elimina la inscripción 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT a.acta,a.inscritos FROM tblaca004 a, sc_tg_temp b WHERE a.acta=b.acta2 ORDER BY 1 ASC";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;
//vacio los resultados en un array 
for($i=0; $i < count($result); $i++) {
	$acta[$i]=$result[$i][0];
	$inscritos[$i]=$result[$i][1];
	//echo $acta[$i];
	//echo '<br />';
	//echo $inscritos[$i];
	//echo '<br />';
}

for($i=0; $i < count($acta); $i++) { 
	//busco la cantidad de inscritos en tg_temp
	$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
	$mSQL  = "SELECT exp_e FROM sc_tg_temp WHERE acta2='$acta[$i]'";     
	$conex->ExecSQL($mSQL,__LINE__,false);
	$result = $conex->result;
	$fila = $conex->filas;
	$ins_temp[$i]=$fila;
	//echo $ins_temp[$i];
	//echo '<br />';

	if($inscritos[$i]==$ins_temp[$i]):
	$nacta[$i] = $acta[$i];
	//elimino la seccion en tblaca004 si esta esta vacia 
	$conex->iniciarTransaccion("Inicia Transaccion ".$_SESSION['ced']." - Acta: ".$acta[$i]);
	$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
	$mSQL  = "DELETE FROM tblaca004 WHERE acta='$acta[$i]' AND lapso='".$bLapso."' AND c_uni_ca='".$bCarrera."' ";
	$conex->ExecSQL($mSQL,__LINE__,true);



	//ingreso el numero de acta generado en tg_temp1
	$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
	$mSQL  = "UPDATE sc_tg_temp SET acta='$nacta[$i]' WHERE acta2='$nacta[$i]'";      
	$conex->ExecSQL($mSQL,__LINE__,true);
	$conex->finalizarTransaccion("Finaliza Transaccion ".$_SESSION['ced']);
	$ok=$conex->fmodif;

	else:
	echo'';
	endif;
}
/*
//ingreso el Nro nuevo de acta en sc_temp1
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "INSERT INTO sc_temp1 (acta) VALUES ('$nacta')";     
$conex->ExecSQL($mSQL,__LINE__,true);
*/
?>

