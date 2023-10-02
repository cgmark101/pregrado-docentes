<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	
<?php

include_once ('inc/vImage.php');
include_once ('inc/odbcss_c.php');
include_once ('inc/config.php');
include_once ('inc/activaerror.php');

$lista_e = array();

$fecha  = date('Y-m-d', time() - 3600*date('I'));
$hora   = date('h:i a', time() - 3600*date('I'));

$DSN =  $nucleos[0];

?>

<style type="text/css">
<!--
#prueba {
  overflow:hidden;
  color:#00FFFF;
  background:#F7F7F7;
}

.titulo {
  text-align: center; 
  font-family:Arial; 
  font-size: 13px; 
  font-weight: normal;
  margin-top:0;
  margin-bottom:0;	
}
.tit14 {
  text-align: center; 
  font-family: Arial; 
  font-size: 13px; 
  font-weight: bold;
  letter-spacing: 1px;
  font-variant: small-caps;
}
.instruc {
  font-family:Arial; 
  font-size: 12px; 
  font-weight: normal;
  background-color: #FFFFCC;
}
.boton {
  text-align: center; 
  font-family:Arial; 
  font-size: 11px;
  font-weight: normal;
  background-color:#e0e0e0; 
  font-variant: small-caps;
  height: 20px;
  padding: 0px;
}
.enc_p {
  color:#FFFFFF;
  text-align: center; 
  font-family:Helvetica; 
  font-size: 11px; 
  font-weight: normal;
  background-color:#3366CC;
  height:20px;
  font-variant: small-caps;
}
.enc_p2 {
  color:#000000;
  text-align: center; 
  font-family:Helvetica; 
  font-size: 11px; 
  font-weight: bold;
  height:20px;
  font-variant: small-caps;
}
.inact {
  text-align: center; 
  font-family:Arial; 
  font-size: 11px; 
  font-weight: normal;
  
}
.inact2 {
  text-align: left; 
  font-family:Arial; 
  font-size: 11px; 
  font-weight: normal;
  padding-left: 10px;
 
}
.inact3 {
  text-align: left; 
  font-family:Arial; 
  font-size: 9px; 
  font-weight: normal;
  background-color:#F0F0F0;
}
.act { 
  text-align: center; 
  font-family:Arial; 
  font-size: 11px; 
  font-weight: normal;
  background-color:#99CCFF;
}

DIV.peq {
   font-family: Arial;
   font-size: 9px;
   z-index: -1;
}
select.peq {
   font-family: Arial;
   font-size: 8px;
   z-index: -1;
   height: 11px;
   border-width: 1px;
   padding: 0px;
   width: 84px;
}
.datosp {
  text-align: left; 
  font-family:Arial; 
  font-size: 11px;
  font-weight: normal;
  font-variant: small-caps;
}

-->
</style>



<?php



if (isset($_POST['agrega'])){
	$total_ag = count($_POST)-6;
	if (($_POST['agrega'] == 'si') and ($total_ag > 0)){
		
		$acta = $_POST['acta'];
		$seccion = $_POST['seccion'];
		$c_asigna = $_POST['c_asigna'];
		$total = $_POST['total'];

		$Cagr = new ODBC_Conn($DSN,"N","N",$ODBCC_conBitacora, $laBitacora);
		
		$j=0; // contador para mostrar agregados

		$Cagr->iniciarTransaccion("Inicia agregado: - Acta => ".$acta." - Codigo => ".$c_asigna." - Seccion => ".$seccion." ");
		
		foreach ($_POST as $campo => $exp_e){
			if (strlen($campo) <= 2){ // Si es un checkbox 

				

				# Revisar si hay disponibilidad de cupo en la seccion
				$mSQL = "SELECT DISTINCT exp_e FROM dace006 WHERE lapso='".$lapsoProceso."' ";
				$mSQL.= "AND acta='".$acta."' AND c_asigna='".$c_asigna."' ";
				$mSQL.= "AND seccion='".$seccion."' AND status IN ('7','A')";
				$Cagr->ExecSQL($mSQL,__LINE__,true);

				$haycupo = ($Cagr->filas < $limite); // Limite de inscritos por seccion
				
				if ($haycupo){

					$suma = false;

					# Revisar total de cupos en tblaca004
					$mSQL = "SELECT tot_cup FROM tblaca004 WHERE lapso='".$lapsoProceso."' ";
					$mSQL.= "AND acta='".$acta."' AND c_asigna='".$c_asigna."' ";
					$mSQL.= "AND seccion='".$seccion."' ";
					$Cagr->ExecSQL($mSQL,__LINE__,true);

					$tot_cup = $Cagr->result[0][0];

					# total cupo disp < 40							- Si es mayor aumenta tot_cup
					($tot_cup < ($limite - 5)) ? $suma_tot = " " : $suma_tot = ", tot_cup=tot_cup+1 ";
					
					# Aumentar el total de cupos en tblaca004
					$mSQL = "UPDATE tblaca004 SET inscritos=inscritos+1 ". $suma_tot."  ";
					$mSQL.= "WHERE lapso='".$lapsoProceso."' AND acta='".$acta."' ";
					$mSQL.= "AND c_asigna='".$c_asigna."' AND seccion='".$seccion."' ";
					$Cagr->ExecSQL($mSQL,__LINE__,true);

					$suma = ($Cagr->fmodif > 0);

					# Buscar si tiene grupo de laboratorio
					$gSQL = "SELECT c_asigna FROM tblaca008 ";
					$gSQL.= "WHERE c_asigna='".$c_asigna."' AND horas_lab > 0 ";
					$gSQL.= "AND horas_teoricas > 0 ";
					$Cagr->ExecSQL($gSQL,__LINE__,true);

					$tiene_lab = ($Cagr->filas > 0);

					$campog = " ";
						
					if($tiene_lab){// Si tiene laboratorio
						# Buscar grupo de laboratorio con cupo disponible
						$mSQL = "SELECT grupo FROM tblaca004_lab ";
						$mSQL.= "WHERE lapso='".$lapsoProceso."' AND c_asigna='".$c_asigna."' ";
						$mSQL.= "AND seccion='".$seccion."' AND inscritos < tot_cup ";
						$Cagr->ExecSQL($mSQL,__LINE__,true);

						$grupo = $Cagr->result[0][0];
						$campog = ", incluye='".$grupo."' ";;

						# Aumentar el total de cupos en tblaca004_lab
						$mSQL = "UPDATE tblaca004_lab SET inscritos=inscritos+1 ";
						$mSQL.= "WHERE lapso='".$lapsoProceso."' AND c_asigna='".$c_asigna."' ";
						$mSQL.= "AND seccion='".$seccion."' AND grupo='".$grupo."' ";
						$Cagr->ExecSQL($mSQL,__LINE__,true);
						
						$suma = ($Cagr->fmodif > 0);

					}// fin $tiene_lab
					
					if ($suma){// Si actualizo totales, actualiza dace006

						$mSQL = "UPDATE dace006 SET status='A', fecha='".$fecha."'".$campog;
						$mSQL.= "WHERE exp_e='".$exp_e."' AND lapso='".$lapsoProceso."' "; 
						$mSQL.= "AND acta='".$acta."' AND c_asigna='".$c_asigna."' ";
						$mSQL.= "AND seccion='".$seccion."' ";
						$Cagr->ExecSQL($mSQL,__LINE__,true);
						$j+=$Cagr->fmodif;					
					}// fin fmodif > 0
				}// fin if $haycupo
			}// fin if strlen($campo) <= 2
		}// fin foreach
		$Cagr->finalizarTransaccion("Fin agregado: - Acta => ".$acta." - Codigo => ".$c_asigna." - Seccion => ".$seccion." TOTAL AGREGADOS: ".$j." -");
	}// fin total a agregar > 0
}// fin agrega

if(isset($_POST['acta']) && isset($_POST['cedula'])) {
	
	$acta=$_POST['acta'];
	$cedula=$_POST['cedula'];

	$Cmat = new ODBC_Conn($DSN,"N","N",true, $laBitacora);

	$SQL = "SELECT acta FROM tblaca004 ";
	$SQL.= "WHERE acta='".$acta."' AND ci='".$cedula."' AND lapso='".$lapsoProceso."'";
	$Cmat->ExecSQL($SQL,__LINE__,true);

	(isset($Cmat->result[0][0])) ? $acta_a = $Cmat->result[0][0] : $acta_a = "XXX" ;

	if ($acta == $acta_a){

		//Lista de Estudiantes Inscritos
	
	$mSQL = "select a.exp_e,a.apellidos,a.nombres,b.acta,b.c_asigna,";
	$mSQL= $mSQL."c.asignatura,b.seccion,e.ci,e.apellido,e.nombre,b.status,a.apellidos2,a.nombres2 ";
	$mSQL= $mSQL."from dace002 a,dace006 b,tblaca008 c,tblaca007 e,tblaca004 f ";
	$mSQL= $mSQL."where b.lapso='".$lapsoProceso."' and a.exp_e=b.exp_e ";
	$mSQL= $mSQL."and  b.acta ='".$acta."' and b.c_asigna=c.c_asigna and f.ci='".$cedula."' ";
	$mSQL= $mSQL."and b.c_asigna=f.c_asigna and b.lapso=f.lapso and b.seccion=f.seccion ";
	$mSQL= $mSQL."and b.acta=f.acta and f.ci=e.ci and b.status NOT IN ('Y','Z') order by 2 ";
	$Cmat->ExecSQL($mSQL,__LINE__,true);
	$lista_e=$Cmat->result;

	foreach ($lista_e as $est){
		$secc = $est[6];
		$acta = $est[3];
		$cidoc = $est[7];
		$nombdoc = $est[9];
		$apedoc = $est[8];
		$asig = $est[5];
		$cod = $est[4];
	}


	?>
	<title><?php print $nombdoc."  ".$apedoc." - ".$asig." - ".$lapsoProceso ?></title>

	</head>
	<body <?=$botonDerecho?>>



	<SCRIPT LANGUAGE="JavaScript">
	<!--
	function validarN(campo) {

		var cadena = campo.value;
		var nums="1234567890.";
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

	function validarNota(campo) {

		if (campo.value > 0 && campo.value < 1){
			alert("NOTA NO VALIDA")
			campo.value = ""
			}
		if (campo.value > 9)
			{alert("NOTA NO VALIDA")
			campo.value = ""
			}
		if (campo.value == '')
			{alert("DEBE INTRODUCIR UNA NOTA")
			}
	}

	function goAway() { 
	if (confirm('La página actual está intentando ser cerrada.\n\n¿Está seguro que desea salir?'))
	window.close();
	else { 
	alert('Se encuentra aún conectado al sistema.'); 
	return false;}} 

	function control_seleccion(casilla){
		seleccionado = 	casilla.checked;
		with (document.lista_cola){
			if (seleccionado) {
				contador.value++;
			}else{
				contador.value--;
			}
			/*if (contador.value > limite_ag.value) {
				
				(limite_ag.value == 1) ? tantos = 'estudiante': tantos = 'estudiantes';

				alert('Solo puede seleccionar '+limite_ag.value+' '+tantos+'.\n\nHa seleccionado el maximo de estudiantes permitido para esta seccion.');
				
				casilla.checked = false;
				contador.value--;
			}*/
		} // fin with
	}// Fin funcion

	function verificar (formulario){
		with(formulario){
			//if (contador.value > limite_ag.value) {
			if (false){
				
				(limite_ag.value == 1) ? tantos = 'estudiante': tantos = 'estudiantes';

				alert('Solo puede seleccionar '+limite_ag.value+' '+tantos+'.\n\nHa seleccionado el maximo de estudiantes permitido para esta seccion.\nPor favor verifique su seleccion e intente nuevamente.');
			}else{
				
				(contador.value == 1) ? tantos = 'al estudiante seleccionado.': tantos = 'a los estudiantes seleccionados.';

				envia =  confirm('ATENCION: Esta a punto de incrementar en '+contador.value+' el total de cupos en su seccion. Ademas ingresara a la seccion '+tantos+'\n\nEsta seguro que desea procesar su seleccion?\n\nPresione Aceptar para continuar o Cancelar para declinar la solicitud.');
				if (envia) {
					//alert('submit');
					formulario.submit();
				}
			}
		}	
	}

	//-->
	</SCRIPT>



	<table align="center" border="0" cellpadding="0" cellspacing="1" width="660">
		<tr>
			<td class="inact"><IMG SRC="imagenes/unex15.gif" WIDTH="75" HEIGHT="75" BORDER="0" ALT="">
			</td>
			
			<td class="inact">Universidad Nacional Experimental Polit&eacute;cnica<BR>"Antonio Jos&eacute; de Sucre"<BR>Vicerrectorado&nbsp;<? print $vicerrectorado?><BR><? print $nombreDependencia  ?><BR> <? print $tProceso ?>&nbsp;Lapso&nbsp;<? print $lapsoProceso ?>
			</td>
			<td bgcolor="#A7A7A7">&nbsp</td>
			
			<td class="datosp">
				&nbsp;&nbsp;<B>Fecha:</B>&nbsp;<?echo date("d/m/Y");?>&nbsp;<?echo $hora?>
				&nbsp;&nbsp;&nbsp;&nbsp;<B>Lapso</B>:&nbsp;<? print $lapsoProceso ?><BR>
				
				&nbsp;&nbsp;<B>Docente:</B>&nbsp;<? print $nombdoc?>&nbsp;&nbsp;<? print $apedoc ?>&nbsp;<B>CI:</B>&nbsp;<? print $cidoc ?><BR>

				&nbsp;&nbsp;<B>Asignatura:</B>&nbsp;<? print $asig?><br>&nbsp;<B>C&oacute;digo:&nbsp;</B><?print $cod?>
				
				&nbsp;&nbsp;<B>Secci&oacute;n:</B>&nbsp;<? print $secc?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				
				&nbsp;&nbsp;<B>Acta:</B>&nbsp;<? print $acta ?>
					 
			</td>
		</tr>
	</table>
	<BR>

	<table align="center" border="1" cellpadding="0" cellspacing="1" width="660" style="border-collapse: collapse;border-color:black;">
		<tr bgcolor="#FFFFFF" class="enc_p2">
			<td style="width: 600px;" colspan="5">ESTUDIANTES INSCRITOS, AGREGADOS Y/O RETIRADOS</td>
		</tr>

		<tr bgcolor="#FFFFFF" class="enc_p2">
			<td style="width: 30px;">NRO</td>
			<td style="width: 100px;">EXPEDIENTE</td>
			<td style="width: 180px;">APELLIDOS</td>
			<td style="width: 180px;">NOMBRES</td>
			<td style="width: 130px;">ESTATUS</td>
		</tr>
				<?php
				$nota=array();
				$nro=0;
				foreach ($lista_e as $est){
					$nro++;
					$nota[$nro]=$nro;
					print "<tr>";
					print "<td><div class=\"inact\">$nro</div></td>";
					print "<td><div class=\"inact\">$est[0]</div></td>";
					print "<td><div class=\"inact2\">$est[1] $est[11]</div></td>";
					print "<td><div class=\"inact2\">$est[2] $est[12]</div></td>";
					if ($est[10] == 'A'){
						print "<td><div class=\"inact\">AGREGADO(A)</div></td>";
					}elseif ($est[10] == '2'){
						print "<td><div class=\"inact\">RETIRADO(A)</div></td>";
					}elseif ($est[10] == 'R'){
						print "<td><div class=\"inact\">RETIRADO(A) POR REGLAMENTO</div></td>";
					}
					print "</tr>";
					
				}
				if (isset($j)){
					
					($j == 1) ? $msg = " ha agregado <b>".$j."</b> estudiante" : $msg = " han agregado <b>".$j."</b> estudiantes";

					print "<tr><td colspan=\"7\" class=\"inact2\">Se ".$msg." a la secci&oacute;n</td></tr>";
				
				}

			?>
		<tr><td colspan="7" bgcolor="#000000" align="center"></td></tr></table>

	<?php

	//Lista de Estudiantes en COLA
	$Cmat = new ODBC_Conn($DSN,"N","N",$ODBCC_conBitacora, $laBitacora);
	$mSQL = "SELECT COUNT(exp_e) ";
	$mSQL.= "FROM dace006 ";
	$mSQL.= "WHERE lapso='".$lapsoProceso."' AND acta ='".$acta."' AND c_asigna='".$cod."' ";
	$mSQL.= "AND seccion='".$secc."' AND status IN (7,'A') ";
	$Cmat->ExecSQL($mSQL,__LINE__,true);
	//print_r ($Cmat->result);
//	echo $mSQL;
	$total_insc = $Cmat->result[0][0];



	//Lista de Estudiantes en COLA
	$Cmat = new ODBC_Conn($DSN,"N","N",$ODBCC_conBitacora, $laBitacora);
	$mSQL = "select a.exp_e,a.apellidos,a.apellidos2,a.nombres,a.nombres2,b.status ";
	$mSQL.= "from dace002 a,dace006 b ";
	$mSQL.= "where b.lapso='$lapsoProceso' and a.exp_e=b.exp_e and b.acta ='$acta' ";
	$mSQL.= "and b.status='Y' ORDER BY nro_prof";
	$Cmat->ExecSQL($mSQL,__LINE__,true);
	$lista_e=$Cmat->result;
	$total=$Cmat->filas;

	if($total > 0){

		$limite_ag = ($limite - $total_insc);

		($limite_ag == 1) ? $tantos = " estudiante" : $tantos = " estudiantes";

		($limite_ag == 0) ? /*$desactivado = " disabled"*/$desactivado = " " : $desactivado = " ";

		?>

	<BR>
	<form action="" method="POST" name="lista_cola" >

	<table align="center" border="1" cellpadding="0" cellspacing="1" width="660" style="border-collapse: collapse;border-color:black;">
		<tr bgcolor="#FFFF99" class="enc_p2" >
			<td style="width: 600px;" colspan="6">
				ESTUDIANTES EN COLA (<?=$total?>)<br><br>
				<!-- El l&iacute;mite para cada secci&oacute;n es de 45 estudiantes. --><br><br>

				<?php //if ($limite_ag > 0) { }?>

					Puede seleccionar la cantidad de estudiantes que desee.
					<input type="hidden" size="1" name="limite_ag" value="<?php echo $limite_ag ?> " style="border-style: solid; border-width: 0px; text-align: center; font-family: arial; font-size: 12px; color: #FF0000; background-color: #FFFF99; font-weight:bold;" readonly> <?php //echo $tantos ?>  <!-- para agregar. -->&nbsp;&nbsp;&nbsp; Ha seleccionado
					<input type="text" size="1" name="contador" value="0" style="border-style: solid; border-width: 0px; text-align: center; font-family: arial; font-size: 12px; color: #FF0000; background-color: #FFFF99; font-weight:bold;" readonly> 


				
			</td>
		</tr>

		<tr bgcolor="#99CCFF" class="enc_p2">
			<td style="width: 30px;">AGREGAR</td>
			<td style="width: 30px;">NRO</td>
			<td style="width: 100px;">EXPEDIENTE</td>
			<td style="width: 180px;">APELLIDOS</td>
			<td style="width: 180px;">NOMBRES</td>
			<td style="width: 130px;">ESTATUS</td>
		</tr>
		
		
		<?php
				$nota=array();
				$nro=0;
				foreach ($lista_e as $est){
					$nro++;
					$nota[$nro]=$nro;

					($nro % 2) ? $bgcolor = "#EFEFEF" :	$bgcolor = "#CEE7FF";

					echo "<tr style=\"background-color:".$bgcolor."\" onmouseover=\"this.style.backgroundColor='#FFFF66'\" onmouseout=\"this.style.backgroundColor='$bgcolor'\">";
					//casilla de seleccion
					print "<td> <div class=\"inact\"> <input type=\"checkbox\" $desactivado name=\"$nro\" value=\"$est[0]\" onclick=\"control_seleccion(this);\"></div></td>";
					//numero de la lista
					print "<td><div class=\"inact\">$nro</div></td>";
					//expediente
					print "<td><div class=\"inact\">$est[0]</div></td>";
					//apellidos
					print "<td><div class=\"inact2\">$est[1] $est[2]</div></td>";
					//nombres
					print "<td><div class=\"inact2\">$est[3] $est[4]</div></td>";
					if ($est[5] == 'Y'){
						//estatus en cola
						print "<td><div class=\"inact\">EN COLA</div></td>";
					}else{
						//estatus distinto de la cola
						print "<td><div class=\"inact\">NO ESTA EN COLA</div></td>";
					}
					print "</tr>";
				}
			?>
		<tr><td colspan="7" bgcolor="#000000" align="center"></td></tr>

		<!-- <tr><td colspan="7" class="enc_p2" align="center">Controlador de inscritos</td></tr> -->
		
		</table>
	<table align="center" border="0" cellpadding="0" cellspacing="1" width="660" style="border-collapse: collapse;border-color:black;">
		<tr>
			<td valign="top" colspan="3">
				<p align="center">
					<br><input type="button" value="cerrar" name="cerrar" id="exit" class="boton" onclick="goAway();">
				</p> 
			</td>
			<td valign="top" colspan="3">
				<p align="center">
					<input type="hidden" name="agrega" value="si">
					<input type="hidden" name="acta" value="<?=$acta?>">
					<input type="hidden" name="seccion" value="<?=$secc?>">
					<input type="hidden" name="c_asigna" value="<?=$cod?>">
					<input type="hidden" name="cedula" value="<?=$cedula?>">
					<input type="hidden" name="total" value="<?=$total?>">


					<br><input type="button" value="agregar" class="boton" <?php echo $desactivado; ?> onClick="verificar(this.form);">
				</p> 
			</td>
						<td valign="top" colspan="3"><p align="center">
							<br><input type="reset" value="imprimir" name="imprimir" class="boton" onclick="window.print();"></p> 
						</td>
					</tr>
	</form>
	</table>
	<?php
	}else {						 
	?>
	<table align="center" border="0" cellpadding="0" cellspacing="1" width="660" style="border-collapse: collapse;border-color:black;">
		<tr>
						
						 <td valign="top" colspan="3"><p align="center">
							<BR><input type="button" value="Cerrar" name="cerrar" id="exit" class="boton" 
							 onClick="goAway();"></p> 
						</td>
						<td valign="top" colspan="3"><p align="center">
							<BR><input type="reset" value="Imprimir" name="imprimir" class="boton" onclick="window.print();"></p> 
						</td>
					</tr>
	</form>
	</table>
	<?
	}					 
	?>
	</body>
	</html>
	<?php
	
	}else{ // si el acta enviada no es del profesor
		//sleep(5);
		//die();
		echo "<script>document.location.href='error.php';</script>\n";
	}
}else { // si no envia acta y cedula
	echo "<script>document.location.href='../autag_l';</script>\n";
}

