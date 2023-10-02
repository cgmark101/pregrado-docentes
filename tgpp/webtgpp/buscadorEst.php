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
	    <table border="0px" align="center" width="1100">
		<tr>
		    <td colspan="5" align="center">	
			<table border="0" width="1100">
			    <tr>
				<td width="150">
				    <p align="right" style="margin-top: 0; margin-bottom: 0">
					<img border="0" src="images/unex15.gif" width="75" height="75">
				    </p>
				</td>
				<td width="800">
			            <p class="titulon">UNIVERSIDAD NACIONAL EXPERIMENTAL POLIT&Eacute;CNICA</p>
				    <p class="titulon">"ANTONIO JOS&Eacute; DE SUCRE"</p>
				    <p class="titulon">VICE-RECTORADO PUERTO ORDAZ</p>
				    <p class="titulon">ASIGNATURA TRABAJO DE GRADO Y PR&Aacute;CTICA PROFESIONAL</p>
				</td>
				<td border="0" width="150">&nbsp;</td>
			    </tr>
			</table>
		    </td>
		</tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5">&nbsp</td></tr>
		<tr><td colspan="5">&nbsp</td></tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
	        <tr><td class="enc_p" colspan="5">B&Uacute;SQUEDA DE ESTUDIANTES</td></tr>
                <tr>
                    <table width="1100" height="80"  border="0" align="center" bgcolor="#99CCFF" style="border-collapse: collapse;">
                        <form name="buscador" action="" method="post">
                        <tr>
                            <td width="180" align="center"><span class="datosp">Nombres</span></td>
                            <td width="180" align="center"><span class="datosp">C&eacute;dula</span></td>
                            <td width="180" align="center"><span class="datosp">Asignatura</span></td>
                            <td width="180" align="center"><span class="datosp">Estatus</span></td>
                            <td rowspan="2" width="80" align="center"><input name="buscar" type="submit" class="datosp" value="Buscar"></td>
                        </tr>
                        <tr>
			    <td class="datosc"><input type="text" class="datosc" id="buscar_usuario" name="buscar_usuario" size="45" /></td>
                            <td align="center"><input type="text" class="datosc" id="cedula" name="CI_E" size="15" /></td>
                            <td class="datosc" style="text-align:center">
			    <select name="TIPO_PASANTIA" id="TIPO_PASANTIA" class="datospf">
				<option value=""  <?php if($_POST)if($_POST['TIPO_PASANTIA']=='') echo 'selected="selected" ';?>>SELECCIONE UNA OPCI&Oacute;N</option>
				<option value="1" <?php if($_POST)if($_POST['TIPO_PASANTIA']=='1') echo 'selected="selected" ';?>>Práctica Profesional</option>
				<option value="2" <?php if($_POST)if($_POST['TIPO_PASANTIA']=='2') echo 'selected="selected" ';?>>Trabajo de Grado</option>		
			    </select>                    
                            </td>
                            <td class="datosc" style="text-align:center">
                               <?php
                                    $conexion = mysql_connect("localhost","root","") or die ("Problemas en la conexión");
                                    mysql_select_db("tg-pp",$conexion) or die ("Problemas en la selección de la base de datos");
                                    $resultado = mysql_query("select * from sol_estatus", $conexion)or die ("Problemas en el select");
                                    echo "<select name='id_estatus' id='id_estatus' class='datospf'>";
                                    $Sel[1]="SELECCIONE UNA OPCI&Oacute;N";
                                    $fila[0]="";
                                    if ($fila[0]=="")
                                        {
                                	echo "<option selected value='$fila[0]'>$Sel[1]";
                                        }                                    
                                    while ($fila=mysql_fetch_row($resultado))
                                    {
                                        
                                      if ($fila[0]==1)
                                        {
                                	echo "<option  value='$fila[0]'>$fila[1]";
                                        }
                                     else
                                        {
                                            echo "<option value='$fila[0]'>$fila[1]";
                                        }
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
			<table width="1100"  align=center border="1" CELLPADDING=0 CELLSPACING=0 overflow:auto bgcolor="99CCFF">
			    <tr height="35">
				<th width="30" scope="col"><span class="datosp">C&eacute;dula</span></th>
				<th width="120" scope="col"><span class="datosp">Asignatura</span></th>
                                <th width="120" scope="col"><span class="datosp">Nombres</span></th>
				<th width="120" scope="col"><span class="datosp">Apellidos</span></th>
				<th width="300" scope="col"><span class="datosp">Nombre del Proyecto</span></th>
				<th width="80" scope="col"><span class="datosp">Estatus</span></th>
				<th width="20" scope="col"><span class="datosp">Modificar</span></th>
			    </tr>
			    <tr>
				    <?php
                                    if($_REQUEST)
                                    {
                                        $conexion = mysql_connect("localhost","root","") or die ("Problemas en la conexión");
                                        mysql_select_db("tg-pp",$conexion) or die ("Problemas en la selección de la base de datos");
                                        $tabla = mysql_query("select * from sol_tgpp order by cast(CI_E as unsigned)", $conexion)or die ("Problemas en el select");
                                        while ($tab = mysql_fetch_array($tabla))
                                        {


                                            if($_POST['CI_E']!="")
                                            {
                                                if ($_POST['TIPO_PASANTIA']!="")
                                                {
                                                    if ($_POST['id_estatus']!="")
                                                    {
                                                        mysql_select_db("tg-pp",$conexion) or die ("Problemas en la selección de la base de datos");
                                                        $tabla = mysql_query("select * from sol_tgpp where CI_E='$_POST[CI_E]' and TIPO_PASANTIA='$_POST[TIPO_PASANTIA]' and id_estatus='$_POST[id_estatus]' order by cast(CI_E as unsigned)", $conexion)or die ("Problemas en el select");
                                                        while ($tab = mysql_fetch_array($tabla))
                                                        {
                                                            mysql_select_db("tg-pp",$conexion) or die ("Problemas en la selección de la base de datos");
                                                            $stats = mysql_query("select * from sol_estatus where id_estatus='$tab[id_estatus]'", $conexion)or die ("Problemas en el select");
                                                                if ($stat = mysql_fetch_array($stats))
                                                            {
                                                            mysql_select_db("dace",$conexion) or die ("Problemas en la selección de la base de datos");
                                                                $registros = mysql_query("select CI_E, APELLIDOS, NOMBRES from dace002 where CI_E='$tab[CI_E]'", $conexion)or die ("Problemas en el select");
                                                                if ($reg = mysql_fetch_array($registros))
                                                                {
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
                                                                    <td bgcolor="#FFFFFF"><div class="datosc"><a href="actualizar.php?id=%d&as=%s&st=%s" target="popup" onclick=window.open("", popup, width = 900, height = 800, left=220, top=0, scrollbars=yes)><img src="imagenes/icono_modificar.gif" alt="buscar" width="15"height="15" border="0"></a></td>
                                                                    </tr>',$tab["CI_E"],$asi,$reg["NOMBRES"],$reg["APELLIDOS"],$tab["n_proyecto"],$stat["estatus"],$tab["CI_E"],$tab['TIPO_PASANTIA'],$tab['id_estatus']);
                                                                }
                                                            }
                                                        }
                                                    }
                                                    else
                                                    {
                                                        mysql_select_db("tg-pp",$conexion) or die ("Problemas en la selección de la base de datos");
                                                        $tabla = mysql_query("select * from sol_tgpp where CI_E='$_POST[CI_E]' and TIPO_PASANTIA='$_POST[TIPO_PASANTIA]' order by cast(CI_E as unsigned)", $conexion)or die ("Problemas en el select");
                                                        while ($tab = mysql_fetch_array($tabla))
                                                        {
                                                            mysql_select_db("tg-pp",$conexion) or die ("Problemas en la selección de la base de datos");
                                                            $stats = mysql_query("select * from sol_estatus where id_estatus='$tab[id_estatus]'", $conexion)or die ("Problemas en el select");
                                                                if ($stat = mysql_fetch_array($stats))
                                                            {
                                                            mysql_select_db("dace",$conexion) or die ("Problemas en la selección de la base de datos");
                                                                $registros = mysql_query("select CI_E, APELLIDOS, NOMBRES from dace002 where CI_E='$tab[CI_E]'", $conexion)or die ("Problemas en el select");
                                                                if ($reg = mysql_fetch_array($registros))
                                                                {
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
                                                                    <td bgcolor="#FFFFFF"><div class="datosc"><a href="actualizar.php?id=%d&as=%s&st=%s" target="popup" onclick=window.open("", popup, width = 900, height = 800, left=220, top=0, scrollbars=yes)><img src="imagenes/icono_modificar.gif" alt="buscar" width="15"height="15" border="0"></a></td>
                                                                    </tr>',$tab["CI_E"],$asi,$reg["NOMBRES"],$reg["APELLIDOS"],$tab["n_proyecto"],$stat["estatus"],$tab["CI_E"],$tab['id_estatus']);
                                                                }                                                                                
                                                            }                           
                                                        }
                                                    }
                                                }
                                                else
                                                {
                                                    if ($_POST['id_estatus']!="")
                                                    {
                                                        mysql_select_db("tg-pp",$conexion) or die ("Problemas en la selección de la base de datos");
                                                        $tabla = mysql_query("select * from sol_tgpp where CI_E='$_POST[CI_E]' and id_estatus='$_POST[id_estatus]' order by cast(CI_E as unsigned)", $conexion)or die ("Problemas en el select");
                                                        while ($tab = mysql_fetch_array($tabla))
                                                        {
                                                            mysql_select_db("tg-pp",$conexion) or die ("Problemas en la selección de la base de datos");
                                                            $stats = mysql_query("select * from sol_estatus where id_estatus='$tab[id_estatus]'", $conexion)or die ("Problemas en el select");
                                                                if ($stat = mysql_fetch_array($stats))
                                                            {
                                                            mysql_select_db("dace",$conexion) or die ("Problemas en la selección de la base de datos");
                                                                $registros = mysql_query("select CI_E, APELLIDOS, NOMBRES from dace002 where CI_E='$tab[CI_E]'", $conexion)or die ("Problemas en el select");
                                                                if ($reg = mysql_fetch_array($registros))
                                                                {
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
                                                                    <td bgcolor="#FFFFFF"><div class="datosc"><a href="actualizar.php?id=%d&as=%s&st=%s" target="popup" onclick=window.open("", popup, width = 900, height = 800, left=220, top=0, scrollbars=yes)><img src="imagenes/icono_modificar.gif" alt="buscar" width="15"height="15" border="0"></a></td>
                                                                    </tr>',$tab["CI_E"],$asi,$reg["NOMBRES"],$reg["APELLIDOS"],$tab["n_proyecto"],$stat["estatus"],$tab["CI_E"],$tab['TIPO_PASANTIA'],$tab['id_estatus']);
                                                                }
                                                            }
                                                        }
                                                    }
                                                    else
                                                    {
                                                        mysql_select_db("tg-pp",$conexion) or die ("Problemas en la selección de la base de datos");
                                                        $tabla = mysql_query("select * from sol_tgpp where CI_E='$_POST[CI_E]' order by cast(CI_E as unsigned)", $conexion)or die ("Problemas en el select");
                                                        while ($tab = mysql_fetch_array($tabla))
                                                        {
                                                            mysql_select_db("tg-pp",$conexion) or die ("Problemas en la selección de la base de datos");
                                                            $stats = mysql_query("select * from sol_estatus where id_estatus='$tab[id_estatus]'", $conexion)or die ("Problemas en el select");
                                                                if ($stat = mysql_fetch_array($stats))
                                                            {
                                                            mysql_select_db("dace",$conexion) or die ("Problemas en la selección de la base de datos");
                                                                $registros = mysql_query("select CI_E, APELLIDOS, NOMBRES from dace002 where CI_E='$tab[CI_E]'", $conexion)or die ("Problemas en el select");
                                                                if ($reg = mysql_fetch_array($registros))
                                                                {
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
                                                                    <td bgcolor="#FFFFFF"><div class="datosc"><a href="actualizar.php?id=%d&as=%s&st=%s" target="popup" onclick=window.open("", popup, width = 900, height = 800, left=220, top=0, scrollbars=yes)><img src="imagenes/icono_modificar.gif" alt="buscar" width="15"height="15" border="0"></a></td>
                                                                    </tr>',$tab["CI_E"],$asi,$reg["NOMBRES"],$reg["APELLIDOS"],$tab["n_proyecto"],$stat["estatus"],$tab["CI_E"],$tab['TIPO_PASANTIA'],$tab['id_estatus']);
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            else
                                            {
                                                if ($_POST['TIPO_PASANTIA']!="")
                                                {
                                                    if ($_POST['id_estatus']!="")
                                                    {
                                                        mysql_select_db("tg-pp",$conexion) or die ("Problemas en la selección de la base de datos");
                                                        $tabla = mysql_query("select * from sol_tgpp where TIPO_PASANTIA='$_POST[TIPO_PASANTIA]' and id_estatus='$_POST[id_estatus]' order by cast(CI_E as unsigned)", $conexion)or die ("Problemas en el select");
                                                        while ($tab = mysql_fetch_array($tabla))
                                                        {
                                                            mysql_select_db("tg-pp",$conexion) or die ("Problemas en la selección de la base de datos");
                                                            $stats = mysql_query("select * from sol_estatus where id_estatus='$tab[id_estatus]'", $conexion)or die ("Problemas en el select");
                                                                if ($stat = mysql_fetch_array($stats))
                                                            {
                                                            mysql_select_db("dace",$conexion) or die ("Problemas en la selección de la base de datos");
                                                                $registros = mysql_query("select CI_E, APELLIDOS, NOMBRES from dace002 where CI_E='$tab[CI_E]'", $conexion)or die ("Problemas en el select");
                                                                if ($reg = mysql_fetch_array($registros))
                                                                {
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
                                                                    <td bgcolor="#FFFFFF"><div class="datosc"><a href="actualizar.php?id=%d&as=%s&st=%s" target="popup" onclick=window.open("", popup, width = 900, height = 800, left=220, top=0, scrollbars=yes)><img src="imagenes/icono_modificar.gif" alt="buscar" width="15"height="15" border="0"></a></td>
                                                                    </tr>',$tab["CI_E"],$asi,$reg["NOMBRES"],$reg["APELLIDOS"],$tab["n_proyecto"],$stat["estatus"],$tab["CI_E"],$tab['TIPO_PASANTIA'],$tab['id_estatus']);
                                                                }
                                                            }
                                                        }
                                                    }
                                                    else
                                                    {
                                                        mysql_select_db("tg-pp",$conexion) or die ("Problemas en la selección de la base de datos");
                                                        $tabla = mysql_query("select * from sol_tgpp where TIPO_PASANTIA='$_POST[TIPO_PASANTIA]' order by cast(CI_E as unsigned)", $conexion)or die ("Problemas en el select");
                                                        while ($tab = mysql_fetch_array($tabla))
                                                        {
                                                            mysql_select_db("tg-pp",$conexion) or die ("Problemas en la selección de la base de datos");
                                                            $stats = mysql_query("select * from sol_estatus where id_estatus='$tab[id_estatus]'", $conexion)or die ("Problemas en el select");
                                                                if ($stat = mysql_fetch_array($stats))
                                                            {
                                                            mysql_select_db("dace",$conexion) or die ("Problemas en la selección de la base de datos");
                                                                $registros = mysql_query("select CI_E, APELLIDOS, NOMBRES from dace002 where CI_E='$tab[CI_E]'", $conexion)or die ("Problemas en el select");
                                                                if ($reg = mysql_fetch_array($registros))
                                                                {
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
                                                                    <td bgcolor="#FFFFFF"><div class="datosc"><a href="actualizar.php?id=%d&as=%s&st=%s" target="popup" onclick=window.open("", popup, width = 900, height = 800, left=220, top=0, scrollbars=yes)><img src="imagenes/icono_modificar.gif" alt="buscar" width="15"height="15" border="0"></a></td>
                                                                    </tr>',$tab["CI_E"],$asi,$reg["NOMBRES"],$reg["APELLIDOS"],$tab["n_proyecto"],$stat["estatus"],$tab["CI_E"],$tab['TIPO_PASANTIA'],$tab['id_estatus']);
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                else
                                                {
                                                    if ($_POST['id_estatus']!="")
                                                    {
                                                        mysql_select_db("tg-pp",$conexion) or die ("Problemas en la selección de la base de datos");
                                                        $tabla = mysql_query("select * from sol_tgpp where id_estatus='$_POST[id_estatus]' order by cast(CI_E as unsigned)", $conexion)or die ("Problemas en el select");
                                                        while ($tab = mysql_fetch_array($tabla))
                                                        {
                                                            mysql_select_db("tg-pp",$conexion) or die ("Problemas en la selección de la base de datos");
                                                            $stats = mysql_query("select * from sol_estatus where id_estatus='$tab[id_estatus]'", $conexion)or die ("Problemas en el select");
                                                                if ($stat = mysql_fetch_array($stats))
                                                            {
                                                            mysql_select_db("dace",$conexion) or die ("Problemas en la selección de la base de datos");
                                                                $registros = mysql_query("select CI_E, APELLIDOS, NOMBRES from dace002 where CI_E='$tab[CI_E]'", $conexion)or die ("Problemas en el select");
                                                                if ($reg = mysql_fetch_array($registros))
                                                                {
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
                                                                    <td bgcolor="#FFFFFF"><div class="datosc"><a href="actualizar.php?id=%d&as=%s&st=%s" target="popup" onclick=window.open("", popup, width = 900, height = 800, left=220, top=0, scrollbars=yes)><img src="imagenes/icono_modificar.gif" alt="buscar" width="15"height="15" border="0"></a></td>
                                                                    </tr>',$tab["CI_E"],$asi,$reg["NOMBRES"],$reg["APELLIDOS"],$tab["n_proyecto"],$stat["estatus"],$tab["CI_E"],$tab['TIPO_PASANTIA'],$tab['id_estatus']);
                                                                }
                                                            }
                                                        }
                                                    }
                                                    else
                                                    {
                                                        mysql_select_db("tg-pp",$conexion) or die ("Problemas en la selección de la base de datos");
                                                        $tabla = mysql_query("select * from sol_tgpp order by cast(CI_E as unsigned)", $conexion)or die ("Problemas en el select");
                                                        while ($tab = mysql_fetch_array($tabla))
                                                        {
                                                            mysql_select_db("tg-pp",$conexion) or die ("Problemas en la selección de la base de datos");
                                                            $stats = mysql_query("select * from sol_estatus where id_estatus='$tab[id_estatus]'", $conexion)or die ("Problemas en el select");
                                                                if ($stat = mysql_fetch_array($stats))
                                                            {
                                                            mysql_select_db("dace",$conexion) or die ("Problemas en la selección de la base de datos");
                                                                $registros = mysql_query("select CI_E, APELLIDOS, NOMBRES from dace002 where CI_E='$tab[CI_E]'", $conexion)or die ("Problemas en el select");
                                                                if ($reg = mysql_fetch_array($registros))
                                                                {
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
                                                                    <td bgcolor="#FFFFFF"><div class="datosc"><a href="actualizar.php?id=%d&as=%s&st=%s" target="popup" onclick=window.open("", popup, width = 900, height = 800, left=220, top=0, scrollbars=yes)><img src="imagenes/icono_modificar.gif" alt="buscar" width="15"height="15" border="0"></a></td>
                                                                    </tr>',$tab["CI_E"],$asi,$reg["NOMBRES"],$reg["APELLIDOS"],$tab["n_proyecto"],$stat["estatus"],$tab["CI_E"],$tab['TIPO_PASANTIA'],$tab['id_estatus']);
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
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