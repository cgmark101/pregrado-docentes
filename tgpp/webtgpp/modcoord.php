<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>COORDINADOR</title>
    <link rel="stylesheet" media="all" type="text/css" href="css/general.css" />
    <link rel="stylesheet" media="all" type="text/css" href="css/estilos.css" />
    <script type="text/javascript" src="js/click_hover.js"></script>
    <script language="Javascript" src="js/fecha.js"></script>
</head>
<body onload="clickMenu('menu')">
    <?php
     include_once('conexion.php');
	if ($_POST)
	{$_SESSION['cedula']=$_POST['cedula'];}
     	
		/*
		$sql3="select USERID, TIPO_USUARIO from USUARIOS where USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 321 or USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 325 or USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 326 or USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 331 or USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 335 or USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 336 or USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 341 or USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 345 or USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 346 or USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 351 or USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 355 or USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 355 or USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 356 or USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 361 or USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 365 or USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 366 or USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 21 or USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 22 or
		USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 31 or USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 32 or USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 41 or USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 42 or USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 51 or USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 52 or USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 61 or USERID = '$_SESSION[cedula]' and TIPO_USUARIO = 62";
        $conex2 -> ExecSQL($sql3,__LINE__,true);
		$fila7 = $conex2->filas;
		*/

		$cSQL = "SELECT campus FROM usuarios WHERE userid = '".$_SESSION['cedula']."' ";
		$cSQL.= "AND campus is not null ";

		$conex2 -> ExecSQL($cSQL,__LINE__,true);

		//if (false)
		if ($conex2->filas == 1)
   {
		$cod1 = $conex2->result_h;
	    $cod2 = $conex2->result[0];
	    $cod = array_combine($cod1,$cod2);
		
		/*if ($cod['TIPO_USUARIO']==21 || $cod['TIPO_USUARIO']== 31 || $cod['TIPO_USUARIO']==41 || $cod['TIPO_USUARIO']==51 || $cod['TIPO_USUARIO']==61)
		   {$usuario=substr($cod['TIPO_USUARIO'],0,1);}
		else
		   {$usuario=substr($cod['TIPO_USUARIO'],1,1);}*/

		$usuario = substr($conex2->result[0][0],-1,1);
		$campus = substr($conex2->result[0][0],-2,1);

		$_SESSION['usuario'] = $usuario;
		$_SESSION['campus'] = $campus;		

		$_SESSION['coor'] = $_SESSION['cedula'];

		//print_r($_SESSION);

		//die();


     	$sql1="select APELLIDO, NOMBRE, DEPARTAMENTO from tblaca007 where CI = '$_SESSION[cedula]'";
        $conex -> ExecSQL($sql1,__LINE__,true);

	$fila = $conex->filas;
	if ($fila!=0)
	    {
	    $reg1 = $conex->result_h;
	    $reg2 = $conex->result[0];
	    $reg = array_combine($reg1,$reg2);
	    $cedula=($_SESSION['cedula']);
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
			    MÓDULO DE COORDINADOR - TRABAJO DE GRADO - PRÁCTICA PROFESIONAL
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
				<li class="sub">ESTUDIANTES
				    <ul>
					<li class="fly"><a href="#nogo">Trámites</a>
				        <ul>
					    <li><a href="buscadorV1.php" target="popu">B&uacute;squeda en BD</a></li>
					    <li><a href="fechalimite.php" target="popu">Fecha L&iacute;mite</a></li>
					</ul>
					</li>
				    </ul>
				</li>
				<li class="sub">PROFESORES
				    <ul>
				        <li><a href="listadoprof.php" target="popup" onclick="window.open('', 'popup', 'width = 900, height = 800, left=55, top=0, scrollbars=yes')">Listado de Profesores</a></li>
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
				        <li><a href="buscadorhist.php" target="popu">B&uacute;squeda por Estudiantes</a></li>
						<li><a href="buscar_tut.php" target="popu">B&uacute;squeda por Tutor</a></li>
				    </ul>
				    <ul>
					<li class="fly"><a href="#nogo">Cargar</a>
					    <ul>
						<?php
						switch ($_SESSION['campus']){
							case 'P':
								echo " <li><a href=\"ingresoest2.php\" target=\"popu\">Práctica Profesional</a></li> ";
								break;
							case 'T':
								echo " <li><a href=\"ingresoest1.php\" target=\"popu\">Trabajo de Grado</a></li> ";
								break;
							case 'G':
								echo " <li><a href=\"ingresoest2.php\" target=\"popu\">Práctica Profesional</a></li> ";
								echo " <li><a href=\"ingresoest1.php\" target=\"popu\">Trabajo de Grado</a></li> ";
								break;
						}

						?>
						<!-- <li><a href="ingresoest1.php" target="popu">Trabajo de Grado</a></li>
						<li><a href="ingresoest2.php" target="popu">Práctica Profesional</a></li> -->
					    </ul>
					</li>	
				    </ul>
				</li>
				<!--<li class="sub">AGREGAR
				    <ul>
				        <li><a href="agregarestado.php" target="popup1" onclick="window.open('', 'popup1', 'width = 750, height = 800, left=150, top=0, scrollbars=yes')">Estado</a></li>
				    </ul>
				</li>-->
			    </ul>
			    </td>
			    <td width="70%" valign=top>
				<?php
				    printf('<br><div class="tituloc" align=center>BIENVENIDO:<br></div><div class="titulom">%s %s</div>
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
   }
   else
   {
	   echo "USTED NO TIENE PERMISOS DE COORDINACIÓN ";
   }
	?>
</body>
</html>