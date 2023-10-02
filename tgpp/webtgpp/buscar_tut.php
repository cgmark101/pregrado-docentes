<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>Búsqueda de Tutores</title>
    <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" media="all" type="text/css" href="css/estilos.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/estilos.css" />
    <link type="text/css" rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.16.custom.css"/>
    <script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
    <script type="text/javascript" src="js/autocomplet.js"></script>
    </script>
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
    <style>
    .programa{border: 1px solid #ccc; padding: 5px; margin-bottom: 3px; width: 150px}
    .titulo{background: #ccc; cursor: pointer}
    .desc{display: none}
    </style>
</head>
<body>
	    <table border="0px" align="center" width="900">
		<tr>
		    <td colspan="5" align="center">	
			<table border="0" width="900">
			    <tr>
				<td width="150">
				    <p align="right" style="margin-top: 0; margin-bottom: 0">
					<img border="0" src="images/unex15.gif" width="75" height="75">
				    </p>
				</td>
				<td width="600">
			            <p class="titulon">UNIVERSIDAD NACIONAL EXPERIMENTAL POLIT&Eacute;CNICA</p>
				    <p class="titulon">"ANTONIO JOS&Eacute; DE SUCRE"</p>
				    <p class="titulon">VICE-RECTORADO PUERTO ORDAZ</p>
				    <p class="titulon">ASIGNATURA TRABAJO DE GRADO Y PR&Aacute;CTICA PROFESIONAL</p>
				</td>
				<td width="150">&nbsp;</td>
			    </tr>
			</table>
		    </td>
		</tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5">&nbsp</td></tr>
        <tr><td class="enc_p" colspan="5">B&Uacute;SQUEDA DE TUTORES INDUSTRIALES</td></tr>
                <tr>
                    <table width="900" height="60"  border="1" align="center" bgcolor="#99CCFF" style="border-collapse: collapse;">
                        <form name="buscador" action="" method="post" autocomplete="off">
                        <tr>
                            <td width="20%" align="center"><span class="datosp">Nombre/Apellido</span></td>
                            <td width="10%" align="center"><span class="datosp">C&eacute;dula</span></td>
                            <td width="70%" align="center" colspan="2"><span class="datosp">Nombre Trabajo</span></td>
                            <td rowspan="2" width="80" align="center"><input name="buscar" type="submit" class="datosp" value="Buscar"></td>
                        </tr>
                        <tr>
                            <td class="datosc"><input type="text" class="datosc" id="nombre" name="nombre" size="25" /></td>
                            <td align="center"><input type="text" class="datosc" id="cedula" name="cedula" size="10" /></td>
                            <td class="datosc" style="text-align:center" colspan="2">
								<input type="text" class="datosc" id="trabajo" name="trabajo" size="80" />
                            </td>
                        </tr>
                        </form>
                    </table>
                </tr>
                <tr><td colspan="5"><font style="font-size:12px;">&nbsp;</font></td></tr>		
		<tr>
		    <td colspan="5">
			<table width="100%"  align=center border="1" CELLPADDING=0 CELLSPACING=0 overflow:auto bgcolor="99CCFF" style="border-collapse: collapse;">
			    <tr height="30">
				<th width="6%" scope="col"><span class="datosp">C&eacute;dula</span></th>
                <th width="12%" scope="col"><span class="datosp">Nombres</span></th>
				<th width="12%" scope="col"><span class="datosp">Apellidos</span></th>
                <th width="20%" scope="col"><span class="datosp">Empresa</span></th>
				<th width="40%" scope="col"><span class="datosp">Nombre del Proyecto</span></th>
				<th width="10%" scope="col"><span class="datosp">Estatus</span></th>
			    </tr>
			    <tr>
<?php
ini_set("display_errors",1);
include_once('conexion.php');

if($_REQUEST) {

	//print_r($_POST);
	$AND1 = (strlen($_POST['nombre'])>0) ? " AND (nombre_ti LIKE '%".strtoupper($_POST['nombre'])."%' OR apellido_ti LIKE '%".strtoupper($_POST['nombre'])."%') " : "" ;

	$AND2 = (strlen($_POST['cedula'])>0) ? " AND cedula_ti LIKE '%".$_POST['cedula']."%' " : "" ;

	$AND3 = (strlen($_POST['trabajo'])>0) ? " AND n_proyecto LIKE '%".strtoupper($_POST['trabajo'])."%' " : "" ;
	

	$tSQL = "SELECT cedula_ti, nombre_ti, apellido_ti, empresa, n_proyecto, estatus, ci_e, tipo_pasantia ";
	$tSQL.= "FROM sol_tgpp a, sol_estatus b ";
	$tSQL.= "WHERE a.id_estatus=b.id_estatus ".$AND1.$AND2.$AND3;
	
	$tSQL.= " UNION ";

	$tSQL.= "SELECT cedula_ti, nombre_ti, apellido_ti, empresa, n_proyecto, estatus, ci_e, tipo_pasantia ";
	$tSQL.= "FROM sol_historial a, sol_estatus b ";
	$tSQL.= "WHERE a.id_estatus=b.id_estatus ".$AND1.$AND2.$AND3;
	
	$tSQL.= "ORDER BY 1 ";

	//echo $tSQL;

	$conex1->ExecSQL($tSQL,__LINE__,true);

	foreach ($conex1->result as $datos){
		$cedula_ti = $datos[0];
		$nombre_ti = $datos[1];
		$apellido_ti = $datos[2];
		$empresa = $datos[3];
		$n_proyecto = $datos[4];
		$estatus = $datos[5];

		$id = $datos[6];
		$as = $datos[7];

		$link = ($estatus == 'CULMINADO') ? "verhist":"ver_hist_t";
		

print <<<TABLA001
	<tr height="30" style="font-size:9pt;background-color:#FFFFFF;">
		<td style="text-align:center;">$cedula_ti</td>
		<td style="padding-left:5px;">$nombre_ti</td>
		<td style="padding-left:5px;">$apellido_ti</td>
		<td style="text-align:center;">$empresa</td>
		<td style="padding-left:5px;">$n_proyecto</td>
		<td style="text-align:center;"><a href="$link.php?id=$id&as=$as" target="popup" onclick=window.open("", popup, width=900, height=800, left=220, top=0, scrollbars=yes)>$estatus <img src="imagenes/icono_buscar.gif" alt="buscar" width="15"height="15" border="0"></a></td>
	</tr>
TABLA001;


				/*		<th width="50" scope="col"><span class="datosp">C&eacute;dula</span></th>
                <th width="120" scope="col"><span class="datosp">Nombres</span></th>
				<th width="120" scope="col"><span class="datosp">Apellidos</span></th>
                <th width="120" scope="col"><span class="datosp">Empresa</span></th>
				<th width="300" scope="col"><span class="datosp">Nombre del Proyecto</span></th>
				<th width="40" scope="col"><span class="datosp">Ver</span></th>*/
	}//Fin for

}


                   /* if($_REQUEST)
                    {
					$i=0;
					$sql2="select DISTINCT CI_E, lapso, empresa, n_proyecto, TIPO_PASANTIA, cedula_TI, nombre_TI, apellido_TI, telefono_TI, correo_TI, fecha_i, fecha_c, id_estatus from sol_historial order by CI_E";
					$conex1 -> ExecSQL($sql2,__LINE__,true);
    
					$fila = $conex1->filas;

					//echo $sql2;

				//	while ($i<$fila) {
					    $tab1 = $conex1->result_h;
					    $tab2 = $conex1->result[$i];
					    $tab = array_combine($tab1,$tab2);

						if($_POST['CI_E']!="") { // Si busca por cedula
							if ($_POST['TIPO_PASANTIA']!="") {
								if ($_POST['lapso']!="") {
									$j=0;
									$sql2="select CI_E, empresa, n_proyecto, TIPO_PASANTIA, cedula_TI, nombre_TI, apellido_TI, telefono_TI, correo_TI, fecha_i, fecha_c, id_estatus, lapso from sol_historial where CI_E='$_POST[CI_E]' and TIPO_PASANTIA='$_POST[TIPO_PASANTIA]' and lapso='$_POST[lapso]' order by CI_E ";

									$conex1 -> ExecSQL($sql2,__LINE__,true);    
									$fila = $conex1->filas;

									while ($j<$fila) {
										$tab1 = $conex1->result_h;
									    $tab2 = $conex1->result[$j];
									    $tab = array_combine($tab1,$tab2);
								
									    $sql1="select NOMBRES, APELLIDOS from dace002 where CI_E = '$tab[CI_E]'";

										$conex -> ExecSQL($sql1,__LINE__,true);
									    $fila1 = $conex->filas;
									    $k=0;
						
										while($k<$fila1) {	
											$reg1 = $conex->result_h;
											$reg2 = $conex->result[$k];
											$reg = array_combine($reg1,$reg2);

											if ($tab['TIPO_PASANTIA']==1)
												$asi='PRÁCTICA PROFESIONAL';
											if ($tab['TIPO_PASANTIA']==2)
												$asi='TRABAJO DE GRADO';

											 printf('<tr height="30">
											 <td bgcolor="#FFFFFF"><div class="datosc">%s</td><td bgcolor="#FFFFFF"><div class="datosc">%s</td><td bgcolor="#FFFFFF"><div class="datosc">%s</td><td bgcolor="#FFFFFF"><div class="datosc">%s</td><td bgcolor="#FFFFFF"><div class="datosc">%s</td><td bgcolor="#FFFFFF"><div class="datosc">%s</td><td bgcolor="#FFFFFF"><div class="datosc"><a href="verhist.php?id=%d&as=%s" target="popup" onclick=window.open("", popup, width = 900, height = 800, left=220, top=0, scrollbars=yes)><img src="imagenes/icono_buscar.gif" alt="buscar" width="15"height="15" border="0"></a></td>></td>
											 </tr>',$tab["lapso"],$tab["CI_E"],$reg["NOMBRES"],$reg["APELLIDOS"],$asi,$tab["n_proyecto"],$tab["CI_E"],$tab['TIPO_PASANTIA']);

											 $k++;
										}
										$j++;
									}
								}
							else {
								$j=0;
								$sql2="select CI_E, empresa, n_proyecto, TIPO_PASANTIA, cedula_TI, nombre_TI, apellido_TI, telefono_TI, correo_TI, fecha_i, fecha_c, id_estatus, lapso from sol_historial where CI_E='$_POST[CI_E]' and TIPO_PASANTIA='$_POST[TIPO_PASANTIA]' order by CI_E";
								$conex1 -> ExecSQL($sql2,__LINE__,true);    
								$fila = $conex1->filas;
								while ($j<$fila) {
									$tab1 = $conex1->result_h;
									$tab2 = $conex1->result[$j];
									$tab = array_combine($tab1,$tab2);
									
									$sql1="select NOMBRES, APELLIDOS from dace002 where CI_E = '$tab[CI_E]'";
									$conex -> ExecSQL($sql1,__LINE__,true);
									$fila1 = $conex->filas;
									$k=0;
									while($k<$fila1) {	
										$reg1 = $conex->result_h;
										$reg2 = $conex->result[$k];
										$reg = array_combine($reg1,$reg2);

										if ($tab['TIPO_PASANTIA']==1)
											$asi='PRÁCTICA PROFESIONAL';
                                        if ($tab['TIPO_PASANTIA']==2)
											$asi='TRABAJO DE GRADO';
                                            
										printf('<tr height="30">
										<td bgcolor="#FFFFFF"><div class="datosc">%s</td><td bgcolor="#FFFFFF"><div class="datosc">%s</td><td bgcolor="#FFFFFF"><div class="datosc">%s</td><td bgcolor="#FFFFFF"><div class="datosc">%s</td><td bgcolor="#FFFFFF"><div class="datosc">%s</td><td bgcolor="#FFFFFF"><div class="datosc">%s</td><td bgcolor="#FFFFFF"><div class="datosc"><a href="verhist.php?id=%d&as=%s" target="popup" onclick=window.open("", popup, width = 900, height = 800, left=220, top=0, scrollbars=yes)><img src="imagenes/icono_buscar.gif" alt="buscar" width="15"height="15" border="0"></a></td>></td>
										</tr>',$tab["lapso"],$tab["CI_E"],$reg["NOMBRES"],$reg["APELLIDOS"],$asi,$tab["n_proyecto"],$tab["CI_E"],$tab['TIPO_PASANTIA']);

										$k++;
									}

									$j++;

								}
							}
						}
					else
                                                {
                                                    if ($_POST['lapso']!="")
                                                    {
							$j=0;
							$sql2="select CI_E, empresa, n_proyecto, TIPO_PASANTIA, cedula_TI, nombre_TI, apellido_TI, telefono_TI, correo_TI, fecha_i, fecha_c, id_estatus, lapso from sol_historial where CI_E='$_POST[CI_E]' and lapso='$_POST[lapso]' order by CI_E";
							$conex1 -> ExecSQL($sql2,__LINE__,true);    
							$fila = $conex1->filas;
							while ($j<$fila)
							{
							    $tab1 = $conex1->result_h;
							    $tab2 = $conex1->result[$j];
							    $tab = array_combine($tab1,$tab2);
							    
							    $sql1="select NOMBRES, APELLIDOS from dace002 where CI_E = '$tab[CI_E]'";
							    $conex -> ExecSQL($sql1,__LINE__,true);
							    $fila1 = $conex->filas;
							    $k=0;
							    while($k<$fila1)
							    {	
								$reg1 = $conex->result_h;
								$reg2 = $conex->result[$k];
								$reg = array_combine($reg1,$reg2);
							
                                                                    if ($tab['TIPO_PASANTIA']==1)
                                                                        $asi='PRÁCTICA PROFESIONAL';
                                                                    if ($tab['TIPO_PASANTIA']==2)
                                                                        $asi='TRABAJO DE GRADO';
                                                                    printf('
                                                                    <tr height="30"><td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc"><a href="verhist.php?id=%d&as=%s" target="popup" onclick=window.open("", popup, width = 900, height = 800, left=220, top=0, scrollbars=yes)><img src="imagenes/icono_buscar.gif" alt="buscar" width="15"height="15" border="0"></a></td>></td>
                                                                    </tr>',$tab["lapso"],$tab["CI_E"],$reg["NOMBRES"],$reg["APELLIDOS"],$asi,$tab["n_proyecto"],$tab["CI_E"],$tab['TIPO_PASANTIA']);
                                                            $k++;
							    }
							$j++;
                                                        }
                                                    }
                                                    else
                                                    {
							$j=0;
							$sql2="select CI_E, empresa, n_proyecto, TIPO_PASANTIA, cedula_TI, nombre_TI, apellido_TI, telefono_TI, correo_TI, fecha_i, fecha_c, id_estatus, lapso from sol_historial where CI_E='$_POST[CI_E]' order by CI_E";
							$conex1 -> ExecSQL($sql2,__LINE__,true);    
							$fila = $conex1->filas;
							while ($j<$fila)
							{
							    $tab1 = $conex1->result_h;
							    $tab2 = $conex1->result[$j];
							    $tab = array_combine($tab1,$tab2);
							    
							    $sql1="select NOMBRES, APELLIDOS from dace002 where CI_E = '$tab[CI_E]'";
							    $conex -> ExecSQL($sql1,__LINE__,true);
							    $fila1 = $conex->filas;
							    $k=0;
							    while($k<$fila1)
							    {	
								$reg1 = $conex->result_h;
								$reg2 = $conex->result[$k];
								$reg = array_combine($reg1,$reg2);

                                                                    if ($tab['TIPO_PASANTIA']==1)
                                                                        $asi='PRÁCTICA PROFESIONAL';
                                                                    if ($tab['TIPO_PASANTIA']==2)
                                                                        $asi='TRABAJO DE GRADO';
                                                                    printf('
                                                                    <tr height="30"><td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc"><a href="verhist.php?id=%d&as=%s" target="popup" onclick=window.open("", popup, width = 900, height = 800, left=220, top=0, scrollbars=yes)><img src="imagenes/icono_buscar.gif" alt="buscar" width="15"height="15" border="0"></a></td>></td>
                                                                    </tr>',$tab["lapso"],$tab["CI_E"],$reg["NOMBRES"],$reg["APELLIDOS"],$asi,$tab["n_proyecto"],$tab["CI_E"],$tab['TIPO_PASANTIA']);
                                                            $k++;
							    }
							$j++;
                                                        }
                                                    }
                                                }
                   } //Fin Busca por cedula
				   else {
					  // echo  "voy";
					   if ($_POST['TIPO_PASANTIA']!="")
                                                {
                                                    if ($_POST['lapso']!="")
                                                    {
							$j=0;
							$sql2="select CI_E, empresa, n_proyecto, TIPO_PASANTIA, cedula_TI, nombre_TI, apellido_TI, telefono_TI, correo_TI, fecha_i, fecha_c, id_estatus, lapso from sol_historial where TIPO_PASANTIA='$_POST[TIPO_PASANTIA]' and lapso='$_POST[lapso]' order by CI_E";
							$conex1 -> ExecSQL($sql2,__LINE__,true);    
							$fila = $conex1->filas;
							while ($j<$fila)
							{
							    $tab1 = $conex1->result_h;
							    $tab2 = $conex1->result[$j];
							    $tab = array_combine($tab1,$tab2);
							    
							    $sql1="select NOMBRES, APELLIDOS from dace002 where CI_E = '$tab[CI_E]'";
							    $conex -> ExecSQL($sql1,__LINE__,true);
							    $fila1 = $conex->filas;
							    $k=0;
							    while($k<$fila1)
							    {	
								$reg1 = $conex->result_h;
								$reg2 = $conex->result[$k];
								$reg = array_combine($reg1,$reg2);
							
							
                                                                    if ($tab['TIPO_PASANTIA']==1)
                                                                        $asi='PRÁCTICA PROFESIONAL';
                                                                    if ($tab['TIPO_PASANTIA']==2)
                                                                        $asi='TRABAJO DE GRADO';
                                                                    printf('
                                                                    <tr height="30"><td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc"><a href="verhist.php?id=%d&as=%s" target="popup" onclick=window.open("", popup, width = 900, height = 800, left=220, top=0, scrollbars=yes)><img src="imagenes/icono_buscar.gif" alt="buscar" width="15"height="15" border="0"></a></td>></td>
                                                                    </tr>',$tab["lapso"],$tab["CI_E"],$reg["NOMBRES"],$reg["APELLIDOS"],$asi,$tab["n_proyecto"],$tab["CI_E"],$tab['TIPO_PASANTIA']);
                                                            $k++;
							    }
							$j++;
                                                        }
                                                    }
                                                    else
                                                    {
							$j=0;
							$sql2="select CI_E, empresa, n_proyecto, TIPO_PASANTIA, cedula_TI, nombre_TI, apellido_TI, telefono_TI, correo_TI, fecha_i, fecha_c, id_estatus, lapso from sol_historial where TIPO_PASANTIA='$_POST[TIPO_PASANTIA]' order by CI_E";
							$conex1 -> ExecSQL($sql2,__LINE__,true);    
							$fila = $conex1->filas;
							while ($j<$fila)
							{
							    $tab1 = $conex1->result_h;
							    $tab2 = $conex1->result[$j];
							    $tab = array_combine($tab1,$tab2);
							    
							    $sql1="select NOMBRES, APELLIDOS from dace002 where CI_E = '$tab[CI_E]'";
							    $conex -> ExecSQL($sql1,__LINE__,true);
							    $fila1 = $conex->filas;
							    $k=0;
							    while($k<$fila1)
							    {	
								$reg1 = $conex->result_h;
								$reg2 = $conex->result[$k];
								$reg = array_combine($reg1,$reg2);

                                                                    if ($tab['TIPO_PASANTIA']==1)
                                                                        $asi='PRÁCTICA PROFESIONAL';
                                                                    if ($tab['TIPO_PASANTIA']==2)
                                                                        $asi='TRABAJO DE GRADO';
                                                                    printf('
                                                                    <tr height="30"><td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc"><a href="verhist.php?id=%d&as=%s" target="popup" onclick=window.open("", popup, width = 900, height = 800, left=220, top=0, scrollbars=yes)><img src="imagenes/icono_buscar.gif" alt="buscar" width="15"height="15" border="0"></a></td>></td>
                                                                    </tr>',$tab["lapso"],$tab["CI_E"],$reg["NOMBRES"],$reg["APELLIDOS"],$asi,$tab["n_proyecto"],$tab["CI_E"],$tab['TIPO_PASANTIA']);
                                                            $k++;    
							    }
							$j++;
                                                        }
                                                    }
                                                }
                                                else
                                                {
                                                    if ($_POST['lapso']!="")
                                                    {
							$j=0;
							$sql2="select CI_E, empresa, n_proyecto, TIPO_PASANTIA, cedula_TI, nombre_TI, apellido_TI, telefono_TI, correo_TI, fecha_i, fecha_c, id_estatus, lapso from sol_historial where lapso='$_POST[lapso]' order by CI_E";
							$conex1 -> ExecSQL($sql2,__LINE__,true);    
							$fila = $conex1->filas;
							while ($j<$fila)
							{
							    $tab1 = $conex1->result_h;
							    $tab2 = $conex1->result[$j];
							    $tab = array_combine($tab1,$tab2);
							    
							    $sql1="select NOMBRES, APELLIDOS from dace002 where CI_E = '$tab[CI_E]'";
							    $conex -> ExecSQL($sql1,__LINE__,true);
							    $fila1 = $conex->filas;
							    $k=0;
							    while($k<$fila1)
							    {	
								$reg1 = $conex->result_h;
								$reg2 = $conex->result[$k];
								$reg = array_combine($reg1,$reg2);

                                                                    if ($tab['TIPO_PASANTIA']==1)
                                                                        $asi='PRÁCTICA PROFESIONAL';
                                                                    if ($tab['TIPO_PASANTIA']==2)
                                                                        $asi='TRABAJO DE GRADO';
                                                                    printf('
                                                                    <tr height="30"><td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc"><a href="verhist.php?id=%d&as=%s" target="popup" onclick=window.open("", popup, width = 900, height = 800, left=220, top=0, scrollbars=yes)><img src="imagenes/icono_buscar.gif" alt="buscar" width="15"height="15" border="0"></a></td>></td>
                                                                    </tr>',$tab["lapso"],$tab["CI_E"],$reg["NOMBRES"],$reg["APELLIDOS"],$asi,$tab["n_proyecto"],$tab["CI_E"],$tab['TIPO_PASANTIA']);
                                                            $k++;
							    }
							$j++;
                                                        }
                                                    }
						else {// Todo viene en blanco
							$j=0;
							$sql2="select DISTINCT CI_E, empresa, n_proyecto, TIPO_PASANTIA, cedula_TI, nombre_TI, apellido_TI, telefono_TI, correo_TI, fecha_i, fecha_c, id_estatus, lapso from sol_historial order by CI_E";
							$conex1 -> ExecSQL($sql2,__LINE__,true);    
							$fila = $conex1->filas;
							
							//echo $fila;

							while ($j<$fila)
							{
							    $tab1 = $conex1->result_h;
							    $tab2 = $conex1->result[$j];
							    $tab = array_combine($tab1,$tab2);
							    
							    $sql1="select NOMBRES, APELLIDOS from dace002 where CI_E = '$tab[CI_E]'";
							    $conex -> ExecSQL($sql1,__LINE__,true);
							    $fila1 = $conex->filas;
							    $k=0;
							    while($k<$fila1)
							    {	
								$reg1 = $conex->result_h;
								$reg2 = $conex->result[$k];
								$reg = array_combine($reg1,$reg2);							
							
                                                                    if ($tab['TIPO_PASANTIA']==1)
                                                                        $asi='PRÁCTICA PROFESIONAL';
                                                                    if ($tab['TIPO_PASANTIA']==2)
                                                                        $asi='TRABAJO DE GRADO';
                                                                    printf('
                                                                    <tr height="30"><td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
                                                                    <td bgcolor="#FFFFFF"><div class="datosc"><a href="verhist.php?id=%d&as=%s" target="popup" onclick=window.open("", popup, width = 900, height = 800, left=220, top=0, scrollbars=yes)><img src="imagenes/icono_buscar.gif" alt="buscar" width="15"height="15" border="0"></a></td>
                                                                    </tr>',$tab["lapso"],$tab["CI_E"],$reg["NOMBRES"],$reg["APELLIDOS"],$asi,$tab["n_proyecto"],$tab["CI_E"],$tab['TIPO_PASANTIA']);
                                                            $k++;
							    }
							$j++;
                                                        }
                                                    }
                                                }
                                            }
                                        $i++;
					//} // Fin while
                                    }*/
                                ?>
                            </tr>
			</table>
		    </td>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5"><font style="font-size:5px;">&nbsp;</font></td></tr>		
		<tr align="center" colspan="5">
		    <table align="center" border="0" width=40%>
			<tr>
			    <form name="" action="" >
			        <td valign="bottom">
				    <p align="center"><input type="button" value="Finalizar" name="bexit" onclick="window.close();"></p> 
			        </td>
			    </form>
			</tr>
		    </table>
		</tr>
	    </table>
	</form>
</body>
</html>