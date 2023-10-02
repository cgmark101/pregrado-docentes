<?php 
//session_start();

ini_set('display_errors','On');

error_reporting(E_ALL);
include_once('inc/config.php');
require_once('inc/odbcss_c.php');
include('encabezado.php'); 


if(empty($orden)) {
	$orden='3';
} else {
	$orden=$_POST['orden'];
}

if(empty($_POST['B1'])){
	$B1='1';
	$fecha=date('Y-m-d');
	$fecha2=date('Y-m-d');
	$boton='1';
} else {
	$boton=$_POST['B1'];
}

if($boton==1) {
	$chec1='CHECKED';
	$chec2=' ';
}

if(empty($_POST['lap'])) {
	$lap=$tLapso;
} else {
	$lap=$_POST['lap'];
}

//print_r($_POST);

?>

<div id="midiv" style="position:absolute; left:30%; top:290px; width:380px; height:120px;">
<center>
<table border="0" align="center" cellpadding="6" cellspacing="0" style="font-family:Arial, Verdana; border: 2px solid #FFFFFF;">
	<tr>
		<td style="text-align:center; background-color:#FFFFFF">
			<IMG SRC="imagenes/loading.gif" WIDTH="80" HEIGHT="80" BORDER="0" ALT="">
		</td>
		<td style="text-align:center; background-color:#FFFFFF">
			<font style="font-size:28px; color:#000000; text-align:center;">Cargando... Por Favor Espere</font>
		</td>
	</tr>
</table>
</center>
</div>

<?php 
if ($_POST['B1'] == 1) { // SI busca por lapso
	include("menu_opciones.php"); 

?>

<table width="700" border="0" align="center">
<?php
	/*if(($user=='0') OR ($user=='700')){
		echo '<tr><td colspan="7"><a class=inact2><span>LAS ACTAS DE PRÁCTICA PROFESIONAL CARGADAS POR EXPERIENCIA PROFESIONAL O QUE EL ESTUDIANTE POSEA TÍTULO DE T.S.U. TIENEN UN ASTERISO (*) PARA IDENTIFICARLAS.</span></td></tr>';
	} */
?>
	<tr>
		<td colspan="6" class="sub_tabla" >
			<p>&nbsp;</p>
			<p>
				Actas Cargadas <?php //echo $user; ?>
				<br />
				Asignaturas que puede seleccionar:
			</p>
		</td>

	<form method=post action="v_acta_orden.php">
		<td class="datosp" WIDTH="20"><strong>ORDENAR POR:<br />
			<SELECT name="orden">
				<OPTION VALUE="1" SELECTED>ESPECIALIDAD</OPTION>
				<OPTION VALUE="2">SECCIÓN</OPTION>
				<OPTION VALUE="3">ACTA</OPTION>
				<OPTION VALUE="4">ASIGNATURA</OPTION>
				<OPTION VALUE="5">LAPSO</OPTION>
				<OPTION VALUE="7">FECHA</OPTION>
			</SELECT></strong>
			<br />
			<input type="submit" value="ordenar" class="boton"><input type="hidden" value="<?php echo $lap; ?>" name="lap" class="boton"><input type="hidden" value="<?php echo $boton; ?>" name="b1" class="boton"></form>
		</td>
	</tr>
	<tr>
		<form method=post name="mostrar" action="v_acta.php" target="reporte_acta">
		<td class="enc_p" align="center"><strong>FECHA</strong></td>
		<td class="enc_p" align="center"><strong>LAPSO</strong></td>
		<td align="center" class="enc_p">C&Oacute;DIGO</td>
		<td align="center" class="enc_p">ESPECIALIDAD</td>
		<td class="enc_p" align="center">ASIGNATURA</td>
		<td class="enc_p" align="center">SECCI&Oacute;N </td>
		<td class="enc_p2" align="center">N&Uacute;MERO DE ACTA  </td>
	  </tr>
<?php
if($user=='0') {
	$dSQL="SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,d.his_fec,e.carrera1  
	FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
	WHERE d.his_lap='$lap' and a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and e.c_uni_ca=b.c_uni_ca
	UNION
	SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,d.his_fec,e.carrera1    
	FROM dace004 a,tblaca009 b,tblaca008 c,his_act d,tblaca010 e
	WHERE d.his_lap='$lap' and a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and a.c_asigna='300622' and b.c_asigna=c.c_asigna AND e.c_uni_ca='5' ORDER BY $orden DESC";
} else if($user=='700') {

	$dSQL="SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,a.status,d.his_fec,e.carrera1 FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and b.c_asigna='322939' and e.c_uni_ca=b.c_uni_ca and d.his_lap='$lap' 
	UNION
	SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,a.status,d.his_fec,e.carrera1
	FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
	WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and a.c_asigna='311939' and e.c_uni_ca=b.c_uni_ca and d.his_lap='$lap'
	UNION
	SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,a.status,d.his_fec,e.carrera1 
	FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
	WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and a.c_asigna='333939' and e.c_uni_ca=b.c_uni_ca and d.his_lap='$lap'
	UNION
	SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,a.status,d.his_fec,e.carrera1 
	FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
	WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and a.c_asigna='355069' and e.c_uni_ca=b.c_uni_ca and d.his_lap='$lap'
	UNION
	SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,a.status,d.his_fec,e.carrera1
	FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
	WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and a.c_asigna='344939' and e.c_uni_ca=b.c_uni_ca and d.his_lap='$lap'
	ORDER BY $orden DESC";

} else if($user=='75') {
	$dSQL="SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,d.his_fec,e.carrera1 FROM dace004 a,tblaca009 b,tblaca008 c,his_act d,tblaca010 e
	WHERE d.his_lap='$lap' and a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and a.c_asigna='300622' and b.c_asigna=c.c_asigna AND e.c_uni_ca='5' ORDER BY $orden DESC";
} else { // trabajo de grado 
	$dSQL="SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,d.his_fec,e.carrera1 
	FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
	WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and b.c_asigna='322040' and e.c_uni_ca=b.c_uni_ca and d.his_cod='$c_asignad' and d.his_lap='$lap'
	UNION
	SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,d.his_fec,e.carrera1
	FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
	WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and a.c_asigna='311040' and e.c_uni_ca=b.c_uni_ca and d.his_cod='$c_asignad' and d.his_lap='$lap'
	UNION
	SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,d.his_fec,e.carrera1 
	FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
	WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and a.c_asigna='333040' and e.c_uni_ca=b.c_uni_ca and d.his_cod='$c_asignad' and d.his_lap='$lap'
	UNION
	SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,d.his_fec,e.carrera1 
	FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
	WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and a.c_asigna='355959' and e.c_uni_ca=b.c_uni_ca and d.his_cod='$c_asignad' and d.his_lap='$lap'
	UNION
	SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,d.his_fec,e.carrera1
	FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
	WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and a.c_asigna='344040' and e.c_uni_ca=b.c_uni_ca and d.his_cod='$c_asignad' and d.his_lap='$lap'
	ORDER BY $orden DESC";
}

//Se consultan las actas de las obligatorias en his_act
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = $dSQL;
$conex->ExecSQL($mSQL,__LINE__,false);

$result = $conex->result;

for($i=0; $i < count($result); $i++) {
	$cod[$i]=$result[$i][0];
	$sec[$i]=$result[$i][1];
	$act[$i]=$result[$i][2];
	$asigna[$i]=$result[$i][3];
	$lapso[$i]=$result[$i][4];
	$fec[$i]=$result[$i][6];
	@$especial[$i]=$result[$i][7];
	$fec[$i]=implode('/',array_reverse(explode('-',$fec[$i])));

	if (($user=='0') or ($user=='700')) {
		


		$status[$i]=$result[$i][5];

		if($status[$i]=='3') {
			$status[$i]='(*)';
		} else {
			$status[$i]=' ';
		}
	} else {
		$status[$i]=' ';
	}
	
	if ($cod[$i]=='300622') {
		$especial[$i]='COMÚN';
	} else {
		@$especial[$i]=$result[$i][7];
	}

?>	<tr>
		<td class="datosp"><?php echo $fec[$i];?></td>
		<td class="datosp"><?php echo $lapso[$i];?></td>
		<td class="datosp"><strong><?php echo $cod[$i]; ?></strong></td>
		<td class="datosp"><?php echo $especial[$i];?></td>
		<td class="datosp"><span class="alert2"><a class=Ntooltip><?php echo $status[$i]; ?><span>ACTA CARGADA POR EXPERIENCIA PROFESIONAL</span></span><?php echo $asigna[$i];?></td>
		<td class="datosp"><?php  echo $sec[$i];  ?></td>
		<td class="inact2"><input type="radio" name="acta" value="<?php  echo $act[$i];echo '_'; echo $lapso[$i]; echo '_'; echo $cod[$i]; ?>"><?php  echo $act[$i]; ?></td>
	</tr>
<?php } ?>
	 </tr>
	  <table width="800" border="0" align="center">
	<tr>
	<td class="datospd">
		<INPUT TYPE="submit" value="Ver Acta" name="MOSTRAR" class="boton" onclick="ver_acta(this.form)">
		<input value="<?php echo $ced; ?>" name="ced" type="hidden"> 
	</td>
	</tr>
</table>
</form>

<?php
} else {



$chec2='CHECKED';
$chec1=' ';
$fecha=$_POST['fecha'];
//echo $fecha;
//echo '<br />';

$fecha2=$_POST['fecha2'];
//echo $fecha2;
 include("menu_opciones.php")?>

<table width="700" border="0" align="center">
  <tr>
   
   </tr>
  <tr>
  <td colspan="6" class="sub_tabla" ><p>&nbsp;</p>
	
    <p>Actas Cargadas <br />
      Asignaturas que puede seleccionar: </p>
  </div></td>
  <FORM METHOD=POST ACTION="v_acta_orden.php">
  
  <td class="datosp" WIDTH="20"><strong>ORDENAR POR:<br /><SELECT name="orden">
	<OPTION VALUE="1" SELECTED>ESPECIALIDAD</OPTION>
	<OPTION VALUE="2">SECCIÓN</OPTION>
	<OPTION VALUE="3">ACTA</OPTION>
	<OPTION VALUE="4">ASIGNATURA</OPTION>
    <OPTION VALUE="5">LAPSO</OPTION>
	<OPTION VALUE="7">FECHA</OPTION>
  </SELECT></strong><br /><INPUT TYPE="submit" value="Ordenar" class="boton"><INPUT TYPE="HIDDEN" value="<?php echo $fecha; ?>" name="fecha" class="boton"><INPUT TYPE="HIDDEN" value="<?php echo $fecha2; ?>" name="fecha2" class="boton"><INPUT TYPE="HIDDEN" value="<?php echo $boton; ?>" name="B1" class="boton"></FORM></td>
  </tr>

 <tr>
   <FORM METHOD=POST NAME="MOSTRAR" ACTION="v_acta.php" target="reporte_acta">
	<td class="enc_p" align="center"><strong>FECHA</strong></td>
    <td class="enc_p" align="center"><strong>LAPSO</strong></td>
	<td align="center" class="enc_p">C&Oacute;DIGO</td>
	<td align="center" class="enc_p">ESPECIALIDAD</td>
    <td class="enc_p" align="center">ASIGNATURA</td>
    <td class="enc_p" align="center">SECCI&Oacute;N </td>
    <td class="enc_p2" align="center">N&Uacute;MERO DE  ACTA  </td>
  </tr>
  <?php


  if($user=='0'):
$dSQL="SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,d.his_fec,e.carrera1  
FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
WHERE d.his_fec BETWEEN '$fecha' AND '$fecha2' and a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and e.c_uni_ca=b.c_uni_ca
UNION
SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,d.his_fec,e.carrera1    
FROM dace004 a,tblaca009 b,tblaca008 c,his_act d,tblaca010 e
WHERE d.his_fec BETWEEN '$fecha' AND '$fecha2' and a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and a.c_asigna='300622' and b.c_asigna=c.c_asigna AND e.c_uni_ca='5' ORDER BY $orden DESC";

elseif($user=='700'):

$dSQL="SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,d.his_fec,e.carrera1 
FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and b.c_asigna='322939' and e.c_uni_ca=b.c_uni_ca and d.his_fec BETWEEN '$fecha' AND '$fecha2'
UNION
SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,d.his_fec,e.carrera1
FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and a.c_asigna='311939' and e.c_uni_ca=b.c_uni_ca and d.his_fec BETWEEN '$fecha' AND '$fecha2'
UNION
SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,d.his_fec,e.carrera1 
FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and a.c_asigna='333939' and e.c_uni_ca=b.c_uni_ca and d.his_fec BETWEEN '$fecha' AND '$fecha2'
UNION
SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,d.his_fec,e.carrera1 
FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and a.c_asigna='355069' and e.c_uni_ca=b.c_uni_ca and d.his_fec BETWEEN '$fecha' AND '$fecha2'
UNION
SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,d.his_fec,e.carrera1
FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and a.c_asigna='344939' and e.c_uni_ca=b.c_uni_ca and d.his_fec BETWEEN '$fecha' AND '$fecha2'
ORDER BY $orden DESC";

elseif($user=='75'):
$dSQL="SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,a.status,d.his_fec,e.carrera1 FROM dace004 a,tblaca009 b,tblaca008 c,his_act d,tblaca010 e
WHERE d.his_fec BETWEEN '$fecha' AND '$fecha2' and a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and a.c_asigna='300622' and b.c_asigna=c.c_asigna AND e.c_uni_ca='5' ORDER BY $orden DESC";

else: // trabajo de grado 

$dSQL="SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,d.his_fec,e.carrera1 
FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and b.c_asigna='322040' and e.c_uni_ca=b.c_uni_ca and d.his_cod='$c_asignad' and d.his_fec BETWEEN '$fecha' AND '$fecha2'
UNION
SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,d.his_fec,e.carrera1
FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and a.c_asigna='311040' and e.c_uni_ca=b.c_uni_ca and d.his_cod='$c_asignad' and d.his_fec BETWEEN '$fecha' AND '$fecha2'
UNION
SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,d.his_fec,e.carrera1 
FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and a.c_asigna='333040' and e.c_uni_ca=b.c_uni_ca and d.his_cod='$c_asignad' and d.his_fec BETWEEN '$fecha' AND '$fecha2'
UNION
SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,d.his_fec,e.carrera1 
FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and a.c_asigna='355959' and e.c_uni_ca=b.c_uni_ca and d.his_cod='$c_asignad' and d.his_fec BETWEEN '$fecha' AND '$fecha2'
UNION
SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,d.his_fec,e.carrera1
FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and a.c_asigna='344040' and e.c_uni_ca=b.c_uni_ca and d.his_cod='$c_asignad' and d.his_fec BETWEEN '$fecha' AND '$fecha2'
ORDER BY $orden DESC";
endif;

//Se consultan las actas de las obligatorias en his_act
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = $dSQL;
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;

for($i=0; $i < count($result); $i++) {
	$cod[$i]=$result[$i][0];
	$sec[$i]=$result[$i][1];
	$act[$i]=$result[$i][2];
	$asigna[$i]=$result[$i][3];
	$lapso[$i]=$result[$i][4];
	$fec[$i]=$result[$i][5];

	
	/*$sql = "SELECT DISTINCT status ";
	$sql.= "FROM dace004 a, his_act b ";
	$sql.= "WHERE a.acta=".$act[$i]." AND a.lapso=".$lapso[$i]." AND a.acta=b.his_act ";
	$sql.= "AND a.lapso=b.his_lap AND a.c_asigna=b.his_cod AND b.his_cod=".$cod[$i]." ";
	
	$conex->ExecSQL($sql,__LINE__,false);

	echo $sql;
	
	$result[$i][7] = $conex->result[0][0];*/
		
	$especial[$i]=$result[$i][6];

	$fec[$i]=implode('/',array_reverse(explode('-',$fec[$i])));

	if(($user=='0') or ($user=='700')):
		$status[$i]=$result[$i][5];
		if($status[$i]=='3'):
			$status[$i]='(*)';
		else:
			$status[$i]=' ';
		endif;
	else:
		$status[$i]=' ';
	endif;
	
	if($cod[$i]=='300622'):
		$especial[$i]='COMÚN';
	else:
		$especial[$i]=$result[$i][6];
		
	endif;

?><tr>
	<td class="datosp"><?php echo $fec[$i];?></td>
	<td class="datosp"><?php echo $lapso[$i];?></td>
	<td class="datosp"><strong><?php echo $cod[$i]; ?></strong></td>
	<td class="datosp"><?php echo $especial[$i];?></td>
		  <td class="datosp"><span class="alert2"><a class=Ntooltip><?php echo $status[$i]; ?><span>ACTA CARGADA POR EXPERIENCIA PROFESIONAL</span></span><?php echo $asigna[$i];?></td>
		  <td class="datosp"><?php  echo $sec[$i];  ?></td>
          <td class="inact2"><INPUT TYPE="radio" NAME="acta" VALUE="<?php  echo $act[$i];echo '_'; echo $lapso[$i]; echo '_'; echo $cod[$i]; ?>"><?php  echo $act[$i]; ?></td>
          
  </tr>

<?php } ?>
	  <table width="800" border="0" align="center">
<tr>
<td class="datospd">                  
                                 
                  
                        <INPUT TYPE="submit" value="Ver Acta" name="MOSTRAR"
							class="boton" onclick="ver_acta(this.form)">
							<input value="<?php echo $ced; ?>" name="ced" type="hidden"> 	                       
                   
				
   
			

</td>
</tr>
</table>
</FORM>
</table>	

<?php } ?>

 




			
		
<p class="titulo_tabla">
<SCRIPT LANGUAGE="javascript">
if(!document.layers)
midiv.style.visibility='hidden';
else
document.midiv.visibility='hide';
</SCRIPT> 

  <SCRIPT LANGUAGE="JavaScript">
<!--

	function validarN(campo) {

			var cadena = campo.value;
			var nums="1234567890";
			var i=0;
			var cl=cadena.length;
			while(i < cl)  {
				cTemp= cadena.substring (i, i+1);
				if (nums.indexOf (cTemp, 0)==-1) {
					cadT = cadena.split(cTemp);
					var cadena = cadT.join("");
					campo.value=cadena;
					i=-1;
					cl=cadena.length;
				}
				i++;
			}
		}

	function checkFields() {
		missinginfo = "";
		if (document.cacta.acta.value == "") {
			missinginfo += "\n     -  Acta";
		}
		if (missinginfo != "") {
			missinginfo ="EL NÚMERO DE ACTA ES REQUERIDO PARA CONTINUAR";
			alert(missinginfo);
			return false;
		}
		else return true;
		}
//-->
</SCRIPT>
</p>