<?php
#incluimoa el archivo config que contiene las variables globales.
require_once('inc/config.php');
require_once("inc/odbcss_c.php");
require_once("guardar.php");
$acta=$_POST['acta'];
$lapso=$lapsoProceso;
//$laBitacora	='avance_academico.log';
//print_r($_POST);
#consulta para obtener el c_asigna


$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);

if( ($_SERVER['HTTP_REFERER']==$raizDelSitio.'planilla_r.php') && (isset($_POST['cedula'])) ){
	$aSQL  = "SELECT c_asigna FROM tblaca004 WHERE acta='".$acta."' AND lapso='".$lapso."' and ci='".$_POST['cedula']."' ";
	$conex->ExecSQL($aSQL,__LINE__,true);
	$result = $conex->result;
	if ($conex->filas == 0){
		die ("<script languaje=\"javascript\"> history.back(alert('El n�mero de acta no corresponde con la c�dula. Por favor verifique e intente nuevamente.')); </script>");
	}
}




$mSQL  = "SELECT c_asigna FROM tblaca004 WHERE acta='".$acta."' AND lapso='".$lapso."' ";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
#resultado de la busqueda
//echo $result[0][0];
#asignamos a la variable el resultado
$c_asigna=$result[0][0];


$resultado=con_ex_temas_car($acta,$lapso,$c_asigna);

//echo $_SERVER['HTTP_REFERER']."<br>";
//echo $raizDelSitio.'cerrar.php';


if($_SERVER['HTTP_REFERER']!=$raizDelSitio.'planilla_r.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'cante.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'guardar.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'introt.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'cargac.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'cerrar.php') die ("<script languaje=\"javascript\"> alert('ACCESO PROHIBIDO!'); </script>");

if($resultado[0][71]==$resultado[0][0] && $resultado!=NULL && $resultado[0][0]>0){
				$total100=0;
				for($i=36,$j=1;$i<=70;$i++,$j++)	$total100=$total100+$resultado[0][$i];
if($total100<100 || $total100>100){
echo '<script>
alert("Actualmente acumula '.$total100.'% de 100% en su plan de evaluacion, recuerde ajustar para que concuerde con el 100% que se evalua en un semestre.");
</script>';}
}

//if($resultado!=NULL && $resultado[0][0]==$resultado[0][71])
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Sistema de avance academico</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="StyleSheet" href="estilos.css" type="text/css"> 
<script language="javascript" src="asrequest.js" type="text/javascript"></script>
<script language="javascript" src="funciones.js" type="text/javascript"></script>
<body onLoad="actualizaReloj()">

		
<?php


#De aqu� en adelante entra en funcionamiento tu c�digo

$info=sacainfo($acta,$lapso,$c_asigna);
$primera=primeravez($acta,$lapso,$c_asigna);
if($primera==false){
?>
<form name="formsalir" method="post">
				<input type="hidden" name="acta" value="<?PHP echo $acta; ?>" >
	  			<input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>" >
	  			<input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>" >
				</form>

<?php
if (isset($_POST['Submit'])){

$select=$_POST['select'];
switch ($select) {
case 11://cargar los datos al sistema////////////////////////////////////////////////////////////////////////////////////////////
//require_once("guardar.php");
$bandera=con_ex_eva_car($acta,$lapso,$c_asigna);
if($bandera==0){
?>
<table >
  <tr>
    <td><?PHP include("encabezado.php"); ?></td>
  </tr>
<tr><td><?PHP include("datosdemateria.php"); ?></td></tr>
    <tr>
    <td height="20" class="datosp" colspan="8"><p><strong>CARGAR PLAN DE EVALUACION</strong></p></td></tr>
  <tr>
    <td height="32" class="datosp" colspan="8">
	<form name="form1" method="post">
	<p>Introduzca la cantidad de evaluaciones que estima realizar durante semestre:</p><br>
	<input name="cantee" id="cantee" type="text" value="" size="2" maxlength="2" class="datospf" OnKeyUp="validarNumero(this); " onblur="validarcantidad(this);"><br><br><br>
	  <p>Elija una opcion para continuar:<br></p>
	  <!--Agregar temas a evaluar&nbsp;<input name="desicion" type="radio" value="si" class="datospf" checked><br>
	  Guardar y salir&nbsp;<input type="radio" name="desicion" value="no" class="datospf"><br>
	  Salir&nbsp;<input type="radio" name="desicion" value="sa" class="datospf">--><br>
	  <input type="hidden" name="codigo" value="11" >
	  <input type="hidden" name="codigog" value="continuar">
	  <input type="hidden" name="trama" value="">
	  <input name="desicion" type="hidden" value="">
	  <input type="hidden" name="cont" value="0">
	  <input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	  <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
	  <input type="button" Value="Continuar" name="Continuar" onClick="validarcontinuarcante(); " class="boton">
	<!--document.formsalir.action='cante.php'; document.formsalir.submit();-->&nbsp;&nbsp;&nbsp;
	<input type="button" Value="Regresar" name="salirdesdecante" onClick="validaregresocante();" class="boton">
	</form></td>
  </tr>
</table>
<?php
}
if($bandera==1)
{
$resultado=canteva($acta,$lapso,$c_asigna);
	?>
<table >
  <tr>
    <td><?PHP include("encabezado.php"); ?></td>
  </tr><tr><td><?PHP include("datosdemateria.php"); ?></td></tr>
    <tr>
    <td height="20" class="datosp" colspan="8"><p><strong>CARGAR PLAN DE EVALUACION</strong></p></td></tr>
  <tr>
    <td height="32" class="datosp" colspan="8">
	<form name="form1" method="post" action="introt.php">
	<p>Usted ya introdujo anteriormente la cantidad de evaluaciones</p><br>
	<p>La cantidad de evaluaciones que se encuentran en el sistema es:&nbsp;<?PHP echo $resultado[0][0]; ?></p><br>
	  <p>Elija una opcion para continuar:<br></p>
	  <!--Agregar temas a evaluar&nbsp;<input name="desicion" type="radio" value="si" class="datospf" checked><br>
	  Salir&nbsp;<input type="radio" name="desicion" value="sa" class="datospf">--><br>
	  <input type="hidden" name="cantee" value="<?PHP echo $resultado[0][0]; ?>" >
	  <input type="hidden" name="codigo" value="11" >
	  <input name="desicion" type="hidden" value="">
	  <input type="hidden" name="cont" value="0">
	  <input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	  <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
	<input type="submit" Value="Continuar" name="submit" onClick="document.form1.action='introt.php'; document.form1.desicion.value='si'; document.form1.submit();" class="boton">&nbsp;&nbsp;&nbsp;
	<input type="button" Value="Regresar" name="salirdesdecante" onClick="document.formsalir.action='cante.php'; document.formsalir.submit();" class="boton">
	</form></td>
  </tr>
</table>
<?php
}	
if($bandera==2)
{
$porc= array();
$tema= array();
			//require_once("guardar.php");
			$resultado=con_ex_temas_car($acta,$lapso,$c_asigna);
				//$cantee=$resultado[0][41];
				$cont=$resultado[0][0];
				for($i=1;$i<=35;$i++) $tema[$i]=$resultado[0][$i];
				for($i=36,$j=1;$i<=70;$i++,$j++)	$porc[$j]=$resultado[0][$i];
				$ban=ucca($acta,$lapso,$c_asigna);
				$ban1=canteva($acta,$lapso,$c_asigna);

	?>			
				<table >
  				<tr>
    			<td><?PHP include("encabezado.php"); ?></td>
  				</tr>
				<tr>				<td><?PHP include("datosdemateria.php"); ?></td></tr>
  				  <tr>
    <td height="20" class="datosp" colspan="8"><p><strong>CARGAR PLAN DE EVALUACION</strong></p></td></tr>
  <tr>
    			<td height="32" class="datosp" colspan="8"><br><br><br>
				<form name="form" method="post">
				YA INTRODUJO TODOS LOS TEMAS A EVALUAR<br><br>
				<?PHP if($ban[0][0]!=NULL && $ban[0][0]!=$ban1[0][0] &&  $ban[0][0]<$ban1[0][0])/// si ya se ha introducido alguna calificacion
				
				{
				echo '<p>Y YA INTRODUJO LAS CALIFICACIONES DE &nbsp;'.$ban[0][0].' &nbsp;TEMA(S)<br><br>Para seguir cargando calificaciones presione el bot&oacute;n CONTINUAR</p><br><br><br><br><input type="hidden" name="codigo" value="022">'; ?>
				<p>Elija una opcion para continuar:<br></p>
				<input type="hidden" name="desicions" value="si">
				<!--Comentario en HTML Agregar calificaciones de estudiantes&nbsp;<input name="desicions" type="radio" value="si" class="datospf" checked><br>
	  			Salir&nbsp;<input type="radio" name="desicions" value="sa" class="datospf">-->	<br><br>
				<?PHP for($i=1;$i<=$cont;$i++)
						{
						echo '<input type="hidden" name="porc'.$i.'" value="'.$porc[$i].'">';
						}
				for($i=1;$i<=$cont;$i++)
						{
						echo '<input type="hidden" name="tema'.$i.'" value="'.$tema[$i].'">';
						}?>
					 <input type="hidden" name="cont" value="0">
					 <input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					 <input type="hidden" name="cantee" value="<?PHP echo $cont; ?>">
					 <input type="submit" Value="Continuar" name="desdecante" onClick="document.form.action='cargac.php'; document.form.submit();" class="boton">&nbsp;&nbsp;&nbsp;<input type="button" Value="Regresar" name="salirdesdecante" onClick="document.formsalir.action='cante.php'; document.formsalir.submit();" class="boton">
					 </form></td></tr></table>
					 
<?php 
}
				

				if($ban[0][0]==NULL && $ban[0][0]!=$ban1[0][0]){//// si no se ha introducido ninguna calificacion
				
				$porc= array();
				$tema= array();
				$nota= array();
				require_once("guardar.php");
				$resultado=con_ex_temas_car($acta,$lapso,$c_asigna);
				//$cantee=$resultado[0][41];
				$cont=$resultado[0][0];
				for($i=1;$i<=35;$i++) $tema[$i]=$resultado[0][$i];
				for($i=36,$j=1;$i<=70;$i++,$j++)	$porc[$j]=$resultado[0][$i];
				?>
				<form name="form" method="post">
				ESTAS SON LAS PRIMERAS CALIFICACIONES QUE VA A CARGAR, ASEGURESE DE QUE INTRODUCE LOS DATOS CORRECTOS Y TENGA MUCHO CUIDADO AL HACERLO<br><br><br><br>
				<p>Elija una opcion para continuar:<br></p>
				<input type="hidden" name="desicions" value="si">				
				<!--Comentario en HTML Agregar calificaciones de estudiantes&nbsp;<input name="desicions" type="radio" value="si" class="datospf" checked><br>
	  			Salir&nbsp;<input type="radio" name="desicions" value="sa" class="datospf">-->	<br><br>
				<?PHP for($i=1;$i<=$cont;$i++)
						{
						echo '<input type="hidden" name="porc'.$i.'" value="'.$porc[$i].'">';
						}
				for($i=1;$i<=$cont;$i++)
						{
						echo '<input type="hidden" name="tema'.$i.'" value="'.$tema[$i].'">';
						}?>
				<input type="hidden" name="codigo" value="020">
					 <input type="hidden" name="cont" value="0">
					 <input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					 <input type="hidden" name="cantee" value="<?PHP echo $cont; ?>">
					 <input type="submit" Value="Continuar" name="desdecante" onClick="document.form.action='cargac.php'; document.form.submit();" class="boton">&nbsp;&nbsp;&nbsp;<input type="button" Value="Regresar" name="salirdesdecante" onClick="document.formsalir.action='cante.php'; document.formsalir.submit();" class="boton">
					 </form></td></tr></table>
						
				<?php
				
				}if($ban[0][0]==$ban1[0][0] || $ban[0][0]>$ban1[0][0]){/// si se introdujeron todas las calificaciones
				?>	
				<p>Tambien introdujo anteriormente todas las calificaciones</p><br>
				<p>Ingrese a la seccion de modificar para realizar una modificacion a cualquier calificacion</p><br>
				<input type="button" Value="Regresar" name="salirdesdecante" onClick="document.formsalir.action='cante.php'; document.formsalir.submit();" class="boton">
				</td></tr></table>
				<?php
				}
}
break;
case 22:	//visualizar los datos que tiene el sistema//////////////////////////////////////////////////////////////
$datos=sacanotas($acta,$lapso,$c_asigna);
///////////////////////en observacion este codigo
$porc= array();
$tema= array();
			$resultado=con_ex_temas_car($acta,$lapso,$c_asigna);
			if($resultado!=NULL)
			{	
				//$cantee=$resultado[0][41];
				$cantee=$resultado[0][0];
				for($i=1;$i<=35;$i++) $tema[$i]=$resultado[0][$i];
				for($i=36,$j=1;$i<=70;$i++,$j++)	$porc[$j]=$resultado[0][$i];
			}
			
$asistentes=sacaasistentes($acta,$lapso,$c_asigna);
$inasistentes=sacainasistentes($acta,$lapso,$c_asigna);
$aprobados=sacaaprobados($acta,$lapso,$c_asigna);
$reprobados=sacareprobados($acta,$lapso,$c_asigna);
$fechas=sacafecha($acta,$lapso,$c_asigna);	
$activasta=comprov($acta,$lapso,$c_asigna);
///////////////////////////////////hasta aqui
//////////sacando todos los datos del ancabezado
?>
<script language="javascript" src="funciones.js" type="text/javascript"></script>
<table>
  <tr>
    <td><?PHP include("encabezado.php"); ?></td>
  </tr>
<tr><td><?PHP include("datosdemateria.php"); ?></td></tr>
  <tr>
    <td height="40" class="datosp" colspan="8">
	<p>Los datos que se encuentran en el sistema son los siguientes:</p>
	
	
	<?php
	echo  '<table border="1" cellspacing="1" class="datotabla" width="100%">
					<tr><th rowspan="3" colspan="4">COMENTARIOS DE TEMAS</th></tr>
					<tr>';
					
					for($i=1;$i<=$cantee;$i++) echo'<td align="center" ><strong>EVALUACION&nbsp;'.$i.'</strong></td>';
					
	echo			'</tr>
					<tr>';
					
					for($i=1;$i<=$cantee;$i++) echo'<td align="center" width="200">'.$tema[$i].'</td>';
					
					echo'<td align="center" width="80" ><strong>TOTAL 100</strong></td><td align="center" width="80" ><strong>TOTAL 9</strong></td>';
					
	echo			'</tr>
					<tr>					
					<td align="center"  colspan="4"><strong>PORCENTAJES</strong></td>';
					
					for($i=1;$i<=$cantee;$i++) echo'<td align="center" >'.$porc[$i].'</td>';
					echo'<td align="center" width="80" ><strong>100%</strong></td><td align="center" width="80" ><strong>9</strong></td>';
					
	echo            '</tr>
					<tr><td align="center"><strong>NUM</strong></td><td align="center"><strong>STATUS</strong></td><td align="center" width="400"><strong>ALUMNOS</strong></td><td align="center" ><strong>C.I</strong></td></tr>';
					
				//recuerda obtener la longitud del vector style="background:#FF0000; color:black; font-family:arial; font-weight:bold;"
			
			
			if($datos[0][0]!=NULL){	
				$cantalu=0;
				$num=1;
			while($datos[$cantalu][0]!=NULL)
				{
			$color='';
			echo '<tr><td align="center">'.$num.'</td>';
			if($datos[$cantalu][39]!=7){
			if($datos[$cantalu][39]=='R') echo	'<td><strong>Ret. Reglam</strong></td>';
			if($datos[$cantalu][39]=='A') echo	'<td><strong>Agregado</strong></td>';
			if($datos[$cantalu][39]==2) echo	'<td><strong>Retirado</strong></td>';
			}
			else echo	'<td><strong></strong></td>';
				for($i=0;$i<=$cantee+1;$i++) echo '<td align="center">'.$datos[$cantalu][$i].'</td>';
				if($activasta==1 && $datos[$cantalu][37]<50) $color='style="background:#FF0000; color:black; font-family:arial; font-weight:bold;"';
				echo '<td align="center" '.$color.' >'.$datos[$cantalu][37].'</td>';
				$color='';
				if($activasta==1 && $datos[$cantalu][38]<5) $color='style="background:#FF0000; color:black; font-family:arial; font-weight:bold;"';
				echo '<td align="center" '.$color.' >'.$datos[$cantalu][38].'</td>';
			echo '</tr>';
				$cantalu++;
				$num++;
				}
			echo '<tr><td colspan="4"><strong>%ASISTENTES</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$asistentes[0][$i].'</td>';
				echo '</tr>';
			echo '<tr><td colspan="4"><strong>%INASISTENTES</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$inasistentes[0][$i].'</td>';
				echo '</tr>';
			echo '<tr><td colspan="4"><strong>%APROBADOS</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$aprobados[0][$i].'</td>';
				echo '</tr>';
			echo '<tr><td colspan="4"><strong>%REPROBADOS</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$reprobados[0][$i].'</td>';
				echo '</tr>';
			echo '<tr><td colspan="4" ><strong>FECHAS DE CARGA</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.implode("/",array_reverse(explode("-",$fechas[0][$i]))).'</td>';
				echo '</tr>';
				echo '</table>';}	
						
			else{
			//require_once("inc/odbcss_c.php");
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select b.apellidos||',  '||nombres,a.EXP_E from dace006 a,dace002 b where a.acta='$acta' and a.lapso='$lapso' and a.EXP_E=b.EXP_E and (status='7' or status='A' or status='2') order by apellidos asc";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;				
				$cantalu=0;
			while($result[$cantalu][0]!=NULL)
				{
			echo '<tr>';
				for($i=0;$i<=$cantee+1;$i++) echo '<td align="center">'.$result[$cantalu][$i].'</td>';
				echo '<td align="center" >'.$result[$cantalu][22].'</td><td align="center">'.$result[$cantalu][23].'</td>';
			echo '</tr>';
				$cantalu++;
				}

			echo '<tr><td colspan="4"><strong>%ASISTENTES</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$asistentes[0][$i].'</td>';
				echo '</tr>';
			echo '<tr><td colspan="4"><strong>%INASISTENTES</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$inasistentes[0][$i].'</td>';
				echo '</tr>';
			echo '<tr><td colspan="4"><strong>%APROBADOS</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$aprobados[0][$i].'</td>';
				echo '</tr>';
			echo '<tr><td colspan="4"><strong>%REPROBADOS</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$reprobados[0][$i].'</td>';
				echo '</tr>';
			echo '<tr><td colspan="4"><strong>FECHAS DE CARGA</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$fechas[0][$i].'</td>';
				echo '</tr>';
				echo '</table>';
			}

?>	
</td>
</tr>
</table>
					<form name="form" method="post" action="cante.php" class="datosp">
					 <input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					 <input type="button" name="imprimir" value="Imprimir" class="boton" style="background:#FFFF33; color:black; font-family:arial; font-weight:bold;" onclick="window.print();">&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Regresar" class="boton">
					 </form>
<?php
break;
case 1212:	//Modificacion de calificacion general///////////////////////////////////////////////////////
$datos=sacanotasgral($acta,$lapso,$c_asigna);
///////////////////////en observacion este codigo
$porc= array();
$tema= array();
			$resultado=con_ex_temas_car($acta,$lapso,$c_asigna);
			if($resultado!=NULL)
			{	
				//$cantee=$resultado[0][41];
				$resulta=ucca($acta,$lapso,$c_asigna);
				$cantee=$resulta[0][0];
				for($i=1;$i<=35;$i++) $tema[$i]=$resultado[0][$i];
				for($i=36,$j=1;$i<=70;$i++,$j++)	$porc[$j]=$resultado[0][$i];
			}
			
$asistentes=sacaasistentes($acta,$lapso,$c_asigna);
$inasistentes=sacainasistentes($acta,$lapso,$c_asigna);
$aprobados=sacaaprobados($acta,$lapso,$c_asigna);
$reprobados=sacareprobados($acta,$lapso,$c_asigna);
$fechas=sacafecha($acta,$lapso,$c_asigna);	
$activasta=comprov($acta,$lapso,$c_asigna);
///////////////////////////////////hasta aqui
//////////sacando todos los datos del ancabezado
?>
<script language="javascript" src="funciones.js" type="text/javascript"></script>
<!-- <script language="javascript" type="text/javascript">alert('Disculpe, este modulo se encuentra en periodo de prueba. Si desea utilizarlo dirijase a la Oficina Regional de Tecnologia y Servicios de Informacion (ORTSI), ubicada en el Piso 1 del Edificio Administrativo en horario de oficina.');history.back();</script> -->
<table>
  <tr>
    <td><?PHP include("encabezado.php"); ?></td>
  </tr>
<tr><td><?PHP include("datosdemateria.php"); ?></td></tr>
  <tr>
    <td height="40" class="datosp" colspan="8">
	<p>Los datos que se encuentran en el sistema son los siguientes:</p>
	
	
	<?php
	echo  '<form name="formu1212" action="cargac.php" method="POST"><table border="1" cellspacing="1" class="datotabla" width="100%">
					<tr><th rowspan="3" colspan="4">COMENTARIOS DE TEMAS</th></tr>
					<tr>';
					
					for($i=1;$i<=$cantee;$i++) echo'<td align="center" ><strong>EVALUACION&nbsp;'.$i.'</strong></td>';
					
	echo			'</tr>
					<tr>';
					
					for($i=1;$i<=$cantee;$i++) echo'<td align="center" width="200">'.$tema[$i].'</td>';
					
					echo'<td align="center" width="80" ><strong>TOTAL 100</strong></td><td align="center" width="80" ><strong>TOTAL 9</strong></td>';
					
	echo			'</tr>
					<tr>					
					<td align="center"  colspan="4"><strong>PORCENTAJES</strong></td>';
					
					for($i=1;$i<=$cantee;$i++) echo'<td align="center" >'.$porc[$i].'<input type="hidden" name="porc'.$i.'" value="'.$porc[$i].'"></td>';
					//$x = $i-1;
					
					//$y = $i;
					echo'<td align="center" width="80" ><strong>100%</strong></td><td align="center" width="80" ><strong>9</strong></td>';
					
	echo            '</tr>
					<tr><td align="center"><strong>NUM</strong></td><td align="center"><strong>STATUS</strong></td><td align="center" width="400"><strong>ALUMNOS</strong></td><td align="center" ><strong>C.I</strong></td></tr>';
					
				//recuerda obtener la longitud del vector style="background:#FF0000; color:black; font-family:arial; font-weight:bold;"
			
			
			if($datos[0][0]!=NULL){	
				$cantalu=0;
				$num=1;
			while($datos[$cantalu][0]!=NULL)
				{
			$color='';
			echo '<tr><td align="center">'.$num.'</td>';
			if($datos[$cantalu][39]!=7){
			if($datos[$cantalu][39]=='R') echo	'<td><strong>Ret. Reglam</strong></td>';
			if($datos[$cantalu][39]=='A') echo	'<td><strong>Agregado</strong></td>';
			if($datos[$cantalu][39]==2) echo	'<td><strong>Retirado</strong></td>';
			}
			else echo	'<td><strong></strong></td>';
				for($i=0;$i<=$cantee+1;$i++){	
					if ((($i >= 2) and ($i <= $cantee+1)) and (($datos[$cantalu][39] != '2') and ($datos[$cantalu][39] != 'R'))){
						echo '<td align="center"><input type="text" style="border:1px solid #3366CC;" name="nota'.($i-1).'-'.$cantalu.'" id="nota'.($i-1).'_'.$cantalu.'" value="'.$datos[$cantalu][$i].'" size="5" maxlength="5" OnKeyUp="validarNumero(this);" onBlur="validarNota(this); validarNumero(this);"></input></td>';
					}else{
						// aqui solo debe generarse la celda vacia si nunca tuvo nota o la ultima nota cargada.
						echo '<td align="center">'.$datos[$cantalu][$i].'<input type="hidden" style="border:1px solid #3366CC;" name="nota'.($i-1).'-'.$cantalu.'" id="nota'.($i-1).'_'.$cantalu.'" value="'.$datos[$cantalu][$i].'" size="5" maxlength="5" OnKeyUp="validarNumero(this);" onBlur="validarNota(this); validarNumero(this);"></input></td>';
						
					}
				}
				if($activasta==1 && $datos[$cantalu][37]<50) $color='style="background:#FF0000; color:black; font-family:arial; font-weight:bold;"';
				echo '<td align="center" '.$color.' >'.$datos[$cantalu][37].'</td>';
				$color='';
				if($activasta==1 && $datos[$cantalu][38]<5) $color='style="background:#FF0000; color:black; font-family:arial; font-weight:bold;"';
				echo '<td align="center" '.$color.' >'.$datos[$cantalu][38].'</td>';
			echo '</tr>';
				$cantalu++;
				$num++;
				}
			echo '<tr><td colspan="4"><strong>%ASISTENTES</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$asistentes[0][$i].'</td>';
				echo '</tr>';
			echo '<tr><td colspan="4"><strong>%INASISTENTES</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$inasistentes[0][$i].'</td>';
				echo '</tr>';
			echo '<tr><td colspan="4"><strong>%APROBADOS</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$aprobados[0][$i].'</td>';
				echo '</tr>';
			echo '<tr><td colspan="4"><strong>%REPROBADOS</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$reprobados[0][$i].'</td>';
				echo '</tr>';
			echo '<tr><td colspan="4" ><strong>FECHAS DE CARGA</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.implode("/",array_reverse(explode("-",$fechas[0][$i]))).'</td>';
				echo '</tr>';
print <<<TEXTO01
				<tr><td colspan="8" style="text-align:left;padding-left:50px;font-variant:normal;color:#3366CC;font-weight:bold;">
					<li>Los valores decimales deben separarse con . (punto).</li>
					<li>Para estudiantes inasistentes colocar el valor 0 (cero).</li>
					<li>Nota m&iacute;nima permitida 0.1 (cero punto uno)</li>
					
				</td></tr>
				<tr> <td height="32" class="datosp" colspan="3">
		<p>Escriba la raz&oacute;n por la cual se va(n) a modificar esa(s) calificacion(es):</td><td class="datosp" colspan="5">
		<textarea name="razomoca" rows="5" cols="80" class="datospf" onKeyUp="maximaLongitud(this,253)"></textarea><div id="contador"></div></p><br> 
</td></tr>
TEXTO01;
				echo '</table><input type="hidden" name="acta" value="'.$acta.'"><input type="hidden" name="c_asigna" value="'.$c_asigna.'"><input type="hidden" name="lapso" value="'.$lapso.'"><input type="hidden" name="cantalu" value="'.$cantalu.'"><input type="hidden" name="cantee" value="'.$cantee.'"><input type="hidden" name="decision6" value="act"><input type="button" value="Modificar Calificaciones" onClick="ValidaGral(this.form,'.$cantee.','.$cantalu.');"></form><br>';}	
						
			else{
			//require_once("inc/odbcss_c.php");
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select b.apellidos||',  '||nombres,a.EXP_E from dace006 a,dace002 b where a.acta='$acta' and a.lapso='$lapso' and a.EXP_E=b.EXP_E and (status='7' or status='A' or status='2') order by apellidos asc";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;				
				$cantalu=0;
			while($result[$cantalu][0]!=NULL)
				{
			echo '<tr>';
				for($i=0;$i<=$cantee+1;$i++) echo '<td align="center">'.$result[$cantalu][$i].'</td>';
				echo '<td align="center" >'.$result[$cantalu][22].'</td><td align="center">'.$result[$cantalu][23].'</td>';
			echo '</tr>';
				$cantalu++;
				}

			echo '<tr><td colspan="4"><strong>%ASISTENTES</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$asistentes[0][$i].'</td>';
				echo '</tr>';
			echo '<tr><td colspan="4"><strong>%INASISTENTES</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$inasistentes[0][$i].'</td>';
				echo '</tr>';
			echo '<tr><td colspan="4"><strong>%APROBADOS</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$aprobados[0][$i].'</td>';
				echo '</tr>';
			echo '<tr><td colspan="4"><strong>%REPROBADOS</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$reprobados[0][$i].'</td>';
				echo '</tr>';
			echo '<tr><td colspan="4"><strong>FECHAS DE CARGA</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$fechas[0][$i].'</td>';
				echo '</tr>';
				echo '</table>';
			}

?>	
</td>
</tr>
</table>
					<form name="form" method="post" action="cante.php" class="datosp">
					 <input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					 <input type="button" name="imprimir" value="Imprimir" class="boton" style="background:#FFFF33; color:black; font-family:arial; font-weight:bold;" onclick="window.print();">&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Regresar" class="boton">
					 </form>
<?php
break;
case 33: //agregar calificaciones de estudiantes/////////////////////////////////////////////////////////////////////////////////
//require_once("guardar.php");
$bander=con_ex_temas_car($acta,$lapso,$c_asigna);
if($bander[0][0]==0 || $bander[0][0]==NULL){
	?>
	
<table >
  <tr>
    <td><?PHP include("encabezado.php"); ?></td>
  </tr><tr><td><?PHP include("datosdemateria.php"); ?></td></tr>
    <tr>
    <td height="20" class="datosp" colspan="8"><p><strong>AGREGAR CALIFICACIONES</strong></p></td></tr>
  <tr>
    <td height="32" class="datosp" colspan="8">
	
	<p>Usted no posee ningun tema a evaluar cargado</p><br>
	<p>Por favor ingrese a la seccion de cargar plan de evaluacion, agregue los temas y luego regrese a esta seccion</p><br>
					<form name="form" method="post" action="cante.php">
					 <input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					 <input type="submit" name="submit" value="Regresar" class="boton">
					 </form>

	
</td>
  </tr>
</table>
<?php
}
if($bander[0][0]>0){
$bandera=con_ex_no_car($acta,$lapso,$c_asigna);
if($bandera==1)
{
	?>
<table >
  <tr>
   <td><?PHP include("encabezado.php"); ?></td>
  </tr><tr><td><?PHP include("datosdemateria.php"); ?></td></tr>
    <tr>
    <td height="20" class="datosp" colspan="8"><p><strong>AGREGAR CALIFICACIONES</strong></p></td></tr>
  <tr>
    <td height="32" class="datosp" colspan="8">
	
	<p>Usted ya introdujo anteriormente todas las calificaciones</p><br>
	<p>Ingrese a la seccion de modificar para realizar una modificacion a cualquier calificacion</p><br>
					<form name="form" method="post" action="cante.php">
					 <input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					 <input type="submit" name="submit" value="Regresar" class="boton">
					 </form>

	
</td>
  </tr>
</table>
<?php
}
if($bandera==2)
{
$resultado=ucca($acta,$lapso,$c_asigna);
$canteva=canteva($acta,$lapso,$c_asigna);
?>
<table >
  <tr>
    <td><?PHP include("encabezado.php"); ?></td>
  </tr><tr><td><?PHP include("datosdemateria.php"); ?></td></tr>
    <tr>
    <td height="20" class="datosp" colspan="8"><p><strong>AGREGAR CALIFICACIONES</strong></p></td></tr>
  <tr>
    <td height="32" class="datosp" colspan="8">
	<form name="form1" method="post">
	<p>YA INTRODUJO LAS CALIFICACIONES DE &nbsp;<?PHP echo $resultado[0][0]; ?> &nbsp;TEMA(S)<br><br>Para seguir cargando calificaciones presione el bot&oacute;n CONTINUAR</p><br><br><br><br>	
	  <p>Elija una opcion para continuar:<br></p>
	  <!--continuar agregando calificaciones&nbsp;<input name="desicions" type="radio" value="si" class="datospf" checked><br>
	  Salir&nbsp;<input type="radio" name="desicions" value="sa" class="datospf">--><br>
	  <input type="hidden" name="cantee" value="<?PHP echo $canteva[0][0]; ?>" >
	  <input type="hidden" name="codigo" value="22" >
	   <input type="hidden" name="desicions" value="" >
	  <input type="hidden" name="cont" value="0">
	  <input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	  <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
	<input type="submit" Value="Continuar" name="submit" onClick="document.form1.action='cargac.php'; document.form1.desicions.value='si'; document.form1.submit();" class="boton">&nbsp;&nbsp;&nbsp;
	<input type="button" Value="Regresar" name="salirdesdecante" onClick="document.formsalir.action='cante.php'; document.formsalir.submit();" class="boton">
	</form></td>
  </tr>
</table>
<?php
}
if($bandera==0)
{
$porc= array();
$tema= array();
$nota= array();
			//require_once("guardar.php");
			$resultado=con_ex_temas_car($acta,$lapso,$c_asigna);
				//$cantee=$resultado[0][41];
				$cont=$resultado[0][0];
				for($i=1;$i<=35;$i++) $tema[$i]=$resultado[0][$i];
				for($i=36,$j=1;$i<=70;$i++,$j++)	$porc[$j]=$resultado[0][$i];
	?>
				<table >
  				<tr>
    			<td><?PHP include("encabezado.php"); ?></td>
  				</tr><tr><td><?PHP include("datosdemateria.php"); ?></td></tr>
  				  <tr>
    <td height="20" class="datosp" colspan="8"><p><strong>AGREGAR CALIFICACIONES</strong></p></td></tr>
  <tr>
    			<td height="32" class="datosp" colspan="8"><br><br><br>
				<form name="form" method="post" action="cargac.php">
				ESTAS SON LAS PRIMERAS CALIFICACIONES QUE VA A CARGAR, ASEGURESE DE QUE INTRODUCE LOS DATOS CORRECTOS Y TENGA MUCHO CUIDADO AL HACERLO<br><br><br><br>
				<p>Elija una opcion para continuar:<br></p>
				<!--Continuar y Agregar calificaciones&nbsp;<input name="desicions" type="radio" value="si" class="datospf" checked><br>
	  			Salir&nbsp;<input type="radio" name="desicions" value="sa" class="datospf">	--><br><br>
				<?PHP for($i=1;$i<=$cont;$i++)
						{
						echo '<input type="hidden" name="porc'.$i.'" value="'.$porc[$i].'">';
						}
				for($i=1;$i<=$cont;$i++)
						{
						echo '<input type="hidden" name="tema'.$i.'" value="'.$tema[$i].'">';
						}?>
				<input type="hidden" name="codigo" value="020">
					 <input type="hidden" name="cont" value="0">
					 <input type="hidden" name="desicions" value="">
					 <input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					 <input type="hidden" name="cantee" value="<?PHP echo $cont; ?>">
					<input type="submit" Value="Continuar" name="submit" onClick="document.form.action='cargac.php'; document.form.desicions.value='si'; document.form.submit();" class="boton">&nbsp;&nbsp;&nbsp;
	<input type="button" Value="Regresar" name="salirdesdecante" onClick="document.formsalir.action='cante.php'; document.formsalir.submit();" class="boton">
					 </form></td></tr></table>
					

<?php
}
}
break;
case 44: //realizar modificacion la calificaciones de estudiantes/////////////////////////////////////////////////////////////////
//require_once("inc/odbcss_c.php");
//require_once("guardar.php");
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select a.EXP_E,b.apellidos||',  '||nombres from N_ESTU a,dace002 b where a.acta='$acta' and a.lapso='$lapso' and a.EXP_E=b.EXP_E order by b.apellidos, b.apellidos2, b.nombres, b.nombres2 asc";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
$ucca=ucca($acta,$lapso,$c_asigna);
$lapsos=explode("-",$lapso);
//print_r($lapsos);
$porcentajesmodcali=con_ex_temas_car($acta,$lapso,$c_asigna);
for($i=36,$j=1;$i<=70;$i++,$j++)	$porc[$j]=$porcentajesmodcali[0][$i];


?>

<table >
  <tr>
    <td><?PHP include("encabezado.php"); ?></td>
  </tr><tr><td><?PHP include("datosdemateria.php"); ?></td></tr>
  <tr>
    <td height="20" class="datosp" colspan="8"><p><strong>MODIFICAR UNA CALIFICACION</strong></p></td></tr>
  <tr>
    <td height="32" class="datosp" colspan="3">
	<form name="form1" method="post" action="guardar.php" >
	<p>Selecciones el Alumno al cual se le va a modificar la calificacion: </td><td class="datosp" colspan="5">
	<label>
			<select name="selecta" id="selecta" class="datospf" OnChange="modifical(<?PHP 
					echo "'".$acta."','".$lapsos[0]."','".$lapsos[1]."','".$c_asigna."'"; 
			?>);">
            <option value="" selected="selected">&lt;&lt; Alumnos &gt;&gt;</option>
			<?PHP 
			$cantalu=0;
			while($result[$cantalu][0]!=NULL)
				{
				echo '<option value="'.$cantalu.'">'.$result[$cantalu][1].'&nbsp;&nbsp;&nbsp;C.I&nbsp;'.$result[$cantalu][0].'</option>'; 
				$cantalu++;
				} 
			for($i=1;$i<$cantalu;$i++)
						{
						echo '<input type="hidden" id="porc'.$i.'" value="'.$porc[$i].'">';
						}	
			
			?>
          </select>
          </label></p></td></tr><tr>
    <td height="32" class="datosp" colspan="3">
	  <p>Seleccione el numero de evaluacion: </td><td class="datosp" colspan="5">
	  <label>
	  
          <select name="selectne" id="selectne" class="datospf" OnChange="modifical(<?PHP 
					echo "'".$acta."','".$lapsos[0]."','".$lapsos[1]."','".$c_asigna."'"; 
			?>);">
            <option value="" selected="selected">&lt;&lt; Calificaciones &gt;&gt;</option>
            <?PHP for($i=1;$i<=$ucca[0][0];$i++) echo '<option value="'.$i.'">Evaluacion&nbsp;'.$i.'</option>'; ?>
          </select>
          </label></p></td></tr>
		<tr><td colspan="8">
		  <div id="temas"></div></td></tr>
	  <tr><td class="datosp" colspan="3"><p>Escriba el nuevo valor:</td><td class="datosp" colspan="5">
		<input name="nc" type="text" value="" size="5" maxlength="5" class="datospf" OnKeyUp="validarNumero(this); validarNota1(this);">pts.</p></td></tr><tr> <td height="32" class="datosp" colspan="3">
		<p>Escriba la Razon por la cual se va a modificar esa calificacion:</td><td class="datosp" colspan="5">
		<textarea name="razomoca" rows="5" cols="80" class="datospf" onKeyUp="maximaLongitud(this,253)"></textarea><div id="contador"></div></p><br> </td></tr><tr> <td class="datosp" colspan="8">
	  <input type="hidden" name="codigos" value="666" >
	  <input type="hidden" name="cont" value="0">
	  <input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	  <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
	<input type="button" name="modificar" value="Modificar" class="boton" onclick="validamodcali(document.form1.selecta.value,document.form1.selectne.value,document.form1.nc.value,document.form1.razomoca.value);">&nbsp;&nbsp;&nbsp;
	<input type="button" Value="Regresar" name="salirdesdecante" onClick="regresarmodcali(document.form1.selecta.value,document.form1.selectne.value,document.form1.nc.value,document.form1.razomoca.value);" class="boton">
	</form></td>
  	</tr>
	</table>
<?php	
break;
case 55: //agregar temas a evaluar///////////////////////////////////////////////////////////////////////////////////////////////
//require_once("guardar.php");
			$resultado=con_ex_temas_car($acta,$lapso,$c_asigna);
			if($resultado!=NULL && $resultado[0][0]==$resultado[0][71])
			{	
				$cont=$resultado[0][0];
				$conte=$cont;
				for($i=1;$i<=35;$i++) $tema[$i]=$resultado[0][$i];
				for($i=36,$j=1;$i<=70;$i++,$j++)	$porc[$j]=$resultado[0][$i];
			$cont++;
			echo '<table>
  					<tr>
    				<td>';
					include("encabezado.php");				
			echo	'</td>
 					</tr><tr><td>';
					include("datosdemateria.php");
			echo	'</td></tr>
 					<tr>
    				<td height="32" class="datosp" colspan="8">
					<p>A CONTINUACION INTRODUZCA EL TEMA NUMERO &nbsp;&nbsp;'.$cont.'</p>
					</td>
					</tr>
 					<tr><td height="32" class="datosp" colspan="8">
					<form name="form1" method="post"  onsubmit="return validarintrot(document.form1.tema'.$cont.'.value,document.form1.porc'.$cont.'.value);"  ><br><br>
					Evaluacion_'.$cont.'<br>
					<textarea name="tema'.$cont.'" rows="5" cols="80" class="datospf" onKeyUp="maximaLongitud(this,253)"></textarea><div id="contador"></div><br>
					Valor&nbsp;<input name="porc'.$cont.'" type="text" value="" size="5" maxlength="5" class="datospf" OnKeyUp="validarNumero(this); validarporcentajes(this);">%<br>
					<input type="hidden" name="cont" value="'.$cont.'">
					<input type="hidden" name="conte" value="'.$conte.'">
					<input type="hidden" name="acta" value="'.$acta.'">
	  				<input type="hidden" name="lapso" value="'.$lapso.'">
	 				<input type="hidden" name="c_asigna" value="'.$c_asigna.'">
					<input type="hidden" name="codigo" value="1111">
					<input type="hidden" name="desicions" value="">
					<input type="hidden" name="cantee" value="'.$cont.'">';
					
					for($i=1;$i<$cont;$i++)
						{
						echo '<input type="hidden" name="porc'.$i.'" value="'.$porc[$i].'">';
						}
					for($i=1;$i<$cont;$i++)
						{
						echo '<input type="hidden" name="tema'.$i.'" value="'.$tema[$i].'">';
						}
					
					?> <p>Elija una opcion para continuar:<br></p>
						<!--Guardar&nbsp;<input type="radio" name="desicions" value="no" class="datospf"><br>
	  					Salir&nbsp;<input type="radio" name="desicions" value="sa" class="datospf">-->	<br>					
						<input type="button" name="button" value="Agregar" class="boton" onClick="validacontinuarintrot(document.form1.tema<?PHP echo $cont; ?>.value,document.form1.porc<?PHP echo $cont; ?>.value);">&nbsp;&nbsp;&nbsp;
	<input type="button" Value="Regresar" name="salirdesdecante" onClick="validaregresointrot(document.form1.tema<?PHP echo $cont; ?>.value,document.form1.porc<?PHP echo $cont; ?>.value);"class="boton">
						</form></td></tr></table> <?PHP	
			 }if($resultado==NULL){
			 echo '<table>
  					<tr>
    				<td>';
					include("encabezado.php");				
			echo	'</td>
 					</tr><tr><td>';
					include("datosdemateria.php");
			echo	'</td></tr>
 					<tr>
    				<td height="32" class="datosp" colspan="8">
					</td>
					</tr>
 					<tr><td height="32" class="datosp" colspan="8">
					<p>No posee plan de evaluacion cargado en el sistema</p>
						<!--Guardar&nbsp;<input type="radio" name="desicions" value="no" class="datospf"><br>
	  					Salir&nbsp;<input type="radio" name="desicions" value="sa" class="datospf">-->	<br>';					
	?> <input type="button" Value="Regresar" name="salirdesdecante" onClick="document.formsalir.action='cante.php'; document.formsalir.submit();" class="boton">
						</form></td></tr></table> <?PHP
			 }if($resultado[0][71]>$resultado[0][0] && $resultado!=NULL){
			 echo '<table>
  					<tr>
    				<td>';
					include("encabezado.php");				
			echo	'</td>
 					</tr><tr><td>';
					include("datosdemateria.php");
			echo	'</td></tr>
 					<tr>
    				<td height="32" class="datosp" colspan="8">
					</td>
					</tr>
 					<tr><td height="32" class="datosp" colspan="8">
					<p>Aun no ha cargado completamente su plan de evaluacion.</p>
					<p>Dirijase a la seccion de cargar plan de evaluacion y culmine la misma.</p>
						<!--Guardar&nbsp;<input type="radio" name="desicions" value="no" class="datospf"><br>
	  					Salir&nbsp;<input type="radio" name="desicions" value="sa" class="datospf">-->	<br>';					
	?> <input type="button" Value="Regresar" name="salirdesdecante" onClick="document.formsalir.action='cante.php'; document.formsalir.submit();" class="boton">
						</form></td></tr></table> <?PHP
			 }
break;
case 66: //eliminar temas a evaluar//////////////////////////////////////////////////////////////////////////////////////////////
//require_once("guardar.php");
$cantee=canteva($acta,$lapso,$c_asigna);
$ucca=ucca($acta,$lapso,$c_asigna);
?>
	<table >
  	<tr>
    <td><?PHP include("encabezado.php"); ?></td>
  	</tr><tr><td><?PHP include("datosdemateria.php"); ?></td></tr>
  	<tr>
    <td height="20" class="datosp" colspan="8"><p><strong>ELIMINAR UN TEMA A EVALUAR</strong></p></td></tr>
  <tr>
    <td height="32" class="datosp" colspan="3">
	<form name="form1" method="post">
	<p>Selecciones el tema a eliminar: </td><td class="datosp" colspan="5">
	<label>
	<select name="selecta" id="selecta" class="datospf" OnChange="fajax('guardar.php','temas','codigos=234&valor='+this.value+'&acta=<?PHP echo $acta; ?>&lapso=<?PHP echo $lapso; ?>&c_asigna=<?PHP echo $c_asigna; ?>','post','0');">
	
		  <option value="" selected="selected">&lt;&lt; temas a eliminar &gt;&gt;</option>
		  
          <?PHP for($i=1;$i<=$cantee[0][0];$i++) 
		  {
		  if($i>$ucca[0][0]) echo '<option value="'.$i.'">Evaluacion&nbsp;'.$i.'</option>'; 
		  }?>
         		</select>
          		</label></p></td></tr>
				<tr><td colspan="8">
		 <div id="temas"></div></td></tr>
	  <tr><td class="datosp" colspan="3"><p>Escriba la Razon por la cual se va elmiminar este tema:</td><td class="datosp" colspan="5">
				<textarea name="razeli" rows="5" cols="80" class="datospf" onKeyUp="maximaLongitud(this,253)"></textarea><div id="contador"></div></p></td></tr><tr><td class="datosp" colspan="8">
	  			<input type="hidden" name="codigos" value="333">
	  			<input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  			<input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	  			<input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
				<input type="button" name="eliminar" value="Guardar" class="boton" onclick="valieliminar(document.form1.selecta.value,document.form1.razeli.value);">&nbsp;&nbsp;&nbsp;
	<input type="button" Value="Regresar" name="salirdesdecante" onClick="regresareliminar(document.form1.selecta.value,document.form1.razeli.value);" class="boton">
				</form></td>
  				</tr>
				</table>
<?PHP
break;
case 77: //modificar la descripcion de un tema a evaluar ////////////////////////////////////////////////////////////////////////
//require_once("guardar.php");
$cantee=canteva($acta,$lapso,$c_asigna);
?>
<script language="javascript" src="asrequest.js" type="text/javascript"></script>
<table >
  <tr>
    <td colspan="2"><?PHP include("encabezado.php"); ?></td>
  </tr><tr><td colspan"2"><?PHP include("datosdemateria.php"); ?></td></tr>
  <tr>
    <td height="20" class="datosp" colspan="8"><p><strong>MODIFICAR UNA DESCRIPCION</strong></p></td></tr>
  <tr>
    <td height="15" class="datosp" colspan="3">
	<form name="form1" method="post" action="guardar.php" >
	<p>Seleccione la evaluacion a modificar: </td><td class="datosp" colspan="5">
	<label>
          <select name="selecta" class="datospf" OnChange="fajax('guardar.php','temas','codigos=235&valor='+this.value+'&acta=<?PHP echo $acta; ?>&lapso=<?PHP echo $lapso; ?>&c_asigna=<?PHP echo $c_asigna; ?>','post','0');">
             <option value="" selected="selected">&lt;&lt; Evaluaciones a modificar &gt;&gt;</option>
            <?PHP for($i=1;$i<=$cantee[0][0];$i++) echo '<option value="'.$i.'">Evaluacion&nbsp;'.$i.'</option>'; ?>
          </select>
          </label></p>
		 </td></tr>
		  <tr><td class="datosp" colspan="3">
		  <p> DESCRIPCION DE TEMA:  </p> </td>
		  <td class="datosp" colspan="5">
		  <div id="temas"></div></td></tr>
	  <tr><td class="datosp" colspan="3"><p>Escriba la nueva descripcion del tema:</td><td class="datosp" colspan="5"><br>
		<textarea name="ndt" rows="5" cols="80" class="datospf" onKeyUp="maximaLongitud(this,253)"></textarea><div id="contador"></div></p><br> </td></tr>
	 <tr><td class="datosp" colspan="3">
	  <p>Escriba la Razon por la cual se va a modificar esta descripcion:</td><td class="datosp" colspan="5"><br>
		<textarea name="razmodt" rows="5" cols="80" class="datospf" onKeyUp="maximaLongitud(this,253)"></textarea><div id="contador"></div></p><br>  </td></tr><tr><td class="datosp" colspan="8">
	  <input type="hidden" name="codigos" value="444">
	  <input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	  <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
	<input type="button" name="modificard" value="Modificar" class="boton" onclick="validardescripcion(document.form1.selecta.value,document.form1.ndt.value,document.form1.razmodt.value);">&nbsp;&nbsp;&nbsp;
	<input type="button" Value="Regresar" name="salirdesdecante" onClick="regresarmodides(document.form1.selecta.value,document.form1.ndt.value,document.form1.razmodt.value); " class="boton">
	</form></td>
  	</tr>
	</table>
<?php	
break;
case 88: //modificar el porcentaje de un tema a evaluar//////////////////////////////////////////////////////////////////////////
//require_once("guardar.php");
$cantee=canteva($acta,$lapso,$c_asigna);
$ucca=ucca($acta,$lapso,$c_asigna);    
?>
<script language="javascript" src="asrequest.js" type="text/javascript"></script>
<table >
  <tr>
   <td colspan="2"><?PHP include("encabezado.php"); ?></td>
  </tr><tr><td colspan="2"><?PHP include("datosdemateria.php"); ?></td></tr>
   <tr>
    <td height="20" class="datosp" colspan="8"><p><strong>MODIFICAR UN PORCENTAJE</strong></p></td></tr>
  <tr>
    <td height="15" class="datosp" colspan="3">
	<form name="form1" method="post" action="guardar.php" >
	<p>Selecciones El tema a modificar: </td><td class="datosp" colspan="5">
	<label>
<select name="selecta" class="datospf" OnChange="fajax('guardar.php','temas','codigos=234&valor='+this.value+'&acta=<?PHP echo $acta; ?>&lapso=<?PHP echo $lapso; ?>&c_asigna=<?PHP echo $c_asigna; ?>','post','0');">
             <option value="" selected="selected">&lt;&lt; Evaluaciones a modificar &gt;&gt;</option>
            <?PHP 
for($i=1;$i<=$cantee[0][0];$i++) {
	if($i > $ucca[0][0]) {
		echo '<option value="'.$i.'">Evaluacion&nbsp;'.$i.'</option>';
	} else {
		echo '<option value="'.$i.'">Evaluacion&nbsp;'.$i.'</option>';
	}
}
			?>
          </select>
          </label></p> 
		  </td></tr>
		  <tr>
		  <td colspan="8">
		  <div id="temas"></div></td></tr>
	  <tr><td class="datosp" colspan="3"><p>Escriba el nuevo valor del tema:</td><td class="datosp" colspan="5">
		<input name="np" type="text" value="" size="5" maxlength="5" class="datospf" OnKeyUp="validarNumero(this); validarporcentajes(this);">%</p><br> </td></tr>
	 <tr><td class="datosp" colspan="3"> <p>Escriba la Razon por la cual se va a modificar el porcentaje de este tema:</td><td class="datosp" colspan="5"><br>
		<textarea name="razmodp" rows="5" cols="80" class="datospf" onKeyUp="maximaLongitud(this,253)"></textarea><div id="contador"></div></p><br>  </td></tr><tr><td class="datosp" colspan="8">
	  <input type="hidden" name="codigos" value="555" >
	  <input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	  <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
	<input type="button" name="modificar" value="Modificar" class="boton" onClick="validarmodpor(document.form1.selecta.value,document.form1.np.value,document.form1.razmodp.value);" >&nbsp;&nbsp;&nbsp;
	<input type="button" Value="Regresar" name="salirdesdecante" onClick="validarregresomodpor(document.form1.selecta.value,document.form1.np.value,document.form1.razmodp.value);" class="boton">
	</form></td>
  	</tr>
	</table>
<?php	
break;
case 99: //visualizar las modificaciones hechas hasta la fecha///////////////////////////////////////////////////////////////////
//require_once("guardar.php");
$modn=saca_modn($acta,$lapso,$c_asigna);
$modp=saca_modp($acta,$lapso,$c_asigna);
$modt=saca_modt($acta,$lapso,$c_asigna);
$modct=saca_modct($acta,$lapso,$c_asigna);
$info=sacainfo($acta,$lapso,$c_asigna);
?>
<script language="javascript" src="funciones.js" type="text/javascript"></script>
<table>
  <tr>
    <td><?PHP include("encabezado.php"); ?></td>
  </tr>
  <tr><td><?PHP include("datosdemateria.php"); ?></td></tr>
  <tr>
    <td height="32"  colspan="8" class="datosp">
	<p>Los datos que se encuentran en el sistema son los siguientes:</p>
	<table border="2" width="100%" class="datotabla">
	<tr><td class="datona">
	<p class="encna"><strong>TEMAS AGREGADOS</strong></p>
	<hr size="1">
		<?php
		$cont=0;
		while($modct[$cont][8]!=NULL){
		if($modct[$cont][4]!=NULL){
		echo '<u>Se realizo en la evaluacion Nro</u> :&nbsp;'.$modct[$cont][7].'<br>';
		//echo '<u>Razon de el cambio</u> :&nbsp;'.$modct[$cont][0].'<br>';
		echo '<u>La cantidad anterior de evaluaciones era</u> :&nbsp;'.$modct[$cont][1].'<br>';
		echo '<u>La cantidad actual de evaluaciones es</u> :&nbsp;'.$modct[$cont][2].'<br>';
		echo '<u>La evaluacion agregada es</u> :&nbsp;'.$modct[$cont][4].'<br>';
		echo '<u>Que tiene un valor de</u> :&nbsp;'.$modct[$cont][6].'<br>';
		echo '<u>Fecha en que se agrego la evaluacion</u> :&nbsp;'.implode("/",array_reverse(explode("-",$modct[$cont][8]))).'<br>';
		echo '<hr size="1">';
		}
		$cont++;
		}
	?>
	</td></tr>
	<tr><td class="datona" >
	<p class="encna"><strong>TEMAS ELIMINADOS</strong></p>
	<hr size="1">
		<?php
		$cont=0;
		while($modct[$cont][8]!=NULL){
		if($modct[$cont][3]!=NULL){
		echo '<u>Se realizo en la evaluacion Nro</u> :&nbsp;'.$modct[$cont][7].'<br>';
		echo '<u>Razon de por que se elimino</u> :&nbsp;'.$modct[$cont][0].'<br>';
		echo '<u>La cantidad anterior de evaluaciones era</u> :&nbsp;'.$modct[$cont][1].'<br>';
		echo '<u>La cantidad actual de evaluaciones es</u> :&nbsp;'.$modct[$cont][2].'<br>';
		echo '<u>La evaluacion eliminada fue</u> :&nbsp;'.$modct[$cont][3].'<br>';
		echo '<u>Que tiene un valor de</u> :&nbsp;'.$modct[$cont][5].'<br>';
		echo '<u>Fecha en que se elimino la evaluacion</u> :&nbsp;'.implode("/",array_reverse(explode("-",$modct[$cont][8]))).'<br>';
		echo '<hr size="1">';
		}
		$cont++;
		}
	?>
	</td></tr>
	<tr><td class="datona">
	<p class="encna"><strong>MODIFICACIONES A LA DESCRIPCION DE LOS TEMAS</strong></p>
	<hr size="1">
		<?php
		//require_once("inc/odbcss_c.php");
		$cont=0;
		while($modt[$cont][4]!=NULL){
		echo '<u>Se realizo en la evaluacion Nro</u> :&nbsp;'.$modt[$cont][3].'<br>';
		echo '<u>Razon de el cambio</u> :&nbsp;'.$modt[$cont][0].'<br>';
		echo '<u>Descripcion original</u> :&nbsp;'.$modt[$cont][1].'<br>';
		echo '<u>Descripcion modificada</u> :&nbsp;'.$modt[$cont][2].'<br>';
		echo '<u>Fecha de modificacion</u> :&nbsp;'.implode("/",array_reverse(explode("-",$modt[$cont][4]))).'<br>';
		echo '<hr size="1">';
		$cont++;
		}
	
	?>
	</td></tr>
	<tr><td class="datona">
	<p class="encna"><strong>MODIFICACIONES AL PORCENTAJE DE LOS TEMAS</strong></p>
	<hr size="1">
		<?php
		//require_once("inc/odbcss_c.php");
		$cont=0;
		while($modp[$cont][4]!=NULL){
		echo '<u>Se realizo en la evaluacion Nro</u> :&nbsp;'.$modp[$cont][3].'<br>';
		echo '<u>Razon de el cambio</u> :&nbsp;'.$modp[$cont][0].'<br>';
		echo '<u>Porcentaje original</u> :&nbsp;'.$modp[$cont][1].'<br>';
		echo '<u>Porcentaje modificada</u> :&nbsp;'.$modp[$cont][2].'<br>';
		echo '<u>Fecha de modificacion</u> :&nbsp;'.implode("/",array_reverse(explode("-",$modp[$cont][4]))).'<br>';
		echo '<hr size="1">';
		$cont++;
		}
	?>
	</td></tr>
	<tr><td  class="datona">
	<p class="encna"><strong>MODIFICACIONES A LAS CALIFICACIONES DE ESTUDIANTES</strong></p>
	<hr size="1">
	<?php
	//require_once("inc/odbcss_c.php");
	//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
	$cont=0;
	//echo "mod4 ".$modn[$cont][4];
	//echo "mod ".$modn[$cont][0];
	while ($cont < count($modn)){
		if ($modn[$cont][4]!=NULL){
			$mSQL  = "select apellidos||',  '||nombres from dace002 where EXP_E='".$modn[$cont][4]."'";
			$conex->ExecSQL($mSQL,__LINE__,true);
			$result = $conex->result;
			echo '<u>MODIFICACI&Oacute;N INDIVIDUAL</u> :<br>';
			echo '<u>Nombre de alumno</u> :&nbsp;'.$result[0][0].'&nbsp;&nbsp;&nbsp;<u>EXP</u>:&nbsp;&nbsp;'.$modn[$cont][4].'<br>';
			echo '<u>Razon del cambio</u> :&nbsp;'.$modn[$cont][0].'<br>';
			echo '<u>Calificacion original</u> :&nbsp;'.$modn[$cont][1].'<br>';
			echo '<u>Calificacion modificada</u> :&nbsp;'.$modn[$cont][2].'<br>';
			echo '<u>Se realizo en la evaluacion Nro</u> :&nbsp;'.$modn[$cont][3].'<br>';
			echo '<u>Fecha de modificacion</u> :&nbsp;'.implode("/",array_reverse(explode("-",$modn[$cont][5]))).'<br>';
			echo '<hr size="1">';
		}else{
			echo '<u>MODIFICACI&Oacute;N GENERAL</u> :<br>';
			echo '<u>Razon del cambio</u> :&nbsp;'.$modn[$cont][0].'<br>';
			echo '<u>Fecha de modificacion</u> :&nbsp;'.implode("/",array_reverse(explode("-",$modn[$cont][5]))).'<br>';
			echo '<hr size="1">';
		}
		//echo $cont;
		$cont++;				
	}
	// hacer el recorrido del result con filas y no con null
	/*if ($modn[$cont][4]!=NULL){
		while($modn[$cont][4]!=NULL){
		$mSQL  = "select apellidos||',  '||nombres from dace002 where EXP_E='".$modn[$cont][4]."'";
		$conex->ExecSQL($mSQL,__LINE__,true);
		$result = $conex->result;
		echo '<u>MODIFICACI&Oacute;N INDIVIDUAL</u> :<br>';
		echo '<u>Nombre de alumno</u> :&nbsp;'.$result[0][0].'&nbsp;&nbsp;&nbsp;<u>C.I</u>:&nbsp;&nbsp;'.$modn[$cont][4].'<br>';
		echo '<u>Razon de el cambio</u> :&nbsp;'.$modn[$cont][0].'<br>';
		echo '<u>Calificacion original</u> :&nbsp;'.$modn[$cont][1].'<br>';
		echo '<u>Calificacion modificada</u> :&nbsp;'.$modn[$cont][2].'<br>';
		echo '<u>Se realizo en la evaluacion Nro</u> :&nbsp;'.$modn[$cont][3].'<br>';
		echo '<u>Fecha de modificacion</u> :&nbsp;'.implode("/",array_reverse(explode("-",$modn[$cont][5]))).'<br>';
		echo '<hr size="1">';
		$cont++;
		}
	}else{
		while($modn[$cont][0]!=NULL){
		echo '<u>MODIFICACI&Oacute;N GENERAL</u> :<br>';
		echo '<u>Razon de el cambio</u> :&nbsp;'.$modn[$cont][0].'<br>';
		echo '<u>Fecha de modificacion</u> :&nbsp;'.implode("/",array_reverse(explode("-",$modn[$cont][5]))).'<br>';
		echo '<hr size="1">';
		$cont++;
		}
	}*/
	?>
	</td></tr>
	</table>
	</td>
  </tr>
</table>
					<form name="form" method="post" action="cante.php" class="datosp">
					 <input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					 <input type="button" name="imprimir" value="Imprimir" class="boton" style="background:#FFFF33; color:black; font-family:arial; font-weight:bold;" onclick="window.print();">&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Regresar" class="boton">
					 </form>
<?php
break;
case 1010: //Revizar si hay agregados///////////////////////////////////////////////////////////////////////////////////////////////
//require_once("guardar.php");
			//$resultado=con_ex_temas_car($acta,$lapso,$c_asigna);
			//if($resultado!=NULL)
			//{	
			//	
			//	$cont=$resultado[0][0];
			//	$conte=$cont;
			//	for($i=1;$i<=35;$i++) $tema[$i]=$resultado[0][$i];
			//	for($i=36,$j=1;$i<=70;$i++,$j++)	$porc[$j]=$resultado[0][$i];
			//$cont++;
			//}
			?>
			<table>
  					<tr>
    				<td>
				<?PHP 	include("encabezado.php");	 ?>			
			</td>
 			</tr><tr><td>
					<?PHP include("datosdemateria.php"); ?>
			</td></tr>
 					<tr>
    <td height="20" class="datosp" colspan="8"><p><strong>AGREGADOS</strong></p></td></tr>
  <tr>
  				<?PHP
				$agregado=ex_agregados($acta,$lapso,$c_asigna);
				if($agregado[0][0]!=NULL)
				{				
				 ?>
    				<td height="32" class="datosp" colspan="8" >
					<p>Actualmente usted si posee agregados en el sistema</p>
					</td>
					</tr>
					<tr ><td colspan="8" class="datosp" width="100%" ><table align="center" class="datotabla" border="1" cellspacing="1" width="600"><tr>
					<td align="center" ><strong>NUM.</strong></td><td align="center" ><strong>STATUS</strong></td><td align="center" ><strong>ALUMNOS</strong></td><td align="center" ><strong>C.I</strong></td></tr>
				<?PHP
				$cantalu=0;
				$num=1;
				while($agregado[$cantalu][0]!=NULL)
				{
				echo '<tr><td>'.$num.'</td><td>';
				if($agregado[$cantalu][2]=='A') echo 'Agregado';
				else echo $agregado[$cantalu][2];				
				echo '</td><td>'.$agregado[$cantalu][1].'</td><td>'.$agregado[$cantalu][0].'</td></tr>';
				$cantalu++;
				$num++;
				}
				?>
				<br>
				
					
					</table>
					</td></tr>
 					<tr><td height="32" class="datosp" colspan="8">
					<form name="form1" method="post"  ><br><br>
					<input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				<input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				<input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					<input type="hidden" name="codigos" value="1agreg">
					<p>Elija una opcion para continuar:<br></p>
						<br>					
						<input type="button" name="button" value="Cargar al sist" class="boton" onClick="confirmacargar();">&nbsp;&nbsp;&nbsp;
	<input type="button" Value="Regresar" name="salirdesdecante" onClick="document.formsalir.action='cante.php'; document.formsalir.submit();" class="boton">
						</form></td></tr></table> <?PHP	
						}else{
						?>
						
						<td height="32" class="datosp" colspan="8" ><br>
					<p>Actualmente usted no posee agregados en el sistema</p><br>
					</td>
					</tr>					
					</table>
					</td></tr>
 					<tr><td height="32" class="datosp" colspan="8">
					<form name="form1" method="post"  ><br>
					<input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				<input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				<input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					<input type="hidden" name="codigos" value="1agreg">
					<p>Elija una opcion para continuar:<br></p>
						<br>					
	<input type="button" Value="Regresar" name="salirdesdecante" onClick="document.formsalir.action='cante.php'; document.formsalir.submit();" class="boton">
						</form></td></tr></table> 
						<?PHP	

						}
			
break;
case 999: // Cierre de acta
	// echo $acta."/".$lapso."/".$c_asigna;


print<<<ENVIAR
	<form name="enviar" method="post" action="">
		<input type="hidden" name="acta" value="$acta">
	  	<input type="hidden" name="lapso" value="$lapso">
	 	<input type="hidden" name="c_asigna" value="$c_asigna">
	</form>
ENVIAR;

$mSQL = "SELECT ucca FROM n_estu WHERE acta='".$acta."' AND lapso='".$lapso."' AND c_asigna='".$c_asigna."'";
$conex->ExecSQL($mSQL,__LINE__,true);
$ultima = $conex->result[0][0];
$mSQL = "SELECT cant_eva FROM d_temas WHERE acta='".$acta."' AND lapso='".$lapso."' AND c_asigna='".$c_asigna."'";
$conex->ExecSQL($mSQL,__LINE__,true);
$total = $conex->result[0][0];

//echo $ultima." de ".$total;

if (($ultima == $total) && ($total != "") && ($ultima != "")) {

	if($total100<100 || $total100>100) {
		echo '<script>alert("Actualmente acumula '.$total100.'% de 100% en su plan de evaluacion, recuerde ajustar para que concuerde con el 100% que se evalua en un semestre.");history.back();</script>';
	} else {
		echo "<script language=\"javascript\">alert('ATENCION: Esta es una vista previa de su acta final. Por favor verifique que toda la informaci�n contenida en ella sea correcta. Presione Confirmar para CERRAR el acta. Presione Regresar para volver al men� de opciones.');document.enviar.action='cerrar.php';document.enviar.submit();</script>";
	}

	
}else {
	echo "<script language=\"javascript\">alert('Lo siento usted no ha completado su Avance Acad�mico en un 100%.');document.enviar.action='cante.php';document.enviar.submit();</script>";
}

//echo "<script language=\"javascript\">alert('ATENCION: Esta es una vista previa de su acta final. Por favor verifique que toda la informaci�n contenida en ella sea correcta. Presione Confirmar para CERRAR el acta. Presione Regresar para volver al men� de opciones.');document.enviar.submit();</script>";
		
			
break;
default:
//error
break;
}
			
} else { ///////////////////PRINCIPIO DE EL SISTEMA/////////////////////////////////////////////////////////////////////////
//require_once("guardar.php");

$mSQL = "SELECT exp_e FROM dace006 WHERE lapso='".$lapso."' AND acta='".$acta."' AND c_asigna='".$c_asigna."' AND status IN ('7','A') ";
$mSQL.= " AND exp_e NOT IN (SELECT exp_e FROM n_estu WHERE lapso='".$lapso."' AND acta='".$acta."' AND c_asigna='".$c_asigna."') ";
$conex->ExecSQL($mSQL,__LINE__,true);
$agregados = $conex->result;// Todos los estudiantes inscritos/agregados que no estan en el acta

for($a=0;$a < count($agregados);$a++) {
	$vSQL = "SELECT exp_e FROM n_estu WHERE lapso='".$lapso."' AND acta='".$acta."' AND c_asigna='".$c_asigna."' AND status IN ('7','A') AND exp_e = '".$agregados[$a][0]."' ";
	$conex->ExecSQL($vSQL,__LINE__,true);// Verifico que realmente no este en el acta

	if (count($conex->result) == 0){// Si no esta en el acta lo inserto.
		$mSQL = "INSERT INTO N_ESTU (acta, lapso, c_asigna, exp_e, total100, total9, ccca, ucca) VALUES ('".$acta."', '".$lapso."', '".$c_asigna."', '".$acta."', '".$agregados[$a][0]."', '0', '0', '".$ulti."', '".$ulti."')";
		$conex->ExecSQL($mSQL,__LINE__,true);
	}	
}

$info=sacainfo($acta,$lapso,$c_asigna);

/**************************************/

$nueva=array();
$nota=array();
$status=array();

$ult=ucca($acta,$lapso,$c_asigna);
$ulti=$ult[0][0];

$mSQL = "select a.EXP_E,b.apellidos||',  '||nombres,a.status from dace006 a,dace002 b ";
$mSQL.= "where a.acta='$acta' and a.lapso='$lapso' and a.EXP_E=b.EXP_E and a.c_asigna='$c_asigna' ";
$mSQL.= "and (status = '7' or status = 'A' or status = '2' or status = 'R' or status = '6' ) ";
$mSQL.= "order by b.apellidos, b.apellidos2, b.nombres, b.nombres2 asc";

$conex->ExecSQL($mSQL,__LINE__,true);
$todos = $conex->result;
$f_todos = $conex->filas;

$mSQL  = "select a.exp_e,b.apellidos||',  '||nombres,a.NOTA1,a.nota2,a.nota3,a.nota4,a.nota5,a.nota6,a.nota7,a.nota8,a.nota9,a.nota10,a.nota11,a.nota12,a.nota13,a.nota14,a.nota15,a.nota16,a.nota17,a.nota18,a.nota19,a.nota20,a.NOTA21,a.NOTA22,a.NOTA23,a.NOTA24,a.NOTA25,a.NOTA26,a.NOTA27,a.NOTA28,a.NOTA29,a.NOTA30,a.NOTA31,a.NOTA32,a.NOTA33,a.NOTA34,a.NOTA35,a.total100,a.total9 from N_ESTU a,dace002 b,dace006 c where a.acta='$acta' and a.lapso='$lapso' and a.C_ASIGNA='$c_asigna' and a.EXP_E=b.EXP_E and c.acta='$acta' and c.lapso='$lapso' and c.C_ASIGNA='$c_asigna' and a.EXP_E=c.EXP_E order by b.apellidos, b.apellidos2, b.nombres, b.nombres2 asc";	
$conex->ExecSQL($mSQL,__LINE__,true);
$existentes = $conex->result;	
$f_existe = $conex->filas;

if ($f_todos > $f_existe){ // Si hay nuevos estudiantes

				$cantalu=0;
				$num=0;
				while($todos[$cantalu][0]!=NULL)
				{	
					if($todos[$cantalu][0]!=$existentes[$num][0])
						{						
						for($k=1;$k<=$ulti;$k++)
								{
								$nota[$cantalu][$k]=0;
								}							
						}
					if($todos[$cantalu][0]==$existentes[$num][0])
						{
							for($j=2,$k=1;$j<=$ulti+1;$j++,$k++)
								{
								$nota[$cantalu][$k]=$existentes[$num][$j];
								}
						$num++;
						}
				$cantalu++;
				}




$resultado4=con_ex_temas_car($acta,$lapso,$c_asigna);
			if($resultado4!=NULL)
			{	
				for($i=36,$j=1;$i<=70;$i++,$j++)	$porc[$j]=$resultado4[0][$i];
			}
			
/////comenzando a guardar todos los cambios

	$naapro=array();	
	$narepro=array();	
	$naasis=array();
	$nainais=array();
	
for($j=1;$j<=$ulti;$j++){
$setpoint=$porc[$j]/2;
for($i=0;$i<$cantalu;$i++)
	{
	if($nota[$i][$j]>=$setpoint) $naapro[$j]++;		
	if($nota[$i][$j]<$setpoint) $narepro[$j]++;
	if($nota[$i][$j]>=1) $naasis[$j]++;
	if($nota[$i][$j]==0) $nainais[$j]++;
	
	}
}	
	
for($j=1;$j<=$ulti;$j++){

	$porap[$j]= round((($naapro[$j]*100)/$cantalu)*100)/100;
	$porre[$j]=	round((($narepro[$j]*100)/$cantalu)*100)/100;
	$poras[$j]=	round((($naasis[$j]*100)/$cantalu)*100)/100;
	$porin[$j]=	round((($nainais[$j]*100)/$cantalu)*100)/100;
}	

$mSQL  = "UPDATE D_TEMAS SET POR_ASIS1='$poras[1]',POR_ASIS2='$poras[2]',POR_ASIS3='$poras[3]',POR_ASIS4='$poras[4]',POR_ASIS5='$poras[5]',POR_ASIS6='$poras[6]',POR_ASIS7='$poras[7]',POR_ASIS8='$poras[8]',POR_ASIS9='$poras[9]',POR_ASIS10='$poras[10]',POR_ASIS11='$poras[11]',POR_ASIS12='$poras[12]',POR_ASIS13='$poras[13]',POR_ASIS14='$poras[14]',POR_ASIS15='$poras[15]',POR_ASIS16='$poras[16]',POR_ASIS17='$poras[17]',POR_ASIS18='$poras[18]',POR_ASIS19='$poras[19]',POR_ASIS20='$poras[20]',POR_ASIS21='$poras[21]',POR_ASIS22='$poras[22]',POR_ASIS23='$poras[23]',POR_ASIS24='$poras[24]',POR_ASIS25='$poras[25]',POR_ASIS26='$poras[26]',POR_ASIS27='$poras[27]',POR_ASIS28='$poras[28]',POR_ASIS29='$poras[29]',POR_ASIS30='$poras[30]',POR_ASIS31='$poras[31]',POR_ASIS32='$poras[32]',POR_ASIS33='$poras[33]',POR_ASIS34='$poras[34]',POR_ASIS35='$poras[35]',POR_IASIS1='$porin[1]',POR_IASIS2='$porin[2]',POR_IASIS3='$porin[3]',POR_IASIS4='$porin[4]',POR_IASIS5='$porin[5]',POR_IASIS6='$porin[6]',POR_IASIS7='$porin[7]',POR_IASIS8='$porin[8]',POR_IASIS9='$porin[9]',POR_IASIS10='$porin[10]',POR_IASIS11='$porin[11]',POR_IASIS12='$porin[12]',POR_IASIS13='$porin[13]',POR_IASIS14='$porin[14]',POR_IASIS15='$porin[15]',POR_IASIS16='$porin[16]',POR_IASIS17='$porin[17]',POR_IASIS18='$porin[18]',POR_IASIS19='$porin[19]',POR_IASIS20='$porin[20]',POR_IASIS21='$porin[21]',POR_IASIS22='$porin[22]',POR_IASIS23='$porin[23]',POR_IASIS24='$porin[24]',POR_IASIS25='$porin[25]',POR_IASIS26='$porin[26]',POR_IASIS27='$porin[27]',POR_IASIS28='$porin[28]',POR_IASIS29='$porin[29]',POR_IASIS30='$porin[30]',POR_IASIS31='$porin[31]',POR_IASIS32='$porin[32]',POR_IASIS33='$porin[33]',POR_IASIS34='$porin[34]',POR_IASIS35='$porin[35]',POR_APRO1='$porap[1]',POR_APRO2='$porap[2]',POR_APRO3='$porap[3]',POR_APRO4='$porap[4]',POR_APRO5='$porap[5]',POR_APRO6='$porap[6]',POR_APRO7='$porap[7]',POR_APRO8='$porap[8]',POR_APRO9='$porap[9]',POR_APRO10='$porap[10]',POR_APRO11='$porap[11]',POR_APRO12='$porap[12]',POR_APRO13='$porap[13]',POR_APRO14='$porap[14]',POR_APRO15='$porap[15]',POR_APRO16='$porap[16]',POR_APRO17='$porap[17]',POR_APRO18='$porap[18]',POR_APRO19='$porap[19]',POR_APRO20='$porap[20]',POR_APRO21='$porap[21]',POR_APRO22='$porap[22]',POR_APRO23='$porap[23]',POR_APRO24='$porap[24]',POR_APRO25='$porap[25]',POR_APRO26='$porap[26]',POR_APRO27='$porap[27]',POR_APRO28='$porap[28]',POR_APRO29='$porap[29]',POR_APRO30='$porap[30]',POR_APRO31='$porap[31]',POR_APRO32='$porap[32]',POR_APRO33='$porap[33]',POR_APRO34='$porap[34]',POR_APRO35='$porap[35]',POR_RPRO1='$porre[1]',POR_RPRO2='$porre[2]',POR_RPRO3='$porre[3]',POR_RPRO4='$porre[4]',POR_RPRO5='$porre[5]',POR_RPRO6='$porre[6]',POR_RPRO7='$porre[7]',POR_RPRO8='$porre[8]',POR_RPRO9='$porre[9]',POR_RPRO10='$porre[10]',POR_RPRO11='$porre[11]',POR_RPRO12='$porre[12]',POR_RPRO13='$porre[13]',POR_RPRO14='$porre[14]',POR_RPRO15='$porre[15]',POR_RPRO16='$porre[16]',POR_RPRO17='$porre[17]',POR_RPRO18='$porre[18]',POR_RPRO19='$porre[19]',POR_RPRO20='$porre[20]',POR_RPRO21='$porre[21]',POR_RPRO22='$porre[22]',POR_RPRO23='$porre[23]',POR_RPRO24='$porre[24]',POR_RPRO25='$porre[25]',POR_RPRO26='$porre[26]',POR_RPRO27='$porre[27]',POR_RPRO28='$porre[28]',POR_RPRO29='$porre[29]',POR_RPRO30='$porre[30]',POR_RPRO31='$porre[31]',POR_RPRO32='$porre[32]',POR_RPRO33='$porre[33]',POR_RPRO34='$porre[34]',POR_RPRO35='$porre[35]' where ACTA='$acta' and LAPSO='$lapso' and C_ASIGNA='$c_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$exp_e= array();
for($i=0;$i<$cantalu;$i++)
	{
	$exp_e[$i]=$todos[$i][0];
	//echo $exp_e[$i].'---';
	for($j=1;$j<=$ulti;$j++) $nota[$i][36]=$nota[$i][36]+$nota[$i][$j];
	$nota[$i][37]=conva9(round($nota[$i][36]));
	}

/*$mSQL  ="DELETE FROM N_ESTU WHERE acta='$acta' and lapso='$lapso' and C_ASIGNA='$c_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);*/
		/*for($k=0;$k<$cantalu;$k++)
		{
$mSQL  = "INSERT INTO N_ESTU (ACTA,LAPSO,C_ASIGNA,EXP_E,NOTA1,NOTA2,NOTA3,NOTA4,NOTA5,NOTA6,NOTA7,NOTA8,NOTA9,NOTA10,NOTA11,NOTA12,NOTA13,NOTA14,NOTA15,NOTA16,NOTA17,NOTA18,NOTA19,NOTA20,NOTA21,NOTA22,NOTA23,NOTA24,NOTA25,NOTA26,NOTA27,NOTA28,NOTA29,NOTA30,NOTA31,NOTA32,NOTA33,NOTA34,NOTA35,TOTAL100,TOTAL9,CCCA,UCCA) VALUES ('$acta','$lapso','$c_asigna','".$exp_e[$k]."','".$nota[$k][1]."','".$nota[$k][2]."','".$nota[$k][3]."','".$nota[$k][4]."','".$nota[$k][5]."','".$nota[$k][6]."','".$nota[$k][7]."','".$nota[$k][8]."','".$nota[$k][9]."','".$nota[$k][10]."','".$nota[$k][11]."','".$nota[$k][12]."','".$nota[$k][13]."','".$nota[$k][14]."','".$nota[$k][15]."','".$nota[$k][16]."','".$nota[$k][17]."','".$nota[$k][18]."','".$nota[$k][19]."','".$nota[$k][20]."','".$nota[$k][21]."','".$nota[$k][22]."','".$nota[$k][23]."','".$nota[$k][24]."','".$nota[$k][25]."','".$nota[$k][26]."','".$nota[$k][27]."','".$nota[$k][28]."','".$nota[$k][29]."','".$nota[$k][30]."','".$nota[$k][31]."','".$nota[$k][32]."','".$nota[$k][33]."','".$nota[$k][34]."','".$nota[$k][35]."','".$nota[$k][36]."','".$nota[$k][37]."','$ulti','$ulti')";
		@$conex->ExecSQL($mSQL,__LINE__,true);
		}*/

	for($k=0;$k<$cantalu;$k++) {

		
		$sql = "SELECT exp_e FROM n_estu WHERE acta = '".$acta."' AND lapso='".$lapso."' AND c_asigna='".$c_asigna."' AND exp_e='".$exp_e[$k]."' ";

		@$conex->ExecSQL($sql,__LINE__,true);

		($conex->filas > 0) ? $existe = true : $existe = false;

		if (!$existe){
			$mSQL  = "INSERT INTO N_ESTU (ACTA,LAPSO,C_ASIGNA,EXP_E,NOTA1,NOTA2,NOTA3,NOTA4,NOTA5,NOTA6,NOTA7,NOTA8,NOTA9,NOTA10,NOTA11,NOTA12,NOTA13,NOTA14,NOTA15,NOTA16,NOTA17,NOTA18,NOTA19,NOTA20,NOTA21,NOTA22,NOTA23,NOTA24,NOTA25,NOTA26,NOTA27,NOTA28,NOTA29,NOTA30,NOTA31,NOTA32,NOTA33,NOTA34,NOTA35,TOTAL100,TOTAL9,CCCA,UCCA) VALUES ('$acta','$lapso','$c_asigna','".$exp_e[$k]."','".$nota[$k][1]."','".$nota[$k][2]."','".$nota[$k][3]."','".$nota[$k][4]."','".$nota[$k][5]."','".$nota[$k][6]."','".$nota[$k][7]."','".$nota[$k][8]."','".$nota[$k][9]."','".$nota[$k][10]."','".$nota[$k][11]."','".$nota[$k][12]."','".$nota[$k][13]."','".$nota[$k][14]."','".$nota[$k][15]."','".$nota[$k][16]."','".$nota[$k][17]."','".$nota[$k][18]."','".$nota[$k][19]."','".$nota[$k][20]."','".$nota[$k][21]."','".$nota[$k][22]."','".$nota[$k][23]."','".$nota[$k][24]."','".$nota[$k][25]."','".$nota[$k][26]."','".$nota[$k][27]."','".$nota[$k][28]."','".$nota[$k][29]."','".$nota[$k][30]."','".$nota[$k][31]."','".$nota[$k][32]."','".$nota[$k][33]."','".$nota[$k][34]."','".$nota[$k][35]."','".$nota[$k][36]."','".$nota[$k][37]."','$ulti','$ulti') ";
			@$conex->ExecSQL($mSQL,__LINE__,true);
		}
	}
}// Fin nuevos estudiantes

/***********************************/

?>
<table >
  <tr>
    <td>
	<?PHP include("encabezado.php"); ?>
	</td>
  </tr>
    <tr><td><?PHP include("datosdemateria.php"); ?></td></tr>
</table></td></tr>
    <tr>
    <td width="100%" height="88" class="datosp"><p align="center"><strong>BIENVENIDO!!</strong></p>

	<!-- <p style="text-align:justify;padding-left:100px;padding-right:100px;font-family:arial;font-size:12px;background-color:#FFFFCC;font-variant:normal;">
		<span style="font-weight:bold;color:#285da8;font-size:14px;">ATENCI&Oacute;N:</span><br><br>
	
	El <span style="font-weight:bold;">Sistema de Avance Acad&eacute;mico</span> ofrece nuevas funciones:
		<br><br>
	1.- <span style="font-weight:bold;">Modificaci&oacute;n de Calificaci&oacute;n General</span>: Esta funci&oacute;n permite modificar todas las calificaciones cargadas hasta el momento a trav&eacute;s de un mismo m&oacute;dulo. <em>Acceda a esta opci&oacute;n seleccion&aacute;ndola en el men&uacute;.</em>
	<br><br>
	2.- <span style="font-weight:bold;">Confirmar Cierre de Acta Final</span>: Esta funci&oacute;n permite cerrar el acta final de calificaciones cargadas en el lapso actual, solo estar&aacute; disponible al cargar el 100% de su avance acad&eacute;mico. <em>Acceda a esta opci&oacute;n seleccion&aacute;ndola en el men&uacute;.</em>
	<br><br>
	<span style="font-size:8pt;font-family: arial;">Si presenta alg&uacute;n inconveniente utilizando el sistema, por favor acuda a la Oficina Regional de Tecnolog&iacute;a y Servicios de Informaci&oacute;n ORTSI</span>

	</p> -->
<br>
    <p align="center" class="titulo"> A continuaci&oacute;n seleccione la operacion a realizar. </p></td>
  </tr>
  <tr>
    <td height="32" class="datosp"><br><br>
      <form name="form1" method="post" onsubmit="return validaropcion();" >
        <label>
          <select name="select" id="selectop" class="select.peq">
		  	<option value="0" selected="selected">&lt;&lt; Operaciones a realizar &gt;&gt;</option>
			<optgroup label="Cargas......................................................................">
			<option value="11">Cargar Plan de Evaluaci&oacute;n al Sistema</option>
			<option value="33">Agregar Calificaciones a los Estudiantes</option>
			<option value="55">Agregar Temas a Evaluar Adicionales</option>
			</optgroup>
			<optgroup label="Modificaciones........................................................">
			 <option value="66">Eliminar Temas a Evaluar</option>
			<option value="77">Modificar la Descripci&oacute;n de un Tema a Evaluar</option>
            <option value="88">Modificar el Porcentaje de un Tema a Evaluar</option>
			<option value="44">Modificar Calificacion Individual</option>
			<option value="1212">Modificar Calificacion General</option>
			</optgroup>
			<optgroup label="Visualizaciones.......................................................">
			<option value="22">Visualizar Datos Cargados al Sistema</option>
			<option value="99">Visualizar las Modificaciones Hechas Hasta la Fecha</option>
			</optgroup>
			<!-- <optgroup label="Actualizacion de matricula de estudiantes (Agregados)">
			<option value="1010">Ver si existen agregados</option>
			</optgroup> -->
			<optgroup label="Cierre de Acta: <?php echo $acta?> en el Lapso:  <?php echo $lapso?>">
			<option style="color:#FF0000;font-weight:bold" >Disponible hasta 21/10/2022 11:00 am</option>
			<option value="999" >Confirmar el Cierre del Acta</option>
			</optgroup>
          </select>
        </label>
        <p>
          <label>
          <input type="submit" name="Submit" value="Continuar" class="boton" >&nbsp;&nbsp;&nbsp;<input type="button" value="Salir" name="B1" class="boton" onclick="javascript:self.close();">
		  <input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  	  <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	      <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
          </label>
        </p>
      </form>
    </td>
  </tr>
</table>					 
<?php } // cuando se entra por primera vez al sistema
}else{?>
<table >
  <tr>
    <td width="100%" height="88" class="act"><?PHP include("encabezado.php"); ?></td>
  </tr>
<tr><td><?PHP include("datosdemateria.php"); ?></td></tr>
  <tr>
    <td height="40" class="datosp" colspan="8">
	<p align="center"><strong>POR SER PRIMERA VEZ QUE INGRESA AL SISTEMA, DEBE PRIMERO CARGAR LOS ALUMNOS A LA BASE DE DATOS</strong>
	</td>
</tr>
</table>
					<form name="form1" method="post" action="guardar.php" class="datosp">
					 <input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					 <input type="hidden" name="codigos" value="277">
					 <input type="submit" name="Cargar" value="Cargar alumnos" class="boton">
					 &nbsp;&nbsp;&nbsp;<input type="button" name="submit" value="Salir" class="boton" onclick="confirmasalir()">
					 </form>
<?php
// end of form 
}
?>
</html>