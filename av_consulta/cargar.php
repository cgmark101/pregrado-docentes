<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
<?php
include_once('inc/vImage.php');
include_once('inc/odbcss_c.php');
include_once ('inc/config.php');
include_once ('inc/activaerror.php');

print $noCache; 
print $noJavaScript; 


$lista_e = array();

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
  background-color:#F0F0F0; 
  font-variant: small-caps;
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
.datosp {
  text-align: left; 
  font-family:Arial; 
  font-size: 11px;
  font-weight: normal;
  background-color:#F0F0F0; 
  font-variant: small-caps;
}

-->
</style>

<?

if(isset($_POST['acta']) && isset($_POST['cedula'])) {
	
	$acta=$_POST['acta'];
	$cedula=$_POST['cedula'];
	/*print $acta;
	print $cedula;*/
}

$Cmat = new ODBC_Conn("DACEPTO","N","N");
$mSQL = "select a.exp_e,a.apellidos,a.nombres,b.acta,b.c_asigna,";
$mSQL= $mSQL."c.asignatura,b.seccion,e.ci,e.apellido,e.nombre ";
$mSQL= $mSQL."from dace002 a,dace006 b,tblaca008 c,tblaca007 e,tblaca004 f ";
$mSQL= $mSQL."where b.lapso='$lapsoProceso' and a.exp_e=b.exp_e ";
$mSQL= $mSQL."and  b.acta ='$acta' and b.c_asigna=c.c_asigna and f.ci='$cedula' ";
$mSQL= $mSQL."and b.c_asigna=f.c_asigna and b.lapso=f.lapso and b.seccion=f.seccion ";
$mSQL= $mSQL."and b.acta=f.acta and f.ci=e.ci order by 2";
$Cmat->ExecSQL($mSQL);
$lista_e=$Cmat->result;
foreach ($lista_e as $est){
	$secc = $est[6];
	$acta = $est[3];
	$cidoc = $est[7];
	$nombdoc = $est[9];
	$apedoc = $est[8];
	$asig = $est[5];
	$cod = $est[4];
}

?>
<title><? print $nombdoc."  ".$apedoc." - ".$asig." - ".$secc." - ".$lapsoProceso ?>

</head>
<body>



<SCRIPT LANGUAGE="JavaScript">
<!--
function validarN(campo) {

	var cadena = campo.value;
    var nums="1234567890.";
    var i=0;
    var cl=cadena.length;
    while(i < cl)  {
		cTemp= cadena.substring (i, i+1);
        if (nums.indexOf (cTemp, 0)==-1) {
            cadT = cadena.split(cTemp);
            var cadena = cadT.join("");
            campo.value=cadena;
            i=-1;
            cl=cadena.length;
		}
        i++;
    }
}

//-->
</SCRIPT>



<table align="center" border="0" cellpadding="0" cellspacing="1" width="750">
	<tr>
		<td class="inact"><IMG SRC="imagenes/unex15.gif" WIDTH="75" HEIGHT="75" BORDER="0" ALT="">
		</td>
		
		<td class="inact">Universidad Nacional Experimental Polit&eacute;cnica<BR>"Antonio Jos&eacute; de Sucre"<BR>Vicerrectorado&nbsp;<? print $vicerrectorado?><BR><? print $nombreDependencia  ?><BR> <? print $tProceso ?>&nbsp;Lapso&nbsp;<? print $lapsoProceso ?>
		</td>
		<td bgcolor="#A7A7A7">&nbsp</td>
		
		<td bgcolor="#EFEFEF" class="datosp">
			&nbsp;&nbsp;<B>Fecha:</B>&nbsp;<?echo date("d/m/Y"); ?>&nbsp;&nbsp;&nbsp;&nbsp;<B>Lapso</B>:&nbsp;<? print $lapsoProceso ?><BR>
			
			&nbsp;&nbsp;<B>Docente:</B>&nbsp;<? print $nombdoc?>&nbsp;&nbsp;<? print $apedoc ?>&nbsp;<B>CI:</B>&nbsp;<? print $cidoc ?><BR>

			&nbsp;&nbsp;<B>Asignatura:</B>&nbsp;<? print $asig?>&nbsp;&nbsp;<B>C&oacute;digo:&nbsp;</B><?print $cod?><BR>
			
			&nbsp;&nbsp;<B>Secci&oacute;n:</B>&nbsp;<? print $secc?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			
			&nbsp;&nbsp;<B>Acta:</B>&nbsp;<? print $acta ?>
				 
		</td>
	</tr>
	<tr><td colspan="4" bgcolor="#000000"></td></tr>
	<tr><td colspan="4" bgcolor="#000000"></td></tr>
	<tr><td colspan="4" bgcolor="#000000"></td></tr>
</table>
<table align="center" border="0" cellpadding="0" cellspacing="1" width="750">


	<tr border="1" bordercolor="#3399FF">
		<td style="width: 110px;" class="enc_p">NRO</td>
		<td style="width: 110px;" class="enc_p">EXPEDIENTE</td>
		<td style="width: 110px;" class="enc_p">APELLIDOS</td>
		<td style="width: 110px;" class="enc_p" >NOMBRES</td>
		<!-- <td style="width: 50px;" class="enc_p">NOTA</td>
		<td style="width: 120px;" class="enc_p">EN LETRAS</td> -->
		<td style="width: 120px;" class="enc_p">OBSERVACIONES</td>
       
	</tr>
	<tr><td colspan="7" bgcolor="#000000"></td></tr>
	<tr><td colspan="7" bgcolor="#000000"></td></tr>
	<tr><td colspan="7" bgcolor="#000000"></td></tr>
	<?
	//print $lista_e;
	?>
	<form action="registrar.php" method="POST" name="notas">
			<?
			$nota=array();
			$nro=0;
			foreach ($lista_e as $est){
				$nro++;
				$nota[$nro]=$nro;
				print "<tr>";
				print "<td><div class=\"inact\">$nro</div></td>";
				print "<td><div class=\"inact\">$est[0]</div></td>";
				print "<td><div class=\"inact\">$est[1]</div></td>";
				print "<td><div class=\"inact\">$est[2]</div></td>";
				/*print "<td align='center'><div>";
				print "<input name='nota' type='text' style='width: 25px; color:#000000; border-style: solid; border-width: 1px; border-color: #0000FF; background-color: #FFFF99;' maxlength='3' onKeyUp='validarN(this);' value=''>";
				print "<input name='numero' type='hidden' value='$nro'>";
				print "<input name='exp' type='hidden' value='$est[0]'>";
				print "<input name='apellido' type='hidden' value='$est[1]'>";
				print "<input name='nombre' type='hidden' value='$est[2]'>";
				print "</div></td>";
				print "<td><div class=\"inact\">nota</div></td>";*/
				print "<td><div class=\"inact\">&nbsp;</div></td>";
				print "</tr>";
				}
		?>
	<tr><td colspan="7" bgcolor="#000000" align="center"></td></tr>
	<tr><td colspan="7" bgcolor="#000000" align="center"></td></tr>
	<tr><td colspan="7" bgcolor="#000000" align="center"></td></tr>
	<!-- <tr><td colspan="7"><FONT SIZE="1" COLOR="#FF0000" FACE="arial">Por favor asegurese que todos los datos sean correctos, puesto que una vez incluidos no podr&aacute;n ser modificados</FONT></td></tr>
	<tr> -->
                    
                    <td valign="top" colspan="3"><p align="center">
                        <BR><input type="button" value="Cerrar" name="cerrar" id="exit" class="boton" 
                         onclick="javascript:self.close();"></p> 
                    </td>
					<td valign="top" colspan="3"><p align="center">
                        <BR><input type="reset" value="Imprimir" name="imprimir" class="boton" onclick="window.print();"></p> 
                    </td>
                    <!-- <td colspan="2"><p align="center">
                        <BR><INPUT TYPE="submit" value="Cargar" name="cargar"
							class="boton"></p>
							
							<? print "<input value='$acta' name='acta' type='hidden'>";?>
							
                    </td> -->
                </tr>
</form>
</table>
</body>
</html>
