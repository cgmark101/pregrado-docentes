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
  background-color:#FFFFFF; 
  font-variant: small-caps;
}
.datosp2 {
  text-align: left; 
  font-family:Arial; 
  font-size: 12px;
  font-weight: bold;
  background-color:#FFFFFF; 
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
  background-color:#FFFFFF;
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
  text-align: right; 
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

<title><?php echo $tProceso?> > Tutorias en Trabajos de Grado</title>


</head>
<body>

<?
if(isset($_GET["ttg"])) {
	$ttg = $_GET["ttg"];
	$cidoc = $_GET["doc"];
	
//CONSULTA DE DATOS ALMACENADOS
$Cdatos_p = new ODBC_Conn("DACEPOZ","N","N");
$dSQL     = " SELECT ci, nombre, apellido";
$dSQL     = $dSQL." FROM TBLACA007 ";
$dSQL     = $dSQL." WHERE ci='$cidoc' " ;
$Cdatos_p->ExecSQL($dSQL);
$docente=$Cdatos_p->result;
foreach($docente as $doc){}?>

<BR>
<table border="0" width="600" id="table1" cellspacing="1" cellpadding="0" style="border-collapse: collapse;border-color:blue;">
	<tr>
		<td class="inact"><IMG SRC="imagenes/unex15.gif" WIDTH="75" HEIGHT="75" BORDER="0" ALT=""></td>
				
		<td class="inact">Universidad Nacional Experimental Polit&eacute;cnica<BR>"Antonio Jos&eacute; de Sucre"<BR>Vicerrectorado&nbsp;<? print $vicerrectorado?><BR><? print $nombreDependencia  ?>
		</td>
	<tr>
</table><BR>
<FONT SIZE="3" COLOR="#000000" face="arial"><CENTER><B>FICHA DE DATOS DOCENTE</B></CENTER></FONT>
<TABLE border="0" width="600">
<TR class="datospf">
	<TD><?	$fecha  = date('d/m/Y', time() - 3600*date('I'));
	$hora   = date('h:i:s', time() - 3600*date('I'));
	print $fecha.' '.$hora;
?></TD>
</TR>
</TABLE>
<HR width="600" align="center">
<table border="0" width="600" id="table1" cellspacing="1" cellpadding="0" style="border-collapse: collapse;border-color:blue;" align="center">
	<tr class="datosp2">
				<td style="width: 150px;" >C&eacute;dula:</td>
				<td style="width: 150px;">Apellidos:</td>
				<td style="width: 150px;">Nombres:</td>
            </tr>           

			<tr>
				<td style="width: 150px;" class="datosp">
					<?print $doc[0];?>
				</td>

				<td style="width: 150px;" class="datosp">
					<?print $doc[2];?>
				</td>
				<td style="width: 150px;" class="datosp">
					<?print $doc[1]?>
				</td>
				
            </tr>
</table>

<form name="datos_ttg" method="POST" action="registrarttesis.php">
	<?for ($i=1;$i<=$ttg;$i++){
		?>
		<TABLE id="datos_ttg" align="center" border="0" cellpadding="0" cellspacing="1" 
		 width="600" style="border-collapse:collapse;border-color: white; border-style:solid; background:#D2DEF0;">
		<BR><div class="tit14" style="text-align:center;">
			<HR width="600" align="center">Trabajo <?print $i ?> Datos Generales:<HR width="600" align="center">
		</div>
				<tr>
					<td class="datosp2" style="width: 60px" colspan="3">
						Nombre del Trabajo:
					</td>
				</tr>
				<?
				//CONSULTA DE DATOS ALMACENADOS
				$Ccon = new ODBC_Conn("FDOCENTE","C","C");
				$mSQL = "select NOMBRE,ESTUDIANTE,FECHA,ESPECIALIDAD,MENCION ";
				$mSQL= $mSQL."from DTUTORIAS ";
				$mSQL= $mSQL."where CI_D='$cidoc' and NUM='$i'";
				$Ccon->ExecSQL($mSQL);
				$tut=$Ccon->result;
				foreach($tut as $t){}

				print "<tr class=\"datosp\">";
					print "<td colspan=\"3\"><div>$t[0]</div></td>";	
				print "</tr>";
				
				print "<tr class=\"datosp2\">";
					print "<td style=\"width: 60px\" colspan=\"3\">Nombres Y Apellidos del Estudiante:</td>";
				print "</tr>";
				print "<tr class=\"datosp\">";
					print "<td colspan=\"3\"><div>$t[1]</div></td>";	
				print "</tr>";
				
				print "<tr class=\"datosp2\">";
					print "<td  style=\"width: 60px\">Fecha de Presentaci&oacute;n:</td>";
					print "<td  style=\"width: 160px\">Especialidad:</td>";
					print "<td  style=\"width: 60px\">Menci&oacute;n/Area:</td>";
				print "</tr>";
				print "<tr class=\"datosp\">";
					print "<td style='width: 220px;'><div>$t[2]</div></td>";
					print "<td><div>$t[3]</div></td>";
					print "<td><div>$t[4]</div></td>";
					
				print "</tr>";
				
												
				?>
				
			</TABLE>

		<?
	}
}
else
	print "no hay valor";
?><HR width="600" align="center">
<table border="0" width="600" id="table1" cellspacing="1" cellpadding="0" style="border-collapse: collapse;border-color:blue;">
<tr>
                    
                    <td valign="top" colspan="3"><p align="center">
                        <BR><input type="button" style="width: 90px;" value="Cerrar"  name="cerrar" class="boton" 
                         onclick="javascript:self.close();"></p> 
                    </td>
					<td valign="top" colspan="4"><p align="center">
                        <BR><input type="reset" style="width: 90px;" value="Imprimir"  name="imprimir" class="boton" onclick="window.print();"></p> 
                    </td>
                   
                </tr>
</table>
<? print "<INPUT TYPE='hidden' name='docente' value='$doc'>";
   print "<INPUT TYPE='hidden' name='ttg' value='$ttg'>";
?>

</form>
</body>
</html>