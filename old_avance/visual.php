<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Sistema de avance academico</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="StyleSheet" href="estilos.css" type="text/css"> 
<script language="javascript" src="asrequest.js" type="text/javascript"></script>
<script language="javascript" src="funciones.js" type="text/javascript"></script>
<body onLoad="actualizaReloj()">

<?PHP
require_once('inc/config.php');
require_once("inc/odbcss_c.php");
require_once("guardar.php");

if($_SERVER['HTTP_REFERER']!=$raizDelSitio.'planilla_r.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'cante.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'guardar.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'introt.php' && $_SERVER['HTTP_REFERER']!=$raizDelSitio.'cargac.php') die ("<script languaje=\"javascript\"> alert('ACCESO PROHIBIDO!'); </script>");
$nombre=$_POST['nombre'];

?>

<table >
  <tr>
    <td>
	<table border="0" width="100%">
		<tr>
		<td width="125">
		<p align="right" style="margin-top: 0; margin-bottom: 0">
		<img border="0" src="imagenes/unex15.gif" 
		     width="50" height="50"></p></td>
		<td width="500">
		<p class="titulo">
		Universidad Nacional Experimental Polit&eacute;cnica</p>
		<p class="titulo">
		Vicerrectorado Puerto Ordaz</font></p>

		<p class="titulo">
		Unidad Regional de Admisi&oacute;n y Control de Estudios</font></td>
		<td width="125">&nbsp;</td>
		</tr><tr><td colspan="3" style="background-color:#99CCFF;">
		<font style="font-size:2px;">&nbsp; </font></td></tr>
	    </table>	
			</tr>
			<tr>
				<td class="enc_p" colspan="2">SISTEMA DE AVANCE ACADEMICO</td>
			</tr>
	</td>
  </tr>
</td></tr>
<tr>
    <td width="100%" class="datosp">
	<p align="center"><strong><? echo $nombre; ?></strong></p>
	</td>
  </tr>
    <tr>
    <td width="100%" height="88" class="datosp"><p align="center"><strong>BIENVENIDO!!</strong></p>
    <p align="center" class="titulo">Se encuentra en el modulo de visualizacion de actas</p><br><p align="center" class="titulo"> A continuaci&oacute;n se muestra el listado de Docentes que han cargado avance acad&eacute;mico. </p>
	</td>
  </tr>
  <tr>
    <td height="32" class="datosp" align="left">	
<?PHP
$cargo=$_POST['cargo'];
$cedula=$_POST['cedula'];
if($cargo==7 || $cargo==17 || $cargo==91 || $cargo==81) $cod=123;
if($cargo==21) 
	{
	$car=4;
	$cod=124;
	}
if($cargo==31) 
	{
	$car=2;
	$cod=124;
	}
if($cargo==41) 
	{
	$car=5;
	$cod=124;
	}
if($cargo==51) 
	{
	$car=3;
	$cod=124;
	}
if($cargo==61) 
	{
	$car=6;
	$cod=124;
	}
if($cargo==71) 
	{
	$car=1;
	$cod=124;
	}

if($cod==123){

?><br>
<select name="selectca" id="selectca" class="select.peq" OnChange="fajax('guardar.php','materias','codigos=112232&carrera='+this.value+'','post','0');">
            <option value="" selected="selected">&lt;&lt; Especialidad &gt;&gt;</option>
			<option value="1" > Estudios Generales </option>
			<option value="2" > Electrica </option>
			<option value="3" > Electronica </option>
			<option value="4" > Mecanica </option>
			<option value="5" > Metalurgica </option>
			<option value="6" > Industrial </option>
          </select><br><br>
<div id="materias"></div>
<?PHP
}
?>	
<?PHP
if($cod==124){
$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,'consultas.log');

$aSQL = "select acta,c_asigna,lapso from D_TEMAS where C_ASIGNA like ";

switch ($car) {
	case 1:
		$aSQL.= "'30%'";
		break;
	case 2:
		$aSQL.= "'31%'";
		break;
	case 3:
		$aSQL.= "'35%'";
		break;
	case 4:
		$aSQL.= "'32%'";
		break;
	case 5:
		$aSQL.= "'33%'";
		break;
	case 6:
		$aSQL.= "'34%'";
		break;
}

$conex->ExecSQL($aSQL,__LINE__,true);
$resultado = $conex->result;

			$mSQL = "SELECT distinct c.asignatura,a.c_asigna,b.pensum ";
			$mSQL.= "FROM tblaca004 a,tblaca009 b,tblaca008 c ";
			$mSQL.= "WHERE a.c_asigna like ";

			switch ($car) {
				case 1:
					$mSQL.= "'30%' AND a.c_asigna in (SELECT c_asigna FROM D_TEMAS WHERE c_asigna like '30%') ";
					break;
				case 2:
					$mSQL.= "'31%' AND a.c_asigna in (SELECT c_asigna FROM D_TEMAS WHERE c_asigna like '31%') ";
					break;
				case 3:
					$mSQL.= "'35%' AND a.c_asigna in (SELECT c_asigna FROM D_TEMAS WHERE c_asigna like '35%') ";
					break;
				case 4:
					$mSQL.= "'32%' AND a.c_asigna in (SELECT c_asigna FROM D_TEMAS WHERE c_asigna like '32%') ";
				case 5:
					$mSQL.= "'33%' AND a.c_asigna in (SELECT c_asigna FROM D_TEMAS WHERE c_asigna like '33%') ";
					break;
				case 6:
					$mSQL.= "'34%' AND a.c_asigna in (SELECT c_asigna FROM D_TEMAS WHERE c_asigna like '34%') ";
					break;
			}

			$mSQL.= "and b.pensum='5' and c.c_asigna=a.c_asigna order by c.asignatura asc";

			
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;

if (count($resultado) > 0){
print <<<TABLA01
		<table cellpadding="0" cellspacing="0" border="1" width="100%" style="background-color:#FFFFFF;">
		<tr style="font-weight:bold;">
			<td>ACTA</td>
			<td>CI</td>
			<td>NOMBRE</td>
			<td>ASIGNATURA</td>
			<td>SECCION</td>
			<td>FECHA</td>
		</tr>
TABLA01;

//print_r($resultado);

for ($i=0;$i < count($resultado);$i++){
	$dSQL = "select distinct a.ci,apellido,nombre,asignatura,seccion,a.acta ";
	$dSQL.= "from TBLACA004 a, TBLACA007 b, TBLACA008 c, D_TEMAS d ";
	$dSQL.= "where a.ACTA='".$resultado[$i][0]."' and a.LAPSO='".$resultado[$i][2]."' ";
	$dSQL.= "and c.C_ASIGNA='".$resultado[$i][1]."' and a.CI=b.CI ";
	$conex->ExecSQL($dSQL,__LINE__,true);

print <<<TABLA02
		<tr>
			<td>{$conex->result[0][5]}</td>
			<td>{$conex->result[0][0]}</td>
			<td style="text-align:justify;padding-left:10px;">{$conex->result[0][1]}, {$conex->result[0][2]}</td>
			<td style="text-align:justify;padding-left:10px;">{$conex->result[0][3]}</td>
			<td>{$conex->result[0][4]}</td>
			<td>FECHA</td>
		</tr>
TABLA02;

	//echo $conex->result[0][0]." ".$conex->result[0][1]." ".$conex->result[0][2]."<br>";
	//echo $result[$i][0]."-".$result[$i][1]."-".$result[$i][2]."<br>";

}// Fin for

print <<<TABLA03
		</table>
TABLA03;

?>
<br>
<select name="selectma" id="selectma" class="select.peq" OnChange="fajax('guardar.php','ttt','codigos=112233&c_asigna='+this.value+'','post','0');">
            <option value="" selected="selected">&lt;&lt; Seleccione la asignatura que desee consultar &gt;&gt;</option>
			<?PHP 
			$cantalu=0;
			while($result[$cantalu][0]!=NULL)
				{
				echo '<option value="'.$result[$cantalu][1].'">'.$result[$cantalu][0].'</option>'; 
				$cantalu++;
				} 
			?>
          </select><br><br>
		  
<div id="ttt"> </div>

<?PHP
	}else{
		print <<<TABLA01
		<table cellpadding="0" cellspacing="0" border="1" width="100%">
		<tr>
			<td style="background-color:#FFFFFF;font-weight:bold;">
			NO HAY AVANCES ACAD&Eacute;MICOS CARGADOS EN ESTE DEPARTAMENTO.
			</td>
		</tr>
		</table>
TABLA01;

	}// Fin no hay avances cargados
}
?>	
  </td>
  </tr>
  <tr><td class="datosp">
  <div id="visual"></div>
  </td>
  </tr>
  <tr><td class="datosp">
  
          <input type="button" name="imprimir" value="Imprimir" class="boton" style="background:#FFFF33; color:black; font-family:arial; font-weight:bold;" onclick="window.print();">
		  &nbsp;&nbsp;&nbsp;<input type="button" value="Salir" name="B1" class="boton" onclick="self.close();">

    </td>
  </tr>
</table>
</body>
</html>
