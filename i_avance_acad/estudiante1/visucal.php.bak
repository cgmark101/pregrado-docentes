<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema de consulta de calificaciones</title>
<link rel="StyleSheet" href="estilos.css" type="text/css">

 
</head>

<?php
require_once('odbc/config.php');//este tambien esta agregado en cada funcion
require_once("odbc/odbcss_c.php");
require_once("odbc/guardar.php");

$exp_e=$_POST['exp_e'];
$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$LBT);
$mSQL  = "select apellidos||', '||nombres,ci_e from dace002 where exp_e='$exp_e'";
$conex->ExecSQL($mSQL,__LINE__,true);
$estu = $conex->result;
$mSQL  = "select a.acta,a.seccion,b.c_asigna,c.asignatura,b.ci,d.apellido||', '||nombre  from dace006 a,tblaca004 b,tblaca008 c,tblaca007 d  where b.acta=a.acta and b.c_asigna=b.c_asigna and b.lapso='$lapsoProceso' and a.lapso='$lapsoProceso' and a.exp_e='$exp_e' and c.c_asigna=b.c_asigna and a.acta=b.acta and a.seccion=b.seccion and b.ci=d.ci";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
$cantalu=0;
echo '<table width="1000" >
  <tr><td align="center" >
  <table width="100%" align="center"><tr>
    <td width="100%" height="88" align="center">';
	include("odbc/encabezado.php");
	echo'</td></tr><tr><td>';
	echo '<hr>';
	include("odbc/datosestudiante.php");
	//print_r($conex->result);
	echo '<hr></td></tr><tr><td width="100%"><p align="center"><strong>CALIFICACIONES</strong></p>';
	
while($result[$cantalu][0]!=NULL)
				{
				$activasta=comprov($result[$cantalu][0],$lapsoProceso,$result[$cantalu][2]);
				$datos=sacanotasindi($result[$cantalu][0],$lapsoProceso,$result[$cantalu][2],$exp_e);
				$fechas=sacafecha($result[$cantalu][0],$lapsoProceso,$result[$cantalu][2]);
				$porc= array();
				$tema= array();
				$resultado=con_ex_temas_car($result[$cantalu][0],$lapsoProceso,$result[$cantalu][2]);
				if($resultado!=NULL)
					{	
					$cantee=$resultado[0][0];
					for($i=1;$i<=35;$i++) $tema[$i]=$resultado[0][$i];
					for($i=36,$j=1;$i<=70;$i++,$j++)	$porc[$j]=$resultado[0][$i];
					}	
					
				echo '<table class="datotabla"><tr><td width="100%">';
				include("odbc/datosdemateria.php");				
				echo '</td></tr>
						<tr>
						<td align="center" >
					<table border="1" cellspacing="1" class="datotabla">
					<tr><th rowspan="3" colspan="3">COMENTARIOS DE TEMAS</th></tr>
					<tr>';
					
					for($i=1;$i<=$cantee;$i++) echo'<td align="center" ><strong>EVALUACION&nbsp;'.$i.'</strong></td>';
					
	echo			'</tr>
					<tr>';
					
					for($i=1;$i<=$cantee;$i++) echo'<td align="center" width="200">'.$tema[$i].'</td>';
					
					echo'<td align="center" width="80" ><strong>TOTAL 100</strong></td><td align="center" width="80" ><strong>TOTAL 9</strong></td>';
					
	echo			'</tr>
					<tr>					
					<td align="center"  colspan="3"><strong>PORCENTAJES</strong></td>';
					
					for($i=1;$i<=$cantee;$i++) echo'<td align="center" >'.$porc[$i].'</td>';
					echo'<td align="center" width="80" ><strong>100%</strong></td><td align="center" width="80" ><strong>9</strong></td>';
					
	echo            '</tr>
					<tr><td align="center"><strong>STATUS</strong></td><td align="center" width="250"><strong>ALUMNO</strong></td><td align="center" ><strong>C.I</strong></td></tr>';
					
				//recuerda obtener la longitud del vector
			
			
			if($datos[0][0]!=NULL){	
				$cantalu=0;
				$num=1;
			while($datos[$cantalu][0]!=NULL)
				{
			echo '<tr>';
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
			echo '<tr><td colspan="3"><strong>FECHAS DE CARGA</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.implode("/",array_reverse(explode("-",$fechas[0][$i]))).'</td>';
				echo '</tr>';
				echo '</table>';
				echo '</td></tr>';
				echo '</table>';}				
				$cantalu++;
				echo '<hr>';
				}
?>
</td></tr><tr><td align="center" colspan="38">

          <input type="button" name="imprimir" value="Imprimir" class="boton" style="background:#FFFF33; color:black; font-family:arial; font-weight:bold;" onclick="window.print();">&nbsp;&nbsp;&nbsp;<input type="button" value="Salir" name="B1" class="boton" onclick="javascript:self.close();">

    </td>
  </tr></table></td></tr></table>
<body>

</body>
</html>
