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
<?php echo "<script src='popcalendar.js' type='text/javascript'></script>" ?>
<?php echo "<script src='{$raizDelSitio}/inscni.js' type='text/javascript'></script>" ?>
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
<?php
print $noCache; 
print $noJavaScript; 
?>

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

<title><?php echo $tProceso?> > Materias Actuales</title>


</head>
<body>

<?
if(isset($_GET["materias"])) {
	$materias = $_GET["materias"];
	$doc = $_GET["doc"];?>

<form name="datos_m" method="POST" action="registrarm.php">
	<?for ($i=1;$i<=$materias;$i++){
		?>
		<TABLE id="datos_materias" align="center" border="0" cellpadding="0" cellspacing="1" 
		 width="600" style="border-collapse:collapse;border-color: white; border-style:solid; background:#D2DEF0;">
		<BR><div class="tit14" style="text-align:center;">
			Materia <?print $i ?> Datos Generales:
			<span class="titulo" style="color:gray; font-variant:normal;">
			(Coloque los datos completos en todos los campos.)</span>
		</div>
				<tr>
					<td class="datosp" style="width: 60px">
						C&oacute;digo:
					</td>
					<td class="datosp" style="width: 60px">
						Cr&eacute;ditos:
					</td>
					<td class="datosp" style="width: 50px">
						Nombre &nbsp;Completo:
					</td>
					<td class="datosp" style="width: 60px">
						Secci&oacute;n:
					</td><td class="datosp" style="width: 100px">
						Nivel:
					</td>
					
				</tr>
				<?

				//CONSULTA DE DATOS ALMACENADOS
				$m=array();
				reset($m);
				$Ccon = new ODBC_Conn("FDOCENTE","C","C");
				$mSQL = "select C_ASIGNA,UNID_CREDITO,ASIGNATURA,SECCION,NIVEL ";
				$mSQL= $mSQL."from DMAT_A ";
				$mSQL= $mSQL."where CI_D='$doc' and NUM='$i'";
				$Ccon->ExecSQL($mSQL);
				$mat=$Ccon->result;
				foreach($mat as $m){}

				print "<tr>";
					if(isset($m[0])) {
						print "<td><div><input name='" . "codigo_" . $i ."' class=\"datospf\" style='width: 50px;' maxlength='10' onKeyUp='validarN(this);' value='$m[0]'><INPUT TYPE='hidden' NAME='update' value='SI'></div></td>";
					}
					else {
						print "<td><div><input name='" . "codigo_" . $i ."' class=\"datospf\" style='width: 50px;' maxlength='10' onKeyUp='validarN(this);'><INPUT TYPE='hidden' NAME='update' value='NO'></div></td>";
					}
					if(isset($m[1])) {
						print "<td><div><input name='" . "creditos_" . $i ."' class=\"datospf\" style='width: 25px;' maxlength='2' onKeyUp='validarN(this);' value='$m[1]'></div></td>";
					}
					else {
						print "<td><div><input name='" . "creditos_" . $i ."' class=\"datospf\" style='width: 25px;' maxlength='2' onKeyUp='validarN(this);'></div></td>";
					}
					if(isset($m[2])) {
						print "<td><div><input name='" . "asignatura_" . $i ."' class=\"datospf\" style='width: 300px;' onKeyUp='validarL(this);' value='$m[2]'></div></td>";
					}
					else {
						print "<td><div><input name='" . "asignatura_" . $i ."' class=\"datospf\" style='width: 300px;' onKeyUp='validarL(this);'></div></td>";
					}
					if(isset($m[3])) {		
						print "<td><div><input name='" . "seccion_" . $i ."' class=\"datospf\" style='width: 25px;' maxlength='2' value='$m[3]'></div></td>";
					}
					else {
						print "<td><div><input name='" . "seccion_" . $i ."' class=\"datospf\" style='width: 25px;' maxlength='2'></div></td>";
					}
					if(isset($m[4])) {
						print "<td><div><select name='" . "nivel_" . $i ."' class=\"datospf\" style='width: 100px;>'";
							print "<option value=\"$m[4]\">$m[4]</option>";
							print "<option value=\"TSU\">TEC. SUP. UNIV.</option>";
							print "<option value=\"ART. Y PROC.\">ART. Y PROC.</option>";
							print "<option value=\"PREGRADO\">PREGRADO</option>";
							print "<option value=\"POSTGRADO\">POSTGRADO</option>";
						print "</select></div></td>";
					}
					else {
						print "<td><div><select name='" . "nivel_" . $i ."' class=\"datospf\" style='width: 100px;>'";
							print "<option value=\"\">--SELECCIONE--</option>";
							print "<option value=\"TSU\">TEC. SUP. UNIV.</option>";
							print "<option value=\"ART. Y PROC.\">ART. Y PROC.</option>";
							print "<option value=\"PREGRADO\">PREGRADO</option>";
							print "<option value=\"POSTGRADO\">POSTGRADO</option>";
						print "</select></div></td>";
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
   print "<INPUT TYPE='hidden' name='materias' value='$materias'>";
?>

</form>
</body>
</html>