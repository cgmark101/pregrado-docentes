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
$ci_e='.';
endif;

//extraigo los datos de los estudiantes de dace002
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT a.exp_e, a.apellidos, a.apellidos2, a.nombres, a.nombres2, a.ci_e, a.c_uni_ca, a.estatus_e, b.carrera FROM dace002 a, tblaca010 b WHERE ci_e='$ci_e' and a.c_uni_ca=b.c_uni_ca and a.estatus_e='1'";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;
if($fila==0):
include('ing_ced.php');
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
include_once('muestra.php');
            
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

//verifico si el alumno esta inscrito por dace006

if($user=='0'):
$dSQL="SELECT DISTINCT a.acta, a.lapso, a.seccion, a.c_asigna, e.asignatura
FROM dace006 a, dace002 b, tblaca004 c, tblaca009 d, tblaca008 e
WHERE b.c_uni_ca = c.c_uni_ca
AND a.c_asigna = c.c_asigna
AND c.c_asigna = d.c_asigna
AND d.c_asigna = e.c_asigna
AND e.c_asigna = a.c_asigna
AND a.exp_e=b.exp_e
AND a.exp_e='$exp_e'
AND obligatoria = '1'
AND a.c_asigna='322040'
AND a.status IN (7,'A') 

UNION
SELECT DISTINCT a.acta, a.lapso, a.seccion, a.c_asigna, e.asignatura
FROM dace006 a, dace002 b, tblaca004 c, tblaca009 d, tblaca008 e
WHERE b.c_uni_ca = c.c_uni_ca
AND a.c_asigna = c.c_asigna
AND c.c_asigna = d.c_asigna
AND d.c_asigna = e.c_asigna
AND e.c_asigna = a.c_asigna
AND a.exp_e=b.exp_e
AND a.exp_e='$exp_e'
AND obligatoria = '1'
AND a.c_asigna='311040'
AND a.status IN (7,'A') 

UNION
SELECT DISTINCT a.acta, a.lapso, a.seccion, a.c_asigna, e.asignatura
FROM dace006 a, dace002 b, tblaca004 c, tblaca009 d, tblaca008 e
WHERE b.c_uni_ca = c.c_uni_ca
AND a.c_asigna = c.c_asigna
AND c.c_asigna = d.c_asigna
AND d.c_asigna = e.c_asigna
AND e.c_asigna = a.c_asigna
AND a.exp_e=b.exp_e
AND a.exp_e='$exp_e'
AND obligatoria = '1'
AND a.c_asigna='333040'
AND a.status IN (7,'A') 

UNION
SELECT DISTINCT a.acta, a.lapso, a.seccion, a.c_asigna, e.asignatura
FROM dace006 a, dace002 b, tblaca004 c, tblaca009 d, tblaca008 e
WHERE b.c_uni_ca = c.c_uni_ca
AND a.c_asigna = c.c_asigna
AND c.c_asigna = d.c_asigna
AND d.c_asigna = e.c_asigna
AND e.c_asigna = a.c_asigna
AND a.exp_e=b.exp_e
AND a.exp_e='$exp_e'
AND obligatoria = '1'
AND a.c_asigna='355959'
AND a.status IN (7,'A') 

UNION
SELECT DISTINCT a.acta, a.lapso, a.seccion, a.c_asigna, e.asignatura
FROM dace006 a, dace002 b, tblaca004 c, tblaca009 d, tblaca008 e
WHERE b.c_uni_ca = c.c_uni_ca
AND a.c_asigna = c.c_asigna
AND c.c_asigna = d.c_asigna
AND d.c_asigna = e.c_asigna
AND e.c_asigna = a.c_asigna
AND a.exp_e=b.exp_e
AND a.exp_e='$exp_e'
AND obligatoria = '1'
AND a.c_asigna='344040'
AND a.status IN (7,'A')
 ";//AND a.lapso <> '$lapsoProceso'

else:
$dSQL="SELECT DISTINCT a.acta, a.lapso, a.seccion, a.c_asigna, e.asignatura
FROM dace006 a, dace002 b, tblaca004 c, tblaca009 d, tblaca008 e
WHERE b.c_uni_ca = c.c_uni_ca
AND a.c_asigna = c.c_asigna
AND c.c_asigna = d.c_asigna
AND d.c_asigna = e.c_asigna
AND e.c_asigna = a.c_asigna
AND a.exp_e=b.exp_e
AND a.exp_e='$exp_e'
AND a.c_asigna='$c_asignad'
AND obligatoria = '1'
AND a.status IN (7,'A')
 ";//AND a.lapso <> '$lapsoProceso'

endif;


$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
//$mSQL  = $dSQL;     
$conex->ExecSQL($dSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;

//echo "<BR>".$dSQL;

if($fila==0):
include('ing_ced.php');
echo '<table width="720" border="0" align="center" style="border-collapse: collapse;border-color:black;">
  <tr>
    <td class="titulo_tabla"><div align="left">Sugerencias:</div></td>
  </tr>
  <tr>
    <td class="datospd"><div align="left"> <span class="alert2">El alumno no tiene la asignatura inscrita en el sistema
	</span>  </td>
</div></td>
  </tr>
</table>';
echo "<script languaje='javascript'>
alert('ALERTA: El alumno no tiene la asignatura inscrita en el sistema.');
</script>";
include_once('muestra.php');

else:
$acta=$result[0][0];
$lapso=$result[0][1];
$seccion=$result[0][2];
$c_asigna=$result[0][3];
$asignatura=$result[0][4];

//verifico si al alumno ya le cargaron la nota 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT exp_e FROM dace004 WHERE exp_e='$exp_e' and c_asigna='$c_asigna' AND status IN ('0''3','5','C') ";      
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;
if($fila==1):

include('ing_ced.php');
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
include_once('muestra.php');
else:

//verifico si cedula esta en tg_temp
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT ci_e FROM sc_tg_temp WHERE ci_e='$ci_e'";      
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;
if($fila==1):
include('ing_ced.php');
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
include_once('muestra.php');

else:

/*$sSQL = "SELECT lapso FROM dace006 WHERE exp_e='".$exp_e."' AND c_asigna='".$c_asigna."' ";
$conex->ExecSQL($mSQL,__LINE__,true);

if ($conex->result[0][0] == $lapsoProceso){

}*/


//ingreso los datos del estudiante en tg_temp
$conex->iniciarTransaccion("Inicia Transaccion ".$_SESSION['ced']." - Ced Estudiante: ".$ci_e);
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "INSERT INTO sc_tg_temp (EXP_E, APELLIDOS, APELLIDOS2, NOMBRES, NOMBRES2, CI_E, ACTA, ACTA2, LAPSO, C_ASIGNA, SECCION,ESTATUS_E,CARRERA,C_UNI_CA,ASIGNATURA) VALUES ('$exp_e', '$apellidos', '$apellidos2', '$nombres', '$nombres2', '$ci_e', '$acta', '$acta', '$lapso', '$c_asigna', '$seccion','$estatus_e','$carrera','$c_uni_ca','$asignatura')";      
$conex->ExecSQL($mSQL,__LINE__,true);
$conex->finalizarTransaccion("Finaliza Transaccion ".$_SESSION['ced']);
$ok=$conex->fmodif;
 
include('ing_ced.php');

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
}else {// si no tiene insolvencia
	include_once('muestra.php');
}

 endif; 
 endif; 
 endif;
 endif;




include('pie.php');
?>
