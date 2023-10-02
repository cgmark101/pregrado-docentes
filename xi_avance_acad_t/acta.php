<?php
#incluimoa el archivo config que contiene las variables globales.
require('inc/config.php');
require('inc/odbcss_c.php');

if ($_SERVER['HTTP_REFERER'] != $raizDelSitio.'cerrar.php'){
	die ("<script languaje=\"javascript\"> alert('ACCESO PROHIBIDO'); </script>");
}

$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$_SERVER[DOCUMENT_ROOT].'/log/pregrado/docentes/avance/cierre_actas_'.$lapso);

$fecha		= date('Y-m-d', time() - 3600*date('I'));
//$hora		= date('h:i:s', time() - 3600*date('I'));

$h = "4.5";
$hm = $h*60;
$ms = $hm*60;
$hora		= gmdate("g:i a",time()-($ms));
$que		= "acta incluida";

$acta		=	$_POST['acta'];
$lapso		=	$_POST['lapso'];
$c_asigna	=	$_POST['c_asigna'];
$nro		=	$_POST['nro'];

$mSQL = "SELECT ci, seccion FROM tblaca004 WHERE c_asigna='".$c_asigna."' ";
$mSQL.= "AND acta='".$acta."' AND lapso='".$lapso."'";
$conex->ExecSQL($mSQL,__LINE__,true);


if ($conex->filas == 0){
	$mSQL = "SELECT his_ced, his_sec FROM his_act WHERE his_cod='".$c_asigna."' ";
	$mSQL.= "AND his_act='".$acta."' AND his_lap='".$lapso."'";
	$conex->ExecSQL($mSQL,__LINE__,true);
	$notasOK = false;
}else{
	$notasOK = ($conex->filas == 1);
}

$cedula		= $conex->result[0][0]; //cedula docente
$seccion	= $conex->result[0][1];



//print_r($_POST);

//echo $notasOK;

/********PROCESAR CALIFICACIONES*********/
	if ($notasOK){
		$conex->iniciarTransaccion("usuario: ".$cedula." - acta: ".$acta." \n Inicio Transaccion");
		for ($i = 0; $i < $nro; $i++) {
				$sw2 = '0';
				$nota=$_POST['nota_' . $i];
				$exp=$_POST['exp_' . $i];
				
				if ($nota == '0'){
					$nota = 'I';
				}	
				if (($nota >= '1') and ($nota <= '4.9')){
					$estatus = '1';
				}	
				if (($nota >= '5.0') and ($nota <= '9')){
					$estatus = '0';
				}
				if ($nota == 'I'){
					$estatus = 'I';
					$nota = '1';
				}

				if (empty($nota)){
					$sw2 = '1'; 
					//print "La nota esta vacia";
					break;
				}else{
					//Insertamos las calificaciones en DACE004
					$statusr = 0;
					$afecind = 0;
					$mSQL = "INSERT INTO DACE004 (CALIFICACION,ACTA,C_ASIGNA,EXP_E,LAPSO,STATUS,STATUS_RR,AFEC_INDICE) ";
					$mSQL.= "VALUES ('".$nota."','".$acta."','".$c_asigna."','".$exp."','".$lapsoProceso."',";
					$mSQL.= "'".$estatus."','".$statusr."','".$afecind."')";
					$conex->ExecSQL($mSQL,__LINE__,true);
					//echo $mSQL."<br><br>";
					$notasOK = ($conex->fmodif > 0);
				
					//Insertamos las calificaciones en AUDITORIA
					
					$mSQL = "INSERT INTO AUDITORIA ";
					$mSQL.= "(USER_ID,TABLA,CAMPO1,CAMPO2,CAMPO3,CAMPO4,FECHA,HORA,QUE) ";
					$mSQL.= "VALUES  ('".$cedula."','".$exp."','".$c_asigna."','".$acta."','".$seccion."', ";
					$mSQL.= "'".$lapsoProceso."','".$fecha."','".$hora."','".$que."')";	
					$conex->ExecSQL($mSQL,__LINE__,true);
					//echo $mSQL."<br><br>";
													
				}// fin nota no vacia	
		}//fin del bucle for
	}// 

	if ($notasOK){
		
		$mSQL = "select count(*) from dace006 where acta='$acta' and lapso='$lapsoProceso' and status='2'";
		$conex->ExecSQL($mSQL,__LINE__,true);
		$retirados=$conex->result[0][0];

		$mSQL = "INSERT INTO HIS_ACT";
		$mSQL.= "(HIS_ACT,HIS_CED,HIS_SEC,HIS_LAP,HIS_COD,HIS_FEC,HIS_INS,HIS_RET) ";
		$mSQL.= " VALUES ('".$acta."','".$cedula."','".$seccion."','".$lapsoProceso."','".$c_asigna."', ";
		$mSQL.= "'".$fecha."','".$nro."','".$retirados."')";
		$conex->ExecSQL($mSQL,__LINE__,true);
		//echo $mSQL."<br><br>";

		//BORRAMOS EL ACTA DE DACE006
		$dSQL = "DELETE FROM dace006 WHERE lapso='".$lapsoProceso."' AND acta='".$acta."' ";
		$dSQL.= "AND c_asigna='".$c_asigna."' AND seccion='".$seccion."' AND (status='7' OR status='A')";
		$conex->ExecSQL($dSQL,__LINE__,true);
		//echo $dSQL."<br><br>";

		//BORRAMOS EL ACTA DE TBLACA004
		$dSQL = "DELETE FROM tblaca004 WHERE lapso='".$lapsoProceso."' AND acta='".$acta."' ";
		$dSQL.= "AND c_asigna='".$c_asigna."' AND seccion='".$seccion."'";
		$conex->ExecSQL($dSQL,__LINE__,true);
		//echo $dSQL."<br><br>";

		$conex->finalizarTransaccion("usuario: ".$cedula." - acta: ".$acta." - Fin Transaccion \n");
	}


/******FIN PROCESAR CALIFICACIONES*******/


function Mes_Txt($Numero){
	if ($Numero == 01){return "Enero";}
	if ($Numero == 02){return "Febrero";}
	if ($Numero == 03){return "Marzo";}
	if ($Numero == 04){return "Abril";}
	if ($Numero == 05){return "Mayo";}
	if ($Numero == 06){return "Junio";}
	if ($Numero == 07){return "Julio";}
	if ($Numero == 08){return "Agosto";}
	if ($Numero == 09){return "Septiembre";}
	if ($Numero == 10){return "Octubre";}
	if ($Numero == 11){return "Noviembre";}
	if ($Numero == 12){return "Diciembre";}
}
	
	$mSQL = "SELECT asignatura FROM tblaca008 WHERE c_asigna='".$c_asigna."'";
//	$mSQL.= "AND acta='".$acta."' AND lapso='".$lapso."'";
	$conex->ExecSQL($mSQL,__LINE__,true);

	$asignatura = $conex->result[0][0];

	//Lista de Estudiantes

		/*$mSQL = "SELECT a.exp_e,a.apellidos,a.apellidos2,a.nombres,a.nombres2,b.status ";
		$mSQL.= "FROM dace002 a,dace006 b,tblaca008 c,tblaca007 e,tblaca004 f ";
		$mSQL.= "WHERE b.lapso='".$lapso."' AND a.exp_e=b.exp_e ";
		$mSQL.= "AND  b.acta ='".$acta."' AND b.c_asigna=c.c_asigna AND f.ci='".$cedula."' ";
		$mSQL.= "AND b.c_asigna=f.c_asigna AND b.lapso=f.lapso AND b.seccion=f.seccion ";
		$mSQL.= "AND b.acta=f.acta AND f.ci=e.ci ORDER BY 2,3,4,5";*/

		$mSQL = "SELECT a.exp_e,a.apellidos,a.apellidos2,a.nombres,a.nombres2,";
		$mSQL.= "@DECODE(STATUS,'0','Aprobado','1','Aplazado','I','Inasistente') ";
		$mSQL.= "FROM DACE002 A,DACE004 B ";
		$mSQL.= "WHERE A.EXP_E=B.EXP_E AND B.ACTA='".$acta."' and b.lapso='".$lapsoProceso."' ";
		$mSQL.= "UNION ";
		$mSQL.= "SELECT a.exp_e,a.apellidos,a.apellidos2,a.nombres,a.nombres2,";
		$mSQL.= "@DECODE(STATUS,'6','Eliminado', '2','Retirado','7','Inscrito','R','Retirado') ";
		$mSQL.= "FROM DACE002 A,DACE006 B ";
		$mSQL.= "WHERE A.EXP_E=B.EXP_E AND B.ACTA='$acta' AND B.LAPSO='$lapsoProceso' AND status IN ('6','2','7','R','A') ";
		$mSQL.= "ORDER BY 2,3,4,5";

		$conex->ExecSQL($mSQL,__LINE__,true);
		$lista_e=$conex->result;



		$fecha = date('j')."-".substr(Mes_Txt(date('m')),0,3)."-".date('Y');
print <<<ENC
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
				ACTA DE EVALUACI&Oacute;N FINAL
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
		<form name="notas" method="POST" action="printav.php">
		<table cellpadding="0" cellspacing="0" border="1" width="100%" align="center" style="border-collapse:collapse;">
		<tr>
			<td width="48%" style="text-align:center;font-family:arial;font-size:8pt;" colspan="3">
			</td>
			<td width="32%" style="text-align:center;font-family:arial;font-size:8pt;" colspan="2">
				NOTA DEFINITIVA
			</td>
			<td width="16%" style="text-align:center;font-family:arial;font-size:8pt;">
			</td>
		</tr>
		<tr>
			<td width="5%" style="text-align:center;font-family:arial;font-size:6pt;font-weight:bold;">
			</td>
			<td width="10%" style="text-align:center;font-family:arial;font-size:6pt;font-weight:bold;">
				EXPEDIENTE
			</td>
			<td width="50%" style="text-align:center;font-family:arial;font-size:6pt;font-weight:bold;">
				APELLIDOS Y NOMBRES
			</td>
			<td width="10%" style="text-align:center;font-family:arial;font-size:6pt;font-weight:bold;">
				EN NUMERO
			</td>
			<td width="15%" style="text-align:center;font-family:arial;font-size:6pt;font-weight:bold;">
				EN LETRAS
			</td>
			<td width="10%" style="text-align:center;font-family:arial;font-size:6pt;font-weight:bold;">
				OBSERVACION
			</td>
		</tr>
		
		
ENC;


/*print <<<CUERPO1
		<table cellpadding="0" cellspacing="0" border="1" width="100%" align="center" style="border-collapse:collapse;">
CUERPO1;*/
		
for($i=0;$i < count($lista_e);$i++){
	echo "<tr>";
	echo "<td width=\"5%\" style=\"text-align:center;font-family:arial;font-size:8pt;font-weight:bold;\">";
		echo $i+1; // Numero
	echo "</td>";

	echo "<td width=\"10%\" style=\"text-align:center;font-family:arial;font-size:7pt;\">";
		echo $lista_e[$i][0]; // Expediente
	echo "<input type=\"hidden\" name=\"exp_".$i."\" value=\"".$lista_e[$i][0]."\"></td>";

	echo "<td width=\"50%\" style=\"text-align:left;font-family:arial;font-size:7pt;padding-left:10px;padding-top:5px;padding-bottom:2px;\">";
		echo $lista_e[$i][1]." ".$lista_e[$i][2]." ".$lista_e[$i][3]." ".$lista_e[$i][4]; // Apell y Nomb
	echo "</td>";

	// Buscar la nota segun el expediente
	$mSQL = "SELECT calificacion FROM dace004 WHERE exp_e='".$lista_e[$i][0]."' ";
	$mSQL.= "AND acta='".$acta."' AND lapso='".$lapso."' AND c_asigna='".$c_asigna."' ";
	$conex->ExecSQL($mSQL,__LINE__,true);
	$nota = $conex->result[0][0];
	
	echo "<td width=\"10%\" style=\"text-align:center;font-family:arial;font-size:8pt;\">";
		echo $nota; // Nota
	echo "<input type=\"hidden\" name=\"nota_".$i."\" value=\"".$nota."\"></td>";

	// Buscar el equivalente en letras segun la nota
	$mSQL = "SELECT letras FROM letras WHERE nota='".$nota."' ";
	$conex->ExecSQL($mSQL,__LINE__,true);
	$enletras = $conex->result[0][0];

	echo "<td width=\"15%\" style=\"text-align:left;font-family:arial;font-size:6pt;padding-left:10px;\">";
		echo $enletras; // letras
	echo "</td>";

	echo "<td width=\"10%\" style=\"text-align:center;font-family:arial;font-size:8pt;\">";
		echo $lista_e[$i][5];	
	echo "</td>";
	
	echo "</tr>";
}

print <<<CUERPO2
		
		</table>
		<input type="hidden" name="acta" value="$acta">
		<input type="hidden" name="lapso" value="$lapso">
		<input type="hidden" name="c_asigna" value="$c_asigna">
		</form>
		<br><br>

CUERPO2;

	
	// Buscar el equivalente en letras segun la nota
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
				FECHA:
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
		<div align="center" id="oculto" style="text-align:center;">
			<input type="button" value="Imprimir" onClick="imprimir();">&nbsp;&nbsp;
			<input type="button" value="Cerrar" onClick="window.close();">&nbsp;&nbsp;
			<input type="button" value="Imprimir Avance" onClick="enviar();"></div>

PIE;

?>

<script languaje="javascript">
	var ocul;
	//alert('Recuerde entregar dos (2) copias firmadas de esta acta en el departamento.');
	//botones=document.getElementById("oculto");
	//botones.style.visibility='hidden';
	//alert('EL botòn "Imprimir" se activará nuevamente en 5 segundos.');
	//window.print();
	//setTimeout("botones.style.visibility='visible'",2000);
function imprimir(){
	var ocul;
	alert('Recuerde entregar dos (2) copias firmadas de esta acta en el departamento.');
	botones=document.getElementById("oculto");
	botones.style.visibility='hidden';
	//alert('EL botòn "Imprimir" se activará nuevamente en 5 segundos.');
	window.print();
	setTimeout("botones.style.visibility='visible'",2000);
}
function enviar(){
	confirma = confirm('Si ya imprimio su acta final pulse ACEPTAR,\nde lo contrario pulse CANCELAR e imprima su acta final\nantes de abandonar esta pagina.');

	if (confirma){
		document.notas.submit();
	}
}
</script>