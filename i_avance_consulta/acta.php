<?php
ini_set('max_memory','42M');
#incluimoa el archivo config que contiene las variables globales.
require('inc/config.php');
require('inc/odbcss_c.php');

#manejador de la conexion
$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);

/****** Variables necesarias *******/

# fecha
$fecha		= date('Y-m-d', time() - 3600*date('I'));

#hora
$h = "4.5";
$hm = $h*60;
$ms = $hm*60;
$hora		= gmdate("g:i a",time()-($ms));

# Numero de acta
$acta		=	$_POST['acta'];

# Lapso actual
$lapso		=	$lapsoProceso;

# Busco cedula, seccion y codigo del acta
$mSQL = "SELECT his_ced, his_sec, his_cod FROM his_act WHERE ";
$mSQL.= "his_act='".$acta."' AND his_lap='".$lapso."'";
$conex->ExecSQL($mSQL,__LINE__,true);
$notasOK = false;


$cedula		= $conex->result[0][0]; //cedula docente
$seccion	= $conex->result[0][1]; //seccion
$c_asigna	= $conex->result[0][2]; //codigo asignatura

// Convierte el numero mes a nombre mes
function Mes_Txt($Numero){
	if ($Numero == 01){return "Enero";}
	if ($Numero == 02){return "Febrero";}
	if ($Numero == 03){return "Marzo";}
	if ($Numero == 04){return "Abril";}
	if ($Numero == 05){return "Mayo";}
	if ($Numero == 06){return "Junio";}
	if ($Numero == 07){return "Julio";}
	if ($Numero == '08'){return "Agosto";}
	if ($Numero == '09'){return "Septiembre";}
	if ($Numero == 10){return "Octubre";}
	if ($Numero == 11){return "Noviembre";}
	if ($Numero == 12){return "Diciembre";}
}
	# Busco el nombre de la asignaturas segun codigo
	$mSQL = "SELECT asignatura FROM tblaca008 WHERE c_asigna='".$c_asigna."'";
	$conex->ExecSQL($mSQL,__LINE__,true);

	$asignatura = $conex->result[0][0];

	//Lista de Estudiantes

		# Busco cantidad de evaluaciones para acta en el lapso
		$mSQL = "SELECT cant_eva FROM d_temas WHERE acta='".$acta."' AND lapso='".$lapso."'";
		$conex->ExecSQL($mSQL,__LINE__,true);
		$cant_eva = $conex->result[0][0];

		# Total de notas a seleccionar de tabla n_estu
		for ($i=1;$i<=$cant_eva;$i++){
			$selec.= "nota".$i.",";
		}

		$mSQL = "SELECT a.exp_e,apellidos||' '||apellidos2||' '||nombres||' '||nombres2,".$selec."total100,total9,a.status ";
		$mSQL.= "FROM n_estu a, dace002 b ";
		$mSQL.= "WHERE acta='".$acta."' AND lapso='".$lapso."' ";
		$mSQL.= "AND a.exp_e=b.exp_e ";
		$mSQL.= "UNION ";
		$mSQL.= "SELECT a.exp_e,apellidos||' '||nombres,".$selec."total100,total9,a.status ";
		$mSQL.= "FROM n_estu a, dace002_grad b ";
		$mSQL.= "WHERE acta='".$acta."' AND lapso='".$lapso."' ";
		$mSQL.= "AND a.exp_e=b.exp_e ";
		$mSQL.= "ORDER BY 2 ";

		$conex->ExecSQL($mSQL,__LINE__,true);
		$lista_e=$conex->result;

$fecha = date('j')."-".substr(Mes_Txt(date('m')),0,3)."-".date('Y');

print <<<THEAD1
		<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
		<tr>
			<td width="20%" style="text-align:center;"><img src="/img/logo_unexpo.png" width="90" height="68" border="0" alt="" title=""></td>
			<td width="60%" style="text-align:center;font-family:arial;font-size:10pt;font-weight:bold;">
					Universidad Nacional Experimental Polit&eacute;cnica<br>
					"Antonio Jos&eacute; de Sucre"<br>
					Vicerrectorado $vicerrectorado<br>
					$nombreDependencia
			</td>
			<td width="20%" style="padding-left:20px;font-family:arial;font-size:10pt;">
				Fecha: $fecha<br><br>
				Lapso: $lapso
			</td>
		</tr>
		</table>
		
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
			<td width="60%" style="text-align:center;font-family:arial;font-size:12pt;font-weight:bold;" colspan="3">
				AVANCE ACAD&Eacute;MICO
			</td>
		</tr>
		</table>
		
		<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
		<tr>
			<td width="20%" style="text-align:justify;font-family:arial;font-size:9pt;" colspan="3">
				C&Oacute;DIGO: <span style="font-weight:bold;">$c_asigna</span>
			</td>
			<td width="60%" style="text-align:justify;font-family:arial;font-size:9pt;" colspan="3">
				<span style="font-weight:bold;">$asignatura</span>
			</td>
			<td width="20%" style="text-align:center;font-family:arial;font-size:9pt;" colspan="3">
				ACTA: <span style="font-weight:bold;">$acta</span>
			</td>
		</tr>
		<tr>
			<td style="text-align:justify;font-family:arial;font-size:9pt;" colspan="3">
				SECCI&Oacute;N: <span style="font-weight:bold;">$seccion</span>
			</td>
		</tr>
		</table>
		<br>
		<form name="notas" method="POST" action="cerrar.php">
		<table cellpadding="0" cellspacing="0" border="1" width="100%" align="center" style="border-collapse:collapse;">
		<tr>
			<td width="5px" style="text-align:center;font-family:arial;font-size:6pt;font-weight:bold;">
			</td>
			<td width="15px" style="text-align:center;font-family:arial;font-size:6pt;font-weight:bold;">
				EXPED
			</td>
			<td width="100px" style="text-align:center;font-family:arial;font-size:6pt;font-weight:bold;">
				APELLIDOS Y NOMBRES
			</td>
			
THEAD1;

# Genero dinamicamente columnas según $cant_eva
for ($i=1;$i<=$cant_eva;$i++){
	echo "<td width=\"5px\" style=\"text-align:center;font-family:arial;font-size:6pt;font-weight:bold;\">NOTA ".$i."</td>";
}

print <<<THEAD2
		
			<td width="5px" style="text-align:center;font-family:arial;font-size:6pt;font-weight:bold;">TOTAL 100</td>
			<td width="5px" style="text-align:center;font-family:arial;font-size:6pt;font-weight:bold;">TOTAL 9</td>
THEAD2;


print "</tr>";// fin encabezado tabla

### CONTENIDO
# Genero dinamicamente columnas de calificaciones según count($lista_e)
for ($x=0;$x<count($lista_e);$x++){
	$nro = $x+1;

	# Determino el estatus del estudiante en la seccion

	switch($lista_e[$x][$cant_eva+4]){
		case 7:
			$estatus = "INSCRITO";
			break;
		case 'A':
			$estatus = "AGREGADO";
			break;
		case 2:
			$estatus = "RETIRADO";
			break;
		case 'R':
			$estatus = "RET.REGL";
			break;
		default:
			$estatus = "INDEFINIDO";
			break;
	}

	echo "<tr>";
	# numero
	echo "<td width=\"5px\" style=\"text-align:center;font-family:arial;font-size:6pt;font-weight:bold;\">".$nro."</td>";
	# expediente
	echo "<td width=\"1%\" style=\"padding-right:3px;padding-left:3px;text-align:center;font-family:arial;font-size:8pt;font-weight:bold;\">".$lista_e[$x][0]."</td>";

	# Busco cantidad de evaluaciones para acta en el lapso
	$mSQL = "SELECT apellidos||' '||nombres FROM dace002 WHERE exp_e='".$lista_e[$x][0]."'";
	$conex->ExecSQL($mSQL,__LINE__,true);

	# apellidos y nombres
	echo "<td width=\"5px\"><table width=\"100%\"><tr><td style=\"padding-left:5px;font-family:arial;font-size:6pt;font-weight:normal;\">".$conex->result[0][0]."</td><td style=\"text-align:right;padding-right:5px;font-family:arial;font-size:5pt;font-weight:normal;\">".$estatus."</td>
	</tr></table></td>";

	# notas
	for ($y=2;$y<($cant_eva+2);$y++){
		echo "<td width=\"5px\" style=\"text-align:center;font-family:arial;font-size:8pt;font-weight:normal;\">".$lista_e[$x][$y]."</td>";
	}

	# total 100
	echo "<td width=\"5px\" style=\"text-align:center;font-family:arial;font-size:8pt;font-weight:bold;\">".$lista_e[$x][$cant_eva+2]."</td>";

	# total 9
	echo "<td width=\"5px\" style=\"text-align:center;font-family:arial;font-size:8pt;font-weight:bold;\">".$lista_e[$x][$cant_eva+3]."</td>";

	echo "</tr>";
}
### FIN CONTENIDO


print "</table>";// fin tabla contenido

echo "<br><br>";

	
	// Buscar los datos del docente
	$mSQL = "SELECT apellido,nombre FROM tblaca007 WHERE ci='".$cedula."' ";
	$conex->ExecSQL($mSQL,__LINE__,true);
	$apeynom = $conex->result[0][0]." ".$conex->result[0][1];

	//busca la fecha de carga
	$mSQL = "SELECT his_fec FROM his_act WHERE ";
	$mSQL.= "his_act='".$acta."' AND his_lap='".$lapso."' AND his_cod='".$c_asigna."' ";
	$conex->ExecSQL($mSQL,__LINE__,true);
	$fecha = $f_nac=implode("/", array_reverse(explode("-", $conex->result[0][0])));



print <<<PIE
		<table cellpadding="0" cellspacing="0" border="1" width="100%" align="center" style="border-collapse:collapse;">
		<tr>
			<td width="25%" style="text-align:center;font-family:arial;font-size:7pt;font-weight:bold;">
				PROFESOR:
			</td>
			<td width="25%" style="text-align:center;font-family:arial;font-size:7pt;font-weight:bold;">
				Nro. CEDULA
			</td>
			<td width="25%" style="text-align:center;font-family:arial;font-size:7pt;font-weight:bold;">
				FIRMA
			</td>
			<td width="25%" style="text-align:center;font-family:arial;font-size:7pt;font-weight:bold;">
				FECHA DE CIERRE:
			</td>
		</tr>
		<tr>
			<td width="25%" style="text-align:center;font-family:arial;font-size:8pt;">
				$apeynom
			</td>
			<td width="25%" style="text-align:center;font-family:arial;font-size:8pt;padding-top:10px;padding-bottom:5px;">
				$cedula
			</td>
			<td width="25%" style="text-align:center;font-family:arial;font-size:8pt;">
				
			</td>
			<td width="25%" style="text-align:center;font-family:arial;font-size:8pt;">
				$fecha
			</td>
		</tr>
		</table>
		<div align="center" style="text-align:center;font-family:arial;font-size:4pt;">VA SIN ENMIENDAS</div>
		<div align="center" id="oculto" style="text-align:center;"><input type="button" value="Imprimir" onClick="imprimir();">&nbsp;&nbsp;<input type="button" value="Cerrar" onClick="window.close();"></div>

PIE;

?>

<script languaje="javascript">
	var ocul;
	//alert('Recuerde entregar dos (2) copias firmadas de este avance en el departamento.');
	botones=document.getElementById("oculto");
	botones.style.visibility='hidden';
	//alert('EL botòn "Imprimir" se activará nuevamente en 5 segundos.');
	//window.print();
	setTimeout("botones.style.visibility='visible'",1000);
function imprimir(){
	var ocul;
	//alert('Recuerde entregar dos (2) copias firmadas de este avance en el departamento.');
	botones=document.getElementById("oculto");
	botones.style.visibility='hidden';
	//alert('EL botòn "Imprimir" se activará nuevamente en 5 segundos.');
	window.print();
	setTimeout("botones.style.visibility='visible'",2000);
}
</script>