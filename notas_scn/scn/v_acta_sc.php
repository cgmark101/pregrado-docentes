<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</HEAD>
<?php

//Se consultan los datos en his_act 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT his_ced, his_lap, his_cod, his_sec, his_fec FROM his_act WHERE his_act='$acta' and his_cod='300622'";     
$conex->ExecSQL($mSQL,__LINE__,true);
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



//consultar alumnos en dace004
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT a.exp_e,a.acta,a.c_asigna,a.lapso,b.apellidos,b.apellidos2,b.nombres,b.nombres2 FROM dace004 a, dace002 b WHERE a.acta='$acta' and a.exp_e=b.exp_e and a.c_asigna='300622' ORDER BY 5,6,7,8 ASC";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
//vacio result en exp_e como un array 
for($i=0; $i < count($result); $i++) {
$exp_e[$i]=$result[$i][0];
$apellidos[$i]=$result[$i][4];
$apellidos2[$i]=$result[$i][5];
$nombres[$i]=$result[$i][6];
$nombres2[$i]=$result[$i][7];
$obs[$i]='APROBADO';
}


//Busco datos profesor para mostrar
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT ci,nombre,apellido FROM tblaca007 WHERE ci='$ci'";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$ci=$result[0][0];
$nombre=$result[0][1];
$apellido=$result[0][2];

//$ins=count($exp_e);
//if($ins < 46):
include('v_acta_head.php');
//defino cuantos mostrar 
$desde=0;
$hasta=count($exp_e);
include('v_acta_body.php');
//footer 
//$ciclo=40-$ins;
//for($i=0; $i < $ciclo; $i++){
//echo ' ';
//echo '<br>';
//}
include('v_acta_foot.php');
/*
else:     // para actas mayores a 40 

include('v_acta_head.php');

$desde=0;
$hasta=count($exp_e);
$hasta=$hasta-20;
include('v_acta_body.php');
$ciclo=50-$hasta;   // espaciado del head
for($i=0; $i < $ciclo; $i++){
echo ' ';
echo '<br>';
}
include('v_acta_head.php');
$desde=$hasta;
$hasta=count($exp_e);
include('v_acta_body.php');

//footer 
$ciclo=$desde;
for($i=0; $i < $ciclo; $i++){
echo ' ';
echo '<br>';
}
include('v_acta_foot.php');
endif;*/
?>
