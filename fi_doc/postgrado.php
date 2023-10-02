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

<title><?php echo $tProceso?> > Estudios de Postgrado</title>


</head>
<body>

<?
if(isset($_GET["postgrados"])) {
	$postgrados = $_GET["postgrados"];
	$doc = $_GET["doc"];?>

<form name="datos_preg" method="POST" action="registrarpostg.php">
	<?for ($i=1;$i<=$postgrados;$i++){
		?>
		<TABLE id="datos_postg" align="center" border="0" cellpadding="0" cellspacing="1" 
		 width="600" style="border-collapse:collapse;border-color: white; border-style:solid; background:#D2DEF0;">
		<BR><div class="tit14" style="text-align:center;">
			Postgrado <?print $i ?> Datos Generales:
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
				$p=array();
				reset($p);
				$Ccon = new ODBC_Conn("FDOCENTE","C","C");
				$mSQL = "select INSTITUTO,CIUDAD,PAIS,TITULO,MENCION,ANIO_E,HONORES ";
				$mSQL= $mSQL."from DPOSTGRADO ";
				$mSQL= $mSQL."where CI_D='$doc' and NUM='$i'";
				$Ccon->ExecSQL($mSQL);
				$pos=$Ccon->result;
				foreach($pos as $p){}

				print "<tr>";
					if(isset($p[0])) {
						print "<td  colspan=\"3\"><div><input name='" . "instituto_" . $i ."' class=\"datospf\" style='width: 600px;' onKeyUp='validarL(this);' value='$p[0]'><INPUT TYPE='hidden' NAME='update' value='SI'></div></td>";
					}
					else {
						print "<td  colspan=\"3\"><div><input name='" . "instituto_" . $i ."' class=\"datospf\" style='width: 600px;' onKeyUp='validarL(this);'></div></td>";
					}
				print "</tr>";
				
				print "<tr>";
					print "<td>";
						print "&nbsp;";
					print "</td>";
				print "</tr>";
				
				print "<tr>";
					if(isset($p[1])) {
						print "<td class=\"datosp\" style=\"width: 60px\">Ciudad:&nbsp;<div><input name='" . "ciudad_" . $i ."' class=\"datospf\" style='width: 200px;' onKeyUp='validarL(this);' value='$p[1]'></div></td>";
					}
					else {
						print "<td class=\"datosp\" style=\"width: 60px\">Ciudad:&nbsp;<div><input name='" . "ciudad_" . $i ."' class=\"datospf\" style='width: 200px;' onKeyUp='validarL(this);'></div></td>";
					}
					if(isset($p[2])) {
						print "<td class=\"datosp\" style=\"width: 160px\">Pais:&nbsp;<div><input name='" . "pais_" . $i ."' class=\"datospf\" style='width: 200px;' onKeyUp='validarL(this);' value='$p[2]'></div></td>";
					}
					else {
						print "<td class=\"datosp\" style=\"width: 160px\">Pais:&nbsp;<div><input name='" . "pais_" . $i ."' class=\"datospf\" style='width: 200px;' onKeyUp='validarL(this);'></div></td>";
					}
					if(isset($p[5])) {
						print "<td class=\"datosp\" style=\"width: 160px\">Año de Egreso:&nbsp;<div><input name='" . "anioe_" . $i ."' class=\"datospf\" style='width: 30px;' onKeyUp='validarN(this);' value='$p[5]'></div></td>";
					}
					else {
						print "<td class=\"datosp\" style=\"width: 160px\">Año de Egreso:&nbsp;<div><input name='" . "anioe_" . $i ."' class=\"datospf\" style='width: 30px;' onKeyUp='validarN(this);'></div></td>";
					}
					
				print "</tr>";
				print "<tr>";
					print "<td>";
						print "&nbsp;";
					print "</td>";
				print "</tr>";
				
				print "<tr>";
					print "<td class=\"datosp\" style=\"width: 60px\">T&iacute;tulo Obtenido:</td>";
					print "<td class=\"datosp\" style=\"width: 60px\">Menci&oacute;n:</td>";
					print "<td class=\"datosp\" style=\"width: 60px\">Menci&oacute;n Honorifica:</td>";	
				print "</tr>";
				
				print "<tr>";
				if(isset($p[3])) {
					print "<td><div><select name='" . "titulo_" . $i ."' class=\"datospf\" style='width: 120px;>'";
						print "<option value=\"$p[3]\">$p[3]</option>";
						print "<option value=\"DIPLOMADO\">DIPLOMADO</option>";
						print "<option value=\"ESPECIALIZACION\">ESPECIALIZACI&Oacute;N</option>";
						print "<option value=\"MAESTRIA\">MAESTR&Iacute;A</option>";
						print "<option value=\"DOCTORADO\">DOCTORADO</option>";
					print "</select></div></td>";
				}
				else{
					print "<td><div><select name='" . "titulo_" . $i ."' class=\"datospf\" style='width: 120px;>'";
						print "<option value=\"\">----SELECCIONE----</option>";
						print "<option value=\"DIPLOMADO\">DIPLOMADO</option>";
						print "<option value=\"ESPECIALIZACION\">ESPECIALIZACI&Oacute;N</option>";
						print "<option value=\"MAESTRIA\">MAESTR&Iacute;A</option>";
						print "<option value=\"DOCTORADO\">DOCTORADO</option>";
					print "</select></div></td>";
				}
				if(isset($p[4])) {
					print "<td><div><input name='" . "mencion_" . $i ."' class=\"datospf\" style='width: 150px;' onKeyUp='validarL(this);' value='$p[4]'></div></td>";
				}
				else {
					print "<td><div><input name='" . "mencion_" . $i ."' class=\"datospf\" style='width: 150px;' onKeyUp='validarL(this);'></div></td>";
				}
				if(isset($p[6])) {
					print "<td><div><select name='" . "honores_" . $i ."' id=\"jefatura\" class=\"datospf\" style='width: 120px;>'";
						print "<option value=\"$p[6]\">$p[6]</option>";
						print "<option value=\"NINGUNA\">NINGUNA</option>";
						print "<option value=\"CUMLAUDE\">CUMLAUDE</option>";
						print "<option value=\"SUMMACUMLAUDE\">SUMMACUMLAUDE</option>";
						print "<option value=\"MAGNACUMLAUDE\">MAGNACUMLAUDE</option>";
					print "</select></div></td>";
				}
				else {
					print "<td><div><select name='" . "honores_" . $i ."' id=\"jefatura\" class=\"datospf\" style='width: 120px;>'";
						print "<option value=\"\">----SELECCIONE----</option>";
						print "<option value=\"NINGUNA\">NINGUNA</option>";
						print "<option value=\"CUMLAUDE\">CUMLAUDE</option>";
						print "<option value=\"SUMMACUMLAUDE\">SUMMACUMLAUDE</option>";
						print "<option value=\"MAGNACUMLAUDE\">MAGNACUMLAUDE</option>";
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
   print "<INPUT TYPE='hidden' name='postgrados' value='$postgrados'>";
?>

</form>
</body>
</html>