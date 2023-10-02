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
$conex->ExecSQL($mSQL,__LINE__,false);
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
	$status_rr[$i]='0';

	$seccion[$i]=$result[$i][6];
	$acta2[$i]=$result[$i][7];

	//auditoria
	$tabla[$i]=$exp_e[$i];
	$campo1[$i]=$c_asigna[$i];
	$campo2[$i]=$acta[$i];
	$campo3[$i]=$seccion[$i];
	$campo4[$i]=$lapso[$i];
}



for($i=0; $i < count($acta); $i++) { 
//busco la cantidad de inscritos en tg_temp
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT exp_e FROM sc_tg_temp WHERE acta2='$acta[$i]'";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;
$his_ins[$i]=$fila;


}
//consulto los datos para  his_act

$his_ced=$ced;   //tomar la cedula del profesor que ingreso al sistema 
$his_fec=date("Y-m-d");
$his_ei='0';
$his_otr='0';
$his_ret_r='0';
$his_ret='0';

$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT DISTINCT acta,lapso,seccion,c_asigna FROM sc_tg_temp";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;

//vacio los resultados en un array 
for($i=0; $i < count($result); $i++) {
$his_act[$i]=$result[$i][0];
//echo $his_act[$i];
//echo '<br />';

$his_lap[$i]=$result[$i][1];
//echo $his_lap[$i];
// '<br />';
$his_sec[$i]=$result[$i][2];

$his_cod[$i]=$result[$i][3];

//consulto aprobados en tg_temp
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT observacion FROM sc_tg_temp WHERE status='0' and acta='$his_act[$i]'";     
$conex->ExecSQL($mSQL,__LINE__,false);
$fila = $conex->filas;
$his_apr[$i]=$fila; 
//echo $his_apr[$i];
//echo '<br />';
//consulto aprobados en tg_temp
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT observacion FROM sc_tg_temp WHERE status IN (1,'I') and acta='$his_act[$i]'";     
$conex->ExecSQL($mSQL,__LINE__,false);
$fila = $conex->filas;
$his_apl[$i]=$fila; 
//echo $his_apl[$i];
//echo '<br />';


	//ingreso elementos en his_act
	$conex->iniciarTransaccion("Inicia Transaccion ".$_SESSION['ced']." - Acta: ".$his_act[$i]);
	$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
	$mSQL  = "INSERT INTO his_act (his_ced,his_act,his_lap,his_sec,his_cod,his_fec,his_ins,his_ret,his_apl,his_apr,his_ei,his_otr,his_ret_r) VALUES ('$his_ced','$his_act[$i]','$his_lap[$i]','$his_sec[$i]','$his_cod[$i]','$his_fec','$his_ins[$i]','$his_ret','$his_apl[$i]','$his_apr[$i]','$his_ei','$his_otr','$his_ret_r')";   
	$conex->ExecSQL($mSQL,__LINE__,true);
	$ok=$conex->fmodif;

}



for($i=0; $i < count($exp_e); $i++) { 

	//ingreso elementos en dace004

	$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
	$mSQL  = "INSERT INTO dace004 (acta,lapso,c_asigna,exp_e,calificacion,afec_indice,status,status_rr) VALUES ('$acta[$i]','$lapso[$i]','$c_asigna[$i]','$exp_e[$i]','$calificacion[$i]','$afec_indice[$i]','$status[$i]','$status_rr[$i]')";     
	$conex->ExecSQL($mSQL,__LINE__,true);
	$ok=$conex->fmodif;
}




//capturo elementos para auditoria
$user_id=$ced;


$fecha=date("Y-m-d");
$hora=date('H:i:s');
$que='ACTA INCLUIDA';

for($i=0; $i < count($exp_e); $i++) { 

	//ingreso elementos en auditoria
	$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
	$mSQL  = "INSERT INTO auditoria (user_id,tabla,campo1,campo2,campo3,campo4,fecha,hora,que) VALUES ('$user_id','$tabla[$i]','$campo1[$i]','$campo2[$i]','$campo3[$i]','$campo4[$i]','$fecha','$hora','$que')";     
	$conex->ExecSQL($mSQL,__LINE__,true);
	$ok=$conex->fmodif;

}

for($i=0; $i < count($exp_e); $i++) { 
//actualizo tblaca004 los numeros de inscritos
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "UPDATE tblaca004 SET inscritos=inscritos -1 WHERE acta='$acta2[$i]' and c_asigna='$c_asigna[$i]' and lapso='$lapso[$i]' ";     
$conex->ExecSQL($mSQL,__LINE__,true);
$ok=$conex->fmodif;
}
 //activar cuando termine de hacer las pruebas

for($i=0; $i < count($exp_e); $i++) { 
//verifico si la seccion quedo vacia 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
//$mSQL  = "SELECT inscritos FROM tblaca004 WHERE acta='$acta2[$i]' and c_asigna='$c_asigna[$i]' and lapso='$lapso[$i]'";

$mSQL  = "SELECT COUNT(exp_e) FROM dace006 WHERE acta='$acta2[$i]' and c_asigna='$c_asigna[$i]' and lapso='$lapso[$i]' AND status IN ('7','A') ";     

$conex->ExecSQL($mSQL,__LINE__,false);
$ok=$conex->fmodif;
$result = $conex->result;
$inscritos[$i]=$result[0][0];


if($inscritos[$i] < 0):

//elimino la seccion 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "DELETE FROM tblaca004 WHERE acta='$acta2[$i]' and c_asigna='$c_asigna[$i]' and lapso='$lapso[$i]'";     
$conex->ExecSQL($mSQL,__LINE__,true);
$ok=$conex->fmodif;

else:
echo ' ';
endif;

}


 //activar cuando se terminen de realizar las pruebas para que no se eliminen las inscripciones 

for($i=0; $i < count($exp_e); $i++) { 
//elimino inscritos de dace006 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "DELETE FROM dace006 WHERE exp_e='$exp_e[$i]' and c_asigna='$c_asigna[$i]'";     
$conex->ExecSQL($mSQL,__LINE__,true);
$ok=$conex->fmodif;
}



//elimino campos sc_temp1
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "DELETE FROM sc_temp1";     
$conex->ExecSQL($mSQL,__LINE__,true);
$ok=$conex->fmodif;
//elimino campos tg_temp 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "DELETE FROM sc_tg_temp";     
$conex->ExecSQL($mSQL,__LINE__,true);
$conex->finalizarTransaccion("Finaliza Transaccion ".$_SESSION['ced']);
$ok=$conex->fmodif;



?>