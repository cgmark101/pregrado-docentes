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
	txt : ['A�o Anterior', 'Mes Anterior', 'Mes Siguiente', 'A�o Siguiente', 'Aceptar']
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

<title><?php echo $tProceso?> > Cursos Realizados</title>


</head>
<body>

<?
if(isset($_GET["cursos"])) {
	$cursos = $_GET["cursos"];
	$doc = $_GET["doc"];?>

<form name="datos_cursos" method="POST" action="registrarcursos.php">
	<?for ($i=1;$i<=$cursos;$i++){
		?>
		<TABLE id="datos_postg" align="center" border="0" cellpadding="0" cellspacing="1" 
		 width="600" style="border-collapse:collapse;border-color: white; border-style:solid; background:#D2DEF0;">
		<BR><div class="tit14" style="text-align:center;">
			Curso <?print $i ?> Datos Generales:
			<span class="titulo" style="color:gray; font-variant:normal;">
			(Coloque los datos completos en todos los campos.)</span>
		</div>
				<tr>
					<td class="datosp" style="width: 60px" colspan="2">
						Instituci&oacute;n:
					</td>
				</tr>
				<?
				//CONSULTA DE DATOS ALMACENADOS
				$c=array();
				reset($c);
				//CONSULTA DE DATOS ALMACENADOS
				$Ccon = new ODBC_Conn("FDOCENTE","C","C");
				$mSQL = "select INSTITUTO,NOMBRE,CIUDAD,PAIS,HORAS_D,FECHA ";
				$mSQL= $mSQL."from DCURSOS ";
				$mSQL= $mSQL."where CI_D='$doc' and NUM='$i'";
				$Ccon->ExecSQL($mSQL);
				$cur=$Ccon->result;
				foreach($cur as $c){}

				print "<tr>";
					if(isset($c[0])) {
						print "<td  colspan=\"3\"><div><input name='" . "instituto_" . $i ."' class=\"datospf\" style='width: 600px;' value='$c[0]'><INPUT TYPE='hidden' NAME='update' value='SI'></div></td>";
					}
					else {
						print "<td  colspan=\"3\"><div><input name='" . "instituto_" . $i ."' class=\"datospf\" style='width: 600px;'></div></td>";
					}
				print "</tr>";
				
				print "<tr>";
					print "<td>";
						print "&nbsp;";
					print "</td>";
				print "</tr>";
				
				print "<tr>";
					print "<td class=\"datosp\" style=\"width: 60px\" colspan=\"2\">Nombre del Curso:</td>";
					print "<td class=\"datosp\" style=\"width: 60px\">Fecha:</td>";
				print "</tr>";
				
				print "<tr>";
					if(isset($c[1])) {
						print "<td  colspan=\"2\"><div><input name='" . "nombre_" . $i ."' class=\"datospf\" style='width: 400px;' value='$c[1]'></div></td>";
					}
					else {
						print "<td  colspan=\"2\"><div><input name='" . "nombre_" . $i ."' class=\"datospf\" style='width: 400px;'></div></td>";
					}
					if(isset($c[5])) {
						print "<td style='width: 120px;'><div><input name='" . "fecha_" . $i ."' class=\"datospf\" style='width: 60px;' onClick=\"c1.popup('" . "fecha_" . $i ."');\" readonly=\"readonly\" value='$c[5]'>&nbsp;&nbsp;<IMG SRC=\"Builder/img/cal.gif\" WIDTH=\"16\" HEIGHT=\"16\" BORDER=\"0\" onClick=\"c1.popup('" . "fecha_" . $i ."');\"></div></td>";
					}
					else {
						print "<td style='width: 120px;'><div><input name='" . "fecha_" . $i ."' class=\"datospf\" style='width: 60px;' onClick=\"c1.popup('" . "fecha_" . $i ."');\" readonly=\"readonly\">&nbsp;&nbsp;<IMG SRC=\"Builder/img/cal.gif\" WIDTH=\"16\" HEIGHT=\"16\" BORDER=\"0\" onClick=\"c1.popup('" . "fecha_" . $i ."');\"></div></td>";
					}	
				print "</tr>";

				print "<tr>";
					print "<td>";
						print "&nbsp;";
					print "</td>";
				print "</tr>";
				
				print "<tr>";
					if(isset($c[2])) {
						print "<td class=\"datosp\" style=\"width: 60px\">Ciudad:&nbsp;<div><input name='" . "ciudad_" . $i ."' class=\"datospf\" style='width: 200px;' onKeyUp='validarL(this);' value='$c[2]'></div></td>";
					}
					else {
						print "<td class=\"datosp\" style=\"width: 60px\">Ciudad:&nbsp;<div><input name='" . "ciudad_" . $i ."' class=\"datospf\" style='width: 200px;' onKeyUp='validarL(this);'></div></td>";
					}
					if(isset($c[3])) {
						print "<td class=\"datosp\" style=\"width: 60px\">Pais:&nbsp;<div><input name='" . "pais_" . $i ."' class=\"datospf\" style='width: 200px;' onKeyUp='validarL(this);' value='$c[3]'></div></td>";
					}
					else {
						print "<td class=\"datosp\" style=\"width: 60px\">Pais:&nbsp;<div><input name='" . "pais_" . $i ."' class=\"datospf\" style='width: 200px;' onKeyUp='validarL(this);'></div></td>";
					}
					if(isset($c[4])) {
						print "<td class=\"datosp\" style=\"width: 60px\">Duraci&oacute;n:&nbsp;
						<div><input name='" . "horas_" . $i ."' class=\"datospf\" style='width: 20px;' maxlength=\"3\" OnKeyUp='validarN(this)' value='$c[4]'>horas</div></td>";
					}
					else {
						print "<td class=\"datosp\" style=\"width: 60px\">Duraci&oacute;n:&nbsp;
						<div><input name='" . "horas_" . $i ."' class=\"datospf\" style='width: 20px;' maxlength=\"3\" OnKeyUp='validarN(this)'>horas</div></td>";
					}
					
				print "</tr>";
								
				?>
				<tr>
					<td colspan="5" class="datosp2">
						&nbsp;
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
<? print "<INPUT TYPE='hidden' name='docente' value='$doc'>";
   print "<INPUT TYPE='hidden' name='cursos' value='$cursos'>";
?>

</form>
</body>
</html>