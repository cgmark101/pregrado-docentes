<?php
include_once('inc/config.php');
include("encabezado.php");
if(($acceso_user7==false) AND ($user=='7')):
echo '<table width="720" border="0" align="center" style="border-collapse: collapse;border-color:black;">
  <tr>
    <td class="titulo_tabla"><div align="left">Sugerencias:</div></td>
  </tr>
  <tr>
    <td class="datospd"><div align="left"> <span class="alert">"EL PROCESO DE CARGA DE NOTAS ESTA RESTRINGIDO, POR FAVOR COMUNIQUESE CON ORTSI"
	</span>  </td>
</div></td>
  </tr>
</table>';
echo "<script languaje='javascript'>
alert('ALERTA: EL PROCESO DE CARGA DE NOTAS ESTA RESTRINGIDO, POR FAVOR COMUNIQUESE CON ORTSI');

</script>";
else:

//verificar si tiene actas pendientes 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT * FROM sc_pp_temp";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;
if($fila > 0):
echo '<table width="720" border="0" align="center" style="border-collapse: collapse;border-color:black;">
  <tr>
    <td class="titulo_tabla"><div align="left">Sugerencias:</div></td>
  </tr>
  <tr>
    <td class="datospd"><div align="left"> <span class="alert">QUEDAN ACTAS PENDIENTES POR PROCESAR, HAGA CLIC EN LA PESTAÑA "VISUALIZAR ACTAS" LUEGO EN ACTAS PENDIENTES EN EL  MENU PRINCIPAL"
	</span>  </td>
</div></td>
  </tr>
</table>';
echo "<script languaje='javascript'>
alert('ALERTA: QUEDAN ACTAS PENDIENTES POR PROCESAR, HAGA CLIC EN LA PESTAÑA VISUALIZAR ACTAS PENDIENTES DEL MENU PRINCIPAL');

</script>";
else:
?>
<link href="css/estilo.css" rel="stylesheet" type="text/css" />

<table width="700" border="0" align="center">
  <tr>
    <td class="enc_materias" align="center"><p>&nbsp;</p>
    <p><font style="font-size: 14px"><?php echo $nombre; echo ' '; echo $apellido; ?> </p></td>
  </tr>
 <tr>
 <td class="sugerencia"> <div align="left"> - Seleccione una opción en el menú desplegable, ubicado en la parte superior de la página<br />
    - Si necesita consultar el manual de usuario, ubique la sección de Ayuda en el menú <br />
    - Si no desee realizar más operaciones ubique Salir en el menú </div></td>
 </tr> 
<?php 
include_once('ing_ced_pp.php'); 
?> 
</tr>
</table>





<?php
include("pie.php");
endif;
endif;
?>