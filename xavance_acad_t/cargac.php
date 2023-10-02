<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Sistema de avance academico</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="StyleSheet" href="estilos.css" type="text/css"> 
<script language="javascript" src="funciones.js" type="text/javascript"></script>
<body onLoad="actualizaReloj()">
</head>

<?php
require_once('inc/config.php');
require_once("inc/odbcss_c.php");
require_once("guardar.php");
if($_SERVER['HTTP_REFERER']!=$raizDelSitio.'planilla_r.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'cante.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'guardar.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'introt.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'cargac.php') die ("<script languaje=\"javascript\"> alert('ACCESO PROHIBIDO!'); </script>");

//print_r($_POST);

$acta=$_POST['acta'];
$lapso=$_POST['lapso'];
$c_asigna=$_POST['c_asigna'];
$cantee=$_POST['cantee'];
$desicionss=$_POST['desicionss'];////
$cont=$_POST['cont'];
$conte=$_POST['conte'];
$desicions=$_POST['desicions'];//donde decidio si queria agregar calificaciones o no
$desicion3=$_POST['desicion3'];
$decision6=$_POST['decision6'];
//echo $decision6;
$codigo=$_POST['codigo'];
$trama=$_POST['trama'];
$porc= array();
$tema= array();
$nota= array();
for($i=1;$i<=$cantee;$i++)
	{
	$porc[$i]=$_POST['porc'.$i];
	}
for($i=1;$i<=$cantee;$i++)
	{
	$tema[$i]=$_POST['tema'.$i];
	}
$cantalu=$_POST['cantalu'];

for($i=1;$i<=$cantee;$i++)
	{
	for($j=0;$j<$cantalu;$j++)
		{
		$nota[$i][$j]=$_POST['nota'.$i.'-'.$j];
		}
	}


////////////////////////////////cargando alumnos de la base de datos
require_once("inc/odbcss_c.php");
$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);

///////////////////////////////soluciona cambios de seccion

# Selecciona exp_e que estan en N_ESTU y no estan en DACE006 (por cambio de seccion o eliminados)
$mSQL = "select EXP_E from N_ESTU where c_asigna='$c_asigna' and acta='$acta' and lapso='$lapso' ";
$mSQL.= "and EXP_E NOT IN(select EXP_E from dace006 where c_asigna='$c_asigna' and acta='$acta' and ";
$mSQL.= "lapso='$lapso' and (status = '7' or status = 'A' or status = '2' or status = 'R' or status = '6' ))";
 
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
#print_r($result);
$fil=count($result);
#echo $fil;
$z=0;
if ($fil > 0){
	for($k=0;$k<$fil;$k++){
		/*$mSQL  = "select acta from dace006 where c_asigna='$c_asigna' and lapso='$lapso' and EXP_E='".$result[$k][0]."'";
		$conex->ExecSQL($mSQL,__LINE__,true);
		$n_acta = $conex->result[0][0];*/
		
		$mSQL  = "delete from n_estu where acta='$acta' and c_asigna='$c_asigna' and lapso='$lapso' and EXP_E='".$result[$k][0]."'";
		$conex->ExecSQL($mSQL,__LINE__,true);
		
		if ($conex->fmodif == 1){
			$z++;		
		}
	}// Fin for
	//echo "filas modificadas: ".$z;
}

$mSQL  = "select a.EXP_E,b.apellidos||',  '||nombres,c.status from N_ESTU a,dace002 b, dace006 c where a.acta='$acta' and a.lapso='$lapso' and a.EXP_E=b.EXP_E and a.c_asigna='$c_asigna' and c.acta='$acta' and c.lapso='$lapso' and c.c_asigna='$c_asigna' and c.EXP_E=a.EXP_E order by b.apellidos asc";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
/*
for($i=0;$i<$cantalu;$i++)
	{
	echo $result[$i][1].'&nbsp;';
	for($j=1;$j<=$cantee;$j++)
		{
		echo $nota[$j][$i];
		}
	echo '<br>';
	}*/

///////////////////////////////////////////////////////////////////
$info=sacainfo($acta,$lapso,$c_asigna);
//echo $desicion6;
if($decision6 == "act")
		{
//echo "actualizar";
$respuestac=guardar_calificaciones($acta,$lapso,$c_asigna,$result,$nota,$cantalu,$cantee,$cantee,$porc);

$rmo = $_POST['razomoca'];
$esta_ann = "";
$esta_acn = "";
$exp_e = "";
$n_tm = $cantee;
guardar_modc($acta,$lapso,$c_asigna,$rmo,$esta_ann,$esta_acn,$exp_e,$n_tm)

			?>
					<form name="form2" method="post" action="" >
	 				<input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					 <input type="hidden" name="select" value="22">
					 <input type="hidden" name="Submit" value="1">
					 </form>
					 <script>
     				 document.form2.action='cante.php'; 
					 document.form2.submit(); 
					 alert('Se han modificado la evaluaciones');
            		</script>
	<?PHP
}


if (isset($_POST['submit']) || isset($_POST['desdecante']) || true) { ///////////////SI EL SUBMIT DE LA PAGINA CANTE.PHP FUE SETEADO
	
	if($desicionss=='si' || $desicions=='si') ///////////////SI SE QUERIA AGREGAR LOS TEMAS O AGREGAR EL SIGUIENTE TEMA
		{	
		
			if($codigo==22)
			{
			require_once("guardar.php");
			$resultado=con_ex_temas_car($acta,$lapso,$c_asigna);
			if($resultado!=NULL)
			{	
				$temp=ucca($acta,$lapso,$c_asigna);
				$cont=$temp[0][0];
				for($i=1;$i<=35;$i++) $tema[$i]=$resultado[0][$i];
				for($i=36,$j=1;$i<=70;$i++,$j++)	$porc[$j]=$resultado[0][$i];
			}
			$resultad=con_ex_ca_car($acta,$lapso,$c_asigna);
			$cantalu=0;
			while($resultad[$cantalu][0]!=NULL)
				{
				for($i=1;$i<=$cont;$i++) 
				{
				$nota[$i][$cantalu]=$resultad[$cantalu][$i];
				}
				$cantalu++;
				}	
			}
				
			if($cont<$cantee)///////////////SI SI EL CONTADOR DE TEMAS ES MENOR QUE LA CANTIDAD TOTAL DE TEMAS
			{
			$cont++;
			echo  '	<table ><tr><td>';
			include("encabezado.php");
			echo '</td></tr><tr><td>';
					include("datosdemateria.php");
			echo	'</td></tr>
  					<tr>
    				<td height="32" class="datosp" colspan="8" align="center">
					<form name="formnotas" method="post">
					<input type="hidden" name="cont" value="'.$cont.'">
					
					<input type="hidden" name="cantee" value="'.$cantee.'">';
					for($i=1;$i<$cont;$i++)
						{
						$cantalu=0;
						while($result[$cantalu][0]!=NULL)
							{
							echo '<input type="hidden" name="nota'.$i.'-'.$cantalu.'" value="'.$nota[$i][$cantalu].'">';
							$cantalu++;
							}
						}
					for($i=1;$i<=$cantee;$i++)
						{
						echo '<input type="hidden" name="porc'.$i.'" id="porc'.$i.'" value="'.$porc[$i].'">';
						}
					for($i=1;$i<=$cantee;$i++)
						{
						echo '<input type="hidden" name="tema'.$i.'" value="'.$tema[$i].'">';
						}
					
			 echo  '<table border="1" cellspacing="1" class="datotabla" align="center">
					<tr><th rowspan="3" colspan="4">COMENTARIOS DE TEMAS</th></tr>
					<tr><td align="center" ><strong>EVALUACION&nbsp;'.$cont.'</strong></td></tr>
					<tr><td align="center" width="200" >'.$tema[$cont].'</td></tr>
					<tr><td align="center"  colspan="4"><strong>PORCENTAJE</strong></td><td align="center" >'.$porc[$cont].'                    </td></tr>
					<tr><td align="center" ><strong>NUM.</strong></td><td align="center" ><strong>STATUS</strong></td><td align="center" width="300"><strong>ALUMNOS</strong></td><td align="center" ><strong>C.I</strong></td><td align="center"><strong>CALIFICACIONES</strong></td></tr>';
			echo '<script languaje="JavaScript">
     				 var porcentaje=parseInt('.$porc[$cont].');
            		</script>';	
				//recuerda obtener la longitud del vector
				$cantalu=0;
				$num=1;
			while($result[$cantalu][0]!=NULL)
				{
			echo '<tr><td><strong>'.$num.'</strong></td>';
			if($result[$cantalu][2]!=7){
			if($result[$cantalu][2]=='R') echo	'<td><strong>Ret. Reglam</strong></td>';
			if($result[$cantalu][2]=='A') echo	'<td><strong>Agregado</strong></td>';
			if($result[$cantalu][2]==2) echo	'<td><strong>Retirado</strong></td>';
			}
			else echo	'<td><strong></strong></td>';
		if($result[$cantalu][2]!='R' && $result[$cantalu][2]!=2){	echo '<td>'.$result[$cantalu][1].'</td><td>'.$result[$cantalu][0].'</td><td align="center"><input class="datospf" name="nota'.$cont.'-'.$cantalu.'" id="nota'.$cantalu.'" type="text" value="" size="5" maxlength="5" OnKeyUp="validarNumero(this);" onBlur="validarNota1(this); validarNumero(this);"><input type="hidden" id="activareritado'.$cantalu.'" value="0"></td></tr>';}
		
		if($result[$cantalu][2]=='R' || $result[$cantalu][2]==2){	echo '<td>'.$result[$cantalu][1].'</td><td>'.$result[$cantalu][0].'</td><td align="center"><input type="hidden" "nota'.$cont.'-'.$cantalu.'" id="nota'.$cantalu.'" value="0"><input type="hidden" id="activareritado'.$cantalu.'" value="1"></td></tr>';}
		
				$cantalu++;
				$num++;
				}	
				$cantalu=0;		
			while($result[$cantalu][0]!=NULL)
				{
			echo '<input type="hidden" name="exp_'.$cantalu.'" value="'.$result[$cantalu][0].'"><input type="hidden" name="nom_'.$cantalu.'" value="'.$result[$cantalu][1].'">';
				$cantalu++;
				}	
				echo '</table>
						<input type="hidden" name="nro" value="'.$cantalu.'">
						<input type="hidden" name="trama" value="">
						<input type="hidden" name="cantalu" value="'.$cantalu.'">
						 <input type="hidden" name="acta" value="'.$acta.'">
	  					 <input type="hidden" name="lapso" value="'.$lapso.'">
	 					 <input type="hidden" name="c_asigna" value="'.$c_asigna.'">
						<p>Elija una opcion para continuar:<br></p>
	  					<!--Agregar la siguiente calificacion&nbsp;<input name="desicionss" type="radio" value="si" class="datospf" checked><br>
	  					Guardar y salir&nbsp;<input type="radio" name="desicionss" value="no" class="datospf" ><br>
	  					Salir&nbsp;<input type="radio" name="desicionss" value="sa" class="datospf" >--><br>
						<input type="hidden" name="desicionss" value="">';						
						?><!--ghf-->
	<input type="button" Value="Continuar" name="continuar" onClick="validarcontinuarcargac();" class="boton">&nbsp;&nbsp;&nbsp;
	<input type="button" Value="Regresar" name="salirdesdecante" onClick="validaregresocargac();" class="boton">
						</form></td></tr></table> <?PHP
	
			}  /////// si se estan agregando las calificaciones   OnClick="notasOK()"
			else{///////////////SI YA SE AGREGARON todas las calificaciones
			echo  '	<table ><tr><td>';
			include("encabezado.php");
			echo '</td></tr><tr><td>';
					include("datosdemateria.php");
			echo	'</td></tr>
  					<tr>
    			<td height="32" class="datosp" colspan="8"><br><br><br>
				<form name="form" method="post">
				YA INTRODUJO TODAS LAS CALIFICACIONES<br><br><br><br>
				<p>Elija una opcion para continuar:<br></p>
				<!--Guardar y salir&nbsp;<input type="radio" name="desicion3" value="gs" class="datospf" checked><br>
	  			Salir&nbsp;<input type="radio" name="desicion3" value="sa" class="datospf">	--><br><br>
				<input type="hidden" name="cantalu" value="'.$cantalu.'">';
				for($i=1;$i<=$cont;$i++)
						{
						echo '<input type="hidden" name="porc'.$i.'" value="'.$porc[$i].'">';
						}
				for($i=1;$i<=$cont;$i++)
						{
						echo '<input type="hidden" name="tema'.$i.'" value="'.$tema[$i].'">';
						}
				for($i=1;$i<=$cont;$i++)
						{
						$cantalu=0;
						while($result[$cantalu][0]!=NULL)
							{
							echo '<input type="hidden" name="nota'.$i.'-'.$cantalu.'" value="'.$nota[$i][$cantalu].'">';
							$cantalu++;
							}
						}
				echo '<input type="hidden" name="codigo" value="030">
					 <input type="hidden" name="desicion3" value="">
					 <input type="hidden" name="acta" value="'.$acta.'">
	  				 <input type="hidden" name="lapso" value="'.$lapso.'">
	 				 <input type="hidden" name="c_asigna" value="'.$c_asigna.'">
					 <input type="hidden" name="cont" value="'.$cont.'">
					 <input type="hidden" name="cantee" value="'.$cantee.'">';
					 ?>	
	<!--<input type="submit" Value="Guardar" name="submit" onClick="document.form.action='cargac.php'; document.form.desicion3.value='gs';   document.form.submit();" class="boton">&nbsp;&nbsp;&nbsp;-->
	<input type="button" Value="Regresar" name="salirdesdecante" onClick="document.formsalir.action='cante.php'; document.formsalir.submit();" class="boton">
						</form></td></tr></table> 
						<?PHP
			
			} ///////si ya se agregaron todas las calificaciones
		}
	if($desicions=='no' || $desicionss=='no')
		{
		if($desicionss=='no')///////////////SI NO SE QUERIA AGREGAR la siguiente calificacion
			{
			///////cuando dijo que no a querer seguir con la siguiente calificacion
			//require_once("guardar.php");
			//$respuestat=guardar_temas($cantee,$acta,$lapso,$c_asigna,$tema,$porc,$cantee,$cantee);
			$respuestac=guardar_calificaciones_agregadas($acta,$lapso,$c_asigna,$result,$nota,$cantalu,$cont,$cont,$porc);
			?>
			<form name="form1" method="post" action="" >
	 				<input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
						<input type="hidden" name="cont" value="<?PHP echo $cont; ?>">
					<input type="hidden" name="cantee" value="<?PHP echo $cantee; ?>">
					<input type="hidden" name="cantalu" value="<?PHP echo $cantalu; ?>">
					<input type="hidden" name="desicionss" value="">				
			<?PHP	
					for($i=1;$i<=$cont;$i++)
						{
						$cantalu=0;
						while($result[$cantalu][0]!=NULL)
							{
							echo '<input type="hidden" name="nota'.$i.'-'.$cantalu.'" value="'.$nota[$i][$cantalu].'">';
							$cantalu++;
							}
						}
					for($i=1;$i<=$cantee;$i++)
						{
						echo '<input type="hidden" name="porc'.$i.'" value="'.$porc[$i].'">';
						}
					for($i=1;$i<=$cantee;$i++)
						{
						echo '<input type="hidden" name="tema'.$i.'" value="'.$tema[$i].'">';
						}
					 ?>					 
					 </form>
					  </form>
					<form name="form2" method="post" action="" >
	 				<input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					 </form>
			<?PHP		    
			if($trama!='regresarc')  echo "<script> document.form1.desicionss.value='si'; 
			document.form1.action='cargac.php';  document.form1.submit(); </script>";
			
			if($trama=='regresarc')  echo "<script> document.form2.action='cante.php'; 
			document.form2.submit(); </script>";
			}
		else
			{

				
			}
		}
	if($desicions=='sa' || $desicionss=='sa')
		{?>
		<body onLoad="document.form2.action='cante.php'; document.form2.submit();">
				<form name="form2" method="post" action="" >
	 				<input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					 </form>
		<?PHP
		/*echo '<table >
  				<tr>
    			<td width="893" height="88" class="act"><p align="center">Universidad Nfdgfdgfacional Experimxcxcxental Polit&eacute;cnica<br>
				"Antonio Jos&eacute; de Sucre"<br>
				Vicerrectorado Puerto Ordaz<br>
				Unidad Regional de Admisi&oacute;n y Control de Estudios</p>    </td>
  				</tr>
  				<tr>
  				<td height="22" class="enc_p">SISTEMA DE AVANCE ACADEMICO</td>
  				</tr>
  				<tr><td class="datosp">
					<br><br>
    				<p>No se guardaron los datos</p>
					<form name="form" method="post" action="cante.php">
					 <input type="hidden" name="acta" value="'.$acta.'">
	  				 <input type="hidden" name="lapso" value="'.$lapso.'">
	 				 <input type="hidden" name="c_asigna" value="'.$c_asigna.'">
					 <input type="submit" name="submit" value="Regresar" class="boton">
					</td>
  				</tr>
				</table>';*/
		}
	if($desicion3=='gs')
		{	
		require_once("guardar.php");

			$respuestat=guardar_temas($cantee,$acta,$lapso,$c_asigna,$tema,$porc,$cantee,$cantee);
			$respuestac=guardar_calificaciones($acta,$lapso,$c_asigna,$result,$nota,$cantalu,$cont,$cont);		
		?>
		<form name="form2" method="post" action="" >
	 				<input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					 </form>
			<script>
     				 document.form2.action='cante.php'; 
					 document.form2.submit(); 
					 alert('Se han guardado la cantidad evaluaciones');
            		</script>
		<?PHP	
		/*echo '<table >
  				<tr>
    			<td width="893" height="88" class="act"><p align="center">Universidad Nacional Experimental Polit&eacute;cnica<br>
				"Antonio Jos&eacute; de Sucre"<br>
				Vicerrectorado Puerto Ordaz<br>
				Unidad Regional de Admisi&oacute;n y Control de Estudios</p>    </td>
  				</tr>
  				<tr>
  				<td height="22" class="enc_p">SISTEMA DE AVANCE ACADEMICO</td>
  				</tr>
  				<tr><td class="datosp">
					<br><br>
    				<p>Se han guardado todas las calificaciones correctamente</p>
						<form name="form" method="post" action="cante.php">
					 <input type="hidden" name="acta" value="'.$acta.'">
	  				 <input type="hidden" name="lapso" value="'.$lapso.'">
	 				 <input type="hidden" name="c_asigna" value="'.$c_asigna.'">
					 <input type="submit" name="submit" value="Regresar" class="boton">
					</td>
  				</tr>
				</table>';*/
		}
	if($desicion3=='sa')
		{?>
		<body onLoad="document.form2.action='cante.php'; document.form2.submit();">
				<form name="form2" method="post" action="" >
	 				<input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					 </form>
		<?PHP
		/*echo '<table >
  				<tr>
    			<td width="893" height="88" class="act"><p align="center">Universxccxcxcxidad Nacional Experimental Polit&eacute;cnica<br>
				"Antonio Jos&eacute; de Sucre"<br>
				Vicerrectorado Puerto Ordaz<br>
				Unidad Regional de Admisi&oacute;n y Control de Estudios</p>    </td>
  				</tr>
  				<tr>
  				<td height="22" class="enc_p">SISTEMA DE AVANCE ACADEMICO</td>
  				</tr>
  				<tr><td class="datosp">
					<br><br>
    				<p>No se aguardaron los datos</p>
						<form name="form" method="post" action="cante.php">
					 <input type="hidden" name="acta" value="'.$acta.'">
	  				 <input type="hidden" name="lapso" value="'.$lapso.'">
	 				 <input type="hidden" name="c_asigna" value="'.$c_asigna.'">
					 <input type="submit" name="submit" value="Regresar" class="boton">
					</td>
  				</tr>
				</table>';*/
		}
		
}




?>

<form name="formsalir" method="post">
				<input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  			<input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	  			<input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
				</form>
</html>