
<?php

include_once('inc/vImage.php');
include_once('inc/odbcss_c.php');
include_once ('inc/config.php');
include_once ('inc/activaerror.php');

print <<<ESTILO



ESTILO;



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<?php echo "<script src='codethatcalendar.js' type='text/javascript'></script>" ?>
<?php echo "<script src='{$raizDelSitio}/inscni.js' type='text/javascript'></script>" ?>

  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
<?php
print $noCache; 
print $noJavaScript; 
?>

<script language="javascript1.2">
<!--
var caldef1 =
{
	firstday : 0,
	dtype : 'yyyy-MM-dd',
	width : 275,
	windoww : 300,
	windowh : 200,
	border_width : 0,
	border_color : 'White',
	multi : true,
	spr : '\r\n',
	dn_css : 'clsDayName',
	cd_css : 'clsCurrentDay',
	tw_css : 'clsCurrentWeek',
	wd_css : 'clsWorkDay',
	we_css : 'clsWeekEnd',
	wdom_css : 'clsWorkDayOtherMonth',
	weom_css : 'clsWeekEndOtherMonth',
	wdomcw_css : 'clsWorkDayOthMonthCurWeek',
	weomcw_css : 'clsWeekEndOthMonthCurWeek',
	wecd_css : 'clsWeekEndCurDay',
	wecw_css : 'clsWeekEndCurWeek',
	preview_css : 'clsPreview',
	highlight_css : 'clsHighLight',
	headerstyle :
	{
		type : 'buttons',
		css : 'clsDayName',
		imgnextm : 'img/next.gif',
		imgprevm : 'img/prev.gif',
		imgnexty : 'img/next_year.gif',
		imgprevy : 'img/prev_year.gif'
	},
	imgapply : 'img/apply.gif',
	preview : true,
	monthnames : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
		'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	daynames : ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
	txt : ['Año Anterior', 'Mes Anterior', 'Mes Siguiente', 'Año Siguiente', 'Aceptar']
};
var c1 = new CodeThatCalendar(caldef1); 
//-->
</script>

<style type="text/css">
<!--
#prueba {
  overflow:hidden;
  color:#00FFFF;
  background:#F7F7F7;
}

.titulo {
  text-align: center; 
  font-family:Arial; 
  font-size: 13px; 
  font-weight: normal;
  margin-top:0;
  margin-bottom:0;	
}
.tit14 {
  text-align: center; 
  font-family: Arial; 
  font-size: 13px; 
  font-weight: bold;
  letter-spacing: 1px;
  font-variant: small-caps;
}
.tit15 {
  text-align: left; 
  font-family: Arial; 
  font-size: 13px; 
  font-weight: bold;
  letter-spacing: 1px;
  font-variant: small-caps;
}
.instruc {
  font-family:Arial; 
  font-size: 12px; 
  font-weight: normal;
  background-color: #FFFFCC;
}
.datosp {
  text-align: left; 
  font-family:Arial; 
  font-size: 11px;
  font-weight: normal;
  background-color:#D2DEF0; 
  font-variant: small-caps;
}
.datosp2 {
  text-align: left; 
  font-family:Arial; 
  font-size: 12px;
  font-weight: bold;
  background-color:#F0F0F0; 
  font-variant: small-caps;
}
.boton {
  text-align: center; 
  font-family:Arial; 
  font-size: 14px;
  font-weight: normal;
  background-color:#e0e0e0; 
  font-variant: small-caps;
  height: 20px;
  width: 80px;
  padding: 0px;
}
.enc_p {
  color:#FFFFFF;
  text-align: center; 
  font-family:Helvetica; 
  font-size: 11px; 
  font-weight: normal;
  background-color:#3366CC;
  height:20px;
  font-variant: small-caps;
}
.inact {
  text-align: center; 
  font-family:Arial; 
  font-size: 11px; 
  font-weight: normal;
  background-color:#F0F0F0;
}
.act { 
  text-align: center; 
  font-family:Arial; 
  font-size: 11px; 
  font-weight: normal;
  background-color:#99CCFF;
}

DIV.peq {
   font-family: Arial;
   font-size: 9px;
   z-index: -1;
}
select.peq {
   font-family: Arial;
   font-size: 8px;
   z-index: -1;
   height: 11px;
   border-width: 1px;
   padding: 0px;
   width: 84px;
}
.datospf {
  text-align: left; 
  font-family:Arial; 
  font-size: 11px;
  font-weight: normal;
  background-color:#FFFFFF; 
  font-variant: small-caps;
  border-style: solid;
  border-width: 1px;
  border-color: #96BBF3;
  text-transform:uppercase;
}
.boton {
  text-align: center; 
  font-family:Arial; 
  font-size: 11px;
  font-weight: normal;
  background-color:#e0e0e0; 
  font-variant: small-caps;
  height: 20px;
  padding: 0px;
}

-->
</style>

<title><?php echo $tProceso?> > Hijos</title>


</head>
<body>

<?php
if(isset($_GET["hijos"])) {
	$hijos = $_GET["hijos"];
	$padre = $_GET["padre"];?>

<form name="datos_h" method="POST" action="registrarh.php">
	<?for ($i=1;$i<=$hijos;$i++){
		?>
		<TABLE id="datos_hijos" align="center" border="0" cellpadding="0" cellspacing="1" 
		 width="740" style="border-collapse:collapse;border-color: white; border-style:solid; background:#D2DEF0;">
		<BR><div class="tit14" style="text-align:center;">
			Hijo <?print $i ?> Datos Personales:
			<span class="titulo" style="color:gray; font-variant:normal;">
			(Coloque sus datos completos, tal y como 
			aparecen en su C&eacute;dula de Identidad.)</span>
		</div>
				<tr>
					<td class="datosp" style="width: 70px">
						Cedula
					</td>
					<td class="datosp" style="width: 160px">
						Nombres
					</td>
					<td class="datosp" style="width: 160px">
						Apellidos
					</td>
					
				</tr>
				<?
				
				//CONSULTA DE DATOS ALMACENADOS
				$h=array();
				reset($h);
				$Ccon = new ODBC_Conn("FDOCENTE","C","C");
				$mSQL = "select CI,APELLIDOS,NOMBRES,F_NAC,ESTUDIO,NIVEL ";
				$mSQL= $mSQL."from DHIJOS ";
				$mSQL= $mSQL."where CI_P='$padre' and NUM='$i'";
				$Ccon->ExecSQL($mSQL);
				$hij=$Ccon->result;
				foreach($hij as $h){}
				
				print "<tr>";
					if(isset($h[0])) {
						print "<td><div><input name='" . "cedula_" . $i ."' class=\"datospf\" style='width: 70px;' maxlength='8' onKeyUp=\"validarN(this);\" value='$h[0]'><INPUT TYPE='hidden' NAME='update' value='SI'></div></td>";
					}
					else{
						print "<td><div><input name='" . "cedula_" . $i ."' class=\"datospf\" style='width: 70px;' maxlength='8' onKeyUp=\"validarN(this);\"><INPUT TYPE='hidden' NAME='update' value='NO'></div></td>";
					}
					if(isset($h[2])) {
						print "<td><div><input name='" . "nombres_" . $i ."' class=\"datospf\" style='width: 250px;' OnKeyUp='validarL(this);' alt='Nombres' value='$h[2]'></div></td>";
					}
					else{
						print "<td><div><input name='" . "nombres_" . $i ."' class=\"datospf\" style='width: 250px;' OnKeyUp='validarL(this);' alt='Nombres'></div></td>";
					}
					if(isset($h[1])) {
						print "<td><div><input name='" . "apellidos_" . $i ."' class=\"datospf\" style='width: 250px;' OnKeyUp='validarL(this);' alt='Apellidos' value='$h[1]'></div></td>";
					}
					else{
						print "<td><div><input name='" . "apellidos_" . $i ."' class=\"datospf\" style='width: 250px;' OnKeyUp='validarL(this);' alt='Apellidos'></div></td>";
					}
				print "</tr>";
				
				print "<tr>";

					print "<td class='datosp' style='width: 120px'>Fecha de Nacimiento</td> ";
					print "<td class='datosp' style='width: 70px'>Nivel de Estudio</td> ";
					print "<td class='datosp' style='width: 70px'>Grado / Año / Semestre</td> ";
						
				print "</tr>";
				
				print "<tr>";
					if(isset($h[3])) {
						print "<td><div><input name='" . "fnac_" . $i ."' class=\"datospf\" style='width: 60px;' onClick=\"c1.popup('" . "fnac_" . $i ."');\" readonly=\"readonly\" value='$h[3]'>&nbsp;&nbsp;<IMG SRC=\"Builder/img/cal.gif\" WIDTH=\"16\" HEIGHT=\"16\" BORDER=\"0\" onClick=\"c1.popup('" . "fnac_" . $i ."');\"></div></td>";
					}
					else{
						print "<td><div><input name='" . "fnac_" . $i ."' class=\"datospf\" style='width: 60px;' onClick=\"c1.popup('" . "fnac_" . $i ."');\" readonly=\"readonly\">&nbsp;&nbsp;<IMG SRC=\"Builder/img/cal.gif\" WIDTH=\"16\" HEIGHT=\"16\" BORDER=\"0\" onClick=\"c1.popup('" . "fnac_" . $i ."');\"></div></td>";					
					}
					if(isset($h[4])) {
						print "<td><div><select name='" . "estudio_" . $i ."'  class=\"datospf\" style='width: 95px;'>";
						print "<option value='$h[4]'>$h[4]</option>";
						print "<option value='NINGUNO'>NINGUNO</option>";
						print "<option value='PREESCOLAR'>PREESCOLAR</option>";
						print "<option value='PRIMARIA'>PRIMARIA</option>";
						print "<option value='SECUNDARIA'>SECUNDARIA</option>";
						print "<option value='SUPERIOR'>SUPERIOR</option>";
						print "</div></td>";
					}
					else {
						print "<td><div><select name='" . "estudio_" . $i ."' class=\"datospf\" style='width: 95px;'>";
						print "<option value=''>-SELECCIONE-</option>";
						print "<option value='NINGUNO'>NINGUNO</option>";
						print "<option value='PREESCOLAR'>PREESCOLAR</option>";
						print "<option value='PRIMARIA'>PRIMARIA</option>";
						print "<option value='SECUNDARIA'>SECUNDARIA</option>";
						print "<option value='SUPERIOR'>SUPERIOR</option>";
						print "</div></td>";
					}
					if(isset($h[5])) {
						print "<td><div><select name='" . "nivel_" . $i ."' class=\"datospf\" style='width: 50px;'>";
						print "<option value='$h[5]'>$h[5]</option>";
						print "<option value='1'>1</option>";
						print "<option value='2'>2</option>";
						print "<option value='3'>3</option>";
						print "<option value='4'>4</option>";
						print "<option value='5'>5</option>";
						print "<option value='6'>6</option>";
						print "<option value='7'>7</option>";
						print "<option value='8'>8</option>";
						print "<option value='9'>9</option>";
						print "<option value='10'>10</option>";
						print "</div></td>";
					}
					else {
						print "<td><div><select name='" . "nivel_" . $i ."' class=\"datospf\" style='width: 50px;'>";
						print "<option value=''>-SEL-</option>";
						print "<option value='1'>1</option>";
						print "<option value='2'>2</option>";
						print "<option value='3'>3</option>";
						print "<option value='4'>4</option>";
						print "<option value='5'>5</option>";
						print "<option value='6'>6</option>";
						print "<option value='7'>7</option>";
						print "<option value='8'>8</option>";
						print "<option value='9'>9</option>";
						print "<option value='10'>10</option>";
						print "</div></td>";
					}
				print "</tr>";
				?>
				<tr>
					<td colspan="5" class="datosp2">
						Si no posee cedula ingrese el valor cero (0) en el campo cedula
					</td>
				</tr>
			</TABLE>
<BR>
		<?
	}
}
else
	print "no hay valor";
?>
<TABLE align="center">
<TR>
	<td style="width: 300px;">
	<p align="center"><BR>
		<input type="button" value="Cerrar" name="cerrar" class="boton" onclick="javascript:self.close();"></p> 
    </td>
	<td style="width: 300px;">
	<p align="center"><BR>
		<input type="reset" value="Reiniciar" name="reiniciar" class="boton"></p> 
    </td>
	<td style="width: 300px;">
	<p align="center"><BR>
		<INPUT TYPE="submit" value="Procesar" name="cargar" class="boton"></p>
	</td>
</TR>
</TABLE>
<? print "<INPUT TYPE='hidden' name='padre' value='$padre'>";
   print "<INPUT TYPE='hidden' name='hijos' value='$hijos'>";
?>

</form>
</body>
</html>