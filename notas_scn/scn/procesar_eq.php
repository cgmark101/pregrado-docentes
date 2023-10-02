<?php 
include_once('user2.php');

error_reporting(E_ALL);
include_once('inc/config.php');
require_once('inc/odbcss_c.php');
setlocale(LC_ALL,"es_ES@euro","es_ES","esp"); 


$opr=$_POST['opr'];

//selecciono todos los datos que voy a usar
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT acta,c_asigna,seccion,lapso,asignatura FROM sc_eq_temp ORDER BY apellidos ASC";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$acta=$result[0][0];
$c_asigna=$result[0][01];
$seccion=$result[0][2];
$lapso=$result[0][3];
$asignatura=$result[0][4];

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
      <p class="Estilo3">ACTA DE EVALUACI&Oacute;N FINAL </p>
    </div></td>
    <td width="102"><p align="left" class="datos_tabla Estilo2"><span class="Estilo4">Fecha:<strong> <?php echo date("d/m/Y");?></strong></span><br />
    </p>
      <p class="datos_tabla"><br />
    </p></td>
  </tr>
  <tr>
    <td class="datos_tabla"><div align="left">C&Oacute;DIGO:<strong><?php echo $c_asigna; ?></strong></div></td>
    <td><div align="center" class="enc_materias Estilo1"><?php echo $asignatura; ?></div></td>
    <td class="datos_tabla"><div align="left">LAPSO:<strong><?php echo $lapso; ?></strong></div></td>
  </tr>
  <tr>
    <td class="datos_tabla"><div align="left">SECCI&Oacute;N:<strong><?php echo $seccion; ?></strong></div></td>
    <td>&nbsp;</td>
    <td class="datos_tabla"><div align="left">ACTA:<strong><?php echo $acta;?></strong></div></td>
  </tr>
</table>

<?php //Generar la consulta ODBC a sc_temp para mostrarla 
include_once('inc/config.php');
require_once('inc/odbcss_c.php');
require("funciones.php");

$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT exp_e,apellidos,apellidos2,nombres,nombres2,observacion, ci_e FROM sc_eq_temp ORDER BY apellidos ASC";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;
if($fila==0):
echo "<script languaje='javascript'>
alert('ALERTA: Debe ingresar al menos 1 alumno para poder procesar');
window.opener.location = 'index_0.php';
window.close();
</script>";
//elimino campos sc_temp1
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "DELETE FROM sc_temp1";     
$conex->ExecSQL($mSQL,__LINE__,true);
$ok=$conex->fmodif;
else:?>
<table width="650" border="1" align="center" style="border-collapse: collapse;border-color:black;">

    <td class="datos_tabla"><strong> </strong></div></td>
    <td class="datos_tabla"><strong>EXPEDIENTE</strong></div></td>
    <td class="datos_tabla"><strong>APELLIDOS Y </strong><strong>NOMBRES </strong></td>
	<td class="datos_tabla"><strong>OBSERVACION</strong></td>
	</tr>

<?php for($i=0; $i < count($result); $i++) { ?>
		<tr>
		<td class="datospd"><strong><?php echo $i+1; ?></strong></td>
	    <td class="datospd"><?php echo $result[$i][0]; ?></td>
	    <td class="datospd"><div align="left">    <?php echo $result[$i][1]; ?>  <?php echo $result[$i][2]; ?>  <?php echo $result[$i][3]; ?>  <?php echo $result[$i][4]; ?></div></td>
		<td class="datospd"><?php echo $result[$i][5]; ?></td>
  </tr>
  
<?php $ins=$i+1;} ?>
</table>

<?php 
//Busco datos profesor para mostrar
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT ci,nombre,apellido FROM tblaca007 WHERE ci='$ced'";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$ci=$result[0][0];
$nombre=$result[0][1];
$apellido=$result[0][2];

?>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<p>&nbsp;</p>
<table width="650" border="1" align="center"  style="border-collapse: collapse;border-color:black;">
  <tr>
    <td width="223" class="sub_tabla">PROFESOR:</td>
    <td width="175" class="sub_tabla">Nro. CEDULA </td>
    <td width="225" class="sub_tabla">FIRMA</td>
    <td width="149" class="sub_tabla">FECHA:</td>
  </tr>
  <tr>
    <td height="54" class="datos_tabla"><?php echo $nombre;?>  <?php echo $apellido;?></td>
    <td class="datos_tabla"><?php echo $ci;?></td>
    <td class="datos_tabla">&nbsp;</td>
    <td class="datos_tabla"><p><?php echo date("d/m/Y");?></p>
    </td>
  </tr>
</table>
<table width="650" border="0" align="center"  style="border-collapse: collapse;border-color:black;">
  <tr>
    <td class="sub_tabla"><td id="oculto" colspan="2" align="center"><input type="button" value="IMPRIMIR" onclick="imprimir()">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="SALIR" onclick="proceso();"></td>
    
  </tr>

<?php  include('procesar_all_eq.php'); ?>
</table>

<script type="text/javascript">
function proceso() {
     if (window.confirm("Recuerde imprimir su Acta de Evaluación Final ¿Desea Continuar?")) {
		window.location = 'index_0.php';
	    
	}
}
</script>

<SCRIPT LANGUAGE="JavaScript1.2" TYPE="text/javascript">
<!--
window.onbeforeunload = unloadMess;
function unloadMess(){
	mess = "Recuerde imprimir su Acta de Evaluación Final"
	window.location = 'index_0.php';
	return mess;
    

}
//-->

</SCRIPT>

<?php 
endif;
?>
