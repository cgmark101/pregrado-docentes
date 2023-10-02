<?php 

error_reporting(E_ALL);
include_once('inc/config.php');
require_once('inc/odbcss_c.php');
setlocale(LC_ALL,"es_ES@euro","es_ES","esp"); 

$asigna=$_POST['actap'];
//se consulta la asignatura (el acta de servicio comunitario es diferente)
/*$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT c_asigna FROM sc_tg_temp WHERE acta='$actap'
UNION
SELECT c_asigna FROM sc_temp WHERE acta='$actap'
UNION
SELECT c_asigna FROM sc_pp_temp WHERE acta='$actap'";     
$conex->ExecSQL($mSQL,__LINE__,true);
$fila = $conex->filas;
if($fila==0):
echo '  <link rel="stylesheet" href= "css/estilo.css"  type="text/css" media="screen">
<table width="720" border="0" align="center" style="border-collapse: collapse;border-color:black;">
  <tr>
    <td class="titulo_tabla"><div align="left">Sugerencias:</div></td>
  </tr>
  <tr>
    <td class="datospd"><div align="left"> <span class="alert2">HA INGRESADO UN NÚMERO DE ACTA INVÁLIDO
	</span>  <a href=javascript:history.back(1)><input name="Regresar" type="button" value="Regresar"/></a></font>
</td>
</div></td>
  </tr>
</table>';
echo "<script languaje='javascript'>
alert('ALERTA: HA INGRESADO UN NÚMERO DE ACTA INVÁLIDO');
window.opener.location = 'index.php';


</script>";
else:

$result = $conex->result;
$codigo=$result[0][0];



$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT asignatura FROM tblaca008 WHERE c_asigna='$codigo'";     
$conex->ExecSQL($mSQL,__LINE__,true);
$fila = $conex->filas;
$result = $conex->result;
$asigna=$result[0][0];
*/

if($asigna=='SERVICIO COMUNITARIO'):
include('datos_e2_sc.php'); // procesar solo las actas pendientes 

elseif($asigna=='TRABAJO DE GRADO'):
include('datos_e2.php');

elseif($asigna=='PRACTICA PROFESIONAL' or $asigna=='PRACTICA PROFESIONAL '):
include('datos_e2_pp.php');

elseif($asigna=='PRACTICA PROFESIONAL DE GRADO'):
include('datos_e2_pp.php');

else:
echo '';
//endif;
endif;
?>


