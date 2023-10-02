<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>ESTUDIANTE</title>
    <link rel="stylesheet" media="all" type="text/css" href="css/general.css" />
    <link rel="stylesheet" media="all" type="text/css" href="css/estilos.css" />
    <script type="text/javascript" src="js/click_hover.js"></script>
    <script language="Javascript" src="js/fecha.js"></script>
</head>
<body onload="clickMenu('menu')">
    <?php
	if($_POST)
	{$cedula=($_POST['cedula']);
	$_SESSION["cedula"]=$cedula;
	}
	include_once('conexion.php');
	$sql1="select CI_E, NOMBRES, APELLIDOS from dace002 where CI_E = '$_SESSION[cedula]'";
        $conex -> ExecSQL($sql1,__LINE__,true);
	$fila = $conex->filas;
	if ($fila==1)
	    {
	    $reg1 = $conex->result_h;
	    $reg2 = $conex->result[0];
	    $reg = array_combine($reg1,$reg2);
		if($_POST)
			{$cedula=($_POST['cedula']);
			$_SESSION["cedula"]=$cedula;}
		else
			$_SESSION["cedula"]=$reg['CI_E'];
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
			    MÓDULO DE ESTUDIANTES - TRABAJO DE GRADO - PRÁCTICA PROFESIONAL
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
					<li><a href="modest.php" target="popup"></a></li>
				    </ul>
				</li>
				<li class="sub">MARCO LEGAL
				    <ul>
					<li class="fly"><a href="#nogo">Leyes y Reglamentos</a>
					    <ul>
					        <li><a href="pdf/Reglamento.pdf" target="popup" onclick="window.open('', 'popup', 'width = 790, height = 800, left=255, top=0')">Reglamento Vigente</a></li>
					    </ul>
					</li>	
				    </ul>
				</li>
				<li class="sub">REQUISITOS
				    <ul>
				        <li class="fly"><a href="#nogo">Asignatura</a>
					    <ul>
					        <li><a href="requisitos_tg.php" target="popup" onclick="window.open('', 'popup', 'width = 790, height = 800, left=125, top=0')">Trabajo de Grado</a></li>
					        <li><a href="requisitos_pp.php" target="popup" onclick="window.open('', 'popup', 'width = 790, height = 800, left=125, top=0')">Pr&aacute;ctica Profesional</a></li>
					    </ul>
					</li>	
				    </ul>
				</li>
				<li class="sub">SOLICITUDES
				    <ul>
				        <li></a></li>
				        <li class="fly"><a>Registro de Anteproyecto</a>
					    <ul>
						<?php
						$flagtg=0;
						$flagpp=0;
						$sql2="select TIPO_PASANTIA from sol_tgpp where CI_E = '$_reg[CI_E]'and TIPO_PASANTIA = 2";
						$conex1 -> ExecSQL($sql2,__LINE__,true);
						$fila = $conex1->filas;
						if ($fila==1)
						{
						    $aux1 = $conex1->result[0];
						    if($aux1[0]==2)
						    	{$flagtg=1;}
						    else
							{$flagtg=0;}
						}
						$sql2="select TIPO_PASANTIA from sol_tgpp where CI_E = '$_reg[CI_E]'and TIPO_PASANTIA = 1";
						$conex1 -> ExecSQL($sql2,__LINE__,true);
						$fila = $conex1->filas;
						if ($fila==1)
						{
						    $aux2 = $conex1->result[0];
						    if($aux2[0]==1)
						    	{$flagpp=1;}
						    else
							{$flagpp=0;}
						}
						if($flagtg==0)
						{
						?>
						    <li><a href="planillat.php" target="popup" onclick="window.open('', 'popup', 'width = 790, height = 800, left=125, top=0')">Trabajo de Grado</a></li>
						<?php
						}
						if($flagpp==0)
						{
						?>
						    <li><a href="planillap.php" target="popup" onclick="window.open('', 'popup', 'width = 790, height = 800, left=125, top=0')">Práctica Profesional</a></li>
						<?php
						}
						?>
					    </ul>
					</li>
				    </ul>
				</li>
				<li class="sub">ESTADO DE TRÁMITES
				    <ul>
				        <li class="fly"><a>Consultas</a>
					    <ul>
						<?php
						$sql2="select CI_E from sol_tgpp where CI_E = '$_SESSION[cedula]' and TIPO_PASANTIA = 2";
						$conex1-> ExecSQL($sql2,__LINE__,true);
						$aux = $conex1->result;
						if($aux1 = $aux)
						{
						?>
						    <li><a href="datosesttg1.php" target="popup" onclick="window.open('', 'popup', 'width = 790, height = 800, left=125, top=0')">Trabajo de Grado</a></li>
						<?php
						}
						$sql2="select CI_E from sol_tgpp where CI_E = '$_SESSION[cedula]' and TIPO_PASANTIA = 1";
						$conex1-> ExecSQL($sql2,__LINE__,true);
						$aux2 = $conex1->result;
						if($aux3 =$aux2)
						{
						?>
						    <li><a href="datosestpp1.php" target="popup" onclick="window.open('', 'popup', 'width = 790, height = 800, left=125, top=0')">Práctica Profesional</a></li>
						<?php
						}
						?>
					    </ul>
					</li>
				    </ul>
				</li>
			    </ul>
			    </td>
			    <td width="70%" valign=top>
				<?php
				    printf('<br><div class="tituloc" align=center>BIENVENIDO..<br></div><div class="titulom">%s %s</div>
					',$reg['NOMBRES'],$reg['APELLIDOS']);
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