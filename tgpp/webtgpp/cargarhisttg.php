<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
    <link rel="stylesheet" type="text/css" href="css/estilos.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link type="text/css" rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.16.custom.css"/>
    <script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
    <script language='javascript' src='js/popcalendar1.js'></script>
    <script language='javascript' src='js/validar.js'></script>
    <script type="text/javascript" src="js/autocomplet2.js"></script>
    <script type="text/javascript" src="js/autocomplet3.js"></script>
    <script type="text/javascript" src="js/autocomplet4.js"></script>
    <script type="text/javascript" src="js/contador.js"></script>
    <script type="text/javascript" src="js/charCount.js"></script>
    <script language="javascript">
    function setTextAreaListner(eve,func) {
    var ele = document.forms[0].elements;
    for(var i = 0; i <ele.length;i++) {
    element = ele[i];
    if (element.type) {
    switch (element.type) {
    case 'textarea':
    attachEvent(eve,element,func);
    }
    }
    }
    }
    </script>
    <script language="javascript">
    setTextAreaListner("keypress",maxLength);
    setTextAreaListner("paste",maxLengthPaste);
    </script>
    <title>Registro de Proyectos Trabajo de Grado</title>
    <script language=javascript>
    function fechaC(){
    var day=0, month=0, year=0;
    var fecha = document.getElementById('dateArrival').value
    var day = parseInt(fecha.substr(0,2));
    var month = parseInt(fecha.substr(3,2));	
    var year = parseInt(fecha.substr(6,4));
    var fechacul=0;
    if (day<10) day='0'+day;
    if (month<10) month='0'+month; 
    year=year+1;
    fechacul = day +"-"+ month +"-"+ year;
    document.getElementById('dateArrival1').value = fechacul
   }
   </script> 
    <script text=javascript>
        function tutor(){
        alert(document.getElementById('cedula_TA').value);
	}
    </script>
</head>
<body>
    <?php
    $_SESSION['cedula']=$_SESSION['cedula'];
	$_POST['cedulaest']=str_pad($_POST['cedulaest'],8,"0", STR_PAD_LEFT);
	//$_POST[cedulaest]='0'.$_POST[cedulaest];
    include_once('conexion.php');
	$sql1="select APELLIDOS, NOMBRES, EXP_E, C_UNI_CA, TELEFONO2 from dace002_grad where CI_E = '$_POST[cedulaest]'";
    $conex -> ExecSQL($sql1,__LINE__,true);
	$fila = $conex->filas;
	if ($fila==1)
	{
	    $reg1 = $conex->result_h;
	    $reg2 = $conex->result[0];
	    $reg = array_combine($reg1,$reg2);
	}
	else
	{
	$sql1="select APELLIDOS, NOMBRES, EXP_E, C_UNI_CA, TELEFONO2 from dace002 where CI_E = '$_POST[cedulaest]'";
    $conex -> ExecSQL($sql1,__LINE__,true);
	}
	$fila = $conex->filas;
	if ($fila==1)
	{
	    $reg1 = $conex->result_h;
	    $reg2 = $conex->result[0];
	    $reg = array_combine($reg1,$reg2);
    ?>
	<form name="Solicitud" action="histesttg.php" onSubmit="return validar(this)">
	    <table border="0px" align="center">
		<tr>
		    <td colspan="5" align="center">	
			<table border="0" width="600">
			    <tr>
				<td width="50">
				    <p align="right" style="margin-top: 0; margin-bottom: 0">
					<img border="0" src="images/unex15.gif" width="75" height="75">
				    </p>
				</td>
				<td width="500">
			            <p class="titulon">UNIVERSIDAD NACIONAL EXPERIMENTAL POLIT&Eacute;CNICA</p>
				    <p class="titulon">"ANTONIO JOS&Eacute; DE SUCRE"</p>
				    <p class="titulon">VICE-RECTORADO PUERTO ORDAZ</font></p>
				    <p class="titulon">ASIGNATURA TRABAJO DE GRADO</font>
				</td>
				<td border="0" width="50">&nbsp;</td>
			    </tr>
			</table>
		    </td>
		</tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
	        <tr><td class="enc_p" colspan="5">DATOS DEL ESTUDIANTE</td></tr>
		<tr align="center">
		    <td colspan="5">
		        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
			    <tbody>
			        <tr>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Apellidos:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Nombres:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>C&eacute;dula:</B></div></td>
				</tr>
				<?php
				    printf('<tr>
					<td <div class="datosc">%s</div></td>
					<td <div class="datosc">%s</div></td>
					<td <div class="datosc">%s</div></td></tr>',$reg["APELLIDOS"],$reg["NOMBRES"],$_POST["cedulaest"]);
				?>
				<tr>
				    <td bgcolor="#FFFFFF"><div class="datosc"><B>Expediente:</B></div></td>
				    <td bgcolor="#FFFFFF"><div class="datosc"><B>Especialidad:</B></div>
				    <td bgcolor="#FFFFFF" colspan="3"><div class="datosc"><B>Teléfono:</B></div>
				    </td>
				</tr>
				<?php
				    $sql1="select CARRERA from tblaca010 where C_UNI_CA= '$reg[C_UNI_CA]'";
				    $conex -> ExecSQL($sql1,__LINE__,true);
				    $fila = $conex->filas;
				    if ($fila==1)
				        {
				        $esp1 = $conex->result_h;
				        $esp2 = $conex->result[0];
				        $espe = array_combine($esp1,$esp2);
					printf('<tr>
					    <td bgcolor="#FFFFFF"><div class="datosc">%s</div></td>
					    <td bgcolor="#FFFFFF"><div class="datosc">%s</div></td>
					    <td bgcolor="#FFFFFF"><div class="datosc">%s</div></td></tr>', $reg["EXP_E"], $espe["CARRERA"], $reg["TELEFONO2"]);
					echo "<input type=\"hidden\" name=\"exp_e\" value=\"".$reg["EXP_E"]."\">";
					}
				$especialidad=$reg['C_UNI_CA'];
				$_SESSION['especialidad']=$especialidad;
				$_SESSION['cedulaest']=$_POST['cedulaest'];
				?>
			    </tbody>
			</table>
		    </td>
		</tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5"><font style="font-size:5px;">&nbsp;</font></td></tr>
		<?php
		if($especialidad!='5')
		{
		    $sql1="select ID_EMPRESA, EXP_E, TIPO_PASANTIA from sol_solicitudes where EXP_E= '$reg[EXP_E]' and TIPO_PASANTIA='2'";
		    $conex -> ExecSQL($sql1,__LINE__,true);
		    $fila = $conex->filas;
		    if ($fila==1)
			{
			$sol1 = $conex->result_h;
			$sol2 = $conex->result[0];
			$solicit = array_combine($sol1,$sol2);
			
			$sql1="select NOMBRE_EMPRESA from sol_empresas where ID_EMPRESA= '$solicit[ID_EMPRESA]'";
			$conex -> ExecSQL($sql1,__LINE__,true);
			$fila = $conex->filas;
			if ($fila==1)
			{
			    $emp1 = $conex->result_h;
			    $emp2 = $conex->result[0];
			    $empre = array_combine($emp1,$emp2);
			    if($solicit['EXP_E']=="" || $solicit['TIPO_PASANTIA']!="2" || $solicit['ID_EMPRESA']=="")
			    {
				echo ("ALGO ANDA MAL");
			    }
			    else
			    {
		?>
		<tr>
		    <td colspan="5">
		        <table width="100%">
			    <tbody>
				<tr>
				    <td style="text-align: center;" class="datosp">
					<strong>Empresa</strong>
				    </td>
				</tr>
				<tr>
				    <td style="text-align: center;" class="datosp">
				<tr>
				    <?php
				    printf('
				    <td bgcolor="#FFFFFF"><div  style="text-align:center;" class="datosp">%s</div></td>', $empre["NOMBRE_EMPRESA"]);
					    $empresa=$empre["NOMBRE_EMPRESA"];
					    $_SESSION['empresa']=$empresa;
				    ?>
				</tr>
			    </tbody>
			</table>
		    </td>
		</tr>
		<?php
		    	    }
			}
		    }
		}
		$_SESSION['TIPO_PASANTIA']=2;
		?>
		<tr>
		    <td colspan="5">
		        <table width="100%">
			    <tbody>
				
			    </tbody>
			</table>
		    </td>
		</tr>
		<tr><td colspan="5"><font style="font-size: 5px;">&nbsp;</font></td></tr>
		<tr>
		    <td width="100%">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
			    <tbody>
				<tr>
				    <td colspan="2" width="92%" style="text-align: center;" class="datosp">
					<strong>Nombre del Proyecto:</strong>
				    </td>
				    <td colspan="2">
					<div id="cuenta2" class="datosp"></div>
					<script>document.getElementById('cuenta2').innerHTML=document.getElementById('textarea1').value.length+'/'+document.getElementById('textarea1').maxLength;
					attachEvent("keypress","textarea1",maxLength);
					attachEvent("paste","textarea1",maxLengthPaste);
					</script>
				    </td>
				</tr>
				<tr>
				    <td colspan="5" style="text-align: center;" class="datosp">
					<textarea name="nom_proyecto" maxLength="250" id="textarea1" class="datosp" onKeyUp="document.getElementById('cuenta2').innerHTML=document.getElementById('textarea1').value.length+'/'+document.getElementById('textarea1').maxLength;"  onblur="this.value=this.value.toUpperCase();" rows="1" cols="100"></textarea>
				    </td>
				</tr>
			    </tbody>
			</table>
		    </td>
		</tr>
		<tr><td colspan="5"><font style="font-size: 5px;">&nbsp;</font></td></tr>
		<tr>
		    <td width="100%">
			<table align="center" border="0" cellpadding="1" cellspacing="1" width="80%" style="border-collapse: collapse;">
			    <tbody  valign="center">
				<tr>			    
				    <td width="30%" style="text-align: center;" class="datosp">
					<strong>Fecha de Inicio:</strong>
				    </td>
				    <td width="30%" style="text-align: center;" class="datosp">
					<strong>Fecha de Culminación:</strong>
				    </td>
					<td width="30%" style="text-align: center;" class="datosp">
					<strong>Lapso:</strong>
				    </td>
				</tr>
				<?php
				//if($especialidad!='5')
				if(true)
				{
				?>
				<tr>
				    <td class="datosp" style="text-align:center;">
					    <input name="Sel_Fecha1" style="text-align:center; cursor:pointer;" type="text" id="dateArrival2" onClick="popUpCalendar(this, Solicitud.dateArrival2, 'dd-mm-yyyy');" readonly="" size="10" class="datospf">
					    <img src="images/cal.jpeg" style="cursor:pointer" width="18" height="15" border="0" alt="Presione para seleccionar una fecha" title="Presione para seleccionar una fecha" onClick="popUpCalendar(document.Solicitud.Sel_Fecha1, Solicitud.dateArrival2, 'dd-mm-yyyy');"> 
				    </td>
				    <td class="datosp" style="text-align:center;">
					    <input name="Sel_Fecha" style="text-align:center; cursor:pointer;" type="text" id="dateArrival3" onClick="popUpCalendar(this, Solicitud.dateArrival3, 'dd-mm-yyyy');" readonly="" size="10" class="datospf">
					    <img src="images/cal.jpeg" style="cursor:pointer" width="18" height="15" border="0" alt="Presione para seleccionar una fecha" title="Presione para seleccionar una fecha" onClick="popUpCalendar(document.Solicitud.Sel_Fecha, Solicitud.dateArrival3, 'dd-mm-yyyy');">
				    </td>
					 <td class="datosp" style="text-align:center;">
					    <input name="lapso" style="text-align:center;" type="text" size="10" class="datospf">
				    </td>
				</tr>   
				<?php
				}
				else
				{
				?>
				<tr>
				    <td class="datosp" style="text-align:center;">
					    <input name="Sel_Fecha1" style="text-align:center; cursor:pointer;" type="text" readonly="" id="dateArrival" onClick="popUpCalendar(this, Solicitud.dateArrival, 'dd-mm-yyyy');"  size="10" class="datospf">
					    <img src="images/cal.jpeg" style="cursor:pointer" width="18" height="15" border="0" alt="Presione para seleccionar una fecha" title="Presione para seleccionar una fecha" onClick="popUpCalendar(document.Solicitud.Sel_Fecha1, Solicitud.dateArrival, 'dd-mm-yyyy');"> 
				    </td>
				    <td class="datosp" style="text-align:center;">
					    <input name="Sel_Fecha" style="text-align:center; cursor:pointer;" type="text" readonly="" id="dateArrival1" size="10" class="datospf" >
					    <img src="images/cal.jpeg" style="cursor:pointer" width="18" height="15" border="0" alt="">
				    </td>
				</tr>
				<?php
				}
				?>
			    </tbody>
			</table>
		    </td>
		</tr>
		<?php
		//if($especialidad!='5')
		if(true)
		{
		?>
		<tr><td colspan="5"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td class="enc_p" colspan="5">DATOS DEL TUTOR INDUSTRIAL</td></tr>
		<tr align="center">
		    <td colspan="5">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
			    <tbody>
				<tr>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>Apellidos:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>Nombres:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>C&eacute;dula:</B></div></td>
				</tr>
				<tr>
				    <td bgcolor="#FFFFFF"><div class="datosp"><input type="text" class="datosp" onblur="this.value=this.value.toUpperCase();" name="apellido_ti" size="25"></div></td>
				    <td bgcolor="#FFFFFF"><div class="datosp"><input type="text" class="datosp" onblur="this.value=this.value.toUpperCase();" name="nombre_ti" size="25"></div></td>
				    <td bgcolor="#FFFFFF"><div class="datosp"><input type="text" class="datosp" onblur="this.value=this.value.toUpperCase();" name="cedula_ti" size="25"></div></td>
				</tr>
				<tr>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>Teléfono:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>Correo:</B></div></td>
				</tr>
				<tr>
				    <td bgcolor="#FFFFFF"><div class="datosp"><input type="text" class="datosp" onblur="this.value=this.value.toUpperCase();" name="telefono_ti" size="25"></div></td>
				    <td bgcolor="#FFFFFF"><div class="datosp"><input type="text" class="datosp" onblur="this.value=this.value.toUpperCase();" name="correo_ti" size="25"></div>
				    <td><input type="hidden" name="TIPO_PASANTIA" value="2"></td>
				    </td>
				</tr>
			    </tbody>
			</table>
		    </td>
		</tr>
		<?php
		}
		?>
		    <tr><td colspan="5"><font style="font-size:2px;">&nbsp;</font></td></tr>
		    <tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		    <tr><td class="enc_p" colspan="5">DATOS DEL TUTOR ACAD&Eacute;MICO</td></tr>
		    <tr align="center">
		        <td colspan="5">
		    	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
		    	    <tbody>
		    		<tr>
		    		    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Nombres:</B></div></td>
		    		    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>C&eacute;dula:</B></div></td>
		    		</tr>
		    		<tr>
				    <td align="center"><input type="text" onkeyup="this.value=this.value.toUpperCase();" class="datosc" id="buscar_usuario" name="buscar_usuario" size="45" /></td>
				    <td align="center"><input type="text" class="datosc" id="cedula" name="cedula_TA" size="15" /></td>
				</tr>
		    	    </tbody>
		    	</table>
		        </td>
		    </tr>		
			    <tr><td colspan="5"><font style="font-size:2px;">&nbsp;</font></td></tr>
			    <tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
			    <tr><td class="enc_p" colspan="5">DATOS DEL JURADO COORDINADOR</td></tr>
			    <tr align="center">
			        <td colspan="5">
					<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
					    <tbody>
						<tr>
						    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Nombres:</B></div></td>
						    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>C&eacute;dula:</B></div></td>
						</tr>
						<tr>
						    <td class="datosc"><input type="text" onkeyup="this.value=this.value.toUpperCase();" class="datosc" id="buscar_usuario_c" name="buscar_usuario_c" size="45" /></td>
						    <td align="center"><input type="text" class="datosc" id="cedula_c" name="cedula_JC" size="15" /></td>
						</tr>
				    	    </tbody>
					</table>
				    </td>
				</tr>
			    <tr><td colspan="5"><font style="font-size:2px;">&nbsp;</font></td></tr>
			    <tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
			    <tr><td class="enc_p" colspan="5">DATOS DEL JURADO SECRETARIO</td></tr>
			    <tr align="center">
			        <td colspan="5">
					<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
					    <tbody>
						<tr>
						    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Nombres:</B></div></td>
						    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>C&eacute;dula:</B></div></td>
						</tr>
						<tr>
						    <td class="datosc"><input type="text" onkeyup="this.value=this.value.toUpperCase();" class="datosc" id="buscar_usuario_s" name="buscar_usuario_s" size="45" /></td>
						    <td align="center"><input type="text" class="datosc" id="cedula_s" name="cedula_JS" size="15" /></td>
						</tr>
					    </tbody>
					</table>
				    </td>
				</tr>
		<tr><td colspan="5"><font style="font-size:10px;">&nbsp;</font></td></tr>
		<tr class="act">
		    <td valign="middle" style="text-align: center;" colspan="5" class="datosp">
			<br>Solo seran procesadas las solicitudes que cumplan TODOS los Pre-Requisitos<br><br>
		    </td>
		</tr>
		<tr align=center>
		    <table align="center" border="0" width=40%>
		    <tr><td height="40" align="center" valign="bottom" colspan="2">
			<input type="submit" value="Registrar">
		    </td>
		    <td align="center" valign="bottom" colspan="1">
			<input type="button" value="Finalizar" name="bexit" onclick="window.close();">
		    </td>
		    </tr>
		    </table>
		</tr>
	    </table>
	</form>
    <?php
	    }
    ?>
</body>
</html>