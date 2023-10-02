<?php
include_once('user2.php');

if($user=='0'):
$dSQL="SELECT acta, lapso, c_asigna, exp_e, calificacion, status, seccion, acta2, observacion FROM sc_tg_temp";
else:
$dSQL="SELECT acta, lapso, c_asigna, exp_e, calificacion, status, seccion, acta2, observacion FROM sc_tg_temp WHERE c_asigna='$c_asignad'";
endif;
//consulto estudiantes en tg_temp
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = $dSQL;     
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
$fila = $conex->filas;


// capturo elementos para dace004

for($i=0; $i < count($result); $i++) { 
//dace004
$acta[$i]=$result[$i][0];
$lapso[$i]=$result[$i][1];
$c_asigna[$i]=$result[$i][2];
$exp_e[$i]=$result[$i][3];
$calificacion[$i]=$result[$i][4];
$afec_indice[$i]='1';
$status[$i]=$result[$i][5];
$status_rr[$i]='4';

$seccion[$i]=$result[$i][6];
$acta2[$i]=$result[$i][7];

//auditoria
$tabla[$i]=$exp_e[$i];
$campo1[$i]=$c_asigna[$i];
$campo2[$i]=$acta[$i];
$campo3[$i]=$seccion[$i];
$campo4[$i]=$lapso[$i];
}

for($i=0; $i < count($exp_e); $i++) { 
//verifico si la seccion quedo vacia 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT inscritos FROM tblaca004 WHERE acta='$acta2[$i]' and c_asigna='c_asigna[$i]' and lapso='$lapso[$i]'";     
$conex->ExecSQL($mSQL,__LINE__,true);
$ok=$conex->fmodif;
$result = $conex->result;
$inscritos[$i]=$result[$i][0];
if($inscritos[$i] < 0):
echo 'eliminar sección';
else:
	echo ' ';
endif;

}