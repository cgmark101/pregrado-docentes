<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>PROFESORES</title>
    <link rel="stylesheet" media="all" type="text/css" href="css/general.css" />
    <link rel="stylesheet" media="all" type="text/css" href="css/estilos.css" />
    <script type="text/javascript" src="js/click_hover.js"></script>
    <script language="Javascript" src="js/fecha.js"></script>
</head>
<body onload="clickMenu('menu')">
    <?php
	include_once('conexion.php');
	$sql1="select APELLIDO, NOMBRE, DEPARTAMENTO from tblaca007 where CI = '$_REQUEST[cedula]'";
        $conex -> ExecSQL($sql1,__LINE__,true);

	$fila = $conex->filas;
	if ($fila==1)
	    {
	    $reg1 = $conex->result_h;
	    $reg2 = $conex->result[0];
	    $reg = array_combine($reg1,$reg2); 
	    $cedula=($_POST['cedula']);
	    $_SESSION["cedula"]=$cedula;
    ?>
    <table width="80%" align="center" border="0" cellspacing="0" cellpadding="0">
	<tr>
	    <td colspan="3"><img src="imagenes/dibujo2.GIF" width="100%" height="120" /></td>
	</tr>
	<tr align="center">
	    <table border="0" width="80%" align="center" style="border-collapse: collapse;">
		<tr>
		    <td width="33%" height="45">
			<span>&nbsp</span>
		    </td>
		    <td width="33%" height="45">
			<span>&nbsp</span>
		    </td>
		    <td width="33%" height="45">
		        <div class="titulo">
		            <script language="javascript">Fecha()</script>
		        </div>
		    </td>
		</tr>
		<tr>
		    <td colspan="3">
			<div class="titulog">
			    MÓDULO DE PROFESORES - TRABAJO DE GRADO - PRÁCTICA PROFESIONAL
			</div>
		    </td>
		</tr>
		<tr colspan="3">
		    <table border="0" width="80%" align="center" style="border-collapse: collapse;" >
			<tr height="280" style="background: url(imagenes/fondo_unexpox.png) no-repeat">
			    <td width="20%">
			    <ul id="menu">
				<li class="sub">INICIO
				    <ul>
					<li><a href="#"></a></li>
				    </ul>
				</li>
				<li class="sub">CONSULTAS
				    <ul>
				        <li class="fly"><a href="#">Bachilleres Asignados</a>
					    <ul>
					        <li><a href="tutt.php" target="popup" onclick="window.open('', 'popup', 'width = 950, height = 900, left=70, top=0')">Trabajo de Grado</a></li>
						<li><a href="tutp.php" target="popup" onclick="window.open('', 'popup', 'width = 950, height = 900, left=70, top=0')">Práctica Profesional</a></li>
					    </ul>
					</li>
				    </ul>
				</li>
				<li class="sub">HISTORIAL
				    <ul>
				        <li><a href="buscadorhist.php" target="popu">B&uacute;squeda</a></li>
					<!--<li><a href="fechalimite.php" target="popu">Fecha L&iacute;mite</a></li>-->
					</li>
				    </ul>
				</li>
			    </ul>
			    </td>
			    <td width="70%" valign=top>
				<?php
				    printf('<br><div class="tituloc" align=center>BIENVENIDO..<br></div><div class="titulom">%s %s</div>
					',$reg["NOMBRE"],$reg["APELLIDO"]);
				?>
			    </td>
			</tr>
		    </table>
		</tr>
	    </table>
	</tr>
    </table>
    <?php
		}
    ?>
</body>
</html>