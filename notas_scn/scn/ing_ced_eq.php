<?php

$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT * FROM sc_eq_temp ORDER BY lapso DESC";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;

if ($fila > 0):
echo ' ';
else:
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT lapso FROM sc_temp1 ORDER BY lapso DESC";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$lapso=$result[0][0];

?>
<table border="1px" align="center" width="720px" style="border-collapse: collapse;border-color:black;">
  <tr>
    <td class="titulo_tabla"><div align="center">Lapso Acad&eacute;mico: <?php echo $lapso; ?></div></td>
  </tr>
</table>

<table width="720" border="0" align="center">
  <form action="datos_e2_eq.php" method="post" name="cedula" id="cedula" >
  <tr>
  <td class="datos" align"center" >Introduzca el Número de Cédula de Identidad del alumno que desea cargarle el estatus de "Aprobado"</td>
  </tr>
  <tr>
  
  <td> 
  <span class="datos_tabla">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cédula de Identidad   : </span>
  <label class="alert">
  <input name="ci_e" type="text" class=":required :number" />
  </label>
  <span class="sugerencia">Sin comas ni puntos, solo números</span>   </td>
   
  </tr> 
 <tr>
 <td>
 <span class="datos_tabla">C&oacute;digo de la Asignatura: </span>
 <label class="alert"><input name="c_asigna" type="text" class=":required"></label>  <span class="sugerencia">Sin comas ni puntos, solo números</span>
 </td>
 </tr>
 <tr>
 
 <LABEL class=":required">
		<td class="inact2" align"left"> SELECCIONE SI ES POR EQUIVALENCIA O POR REVÁLIDA <SELECT class="datosp" NAME="opr" align="left">
		<OPTION VALUE="1" SELECTED>EQUIVALENCIA</OPTION>
		<OPTION VALUE="2"> REVÁLIDA</OPTION>
	</SELECT>
	</LABEL>
	<input type="submit" value="Aceptar" />
 </td>
 </tr>
  </tr>
  </form>
</table>
<?php 
/*else:
echo ' ' ;*/
endif;

?>





