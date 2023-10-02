<?php


//consulto estudiantes en sc_temp
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT exp_e FROM sc_temp";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;


// guardar elementos en dace004

$c_asigna='300622';
//$exp_e=$result[0][0];
$calificacion='0';
$afec_indice='0';
$status='0';
$status_rr='4';


for($i=0; $i < count($result); $i++) { 
	$exp_e[$i]=$result[$i][0];
}

$conex->iniciarTransaccion("Inicia Transaccion ".$_SESSION['ced']);
for($i=0; $i < count($exp_e); $i++) { 

	//ingreso elementos en dace004
	$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
	$mSQL = "INSERT INTO ";
	$mSQL.= " dace004 (acta,lapso,c_asigna,exp_e,calificacion,afec_indice,status,status_rr) VALUES ";
	$mSQL.= "('$acta','$lapso','$c_asigna','$exp_e[$i]','$calificacion','$afec_indice','$status',";
	$mSQL.= "'$status_rr') ";	     
	$conex->ExecSQL($mSQL,__LINE__,true);
	$ok=$conex->fmodif;

}

//ingreso los datos en el his_act
$his_ced=$ced;   //tomar la cedula del profesor que ingreso al sistema 
$his_act=$acta;
$his_lap=$lapso;
$his_sec='M1';
$his_cod='300622';
$his_fec=date("Y-m-d");
$his_ins=$ins;
$his_ret='0';
$his_apl='0';
$his_apr=$his_ins;
//$his_ei='0';
//$his_otr='0';
//$his_ret_r='0';



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
$fecha=date("Y-m-d");   // PENDIENTE 
$hora=date('H:i:s');
$que='ACTA SC INCLUIDA';

for($i=0; $i < count($exp_e); $i++) { 

//ingreso elementos en auditoria
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "INSERT INTO auditoria (user_id,tabla,campo1,campo2,campo3,campo4,fecha,hora,que) VALUES ('$user_id','$exp_e[$i]','$campo1','$campo2','$campo3','$campo4','$fecha','$hora','$que')";     
$conex->ExecSQL($mSQL,__LINE__,true);
$ok=$conex->fmodif;

}
//endif;






//elimino campos sc_temp1
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "DELETE FROM sc_temp1 WHERE ci='".$ced."' AND c_asigna='300622' ";     
$conex->ExecSQL($mSQL,__LINE__,true);
$ok=$conex->fmodif;
//elimino campos sc_temp 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "DELETE FROM sc_temp ";     
$conex->ExecSQL($mSQL,__LINE__,true);
$conex->finalizarTransaccion("Finaliza Transaccion ".$_SESSION['ced']);
$ok=$conex->fmodif;
?>