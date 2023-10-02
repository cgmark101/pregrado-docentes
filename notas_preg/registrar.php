<?php
	include_once('inc/vImage.php');
    include_once('inc/odbcss_c.php');
	include_once ('inc/config.php');
	include_once ('inc/activaerror.php');

print $noCache; 
print $noJavaScript; 

//print_r($HTTP_POST_VARS);

if(isset($_POST['acta'])) {
	
	$acta=$_POST['acta'];
	//$cedula=$_POST['cedula'];
	/*print $acta;
	print $cedula;*/

}else echo "<script>document.location.href='../notas';</script>\n";


$fecha  = date('Y-m-d', time() - 3600*date('I'));
//$hora   = date('h:i:s', time() - 3600*date('I'));
$h = "4.5";
$hm = $h*60;
$ms = $hm*60;
$hora = gmdate("g:i a",time()-($ms));

$nro=$_POST['nro'];
$notasOK=$_POST['notOK'];

//print $fecha;
//print $hora;
$que='Acta Incluida';
$sw2 = '0';

if ($notasOK){
	$Cnot = new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
	$Cnot->iniciarTransaccion("usuario: ".$cidoc." - acta: ".$acta." \n Inicio Transaccion");
	for ($i = 1; $i <= $nro; $i++) {
			$sw2 = '0';
			$nota=$_POST['nota_' . $i];
			$exp=$_POST['exp_' . $i];
			
			if ($nota == '0'){
				$nota = 'I';
			}	
			if (($nota >= '1') and ($nota <= '4.9')){
				$estatus = '1';
			}	
			if (($nota >= '5.0') and ($nota <= '9')){
				$estatus = '0';
			}
			if ($nota == 'I'){
				$estatus = 'I';
				$nota = '1';
			}

			if (empty($nota)){
				$sw2 = '1'; 
				//print "La nota esta vacia";
				break;
			}else{
				//Insertamos las calificaciones en DACE004
				
				$mSQL = "INSERT INTO DACE004 (CALIFICACION,ACTA,C_ASIGNA,EXP_E,LAPSO,STATUS,STATUS_RR,AFEC_INDICE) ";
				$mSQL.= "VALUES ('".$nota."','".$acta."','".$c_asigna."','".$exp."','".$lapsoProceso."',";
				$mSQL.= "'".$estatus."','".$statusr."','".$afecind."')";
				$Cnot->ExecSQL($mSQL,__LINE__,true);
				$notasOK = ($Cnot->fmodif > 0);
			
				//Insertamos las calificaciones en AUDITORIA
				$tipo_usuario=$_POST['tipo_usuario'];
				$userid=$_POST['userid'];
				
				if ($tipo_usuario > 1000){
					$citemp=$cidoc;
					$cidoc=$userid;
				}
				$Caud = new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
				$mSQL = "INSERT INTO AUDITORIA ";
				$mSQL= $mSQL."(USER_ID,TABLA,CAMPO1,CAMPO2,CAMPO3,CAMPO4,FECHA,HORA,QUE) ";
				$mSQL= $mSQL." VALUES  ('$cidoc','$exp','$cod','$acta','$seccion', ";
				$mSQL= $mSQL."'$lapsoProceso','$fecha','$hora','$que')";	
				$Caud->ExecSQL($mSQL,__LINE__,true);
								
				if(isset($citemp)){$cidoc=$citemp;}
			}	

	}//fin del bucle for
}//fin notasOK

if ($sw2 == '1') {
	//print "salir del sistema";
	echo "<script>document.location.href='../notas/error1.php';</script>\n";
}else{
//Contamos los retirados
$Cret= new ODBC_Conn("CENTURA-DACE","c","c",$ODBCC_conBitacora, $laBitacora);
$mSQL = "select count(*) from dace006 where acta='$acta' and lapso='$lapsoProceso' and status='2'";
$Cret->ExecSQL($mSQL,__LINE__,true);
$lista_r=$Cret->result;

foreach ($lista_r as $ret){}

//INSERTAMOS EN HISTORICO DE ACTA
if ($notasOK){
$Chis = new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
$mSQL = "INSERT INTO HIS_ACT";
$mSQL= $mSQL."(HIS_ACT,HIS_CED,HIS_SEC,HIS_LAP,HIS_COD,HIS_FEC,HIS_INS,HIS_RET) ";
$mSQL= $mSQL." VALUES ('$acta','$cidoc','$seccion','$lapsoProceso','$cod', ";
$mSQL= $mSQL."'$fecha','$nro','$ret[0]')";
$Chis->ExecSQL($mSQL,__LINE__,true);

//BORRAMOS EL ACTA DE DACE006
$Cdel06 = new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
$dSQL   = "DELETE FROM dace006 WHERE lapso='$lapsoProceso' AND acta='$acta' ";
$dSQL   = $dSQL . "AND c_asigna='$cod' AND seccion='$seccion' AND (status='7' OR status='A')";
$Cdel06->ExecSQL($dSQL,__LINE__,true);

//BORRAMOS EL ACTA DE TBLACA004
$Cdel04 = new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
$dSQL   = "DELETE FROM tblaca004 WHERE lapso='$lapsoProceso' AND acta='$acta' ";
$dSQL   = $dSQL . "AND c_asigna='$cod' AND seccion='$seccion'";
$Cdel04->ExecSQL($dSQL,__LINE__,true);}

$Cdel04->finalizarTransaccion("usuario: ".$cidoc." - Fin Transaccion \n");
}
?>

<!-- ACTA ELECTRONICA SOLO INFORMATIVA-->
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>

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
//Consulta de notas incluidas
$Ccon = new ODBC_Conn("CENTURA-DACE","c","c",$ODBCC_conBitacora, $laBitacora);
$mSQL = "select a.exp_e,a.apellidos,a.nombres,b.acta,b.c_asigna,b.status,";
$mSQL= $mSQL."b.calificacion,c.asignatura,f.his_sec,e.ci,e.apellido,e.nombre ";
$mSQL= $mSQL."from dace002 a,dace004 b,tblaca008 c,tblaca007 e,his_act f ";
$mSQL= $mSQL."where b.lapso='$lapsoProceso' and b.acta ='$acta' and f.his_ced='$cidoc' ";
$mSQL= $mSQL."and a.exp_e=b.exp_e and b.c_asigna=c.c_asigna ";
$mSQL= $mSQL."and b.c_asigna=f.his_cod and b.lapso=f.his_lap ";
$mSQL= $mSQL."and b.acta=f.his_act and f.his_ced=e.ci order by 2";
$Ccon->ExecSQL($mSQL,__LINE__,true);
$lista_c=$Ccon->result;

foreach ($lista_c as $est){
	$secc = $est[8];
	$acta = $est[3];
	$cidoc = $est[9];
	$nombdoc = $est[11];
	$apedoc = $est[10];
	$asig = $est[7];
	$cod = $est[4];
}

?>
<title>CONSULTA DE NOTAS&nbsp;PARA&nbsp;<?php print $nombdoc."  ".$apedoc." - ".$asig." - ".$lapsoProceso ?></title>

</head>
<body <?php global $botonDerecho; echo $botonDerecho; ?>>
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
		<td style="width: 20px;" class="enc_p">NRO</td>
		<td style="width: 70px;" class="enc_p">EXPEDIENTE</td>
		<td style="width: 140px;" class="enc_p">APELLIDOS</td>
		<td style="width: 140px;" class="enc_p">NOMBRES</td>
		<td style="width: 40px;" class="enc_p">NOTA</td>
		<td style="width: 120px;" class="enc_p">EN LETRAS</td>
		<td style="width: 70px;" class="enc_p">OBSERVACIONES</td>
	</tr>

	<form action="registrar.php" method="POST" name="notas" onsubmit = "return confirm('¿Esta seguro de incluir las notas de esta acta?\n Una vez ingresados no podran ser modificados')">
			<?php 
			$nota=array();
			$nros=0;
			$nro=0;
			//Consulta de notas incluidas
			$Ccon = new ODBC_Conn("CENTURA-DACE","c","c");
				$mSQL="SELECT A.EXP_E,A.APELLIDOS,A.NOMBRES,B.CALIFICACION,";
				$mSQL= $mSQL."@DECODE(STATUS,'0','Aprobada','1','Aplazada','I','Inasistente') ";
				$mSQL= $mSQL."FROM DACE002 A,DACE004 B ";
				$mSQL= $mSQL."WHERE A.EXP_E=B.EXP_E AND B.ACTA='$acta' and b.lapso='$lapsoProceso' ";
				$mSQL= $mSQL."UNION ";
				$mSQL= $mSQL."SELECT B.EXP_E,A.APELLIDOS,A.NOMBRES,B.CALIFICACION,";
				$mSQL= $mSQL."@DECODE(STATUS,'6','Eliminado', '2','Retirado','7','Inscrito','R','Retirado') ";
				$mSQL= $mSQL."FROM DACE002 A,DACE006 B ";
				$mSQL= $mSQL."WHERE A.EXP_E=B.EXP_E AND B.ACTA='$acta' AND B.LAPSO='$lapsoProceso' ";
				$mSQL= $mSQL."ORDER BY 2";
			$Ccon->ExecSQL($mSQL);
			$lista_e=$Ccon->result;
			foreach ($lista_e as $reg){
				$nros++;
				$nro++;
				//$nota[$nro]=$nro;
				$let=array();
				reset($let);
				//Buscar en la tabla el equivalente en letras
				$Clet = new ODBC_Conn("CENTURA-DACE","c","c");
				$mSQL = "select letras ";
				$mSQL= $mSQL."from letras ";
				$mSQL= $mSQL."where nota='$reg[3]'";
				$Clet->ExecSQL($mSQL);
				$letras=$Clet->result;
				foreach ($letras as $let)	

				print "<tr>";
				print "<td><div class=\"inact\">$nros</div></td>";
				print "<td><div class=\"inact\">$reg[0]</div></td>";
				print "<td><div class=\"inact2\">$reg[1]</div></td>";
				print "<td><div class=\"inact2\">$reg[2]</div></td>";
				if(isset($reg[3])){$nro--;print "<td><div class=\"inact\">$reg[3]</div></td>";}
				else print "<td><div class=\"inact3\">&nbsp;</div></td>";
				if(isset($let[0])){$nro--;print "<td><div class=\"inact3\">$let[0]</div></td>";}
				else print "<td><div class=\"inact2\">&nbsp;</div></td>";
				print "<td><div class=\"inact2\">$reg[4]</div></td>";
				
				print "</tr>";
				}
		?>
	<tr><td colspan="7" bgcolor="#000000" align="center"></td></tr></table>

	<table align="center" border="0" cellpadding="0" cellspacing="1" width="660" style="border-collapse: collapse;border-color:black;">
	<tr><td colspan="7"><FONT SIZE="2" COLOR="#FF0000" FACE="arial"><B>ATENCION:</B><UL>
	<LI>Acta solo con fines informativos para uso docente.
	<LI>Acta original retirar por su departamento para verificaci&oacute;n y firma.
	
</UL></FONT></td></tr>
	<tr>
                    
                    <td valign="top"><p align="center">
                        <BR><input type="button" value="Cerrar" name="cerrar" class="boton" 
                         onclick="javascript:self.close();"></p> 
                    </td>
					<td valign="top"><p align="center">
                        <BR><input type="reset" value="Imprimir" name="imprimir" class="boton" onclick="window.print();"></p> 
                    </td>
                   
                </tr>
</form>
</table>
</body>
</html>