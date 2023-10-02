<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>Listado de Profesores</title>
    <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script src="http://cherne.net/brian/resources/jquery.hoverIntent.minified.js"></script>
    <script type="text/javascript">
    $(function(){
        $(".titulo").click( function(){
        $(this).next().toggle('fast');
        });
    });
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
    <style type="text/css">
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
</head>
<body>
    <?php
	include_once('inc\config.php');
	session_start();
	    $conexion = odbc_connect($DSN, $user, $pass, true, $laBitacora) or die ("Problemas en la conexión");
	    $sql="select APELLIDO, NOMBRE, DEPARTAMENTO from tblaca007 where CI = '$_SESSION[cedula]'";
	    $registros = odbc_exec($conexion,$sql)or die ("Problemas en el select");
    ?>
	    <table border="0px" align="center" width="900">
		<tr>
		    <td colspan="5" align="center">	
			<table border="0" width="900">
			    <tr>
				<td width="100">
				    <p align="right" style="margin-top: 0; margin-bottom: 0">
					<img border="0" src="images/unex15.gif" width="75" height="75">
				    </p>
				</td>
				<td width="800">
			            <p class="titulo">UNIVERSIDAD NACIONAL EXPERIMENTAL POLIT&Eacute;CNICA</p>
				    <p class="titulo">"ANTONIO JOS&Eacute; DE SUCRE"</p>
				    <p class="titulo">VICE-RECTORADO PUERTO ORDAZ</p>
				    <p class="titulo">ASIGNATURA TRABAJO DE GRADO Y PR&Aacute;CTICA PROFESIONAL</p>
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
	        <tr><td class="enc_p" colspan="5">B&Uacute;SQUEDA DE ESTUDIANTES</td></tr>
                <tr>
                    <table width="900" height="80"  border="0" align="center" bgcolor="#99CCFF" style="border-collapse: collapse;">
                        <tr>
                            <td width="180" align="center"><span class="datosp">C&eacute;dula</span></td>
                            <td width="180" align="center"><span class="datosp">Nombres</span></td>
                            <td width="180" align="center"><span class="datosp">Asignatura</span></td>
                            <td width="180" align="center"><span class="datosp">Estatus</span></td>
                            <td rowspan="2" width="80" align="center"><input name="buscar" type="submit" class="datosp" value="Buscar"></td>
                        </tr>
                        <tr>
                            <td align="center"><input name="cedula" type="text"  maxlength="8"size="15"/></td>
                        </tr>
                    </table>
                </tr>
		<?php
                $conexion = odbc_connect($DSN2, $user, $pass, true, $laBitacora) or die ("Problemas en la conexión");
		$conexion1 = odbc_connect($DSN2, $user, $pass, true, $laBitacora) or die ("Problemas en la conexión"); 		
		$datos = odbc_exec("select * from sol_tgpp where cedula_E='cedula' ", $conexion)or die ("Problemas en el select");
		while ($dat = odbc_fetch_array($datos))
		    {

		    }
		?>
		<tr>
		    <td colspan="5">
			<table width="900"  align=center border="1" CELLPADDING=0 CELLSPACING=0 overflow:auto bgcolor="99CCFF">
			    <tr height="45">
				<th width="50" scope="col"><span class="datosp">C&eacute;dula</span></th>
				<th width="120" scope="col"><span class="datosp">Nombres</span></th>
				<th width="120" scope="col"><span class="datosp">Apellidos</span></th>
				<th width="60" scope="col"><span class="datosp">Tutor Académico</span></th>
				<th width="60" scope="col"><span class="datosp">Jurado Coordinador</span></th>
				<th width="60" scope="col"><span class="datosp">Jurado Secretario</span></th>
				<th width="20" scope="col"><span class="datosp">Buscar</span></th>
			    </tr>
			    <tr>
				    <?php
					$conexion = odbc_connect($DSN, $user, $pass, true, $laBitacora) or die ("Problemas en la conexión");
					$sql1="select CI, APELLIDO, NOMBRE from tblaca007 order by cast(CI as unsigned)";
					$datos = odbc_exec($conexion,$sql1)or die ("Problemas en el select");
					while ($dat = odbc_fetch_array($datos))
					{
					    printf('
					        <tr height="30"><td bgcolor="#FFFFFF"><div class="datosc">%s</td>
					        <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
					        <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
					        <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
					        <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
					        <td bgcolor="#FFFFFF"><div class="datosc">%s</td>
						<td bgcolor="#FFFFFF"><div class="datosc"><a href="proftut.php?id=%d" target="popup" onclick=window.open("", popup, width = 900, height = 800, left=220, top=0, scrollbars=yes)><img src="imagenes/icono_buscar.gif" alt="buscar" width="15"height="15" border="0"></a></td>
						</tr>',$dat[""],$dat["NOMBRE"],$dat["APELLIDO"],$ta,$jc,$js,$dat["CI"]);
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