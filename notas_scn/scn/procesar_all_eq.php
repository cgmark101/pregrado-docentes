<?php


//consulto estuadiantes en eq_temp
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT acta,lapso,c_asigna,seccion,exp_e FROM sc_eq_temp";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;
$acta=$result[0][0];
$lapso=$result[0][1];
$c_asigna=$result[0][2];
$seccion=$result[0][3];
$exp_e=$result[0][4];

//echo $opr;
//si es por revalida status=5
if($opr=='1'){//equivalencia
	$status='3';  
	$status_rr='0';
}else if($opr=='2'){ // revalida
	$status='5';
	$status_rr='0';
}

$calificacion='0';
$afec_indice='0';

//ingreso elementos en dace004
$conex->iniciarTransaccion("Inicia Transaccion ".$_SESSION['ced']." - Expediente Estudiante: ".$exp_e);
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "INSERT INTO dace004 (acta,lapso,c_asigna,exp_e,calificacion,afec_indice,status,status_rr) VALUES ('$acta','$lapso','$c_asigna','$exp_e','$calificacion','$afec_indice','$status','$status_rr')";     
$conex->ExecSQL($mSQL,__LINE__,true);
$ok=$conex->fmodif;

//ingreso los datos en el his_act
$his_ced=$ced;  
$his_act=$acta;
$his_lap=$lapso;
$his_sec=$seccion;
$his_cod=$c_asigna;
$his_fec=date("Y-m-d");
$his_ins='1';
$his_ret='0';
$his_apl='0';
$his_apr='1';
//$his_ei='0';
//$his_otr='0';
//$his_ret_r='0';



$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "INSERT INTO his_act (his_ced,his_act,his_lap,his_sec,his_cod,his_fec,his_ins,his_ret,his_apl,his_apr) VALUES('$his_ced','$his_act','$his_lap','$his_sec','$his_cod','$his_fec','$his_ins','$his_ret','$his_apl','$his_apr')";   
$conex->ExecSQL($mSQL,__LINE__,true);
$ok=$conex->fmodif;


//ingreso datos en auditoria
$user_id=$ci;
//$tabla=$exp_e[$i];
$campo1=$c_asigna;
$campo2=$acta;
$campo3=$seccion;
$campo4=$lapso;
$fecha=date("Y-m-d");
$hora=date('H:i:s');
$que='ACTA INCLUIDA';



//ingreso elementos en auditoria
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "INSERT INTO auditoria (user_id,tabla,campo1,campo2,campo3,campo4,fecha,hora,que) VALUES ('$user_id','$exp_e','$campo1','$campo2','$campo3','$campo4','$fecha','$hora','$que')";     
$conex->ExecSQL($mSQL,__LINE__,true);
$ok=$conex->fmodif;








//elimino campos sc_temp1
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "DELETE FROM sc_temp1";     
$conex->ExecSQL($mSQL,__LINE__,true);
$ok=$conex->fmodif;
//elimino campos sc_temp 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "DELETE FROM sc_exp_temp";     
$conex->ExecSQL($mSQL,__LINE__,true);
$conex->finalizarTransaccion("Finaliza Transaccion ".$_SESSION['ced']);
$ok=$conex->fmodif;

?>