<?php  header( 'Content-type: text/html; charset=iso-8859-1' );

include('encabezado.php');
error_reporting(E_ALL);
include_once('inc/config.php');
require_once('inc/odbcss_c.php');


if(empty($actap)):
$mens1='No se encontró ningún alumno con ese número de cédula, o el estudiante esta inactivo.';
$ci_e=$_POST['ci_e'];
else:
$mens1=' ';
$ci_e='.';
endif;
//extraigo los datos de los estudiantes de dace002
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT a.exp_e, a.apellidos, a.apellidos2, a.nombres, a.nombres2, a.ci_e, a.c_uni_ca, a.estatus_e, b.carrera FROM dace002 a, tblaca010 b WHERE ci_e='$ci_e' and a.c_uni_ca=b.c_uni_ca and a.estatus_e='1' ";  

$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
$fila = $conex->filas;
if($fila==0):
include('ing_ced_pp.php');
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
include_once('muestra_pp.php');
            
else:
$exp_e=$result[0][0];
$apellidos=$result[0][1];
$apellidos2=$result[0][2];
$nombres=$result[0][3];
$nombres2=$result[0][4];
$ci_e=$result[0][5];
$estatus_e=$result[0][7];
$carrera=$result[0][8];
$c_uni_ca=$result[0][6];

//verifico si el alumno esta inscrito por dace006 para todas las materias de PP y PPG 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "
SELECT DISTINCT a.acta,a.lapso,a.seccion,a.c_asigna, c.asignatura FROM dace006 a, tblaca004 b, tblaca008 c, tblaca009 d WHERE a.exp_e='$exp_e' and a.acta=b.acta and a.c_asigna=b.c_asigna and b.c_asigna=c.c_asigna and d.c_asigna=c.c_asigna and a.c_asigna='322939' AND status IN (7,'A')
UNION
SELECT DISTINCT a.acta,a.lapso,a.seccion,a.c_asigna, c.asignatura FROM dace006 a, tblaca004 b, tblaca008 c, tblaca009 d WHERE a.exp_e='$exp_e' and a.acta=b.acta and a.c_asigna=b.c_asigna and b.c_asigna=c.c_asigna and d.c_asigna=c.c_asigna and a.c_asigna='311939' AND status IN (7,'A')
UNION
SELECT DISTINCT a.acta,a.lapso,a.seccion,a.c_asigna, c.asignatura FROM dace006 a, tblaca004 b, tblaca008 c, tblaca009 d WHERE a.exp_e='$exp_e' and a.acta=b.acta and a.c_asigna=b.c_asigna and b.c_asigna=c.c_asigna and d.c_asigna=c.c_asigna and a.c_asigna='333939' AND status IN (7,'A')
UNION
SELECT DISTINCT a.acta,a.lapso,a.seccion,a.c_asigna, c.asignatura FROM dace006 a, tblaca004 b, tblaca008 c, tblaca009 d WHERE a.exp_e='$exp_e' and a.acta=b.acta and a.c_asigna=b.c_asigna and b.c_asigna=c.c_asigna and d.c_asigna=c.c_asigna and a.c_asigna='355069' AND status IN (7,'A')
UNION
SELECT DISTINCT a.acta,a.lapso,a.seccion,a.c_asigna, c.asignatura FROM dace006 a, tblaca004 b, tblaca008 c, tblaca009 d WHERE a.exp_e='$exp_e' and a.acta=b.acta and a.c_asigna=b.c_asigna and b.c_asigna=c.c_asigna and d.c_asigna=c.c_asigna and a.c_asigna='344939' AND status IN (7,'A')
";     
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
$fila = $conex->filas;

//echo $mSQL;

if($fila==0):
include('ing_ced_pp.php');
echo '<table width="720" border="0" align="center" style="border-collapse: collapse;border-color:black;">
  <tr>
    <td class="titulo_tabla"><div align="left">Sugerencias:</div></td>
  </tr>
  <tr>
    <td class="datospd"><div align="left"> <span class="alert2">El alumno no tiene la asignatura inscrita en el sistema.
	</span>  </td>
</div></td>
  </tr>
</table>';
echo "<script languaje='javascript'>
alert('ALERTA: El alumno no tiene la asignatura inscrita en el sistema.');
</script>";
include_once('muestra_pp.php');

else:
$acta=$result[0][0];
$lapso=$result[0][1];
$seccion=$result[0][2];
$c_asigna=$result[0][3];
$asignatura=$result[0][4];

//verifico si al alumno ya le cargaron la nota 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT exp_e FROM dace004 WHERE exp_e='$exp_e' and c_asigna='$c_asigna' AND status='0'";     

//echo $mSQL;

$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
$fila = $conex->filas;
if($fila==1):

include('ing_ced_pp.php');
echo '<table width="720" border="0" align="center" style="border-collapse: collapse;border-color:black;">
  <tr>
    <td class="titulo_tabla"><div align="left">Sugerencias:</div></td>
  </tr>
  <tr>
    <td class="datospd"><div align="left"> <span class="alert2">El alumno ya tiene la nota cargada en el sistema
	</span>  </td>
</div></td>
  </tr>
</table>';
echo "<script languaje='javascript'>
alert('ALERTA: El alumno ya tiene la nota cargada en el sistema');
</script>";
include_once('muestra_pp.php');
else:

//verifico si cedula esta en pp_temp
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT ci_e FROM sc_pp_temp WHERE ci_e='$ci_e'"; 

//echo $mSQL;

$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
$fila = $conex->filas;
if($fila==1):
include('ing_ced_pp.php');
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
include_once('muestra_pp.php');

else:

//ingreso los datos del estudiante en pp_temp
$conex->iniciarTransaccion("Inicia Transaccion ".$_SESSION['ced']." - Ced Estudiante: ".$ci_e);
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "INSERT INTO sc_pp_temp (EXP_E, APELLIDOS, APELLIDOS2, NOMBRES, NOMBRES2, CI_E, ACTA, ACTA2, LAPSO, C_ASIGNA, SECCION,ESTATUS_E,CARRERA,C_UNI_CA,ASIGNATURA) VALUES ('$exp_e', '".str_replace("'"," ",$apellidos)."', '".str_replace("'"," ",$apellidos2)."', '$nombres', '$nombres2', '$ci_e', '$acta', '$acta', '$lapso', '$c_asigna', '$seccion','$estatus_e','$carrera','$c_uni_ca','$asignatura')";      

//echo $mSQL;

$conex->ExecSQL($mSQL,__LINE__,true);
$conex->finalizarTransaccion("Finaliza Transaccion ".$_SESSION['ced']);
$ok=$conex->fmodif;
 
include('ing_ced_pp.php');


include_once('muestra_pp.php');

 endif; 
 endif; 
 endif;
 endif;

 //verifico si tiene insolvecias
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
@$mSQL  = "SELECT observacion FROM dace003 WHERE exp_e='$exp_e' AND c_unid_f<>'20' ";      
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
