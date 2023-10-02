<?php 

//consultar alumnos del acta  
include_once('inc/config.php');
require_once('inc/odbcss_c.php');
//require("funciones.php");




?>
<table width="650" border="1" align="center" style="border-collapse: collapse;border-color:black;">

    <td class="datos_tabla"><strong> </strong></div></td>
    <td class="datos_tabla"><strong>EXPEDIENTE</strong></div></td>
    <td class="datos_tabla"><strong>APELLIDOS Y </strong><strong>NOMBRES </strong></td>
	<td class="datos_tabla"><strong>OBSERVACION</strong></td>
	</tr>
  <?php for($i=$desde; $i < $hasta; $i++) { ?>
		<tr>
		  <td class="datospd"><strong><?php echo $i+1; ?></strong></td>
		  <td class="datospd"><?php echo $exp_e[$i]; ?></td>
		  <td class="datospd"><div align="left">   <?php echo $apellidos[$i]; echo ' '; ?><?php echo $apellidos2[$i]; echo ' ';  ?><?php echo $nombres[$i]; echo ' '; ?><?php echo $nombres2[$i]; ?> </div></td>
		  <td class="datospd"><?php echo $obs[$i]; ?></td>
  </tr>
  
<?php $ins=$i+1; } ?>
</table>