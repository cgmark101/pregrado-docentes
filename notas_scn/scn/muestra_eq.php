<?php 
include_once('inc/config.php');
require_once('inc/odbcss_c.php');
require("funciones.php");

//Busco acta y lapso en sc_temp1 para mostrarla 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT acta,lapso FROM sc_temp1 ORDER BY acta DESC";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$acta=$result[0][0];
$lapso=$result[0][1];
//Busco lo demas en exp_temp
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT c_asigna, asignatura, carrera FROM sc_eq_temp ORDER BY acta DESC";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;
if($fila==0):
$c_asigna=' ';
$asignatura=' ';
$carrera=' ';
$operacion=' ';
$opr=' ';
else:
$c_asigna=$result[0][0];
$asignatura=$result[0][1];
$carrera=$result[0][2];

endif;
$fecha=date("Y-m-d"); 
$seccion='M1';

if($opr==1):
$operacion='EQUIVALENCIA';
elseif($opr=='2'):
$operacion='REVÁLIDA';
else:
$operacion=' ';
endif;

?>
<table width="720" border="0" align="center" style="border-collapse: collapse;border-color:black;">
  <tr>
    <td class="titulo_tabla"><div align="center">ACTA DE EVALUACION FINAL </div></td>
  </tr>
  <tr>
    
</div></td>
  </tr>
<table width="720" border="0" align="center" style="border-collapse: collapse;border-color:black;">
 <tr>
 <td width="614"  class="datos_tabla"><div align="left">ASIGNATURA: <strong><?php echo $asignatura; ?> </strong></div></td>
  
 <td width="76" class="datos_tabla"><div align="right">ACTA: <strong><?php echo $acta;?></strong></div></td>

 </tr>
 <tr>
   <td class="datos_tabla"><div align="left">C&Oacute;DIGO: <strong><?php echo $c_asigna; ?></strong></div></td>
   <td></td>
 </tr>
 <tr>
   <td class="datos_tabla"><div align="left">SECCI&Oacute;N: <strong><?php echo $seccion; ?></strong></div></td>
   <td class="datosp" align="right"><strong><?php echo $operacion; ?></strong></td>
 </tr>
</table>

<?php
//if (empty($actap)):
$dSQL="SELECT exp_e, apellidos, apellidos2, nombres, nombres2, observacion, ci_e, lapso, carrera FROM sc_eq_temp ORDER BY lapso ASC";
//else:
//$dSQL="SELECT exp_e, apellidos, apellidos2, nombres, nombres2, observacion, ci_e FROM sc_temp WHERE acta='$actap' ORDER BY lapso ASC";
//endif;
//Generar la consulta ODBC a sc_temp para mostrarla 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = $dSQL;     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;

?>
<table width="720" border="1" align="center" style="border-collapse: collapse;border-color:black;">

    <td class="datos_tabla"><strong> </strong></div></td>
    <td class="datos_tabla"><strong>EXPEDIENTE</strong></div></td>
	<td class="datos_tabla"><strong>LAPSO</strong></div></td>
	<td class="datos_tabla"><strong>ESPECIALIDAD</strong></div></td>
    <td class="datos_tabla"><strong>APELLIDOS</strong></td>
	<td class="datos_tabla"><strong>NOMBRES </strong></td>
    <td class="datos_tabla"><strong>OBSERVACION</strong></td>
	<td class="datos_tabla"><strong>OPCIÓN</strong></td>
  </tr>

<?php for($i=0; $i < count($result); $i++) { ?>
		<tr>
		<td class="datospd"><?php echo $i+1; ?></td>
	    <td class="datospd"><?php echo $result[$i][0]; ?></td>
		<td class="datospd"><?php echo $result[$i][7]; ?></td>
		<td class="datospd"><?php echo $result[$i][8]; ?></td>
	    <td class="datospd"><?php echo $result[$i][1]; ?>  <?php echo $result[$i][2]; ?></td>
		<td class="datospd"><?php echo $result[$i][3]; ?>  <?php echo $result[$i][4]; ?></td>
		<td class="datospd"><?php echo $result[$i][5]; ?></td>
		<td class="datospd"><a href="#" onClick="delEst('<?php echo $result[$i][6];?>');">Eliminar</a></td>
 </tr>
<?php } ?>
<label>
<FORM METHOD=POST ACTION="procesar_eq.php">
	

	<td colspan="7"> </td>
 <?php
  if($fila >= '1'): 
  echo '<td class="datospd" align="right"><input type="submit" name="Submit" value="Procesar" onClick="mensaje_eq(this)"/></a>
	<input value="<?php echo $opr; ?>" name="opr" type="hidden"></td>
  </label>';
  else:
  echo ' ';
  endif;?>
  </FORM>
</table>

<script type="text/javascript">
function delEst(id) {
    if (window.confirm("Aviso:\nDesea eliminar el alumno seleccionado?")) {
        window.location = "borrar_est_eq.php?action=del&id="+id;   
    }
}
</script>

