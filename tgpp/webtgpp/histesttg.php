<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/estilos.css" />
    <script language="Javascript" src="fecha.js"></script>
    <script languaje="Javascript">
    <!--
    Estudiante = '';        var Imprimio = false;
    function imprimir(fi) {
	with (fi) {
	    bimp.style.display="none";
            bexit.style.display="none";
            window.print();
            Imprimio = true;
            msgI = Estudiante + ':\nSi mandaste a imprimir tu planilla\n';
            msgI = msgI + "pulsa el botón 'Finalizar' y ve a retirar tu planilla por la impresora,\n";
            msgI = msgI + 'de lo contrario vuelve a pulsar Imprimir\n';
            //alert(msgI);
            bimp.style.display="block";
            bexit.style.display="block";
        }
    }
    function verificarSiImprimio(){
        window.status = Estudiante + ': NO TE VAYAS SIN IMPRIMIR TU PLANILLA';
        if (Imprimio){
            window.close();
        }
        else {
            msgI = '            ATENCION!\n' + Estudiante;
            alert(msgI +':\nNo te vayas sin imprimir tu planilla');
	    Imprimio = true;
        }
    }
    <!--
    document.writeln('</font>');
    //-->
    </script>
	<script language="javascript">
		function recarga()
		{
		window.opener.document.location.href=window.opener.document.location.href;
		window.close();
		}
	</script>
    <title>Procesar Datos de Estudiantes</title>
    <?php
    $_SESSION['cedula']=$_SESSION['cedula'];
     include_once('conexion.php');	
	$fecha_l=$_REQUEST["Sel_Fecha1"];
	$dia= substr($fecha_l,0,2);
	$mes= substr($fecha_l,3,2);
	$anio= substr($fecha_l,6,4);
	$anio=$anio+1;
	$fecha_l = $anio ."-". $mes ."-". $dia;
	$sql2="select CI_E, TIPO_PASANTIA from sol_historial where CI_E = '$_SESSION[cedulaest]' and TIPO_PASANTIA = 2";
        $conex1 -> ExecSQL($sql2,__LINE__,true);
	$fila0 = $conex1->filas;
	if ($fila0!=0)
	{
	    printf('El estudiante ya se encuentra Registrado en la Base de Datos');
	}
	else
	{
		if($_SESSION['especialidad']==5)
		{
			/*$sql2="insert into sol_historial (CI_E, TIPO_PASANTIA, n_proyecto, fecha_i, fecha_c, fecha_l, cedula_TA, cedula_JC, cedula_JS, id_estatus, c_uni_ca) values ('$_SESSION[cedulaest]','$_SESSION[TIPO_PASANTIA]','$_REQUEST[nom_proyecto]','$_REQUEST[Sel_Fecha1]','$_REQUEST[Sel_Fecha]','$fecha_l','$_REQUEST[cedula_TA]','$_REQUEST[cedula_JC]','$_REQUEST[cedula_JS]',5,'$_SESSION[especialidad]')";*/




			$sql2="insert into sol_historial (CI_E, TIPO_PASANTIA, empresa, n_proyecto, fecha_i, fecha_c, fecha_l, cedula_ti, nombre_ti, apellido_ti, telefono_ti, correo_ti, cedula_TA, cedula_JC, cedula_JS, id_estatus, c_uni_ca, lapso, exp_e) values ('$_SESSION[cedulaest]','$_REQUEST[TIPO_PASANTIA]','$_SESSION[empresa]','$_REQUEST[nom_proyecto]','$_REQUEST[Sel_Fecha1]','$_REQUEST[Sel_Fecha]','$fecha_l','$_REQUEST[cedula_ti]','$_REQUEST[nombre_ti]','$_REQUEST[apellido_ti]','$_REQUEST[telefono_ti]','$_REQUEST[correo_ti]','$_REQUEST[cedula_TA]','$_REQUEST[cedula_JC]','$_REQUEST[cedula_JS]',4,'$_SESSION[especialidad]', '$_REQUEST[lapso]','$_REQUEST[exp_e]')";

			/*echo $sql2;

			die();*/


			$conex1 -> ExecSQL($sql2,__LINE__,true);
		}
		else
		{
		    /*$sql2="insert into sol_historial (CI_E, TIPO_PASANTIA, empresa, n_proyecto, fecha_i, fecha_c, fecha_l, cedula_ti, nombre_ti, apellido_ti, telefono_ti, correo_ti, cedula_TA, cedula_JC, cedula_JS, id_estatus, c_uni_ca)
		    values ('$_SESSION[cedulaest]','$_REQUEST[TIPO_PASANTIA]','$_SESSION[empresa]','$_REQUEST[nom_proyecto]','$_REQUEST[Sel_Fecha1]','$_REQUEST[Sel_Fecha]','$fecha_l','$_REQUEST[cedula_ti]','$_REQUEST[nombre_ti]','$_REQUEST[apellido_ti]','$_REQUEST[telefono_ti]','$_REQUEST[correo_ti]','$_REQUEST[cedula_TA]','$_REQUEST[cedula_JC]','$_REQUEST[cedula_JS]',5,'$_SESSION[especialidad]')";*/

			$conex1->iniciarTransaccion("Inicio Guarda Historial TG - ".$_REQUEST[exp_e]);

			$sql2="insert into sol_historial (CI_E, TIPO_PASANTIA, empresa, n_proyecto, fecha_i, fecha_c, fecha_l, cedula_ti, nombre_ti, apellido_ti, telefono_ti, correo_ti, cedula_TA, cedula_JC, cedula_JS, id_estatus, c_uni_ca, lapso, exp_e) values ('$_SESSION[cedulaest]','$_REQUEST[TIPO_PASANTIA]','$_SESSION[empresa]','$_REQUEST[nom_proyecto]','$_REQUEST[Sel_Fecha1]','$_REQUEST[Sel_Fecha]','$fecha_l','$_REQUEST[cedula_ti]','$_REQUEST[nombre_ti]','$_REQUEST[apellido_ti]','$_REQUEST[telefono_ti]','$_REQUEST[correo_ti]','$_REQUEST[cedula_TA]','$_REQUEST[cedula_JC]','$_REQUEST[cedula_JS]',4,'$_SESSION[especialidad]', '$_REQUEST[lapso]','$_REQUEST[exp_e]')";

		    $conex1 -> ExecSQL($sql2,__LINE__,true);

			$conex1->finalizarTransaccion("Fin Guarda Historial TG - ".$_REQUEST[exp_e]);
		  }
		}
    ?>	
</head>
<!-- <body onunload="recarga()";> -->
<body>
    <?php
    $meses[] = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	$sql1="select APELLIDOS, NOMBRES, EXP_E, C_UNI_CA, TELEFONO2 from dace002 where CI_E = '$_SESSION[cedulaest]' UNION select APELLIDOS, NOMBRES, EXP_E, C_UNI_CA, TELEFONO2 from dace002_grad where CI_E = '$_SESSION[cedulaest]' ";
        $conex -> ExecSQL($sql1,__LINE__,true);

	$fila = $conex->filas;
	if ($fila==1)
	    {
	    $reg1 = $conex->result_h;
	    $reg2 = $conex->result[0];
	    $reg = array_combine($reg1,$reg2);
    ?>
	<table align="center" border="0" width="750" id="table1" cellspacing="1" cellpadding="0" style="border-collapse: collapse">
	    <tbody>
		<tr>
		    <td>
			<table border="0" width="650" cellpadding="0" align="center">
			    <tr>
				<td width="125">
				    <p align="right" style="margin-top: 0; margin-bottom: 0">
					<img border="0" src="imagenes/logo_unexpo.png" width="80" height="60"></p>
				</td>
				<td width="500">
				    <p class="titulon">UNIVERSIDAD NACIONAL EXPERIMENTAL POLIT&Eacute;CNICA</p>
				    <p class="titulon">"ANTONIO JOS&Eacute; DE SUCRE"</p>
				    <p class="titulon">VICE-RECTORADO PUERTO ORDAZ</p>
				    <p class="titulon">ASIGNATURA TRABAJO DE GRADO</p>
				</td>
				<td width="125">&nbsp;</td>
			    </tr>
			    <tr><td colspan="3" style="background-color:#D0D0D0;"><font style="font-size:1pt;"> &nbsp;</font></td></tr>
			</table>
		    </td>
		</tr>
		<tr><td class="dp">&nbsp;</td></tr> 
		<tr><td width="750"><p class="matB"><b>TITULO DE PROYECTO</b></p></td></tr>
		<tr>
		    <td width="750">
			<table align="center" border="0" cellpadding="0" cellspacing="1" width="550">
			    <tr><td class="dp">&nbsp;</td></tr> 
			    <tr><td class="dp" style="text-align: right;"><?php date_default_timezone_set('Etc/GMT+4'); echo('Fecha : '.date('d').' de '.$meses[0][date('m')].' de '.date('Y').' Hora : '.date('h:i a')); ?></td></tr>
			    <tr><td class="dp">&nbsp;</td></tr> 
			</table>
	             </td>
	        </tr>
		<tr>
		    <td valing=middle nowrap="nowrap" bgcolor="#FFFFFF">
		        <div class="matB">DATOS DEL ESTUDIANTE</div>
		</tr>
		<tr><td class="dp">&nbsp;</td></tr> 
		<tr>
		    <td>
			<table align="center" border="0" cellpadding="0" cellspacing="1" width="550" style="border-collapse: collapse;">
			    <tbody>
			        <tr>
				    <td style="width: 150px;" bgcolor="#FFFFFF"><div class="datosc">Apellidos:</div></td>
				    <td style="width: 150px;" bgcolor="#FFFFFF"><div class="datosc">Nombres:</div></td>
		                    <td style="width: 150px;" bgcolor="#FFFFFF"><div class="datosc">C&eacute;dula:</div></td>
				    <td style="width: 150px;" bgcolor="#FFFFFF"><div class="datosc">Expediente:</font></td>
				</tr>
				<tr>
				    <?php
					printf(
					    '<td bgcolor="#FFFFFF"><div class="datosc">%s</div></td>
					    <td bgcolor="#FFFFFF"><div class="datosc">%s</div></td>
					    <td bgcolor="#FFFFFF"><div class="datosc">%s</div></td>
					    <td style="width: 114px;" bgcolor="#FFFFFF"><div class="datosc">%s</div></td>'
					    ,$reg["APELLIDOS"],$reg["NOMBRES"],$_SESSION["cedulaest"],$reg["EXP_E"]);
				    ?>
				</tr>
			    </tbody>
			</table>
		    </td>
		</tr>
		<tr>
		    <td width="750">
		        <table align="center" border="0" cellpadding="0" cellspacing="1" width="550">
		            <tbody>
		                <?php
				$sql1="select CARRERA from tblaca010 where C_UNI_CA= '$reg[C_UNI_CA]'";
				$conex -> ExecSQL($sql1,__LINE__,true);
			        $fila = $conex->filas;
				if ($fila==1)
				    {
				    $esp1 = $conex->result_h;
				    $esp2 = $conex->result[0];
				    $espe = array_combine($esp1,$esp2);
					printf(
					    '<tr>  
						<td style="width: 570px;" bgcolor="#FFFFFF"><div class="datosc">Especialidad: %s</div></td>
						<td style="width: 570px;" bgcolor="#FFFFFF"><div class="datosc">Teléfono: %s</div></td>
					    </tr>',$espe["CARRERA"], $reg["TELEFONO2"]);
					}
				?>
			    </tbody>
			</table>
		    </td>
		</tr>
		<?php
		    $sql2="select empresa, n_proyecto, TIPO_PASANTIA, cedula_TI, nombre_TI, apellido_TI, telefono_TI, correo_TI, fecha_i, fecha_c, id_estatus, cedula_TA, cedula_JC, cedula_JS from sol_historial where CI_E = '$_SESSION[cedulaest]' and TIPO_PASANTIA=2 ";
		    $conex1 -> ExecSQL($sql2,__LINE__,true);
		    $fila2 = $conex1->filas;
		    if ($fila2!=0)
		    {
			$tab1 = $conex1->result_h;
			$tab2 = $conex1->result[0];
			$tab = array_combine($tab1,$tab2);
		?>
		<tr><td>&nbsp;</td></tr>
	        <tr>
		    <td width="750">
			<table align="center" border="1" cellpadding="3" cellspacing="1" width="550" style="border-collapse: collapse;">
			    <?php
			    if($reg['C_UNI_CA']!=5 && $tab['TIPO_PASANTIA']==2)
			    {printf('<tr>
				<td>
				    <table align="center" border="0" cellpadding="0" cellspacing="1" width="550">
					<tr>
					    <td style="text-align: center;" nowrap="nowrap" bgcolor="#FFFFFF" class="matB">
						<div class="mat"><b>EMPRESA</b></div>
					    </td>
					</tr>
					<tr>
					    <td style="text-align: center;" nowrap="nowrap" bgcolor="#FFFFFF" class="mat">%s</td></tr>
				    </table>
				</td>
			    </tr>', $_SESSION["empresa"]);
			    }?>
			    <tr>
				<td>
				    <table align="center" border="0" cellpadding="0" cellspacing="1" width="550">
					<tr>
					    <td style="width: 300px;" valing=middle nowrap="nowrap" bgcolor="#FFFFFF" colspan="5">
						<div class="mat"><b>TITULO DEL PROYECTO</b></div>
					    </td>
					</tr>
					<tr>
					    <?php
						printf(
						    '<td style="width: 300px;" style="text-align: center;" bgcolor="#FFFFFF" class="mat">%s</td>'
						    , $tab["n_proyecto"]);
					    ?>
					</tr>
				    </table>
				</td>
			    </tr>
			    <tr>
				<td>
				    <table align="center" border="0" cellpadding="0" cellspacing="1" width="550" colspan="5">
					<tr>
					    <td style="width: 100px;" nowrap="nowrap" bgcolor="#FFFFFF"><div class="matB">FECHA DE INICIO</div></td>
					    <td style="width: 100px;" nowrap="nowrap" bgcolor="#FFFFFF"><div class="matB">FECHA DE CULMINACIÓN</div></td>
					    <td style="width: 100px;" nowrap="nowrap" bgcolor="#FFFFFF"><div class="matB">ESTATUS</div></td>
					</tr>
					<tr>
					<?php
					$sql2="select id_estatus, estatus from sol_estatus where id_estatus='$tab[id_estatus]'";
					$conex1 -> ExecSQL($sql2,__LINE__,true);
					$fila3 = $conex1->filas;
					if ($fila3==1)
					{



					    $sta1 = $conex1->result_h;
					    $sta2 = $conex1->result[0];
					    $stat = array_combine($sta1,$sta2);
					    printf(
					      '<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="mat">%s</td>
					      <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="mat">%s</td>
					      <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="mat">%s</td>', $tab["fecha_i"], $tab["fecha_c"], $stat["estatus"]);
					}
					?>
					</tr>
					<tr><td nowrap="nowrap" bgcolor="#FFFFFF" class="tot" colspan="5"></td></tr>
				    </table>
				</td>
			    </tr>
			</table>
		    </td>
		</tr>
		<tr><td>&nbsp;</td></tr>		
		<tr>
		    <td width="750">
		      <?php
		      if(/*$reg['C_UNI_CA']!=5 &&*/ $tab['TIPO_PASANTIA']==2)
		      {
		      ?>
			<table align="center" border="1" cellpadding="3" cellspacing="1" width="550" style="border-collapse: collapse;">
			    <tr>
				<td style="width: 500px;" nowrap="nowrap" bgcolor="#FFFFFF" colspan="5">
				    <div class="mat"><b>DATOS DEL TUTOR INDUSTRIAL</b></div>
				</td>
			    </tr>
			    <tr>
				<td>
				    <table border="0" cellpadding="0" cellspacing="1" width="550">
			                <tr>
					    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="mat"><b>APELLIDOS</b></div></td>
					    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="mat"><b>NOMBRES</b></div></td>
					    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="mat"><b>CÉDULA</b></div></td>
			                </tr>
					<tr>
					<?php
					    printf(
						'<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="mat">%s</td>
						<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="mat">%s</td>
						<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="mat">%s</td>',$tab["apellido_TI"],$tab["nombre_TI"],$tab["cedula_TI"]);
					?>
					</tr>
					<tr><td colspan="5"><font style="font-size: 3px;">&nbsp;</font></td></tr>		
					<tr>
					    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="mat"><b>TELÉFONO</b></div></td>
					    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="mat"><b>CORREO</b></div></td>
					</tr>
					<tr>
					<?php
					    printf(
						'<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="mat">%s</td>			      
						<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="mat">%s</td>',$tab["telefono_TI"],$tab["correo_TI"]);
					?>
					</tr>
			            </table>
			        </td>
			    </tr>
			</table>
		    </td>
		</tr>
		      <?php
		      }
		      ?>
		<tr><td colspan="3"><font style="font-size:1pt;"> &nbsp;</font></td></tr>
		<tr>
		    <td width="750">
			    <table align="center" border="1" cellpadding="3" cellspacing="1" width="550" style="border-collapse: collapse;">
			    <tr>
				<td style="width: 500px;" nowrap="nowrap" bgcolor="#FFFFFF" colspan="5">
				    <div class="mat"><b>DATOS DEL TUTOR ACADÉMICO</b></div>
				</td>
			    </tr>
			    <tr>
				<td>
				    <table border="0" cellpadding="0" cellspacing="1" width="550">
			                <tr>
					    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="mat"><b>APELLIDOS</b></div></td>
					    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="mat"><b>NOMBRES</b></div></td>
					    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="mat"><b>CÉDULA</b></div></td>
			                </tr>
					<tr>
					<?php
					$sql1="select APELLIDO, NOMBRE, CI from tblaca007 where CI = '$tab[cedula_TA]'";
					$conex -> ExecSQL($sql1,__LINE__,true);
					$fila = $conex->filas;
					if ($fila==1)
					{
					    $pro1 = $conex->result_h;
					    $pro2 = $conex->result[0];
					    $prof = array_combine($pro1,$pro2);
					    printf(
						'<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="mat">%s</td>
						<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="mat">%s</td>
						<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="mat">%s</td>',$prof["APELLIDO"],$prof["NOMBRE"],$tab["cedula_TA"]);
					}
					?>
					</tr>
					<tr><td colspan="5"><font style="font-size: 3px;">&nbsp;</font></td></tr>
			            </table>
			        </td>
			    </tr>
			</table>
		    </td>
		</tr>
		<tr><td colspan="3"><font style="font-size:1pt;"> &nbsp;</font></td></tr>
		<tr>
		    <td width="750">
			    <table align="center" border="1" cellpadding="3" cellspacing="1" width="550" style="border-collapse: collapse;">
			    <tr>
				<td style="width: 500px;" nowrap="nowrap" bgcolor="#FFFFFF" colspan="5">
				    <div class="mat"><b>DATOS DEL JURADO COORDINADOR</b></div>
				</td>
			    </tr>
			    <tr>
				<td>
				    <table border="0" cellpadding="0" cellspacing="1" width="550">
			                <tr>
					    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="mat"><b>APELLIDOS</b></div></td>
					    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="mat"><b>NOMBRES</b></div></td>
					    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="mat"><b>CÉDULA</b></div></td>
			                </tr>
					<tr>
					<?php
					$sql1="select APELLIDO, NOMBRE, CI from tblaca007 where CI = '$tab[cedula_JC]'";
					$conex -> ExecSQL($sql1,__LINE__,true);
					$fila = $conex->filas;
					if ($fila==1)
					{
					    $pro1 = $conex->result_h;
					    $pro2 = $conex->result[0];
					    $prof = array_combine($pro1,$pro2);
					    printf(
						'<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="mat">%s</td>
						<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="mat">%s</td>
						<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="mat">%s</td>',$prof["APELLIDO"],$prof["NOMBRE"],$tab["cedula_JC"]);
					}
					?>
					</tr>
					<tr><td colspan="5"><font style="font-size: 3px;">&nbsp;</font></td></tr>
			            </table>
			        </td>
			    </tr>
			</table>
		    </td>
		</tr>
		<tr><td colspan="3"><font style="font-size:1pt;"> &nbsp;</font></td></tr>
		<tr>
		    <td width="750">
			    <table align="center" border="1" cellpadding="3" cellspacing="1" width="550" style="border-collapse: collapse;">
			    <tr>
				<td style="width: 500px;" nowrap="nowrap" bgcolor="#FFFFFF" colspan="5">
				    <div class="mat"><b>DATOS DEL JURADO SECRETARIO</b></div>
				</td>
			    </tr>
			    <tr>
				<td>
				    <table border="0" cellpadding="0" cellspacing="1" width="550">
			                <tr>
					    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="mat"><b>APELLIDOS</b></div></td>
					    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="mat"><b>NOMBRES</b></div></td>
					    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="mat"><b>CÉDULA</b></div></td>
			                </tr>
					<tr>
					<?php
					$sql1="select APELLIDO, NOMBRE, CI from tblaca007 where CI = '$tab[cedula_JS]'";
					$conex -> ExecSQL($sql1,__LINE__,true);
					$fila = $conex->filas;
					if ($fila==1)
					{
					    $pro1 = $conex->result_h;
					    $pro2 = $conex->result[0];
					    $prof = array_combine($pro1,$pro2);
					    printf(
						'<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="mat">%s</td>
						<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="mat">%s</td>
						<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="mat">%s</td>',$prof["APELLIDO"],$prof["NOMBRE"],$tab["cedula_JS"]);
					}
					?>
					</tr>
					<tr><td colspan="5"><font style="font-size: 3px;">&nbsp;</font></td></tr>
			            </table>
			        </td>
			    </tr>
			</table>
		    </td>
		</tr>		
		
		<tr>
		    <td>
			<table align="center" border="0" cellpadding="0" cellspacing="1" width="550">
			    <tr style="font-size: 2px;">
				<td colspan="2" > &nbsp; </td>
			    </tr>
			    <tr>
				<form name="imprime" action="">
				    <td valign="bottom">
				        <p align="center"><input type="button" value=" Imprimir " name="bimp" style="background:#FFFF33;
					    color:black; font-family:arial; font-weight:bold;" onclick="imprimir(document.imprime)">
					</p> 
				    </td>
				    <td valign="bottom">
					  <p align="center"><input type="button" value="Finalizar" name="bexit" onclick="window.close();"></p> 
				    </td>
				</form>
			</table>
		    </td>
		</tr>
	    </tbody>
	</table>
    <?php
		    }
      }
    ?>
</body>
</html>