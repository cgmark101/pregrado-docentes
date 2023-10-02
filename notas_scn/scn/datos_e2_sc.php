<?php  header( 'Content-type: text/html; charset=iso-8859-1' );

include('encabezado.php');
error_reporting(E_ALL);
include_once('inc/config.php');
require_once('inc/odbcss_c.php');

if(empty($actap)):
$ci_e=$_POST['ci_e'];
$mens1='No se encontró ningún alumno con ese número de cédula';
else:
$mens1=' ';
$ci_e='1';
endif;

//extraigo los datos de los estudiantes de dace002
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT exp_e, apellidos, apellidos2, nombres, nombres2, ci_e FROM dace002 WHERE ci_e='$ci_e' and estatus_e='1' ";     

$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;



if($fila==0):
	include('ing_ced_sc.php');
	echo '<table width="720" border="0" align="center" style="border-collapse: collapse;border-color:black;">
	  <tr>
		<td class="titulo_tabla"><div align="left">Sugerencias:</div></td>
	  </tr>
	  <tr>
		<td class="datospd"><div align="left"> <span class="alert2">'; echo $mens1; echo '
		</span>  </td>
	</div></td>
	  </tr>
	</table>';
	include_once('muestra_sc.php');

else:
	$exp_e=$result[0][0];
	$apellidos=$result[0][1];
	$apellidos2=$result[0][2];
	$nombres=$result[0][3];
	$nombres2=$result[0][4];
	$ci_e=$result[0][5];

	//verifico si cedula esta repetida 
	$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
	$mSQL  = "SELECT exp_e FROM dace004 WHERE exp_e='$exp_e' and c_asigna='300622' AND status IN ('0') ";      
	$conex->ExecSQL($mSQL,__LINE__,false);
	$result = $conex->result;
	$fila = $conex->filas;

if($fila==1):
	include('ing_ced_sc.php');
	echo '<table width="720" border="0" align="center" style="border-collapse: collapse;border-color:black;">
	  <tr>
		<td class="titulo_tabla"><div align="left">Sugerencias:</div></td>
	  </tr>
	  <tr>
		<td class="datospd"><div align="left"> <span class="alert2">El alumno ya se encuentra con el estatus APROBADO dentro del sistema
		</span>  </td>
	</div></td>
	  </tr>
	</table>';
	echo "<script languaje='javascript'>
	alert('ALERTA: el alumno ya se encuentra con el estatus de APROBADO dentro del sistema');
	</script>";
	include_once('muestra_sc.php');
else:

//verifico si cedula esta en sc_temp
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT ci_e FROM sc_temp WHERE ci_e='$ci_e' AND c_asigna='300622' ";      
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;
if($fila==1):
include('ing_ced_sc.php');
echo '<table width="720" border="0" align="center" style="border-collapse: collapse;border-color:black;">
  <tr>
    <td class="titulo_tabla"><div align="left">Sugerencias:</div></td>
  </tr>
  <tr>
    <td class="datospd"><div align="left"> <span class="alert2">El alumno ya se encuentra en el ACTA DE EVALUACION FINAL
	</span>  </td>
</div></td>
  </tr>
</table>';
include_once('muestra_sc.php');

else:
//Busco acta y lapso en sc_temp1 para mostrarla 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT acta,lapso FROM sc_temp1";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$acta=$result[0][0];
$c_asigna='300622';
$fecha=date("Y-m-d"); 
$seccion='M1';
$lapso=$result[0][1];

//ingreso los datos del estudiante en sc_temp
$conex->iniciarTransaccion("Inicia Transaccion ".$_SESSION['ced']." - Ced Estudiante: ".$ci_e);
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "INSERT INTO sc_temp (EXP_E, APELLIDOS, APELLIDOS2, NOMBRES, NOMBRES2, observacion, CI_E, ACTA, C_ASIGNA, SECCION, LAPSO, FECHA) VALUES ('$exp_e', '$apellidos', '$apellidos2', '$nombres', '$nombres2', 'Aprobado', '$ci_e','$acta','$c_asigna','$seccion','$lapso','$fecha')";      
$conex->ExecSQL($mSQL,__LINE__,true);
$conex->finalizarTransaccion("Finaliza Transaccion ".$_SESSION['ced']);
$ok=$conex->fmodif;

//echo $mSQL;

include('ing_ced_sc.php');


include_once('muestra_sc.php');

 endif; 
 endif; 
 endif;

 //verifico si tiene insolvecias
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT observacion FROM dace003 WHERE exp_e='$exp_e' AND c_unid_f<>'20' ";      
$conex->ExecSQL($mSQL,__LINE__,false);

if($conex->filas > 0){
	for($i=0;$i<$conex->filas;$i++){
		$obs = "<br>- ".$conex->result[$i][0];
	}

	$msg = "El expediente ".$exp_e." presenta ".$conex->filas." insolvencia";

	$msg.= ($conex->filas > 1) ? "s:" : ":";

	$msg.= "<br>".$obs;

	echo '<table width="720" border="0" align="center" style="border-collapse: collapse;border-color:black;">
		<tr>
			<td class="titulo_tabla"><div align="left">Atencion:</div></td>
		</tr>
		<tr>
			<td class="datospd"><div align="left"> <span class="alert2">'.$msg.'</span></div></td>
		</tr>
	</table>';
	echo "<script languaje='javascript'>
		alert('".str_replace('<br>','\n',$msg)."');
	</script>";	
}
 
include('pie.php');
?>
