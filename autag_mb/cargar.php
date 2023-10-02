<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	
<?php

//ini_set("diplay_errors", "On");

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

$msge = "";

$bdesactivado = " ";

$tiene_lab = false;

if (isset($_POST['agrega'])){
	$total_ag = count($_POST)-6;
	if (($_POST['agrega'] == 'si') and ($total_ag > 0)){

		$bdesactivado = " disabled";
		
		$acta = $_POST['acta'];
		$seccion = $_POST['seccion'];
		$c_asigna = $_POST['c_asigna'];
		$total = $_POST['total'];

		$Cagr = new ODBC_Conn($DSN,"N","N",$ODBCC_conBitacora, $laBitacora);
		
		$j=0; // contador para mostrar agregados

		$Cagr->iniciarTransaccion("Inicia agregado: - Acta => ".$acta." - Codigo => ".$c_asigna." - Seccion => ".$seccion." ");

		$msge = false;// No ha mensajes de error
		$msgerror = "";
		
		foreach ($_POST as $campo => $exp_e){
			if (strlen($campo) <= 2){ // Si es un checkbox 
				
				# Revisar si hay disponibilidad de cupo en la seccion
				$mSQL = "SELECT DISTINCT exp_e FROM dace006 WHERE lapso='".$lapsoProceso."' ";
				$mSQL.= "AND acta='".$acta."' AND c_asigna='".$c_asigna."' ";
				$mSQL.= "AND seccion='".$seccion."' AND status IN ('7','A') ";
				$Cagr->ExecSQL($mSQL,__LINE__,true);

				$haycupo = ($Cagr->filas < $limite); // Limite de inscritos por seccion

				
				if ($haycupo){

					####RUTINA PARA VALIDAR CORREQUISITOS ANTES DE PROCESAR EL AGREGADO

					# Seleccionar correquisitos para la asignatura
					$mSQL = "SELECT par_cod_asig1,par_cod_asig2,par_cod_asig3 ";
					$mSQL.= "FROM tblaca009 ";
					$mSQL.= "WHERE c_asigna='".$c_asigna."' AND pensum='5' ";
					$Cagr->ExecSQL($mSQL,__LINE__,true);

					$co_req = $Cagr->result;
						
					@$co_req = array_values(array_diff($co_req[0], array('')));

					$cumplecorreq = false;

					# >>> el array $co_req contiene los co-requisitos para la asignatura $asig.
					if (count($co_req) > 0){// Si tiene correquisitos

						$cSQL[0] = "SELECT nro_prof,exp_e FROM dace006 WHERE lapso='".$lapsoProceso."' ";
						$cSQL[0].= "AND c_asigna='".$c_asigna."'  AND seccion='".$seccion."' AND status IN ('Y','E') ";

						$cSQL[3] = "AND exp_e='".$exp_e."' AND exp_e IN (";

						$cSQL[1] = "";// select de DACE006
						$cSQL[2] = "";// select de DACE004

						for ($i=0; $i < count($co_req); $i++){					
							((count($co_req) > 1) && ($i != count($co_req)-1)) ? $union = " UNION " : $union = " ";

							$cSQL[1].= "SELECT exp_e FROM dace006 WHERE lapso='".$lapsoProceso."' ";
							$cSQL[1].= "AND c_asigna='".$co_req[$i]."' AND status IN (7,'A') ".$union;

							$cSQL[2].= "SELECT exp_e FROM dace004 WHERE c_asigna='".$co_req[$i]."' ";
							$cSQL[2].= "AND status IN ('0','3','B','C') ".$union;
						}

						$coSQL = $cSQL[0].$cSQL[3].$cSQL[1].") UNION ".$cSQL[0].$cSQL[3].$cSQL[2].") ORDER BY 1,2 ";

						$Cagr->ExecSQL($coSQL, __LINE__,true);

						if ($Cagr->filas > 0){
							$cumplecorreq = true;
						}else{
							$msge = true;
							$msgerror.= "<br>- El expediente <b>".$exp_e."</b>, no cumple con los correquisitos para cursar esta asignatura.";
						}

						/*echo $coSQL;

						die();*/
						
						/*for ($i=0; $i < count($co_req); $i++){ // iterar por cada correq
							
							$cSQL[0] = "SELECT exp_e FROM dace006 WHERE lapso='".$lapsoProceso."' ";
							$cSQL[0].= "AND c_asigna='".$co_req[$i]."' AND status IN (7,'A') ";
							$cSQL[0].= "AND exp_e='".$exp_e."' ";
							$Cagr->ExecSQL($cSQL[0],__LINE__,true);

							()

							$cSQL[1] = "SELECT exp_e FROM dace004 WHERE c_asigna='".$co_req[$i]."' ";
							$cSQL[1].= "AND status IN ('0','3','B','C') ";
							$cSQL[1].= "AND exp_e='".$exp_e."' ";
							$Cagr->ExecSQL($cSQL[0],__LINE__,true);

						}*/
					}			

					####FIN PARA VALIDAR CORREQUISITOS

					// condicionar si se agrega (o no) desde aqui segun las variables de control

					if ((count($co_req) == 0) || ($cumplecorreq)){
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

							@$gcupo = $Cagr->result[0][0];

							if (strlen($gcupo) > 0){
								$grupo = $Cagr->result[0][0];
								$suma_tot_b = " ";
							}else{
								$grupo = "G".mt_rand(1,3);
								$suma_tot_b = ",tot_cup=tot_cup+1 ";
							}

							$campog = ", incluye='".$grupo."' ";;

							# Aumentar el total de cupos en tblaca004_lab
							$mSQL = "UPDATE tblaca004_lab SET inscritos=inscritos+1 ".$suma_tot_b;
							$mSQL.= "WHERE lapso='".$lapsoProceso."' AND c_asigna='".$c_asigna."' ";
							$mSQL.= "AND seccion='".$seccion."' AND grupo='".$grupo."' ";
							$Cagr->ExecSQL($mSQL,__LINE__,true);
							
							$suma = ($Cagr->fmodif > 0);

						}// fin $tiene_lab
						
						if ($suma){// Si actualizo totales
####################   INICIO MODIFICACIONES   #############################
							#### VERIFICAR si esta 7/A en una seccion distinta a $seccion $acta
							#### en el mismo $c_asigna $lapsoProceso

							$sSQL = "SELECT seccion,acta,incluye FROM dace006 ";
							$sSQL.= "WHERE exp_e='".$exp_e."' AND lapso='".$lapsoProceso."' "; 
							$sSQL.= "AND acta<>'".$acta."' AND c_asigna='".$c_asigna."' ";
							$sSQL.= "AND seccion<>'".$seccion."' AND status IN (7,'A') ";
							$Cagr->ExecSQL($sSQL,__LINE__,true);
							
							$YaInscrito = (!empty($Cagr->result[0][1])) ? true : false;
							
							if ($YaInscrito) {// Le elimino la inscripcion anterior
								$seccionP = $Cagr->result[0][0];
								$actaP	= $Cagr->result[0][1];
								@$labP = $Cagr->result[0][1];

								$sSQL = "UPDATE dace006 SET status='X', fecha='".$fecha."' ";
								$sSQL.= "WHERE exp_e='".$exp_e."' AND lapso='".$lapsoProceso."' "; 
								$sSQL.= "AND acta<>'".$acta."' AND c_asigna='".$c_asigna."' ";
								$sSQL.= "AND seccion<>'".$seccion."' AND status IN (7,'A') ";
								$Cagr->ExecSQL($sSQL,__LINE__,true);

								# Cambiar total de cupos en tblaca004
								$mSQL = "UPDATE tblaca004 SET inscritos=inscritos-1 ";
								$mSQL.= "WHERE lapso='".$lapsoProceso."' AND acta='".$actaP."' ";
								$mSQL.= "AND c_asigna='".$c_asigna."' AND seccion='".$seccionP."' ";
								$Cagr->ExecSQL($mSQL,__LINE__,true);

								if(!empty($labP)){// Si tiene laboratorio
									
									# Cambiar total de cupos en tblaca004_lab
									$mSQL = "UPDATE tblaca004_lab SET inscritos=inscritos-1 ";
									$mSQL.= "WHERE lapso='".$lapsoProceso."' AND c_asigna='".$c_asigna."' ";
									$mSQL.= "AND seccion='".$seccionP."' AND grupo='".$labP."' ";
									$Cagr->ExecSQL($mSQL,__LINE__,true);
									
								}// fin $tiene_lab

								### Con el cupo libre reviso si hay estudiantes en cola en $seccionP
####### VALIDACION DE CORREQUISITOS ANTES DE SUBIR LA COLA

	#OJO SELECCIONAR LOS CORREQUISITOS DE LA ASIGNATURA ANTES DE BUSCAR EL PRIMERO DE LA COLA
	$mSQL = "SELECT par_cod_asig1,par_cod_asig2,par_cod_asig3 ";
	$mSQL.= "FROM tblaca009 ";
	$mSQL.= "WHERE c_asigna='".$c_asigna."' AND pensum='5'";
	//@$mSQL.= "AND pensum='".$p."' AND c_uni_ca='".$c."'"; // OJO ES NECESARIA ESTA CONDICION?
	$Cagr->ExecSQL($mSQL, __LINE__,true);

	$co_req = $Cagr->result;
											
	@$co_req = array_values(array_diff($co_req[0], array('')));

	# >>> el array $co_req contiene los co-requisitos para la asignatura $asig.
								
	$cSQL[0] = "SELECT nro_prof,exp_e,status FROM dace006 WHERE lapso='".$lapsoProceso."' ";
	$cSQL[0].= "AND c_asigna='".$c_asigna."'  AND seccion='".$seccionP."' AND status IN ('Y') ";

	if (count($co_req) > 0) {// Si tiene correquisitos
		$cSQL[3] = "AND exp_e IN (";
		$cSQL[1] = "";// select de DACE006
		$cSQL[2] = "";// select de DACE004
		
		for ($i=0; $i < count($co_req); $i++){
			((count($co_req) > 1) && ($i != count($co_req)-1)) ? $union = " UNION " : $union = " "; 

			$cSQL[1].= "SELECT exp_e FROM dace006 WHERE lapso='".$lapsoProceso."' ";
			$cSQL[1].= "AND c_asigna='".$co_req[$i]."' AND status IN (7,'A') ".$union;

			$cSQL[2].= "SELECT exp_e FROM dace004 WHERE c_asigna='".$co_req[$i]."' ";
			$cSQL[2].= "AND status IN ('0','3','B','C') ".$union;
		}

		$coSQL = $cSQL[0].$cSQL[3].$cSQL[1].") UNION ".$cSQL[0].$cSQL[3].$cSQL[2].") ORDER BY 1,2 ";
	} else {// No tiene correquisitos
		$coSQL = $cSQL[0];
	}

	$Cagr->ExecSQL($coSQL, __LINE__,true);

############# FIN VALIDACION CORREQUISITOS


				if ($Cagr->filas > 0){// Si hay estudiantes en cola en $seccionP

					$max = $Cagr->result[0][0];
					$exp_max=$Cagr->result[0][1];					
					$status = $Cagr->result[0][2];

					//Cambiamos el status en dace006 de 'Y'(cola) o 'E'(espera) a 'A'(agregado)
					$rSQL = "UPDATE dace006 SET status='A', incluye='".$labP."', ";
					$rSQL.= "fecha='".$fecha."' ";
					$rSQL.= "WHERE c_asigna='".$c_asigna."' AND ";
					$rSQL.= "seccion='".$seccionP."' AND lapso='".$lapsoProceso."' AND nro_prof='".$max."' ";
					$rSQL.= "AND exp_e='".$exp_max."' AND status IN ('Y')";
					$Cagr->ExecSQL($rSQL,__LINE__,true);
					
					if ($Cagr->fmodif == '1'){
						#echo "incrementa 1 en tblaca004";
						$rSQL = "UPDATE tblaca004 SET inscritos=inscritos+1 WHERE ";
						$rSQL.= "c_asigna='".$c_asigna."' AND seccion='".$seccionP."' AND lapso='".$lapsoProceso."' AND inscritos<tot_cup ";
						$Cagr->ExecSQL($rSQL,__LINE__,true);
						if ($Cagr->fmodif == 1) {
							#echo "incrementa 1 en tblaca004_lab";
							$rSQL = "UPDATE tblaca004_lab SET inscritos=inscritos+1 WHERE ";
							$rSQL.= "c_asigna='".$c_asigna."' AND seccion='".$seccionP."' AND  grupo='".$labP."' AND lapso='".$lapsoProceso."' AND inscritos<tot_cup ";
							$Cagr->ExecSQL($rSQL,__LINE__,true);
						}
					}					


				}



							}// Fin ya esta inscrito
######################   FIN MODIFICACION   ###########################

							$mSQL = "UPDATE dace006 SET status='A', fecha='".$fecha."'".$campog;
							$mSQL.= "WHERE exp_e='".$exp_e."' AND lapso='".$lapsoProceso."' "; 
							$mSQL.= "AND acta='".$acta."' AND c_asigna='".$c_asigna."' ";
							$mSQL.= "AND seccion='".$seccion."' ";
							$Cagr->ExecSQL($mSQL,__LINE__,true);
							$j+=$Cagr->fmodif;		
						}// fin fmodif > 0					
					}// fin cumple correq
				}else{// Si no hay cupó
					$msge = true;
					$msgerror.= "<br>- No hay cupo disponible en la seccion.";
				}// fin if $haycupo
			}// fin if strlen($campo) <= 2
		}// fin foreach


###### ACTUALIZO TOTALES EN TBLACA004 Y TBALACA004_LAB
		$iSQL = "SELECT DISTINCT exp_e FROM dace006 WHERE lapso='".$lapsoProceso."' ";
		$iSQL.= "AND acta='".$acta."' AND c_asigna='".$c_asigna."' ";
		$iSQL.= "AND seccion='".$seccion."' AND status IN ('7','A')";
		$Cagr->ExecSQL($iSQL,__LINE__,true);
		$inscritos = $Cagr->filas;

		$iSQL = "SELECT tot_cup FROM tblaca004 WHERE lapso='".$lapsoProceso."' ";
		$iSQL.= "AND acta='".$acta."' AND c_asigna='".$c_asigna."' ";
		$iSQL.= "AND seccion='".$seccion."' AND inscritos > 0 ";
		$Cagr->ExecSQL($iSQL,__LINE__,true);
		$tot_cupos = $Cagr->filas;

		# Actualizar el total de cupos en tblaca004
		$mSQL = "UPDATE tblaca004 SET inscritos=".$inscritos." ";
		if ($tot_cupos < $inscritos) {
			$mSQL.= ", tot_cup=".$inscritos;
		}
		$mSQL.= " WHERE lapso='".$lapsoProceso."' AND acta='".$acta."' ";
		$mSQL.= " AND c_asigna='".$c_asigna."' AND seccion='".$seccion."' ";
		$Cagr->ExecSQL($mSQL,__LINE__,true);

		if($tiene_lab){// Si tiene laboratorio
			for ($g=1;$g<=3;$g++){
				$iSQL = "SELECT DISTINCT exp_e FROM dace006 WHERE lapso='".$lapsoProceso."' ";
				$iSQL.= "AND acta='".$acta."' AND c_asigna='".$c_asigna."' ";
				$iSQL.= "AND seccion='".$seccion."' AND status IN ('7','A')";
				$iSQL.= "AND incluye='G".$g."' ";
				$Cagr->ExecSQL($iSQL,__LINE__,true);
				$inscritos_l = $Cagr->filas;

				# Actualizar el total de cupos en tblaca004_lab
				//$mSQL = "UPDATE tblaca004_lab SET inscritos=".$inscritos_l.", tot_cup=".$inscritos_l;
				$mSQL = "UPDATE tblaca004_lab SET inscritos=".$inscritos_l." ";
				/*if ($inscritos_1 > 40) {
					$mSQL.= ", tot_cup=".$inscritos;
				}*/
				$mSQL.= " WHERE lapso='".$lapsoProceso."' AND acta='".$acta."' ";
				$mSQL.= " AND c_asigna='".$c_asigna."' AND seccion='".$seccion."' ";
				$mSQL.= " AND grupo='G".$g."' ";
				$Cagr->ExecSQL($mSQL,__LINE__,true);			
			}
		}// fin tiene laboratorio

		$Cagr->finalizarTransaccion("Fin agregado: - Acta => ".$acta." - Codigo => ".$c_asigna." - Seccion => ".$seccion." TOTAL AGREGADOS: ".$j." ");
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
	$mSQL= $mSQL."and b.acta=f.acta and f.ci=e.ci and b.status NOT IN ('Y','Z','E','X') order by 2 ";
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

			//alert(contador.value+' > '+limite_ag.value);

			if (contador.value > parseInt(limite_ag.value)) {

				(limite_ag.value == 1) ? tantos = 'estudiante': tantos = 'estudiantes';

				alert('Solo puede seleccionar '+limite_ag.value+' '+tantos+'.\n\nHa seleccionado el maximo de estudiantes permitido para esta seccion.');
				
				casilla.checked = false;
				contador.value--;
			}
		} // fin with
	}// Fin funcion

	function verificar (formulario){
		with(formulario){
			if (contador.value > parseInt(limite_ag.value)) {
			//if (false){
				
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
				if (isset($j)){// 
					
					($j == 1) ? $msg = " ha agregado <b>".$j."</b> estudiante" : $msg = " han agregado <b>".$j."</b> estudiantes";

					print "<tr><td colspan=\"7\" class=\"inact2\">Se ".$msg." a la secci&oacute;n</td></tr>";				
				}

				if($msge){// si hay mensajes de error
					print "<tr><td colspan=\"7\" class=\"inact2\" style=\"color:red;font-size:12px;\">".$msgerror."<br><br></td></tr>";
				}

			?>
		<tr><td colspan="7" bgcolor="#000000" align="center"></td></tr></table>

	<?php

	//Lista de Estudiantes INSCRITOS
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
	$mSQL.= "and b.status IN ('Y','E') ORDER BY nro_prof";
	$Cmat->ExecSQL($mSQL,__LINE__,true);
	$lista_e=$Cmat->result;
	$total=$Cmat->filas;

	if($total > 0){

		$limite_ag = ($limite - $total_insc);

		($limite_ag == 1) ? $tantos = " estudiante" : $tantos = " estudiantes";

//		($limite_ag <= 0) ? $desactivado = " disabled" : $desactivado = " ";

		if ($limite_ag <= 0){
			$desactivado = " disabled";
			$limite_ag = 0;		
		}else{
			$desactivado = " ";
		}

		?>

	<BR>
	<form action="" method="POST" name="lista_cola" >

	<table align="center" border="1" cellpadding="0" cellspacing="1" width="660" style="border-collapse: collapse;border-color:black;">
		<tr bgcolor="#FFFF99" class="enc_p2" >
			<td style="width: 600px;" colspan="6">
				ESTUDIANTES EN COLA (<?=$total?>)<br><br>
				El l&iacute;mite para cada secci&oacute;n es de <?php echo $limite ?> estudiantes.
				<br><br>

				<?php //if ($limite_ag > 0) { }?>

					Puede seleccionar un m&aacute;ximo de
					<input type="text" size="1" name="limite_ag" value="<?php echo $limite_ag ?> " style="border-style: solid; border-width: 0px; text-align: center; font-family: arial; font-size: 12px; color: #FF0000; background-color: #FFFF99; font-weight:bold;" readonly> <?php echo $tantos ?>  para agregar. &nbsp;&nbsp;&nbsp; Ha seleccionado
					<input type="text" size="1" name="contador" value="0" style="border-style: solid; border-width: 0px; text-align: center; font-family: arial; font-size: 12px; color: #FF0000; background-color: #FFFF99; font-weight:bold;" readonly> 

					<BR><BR>
					Le recordamos que debe procesar todos sus agregados al mismo tiempo.
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
					print "<td> <div class=\"inact\"> <input type=\"checkbox\" $desactivado $bdesactivado name=\"$nro\" value=\"$est[0]\" onclick=\"control_seleccion(this);\"></div></td>";
					//numero de la lista
					print "<td><div class=\"inact\">$nro</div></td>";
					//expediente
					print "<td><div class=\"inact\">$est[0]</div></td>";
					//apellidos
					print "<td><div class=\"inact2\">$est[1] $est[2]</div></td>";
					//nombres
					print "<td><div class=\"inact2\">$est[3] $est[4]</div></td>";
					if (($est[5] == 'Y') or ($est[5] == 'E')) {
						//estatus en cola

						$camb = ($est[5] == 'E') ? "<span style=\"font-size:9px;\">(CAMBIO SECC.) </span>" : " ";

						print "<td><div class=\"inact\">EN COLA ".$camb."</div></td>";
					} else {
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


					<br><input type="button" value="agregar" class="boton" <?php echo $desactivado." ".$bdesactivado; ?> onClick="verificar(this.form);">
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
	echo "<script>document.location.href='../autag_mb';</script>\n";
}

