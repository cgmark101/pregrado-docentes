<?php
include_once('inc/config.php');
include("encabezado.php");
if(($acceso_user1==false) AND ($user=='1')):
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
$mSQL  = "SELECT * FROM sc_temp";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;
if($fila > 0):
echo '<table width="720" border="0" align="center" style="border-collapse: collapse;border-color:black;">
  <tr>
    <td class="titulo_tabla"><div align="left">Sugerencias:</div></td>
  </tr>
  <tr>
    <td class="datospd"><div align="left"> <span class="alert">QUEDAN ACTAS PENDIENTES POR PROCESAR, HAGA CLIC EN LA PESTA�A "VISUALIZAR ACTAS" LUEGO EN ACTAS PENDIENTES EN EL  MENU PRINCIPAL"
	</span>  </td>
</div></td>
  </tr>
</table>';
echo "<script languaje='javascript'>
alert('ALERTA: QUEDAN ACTAS PENDIENTES POR PROCESAR, HAGA CLIC EN LA PESTA�A VISUALIZAR ACTAS PENDIENTES DEL MENU PRINCIPAL');

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
    <td class="datos" align="center"><p>&nbsp;</p>
    <p><font style="font-size: 11px">Introduzca el Lapso Acad&eacute;mico en donde establecer&aacute; el cambio de estatus a los alumnos que cursaron Servicio Comunitario</p></td>
  </tr>
  <tr>
    <td><form " method="post" action="estatus2_sc.php">
     <span class="datos_tabla">Lapso Acad&eacute;mico: </span>
        <label class="alert">
	  <input type="text" name="lap" size="4" maxlength="4" class=":required :integer :only_on_submit"/><strong>-</strong><input type="text" name="so" size="1" maxlength="1" value="" class=":required "/>
      </label>
	 
	 <input type="submit" value="Aceptar" />
	  
	  <span class="sugerencia">Ejemplo: <?php echo $tLapso;?>   </span>
    </form></td>
  </tr>
</table>





<?php
include("pie.php");
endif;
endif;
?>