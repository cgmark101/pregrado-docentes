<?php
//if (empty($actap)): ?>

<table border="1px" align="center" width="720px" style="border-collapse: collapse;border-color:black;">
  <tr>
    <td class="titulo_tabla"><div align="center">Lapso Acad&eacute;mico: <?php echo $tLapso; ?></div></td>
  </tr>
</table>

<table width="720" border="0" align="center">
  <tr>
  <td class="datos" align"center" >Introduzca el N�mero de C�dula de Identidad de los alumnos que desea cargarle el estatus de "Aprobado"</td>
  </tr>
  <tr>
  <td> <form action="datos_e2_pp.php" method="post" name="cedula" id="cedula" onsubmit="return validar();">
  <span class="datos_tabla">C�dula de Identidad: </span>
 <label class="alert">
  <input name="ci_e" type="text" class=":required :number">
  </label>
  <input name="Aceptar" type="submit" value="Aceptar">
  <span class="sugerencia">Sin comas ni puntos, solo n�meros</span>
  </form> </td>
  <td>
  
  

	</td>
  </tr>
</table>
<?php 
/*else:
echo ' ' ;
endif;
*/
?>





