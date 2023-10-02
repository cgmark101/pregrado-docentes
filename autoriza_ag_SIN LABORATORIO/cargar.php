<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	
<?php

include_once ('inc/vImage.php');
include_once ('inc/odbcss_c.php');
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
.inact3 {
  text-align: left; 
  font-family:Arial; 
  font-size: 9px; 
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
  font-variant: small-caps;
}

-->
</style>



<?php
if (isset($_POST['agrega'])){
	$total_ag = count($_POST)-6;
	if (($_POST['agrega'] == 'si') and ($total_ag > 0)){
		#echo "script para capturar los expedientes <BR>";
		$acta = $_POST['acta'];
		$seccion = $_POST['seccion'];
		$c_asigna = $_POST['c_asigna'];
		$total = $_POST['total'];
		#echo $total_ag."<BR>".$acta."<BR>".$seccion."<BR>".$c_asigna;
		/*print_r($_POST);
		echo $lapsoProceso;
		echo count($_POST)-4;
		echo $_POST['agrega'];*/

		#aumentar el total de cupos en TBLACA004
		$Cagr = new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
		
		$mSQL = "UPDATE TBLACA004 SET tot_cup=tot_cup+".$total_ag.", inscritos=inscritos+".$total_ag." ";
		$mSQL.= "WHERE acta='".$acta."' AND seccion='".$seccion."' AND ";
		$mSQL.= "c_asigna='".$c_asigna."' AND lapso='".$lapsoProceso."' ";
		$Cagr->ExecSQL($mSQL,__LINE__,true);
		#si amplia los cupos, se actualizan los datos en DACE006
		if ($Cagr->fmodif == 1){
			$i=1;
			#print_r($_POST);
			#echo $total_ag;
			$j=0;
			while ($i <= $total){
				if (isset($_POST[$i])){
					$exp_e=$_POST[$i];
					$mSQL = "UPDATE DACE006 SET status='A', fecha='".$fecha."' WHERE "; 
					$mSQL.= "exp_e='".$exp_e."' AND acta='".$acta."' AND seccion='".$seccion."' AND ";
					$mSQL.= "c_asigna='".$c_asigna."' AND lapso='".$lapsoProceso."' ";
					$Cagr->ExecSQL($mSQL,__LINE__,true);
					$j+=$Cagr->fmodif;
					#echo $_POST[$i];
				}
				$i++;
			}
		}


	}#else echo "no agrega";
}

if(isset($_POST['acta']) && isset($_POST['cedula'])) {
	
	$acta=$_POST['acta'];
	$cedula=$_POST['cedula'];

	/*print $acta;
	print $cedula;*/

}ELSE echo "<script>document.location.href='../list_est_cola';</script>\n";
//NUMERO DE ACTAS
$Ccont = new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
$mSQL = "select distinct count(*) ";
$mSQL= $mSQL."from tblaca004 a ";
$mSQL= $mSQL."where ci='$cedula' and ";
$mSQL= $mSQL."a.lapso='$lapsoProceso'  ";
$Ccont->ExecSQL($mSQL,__LINE__,true);
$reg=$Ccont->result;
foreach($reg as $reg1){}
$reg2=$reg1[0]-1;

//Consulta Anterior
$Cact = new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
$mSQL = "select distinct a.acta ";
$mSQL= $mSQL."from tblaca004 a,tblaca008 c,dace006 d ";
$mSQL= $mSQL."where a.c_asigna=c.c_asigna and ci='$cedula' and ";
$mSQL= $mSQL."a.lapso='$lapsoProceso' and a.c_asigna=d.c_asigna and ";
$mSQL= $mSQL."a.lapso=d.lapso and a.acta=d.acta and (d.status='7' or d.status='A' or d.status='Y') ";
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

//Lista de Estudiantes Inscritos
$Cmat = new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
$mSQL = "select a.exp_e,a.apellidos,a.nombres,b.acta,b.c_asigna,";
$mSQL= $mSQL."c.asignatura,b.seccion,e.ci,e.apellido,e.nombre,b.status,a.apellidos2,a.nombres2 ";
$mSQL= $mSQL."from dace002 a,dace006 b,tblaca008 c,tblaca007 e,tblaca004 f ";
$mSQL= $mSQL."where b.lapso='$lapsoProceso' and a.exp_e=b.exp_e ";
$mSQL= $mSQL."and  b.acta ='$acta' and b.c_asigna=c.c_asigna and f.ci='$cedula' ";
$mSQL= $mSQL."and b.c_asigna=f.c_asigna and b.lapso=f.lapso and b.seccion=f.seccion ";
$mSQL= $mSQL."and b.acta=f.acta and f.ci=e.ci and b.status!='Y' and b.status!='Z' order by 2";
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
<title><?php print $nombdoc."  ".$apedoc." - ".$asig." - ".$lapsoProceso ?></title>

</head>
<body <?=$botonDerecho?>>



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
		alert("NOTA NO VALIDA")
		campo.value = ""
		}
	if (campo.value > 9)
		{alert("NOTA NO VALIDA")
		campo.value = ""
		}
	if (campo.value == '')
		{alert("DEBE INTRODUCIR UNA NOTA")
		}
}

function goAway() { 
if (confirm('La página actual está intentando ser cerrada.\n\n¿Está seguro que desea salir?'))
window.close();
else { 
alert('Se encuentra aún conectado al sistema.'); 
return false;}} 

//-->
</SCRIPT>



<table align="center" border="0" cellpadding="0" cellspacing="1" width="660">
	<tr>
		<td class="inact"><IMG SRC="imagenes/unex15.gif" WIDTH="75" HEIGHT="75" BORDER="0" ALT="">
		</td>
		
		<td class="inact">Universidad Nacional Experimental Polit&eacute;cnica<BR>"Antonio Jos&eacute; de Sucre"<BR>Vicerrectorado&nbsp;<? print $vicerrectorado?><BR><? print $nombreDependencia  ?><BR> <? print $tProceso ?>&nbsp;Lapso&nbsp;<? print $lapsoProceso ?>
		</td>
		<td bgcolor="#A7A7A7">&nbsp</td>
		
		<td class="datosp">
			&nbsp;&nbsp;<B>Fecha:</B>&nbsp;<?echo date("d/m/Y");?>&nbsp;<?echo $hora?>
			&nbsp;&nbsp;&nbsp;&nbsp;<B>Lapso</B>:&nbsp;<? print $lapsoProceso ?><BR>
			
			&nbsp;&nbsp;<B>Docente:</B>&nbsp;<? print $nombdoc?>&nbsp;&nbsp;<? print $apedoc ?>&nbsp;<B>CI:</B>&nbsp;<? print $cidoc ?><BR>

			&nbsp;&nbsp;<B>Asignatura:</B>&nbsp;<? print $asig?>&nbsp;&nbsp;<B>C&oacute;digo:&nbsp;</B><?print $cod?><BR>
			
			&nbsp;&nbsp;<B>Secci&oacute;n:</B>&nbsp;<? print $secc?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			
			&nbsp;&nbsp;<B>Acta:</B>&nbsp;<? print $acta ?>
				 
		</td>
	</tr>
</table>
<BR>

<table align="center" border="1" cellpadding="0" cellspacing="1" width="660" style="border-collapse: collapse;border-color:black;">
	<tr bgcolor="#FFFFFF" class="enc_p2">
		<td style="width: 600px;" colspan="5">ESTUDIANTES INSCRITOS, AGREGADOS Y/O RETIRADOS</td>
	</tr>

	<tr bgcolor="#FFFFFF" class="enc_p2">
		<td style="width: 30px;">NRO</td>
		<td style="width: 100px;">EXPEDIENTE</td>
		<td style="width: 150px;">APELLIDOS</td>
		<td style="width: 150px;">NOMBRES</td>
		<td style="width: 130px;">ESTATUS</td>
	</tr>
			<?php
			$nota=array();
			$nro=0;
			foreach ($lista_e as $est){
				$nro++;
				$nota[$nro]=$nro;
				print "<tr>";
				print "<td><div class=\"inact\">$nro</div></td>";
				print "<td><div class=\"inact\">$est[0]</div></td>";
				print "<td><div class=\"inact2\">$est[1] $est[11]</div></td>";
				print "<td><div class=\"inact2\">$est[2] $est[12]</div></td>";
				if ($est[10] == 'A'){
					print "<td><div class=\"inact\">AGREGADO(A)</div></td>";
				}elseif ($est[10] == '2'){
					print "<td><div class=\"inact\">RETIRADO(A)</div></td>";
				}elseif ($est[10] == 'R'){
					print "<td><div class=\"inact\">RETIRADO(A) POR REGLAMENTO</div></td>";
				}
				print "</tr>";
				
			}
			if (isset($j)){
				print "<tr><td colspan=\"7\" class=\"inact2\">Se ha(n) agregado <B>$j</B> estudiantes a la secci&oacute;n</td></tr>";
			
			}

		?>
	<tr><td colspan="7" bgcolor="#000000" align="center"></td></tr></table>

<?php

//Lista de Estudiantes en COLA
$Cmat = new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
$mSQL = "select a.exp_e,a.apellidos,a.apellidos2,a.nombres,a.nombres2,b.status ";
$mSQL.= "from dace002 a,dace006 b ";
$mSQL.= "where b.lapso='$lapsoProceso' and a.exp_e=b.exp_e and b.acta ='$acta' ";
$mSQL.= "and b.status='Y' ORDER BY nro_prof";
$Cmat->ExecSQL($mSQL,__LINE__,true);
$lista_e=$Cmat->result;
$total=$Cmat->filas;

if($total > 0){
	?>

<BR>
<table align="center" border="1" cellpadding="0" cellspacing="1" width="660" style="border-collapse: collapse;border-color:black;">
	<tr bgcolor="#FFFF99" class="enc_p2">
		<td style="width: 600px;" colspan="6">ESTUDIANTES EN COLA (<?=$total?>)</td>
	</tr>

	<tr bgcolor="#99CCFF" class="enc_p2">
		<td style="width: 30px;">AGREGAR</td>
		<td style="width: 30px;">NRO</td>
		<td style="width: 100px;">EXPEDIENTE</td>
		<td style="width: 150px;">APELLIDOS</td>
		<td style="width: 150px;">NOMBRES</td>
		<td style="width: 130px;">ESTATUS</td>
	</tr>
	
	
	
	<form action="" method="POST" name="notas" onsubmit = "return confirm('ATENCI&Oacute;N: Est&aacute; a punto de incrementar el total de cupos en su secci&oacute;n. Adem&aacute;s ingresar&aacute; a la secci&oacute;n el(los) estudiante(s) seleccionado(s)\n\n¿Est&aacute; seguro que desea procesar su seleccion?\n\nPresione Aceptar para continuar o Cancelar para declinar la solicitud.')">
			<?php
			$nota=array();
			$nro=0;
			foreach ($lista_e as $est){
				$nro++;
				$nota[$nro]=$nro;
				print "<tr>";
				//casilla de seleccion
				print "<td> <div class=\"inact\"> <input type=\"checkbox\" name=\"$nro\" value=\"$est[0]\"></div></td>";
				//numero de la lista
				print "<td><div class=\"inact\">$nro</div></td>";
				//expediente
				print "<td><div class=\"inact\">$est[0]</div></td>";
				//apellidos
				print "<td><div class=\"inact2\">$est[1] $est[2]</div></td>";
				//nombres
				print "<td><div class=\"inact2\">$est[3] $est[4]</div></td>";
				if ($est[5] == 'Y'){
					//estatus en cola
					print "<td><div class=\"inact\">EN COLA</div></td>";
				}else{
					//estatus distinto de la cola
					print "<td><div class=\"inact\">NO ESTA EN COLA</div></td>";
				}
				print "</tr>";
			}
		?>
	<tr><td colspan="7" bgcolor="#000000" align="center"></td></tr></table>
<table align="center" border="0" cellpadding="0" cellspacing="1" width="660" style="border-collapse: collapse;border-color:black;">
	<tr>
		<td valign="top" colspan="3">
			<p align="center">
				<BR><input type="button" value="Cerrar" name="cerrar" id="exit" class="boton" onClick="goAway();">
			</p> 
        </td>
		<td valign="top" colspan="3">
			<p align="center">
				<INPUT TYPE="hidden" NAME="agrega" value="si">
				<INPUT TYPE="hidden" NAME="acta" value="<?=$acta?>">
				<INPUT TYPE="hidden" NAME="seccion" value="<?=$secc?>">
				<INPUT TYPE="hidden" NAME="c_asigna" value="<?=$cod?>">
				<INPUT TYPE="hidden" NAME="cedula" value="<?=$cedula?>">
				<INPUT TYPE="hidden" NAME="total" value="<?=$total?>">


				<BR><INPUT TYPE="submit" value="Agregar" class="boton">
			</p> 
        </td>
					<td valign="top" colspan="3"><p align="center">
                        <BR><input type="reset" value="Imprimir" name="imprimir" class="boton" onclick="window.print();"></p> 
                    </td>
                </tr>
</form>
</table>
<?php
}else {						 
?>
<table align="center" border="0" cellpadding="0" cellspacing="1" width="660" style="border-collapse: collapse;border-color:black;">
	<tr>
                    
                     <td valign="top" colspan="3"><p align="center">
                        <BR><input type="button" value="Cerrar" name="cerrar" id="exit" class="boton" 
                         onClick="goAway();"></p> 
                    </td>
					<td valign="top" colspan="3"><p align="center">
                        <BR><input type="reset" value="Imprimir" name="imprimir" class="boton" onclick="window.print();"></p> 
                    </td>
                </tr>
</form>
</table>
<?
}					 
?>
</body>
</html>