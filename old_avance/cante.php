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
$mSQL  = "SELECT c_asigna FROM tblaca004 WHERE acta='".$acta."' AND lapso='".$lapso."' ";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
#resultado de la busqueda
//echo $result[0][0];
#asignamos a la variable el resultado
$c_asigna=$result[0][0];

$resultado=con_ex_temas_car($acta,$lapso,$c_asigna);

if($_SERVER['HTTP_REFERER']!=$raizDelSitio.'planilla_r.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'cante.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'guardar.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'introt.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'cargac.php') die ("<script languaje=\"javascript\"> alert('ACCESO PROHIBIDO!'); </script>");

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
				echo '<p>Y YA INTRODUJO LAS CALIFICACIONES DE &nbsp;'.$ban[0][0].' &nbsp;TEMA(S)</p><br><br><br><br><input type="hidden" name="codigo" value="022">'; ?>
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
	<p>YA INTRODUJO LAS CALIFICACIONES DE &nbsp;<?PHP echo $resultado[0][0]; ?> &nbsp;TEMA(S)</p><br><br><br><br>	
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
$mSQL  = "select a.EXP_E,b.apellidos||',  '||nombres from N_ESTU a,dace002 b where a.acta='$acta' and a.lapso='$lapso' and a.EXP_E=b.EXP_E order by b.apellidos asc";
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
          <select name="selecta" id="selecta" class="datospf" OnChange="modifical(<?PHP echo $acta.",".$lapsos[0].",".$lapsos[1].",".$c_asigna; ?>);">
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
	  
          <select name="selectne" id="selectne" class="datospf" OnChange="modifical(<?PHP echo $acta.",".$lapsos[0].",".$lapsos[1].",".$c_asigna; ?>);">
            <option value="" selected="selected">&lt;&lt; Calificaciones &gt;&gt;</option>
            <?PHP for($i=1;$i<=$ucca[0][0];$i++) echo '<option value="'.$i.'">Evaluacion&nbsp;'.$i.'</option>'; ?>
          </select>
          </label></p></td></tr>
		<tr><td colspan="8">
		  <div id="temas"></div></td></tr>
	  <tr><td class="datosp" colspan="3"><p>Escriba el nuevo valor:</td><td class="datosp" colspan="5">
		<input name="nc" type="text" value="" size="5" maxlength="5" class="datospf" OnKeyUp="validarNumero(this); validarNota1(this);">%</p></td></tr><tr> <td height="32" class="datosp" colspan="3">
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
	<p>Seleccione la evaluacion a domificar: </td><td class="datosp" colspan="5">
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
	<p>Selecciones El tema a domificar: </td><td class="datosp" colspan="5">
	<label>
<select name="selecta" class="datospf" OnChange="fajax('guardar.php','temas','codigos=234&valor='+this.value+'&acta=<?PHP echo $acta; ?>&lapso=<?PHP echo $lapso; ?>&c_asigna=<?PHP echo $c_asigna; ?>','post','0');">
             <option value="" selected="selected">&lt;&lt; Evaluaciones a modificar &gt;&gt;</option>
            <?PHP for($i=1;$i<=$cantee[0][0];$i++) 
			{
			if($i>$ucca[0][0])   echo '<option value="'.$i.'">Evaluacion&nbsp;'.$i.'</option>'; 
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
	<p>Los datos que se encuentran en el sistema sosn los siguientes:</p>
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
	while($modn[$cont][4]!=NULL){
	$mSQL  = "select apellidos||',  '||nombres from dace002 where EXP_E='".$modn[$cont][4]."'";
	$conex->ExecSQL($mSQL,__LINE__,true);
	$result = $conex->result;
	echo '<u>Nombre de alumno</u> :&nbsp;'.$result[0][0].'&nbsp;&nbsp;&nbsp;<u>C.I</u>:&nbsp;&nbsp;'.$modn[$cont][4].'<br>';
	echo '<u>Razon de el cambio</u> :&nbsp;'.$modn[$cont][0].'<br>';
	echo '<u>Calificacion original</u> :&nbsp;'.$modn[$cont][1].'<br>';
	echo '<u>Calificacion modificada</u> :&nbsp;'.$modn[$cont][2].'<br>';
	echo '<u>Se realizo en la evaluacion Nro</u> :&nbsp;'.$modn[$cont][3].'<br>';
	echo '<u>Fecha de modificacion</u> :&nbsp;'.implode("/",array_reverse(explode("-",$modn[$cont][5]))).'<br>';
	echo '<hr size="1">';
	$cont++;
	}
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
default:
//error
break;
}
			
} else { ///////////////////PRINCIPIO DE EL SISTEMA/////////////////////////////////////////////////////////////////////////
//require_once("guardar.php");
$info=sacainfo($acta,$lapso,$c_asigna);

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
    <p align="center" class="titulo"> A continuaci&oacute;n seleccione la operacion a realizar. </p></td>
  </tr>
  <tr>
    <td height="32" class="datosp"><br><br>
      <form name="form1" method="post" onsubmit="return validaropcion();" >
        <label>
          <select name="select" id="selectop" class="select.peq">
		  	<option value="0" selected="selected">&lt;&lt; Operaciones a realizar &gt;&gt;</option>
			<optgroup label="Cargas......................................................................">
			<option value="11">Cargar Plan de evaluacion al sistema</option>
			<option value="33">Agregar calificaciones de estudiantes</option>
			<option value="55">Agregar temas a evaluar adicionales</option>
			</optgroup>
			<optgroup label="Modificaciones........................................................">
			 <option value="66">Eliminar temas a evaluar</option>
			<option value="77">Modificar la descripcion de un tema a evaluar</option>
            <option value="88">Modificar el porcentaje de un tema a evaluar</option>
			<option value="44">Modificacion la calificacion de un estudiante</option>
			</optgroup>
			<optgroup label="Visualizaciones.......................................................">
			<option value="22">Visualizar datos cargados al sistema</option>
			<option value="99">Visualizar las modificaciones hechas hasta la fecha</option>
			</optgroup>
			<optgroup label="Actualizacion de matricula de estudiantes (Agregados)">
			<option value="1010">Ver si existen agregados</option>
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