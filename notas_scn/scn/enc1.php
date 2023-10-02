<?php
//header( 'Content-type: text/html; charset=iso-8859-1' );

$title= "SERVICIO COMUNITARIO";
$poz="Vicerrectorado Puerto Ordaz";
$version="Version 1.0";
$copy="© 2012 - UNEXPO - Vicerrectorado Puerto Ordaz. Oficina Regional de Tecnología y Servicios de Información";

$titulo=strtoupper($title);
$css="css/estilo.css";
echo "<input type=\"hidden\" id=\"error\" value=\"NO\">";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
 <head>
  <title>:: Carga de Calificaciones <?php echo ucwords(strtolower($title)) ?> :: UNEXPO <?php echo $poz ?> ::</title>
  <meta name="Author" content="UNEXPO Vicerrectorado Puerto Ordaz">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link rel="stylesheet" href= "css/estilo.css"  type="text/css" media="screen">
  <script type="text/javascript" src="js/funciones.js"></script>
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/vanadium.js"></script>
  <script type="text/javascript" src="js/hora_actual.js"></script>
  <script type="text/javascript" src="js/jquery-ui.min.js"></script>



 </head>
<body onLoad="show5()">

<table width="720" border="0" align="center" style="border-collapse: collapse;border-color:black;">
  <tr>
    <td><img src="imagenes/logo2.png" width="720" height="72" /></td>
  </tr>
  <tr>
    <td class="legend">M&oacute;dulo de Profesores para la Carga de Notas<br /><?php echo $title; ?></td>
  </tr>
  
</table>
<table width="725"  align="center" style="border-collapse: collapse;border-color:black;">
<tr>
  <td class="super_menu"><?php include("menu1.php");?></td>
  <td class="enc_leg">Hora Actual: <span id="liveclock"></span> </td>
  
  
  </tr>
</table>


</body>