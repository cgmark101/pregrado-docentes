<?php 

session_start();
if ((isset($_SESSION['usuario'])) and (!empty($_SESSION['usuario']))){
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>Fecha Límite</title>
    <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" media="all" type="text/css" href="css/estilos.css" />
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
</head>
<body>
    <?php
     include_once('conexion.php');
	//$sql1="select APELLIDO, NOMBRE, DEPARTAMENTO from tblaca007 where CI = '$cedula'";
	//$conex -> ExecSQL($sql1,__LINE__,true);
    ?>
	    <table border="0px" align="center" width="800" scrollbars=yes>
		<tr>
		    <td colspan="5" align="center">	
			<table border="0" width="800">
			    <tr>
				<td width="50">
				    <p align="right" style="margin-top: 0; margin-bottom: 0">
					<img border="0" src="images/unex15.gif" width="75" height="75">
				    </p>
				</td>
				<td width="500">
			            <p class="titulon">UNIVERSIDAD NACIONAL EXPERIMENTAL POLIT&Eacute;CNICA</p>
				    <p class="titulon">"ANTONIO JOS&Eacute; DE SUCRE"</p>
				    <p class="titulon">VICE-RECTORADO PUERTO ORDAZ</p>
				    <p class="titulon">ASIGNATURA TRABAJO DE GRADO Y PRÁCTICA PROFESIONAL</p>
				</td>
				<td border="0" width="50">&nbsp;</td>
			    </tr>
			</table>
		    </td>
		</tr>
		<?php
		$sql2="select CI_E, TIPO_PASANTIA, n_proyecto, cedula_TA from sol_tgpp WHERE c_uni_ca='".$_SESSION['usuario']."' ";
		$conex1 -> ExecSQL($sql2,__LINE__,true);
		$fila = $conex1->filas;
		$j=0;
		$i=0;
		while ($j<$fila)
		{
		    $tab1 = $conex1->result_h;
		    $tab2 = $conex1->result[$j];
		    $tab = array_combine($tab1,$tab2);
		$j++;
		}
		?>
		<tr><td colspan="5" style="background-color:#FFFFFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
	        <tr><td class="enc_p" colspan="5">FECHAS LÍMITES DE PRESENTACIÓN DE PROYECTOS</td></tr>
		<tr align="center">
		    <td colspan="5">
			<table width="800" border="1" align="center" CELLPADDING=0 CELLSPACING=0 overflow: auto; bgcolor="99CCFF">
			    <tr >
				<th width="70" height="25" scope="col"><span class="datosp">C&eacute;dula</span></th>
				<th width="140" height="25" scope="col"><span class="datosp">Nombre</span></th>
				<th width="80" height="25" scope="col"><span class="datosp">Asignatura</span></th>
				<th width="70" height="25" scope="col"><span class="datosp">Fecha Inicio</span></th>
				<th width="70" height="25" scope="col"><span class="datosp">Fecha Culm.</span></th>
				<th width="70" height="25" scope="col"><span class="datosp">Fecha Límite</span></th>
				<th width="50" height="25" scope="col"><span class="datosp">Teléfono</span></th>
			    </tr>
			    <tr>
				    <?php


					

					$sql2="select CI_E, TIPO_PASANTIA, fecha_i, fecha_c, fecha_l from sol_tgpp WHERE c_uni_ca='".$_SESSION['usuario']."' ";

					switch ($_SESSION['campus']){
						case 'P':
							$sql2.= " and TIPO_PASANTIA='1' ";
							break;
						case 'T':
							$sql2.= " and TIPO_PASANTIA='2' ";
							break;
						case 'G':
							$sql2.= " and TIPO_PASANTIA IN ('1','2') ";
							break;
					}
					
					
					$sql2.= " order by fecha_l";
					
					//echo $sql2;

					$conex1 -> ExecSQL($sql2,__LINE__,true);
					$fila = $conex1->filas;
					$j=0;
					while ($j<$fila)
					    {
					    $tab1 = $conex1->result_h;
					    $tab2 = $conex1->result[$j];
					    $tab = array_combine($tab1,$tab2);
					    $fecha_l=$tab['fecha_l'];
						$anio= substr($fecha_l,0,4);
						$mes= substr($fecha_l,5,2);
						$dia= substr($fecha_l,8,2);
						$fecha_l = $dia ."-". $mes ."-". $anio;
					    $sql1="select NOMBRES, APELLIDOS, telefono2 from dace002 where CI_E = '$tab[CI_E]'";
					    $conex -> ExecSQL($sql1,__LINE__,true);
					    $fila1 = $conex->filas;
					    $k=0;
					    while($k<$fila1)
					    {
						$reg1 = $conex->result_h;
						$reg2 = $conex->result[$k];
						$reg = array_combine($reg1,$reg2);
						if ($tab['TIPO_PASANTIA']=='1')
                                                    $asi='PRÁCTICA PROFESIONAL';
                                                if ($tab['TIPO_PASANTIA']=='2')
                                                    $asi='TRABAJO DE GRADO';
						printf('
					        <tr><td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosc">%s</td>
					        <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosc">%s %s</td>
							<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosc">%s</td>
					        <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosc">%s</td>
					        <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
							<td bgcolor="#FFFFFF"><div class="datosc">%s</td>
							<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosc">%s</td>
							</tr>'
						,$tab["CI_E"],$reg["NOMBRES"],$reg["APELLIDOS"],$asi,$tab["fecha_i"],$tab["fecha_c"],$fecha_l,$reg["telefono2"]);
					    $k++;
					    }
					    $j++;
					    }
					
				    ?>
			    </tr>
			</table>
		    </td>
		</tr>
		<tr><td align="center"><br><br><input type="button" value="Imprimir" onClick="window.print();"></td></tr>
	    </table>
		
	</form>
</body>
</html>

<?php
} else {
	die ("<script languaje=\"javascript\"> window.close(alert('Disculpe, su sesion ha expirado. Por favor ingrese al sistema nuevamente.')); </script>");
}