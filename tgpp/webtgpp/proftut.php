<?php //session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>Consulta de Bachilleres Asignados</title>
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
        $ced=$_GET["id"];
	$sql1="select APELLIDO, NOMBRE, DEPARTAMENTO from tblaca007 where CI = '$ced'";
	$conex -> ExecSQL($sql1,__LINE__,true);
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
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
	        <tr><td class="enc_p" colspan="5">DATOS DEL PROFESOR</td></tr>
		<tr align="center">
		    <td colspan="5">
		        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
			    <tbody>
			        <tr>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Apellidos:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Nombres:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>C&eacute;dula:</B></div></td>
				</tr>
				<?php
				$fila = $conex->filas;
    				if ($fila!=0)
				{
				    $reg1 = $conex->result_h;
				    $reg2 = $conex->result[0];
				    $reg = array_combine($reg1,$reg2);	

				    printf('<tr>
					<td <div class="datosc">%s</div></td>
					<td <div class="datosc">%s</div></td>
					<td <div class="datosc">%s</div></td></tr>',$reg["APELLIDO"],$reg["NOMBRE"],$ced);
				?>
				<tr>
				    <td colspan="3" bgcolor="#FFFFFF"><div class="datosc"><B>Departamento:</B></div></td>
				</tr>
				<?php
				    $sql1="select CARRERA from tblaca010 where C_UNI_CA= '$reg[DEPARTAMENTO]'";
				    $conex -> ExecSQL($sql1,__LINE__,true);
				    $fila = $conex->filas;
				    if ($fila!=0)
				    {
				        $esp1 = $conex->result_h;
				        $esp2 = $conex->result[0];
				        $espe = array_combine($esp1,$esp2);
				    printf('<tr>
				    <td colspan="3" bgcolor="#FFFFFF"><div class="datosc">%s</div></td></td>',$espe["CARRERA"]);
				    }
				}
				?>
			    </tbody>
			</table>
		    </td>
		</tr>
		<tr><td colspan="5"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<?php
		$sql2="select CI_E, TIPO_PASANTIA, n_proyecto, cedula_TA from sol_tgpp";
		$conex1 -> ExecSQL($sql2,__LINE__,true);
	
		$fila = $conex1->filas;
		$j=0;
		$i=0;
		while ($j<$fila)
		{
		    $tab1 = $conex1->result_h;
		    $tab2 = $conex1->result[$j];
		    $tab = array_combine($tab1,$tab2);

		    if ($tab['cedula_TA'] == $ced)
		    {$i++;}
		$j++;
		}
		?>
		<tr><td class="enc_p" colspan="5">TUTOR ACAD&Eacute;MICO DE <?php echo("$i");?> BACHILLER<?php if($i!=1){echo("ES");}?></td></tr>
		<tr align="center">
		    <td colspan="5">
			<table width="800" border="1" align="center" CELLPADDING=0 CELLSPACING=0 overflow: auto; bgcolor="99CCFF">
			    <tr >
				<th width="80" height="36" scope="col"><span class="datosp">C&eacute;dula</span></th>
				<th width="80" height="36" scope="col"><span class="datosp">Asignatura</span></th>
				<th width="80" height="36" scope="col"><span class="datosp">Nombres</span></th>
				<th width="80" scope="col"><span class="datosp">Apellidos</span></th>
				<th width="260" scope="col"><span class="datosp">Titulo del Proyecto</span></th>
			    </tr>
			    <tr>
				    <?php
					$sql2="select CI_E, TIPO_PASANTIA, n_proyecto, cedula_TA from sol_tgpp";
					$conex1 -> ExecSQL($sql2,__LINE__,true);
					$fila = $conex1->filas;
					$j=0;
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
					    if ($tab['cedula_TA'] == $ced)
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
					        <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosc">%s</td>
						<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosc">%s</td>
					        <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosc">%s</td>
					        <td  bgcolor="#FFFFFF"><div class="datosc">%s</td></tr>',$tab["CI_E"],$asi,$reg["NOMBRES"],$reg["APELLIDOS"],$tab["n_proyecto"]);
					    }
					    $k++;
					    }
					    $j++;
					    
					    }
					
				    ?>
			    </tr>
			</table>
			<?php if ($j==0){?>  <span class="datosc">NO TIENE ASIGNACIONES</span><?php}?>
		    </td>
		</tr>
		<tr><td colspan="5"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<?php
		$sql2="select CI_E, TIPO_PASANTIA, n_proyecto, cedula_JC from sol_tgpp";
		$conex1 -> ExecSQL($sql2,__LINE__,true);
	
		$fila = $conex1->filas;
		$j=0;
		$i=0;
		while ($j<$fila)
		{
		    $tab1 = $conex1->result_h;
		    $tab2 = $conex1->result[$j];
		    $tab = array_combine($tab1,$tab2);

		    if ($tab['cedula_JC'] == $ced)
		    {$i++;}
		$j++;}
		?>
		<tr><td class="enc_p" colspan="5">JURADO COORDINADOR DE <?php echo("$i");?> BACHILLER<?php if($i!=1){echo("ES");}?></td></tr>
		<tr align="center">
		    <td colspan="5">
			<table width="800" border="1" align="center" CELLPADDING=0 CELLSPACING=0 overflow: auto; bgcolor="99CCFF">
			    <tr >
				<th width="80" height="36" scope="col"><span class="datosp">C&eacute;dula</span></th>
				<th width="80" height="36" scope="col"><span class="datosp">Asignatura</span></th>
				<th width="80" height="36" scope="col"><span class="datosp">Nombres</span></th>
				<th width="80" scope="col"><span class="datosp">Apellidos</span></th>
				<th width="260" scope="col"><span class="datosp">Titulo del Proyecto</span></th>
			    </tr>
			    <tr>
				    <?php
					$sql2="select CI_E, TIPO_PASANTIA, n_proyecto, cedula_JC from sol_tgpp";
					$conex1 -> ExecSQL($sql2,__LINE__,true);
					$fila = $conex1->filas;
					$j=0;
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
					    if ($tab['cedula_JC'] == $ced)
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
					        <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosc">%s</td>
						<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosc">%s</td>
					        <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosc">%s</td>
					        <td  bgcolor="#FFFFFF"><div class="datosc">%s</td></tr>',$tab["CI_E"],$asi,$reg["NOMBRES"],$reg["APELLIDOS"],$tab["n_proyecto"]);
					    }
					    $k++;
					    }
					    $j++;
					    
					    }
					
				    ?>
			    </tr>
			</table>
			<?php if ($j==0){?>  <span class="datosc">NO TIENE ASIGNACIONES</span><?php}?>
		    </td>
		</tr>
		<tr><td colspan="5"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<?php
		$sql2="select CI_E, TIPO_PASANTIA, n_proyecto, cedula_JS from sol_tgpp";
		$conex1 -> ExecSQL($sql2,__LINE__,true);
	
		$fila = $conex1->filas;
		$j=0;
		$i=0;
		while ($j<$fila)
		{
		    $tab1 = $conex1->result_h;
		    $tab2 = $conex1->result[$j];
		    $tab = array_combine($tab1,$tab2);

		    if ($tab['cedula_JS'] == $ced)
		    {$i++;}
		$j++;}
		?>
		<tr><td class="enc_p" colspan="5">JURADO SECRETARIO DE <?php echo("$i");?> BACHILLER<?php if($i!=1){echo("ES");}?></td></tr>
		<tr align="center">
		    <td colspan="5">
			<table width="800" border="1" align="center" CELLPADDING=0 CELLSPACING=0 overflow: auto; bgcolor="99CCFF">
			    <tr >
				<th width="80" height="36" scope="col"><span class="datosp">C&eacute;dula</span></th>
				<th width="80" height="36" scope="col"><span class="datosp">Asignatura</span></th>
				<th width="80" height="36" scope="col"><span class="datosp">Nombres</span></th>
				<th width="80" scope="col"><span class="datosp">Apellidos</span></th>
				<th width="260" scope="col"><span class="datosp">Titulo del Proyecto</span></th>
			    </tr>
			    <tr>
				    <?php
					$sql2="select CI_E, TIPO_PASANTIA, n_proyecto, cedula_JS from sol_tgpp";
					$conex1 -> ExecSQL($sql2,__LINE__,true);
					$fila = $conex1->filas;
					$j=0;
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
					    if ($tab['cedula_JS'] == $ced)
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
					        <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosc">%s</td>
						<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosc">%s</td>
					        <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosc">%s</td>
					        <td  bgcolor="#FFFFFF"><div class="datosc">%s</td></tr>',$tab["CI_E"],$asi,$reg["NOMBRES"],$reg["APELLIDOS"],$tab["n_proyecto"]);
					    }
					    $k++;
					    }
					    $j++;
					    
					    }
				    ?>
			    </tr>
			</table>
			<?php if ($j==0){?>  <span class="datosc">NO TIENE ASIGNACIONES</span><?php}?>
		    </td>
		</tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5"><font style="font-size:5px;">&nbsp;</font></td></tr>		
		<tr align=center>
		    <table align="center" border="0" width=40%>
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
			</tr>
		    </table>
		</tr>
	    </table>
	</form>
</body>
</html>