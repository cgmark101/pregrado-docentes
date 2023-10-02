<?php 
include_once('inc/config.php');
require_once('inc/odbcss_c.php');
require("funciones.php");

//Busco acta en sc_temp1 para mostrarla 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT MAX(@value(acta)) FROM sc_temp1";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;

$acta=$result[0][0];

$c_asigna='300622';
$seccion='M1';
$fecha=date("Y-m-d");
//Busco lapso en sc_temp1 para mostrarla 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT MAX(lapso) FROM sc_temp1";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$lapso=$result[0][0];
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
 <td width="135" class="datos_tabla"><div align="left">C&Oacute;DIGO: <strong><?php echo $c_asigna; ?></strong></div></td>
 <td width="478" class="datos_tabla"><strong></strong></td>
 <td width="85" class="datos_tabla"><div align="right">ACTA: <strong><?php echo $acta;?></strong></div></td>
 </tr>
 <tr>
   <td class="datos_tabla"><div align="left">SECCI&Oacute;N: <strong><?php echo $seccion; ?></strong></div></td>
   <td class="datos_tabla">&nbsp;</td>
   <td class="datos_tabla">&nbsp;</td>
 </tr>
</table>

<?php
//if (empty($actap)):
$dSQL="SELECT exp_e, apellidos, apellidos2, nombres, nombres2, observacion, ci_e FROM sc_temp ORDER BY lapso ASC";
//else:
//$dSQL="SELECT exp_e, apellidos, apellidos2, nombres, nombres2, observacion, ci_e FROM sc_temp WHERE acta='$actap' ORDER BY lapso ASC";
//endif;
//Generar la consulta ODBC a sc_temp para mostrarla 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = $dSQL;     
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
$fila = $conex->filas;

?>
<table width="720" border="1" align="center" style="border-collapse: collapse;border-color:black;">

    <td class="datos_tabla"><strong> </strong></div></td>
    <td class="datos_tabla"><strong>EXPEDIENTE</strong></div></td>
    <td class="datos_tabla"><strong>APELLIDOS</strong></td>
	<td class="datos_tabla"><strong>NOMBRES </strong></td>
    <td class="datos_tabla"><strong>OBSERVACION</strong></td>
	<td class="datos_tabla"><strong>OPCIÓN</strong></td>
  </tr>

<?php  
	for($i=0; $i < count($result); $i++) {?>
		<tr>
		<td class="datospd"><?php echo $i+1; ?></td>
	    <td class="datospd"><?php echo $result[$i][0]; ?></td>
	    <td class="datospd"><?php echo $result[$i][1]; ?>  <?php echo $result[$i][2]; ?></td>
		<td class="datospd"><?php echo $result[$i][3]; ?>  <?php echo $result[$i][4]; ?></td>
		<td class="datospd"><?php echo $result[$i][5]; ?></td>
		<td class="datospd"><a href="#" onclick="delEst('<?php echo $result[$i][6];?>');">Eliminar</a></td>


 </tr>
<?php  } ?>
<label>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
<?php 
if($fila >= '1'): 	
  echo '<td class="datospd" align="right"> <a href="#" onClick="mensaje_sc(this)"><input type="submit" name="Submit" value="Procesar" /></a></td>
  </label>';
else:
  echo ' ';
  endif;?>

</table>

<script type="text/javascript">
function delEst(id) {
    if (window.confirm("Aviso:\nDesea eliminar el alumno seleccionado?")) {
        window.location = "borrar_est_sc.php?action=del&id="+id;   
    }
}
</script>

