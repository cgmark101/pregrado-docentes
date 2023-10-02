<?php
include_once('inc/config.php');
require_once('inc/odbcss_c.php');
//include("encabezado.php");
//header( 'Content-type: text/html; charset=iso-8859-1' );

$title= "TRABAJO DE GRADO";
$poz="Vicerrectorado Puerto Ordaz";
$version="Version 1.0";
$copy="© 2012 - UNEXPO - Vicerrectorado Puerto Ordaz. Oficina Regional de Tecnología y Servicios de Información";

$titulo=strtoupper($title);
$css="css/estilo.css";
echo "<input type=\"hidden\" id=\"error\" value=\"NO\">";

?>

<link href="css/estilo.css" rel="stylesheet" type="text/css" />

<table width="700" border="0" align="center">
  <tr>
    <td class="datos" align="center"><p>&nbsp;</p>
    <p><font style="font-size: 11px">Introduzca su número de cédula</p></td>
  </tr>
  <tr>
    <td><form " method="post" action="valida.php">
     <span class="datos_tabla">Nro de Cédula: </span>
        <label class="alert">
	  <input type="text" name="ced" class=":required"/>
      </label>
	 
	 <input type="submit" value="Aceptar" />
	  
	  <span class="sugerencia">Ejemplo: 123456  </span>
    </form></td>
  </tr>
</table>

<?php
include("pie.php");
?>
