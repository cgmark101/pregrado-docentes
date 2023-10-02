<?php

//Se consultan los datos en his_act 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT a.his_ced, a.his_lap, a.his_cod, a.his_sec, a.his_fec, b.asignatura FROM his_act a, tblaca008 b WHERE a.his_act='$acta' AND a.his_cod=b.c_asigna and a.his_cod='$cod' and a.his_lap='$lap'";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$ci=$result[0][0];
$lapso=$result[0][1];
$c_asigna=$result[0][2];
$sec=$result[0][3];
$fec=$result[0][4];
$asigna=$result[0][5];
$fec=implode('/',array_reverse(explode('-',$fec)));
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
      Unidad Regional de Admisi&oacute;n y Control de Estudios</strong><br /> 
        ACTA DE EVALUACI&Oacute;N FINAL </p>
    </div></td>
    <td width="102"><p align="left" class="datos_tabla Estilo2"><span class="Estilo4">Fecha:<strong> <?php echo $fec;?></strong></span><br />
    </p>
      <p class="datos_tabla"><br />
    </p></td>
  </tr>
  <tr>
    <td class="datos_tabla"><div align="left">C&Oacute;DIGO:<strong><?php echo $c_asigna; ?></strong></div></td>
    <td><div align="center" class="enc_materias Estilo1"><?php echo $asigna; ?> </div></td>
    <td class="datos_tabla"><div align="left">LAPSO:<strong><?php echo $lapso; ?></strong></div></td>
  </tr>
  <tr>
    <td class="datos_tabla"><div align="left">SECCI&Oacute;N:<strong><?php echo $sec; ?></strong></div></td>
    <td>&nbsp;</td>
    <td class="datos_tabla"><div align="left">ACTA:<strong><?php echo $acta;?></strong></div></td>
  </tr>
</table>

<?php //consultar alumnos del acta  
include_once('inc/config.php');
require_once('inc/odbcss_c.php');
require("funciones.php");




//consultar alumnos en dace004
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT a.exp_e,a.acta,a.c_asigna,a.lapso,b.apellidos,b.apellidos2,b.nombres,b.nombres2 FROM dace004 a, dace002 b WHERE a.acta='$acta' and a.exp_e=b.exp_e and a.lapso='$lap' and a.c_asigna='$cod'";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
//vacio result en exp_e como un array 
for($i=0; $i < count($result); $i++) {
	$exp_e[$i]=$result[$i][0];
	$apellidos[$i]=$result[$i][4];
	$apellidos2[$i]=$result[$i][5];
	$nombres[$i]=$result[$i][6];
	$nombres2[$i]=$result[$i][7];
	$obs[$i]='APROBADO';
}


?>
<table width="650" border="1" align="center" style="border-collapse: collapse;border-color:black;">

    <td class="datos_tabla"><strong> </strong></div></td>
    <td class="datos_tabla"><strong>EXPEDIENTE</strong></div></td>
    <td class="datos_tabla"><strong>APELLIDOS Y </strong><strong>NOMBRES </strong></td>
	<td class="datos_tabla"><strong>OBSERVACION</strong></td>
	</tr>
  <?php for($i=0; $i < count($exp_e); $i++) { ?>
		<tr>
		  <td class="datospd"><strong><?php echo $i+1; ?></strong></td>
		  <td class="datospd"><?php echo $exp_e[$i]; ?></td>
		  <td class="datospd"><div align="left">   <?php echo $apellidos[$i]; echo ' '; ?><?php echo $apellidos2[$i]; echo ' ';  ?><?php echo $nombres[$i]; echo ' '; ?><?php echo $nombres2[$i]; ?> </div></td>
		  <td class="datospd"><?php echo $obs[$i]; ?></td>
  </tr>
  
<?php } ?>
</table>
<?php
//Busco datos profesor para mostrar
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT ci,nombre,apellido FROM tblaca007 WHERE ci='$ci'";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
//$ci=$result[0][0];
$nombre=$result[0][1];
$apellido=$result[0][2];

//footer 
$ciclo=10;
for($i=0; $i < $ciclo; $i++){
echo ' ';
echo '<br>';
}
include('v_acta_foot.php');

?>


