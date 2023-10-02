<?php session_start()?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>Búsqueda de Estudiantes</title>
    <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
    <link rel="stylesheet" media="all" type="text/css" href="css/estilos.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link type="text/css" rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.16.custom.css"/>
    <script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
    <script type="text/javascript" src="js/autocomplet.js"></script>
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
	    <tr><td class="enc_p" colspan="5">B&Uacute;SQUEDA DE ESTUDIANTES</td></tr>
                <tr>
                    <table width="900" height="60"  border="0" align="center" bgcolor="#99CCFF" style="border-collapse: collapse;">
                        <form name="buscador" action="" method="post">
                        <tr>
                            <!-- <td width="140" align="center"><span class="datosp">Nombres</span></td> -->
                            <td width="120" align="center"><span class="datosp">C&eacute;dula</span></td>
                            <td width="180" align="center"><span class="datosp">Asignatura</span></td>
                            <td width="180" align="center"><span class="datosp">Estatus</span></td>
                            <td rowspan="2" width="80" align="center"><input name="buscar" type="submit" class="datosp" value="Buscar"></td>
                        </tr>
                        <tr>
			   <!--  <td class="datosc"><input type="text" class="datosc" id="buscar_usuario" name="buscar_usuario" size="45" /></td> -->
                <td align="center"><input type="text" class="datosc" id="cedula" name="CI_E" size="15" /></td>
                <td class="datosc" style="text-align:center">
			    <select name="TIPO_PASANTIA" id="TIPO_PASANTIA" class="datospf">
					<option value="">SELECCIONE UNA OPCI&Oacute;N</option>
					<?php
						switch ($_SESSION['campus']){
							case 'P':
								echo " <option value='1' selected='selected'>PR&Aacute;CTICA PROFESIONAL</option> ";
								break;
							case 'T':
								echo " <option value='2' selected='selected'>TRABAJO DE GRADO</option> ";
								break;
							case 'G':
								echo " <option value='1'>PR&Aacute;CTICA PROFESIONAL</option> ";
								echo " <option value='2'>TRABAJO DE GRADO</option> ";
								break;
						}

					?>
					<!-- <option value="1" <?php if($_POST)if($_POST['TIPO_PASANTIA']=='1') echo 'selected="selected" ';?>>PR&Aacute;CTICA PROFESIONAL</option>
					<option value="2" <?php if($_POST)if($_POST['TIPO_PASANTIA']=='2') echo 'selected="selected" ';?>>TRABAJO DE GRADO</option>	 -->	
			    </select>                    
                            </td>
                            <td class="datosc" style="text-align:center">
                               <?php			
				    include_once('conexion.php');
				    $sql2="select id_estatus, estatus from sol_estatus";
				    $conex1 -> ExecSQL($sql2,__LINE__,true);
				    $fil = $conex1->filas;
				    echo "<select name='id_estatus' id='id_estatus' class='datospf'>";
                                    $Sel[1]="SELECCIONE UNA OPCI&Oacute;N";
                                    $fila[0]="";
                                    if ($fila[0]=="")
                                        {
                                	echo "<option selected value='$fila[0]'>$Sel[1]";
                                        } 
				    $i=0;
				    while ($i<$fil)
				    {
					$fila = $conex1->result[$i];
					echo "<option value='$fila[0]'>$fila[1]";
					$i++;
					}
                                    echo "</select>";
                                ?>            
                            </td>
                        </tr>
                        </form>
                    </table>
                </tr>
                <tr><td colspan="5"><font style="font-size:12px;">&nbsp;</font></td></tr>		
		<tr>
		    <td colspan="5">
			<table width="900"  align="center" border="1" bgcolor="99CCFF" style="border-collapse:collapse;">
			    <tr height="35">
				<th width="32" scope="col"><span class="datosp">#</span></th>
				<th width="32" scope="col"><span class="datosp">C&eacute;dula</span></th>
				<th width="140" scope="col"><span class="datosp">Asignatura</span></th>
                <th width="100" scope="col"><span class="datosp">Nombres</span></th>
				<th width="100" scope="col"><span class="datosp">Apellidos</span></th>
				<th width="300" scope="col"><span class="datosp">Titulo del Proyecto</span></th>
				<th width="80" scope="col"><span class="datosp">Estatus</span></th>
				<th width="20" scope="col"><span class="datosp">Administrar</span></th>
			    </tr>
			    <tr>
				    <?php
						if($_REQUEST) {	
						
							$sql2 = "SELECT CI_E, empresa, n_proyecto, TIPO_PASANTIA, cedula_TI, ";
							$sql2.= "nombre_TI, apellido_TI, telefono_TI, correo_TI, fecha_i, fecha_c, ";
							$sql2.= "id_estatus from sol_tgpp ";
							$sql2.= "WHERE c_uni_ca='".$_SESSION['usuario']."' ";

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
								default:
									$sql2.= " and TIPO_PASANTIA IN ('1','2') ";
							}

							
							$sql2.= ($_POST['CI_E'] != "") ? " AND CI_E='".$_POST[CI_E]."' " : " ";

							$sql2.= ($_POST['TIPO_PASANTIA']) ? " AND TIPO_PASANTIA='".$_POST[TIPO_PASANTIA]."' " : " ";

							$sql2.= ($_POST['id_estatus'] != "") ? " AND id_estatus='".$_POST[id_estatus]."' " : " ";
							
							//echo $sql2;
							
							/*switch($caso) {
								case 0:
									$sql2="select CI_E, empresa, n_proyecto, TIPO_PASANTIA, cedula_TI, nombre_TI, apellido_TI, telefono_TI, correo_TI, fecha_i, fecha_c, id_estatus from sol_tgpp where CI_E='$_POST[CI_E]' and TIPO_PASANTIA='$_POST[TIPO_PASANTIA]' and id_estatus='$_POST[id_estatus]' AND c_uni_ca='".$_SESSION['usuario']."' order by CI_E";
									break;
								case 1:
									$sql2="select CI_E, empresa, n_proyecto, TIPO_PASANTIA, cedula_TI, nombre_TI, apellido_TI, telefono_TI, correo_TI, fecha_i, fecha_c, id_estatus from sol_tgpp where CI_E='$_POST[CI_E]' and TIPO_PASANTIA='$_POST[TIPO_PASANTIA]' AND c_uni_ca='".$_SESSION['usuario']."' order by CI_E";
									break;
								case 2:
									$sql2="select CI_E, empresa, n_proyecto, TIPO_PASANTIA, cedula_TI, nombre_TI, apellido_TI, telefono_TI, correo_TI, fecha_i, fecha_c, id_estatus from sol_tgpp where CI_E='$_POST[CI_E]' and id_estatus='$_POST[id_estatus]' AND c_uni_ca='".$_SESSION['usuario']."' order by CI_E";
									break;
								case 3:
									$sql2="select CI_E, empresa, n_proyecto, TIPO_PASANTIA, cedula_TI, nombre_TI, apellido_TI, telefono_TI, correo_TI, fecha_i, fecha_c, id_estatus from sol_tgpp where CI_E='$_POST[CI_E]' AND c_uni_ca='".$_SESSION['usuario']."' order by CI_E";
									break;
								case 4:
									$sql2="select CI_E, empresa, n_proyecto, TIPO_PASANTIA, cedula_TI, nombre_TI, apellido_TI, telefono_TI, correo_TI, fecha_i, fecha_c, id_estatus from sol_tgpp where TIPO_PASANTIA='$_POST[TIPO_PASANTIA]' and id_estatus='$_POST[id_estatus]' AND c_uni_ca='".$_SESSION['usuario']."' order by CI_E";
									break;
								case 5:
									$sql2="select CI_E, empresa, n_proyecto, TIPO_PASANTIA, cedula_TI, nombre_TI, apellido_TI, telefono_TI, correo_TI, fecha_i, fecha_c, id_estatus from sol_tgpp where TIPO_PASANTIA='$_POST[TIPO_PASANTIA]' AND c_uni_ca='".$_SESSION['usuario']."' order by CI_E";
									break;
								case 6:
									$sql2="select CI_E, empresa, n_proyecto, TIPO_PASANTIA, cedula_TI, nombre_TI, apellido_TI, telefono_TI, correo_TI, fecha_i, fecha_c, id_estatus from sol_tgpp where id_estatus='$_POST[id_estatus]' AND c_uni_ca='".$_SESSION['usuario']."' order by CI_E";
									break;
								case 7:
									$sql2="select CI_E, empresa, n_proyecto, TIPO_PASANTIA, cedula_TI, nombre_TI, apellido_TI, telefono_TI, correo_TI, fecha_i, fecha_c, id_estatus from sol_tgpp ";
									$sql2.=" WHERE c_uni_ca='".$_SESSION['usuario']."' ";
									break;
								default:
									$sql2="";
									break;
							}*/

							$conex1 -> ExecSQL($sql2,__LINE__,true);
							$fila1 = $conex1->filas;
							$j=0;

							while ($j<$fila1) {
								
								$conex1 -> ExecSQL($sql2,__LINE__,true);
								$tab1 = $conex1->result_h;
								$tab2 = $conex1->result[$j];
								$tab = array_combine($tab1,$tab2);
								$sql1="select NOMBRES, APELLIDOS, C_UNI_CA from dace002 where CI_E = '$tab[CI_E]'";
								$conex -> ExecSQL($sql1,__LINE__,true);
								
								$reg1 = $conex->result_h;
								$reg2 = $conex->result[0];
								@$reg = array_combine($reg1,$reg2);

								$sql3="select id_estatus, estatus from sol_estatus where id_estatus='$tab[id_estatus]'";
								$conex1 -> ExecSQL($sql3,__LINE__,true);
								
								$fila2 = $conex1->filas;
								
								if ($fila2!=0) {
									$sta1 = $conex1->result_h;
									$sta2 = $conex1->result[0];
									$stat = array_combine($sta1,$sta2);
								
									if ($tab['TIPO_PASANTIA']==1)
										$asi='PRÁCTICA PROFESIONAL';
									if ($tab['TIPO_PASANTIA']==2)
										$asi='TRABAJO DE GRADO';

									if ($reg['C_UNI_CA']==$_SESSION['usuario']) {
										printf('
										<tr height="30" >
											<td bgcolor="#FFFFFF" style="font-family:arial;font-size:11px;text-align:center;">
												%s
											</td>
											<td bgcolor="#FFFFFF" style="font-family:arial;font-size:11px;text-align:center;">
												%s
											</td>
											<td bgcolor="#FFFFFF" style="font-family:arial;font-size:11px;text-align:center;">
												%s
											</td>
											<td bgcolor="#FFFFFF" style="font-family:arial;font-size:11px;text-align:center;">
												%s
											</td>
											<td bgcolor="#FFFFFF" style="font-family:arial;font-size:11px;text-align:center;">
												%s
											</td>
											<td bgcolor="#FFFFFF" style="font-family:arial;font-size:11px;text-align:center;">
												%s
											</td>
											<td bgcolor="#FFFFFF" style="font-family:arial;font-size:11px;text-align:center;">
												%s
											</td>
											<td bgcolor="#FFFFFF"><div class="datosc"><a href="actualizar.php?id=%s&as=%s&st=%s" target="popup" onclick=window.open("", popup, width = 900, height = 800, left=220, top=0, scrollbars=yes)><img src="imagenes/icono_modificar.gif" alt="buscar" width="15"height="15" border="0"></a></td>
										</tr>',$j+1,$tab["CI_E"],$asi,$reg["NOMBRES"],$reg["APELLIDOS"],$tab["n_proyecto"],$stat["estatus"],$tab["CI_E"],$tab['TIPO_PASANTIA'],$tab['id_estatus']);
									}
								}
								$j++;
							}// end while
					}// end REQUEST
					
				?>
			    </tr>
			</table>
		    </td>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5"><font style="font-size:5px;">&nbsp;</font></td></tr>		
		<tr align="center" colspan="5">
		    <table align="center" border="0" width="40%">
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