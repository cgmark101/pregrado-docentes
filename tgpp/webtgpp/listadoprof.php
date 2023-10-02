<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>Listado de Profesores</title>
    <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" media="all" type="text/css" href="css/estilos.css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script src="http://cherne.net/brian/resources/jquery.hoverIntent.minified.js"></script>
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
    <?php
     include_once('conexion.php');
    ?>
	    <table border="0px" align="center" width="750">
		<tr>
		    <td colspan="5" align="center">	
			<table border="0" width="750">
			    <tr>
				<td width="100">
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
				<td border="0" width="50">&nbsp;</td>
			    </tr>
			</table>
		    </td>
		</tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5">&nbsp</td></tr>
		<tr><td colspan="5">&nbsp</td></tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
	        <tr><td class="enc_p" colspan="5">LISTADO DE PROFESORES</td></tr>
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
		    if ($tab['cedula_TA'] == $_SESSION['cedula'])
		    {$i++;}
		    $j++;
		    }
		?>
		<tr>
		    <td colspan="5">
			<table width="750" border="1" CELLPADDING=0 CELLSPACING=0 overflow:auto bgcolor="99CCFF">
			    <tr height="45">
				<th width="50" scope="col"><span class="datosp">C&eacute;dula</span></th>
				<th width="120" scope="col"><span class="datosp">Apellidos</span></th>
				<th width="120" scope="col"><span class="datosp">Nombres</span></th>
				<th width="60" scope="col"><span class="datosp">Tutor Académico</span></th>
				<th width="60" scope="col"><span class="datosp">Jurado Coordinador</span></th>
				<th width="60" scope="col"><span class="datosp">Jurado Secretario</span></th>
				<th width="20" scope="col"><span class="datosp">Buscar</span></th>
			    </tr>
			    <tr>
				    <?php
				$sql1="select CI, APELLIDO, NOMBRE, DEPARTAMENTO from tblaca007 order by APELLIDO";
					$conex -> ExecSQL($sql1,__LINE__,true);
					$k=0;
					$fila0 = $conex->filas;
					while ($k<$fila0)
				        {
					    $pro1 = $conex->result_h;
					    $pro2 = $conex->result[$k];
					    $prof = array_combine($pro1,$pro2);											
					    $ta=0;
					    $jc=0;
					    $js=0;
					    $sql2="select cedula_TA, cedula_JC, cedula_JS from sol_tgpp";
					    $conex1 -> ExecSQL($sql2,__LINE__,true);
					    $fila1 = $conex1->filas;
					    $j=0;
					    while ($j<$fila1)
					    {
						$tab1 = $conex1->result_h;
						$tab2 = $conex1->result[$j];
						$tab = array_combine($tab1,$tab2);

						if ($prof['CI']==$tab['cedula_TA'])
						{
						    $ta++;
						}
						if ($prof['CI']==$tab['cedula_JC'])
						{
						    $jc++;
						}
						if ($prof['CI']==$tab['cedula_JS'])
						{
						    $js++;
						}
					    $j++;
					    }
						if ($prof['DEPARTAMENTO']==	$_SESSION['usuario'] && $prof['CI']!='.')
							{
					    printf('
					        <tr height="30"><td bgcolor="#FFFFFF"><div class="datosc">%s</td>
					        <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
					        <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
					        <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
					        <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
					        <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
						<td bgcolor="#FFFFFF"><div class="datosc"><a href="proftut.php?id=%d" target="popup2" onclick=window.open("", popup2, width = 900, height = 800, left=220, top=0, scrollbars=yes)><img src="imagenes/icono_buscar.gif" alt="buscar" width="15"height="15" border="0"></a></td>
						</tr>',$prof["CI"],$prof["APELLIDO"],$prof["NOMBRE"],$ta,$jc,$js,$prof["CI"]);
							}
						$k++;
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
			    <form name="imprime" action="" >
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