<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Sistema de avance academico</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="StyleSheet" href="estilos.css" type="text/css"> 
<script language="javascript" src="funciones.js" type="text/javascript"></script>
<script language="javascript" src="asrequest.js" type="text/javascript"></script>
<body onLoad="actualizaReloj()">

<?php 

require_once('inc/config.php');
require_once("inc/odbcss_c.php");
require_once("guardar.php");
if($_SERVER['HTTP_REFERER']!=$raizDelSitio.'planilla_r.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'cante.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'guardar.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'introt.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'cargac.php') die ("<script languaje=\"javascript\"> alert('ACCESO PROHIBIDO!'); </script>");


$acta=$_POST['acta'];
$lapso=$_POST['lapso'];
$c_asigna=$_POST['c_asigna'];
$cantee=$_POST['cantee'];
$desicion=$_POST['desicion'];
$cont=$_POST['cont'];
$conte=$_POST['conte'];
$desicions=$_POST['desicions'];
$codigo=$_POST['codigo'];
$trama=$_POST['trama'];
$total=0;
$porc= array();
$tema= array();
for($i=1;$i<=$cont;$i++)
	{
	$porc[$i]=$_POST['porc'.$i];
	}
for($i=1;$i<=$cont;$i++)
	{
	$tema[$i]=$_POST['tema'.$i];
	}
$info=sacainfo($acta,$lapso,$c_asigna);
if (true) { ///////////////SI EL SUBMIT DE LA PAGINA CANTE.PHP FUE SETEADO

	if($desicion=='si' || $desicions=='si') ///////////////SI LA SE QUERIA AGREGAR LOS TEMAS O AGREGAR EL SIGUIENTE TEMA
		{	
			
			if($codigo==11){
			require_once("guardar.php");
			$resultado=con_ex_temas_car($acta,$lapso,$c_asigna);
			if($resultado!=NULL)
			{	
				$cont=$resultado[0][0];
				$conte=$cont;
				for($i=1;$i<=35;$i++) $tema[$i]=$resultado[0][$i];
				for($i=36,$j=1;$i<=70;$i++,$j++)	$porc[$j]=$resultado[0][$i];
			}
			}
			for($i=1;$i<=$cont;$i++)
			{
			$total=$total+$porc[$i];
			}
			$totali=100-$total;		
			if($cont<$cantee)///////////////SI SI EL CONTADOR DE TEMAS ES MENOR QUE LA CANTIDAD TOTAL DE TEMAS
					{
			$cont++;
			echo '<table>
  					<tr>
    				<td>';
					include("encabezado.php");
			echo	'</td></tr><tr><td>';
					include("datosdemateria.php");
			echo	'</td></tr>
 					<tr>
    				<td height="32" class="datosp" colspan="8">
					<p>A CONTINUACION INTRODUZCA EL TEMA NUMERO &nbsp;&nbsp;'.$cont.'</p>
					</td>
					</tr>
 					<tr><td height="32" class="datosp" colspan="8"> 
					<form name="form1" method="post">
					Evaluacion_'.$cont.'<br>
					<textarea name="tema'.$cont.'" rows="5" cols="80" class="datospf" onKeyUp="maximaLongitud(this,253)"></textarea><div id="contador"></div><br>
					Valor&nbsp;<input name="porc'.$cont.'" type="text" value="" size="5" maxlength="5" class="datospf" OnKeyUp="validarNumero(this); validarporcentajes(this); " onblur="validarloquefalta(this);">%&nbsp;&nbsp;&nbsp;&nbsp;Para completar el 100% falta por agregar '.$totali.'%<br>
					<input type="hidden" name="cont" id="cont" value="'.$cont.'">
					<input type="hidden" name="restante" id="restante" value="'.$totali.'">
					<input type="hidden" name="conte" value="'.$conte.'">
					<input type="hidden" name="acta" value="'.$acta.'">
	  				<input type="hidden" name="lapso" value="'.$lapso.'">
	 				<input type="hidden" name="c_asigna" value="'.$c_asigna.'">
					<input type="hidden" name="desicions" value="">
					<input type="hidden" name="trama" value="">
					<input type="hidden" name="cantee" id="cantee" value="'.$cantee.'">';
					for($i=1;$i<$cont;$i++)
						{
						echo '<input type="hidden" name="porc'.$i.'" value="'.$porc[$i].'">';
						}
					for($i=1;$i<$cont;$i++)
						{
						echo '<input type="hidden" name="tema'.$i.'" value="'.$tema[$i].'">';
						}
					
					?><p>Elija una opcion para continuar:<br></p>
						<!---->
	<input type="button" Value="Continuar" name="Continuar" onClick="validacontinuarintrot(document.form1.tema<?PHP echo $cont; ?>.value,document.form1.porc<?PHP echo $cont; ?>.value);" class="boton">&nbsp;&nbsp;&nbsp;
	<input type="button" Value="Regresar" name="salirdesdecante" onClick="validaregresointrot(document.form1.tema<?PHP echo $cont; ?>.value,document.form1.porc<?PHP echo $cont; ?>.value);" class="boton">
						</form></td></tr></table> <?PHP
			}
			else{///////////////SI YA SE AGREGARON TODOS LOS TEMAS
					echo '
				<table ><tr><td>';
				include("encabezado.php");
				echo '</td></tr><tr><td>';
				include("datosdemateria.php");
		echo	'</td></tr>
  				<tr>
    			<td height="32" class="datosp" colspan="8"><br><br><br>
				<form name="form" method="post">
				YA INTRODUJO TODAS LAS EVALUACIONES<br><br></td></tr>';
				
				
		echo  '<tr><td class="datosp" colspan="8"><table border="1" cellspacing="1" class="datotabla" align="center">
					<tr><th rowspan="3" colspan="4">COMENTARIOS DE TEMAS</th></tr>
					<tr>';
					
					for($i=1;$i<=$cantee;$i++) echo'<td align="center" ><strong>EVALUACION&nbsp;'.$i.'</strong></td>';
					
	echo			'</tr>
					<tr>';
					
					for($i=1;$i<=$cantee;$i++) echo'<td align="center" width="200">'.$tema[$i].'</td>';
					
					//echo'<td align="center" width="200" ><strong>TOTAL 100</strong></td><td align="center" width="200" ><strong>TOTAL 9</strong></td>';
					
	echo			'</tr>
					<tr>					
					<td align="center"  colspan="4"><strong>PORCENTAJES</strong></td>';
					
					for($i=1;$i<=$cantee;$i++) echo'<td align="center" >'.$porc[$i].'</td>';
					//echo'<td align="center" width="200" ><strong>100%</strong></td><td align="center" width="200" ><strong>9</strong></td>';
					
		echo    '</tr></table></td></tr>';				
		echo    '<tr><td class="datosp" colspan="8"><br><p>Elija una opcion para continuar:</p>
				<!--Agregar calificaciones de estudiantes&nbsp;<input name="desicions" type="radio" value="si" class="datospf" checked><br>
	  			Guardar y salir&nbsp;<input type="radio" name="desicions" value="no" class="datospf"><br>
	  			Salir&nbsp;<input type="radio" name="desicions" value="sa" class="datospf">	--><br>';
				for($i=1;$i<=$cont;$i++)
						{
						echo '<input type="hidden" name="porc'.$i.'" value="'.$porc[$i].'">';
						}
				for($i=1;$i<=$cont;$i++)
						{
						echo '<input type="hidden" name="tema'.$i.'" value="'.$tema[$i].'">';
						}
				echo '<input type="hidden" name="codigo" value="020">
					 <input type="hidden" name="cont" value="0">
					 <input type="hidden" name="desicions" value="">
					 <input type="hidden" name="conte" value="'.$conte.'">
					 <input type="hidden" name="acta" value="'.$acta.'">
	  				 <input type="hidden" name="lapso" value="'.$lapso.'">
	 				 <input type="hidden" name="c_asigna" value="'.$c_asigna.'">
					 <input type="hidden" name="cantee" value="'.$cantee.'">';
					 ?>	<!--<input type="submit" Value="Add Califi" name="submit" onClick="document.form.action='cargac.php'; document.form.desicions.value='si'; document.form.submit();" class="boton">&nbsp;&nbsp;&nbsp;-->
	<input type="button" Value="Regresar" name="salirdesdecante" onClick="document.formsalir.action='cante.php'; document.formsalir.submit();" class="boton">
						</form></td></tr></table> <?PHP
			//////////////AQUI VA CUANDO YA INTRODUJO TODAS LAS EVALUACIONES
			}
			
		}
	if($desicion=='no' || $desicions=='no')
		{
		if($desicions=='no')///////////////SI NO SE QUERIA AGREGAR EL SIGUIENTE TEMA
			{
			//cuando dijo que no a querer seguir con el siguiente tema
			//require_once("guardar.php");
			if($_POST['codigo']==1111)
			{
			$razela=$_POST['razeli'];
			$canae=$cantee-1;
			$respuesta1=guardar_modct($acta,$lapso,$c_asigna,$razela,$canae,$cantee,NULL,$tema[$cantee],NULL,$porc[$cantee],$cantee);
			}
			$respuesta=guardar_temas_introducidos($cantee,$acta,$lapso,$c_asigna,$tema,$porc,$cont,$cont);
			
			?>
			<form name="form1" method="post" action="" >
	 				<input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					 <input type="hidden" name="cont" value="<?PHP echo $cont; ?>">
					<input type="hidden" name="conte" value="<?PHP echo $conte; ?>">
					<input type="hidden" name="desicions" value="">
					<input type="hidden" name="cantee" value="<?PHP echo $cantee; ?>" >					
			<?PHP	
					for($i=1;$i<=$cont;$i++)
						{
						echo '<input type="hidden" name="porc'.$i.'" value="'.$porc[$i].'">';
						}
					for($i=1;$i<=$cont;$i++)
						{
						echo '<input type="hidden" name="tema'.$i.'" value="'.$tema[$i].'">';
						}
					 ?>					 
					 </form>
					<form name="form2" method="post" action="" >
	 				<input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					 </form>
			<?PHP		  
					  
					  
			if($trama!='regresar')  echo "<script> document.form1.desicions.value='si'; 
			document.form1.action='introt.php'; document.form1.submit(); </script>";
			
			if($trama=='regresar')  echo "<script> document.form2.action='cante.php'; 
			document.form2.submit(); </script>";
			
			

			}
		else
			{
			///////cuando dijo que no a querer agregar los temas
			require_once("guardar.php");
			$respuesta=guardar_cantidad_evaluaciones($cantee,$acta,$lapso,$c_asigna);
			?>
				<form name="form1" method="post" action="" >
	 				<input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					 <input type="hidden" name="cont" value="0">
					 <input type="hidden" name="codigo" value="11" >
					 <input type="hidden" name="cantee" value="<?PHP echo $cantee; ?>" >
					  <input name="desicion" type="hidden" value="">
					 </form>
					 
					<form name="form2" method="post" action="" >
	 				<input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					 </form>
			<?PHP		  
					  
					  
			if($trama!='regresar')  echo "<script> document.form1.desicion.value='si'; 
			document.form1.action='introt.php';  document.form1.submit(); </script>";
			
			if($trama=='regresar')  echo "<script> document.form2.action='cante.php'; 
			document.form2.submit(); </script>";		 

			}
		}
	if($desicion=='sa' || $desicions=='sa')///	<meta http-equiv="Refresh" content="2;url=cante.php">
		{?>
		<body onLoad="document.form2.action='cante.php'; document.form2.submit();">
				<form name="form2" method="post" action="" >
	 				<input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					 </form>
		<?PHP	

		}
} 

?>
</head>
<form name="formsalir" method="post">
				<input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  			<input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	  			<input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
				</form>
</html>
