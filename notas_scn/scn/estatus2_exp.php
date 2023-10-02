<?php
error_reporting(E_ALL);
include_once('inc/config.php');
require_once('inc/odbcss_c.php');

$title= "ACREDITACION POR EXPERIENCIA";
$poz="Vicerrectorado Puerto Ordaz";
$version="Version 1.0";
$copy="© ".date(Y)." - UNEXPO - Vicerrectorado Puerto Ordaz. Oficina Regional de Tecnología y Servicios de Información";

$titulo=strtoupper($title);
$css="css/estilo.css";

//variables post
$lap=$_POST['lap'];

//print_r($_POST);

include('encabezado.php');

//Se valida el lapso ingresado 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT lapso FROM dace004 WHERE lapso='$lap'";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;

if($fila==0):
echo '<table width="720" border="0" align="center" style="border-collapse: collapse;border-color:black;">
  <tr>
    <td class="titulo_tabla"><div align="left">Sugerencias:</div></td>
  </tr>
  <tr>
    <td class="datospd"><div align="left"> <span class="alert2">No se encontró ningún lapso académico válido
	</span>  <a href=javascript:history.back(1)><input name="Regresar" type="button" value="Regresar"/></a></font>
</td>
</div></td>
  </tr>
</table>';

//include_once('muestra.php');

else:
//Se guarda el lapso en sc_temp1
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "UPDATE sc_temp1 SET lapso='$lap'";     
$conex->ExecSQL($mSQL,__LINE__,true);
$ok=$conex->fmodif;

include_once('gen_acta_exp.php');
?>

<?php // header( 'Content-type: text/html; charset=iso-8859-1' );?>
<link href="css/estilo.css" rel="stylesheet" type="text/css" />


<div id="main">

<table border="1px" align="center" width="720px" style="border-collapse: collapse;border-color:black;">
  <tr>
    <td class="titulo_tabla"><div align="center">Lapso Acad&eacute;mico: <?php echo $lap; ?></div></td>
  </tr>
</table>

<table width="720" border="0" align="center">
  <tr>
  <td class="datos" align"center" >Introduzca el Número de Cédula de Identidad de los alumnos que desea cargarle el estatus de "Aprobado"</td>
  </tr>
  <tr>
  <td> <form action="datos_e2_exp.php" method="post" name="cedula" id="cedula" >
  <span class="datos_tabla">Cédula de Identidad: </span>
  <label class="alert">
  <input name="ci_e" type="text" class=":required"><input name="Aceptar" type="submit" value="Aceptar">
  </label>
  <span class="sugerencia">Sin comas ni puntos, solo números</span>
  </form> </td>
 
  </tr>
</table>


</div>


</body>

</html>

<?php 
 endif;
 include("pie.php");?>
