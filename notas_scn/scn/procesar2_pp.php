<?php 
include_once('user2.php');
error_reporting(E_ALL);
include_once('inc/config.php');
require_once('inc/odbcss_c.php');
setlocale(LC_ALL,"es_ES@euro","es_ES","esp"); 



?>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo1 {font-size: 14px}
.Estilo2 {font-size: 16}
.Estilo3 {font-size: 16px}
.Estilo4 {font-size: 12px}
-->
</style>
<head>
<title>:: Acta de Evaluación Final :: <?php $title ?> :: Sistema Web URACE :: UNEXPO <?php $poz ?>  </title>
<table width="650" border="0" align="center">
  <tr>
    <td width="167"><img src="imagenes/unexpo.jpeg" width="133" height="110" /></td>
    <td width="517"><div align="center" class="enc_materias">
      <p><strong>Universidad  Nacional Experimental Polit&eacute;nica<br />
      &quot;Antonio Jos&eacute; de Sucre&quot;<br /> 
        Vicerrectorado Puerto Ordaz<br />
      Unidad Regional de Admisi&oacute;n y Control de Estudios</strong></p>
   
    </div></td>
   
</table>

<link href="css/estilo.css" rel="stylesheet" type="text/css"><table width="700" border="0" align="center">
  <tr>
  <td colspan="4" align="center" class="titulo_tabla"><div align="center">Datos del Docente </div></td>
  </tr>
   <tr> 
	<td class="datosp" align="center"><strong>Apellidos:</strong></td>
	
    <td class="datosp" align="center"><strong>Nombres:</strong></td>
    <td class="datosp" align="center"><strong>Cedula</strong> </td>
    <td class="datosp" align="center"><strong>ID Usuario</strong> </td>
  </tr>
   <tr>
     <td class="datosp" align="center"><?php echo $apellido; ?></td>
     <td class="datosp" align="center"><?php echo $nombre; ?></td>
     <td class="datosp" align="center"><?php echo $ced; ?></td>
     <td class="datosp" align="center"><?php echo $ced; ?></td>
   </tr>
   <tr>
     <td colspan="4" class="alert2" align="center">Nota: esto "NO" es una acta de evaluación válida, para ver las actas cargadas dirijase al menú principal "Visualizar Actas" y luego a "Actas Cargadas"</td>
   </tr>
  </table>
<p>
  <?php //Generar la consulta ODBC a pp_temp para mostrarla 
include_once('inc/config.php');
require_once('inc/odbcss_c.php');
require("funciones.php");

$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT exp_e,apellidos,apellidos2,nombres,nombres2,ci_e,calificacion,letras,observacion,acta,lapso,c_asigna FROM sc_pp_temp ORDER BY 11,12,10,2,3,4,5 ASC";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;


$fila = $conex->filas;
if($fila==0):
echo "<script languaje='javascript'>
alert('ALERTA: Debe ingresar al menos 1 alumno para poder procesar');
window.opener.location = 'login.php';
window.close();
</script>";
//elimino campos sc_temp1
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "DELETE FROM sc_temp1";     
$conex->ExecSQL($mSQL,__LINE__,true);
$ok=$conex->fmodif;
else:?>
</p>
<p>&nbsp;</p>
<table width="650" border="0" align="center">
  <tr>
    <td colspan="9" align="center" class="sub_tabla"><div align="center">
      <p>Actas de Evaluación Cargadas: </p>
    </div></td>
  </tr>
  <tr>
    <td height="20" colspan="5" class="enc_p"><strong> </strong> </td>
    <td colspan="4" class="enc_p"><strong>NOTA DEFINITIVA </strong></td>
  </tr>
  <tr>
    <td class="enc_p">&nbsp;</td>
    <td class="enc_p2"><strong>ACTA</strong></td>
	<td class="enc_p"><strong>LAPSO</strong></td>
	<td class="enc_p"><strong>CÓDIGO</strong></td>
    <td class="enc_p"><strong>EXPEDIENTE</strong></td>
    <td class="enc_p"><strong>APELLIDOS Y NOMBRES </strong></td>
    <td class="enc_p"><strong>EN NUMERO </strong></td>
    <td class="enc_p"><strong>EN LETRAS </strong></td>
    <td class="enc_p"><strong>OBSERVACION</strong></td>
  </tr>
  <?php for($i=0; $i < count($result); $i++) { ?>
  <tr>
    <td class="datosp"><strong><?php echo $i+1; ?></strong></td>
    <td class="inact2"><?php echo $result[$i][9]; ?></td>
	<td class="datosp"><?php echo $result[$i][10]; ?></td>
	<td class="datosp"><?php echo $result[$i][11]; ?></td>
    <td class="datosp"><?php echo $result[$i][0]; ?></td>
    <td class="datosp"><div align="left">   <?php echo $result[$i][1]; echo ' ';?><?php echo $result[$i][2]; echo ' '; ?><?php echo $result[$i][3]; echo ' '; ?><?php echo $result[$i][4]; ?> </div></td>
    <td class="datosp"><?php  echo $result[$i][6]; ?></td>
    <td class="datosp"><?php  echo $result[$i][7]; ?></td>
    <td class="datosp"><?php echo $result[$i][8]; ?></td>
  </tr>
  <?php $ins=$i+1;} ?>
</table>
<table width="650" border="0" align="center"  style="border-collapse: collapse;border-color:black;">
  <tr>
    <td class="sub_tabla"><td id="oculto" colspan="2" align="center"><input type="button" value="IMPRIMIR" onclick="imprimir()">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="SALIR" onclick="proceso();"></td>
    
  </tr>

<?php 
/*
//elimino campos sc_temp1
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "DELETE FROM sc_temp1";     
$conex->ExecSQL($mSQL,__LINE__,true);
$ok=$conex->fmodif;
*/

//die();
include('procesar_all_pp.php'); ?>
</table>

<script type="text/javascript">
function proceso() {
     if (window.confirm("Recuerde imprimir su Acta de Evaluación Final ¿Desea Continuar?")) {
		window.opener.location = 'index_0.php';
	    window.close();; return false;
	}
}
</script>

<SCRIPT LANGUAGE="JavaScript1.2" TYPE="text/javascript">
<!--
window.onbeforeunload = unloadMess;
function unloadMess(){
	mess = "Recuerde imprimir su Acta de Evaluación Final"
	window.opener.location = 'index_0.php';
	return mess;
    

}
//-->

</SCRIPT>

<?php 
endif;
?>
