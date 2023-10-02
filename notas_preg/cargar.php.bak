<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	
<?php

	include_once('inc/vImage.php');
    include_once('inc/odbcss_c.php');
	include_once ('inc/config.php');
	include_once ('inc/activaerror.php');


$lista_e = array();

$fecha  = date('Y-m-d', time() - 3600*date('I'));
$hora   = date('h:i a', time() - 3600*date('I'));

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
.enc_p2 {
  color:#000000;
  text-align: center; 
  font-family:Helvetica; 
  font-size: 11px; 
  font-weight: bold;
  height:20px;
  font-variant: small-caps;
}
.inact {
  text-align: center; 
  font-family:Arial; 
  font-size: 11px; 
  font-weight: normal;
  
}
.inact2 {
  text-align: left; 
  font-family:Arial; 
  font-size: 11px; 
  font-weight: normal;
  padding-left: 10px;
 
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
  font-variant: small-caps;
}

-->
</style>



<?php
 if(isset($_POST['acta']) && isset($_POST['cedula'])) {
	
	$acta=$_POST['acta'];
	$cedula=$_POST['cedula'];

	
}ELSE echo "<script>document.location.href='../notas';</script>\n";
//NUMERO DE ACTAS
$Ccont = new ODBC_Conn("CENTURA-DACE","c","c",$ODBCC_conBitacora, $laBitacora);
$mSQL = "select distinct count(*) ";
$mSQL= $mSQL."from tblaca004 a ";
$mSQL= $mSQL."where ci='$cedula' and ";
$mSQL= $mSQL."a.lapso='$lapsoProceso'  ";
$Ccont->ExecSQL($mSQL,__LINE__,true);
$reg=$Ccont->result;
foreach($reg as $reg1){}
$reg2=$reg1[0]-1;

//Consulta Anterior
$Cact = new ODBC_Conn("CENTURA-DACE","c","c",$ODBCC_conBitacora, $laBitacora);
$mSQL = "select distinct a.acta ";
$mSQL= $mSQL."from tblaca004 a,tblaca008 c,dace006 d ";
$mSQL= $mSQL."where a.c_asigna=c.c_asigna and ci='$cedula' and ";
$mSQL= $mSQL."a.lapso='$lapsoProceso' and a.c_asigna=d.c_asigna and ";
$mSQL= $mSQL."a.lapso=d.lapso and a.acta=d.acta and (d.status='7' or d.status='A') ";
$Cact->ExecSQL($mSQL,__LINE__,true);
$actass=$Cact->result;

if ($reg2 == -1){echo "<script>document.location.href='../notas/error.php';</script>\n";}

$sw='0';
for ($i=0;$i<=$reg2;$i++){
	//print $actass[$i][0];
	if ($acta == $actass[$i][0]){
		$sw='0';break;
	}else $sw='1';
	
}
//print $acta;
//print $sw;
if ($sw == '1') { 
	print "ERROR";
	echo "<script>document.location.href='../notas/error.php';</script>\n";
}

/*foreach ($actass as $n){
		for ($i=1;$i<=2;$i++){
			
			
		}
	}*/


//print_r($HTTP_POST_VARS);

//Lista de Estudiantes
$Cmat = new ODBC_Conn("CENTURA-DACE","c","c",$ODBCC_conBitacora, $laBitacora);
$mSQL = "select a.exp_e,a.apellidos,a.nombres,b.acta,b.c_asigna,";
$mSQL= $mSQL."c.asignatura,b.seccion,e.ci,e.apellido,e.nombre,b.status ";
$mSQL= $mSQL."from dace002 a,dace006 b,tblaca008 c,tblaca007 e,tblaca004 f ";
$mSQL= $mSQL."where b.lapso='$lapsoProceso' and a.exp_e=b.exp_e ";
$mSQL= $mSQL."and  b.acta ='$acta' and b.c_asigna=c.c_asigna and f.ci='$cedula' ";
$mSQL= $mSQL."and b.c_asigna=f.c_asigna and b.lapso=f.lapso and b.seccion=f.seccion ";
$mSQL= $mSQL."and b.acta=f.acta and f.ci=e.ci order by 2";
$Cmat->ExecSQL($mSQL,__LINE__,true);
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
<title><?php  print $nombdoc."  ".$apedoc." - ".$asig." - ".$lapsoProceso ?></title>

</head>
<body <?php global $botonDerecho; echo $botonDerecho; ?>>



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

function validarNota(campo) {

	if (campo.value > 0 && campo.value < 1){
		alert("Nota no válida.\n\nEl valor de la calificación debe ser entre 1 y 9");
		campo.value = ""
		campo.style.backgroundColor='#FF6600';
		campo.focus();
	}else{
		campo.style.backgroundColor='#FFFF99';
	}
	if (campo.value > 9){
		alert("Nota no válida.\n\nEl valor de la calificación debe ser entre 1 y 9");
		campo.value = ""
		campo.style.backgroundColor='#FF6600';
		campo.focus();
	}else{
		campo.style.backgroundColor='#FFFF99';
	}
}

function notasOK(){
	with (document.notas){
		var i=1;
		var j=0;
		while (i <= nro.value){
			valor=eval("nota_"+i+".value");
			if (valor == ''){
				exp=eval("exp_"+i+".value");
				nom=eval("nom_"+i+".value");
				fila=eval("fila_"+i+".value");
				alert('El campo correspondiente a:\n\n'+nom+' Expediente N°: '+exp+' está vacio.\n\nUbicado en la fila: '+fila);
				j++;	
			}
			i++;			
		}
		if (j > 0){
			if (j > 1){
				msg1=('Existen ');
				msg2=(' campos vacíos.\n\n');
			}else if (j == 1){
				msg1=('Existe ');
				msg2=(' campo vacío.\n\n');
			}
			msg=(msg1+j+msg2+'Por favor complete todos los campos para continuar.');
			alert(msg);
		}
		else{
			notOK.value=true;
			envia = confirm('¿Está seguro de incluir las notas de esta acta?\n\n - Una vez ingresadas no podrán ser modificadas.');
			if (envia){
				document.notas.submit();
			}
		}
	}
}

//-->
</SCRIPT>


<table align="center" border="0" cellpadding="0" cellspacing="1" width="660">
	<tr>
		<td class="inact"><IMG SRC="imagenes/unex15.gif" WIDTH="75" HEIGHT="75" BORDER="0" ALT="">
		</td>
		
		<td class="inact">Universidad Nacional Experimental Polit&eacute;cnica<BR>"Antonio Jos&eacute; de Sucre"<BR>Vicerrectorado&nbsp;<?php  print $vicerrectorado?><BR><?php  print $nombreDependencia  ?><BR> <?php  print $tProceso ?>&nbsp;Lapso&nbsp;<?php  print $lapsoProceso ?>
		</td>
		<td bgcolor="#A7A7A7">&nbsp</td>
		
		<td class="datosp">
			&nbsp;&nbsp;<B>Fecha:</B>&nbsp;<?php echo date("d/m/Y");?>&nbsp;<?php echo $hora?>
			&nbsp;&nbsp;&nbsp;&nbsp;<B>Lapso</B>:&nbsp;<?php  print $lapsoProceso ?><BR>
			
			&nbsp;&nbsp;<B>Docente:</B>&nbsp;<?php  print $nombdoc?>&nbsp;&nbsp;<?php  print $apedoc ?>&nbsp;<B>CI:</B>&nbsp;<?php  print $cidoc ?><BR>

			&nbsp;&nbsp;<B>Asignatura:</B>&nbsp;<?php  print $asig?>&nbsp;&nbsp;<B>C&oacute;digo:&nbsp;</B><?php print $cod?><BR>
			
			&nbsp;&nbsp;<B>Secci&oacute;n:</B>&nbsp;<?php  print $secc?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			
			&nbsp;&nbsp;<B>Acta:</B>&nbsp;<?php  print $acta ?>
				 
		</td>
	</tr>
</table>
<BR>
<table align="center" border="1" cellpadding="0" cellspacing="1" width="660" style="border-collapse: collapse;border-color:black;">


	<tr>
		<td style="width: 10px;" class="enc_p" align="center">NRO</td>
		<td style="width: 100px;" class="enc_p" align="center">EXPEDIENTE</td>
		<td style="width: 100px;" class="enc_p" align="center">APELLIDOS</td>
		<td style="width: 100px;" class="enc_p" align="center">NOMBRES</td>
		<td style="width: 50px;" class="enc_p" align="center">NOTA</td>
		<!-- <td style="width: 120px;" class="enc_p">EN LETRAS</td>
		<td style="width: 120px;" class="enc_p">OBSERVACIONES</td>
        -->
	</tr>

	<form action="registrar.php" method="POST" name="notas">
			<?php
			$nota=array();
			$nro=0;
			$nros=0;
			foreach ($lista_e as $est){
				$nros++;
				$nro++;
				$nota[$nro]=$nro;
				print "<tr>";
				print "<td><div class=\"inact\">$nros</div></td>\n";
				print "<td><div class=\"inact\">$est[0]</div></td>\n";
				print "<td><div class=\"inact2\">$est[1]</div></td>\n";
				print "<td><div class=\"inact2\">$est[2]</div></td>\n";
				if (($est[10] == '7') or ($est[10] == 'A')) {
					print "<td align='center'><div>";
					print "<input name='" . "nota_" . $nro ."' type='text' style='width: 25px; color:#000000; border-style: solid; border-width: 1px; border-color: #0000FF; background-color: #FFFF99;' maxlength='3' onKeyUp='validarN(this); validarNota(this);' value=''>";
					print "<input name='" . "exp_" . $nro ."' type='hidden' value='$est[0]'>";
					print "<input name='" . "nom_" . $nro ."' type='hidden' value='$est[1] $est[2]'>";
					print "<input name='" . "fila_" . $nro ."' type='hidden' value='$nros'>";
					print "</div></td>\n";
				}elseif ($est[10] == '2'){$nro--;
					print "<td><div class=\"inact\">RETIRADO(A)</div></td>\n";
				}elseif ($est[10] == 'R'){$nro--;
					print "<td><div class=\"inact\">RETIRADO(A) POR REGLAMENTO</div></td>\n";
				}


				

//	Estos campos creo que no son necesarios, ya que con con numero de expediente y la nota debe bastar
//				print "<input name='" . "numero_" . $nro ."' type='hidden' value='$nro'>";	
//				print "<input name='" . "apellido_" . $nro ."' type='hidden' value='$est[1]'>";
//				print "<input name='" . "nombre_" . $nro ."' type='hidden' value='$est[2]'>";
//	Estos campos creo que no son necesarios, ya que con con numero de expediente y la nota debe bastar

				
				/*print "<td><div class=\"inact\">nota</div></td>";
				print "<td><div class=\"inact\">observacion</div></td>"; -->*/
				print "</tr>\n\n";
				}
		?>
	<tr><td colspan="7" bgcolor="#000000" align="center"></td></tr></table>

	<table align="center" border="0" cellpadding="0" cellspacing="1" width="660" style="border-collapse: collapse;border-color:black;">
	
	<tr><td colspan="7"><FONT SIZE="2" COLOR="#FF0000" FACE="arial"><B>ATENCION:</B><UL>
	<LI>En caso de utilizar decimales, &eacute;stos deben separarse con <B>punto (.)</B>
	<LI>Asegurese de no dejar casillas vac&iacute;as. Para estudiantes <B>inasistentes</B> introduzca el valor <B>cero (0)</B>
	<LI>Por favor asegurese que todos los datos sean correctos, puesto que una vez incluidos no podr&aacute;n ser modificados.
	<LI>La inclusi&oacute;n de datos est&aacute; bajo la total responsabilidad del Docente.
</UL></FONT></td></tr>
	<tr>
                    
                    <td valign="top"><p align="center">
                        <BR><input type="button" value="Cerrar" name="cerrar" class="boton" 
                         onclick="javascript:self.close();"></p> 
                    </td>
					<td valign="top"><p align="center">
                        <BR><input type="reset" value="Reiniciar" name="reiniciar" class="boton"></p> 
                    </td>
                    <td colspan="2"><p align="center">
                        <BR><INPUT TYPE="button" value="Cargar" name="cargar"
							class="boton" onClick="notasOK();"></p>
							
							<?php  
							  $tipo_usuario=$_POST['tipo_usuario'];
							  $userid=$_POST['userid'];
							  #echo $tipo_usuario;
							  #echo $userid;
							  #print_r ($_POST);

							  print "<input value='$acta' name='acta' type='hidden'>";
							  print "<input value='$nro' name='nro' type='hidden'>";
							  print "<input value='$secc' name='seccion' type='hidden'>";
							  print "<input value='$nombdoc' name='nombdoc' type='hidden'>";
							  print "<input value='$apedoc' name='apedoc' type='hidden'>";
							  print "<input value='$cidoc' name='cidoc' type='hidden'>";
							  print "<input value='$asig' name='asig' type='hidden'>";
							  print "<input value='$lapsoProceso' name='lapsoProceso' type='hidden'>";
							  print "<input value='$cod' name='cod' type='hidden'>";
							  print "<input value='0' name='afecind' type='hidden'>";
							  print "<input value='0' name='statusr' type='hidden'>";
							  print "<input value='0' name='reti' type='hidden'>";
							  print "<input value='' name='notOK' type='hidden'>";
							  print "<input value='$tipo_usuario' name='tipo_usuario' type='hidden'>";
							  print "<input value='$userid' name='userid' type='hidden'>";
							?>

                    </td>
                </tr>
</form>
</table>
</body>
</html>