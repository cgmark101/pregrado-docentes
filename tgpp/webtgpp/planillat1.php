<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
    <title>Registro de Estudiante Trabajo de Grado</title>
    <style type="text/css">
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
        .datospf {
	    text-align: left; 
	    font-family:Arial; 
	    font-size: 11px;
	    font-weight: normal;
	    background-color:#FFFFFF; 
	    border-style: solid;
	    border-width: 1px;
	    border-color: #96BBF3;
        }
        .enc_p {
	    color:#FFFFFF;
	    text-align: center; 
	    font-family:Helvetica;
	    font-size: 14px;
	    font-weight: bold;
	    background-color:#3366CC;
	    height:20px;
	    font-variant: small-caps;
        }
        .datosp {
	    text-align: left; 
	    font-family:Arial; 
	    font-size: 12px;
	    font-weight: normal; 
	    font-variant: small-caps;
        }
        .datosc {
	    text-align: center; 
	    font-family:Arial; 
	    font-size: 12px;
	    font-weight: normal; 
	    font-variant: small-caps;
        }
        .act { 
	    text-align: center; 
	    font-family:Arial; 
	    font-size: 12px; 
	    font-weight: normal;
	    background-color:#99CCFF;
	}
	.dp {
	    text-align: left; 
	    font-family: Arial; 
	    font-size: 11px;
	    font-weight: normal;
	    background-color: #FFFFFF; 
	    font-variant: small-caps;
	}	
	.titulo {
	    text-align: center; 
	    font-family:Arial; 
	    font-size: 12px; 
	    font-weight: normal;
	    background-color: #FFFFFF; 
	    margin-top:0;
	    margin-bottom:0;	
	    font-variant: small-caps;
	}
    </style>  
    <script languaje="Javascript">
	function validar(f) {
	    if (f.nom_proyecto.value == "") {
		alert("Debe colocar el Nombre del Proyecto");
		f.nom_proyecto.focus();
		return false;
	    }
	    if (f.Sel_Fecha1.value == "") {
		alert("Debe colocar la Fecha de Inicio");
		return false;
	    }
	    if (f.Sel_Fecha.value == "") {
		alert("Debe colocar la Fecha de Culminación");
		return false;
	    }
	}	
    </script>
    <script language='javascript' src='popcalendar.js'></script>
    <script language=javascript>
    function fechaC(){
    var fecha = document.getElementById('dateArrival').value
    var day = parseInt(fecha.substr(0,2));
    var month = parseInt(fecha.substr(3,2));	
    var year = parseInt(fecha.substr(6,4));
    var fechac=0;
    if (day<10) day='0'+day;
    if (month<10) month='0'+month; 
    year=year+1;
    fechacul = day +"-"+ month +"-"+ year;
    document.getElementById('dateArrival1').value = fechacul
   }
    </script> 
    <script language=javascript>
    function tutor(){
    document.getElementById('cedula_DS').value  = document.getElementById('cedula_TA').value
   }
    </script> 
</head>
<body>
    <?php
     include_once('inc\config.php');
	session_start();
	$conexion = odbc_connect($DSN, $user, $pass, true, $laBitacora) or die ("Problemas en la conexión"); 	 	     	
	$registros = odbc_exec($conexion, "select APELLIDOS, NOMBRES, EXP_E, C_UNI_CA from dace002 where CI_E = '$_SESSION[cedula]'")or die ("Problemas en el select");
	if ($reg = odbc_fetch_array($registros))
	    {
    ?>
	<form name="Solicitud" action="procesaresttg1.php" method="post" onSubmit="return validar(this)">
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
			            <p class="titulo">UNIVERSIDAD NACIONAL EXPERIMENTAL POLIT&Eacute;CNICA</p>
				    <p class="titulo">"ANTONIO JOSE DE SUCRE"</p>
				    <p class="titulo">VICE-RECTORADO PUERTO ORDAZ</font></p>
				    <p class="titulo">ASIGNATURA TRABAJO DE GRADO</font>
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
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>Apellidos:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>Nombres:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>C&eacute;dula:</B></div></td>
				</tr>
				<?php
				    printf('<tr>
					<td <div class="datosp">%s</div></td>
					<td <div class="datosp">%s</div></td>
					<td <div class="datosp">%s</div></td></tr>',$reg["APELLIDOS"],$reg["NOMBRES"],$_SESSION["cedula"]);
				?>
				<tr>
				    <td bgcolor="#FFFFFF"><div class="datosp"><B>Expediente:</B></div></td>
				    <td bgcolor="#FFFFFF" colspan="3"><div class="datosp"><B>Especialidad:</B></div>
				    <td><input type="hidden" name="asignatura" value="TRABAJO DE GRADO"></td>
				    </td>
				</tr>
				<?php
				    $esp = odbc_exec($conexion, "select CARRERA from tblaca010 where C_UNI_CA= '$reg[C_UNI_CA]'")or die ("Problemas en el select");
				        if ($espe = odbc_fetch_array($esp))
					    {
					    printf('<tr>
					        <td bgcolor="#FFFFFF"><div class="datosp">%s</div></td>
					        <td bgcolor="#FFFFFF"><div class="datosp">INGENIERÍA %s</div></td></tr>', $reg["EXP_E"], $espe["CARRERA"]);
					    }
				$especialidad=$reg['C_UNI_CA'];
				$_SESSION['especialidad']=$especialidad;
				?>
			    </tbody>
			</table>
		    </td>
		</tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5"><font style="font-size:5px;">&nbsp;</font></td></tr>
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
				    <td width="60%" style="text-align: center;" class="datosp">
					<strong>Nombre del Proyecto:</strong>
				    </td>
				</tr>
				<tr>
				    <td style="text-align: center;" class="datosp">
					<textarea name="nom_proyecto" class="datosp" onblur="this.value=this.value.toUpperCase();" rows="1" cols="100"></textarea>                   
				    </td>    	
				</tr>						
			    </tbody>
			</table>
		    </td>
		</tr>
		<tr><td colspan="5"><font style="font-size: 5px;">&nbsp;</font></td></tr>
		<tr>
		    <td width="100%">
			<table align="center" border="0" cellpadding="1" cellspacing="1" width="60%" style="border-collapse: collapse;">
			    <tbody  valign="center">
				<tr>			    
				    <td width="30%" style="text-align: center;" class="datosp">
					<strong>Fecha de Inicio:</strong>
				    </td>
				    <td width="30%" style="text-align: center;" class="datosp">
					<strong>Fecha de Culminación:</strong>
				    </td>
				</tr>
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
			    </tbody>
			</table>
		    </td>
		</tr>
		
		<tr><td colspan="5"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td class="enc_p" colspan="5">DATOS DEL TUTOR ACAD&Eacute;MICO</td></tr>
		<tr align="center">
		    <td colspan="5">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
			    <tbody>
				<tr>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>C&eacute;dula:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Apellidos:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Nombres:</B></div></td>
				</tr>
				<tr>
					<td bgcolor="#FFFFFF"><div class="datosc"><input type="text" class="datosc" name="cedula_tutor" id="cedula_tutor" size="12"></div></td>
				    
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
			<input type="submit" value="Registrarse">
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