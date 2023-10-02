<?php

include_once('inc/vImage.php');
include_once('inc/odbcss_c.php');
include_once ('inc/config.php');
include_once ('inc/activaerror.php');

print $noCache; 
print $noJavaScript; 

//print $lapsoProceso;print "<BR>";
//print_r($HTTP_POST_VARS);

$fecha = date('Y-m-d', time() - 3600*date('I'));
$hora = date('h:i:s', time() - 3600*date('I'));

if (isset($_POST['update'])){
	//DATOS PERSONALES
	$nac = $_POST['nac_eS'];
	$ci = $_POST['cedula'];
	$resid = $_POST['res_extrajS'];
	$docum = $_POST['doc_identS'];
	$passport = $_POST['pasaporte_nro'];
	$apellidos = strtoupper($_POST['apellidos']);
	$nombres = strtoupper($_POST['nombres']);
	$email = $_POST['correo_e'];
	$fnac = $_POST['f_nac'];
	$paisn = strtoupper($_POST['p_nac_e']);
	$lugarn = strtoupper($_POST['l_nac_e']);
	$edad = $_POST['edad'];
	$edocivil = $_POST['edo_c_eS'];
	$sexo = $_POST['sexoS'];
	$chijos = $_POST['c_hijos'];
	$edad = $_POST['edad'];
	$direccion = strtoupper($_POST['direccion']);
	$telff = $_POST['telefono'];
	$telfm = $_POST['celnro'];
	$cargo = $_POST['cargo'];

	//LIMPIAMOS REGISTROS
	$Cnot = new ODBC_Conn("FDOCENTE","N","N");
	$mSQL = "DELETE FROM DPERSONALES WHERE CI='$ci'";
	$Cnot->ExecSQL($mSQL);

	//INSERTAMOS LOS DATOS PERSONALES
	$Cnot = new ODBC_Conn("FDOCENTE","N","N");
	$mSQL = "INSERT INTO DPERSONALES (NAC,CI,RESIDENCIA,DOC_IDENT,PASAPORTE_NRO,APELLIDOS,NOMBRES,EMAIL,";
	$mSQL= $mSQL."F_NAC,PAIS_NAC,LUGAR_NAC,EDAD,EDO_C,DIRECCION,TELF_H,TELF_M,SEXO,HIJOS,CARGO)";
	$mSQL= $mSQL." VALUES  ('$nac','$ci','$resid','$docum','$passport','$apellidos','$nombres','$email',";
	$mSQL= $mSQL."'$fnac','$paisn','$lugarn','$edad','$edocivil','$direccion','$telff','$telfm',";
	$mSQL= $mSQL."'$sexo','$chijos','$cargo')";
	$Cnot->ExecSQL($mSQL);

	//PERFIL ACTUAL
	$ingpub = $_POST['ing_pub'];
	$ingunexpo = $_POST['ing_unexpo'];
	$dpto = $_POST['dpto'];
	$estatus = $_POST['estatus'];
	@$clasif = $_POST['clasif'];
	$dedic = $_POST['dedic'];
	$seccS = $_POST['seccS'];
	$jefatura = $_POST['jefatura'];
	$cotroc = $_POST['c_otroc'];

	//PERFIL HISTORICO
	$math = $_POST['c_math'];
	$otroch = $_POST['c_otroch'];

	//DATOS ACADEMICOS
	$cpreg = $_POST['pregS'];
	$cpostg = $_POST['c_postg'];
	$ccursos = $_POST['c_cursos'];
	$cpubli = $_POST['c_publi'];
	$cconcur = $_POST['c_concur'];
	$cinves = $_POST['c_inves'];
	$ccomu = $_POST['c_comu'];
	$ctas = $_POST['c_tas'];
	$cttg = $_POST['c_ttg'];

	//LIMPIAMOS REGISTROS
	$Cnot = new ODBC_Conn("FDOCENTE","N","N");
	$mSQL = "DELETE FROM DPERFIL_A WHERE CI_D='$ci'";
	$Cnot->ExecSQL($mSQL);

	//INSERTAMOS LOS DATOS DEL PERFIL ACTUAL
	$Cnot = new ODBC_Conn("FDOCENTE","N","N");
	$mSQL = "INSERT INTO DPERFIL_A (CI_D,LAPSO,ING_PUB,ING_UNEXPO,DPTO,ESTATUS,CLASIFICACION,";
	$mSQL= $mSQL."DEDICACION,SECCIONES,JEFATURA,OTROS_CARGOS,OTRAS_MATERIAS,OTROS_CARG_H,";
	$mSQL= $mSQL."PREGRADOS,POSTGRADOS,CURSOS,PUBLICACIONES,CONCURSOS,";
	$mSQL= $mSQL."INVESTIGACIONES,COMUNITARIOS,ASCENSOS,TT_GRADO) ";
	$mSQL= $mSQL." VALUES  ('$ci','$lapsoProceso','$ingpub','$ingunexpo','$dpto','$estatus','$clasif',";
	$mSQL= $mSQL."'$dedic','$seccS','$jefatura','$cotroc','$math','$otroch','$cpreg','$cpostg',";
	$mSQL= $mSQL."'$ccursos','$cpubli','$cconcur','$cinves','$ccomu','$ctas','$cttg')";
	$Cnot->ExecSQL($mSQL);
}
else {
	//DATOS PERSONALES
	$nac = $_POST['nac_eS'];
	$ci = $_POST['cedula'];
	$resid = $_POST['res_extrajS'];
	$docum = $_POST['doc_identS'];
	$passport = $_POST['pasaporte_nro'];
	$apellidos = strtoupper($_POST['apellidos']);
	$nombres = strtoupper($_POST['nombres']);
	$email = $_POST['correo_e'];
	$fnac = '19'.$_POST['anioN'].'-'.$_POST['mesN'].'-'.$_POST['diaN'];
	$paisn = strtoupper($_POST['p_nac_e']);
	$lugarn = strtoupper($_POST['l_nac_e']);
	$edad = $_POST['edad'];
	$edocivil = $_POST['edo_c_eS'];
	$sexo = $_POST['sexoS'];
	$chijos = $_POST['c_hijos'];
	$edad = $_POST['edad'];
	$direccion = strtoupper($_POST['avCalle'].', '.$_POST['barrio'].', '.$_POST['casa'].', '.$_POST['ciudad'].', '.$_POST['estado']);
	$telff = $_POST['codT'].'-'.$_POST['telefono'];
	$telfm = $_POST['celcod'].'-'.$_POST['celnro'];
	$cargo = $_POST['cargo'];

	//LIMPIAMOS REGISTROS
	$Cnot = new ODBC_Conn("FDOCENTE","N","N");
	$mSQL = "DELETE FROM DPERFIL_A WHERE CI_D='$ci'";
	$Cnot->ExecSQL($mSQL);

	//INSERTAMOS LOS DATOS PERSONALES
	$Cnot = new ODBC_Conn("FDOCENTE","N","N");
	$mSQL = "INSERT INTO DPERSONALES (NAC,CI,RESIDENCIA,DOC_IDENT,PASAPORTE_NRO,APELLIDOS,NOMBRES,EMAIL,";
	$mSQL= $mSQL."F_NAC,PAIS_NAC,LUGAR_NAC,EDAD,EDO_C,DIRECCION,TELF_H,TELF_M,SEXO,HIJOS,CARGO)";
	$mSQL= $mSQL." VALUES  ('$nac','$ci','$resid','$docum','$passport','$apellidos','$nombres','$email',";
	$mSQL= $mSQL."'$fnac','$paisn','$lugarn','$edad','$edocivil','$direccion','$telff','$telfm',";
	$mSQL= $mSQL."'$sexo','$chijos','$cargo')";
	$Cnot->ExecSQL($mSQL);

	//PERFIL ACTUAL
	$ingpub = $_POST['ing_pub'];
	$ingunexpo = $_POST['ing_unexpo'];
	$dpto = $_POST['dpto'];
	$estatus = $_POST['estatus'];
	@$clasif = $_POST['clasif'];
	$dedic = $_POST['dedic'];
	$seccS = $_POST['seccS'];
	$jefatura = $_POST['jefatura'];
	$cotroc = $_POST['c_otroc'];

	//PERFIL HISTORICO
	$math = $_POST['c_math'];
	$otroch = $_POST['c_otroch'];

	//DATOS ACADEMICOS
	$cpreg = $_POST['pregS'];
	$cpostg = $_POST['c_postg'];
	$ccursos = $_POST['c_cursos'];
	$cpubli = $_POST['c_publi'];
	$cconcur = $_POST['c_concur'];
	$cinves = $_POST['c_inves'];
	$ccomu = $_POST['c_comu'];
	$ctas = $_POST['c_tas'];
	$cttg = $_POST['c_ttg'];

	//INSERTAMOS LOS DATOS DEL PERFIL ACTUAL
	$Cnot = new ODBC_Conn("FDOCENTE","N","N");
	$mSQL = "INSERT INTO DPERFIL_A (CI_D,LAPSO,ING_PUB,ING_UNEXPO,DPTO,ESTATUS,CLASIFICACION,";
	$mSQL= $mSQL."DEDICACION,SECCIONES,JEFATURA,OTROS_CARGOS,OTRAS_MATERIAS,OTROS_CARG_H,";
	$mSQL= $mSQL."PREGRADOS,POSTGRADOS,CURSOS,PUBLICACIONES,CONCURSOS,";
	$mSQL= $mSQL."INVESTIGACIONES,COMUNITARIOS,ASCENSOS,TT_GRADO) ";
	$mSQL= $mSQL." VALUES  ('$ci','$lapsoProceso','$ingpub','$ingunexpo','$dpto','$estatus','$clasif',";
	$mSQL= $mSQL."'$dedic','$seccS','$jefatura','$cotroc','$math','$otroch','$cpreg','$cpostg',";
	$mSQL= $mSQL."'$ccursos','$cpubli','$cconcur','$cinves','$ccomu','$ctas','$cttg')";
	$Cnot->ExecSQL($mSQL);
}





?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>

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
.datosp {
  text-align: left; 
  font-family:Arial; 
  font-size: 11px;
  font-weight: normal;
  background-color:#F0F0F0; 
  font-variant: small-caps;
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
.inact {
  text-align: center; 
  font-family:Arial; 
  font-size: 12px; 
  font-weight: normal;
  background-color:#FFFFFF;
}
.inact2 {
  text-align: left; 
  font-family:Arial; 
  font-size: 12px; 
  font-weight: normal;
  background-color:#F0F0F0;
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
  font-size: 12px;
  font-weight: normal;
  background-color:#FFFFFF; 
  font-variant: small-caps;
}
.datosp2 {
  text-align: left; 
  font-family:Arial; 
  font-size: 11px;
  font-weight: bold;
  background-color:#FFFFFF; 
  font-variant: small-caps;
}
.datosp3 {
  text-align: left; 
  font-family:Arial; 
  font-size: 11px;
  font-weight: normal;
  background-color:#FFFFFF; 
  font-variant: small-caps;
}
.datospf {
  text-align: right; 
  font-family:Arial; 
  font-size: 11px;
  font-weight: normal;
  background-color:#FFFFFF; 
  font-variant: small-caps;
  border-style: solid;
  border-width: 1px;
  border-color: #96BBF3;
  text-transform:uppercase;
}


-->
</style>

<title><?php echo $tProceso?> > Planilla de Datos</title>
</head>

<body>
<BR>
<table border="0" width="750" id="table1" cellspacing="1" cellpadding="0" style="border-collapse: collapse;border-color:blue;" align="left">
	<tr>
		<td class="inact"><IMG SRC="imagenes/unex15.gif" WIDTH="75" HEIGHT="75" BORDER="0" ALT=""></td>
				
		<td class="inact">Universidad Nacional Experimental Polit&eacute;cnica<BR>"Antonio Jos&eacute; de Sucre"<BR>Vicerrectorado&nbsp;<? print $vicerrectorado?><BR><? print $nombreDependencia  ?>
		</td>
	<tr>
	<tr><td align="center" colspan="2"><FONT SIZE="3" COLOR="#000000" face="arial"><B>FICHA DE DATOS DOCENTE <?print $lapsoProceso;?></B></FONT></td></tr>
</table><BR>
<TABLE border="0" width="750" align="left">
<TR class="datospf">
	<TD><?	$fecha  = date('d/m/Y', time() - 3600*date('I'));
	$hora   = date('h:i:s', time() - 3600*date('I'));
	print $fecha.' '.$hora;
?></TD>
</TR>
</TABLE>
<br>

<table border="0" width="750" id="table1" cellspacing="1" cellpadding="0" style="border-collapse: collapse;border-color:blue;">
<tr><td colspan="4">
<HR width="750" align="left">
<div class="datosp">Datos Personales</div>
<HR width="750" align="left">
</td></tr>
	<tr class="datosp2">
				<td style="width: 150px;" >C&eacute;dula:</td>
				<td style="width: 150px;">Tipo:</td>
				<td style="width: 150px;">Documento:</td>
				<td style="width: 150px;">N&uacute;mero:</td>
            </tr>           

			<tr>
				<td style="width: 150px;" class="datosp">
					<?print $nac.'&nbsp;-&nbsp;'.$ci;?>
				</td>

				<td style="width: 150px;" class="datosp">
					<?print $resid?>
				</td>
				<td style="width: 150px;" class="datosp">
					<?print $docum?>
				</td>
				<td style="width: 150px;" class="datosp">
					<?print $passport?>
				</td>
            </tr>

			<tr class="datosp2">
				<td style="width: 220px;" >Apellidos Completos:</td>
                <td style="width: 220px;" >Nombres Completos:</td>
                <td style="width: 150px;" >Correo electr&oacute;nico:</td>
                
            </tr>
            <tr>
				<td style="width: 150px;" class="datosp">
					<?print $apellidos?>
				</td>
                <td style="width: 150px;" class="datosp">
					<?print $nombres?>
				</td>
				<td style="width: 150px;" class="datosp">
					<?print $email?>
				</td>
            </tr>
		
			<tr class="datosp2">
				<td style="width: 220px;" >Fecha de Nacimiento:</td>
                <td style="width: 220px;" >Pa&iacute;s de Nacimiento:</td>
                <td style="width: 150px;" >Lugar de Nacimiento:</td>
                
            </tr>
            <tr>
				<td style="width: 150px;" class="datosp">
					<?print $fnac?>
				</td>
                <td style="width: 150px;" class="datosp">
					<?print $paisn?>
				</td>
				<td style="width: 150px;" class="datosp">
					<?print $lugarn?>
				</td>
			</tr>
            <tr class="datosp2">
				<td style="width: 220px;" >Edad:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						Estado Civil:</td>
				<td style="width: 220px;" >Sexo:</td>
                <td style="width: 220px;" >Hijos:</td>
                <td style="width: 150px;" >&nbsp;</td>
            </tr>
            <tr>
				<td style="width: 150px;" class="datosp">
					<?print $edad.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$edocivil;?>
				</td>
				<td style="width: 150px;" class="datosp">
					<?print $sexo?>
				</td>
				<td style="width: 150px;" class="datosp">
					<?print $chijos?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<INPUT TYPE="button" id="datos" value="ver datos" class="boton" style="width: 60px;" onClick="enviaH();">
					<INPUT TYPE="hidden" id="hijos" value="<?print$chijos;?>">
					<INPUT TYPE="hidden" id="padre" value="<?print$ci;?>">
					<SCRIPT LANGUAGE="JavaScript">
						<!--
						function enviaH() {
						var a = document.getElementById("hijos").value;
						var b = document.getElementById("padre").value;
						window.open('consultarh.php?hijos=' + a +'&padre=' + b,'POPUP','toolbar=no,status=no,scrollbars=yes,resizable=no,height=400,width=800,left=110, screenX=0,top=150,screenY=0');
						
						}

						//-->
					</SCRIPT>
				</td>

			</tr>
			
			<tr class="datosp">
				<td colspan="4"><BR><HR width="750" align="left">Datos de Ubicacion<BR><HR width="750" align="left"></td>				
			</tr>
			<tr class="datosp2">
                    <td style="width: 200px;" >Direccion General:</td>
					
            </tr>
			<td style="width: 150px;" class="datosp" colspan="4">
					<?print $direccion;?>
				</td>
            </tr>
			<tr class="datosp2">
                    <td style="width: 200px;" >Tlf Hab:</td>
					<td style="width: 200px;" >Tlf Celular:</td>
            </tr>
            <tr>
				<td style="width: 150px;" class="datosp">
					<?print $telff;?>
				</td>
				<td style="width: 150px;" class="datosp">
					<?print $telfm;?>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
</table>
<HR width="750" align="left">
<div class="datosp">Perfil Actual</div>
<HR width="750" align="left">
<table border="0" width="750" id="table1" cellspacing="1" cellpadding="0" style="border-collapse: collapse;border-color:blue;">
	<tr class="datosp">
					<td style="width: 200px;">Ingreso a la Adm. Publica:</td>
					<td style="width: 200px;">Ingreso a la UNEXPO:</td>
					<td style="width: 200px;">Dpto. al que pertenece:</td>
					<td style="width: 200px;">Estatus:</td>
                </tr>
                <tr>
                    <td style="width: 150px;" class="datosp">
						<?print $ingpub;?>
					</td>
					<td style="width: 150px;" class="datosp">
						<?print $ingunexpo;?>
					</td>
					<td style="width: 150px;" class="datosp">
						<?print $dpto;?>
					</td>
					<td style="width: 150px;" class="datosp">
						<?print $estatus;?>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr class="datosp">
					<td style="width: 100px;">Clasificacion:</td>
					<td style="width: 100px;">Dedicacion:</td>
					<td style="width: 95px;" colspan="2">Asignaturas que dicta actualmente:</td>
				</tr>
				<tr>
					<td style="width: 150px;" class="datosp">
						<?print $clasif;?>
					</td>
					<td style="width: 150px;" class="datosp" >
						<?print $dedic;?>
					</td>
					</td>
					<td style="width: 150px;" class="datosp">
						<?print $seccS;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<INPUT TYPE="button" id="datos" value="ver datos" class="boton" style="width: 60px;" onClick="enviaM();">
							<INPUT TYPE="hidden" id="mat" value="<?print$seccS;?>">
							<INPUT TYPE="hidden" id="padre" value="<?print$ci;?>">
					</td>
						<SCRIPT LANGUAGE="JavaScript">
						<!--
						function enviaM() {
							var a = document.getElementById("mat").value;
							var b = document.getElementById("padre").value;
							window.open('consultarmata.php?materias=' + a +'&doc=' + b,'POPUP','toolbar=no,status=no,scrollbars=yes,resizable=no,height=400,width=650,left=110, screenX=0,top=150,screenY=0');
							
						}

						//-->
						</SCRIPT>
					
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr class="datosp">
					<td style="width: 300px;">
						<div>Ejerce un Cargo de jefatura <BR> actualmente en la UNEXPO:</div></td>
					<td style="width: 150px;" class="datosp">
						<?print $jefatura;?>
					</td>
					<td style="width: 300px;">Ejerce o ha ejercido otros <BR>Cargos en la Adm. P&uacute;blica:</td>
					<td style="width: 150px;" class="datosp">
						<?print $cotroc;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<INPUT TYPE="button" id="datos" value="ver datos" class="boton" style="width: 60px;" onClick="enviaOC();">
							<INPUT TYPE="hidden" id="otroc" value="<?print$cotroc;?>">
							<INPUT TYPE="hidden" id="padre" value="<?print$ci;?>">
					</td>
								
					<SCRIPT LANGUAGE="JavaScript">
							<!--
							function enviaOC() {
								var a = document.getElementById("otroc").value;
								var b = document.getElementById("padre").value;
								window.open('consultaroc.php?cargos=' + a +'&doc=' + b,'POPUP','toolbar=no,status=no,scrollbars=yes,resizable=no,height=400,width=650,left=110, screenX=0,top=150,screenY=0');
								
							}

							//-->
					</SCRIPT>
									
				</tr>
				
				<tr>
					<td>&nbsp;</td>
				</tr> 
				<tr class="datosp">
					

					
				</tr>

</table>
<HR width="750" align="left">
<div class="datosp">Perfil Historico</div>
<HR width="750" align="left">
<table border="0" width="750" id="table1" cellspacing="1" cellpadding="0" style="border-collapse: collapse;border-color:blue;">
	<tr class="datosp">
					<td style="width: 80px;">Ha dictado otras materias en la UNEXPO:</td>
					<td style="width: 150px;" class="datosp">
						<?print $math;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<INPUT TYPE="button" id="datos" value="ver datos" class="boton" style="width: 60px;" onClick="enviaMH();">
							<INPUT TYPE="hidden" id="math" value="<?print$math;?>">
							<INPUT TYPE="hidden" id="padre" value="<?print$ci;?>">
					</td>
						<SCRIPT LANGUAGE="JavaScript">
							<!--
							function enviaMH() {
								var a = document.getElementById("math").value;
								var b = document.getElementById("padre").value;
								window.open('consultarmath.php?materias=' + a +'&doc=' + b,'POPUP','toolbar=no,status=no,scrollbars=yes,resizable=no,height=400,width=650,left=110, screenX=0,top=150,screenY=0');
								
							}

							//-->
					</SCRIPT>

					
				</tr>
				<tr>
					<td>&nbsp;</td>
					
				</tr> 
				<tr class="datosp">
					<td style="width: 80px;">Ha ejercido otros cargos en la UNEXPO: &nbsp;</td>
					<td style="width: 150px;" class="datosp">
						<?print $otroch;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<INPUT TYPE="button" id="datos" value="ver datos" class="boton" style="width: 60px;" onClick="enviaOCH();">
							<INPUT TYPE="hidden" id="otroch" value="<?print$otroch;?>">
							<INPUT TYPE="hidden" id="padre" value="<?print$ci;?>">
					</td>

						<SCRIPT LANGUAGE="JavaScript">
							<!--
							function enviaOCH() {
								var a = document.getElementById("otroch").value;
								var b = document.getElementById("padre").value;
								window.open('consultaroch.php?cargos=' + a +'&doc=' + b,'POPUP','toolbar=no,status=no,scrollbars=yes,resizable=no,height=400,width=650,left=110, screenX=0,top=150,screenY=0');
								
							}

							//-->
					</SCRIPT>

					
				</tr>
				 <tr>
					<td>&nbsp;</td>
				</tr>            
</table>
<HR width="750" align="left">
<div class="datosp">Datos Acad&eacute;micos</div>
<HR width="750" align="left">
<table border="0" width="750" id="table1" cellspacing="1" cellpadding="0" style="border-collapse: collapse;border-color:blue;">
<tr class="datosp">
					<td style="width: 200px;">
						Cantidad T&iacute;tulos Pregrado:</td>
						<td style="width: 150px;" class="datosp">
						<?print $cpreg;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<INPUT TYPE="button" id="datos" value="ver datos" class="boton" style="width: 60px;" onClick="enviaPreG();">
							<INPUT TYPE="hidden" id="preg" value="<?print$cpreg;?>">
							<INPUT TYPE="hidden" id="padre" value="<?print$ci;?>">
						</td>
						<SCRIPT LANGUAGE="JavaScript">
						<!--
						function enviaPreG() {
							var a = document.getElementById("preg").value;
							var b = document.getElementById("padre").value;
							window.open('consultarpreg.php?pregrado=' + a +'&doc=' + b,'POPUP','toolbar=no,status=no,scrollbars=yes,resizable=no,height=400,width=650,left=110, screenX=0,top=150,screenY=0');
							
						}

						//-->
						</SCRIPT>
					
					</td>
					
					<td style="width: 200px;">
						Cantidad T&iacute;tulos Postgrado:</td>
						<td style="width: 150px;" class="datosp">
						<?print $cpostg;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<INPUT TYPE="button" id="datos" value="ver datos" class="boton" style="width: 60px;" onClick="enviaPostG();">
							<INPUT TYPE="hidden" id="postg" value="<?print$cpostg;?>">
							<INPUT TYPE="hidden" id="padre" value="<?print$ci;?>">										
						</td>

						<SCRIPT LANGUAGE="JavaScript">
							<!--
							function enviaPostG() {
								var a = document.getElementById("postg").value;
								var b = document.getElementById("padre").value;
								window.open('consultarpost.php?postgrados=' + a +'&doc=' + b,'POPUP','toolbar=no,status=no,scrollbars=yes,resizable=no,height=400,width=650,left=110, screenX=0,top=150,screenY=0');
								
							}

							//-->
					</SCRIPT>
                </tr>
				<tr><td>&nbsp;</td></tr>
				<tr class="datosp">
					<td style="width: 200px;">
						Cantidad Cursos Realizados:</td>
						<td style="width: 150px;" class="datosp">
						<?print $ccursos;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<INPUT TYPE="button" id="datos" value="ver datos" class="boton" style="width: 60px;" onClick="enviaCUR();">
							<INPUT TYPE="hidden" id="cursos" value="<?print$ccursos;?>">
							<INPUT TYPE="hidden" id="padre" value="<?print$ci;?>">										
						</td>

						<SCRIPT LANGUAGE="JavaScript">
							<!--
							function enviaCUR() {
								var a = document.getElementById("cursos").value;
								var b = document.getElementById("padre").value;
								window.open('consultarcursos.php?cursos=' + a +'&doc=' + b,'POPUP','toolbar=no,status=no,scrollbars=yes,resizable=no,height=400,width=650,left=110, screenX=0,top=150,screenY=0');
								
							}

							//-->
					</SCRIPT>
					</td>
					
				

				<td style="width: 200px;">
						Cantidad de Publicaciones:</td>
						<td style="width: 150px;" class="datosp">
						<?print $cpubli;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<INPUT TYPE="button" id="datos" value="ver datos" class="boton" style="width: 60px;" onClick="enviaPUB();">
							<INPUT TYPE="hidden" id="publi" value="<?print$cpubli;?>">
							<INPUT TYPE="hidden" id="padre" value="<?print$ci;?>">										
						</td>

						<SCRIPT LANGUAGE="JavaScript">
							<!--
							function enviaPUB() {
								var a = document.getElementById("publi").value;
								var b = document.getElementById("padre").value;
								window.open('consultarpub.php?publi=' + a +'&doc=' + b,'POPUP','toolbar=no,status=no,scrollbars=yes,resizable=no,height=400,width=650,left=110, screenX=0,top=150,screenY=0');
								
							}

							//-->
					</SCRIPT>
					</td>
					
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr class="datosp">
					<td style="width: 200px;">
						Cantidad de Concursos:</td>
						<td style="width: 150px;" class="datosp">
						<?print $cconcur;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<INPUT TYPE="button" id="datos" value="ver datos" class="boton" style="width: 60px;" onClick="enviaCON();">
							<INPUT TYPE="hidden" id="concur" value="<?print$cconcur;?>">
							<INPUT TYPE="hidden" id="padre" value="<?print$ci;?>">										
						</td>

						<SCRIPT LANGUAGE="JavaScript">
							<!--
							function enviaCON() {
								var a = document.getElementById("concur").value;
								var b = document.getElementById("padre").value;
								window.open('consultarconcur.php?concur=' + a +'&doc=' + b,'POPUP','toolbar=no,status=no,scrollbars=yes,resizable=no,height=400,width=650,left=110, screenX=0,top=150,screenY=0');
								
							}

							//-->
					</SCRIPT>
					</td>
					
					<td style="width: 200px;">
						Investigaciones en que participa:</td>
						<td style="width: 150px;" class="datosp">
						<?print $cinves;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<INPUT TYPE="button" id="datos" value="ver datos" class="boton" style="width: 60px;" onClick="enviaIN();">
							<INPUT TYPE="hidden" id="inves" value="<?print$cinves;?>">
							<INPUT TYPE="hidden" id="padre" value="<?print$ci;?>">										
						</td>

						<SCRIPT LANGUAGE="JavaScript">
							<!--
							function enviaIN() {
								var a = document.getElementById("inves").value;
								var b = document.getElementById("padre").value;
								window.open('consultarinves.php?invest=' + a +'&doc=' + b,'POPUP','toolbar=no,status=no,scrollbars=yes,resizable=no,height=400,width=650,left=110, screenX=0,top=150,screenY=0');
								
							}

							//-->
					</SCRIPT>
					</td>
					
				</tr>

				<tr><td>&nbsp;</td></tr>
				<tr class="datosp">
					<td style="width: 200px;">
						Trabajos Comunitarios:</td>
						<td style="width: 150px;" class="datosp">
						<?print $ccomu;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<INPUT TYPE="button" id="datos" value="ver datos" class="boton" style="width: 60px;" onClick="enviaCO();">
							<INPUT TYPE="hidden" id="comu" value="<?print$ccomu;?>">
							<INPUT TYPE="hidden" id="padre" value="<?print$ci;?>">										
						</td>

						<SCRIPT LANGUAGE="JavaScript">
							<!--
							function enviaCO() {
								var a = document.getElementById("comu").value;
								var b = document.getElementById("padre").value;
								window.open('consultarcomuni.php?comu=' + a +'&doc=' + b,'POPUP','toolbar=no,status=no,scrollbars=yes,resizable=no,height=400,width=650,left=110, screenX=0,top=150,screenY=0');
								
							}

							//-->
					</SCRIPT>
					</td>
					
					<td style="width: 200px;">
						Trabajos de Ascenso:</td>
						<td style="width: 150px;" class="datosp">
						<?print $ctas;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<INPUT TYPE="button" id="datos" value="ver datos" class="boton" style="width: 60px;" onClick="enviaTA();">
							<INPUT TYPE="hidden" id="tas" value="<?print$ctas;?>">
							<INPUT TYPE="hidden" id="padre" value="<?print$ci;?>">										
						</td>

						<SCRIPT LANGUAGE="JavaScript">
							<!--
							function enviaTA() {
								var a = document.getElementById("tas").value;
								var b = document.getElementById("padre").value;
								window.open('consultarascen.php?tas=' + a +'&doc=' + b,'POPUP','toolbar=no,status=no,scrollbars=yes,resizable=no,height=400,width=650,left=110, screenX=0,top=150,screenY=0');
								
							}

							//-->
					</SCRIPT>
					</td>
					
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr class="datosp">
					<td style="width: 200px;">
						Tutorias en Trabajos de Grado:</td>
						<td style="width: 150px;" class="datosp">
						<?print $cttg;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<INPUT TYPE="button" id="datos" value="ver datos" class="boton" style="width: 60px;" onClick="enviaTG();">
							<INPUT TYPE="hidden" id="ttg" value="<?print$cttg;?>">
							<INPUT TYPE="hidden" id="padre" value="<?print$ci;?>">										
						</td>

						<SCRIPT LANGUAGE="JavaScript">
							<!--
							function enviaTG() {
								var a = document.getElementById("ttg").value;
								var b = document.getElementById("padre").value;
								window.open('consultartutor.php?ttg=' + a +'&doc=' + b,'POPUP','toolbar=no,status=no,scrollbars=yes,resizable=no,height=400,width=650,left=110, screenX=0,top=150,screenY=0');
								
							}

							//-->
					</SCRIPT>
					</td>
					
				</tr>

				<tr>
					<td colspan="7">&nbsp;</td>										
				</tr>
                <!-- <tr class="datosp">
					<td colspan="7">Idiomas que domina:&nbsp;&nbsp;
						&nbsp;
					</td>										
				</tr> -->
		</table>
<HR width="750" align="left">
<table border="0" width="750" id="table1" cellspacing="1" cellpadding="0" style="border-collapse: collapse;border-color:blue;">
<tr>
                    
                    <td valign="top" colspan="3"><p align="center">
                        <BR><input type="button" style="width: 90px;" value="Cerrar"  name="cerrar" class="boton" 
                         onclick="javascript:self.close();"></p> 
                    </td>
					<td valign="top" colspan="4"><p align="center">
                        <BR><input type="reset" style="width: 90px;" value="Imprimir"  name="imprimir" class="boton" onclick="window.print();"></p> 
                    </td>
                   
                </tr>
</table>

</body>
<html>