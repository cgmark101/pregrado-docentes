<?php session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>Agregar Estado</title>
    <script type="text/javascript" src="confirm.js"></script>
    <link rel="stylesheet" media="all" type="text/css" href="css/estilos.css" />
    <script language="JavaScript">
    function pregunta(){
        var answer=confirm('¿Desea eliminar este Estado?')
    }
    </script> 
</head>
<body>
	<table border="0px" align="center" width="750">
	    <tr>
		<td colspan="5" align="center">	
		    <table border="0" width="600">
			<tr>
			    <td width="100">
				<p align="right" style="margin-top: 0; margin-bottom: 0">
				    <img border="0" src="images/unex15.gif" width="75" height="75">
				</p>
			    </td>
			    <td width="500">
			    <p class="titulon">UNIVERSIDAD NACIONAL EXPERIMENTAL POLIT&Eacute;CNICA</p>
				<p class="titulon">"ANTONIO JOS&Eacute; DE SUCRE"</p>
				<p class="titulon">VICE-RECTORADO PUERTO ORDAZ</p>
				<p class="titulon">ASIGNATURA TRABAJO DE GRADO Y PR&Aacute;CTICA PROFESIONAL</p>
			    </td>
				<td border="0" width="100">&nbsp;</td>
			</tr>
		    </table>
		</td>
	    </tr>
	    <tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
	    <tr><td colspan="5">&nbsp</td></tr>
	    <tr><td colspan="5">&nbsp</td></tr>
	    <tr><td colspan="5">&nbsp</td></tr>
	    <tr><td colspan="5">&nbsp</td></tr>
	    <tr><td colspan="5">&nbsp</td></tr>
	    <tr>
		    <table border="0" bordercolor="#000000" align="center" cellpadding="0" cellspacing="0" >
		        <tr>
			    <td bgcolor="#99CCFF" class="datosn" width="160" height="25">ESTADOS DE SOLICITUD</td>
			    <td bgcolor="#99CCFF" class="datosn" width="40" height="15">MODIF.</td>
			    <td bgcolor="#99CCFF" class="datosn" width="40" height="15">ELIM.</td>
			</tr>
			<tr>
			    <td>
			    <?php
				include_once('conexion.php');
				$i=0;
				$sql2="select id_estatus, estatus from sol_estatus";
				$conex1 -> ExecSQL($sql2,__LINE__,true);
				$fila = $conex1->filas;
				while ($i<$fila)
				    {
				    $sta1 = $conex1->result_h;
				    $sta2 = $conex1->result[$i];
				    $estat = array_combine($sta1,$sta2);
					    printf('
					        <tr height="30"><td bgcolor="#FFFFFF"><div class="datosc">%s</td>
					        <td bgcolor="#FFFFFF"><div class="datosc"><a href="editar.php?id=%s" target="popup1" onclick=window.open("", popup1, width = 750, height = 800, left=125, top=0, scrollbars=yes)><img src="imagenes/b_edit.png" alt="buscar" width="15"height="15" border="0"></a></td>
						<td bgcolor="#FFFFFF"><div class="datosc"><a href="borrar.php?st=%s" target="popup1"><img src="imagenes/b_drop.png" alt="buscar" width="15"height="15" border="0"></a></td>
						</tr>',$estat['estatus'],$estat['id_estatus'],$estat['id_estatus']);					
				    $i++;
				$fil=$fila;
				$_SESSION['$fi']=$fil+1;
				    }
			    ?>
			</tr>
		    </table>
	    </tr>
	    <tr><td colspan="5">&nbsp</td></tr>
	    <tr>
		<form action="insertarestado.php" method="post" target="" >
		    <table border="0" bordercolor="#ffffff" align="center" cellpadding="0" cellspacing="0" >
			<tr>
			    <td align="center" colspan="2"><input type="text" name="estatus" class="datosc" value="NUEVO ESTADO" maxlength="20" size="25" onblur="this.value=this.value.toUpperCase();"> </td>
			</tr>
			<tr>
			    <td height="40" align="center" valign="middle" colspan="1">
				<input type="submit" value="Aceptar">
			    </td>
			    <td align="center" valign="middle" colspan="1">
				<input type="button" value="Cancelar" name="bexit" onclick="window.close();">
			    </td>
			</tr>
		    </table >
		</form>	
	</table>
</body>
</html>