<?php
//consulto estuadiantes en sc_temp
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT exp_e FROM sc_exp_temp";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;
$exp_e=$result[0][0];

// guardar elementos en dace004
$acta;
$lapso;

// para buscar el c_asigna se debe verificar de que carrera es el alumno
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT c_uni_ca  FROM dace002 WHERE exp_e='$exp_e' ";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$c_uni_ca=$result[0][0];
if($c_uni_ca=='2'):
$c_asigna='322939';
elseif($c_uni_ca=='3'):
$c_asigna='311939';
elseif($c_uni_ca=='4'):
$c_asigna='333939';
elseif($c_uni_ca=='5'):
$c_asigna='355069';
elseif($c_uni_ca=='6'):
$c_asigna='344939';
else:
echo ' ';
endif;

//Busco si tiene aplazada la asignatura
$conex->iniciarTransaccion("Inicia Transaccion ".$_SESSION['ced']." - Expediente Estudiante: ".$exp_e);

$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT * FROM dace004 WHERE exp_e='".$exp_e."' AND c_asigna='".$c_asigna."' AND status='1' ";     
$conex->ExecSQL($mSQL,__LINE__,true);

if (count($conex->result) > 0) {// Si la tiene aplazada
	// Cambiamos a no contabilizar esas aplazadas
	$mSQL  = "UPDATE dace004 SET status_rr='4' WHERE exp_e='".$exp_e."' c_asigna='".$c_asigna."' AND status='1' ";     
	$conex->ExecSQL($mSQL,__LINE__,true);
}

//echo $mSQL."<br>";

//equivalencia por exp profesional
$status = '0';
$calificacion = '0';
$afec_indice = '9';
$status_rr = '4';
$sta_indice = '0';

//ingreso elementos en dace004
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "INSERT INTO dace004 (acta,lapso,c_asigna,exp_e,calificacion,afec_indice,status,status_rr,sta_indice) VALUES ('$acta','$lapso','$c_asigna','$exp_e','$calificacion','$afec_indice','$status','$status_rr','$sta_indice')";     

$conex->ExecSQL($mSQL,__LINE__,true);
$ok=$conex->fmodif;

//ingreso los datos en el his_act
$his_ced=$ced;   //tomar la cedula del profesor que ingreso al sistema 
$his_act=$acta;
$his_lap=$lapso;
$his_sec='M1';
$his_cod=$c_asigna;
$his_fec=date("Y-m-d");
$his_ins=$ins;
$his_ret='0';
$his_apl='0';
$his_apr=$his_ins;

$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "INSERT INTO his_act (his_ced,his_act,his_lap,his_sec,his_cod,his_fec,his_ins,his_ret,his_apl,his_apr) VALUES ('$his_ced','$his_act','$his_lap','$his_sec','$his_cod','$his_fec','$his_ins','$his_ret','$his_apl','$his_apr')";   
$conex->ExecSQL($mSQL,__LINE__,true);
$ok=$conex->fmodif;

//ingreso datos en auditoria
$user_id=$ced;
//$tabla=$exp_e[$i];
$campo1=$c_asigna;
$campo2=$acta;
$campo3='M1';
$campo4=$lapso;
$fecha=date("Y-m-d");
$hora=date('H:i:s');
$que='ACRED. POR EXP.';

//ingreso elementos en auditoria
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "INSERT INTO auditoria (user_id,tabla,campo1,campo2,campo3,campo4,fecha,hora,que) VALUES ('$user_id','$exp_e','$campo1','$campo2','$campo3','$campo4','$fecha','$hora','$que')";     
$conex->ExecSQL($mSQL,__LINE__,true);
$ok=$conex->fmodif;

$conex = new ODBC_Conn("TGPP","C","C",TRUE,$log);
$mSQL = "INSERT INTO sol_historial (ci_e, tipo_pasantia, empresa, n_proyecto, fecha_c, id_estatus, lapso, c_uni_ca, exp_e, programa) ";
$mSQL.= "VALUES ('".substr($exp_e,3)."','1','$e','ACREDITACION POR EXPERIENCIA SEGUN ".$r."',sysdate,'4','$lapso','$c_uni_ca','$exp_e','0')";
$conex->ExecSQL($mSQL,__LINE__,true);
$ok=$conex->fmodif;

//elimino campos sc_temp1
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "DELETE FROM sc_temp1 ";     
$conex->ExecSQL($mSQL,__LINE__,true);
$ok=$conex->fmodif;
//elimino campos sc_temp 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "DELETE FROM sc_exp_temp ";     
$conex->ExecSQL($mSQL,__LINE__,true);
$conex->finalizarTransaccion("Finaliza Transaccion ".$_SESSION['ced']);
$ok=$conex->fmodif;
?>