<?php

$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT * FROM sc_exp_temp ORDER BY lapso DESC";     
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
$fila = $conex->filas;

if ($fila > 0):
echo ' ';
else:
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT lapso FROM sc_temp1 ORDER BY lapso DESC";     
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
$lapso=$result[0][0];

?>
<table border="1px" align="center" width="720px" style="border-collapse: collapse;border-color:black;">
  <tr>
    <td class="titulo_tabla"><div align="center">Lapso Acad&eacute;mico: <?php echo $lapso; ?></div></td>
  </tr>
</table>

<table width="720" border="0" align="center">
  <tr>
  <td class="datos" align"center" >Introduzca el Número de Cédula de Identidad de los alumnos que desea cargarle el estatus de "Aprobado"</td>
  </tr>
  <tr>
  <td> <form action="datos_e2_exp.php" method="post" name="cedula" id="cedula" onsubmit="return validar();">
  <span class="datos_tabla">Cédula de Identidad: </span>
 <label class="alert">
  <input name="ci_e" type="text" class=":required :number">
  </label>
  <input name="Aceptar" type="submit" value="Aceptar">
  <span class="sugerencia">Sin comas ni puntos, solo números</span>
  </form> </td>
 
  </tr>
</table>
<?php 
/*else:
echo ' ' ;*/
endif;

?>





