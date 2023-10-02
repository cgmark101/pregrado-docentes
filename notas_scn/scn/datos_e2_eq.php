<?php // header( 'Content-type: text/html; charset=iso-8859-1' );

include('encabezado.php');
error_reporting(E_ALL);
include_once('inc/config.php');
require_once('inc/odbcss_c.php');

$ci_e=$_POST['ci_e'];
$c_asigna=$_POST['c_asigna'];
$opr=$_POST['opr'];

if(empty($actap)):
$mens1='No se encontró ningún alumno con ese número de cédula';
else:
$mens1=' ';
endif;

//extraigo los datos de los estudiantes de dace002
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT exp_e, apellidos, apellidos2, nombres, nombres2, ci_e, c_uni_ca FROM dace002 WHERE ci_e='$ci_e' and estatus_e='1'";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;

if($fila==0):
include('ing_ced_eq.php');
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
include_once('muestra_eq.php');

else:
$exp_e=$result[0][0];
$apellidos=$result[0][1];
$apellidos2=$result[0][2];
$nombres=$result[0][3];
$nombres2=$result[0][4];
$ci_e=$result[0][5];
$c_uni_ca=$result[0][6];

//verifico si alumno esta aprobado 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT exp_e FROM dace004 WHERE exp_e='$exp_e' and c_asigna='$c_asigna' and status in (0,3,5,'C','B')";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;
if($fila > 0):

include('ing_ced_eq.php');
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
include_once('muestra_eq.php');
else:

//verifico si cedula esta en exp_temp
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT ci_e FROM sc_eq_temp WHERE ci_e='$ci_e'";      
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;
if($fila==1):
include('ing_ced_eq.php');
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
include_once('muestra_eq.php');

else:
//Busco acta y lapso en sc_temp1 para mostrarla 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT acta,lapso FROM sc_temp1 ORDER BY acta DESC";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$acta=$result[0][0];
$lapso=$result[0][1];

// se verifica que el c_asigna ingresado sea de la especialidad del alumno
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT a.c_uni_ca, b.c_asigna, c.asignatura, d.carrera FROM dace002 a, tblaca009 b, tblaca008 c, tblaca010 d WHERE b.c_asigna='$c_asigna' AND b.c_asigna=c.c_asigna AND a.c_uni_ca='$c_uni_ca' 
AND b.c_uni_ca=a.c_uni_ca AND a.c_uni_ca=d.c_uni_ca and a.pensum=b.pensum and a.ci_e='$ci_e' and a.c_uni_ca=b.c_uni_ca";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;
if($fila==0):
include('ing_ced_eq.php');
echo '<table width="720" border="0" align="center" style="border-collapse: collapse;border-color:black;">
  <tr>
    <td class="titulo_tabla"><div align="left">Sugerencias:</div></td>
  </tr>
  <tr>
    <td class="datospd"><div align="left"> <span class="alert2">No se encontró ninguna asignatura con ese código, o posiblemente no pertenece al pensum del alumno
	</span>  </td>
</div></td>
  </tr>
</table>';
include_once('muestra_eq.php');

else:
$c_asigna=$result[0][1];
$asignatura=$result[0][2];
$carrera=$result[0][3];


$fecha=date("Y-m-d"); 
$seccion='M1';

//ingreso los datos del estudiante en sc_temp
$conex->iniciarTransaccion("Inicia Transaccion ".$_SESSION['ced']." - Ced Estudiante: ".$ci_e);
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "INSERT INTO sc_eq_temp (EXP_E, APELLIDOS, APELLIDOS2, NOMBRES, NOMBRES2, observacion, CI_E, ACTA, C_ASIGNA, SECCION, LAPSO, FECHA, ASIGNATURA, CARRERA) VALUES ('$exp_e', '$apellidos', '$apellidos2', '$nombres', '$nombres2', 'Aprobado', '$ci_e','$acta','$c_asigna','$seccion','$lapso','$fecha','$asignatura','$carrera')";      
$conex->ExecSQL($mSQL,__LINE__,true);
$conex->finalizarTransaccion("Finaliza Transaccion ".$_SESSION['ced']);
$ok=$conex->fmodif;
 

include('ing_ced_eq.php');


include_once('muestra_eq.php');

 endif; 
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
