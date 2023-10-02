<?php 
include_once('inc/config.php');
require_once('inc/odbcss_c.php');
require("funciones.php");
/*
//Busco seccion de DACE006
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT seccion FROM dace006 WHERE acta='$acta'";     
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
$seccion=$result[0][0];
*/



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
 
 <td width="478" class="datos_tabla"><strong></strong></td>
 
 </tr>
</table>

<?php
if($user=='0'):
$dSQL="SELECT acta, lapso, seccion, exp_e, apellidos, apellidos2, nombres, nombres2,ci_e, c_asigna FROM sc_tg_temp";
else:
$dSQL="SELECT acta, lapso, seccion, exp_e, apellidos, apellidos2, nombres, nombres2,ci_e, c_asigna FROM sc_tg_temp WHERE c_asigna='$c_asignad'";
endif;


//Generar la consulta ODBC a tg_temp para mostrarla 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = $dSQL;     
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
$fila = $conex->filas;

?>
<table width="720" border="1" align="center" style="border-collapse: collapse;border-color:black;">

    <td class="datos_tabla"><strong> </strong></div></td>
	<td class="datos_tabla"><strong>ACTA</strong></div></td>
	<td class="datos_tabla"><strong>LAPSO</strong></div></td>
	<td class="datos_tabla"><strong>CÓDIGO</strong></div></td>
	<td class="datos_tabla"><strong>SECCION</strong></div></td>
    <td class="datos_tabla"><strong>EXPEDIENTE</strong></div></td>
    <td class="datos_tabla"><strong>APELLIDOS</strong></td>
	<td class="datos_tabla"><strong>NOMBRES </strong></td>
   	<td class="datos_tabla"><strong>OPCIÓN</strong></td>
  </tr>

<?php 
//if(empty($actap)):

?>
<?php for($i=0; $i < count($result); $i++) { ?>
		<tr>
		<td class="datospd"><?php echo $i+1; ?></td>
	    <td class="datospd"><?php echo $result[$i][0]; ?></td>
		<td class="datospd"><?php echo $result[$i][1]; ?></td>
		<td class="datospd"><?php echo $result[$i][9]; ?></td>
		<td class="datospd"><?php echo $result[$i][2]; ?></td>
		<td class="datospd"><?php echo $result[$i][3]; ?></td>
	    <td class="datospd"><?php echo $result[$i][4]; ?>  <?php echo $result[$i][5]; ?></td>
		<td class="datospd"><?php echo $result[$i][6]; ?>  <?php echo $result[$i][7]; ?></td>
		<td class="datospd"><a href="#" onclick="delEst('<?php echo $result[$i][8];?>');">Eliminar</a></td>


 </tr>
 <?php } ?>
<?php /*else:
 for($i=0; $i < count($result); $i++) { ?>
		<tr>
		<td class="datospd"><?php echo $i+1; ?></td>
	    <td class="datospd"><?php echo $result[$i][0]; ?></td>
		<td class="datospd"><?php echo $result[$i][1]; ?></td>
		<td class="datospd"><?php echo $result[$i][9]; ?></td>
		<td class="datospd"><?php echo $result[$i][2]; ?></td>
		<td class="datospd"><?php echo $result[$i][3]; ?></td>
	    <td class="datospd"><?php echo $result[$i][4]; ?>  <?php echo $result[$i][5]; ?></td>
		<td class="datospd"><?php echo $result[$i][6]; ?>  <?php echo $result[$i][7]; ?></td>


 </tr>




 
<?php endif; */

?>
<label>

<?php 
if($fila >= '1'): 	
  echo '<td colspan="8"></td>
  <td class="datospd" align="right"><a href="#" onClick="mensaje1(this);"><input type="submit" name="Submit" value="Procesar" /></a></td>
  </label>';
  else:
  echo ' ';
  endif;?>
  
</table>

<script type="text/javascript">
function delEst(id) {
    if (window.confirm("Aviso:\nDesea eliminar el alumno seleccionado?")) {
        window.location = "borrar_est.php?action=del&id="+id;   
    }
}
</script>

