<?php
ini_set('max_execution_time','6000');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Sistema de Avance Académico</title>
<!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> -->
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
<link rel="StyleSheet" href="estilos.css" type="text/css"> 
<script language="javascript" src="asrequest.js" type="text/javascript"></script>
<script language="javascript" src="funciones.js" type="text/javascript"></script>
<script language="javascript" src="jquery.js" type="text/javascript"></script>
<script language="javascript" src="tablesort.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
	$(function() {
$("#listado").tablesorter({sortList:[[0,0],[2,1]], widgets: ['zebra']});
}); 
</script>


</head>

<body onLoad="actualizaReloj()">

<?PHP
require_once('inc/config.php');
require_once("inc/odbcss_c.php");
require_once("guardar.php");

if($_SERVER['HTTP_REFERER']!=$raizDelSitio.'planilla_r.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'cante.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'guardar.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'introt.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'cargac.php') die ("<script languaje=\"javascript\"> alert('ACCESO PROHIBIDO!'); </script>");
$nombre=$_POST['nombre'];

?>

<table >
  <tr>
    <td>
	<table border="0" width="100%">
		<tr>
		<td width="125">
		<p align="right" style="margin-top: 0; margin-bottom: 0">
		<img border="0" src="imagenes/unex15.gif" 
		     width="50" height="50"></p></td>
		<td width="500">
		<p class="titulo">
		Universidad Nacional Experimental Polit&eacute;cnica</p>
		<p class="titulo">
		Vicerrectorado Puerto Ordaz</font></p>

		<p class="titulo">
		Unidad Regional de Admisi&oacute;n y Control de Estudios</font></td>
		<td width="125">&nbsp;</td>
		</tr><tr><td colspan="3" style="background-color:#99CCFF;">
		<font style="font-size:2px;">&nbsp; </font></td></tr>
	    </table>	
			</tr>
			<tr>
				<td class="enc_p" colspan="2">SISTEMA DE AVANCE ACADEMICO</td>
			</tr>
	</td>
  </tr>
</td></tr>
<tr>
    <td width="100%" class="datosp">
	<p align="center"><strong><? echo $nombre; ?></strong></p>
	</td>
  </tr>
    <tr>
    <td width="100%" height="88" class="datosp"><p align="center"><strong>BIENVENIDO!!</strong></p>
    <p align="center" class="titulo">Se encuentra en el modulo de visualizacion de actas</p><br><p align="center" class="titulo"> A continuaci&oacute;n se muestra el listado de Docentes y detalle de avance acad&eacute;mico. </p>
	</td>
  </tr>
  <tr>
    <td height="32" class="datosp" align="left">	
<?PHP
$cargo=$_POST['cargo'];
$cedula=$_POST['cedula'];

//print_r ($_POST);

if($cargo==7 || $cargo==17 || $cargo==91 || $cargo==81) {	// Si es Dir. Academico ó
															// Vicerrector ó 
															// Jefatura Planificacion ó
															//  Jefatura URDBE
														
	$cod=123;
}

if($cargo==555) {	// JEFATURA INTENSIVO
	$cod=123;
}

if(($cargo==21) || ($cargo==22) || ($cargo==325)) { // Jefatura Mecanica
	$car=4;
	$cod=124;
}

if(($cargo==31) || ($cargo==32) || ($cargo==335)) { // Jefatura Electrica
	$car=2;
	$cod=124;
}

if(($cargo==41) || ($cargo==42)) { // Jefatura Metalurgica
	$car=5;
	//$cod=123; // Permisologia para jefatura de intensivo
	$cod=124; //Permisologia para lapso normal
}

if($cargo==345) { // Jefatura Metalurgica
	$car=5;
	$cod=124;

}

if(($cargo==51) || ($cargo==52) || ($cargo==355)) { // Jefatura Electronica
	$car=3;
	$cod=124;
}

if(($cargo==61) || ($cargo==62) || ($cargo==365)) { // Jefatura Insdustrial
	$car=6;
	$cod=124;
}

if(($cargo==71) || ($cargo==72) || ($cargo==315)) { // Jefatura Est. Generales
	$car=1;
	$cod=124;
}

if($cod==123) { 

?><br>
<select name="selectca" id="selectca" class="select.peq" OnChange="fajax('guardar.php','materias','codigos=112232&carrera='+this.value+'','post','0');">
            <option value="0" selected="selected">&lt;&lt; Especialidad &gt;&gt;</option>
			<option value="1" > Estudios Generales </option>
			<option value="2" > Electrica </option>
			<option value="3" > Electronica </option>
			<option value="4" > Mecanica </option>
			<option value="5" > Metalurgica </option>
			<option value="6" > Industrial </option>
          </select><br><br>
<div id="materias"></div>
<?PHP
}
?>	
<?PHP
if($cod==124) {
$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,'consulta_avance_'.date(m).'-'.date(Y).'.log');

$aSQL = "select acta,a.c_asigna,lapso,asignatura from D_TEMAS a, TBLACA008 b where a.c_asigna=b.c_asigna AND lapso='".$lapsoProceso."' and ";

switch ($car) {
	case 1:
		$aSQL.= "a.C_ASIGNA like '30%' AND a.c_asigna NOT IN ('300213','300313') ";
		break;
	case 2:
		$aSQL.= "a.C_ASIGNA like '31%'";
		break;
	case 3:
		$aSQL.= "((a.C_ASIGNA like '35%') OR (a.c_asigna = '300213' or a.c_asigna='300313'))";
		break;
	case 4:
		$aSQL.= "a.C_ASIGNA like '32%'";
		break;
	case 5:
			$aSQL.= "a.C_ASIGNA like '33%'";
		break;
	case 6:
		$aSQL.= "a.C_ASIGNA like '34%'";
		break;
}

$aSQL.= " AND acta IN (SELECT acta FROM tblaca004 WHERE lapso='".$lapsoProceso."') ";

$aSQL.= " UNION ";

$aSQL.= "SELECT acta,a.c_asigna,lapso,asignatura FROM tblaca004 a, tblaca008 b WHERE a.c_asigna=b.c_asigna AND lapso='".$lapsoProceso."' AND  ";

switch ($car) {
	case 1:
		$aSQL.= "a.C_ASIGNA like '30%' AND a.c_asigna NOT IN ('300213','300313') ";
		break;
	case 2:
		$aSQL.= "a.C_ASIGNA like '31%'";
		break;
	case 3:
		$aSQL.= "((a.C_ASIGNA like '35%') OR (a.c_asigna = '300213' or a.c_asigna='300313'))";
		break;
	case 4:
		$aSQL.= "a.C_ASIGNA like '32%'";
		break;
	case 5:
		$aSQL.= "a.C_ASIGNA like '33%'";
		break;
	case 6:
		$aSQL.= "a.C_ASIGNA like '34%'";
		break;
}

$aSQL.= " AND ci <> '.' AND ACTA NOT IN (SELECT ACTA FROM D_TEMAS WHERE LAPSO = '".$lapsoProceso."' ) ";
$aSQL.= " ORDER BY 4 ";

$conex->ExecSQL($aSQL,__LINE__,true);
$resultado = $conex->result;

			$mSQL = "SELECT distinct c.asignatura,a.c_asigna,b.pensum ";
			$mSQL.= "FROM tblaca004 a,tblaca009 b,tblaca008 c ";
			$mSQL.= "WHERE a.lapso='".$lapsoProceso."' AND  ";

			switch ($car) {
				case 1:
					$mSQL.= "a.c_asigna like '30%' AND a.c_asigna in (SELECT c_asigna FROM D_TEMAS WHERE lapso='".$lapsoProceso."' and c_asigna like '30%') AND a.c_asigna NOT IN ('300213','300313') ";
					break;
				case 2:
					$mSQL.= "a.c_asigna like '31%' AND a.c_asigna in (SELECT c_asigna FROM D_TEMAS WHERE lapso='".$lapsoProceso."' and c_asigna like '31%') ";
					break;
				case 3:
					$mSQL.= "(a.c_asigna like '35%' OR a.c_asigna = '300213' or a.c_asigna='300313') AND a.c_asigna in (SELECT c_asigna FROM D_TEMAS WHERE lapso='".$lapsoProceso."' AND (c_asigna like '35%' OR c_asigna = '300213' or c_asigna='300313')) ";
					break;
				case 4:
					$mSQL.= "a.c_asigna like '32%' AND a.c_asigna in (SELECT c_asigna FROM D_TEMAS WHERE lapso='".$lapsoProceso."' and c_asigna like '32%') ";
					break;
				case 5:
					$mSQL.= "a.c_asigna like '33%' AND a.c_asigna in (SELECT c_asigna FROM D_TEMAS WHERE lapso='".$lapsoProceso."' and c_asigna like '33%') ";
					break;
				case 6:
					$mSQL.= "a.c_asigna like '34%' AND a.c_asigna in (SELECT c_asigna FROM D_TEMAS WHERE lapso='".$lapsoProceso."' and c_asigna like '34%') ";
					break;
			}

			$mSQL.= "and b.pensum='5' and c.c_asigna=a.c_asigna and b.c_asigna=c.c_asigna order by c.asignatura ";

//			echo $mSQL;

			
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;

if (count($resultado) > 0){
//echo count($resultado);

# encabezado tabla
print <<<TABLA01
		<span style="width:100%;text-align:center;color:blue;font-weight:bold;">Presione sobre el encabezado de la columna para ordenar</span>
		<table cellpadding="0" cellspacing="0" border="1" width="100%" id="listado" class="tablesorter">
		<thead>
			<tr style="font-weight:bold;background-color:#000000;color:#FFFFFF;font-size:12px;border-collapse:collapse;">
				<th style="padding-top:3px;padding-bottom:3px;">NRO</th>
				<th style="padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;">ACTA</th>
				<th style="padding-top:3px;padding-bottom:3px;">CI</th>
				<th style="padding-top:3px;padding-bottom:3px;">NOMBRE</th>
				<th style="padding-top:3px;padding-bottom:3px;">ASIGNATURA</th>
				<th style="padding-top:3px;padding-bottom:3px;">SECCION</th>
				<th style="padding-top:3px;padding-bottom:3px;">ULTIMA CARGA</th>
				<th style="padding-top:3px;padding-bottom:3px;">&nbsp;% CARGA</th>
			</tr>
		</thead>
		<tbody>
TABLA01;

//print_r($resultado);

for ($i=0;$i < count($resultado);$i++){
	
	$dSQL = "select distinct a.ci,apellido,nombre,asignatura,seccion,a.acta ";
	$dSQL.= "from TBLACA004 a, TBLACA007 b, TBLACA008 c, D_TEMAS d ";
	$dSQL.= "where a.ACTA='".$resultado[$i][0]."' and a.LAPSO='".$resultado[$i][2]."' ";
	$dSQL.= "and c.C_ASIGNA='".$resultado[$i][1]."' and a.CI=b.CI ";
	//$dSQL.= " ";
	@$conex->ExecSQL($dSQL,__LINE__,true);

	$conex->result[0][3] = utf8_encode($conex->result[0][3]);
	$nomape	= utf8_encode($conex->result[0][1].", ".$conex->result[0][2]);

	$nro = $i+1;

	if ($nro % 2){
		$bgcolor = "#FFFFFF";
	}else{
		$bgcolor = "#CEE7FF";
	}
	$nomape = substr($nomape,0,25);

	$nasig = substr($conex->result[0][3],0,25);

print <<<TABLA02
		<tr style="background-color:$bgcolor;font-size:11px;" onmouseover="this.style.backgroundColor='#FFFF99'" onmouseout="this.style.backgroundColor='$bgcolor'">
			<td style="background-color:#FFFFCC;padding-top:3px;padding-bottom:3px;font-weight:bold;">$nro</td>
			<td>{$conex->result[0][5]}</td>
			<td>{$conex->result[0][0]}</td>
			<td style="text-align:justify;padding-left:10px;font-size:10px;">{$nomape}</td>
			<td style="text-align:justify;padding-left:10px;padding-rigth:5px;font-size:10px;">{$nasig}</td>
			<td>{$conex->result[0][4]}</td>
TABLA02;

			$acta = $conex->result[0][5];
			
			$mSQL = "SELECT ucca FROM n_estu WHERE acta='".$acta."' AND lapso='".$lapsoProceso."' ";
			$conex->ExecSQL($mSQL);
			$ultima = $conex->result[0][0];

			if($ultima > 0){ # Si ha cargado al menos una calificacion

				$back = " ";

				# Busca fecha de ultima carga
				$mSQL = "SELECT fecha_".$ultima." FROM fechas_av WHERE acta='".$acta."' AND lapso='".$lapsoProceso."' ";
				$conex->ExecSQL($mSQL,__LINE__,true);
				$fecha = implode("/", array_reverse(explode("-", $conex->result[0][0])));

				#Busca porcentaje cargado
				
				for($x=1;$x <= $ultima;$x++){
					//$ultima .= ",".$x;
					$mSQL = "SELECT porc".$x." FROM d_temas WHERE acta='".$acta."' AND lapso='".$lapsoProceso."' ";
					$conex->ExecSQL($mSQL);
					$suma += $conex->result[0][0];					
				}
			}else{
				$mSQL = "SELECT c_asigna FROM d_temas WHERE acta='".$acta."' AND lapso='".$lapsoProceso."' ";
				$conex->ExecSQL($mSQL);

				if ($conex->filas > 0){
					$back = " ";
					$fecha = 'PLAN CARGADO';
					$suma = 0;					
				}else{
					$back = '#FFCC00';
					$fecha = 'NO HA CARGADO';
					$suma = 0;
				}				
			}

			if (($suma < 10) && ($suma > 0)) {
				$suma = "0".$suma;
			}

			if ($suma <= 15) {
				$bgsuma = "#FF491C";
			}else if (($suma > 15) && ($suma < 30)){
				$bgsuma = "#FF9933";				
			}else if (($suma >= 30) && ($suma <= 45)){
				$bgsuma = "#FFFF00";		
			}else if (($suma > 45) && ($suma < 60)){
				$bgsuma = "#9DFD3E";
			}else if (($suma >= 60) && ($suma < 75)){
				$bgsuma = "#02B089";
			}else if (($suma >= 75) && ($suma < 90)){
				$bgsuma = "#02A4B0";
			}else if ($suma >= 90) {
				$bgsuma = "#4799FE";
			}

/*print <<<TABLA022
		<td style="text-align:center;padding-right:5px;padding-left:5px;font-size:10px;">
			<div style="background:$back">$fecha</div>
		</td>
		<td style="text-align:center;">
			<div style="width: 16em;border: 1px solid black;background: #eef;height: 1.25em;display: block;">
				<div style="position: absolute;font-size: 1em;width: 16em;text-align: center;font-weight: normal;">
					$suma % completado
				</div>
				<div style="height: 100%;background-color: $bgsuma;display: block;overflow: visible; width: $suma%;">
				</div>
			</div>
		</td>
	</tr>
TABLA022;*/

print <<<TABLA022
		<td style="text-align:center;padding-right:5px;padding-left:5px;font-size:10px;">
			<div style="background:$back">$fecha</div>
		</td>
		<td style="text-align:center;font-size:10px;">
			
					$suma % completado
			
		</td>
	</tr>
TABLA022;

$suma = 0;
	
}// Fin for

print <<<TABLA03
		</tbody>
		</table>
TABLA03;

?>
<br>
<select name="selectma" id="selectma" class="select.peq" OnChange="fajax('guardar.php','ttt','codigos=112233&c_asigna='+this.value+'','post','0');">
            <option value="" selected="selected">&lt;&lt; Seleccione la asignatura que desee consultar &gt;&gt;</option>
			<?PHP 
			$cantalu=0;
			while($result[$cantalu][0]!=NULL)
				{
				echo '<option value="'.$result[$cantalu][1].'">'.utf8_encode($result[$cantalu][0]).'</option>'; 
				$cantalu++;
				} 
			?>
          </select><br><br>
		  
<div id="ttt"> </div>

<?PHP
	}else{
		print <<<TABLA01
		<table cellpadding="0" cellspacing="0" border="1" width="100%">
		<tr>
			<td style="background-color:#FFFFFF;font-weight:bold;">
			NO HAY AVANCES ACAD&Eacute;MICOS CARGADOS EN ESTE DEPARTAMENTO.
			</td>
		</tr>
		</table>
TABLA01;

	}// Fin no hay avances cargados
}
?>	
  </td>
  </tr>
  <tr><td class="datosp">
  <div id="visual"></div>
  </td>
  </tr>
  <tr><td class="datosp">
  
          <input type="button" name="imprimir" value="Imprimir" class="boton" style="background:#FFFF33; color:black; font-family:arial; font-weight:bold;" onclick="window.print();">
		  &nbsp;&nbsp;&nbsp;<input type="button" value="Salir" name="B1" class="boton" onclick="self.close();">

    </td>
  </tr>
</table>
</body>
</html>
