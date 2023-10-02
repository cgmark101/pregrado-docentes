<?php
include_once ('inc/vImage.php');
include_once ('inc/odbcss_c.php');
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
$hora   = date('h:i:s', time() - 3600*date('I'));
$nro=$_POST['nro'];

//print $fecha;
//print $hora;
$que='Acta Incluida';
$sw2 = '0';
///print "sw2 inicial";
//print $sw2;
for ($i = 1; $i <= $nro; $i++) {
        $sw2 = '0';
		$nota=$_POST['nota_' . $i];
		$exp=$_POST['exp_' . $i];
		
		if ($nota == '0'){
			$nota = 'I';
			//print "cambio la nota ";
			//print $nota;
		}
			
		if (empty($nota)){
			$sw2 = '1'; 
			//print "La nota esta vacia";
			break;
		}	

		if ($nota >= '1'){
			if ($nota <= '4.9'){
				$estatus = '1';
			}
		}
			
		if ($nota >= '5'){
			if ($nota <= '9'){
				$estatus = '0';
			}
		}
			
		if ($nota == 'I'){
			$estatus = 'I';
			$nota = '1';
		}


		$Cnot = new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
		$mSQL = "INSERT INTO DACE004 (CALIFICACION,ACTA,C_ASIGNA,EXP_E,LAPSO,STATUS,STATUS_RR,AFEC_INDICE)";
		//$mSQL= $mSQL." ";
		$mSQL= $mSQL." VALUES  ('$nota','$acta','$cod','$exp','$lapsoProceso', ";
		$mSQL= $mSQL."'$estatus','$statusr','$afecind')";
		$Cnot->ExecSQL($mSQL,__LINE__,true);
		
		$Caud = new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
		$mSQL = "INSERT INTO AUDITORIA ";
		$mSQL= $mSQL."(USER_ID,TABLA,CAMPO1,CAMPO2,CAMPO3,CAMPO4,FECHA,HORA,QUE) ";
		$mSQL= $mSQL." VALUES  ('$cidoc','$exp','$cod','$acta','$seccion', ";
		$mSQL= $mSQL."'$lapsoProceso','$fecha','$hora','$que')";	
		$Caud->ExecSQL($mSQL,__LINE__,true);

	

}//fin del bucle for
//print "el valor de sw es";
//print $sw2;
if ($sw2 == '1') {
	//print "salir del sistema";
	echo "<script>document.location.href='../notas/error1.php';</script>\n";
}else{
	

//Contamos los retirados
$Cret= new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
$mSQL = "select count(*) from dace006 where acta='$acta' and lapso='$lapsoProceso' and status='2'";
$Cret->ExecSQL($mSQL,__LINE__,true);
$lista_r=$Cret->result;

foreach ($lista_r as $ret){}

//INSERTAMOS EN HISTORICO DE ACTA
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

?>

<!-- ACTA ELECTRONICA SOLO INFORMATIVA-->
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	
<?php

include_once('../notas/inc/vImage.php');
include_once('C:/Appserv/www/Dace/inc/odbcss_c.php');
include_once ('../notas/inc/config.php');
include_once ('C:/Appserv/www/Dace/inc/activaerror.php');

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
  font-size: 10px; 
  font-weight: normal;
  background-color:#F0F0F0;
}
.inact2 {
  text-align: left; 
  font-family:Arial; 
  font-size: 10px; 
  font-weight: normal;
  background-color:#F0F0F0;
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
  background-color:#F0F0F0; 
  font-variant: small-caps;
}

-->
</style>

<?
//Consulta de notas incluidas
$Ccon = new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
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
<title>CONSULTA DE NOTAS&nbsp;PARA&nbsp;<? print $nombdoc."  ".$apedoc." - ".$asig." - ".$lapsoProceso ?></title>

</head>
<body>
<table align="center" border="0" cellpadding="0" cellspacing="1" width="650">
	<tr>
		<td class="inact"><IMG SRC="imagenes/unex15.gif" WIDTH="75" HEIGHT="75" BORDER="0" ALT="">
		</td>
		
		<td class="inact">Universidad Nacional Experimental Polit&eacute;cnica<BR>"Antonio Jos&eacute; de Sucre"<BR>Vicerrectorado&nbsp;<? print $vicerrectorado?><BR><? print $nombreDependencia  ?><BR> <? print $tProceso ?>&nbsp;Lapso&nbsp;<? print $lapsoProceso ?>
		</td>
		<td bgcolor="#A7A7A7">&nbsp</td>
		
		<td bgcolor="#EFEFEF" class="datosp">
			&nbsp;&nbsp;<B>Fecha:</B>&nbsp;<?echo date("d/m/Y");?>&nbsp;<B>Hora:</B>&nbsp;<? print $hora; ?>&nbsp;&nbsp;&nbsp;&nbsp;<B>Lapso</B>:&nbsp;<? print $lapsoProceso ?><BR>
			
			&nbsp;&nbsp;<B>Docente:</B>&nbsp;<? print $nombdoc?>&nbsp;&nbsp;<? print $apedoc ?>&nbsp;<B>CI:</B>&nbsp;<? print $cidoc ?><BR>

			&nbsp;<B>Secci&oacute;n:</B>&nbsp;<? print $_POST['seccion']?>&nbsp;&nbsp;<B>C&oacute;digo:&nbsp;</B><?print $cod?>&nbsp;&nbsp;<B>Acta:</B>&nbsp;<? print $acta ?><BR>
			&nbsp;<B>Asignatura:</B>&nbsp;<? print $asig?><BR>
			&nbsp;<B>Inscritos:</B>&nbsp;<? print $nro?>&nbsp;&nbsp;&nbsp;<B>Retirados:</B>&nbsp;<? print $ret[0]?>
				 
		</td>
	</tr>
	<tr><td colspan="4" bgcolor="#000000"></td></tr>
	<tr><td colspan="4" bgcolor="#000000"></td></tr>
	<tr><td colspan="4" bgcolor="#000000"></td></tr>
</table>
<table align="center" border="0" cellpadding="0" cellspacing="1" width="650">


	<tr>
		<td style="width: 20px;" class="enc_p">NRO</td>
		<td style="width: 70px;" class="enc_p">EXPEDIENTE</td>
		<td style="width: 140px;" class="enc_p">APELLIDOS</td>
		<td style="width: 140px;" class="enc_p">NOMBRES</td>
		<td style="width: 40px;" class="enc_p">NOTA</td>
		<td style="width: 120px;" class="enc_p">EN LETRAS</td>
		<td style="width: 70px;" class="enc_p">OBSERVACIONES</td>
       
	</tr>
	<tr><td colspan="7" bgcolor="#000000"></td></tr>
	<tr><td colspan="7" bgcolor="#000000"></td></tr>
	<tr><td colspan="7" bgcolor="#000000"></td></tr>

	<form action="registrar.php" method="POST" name="notas" onsubmit = "return confirm('¿Esta seguro de incluir las notas de esta acta?\n Una vez ingresados no podran ser modificados')">
			<?
			$nota=array();
			$nro=0;
			foreach ($lista_c as $est){
				$nro++;
				//$nota[$nro]=$nro;
				//Buscar en la tabla el equivalente en letras
				$Clet = new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
				$mSQL = "select letras ";
				$mSQL= $mSQL."from letras ";
				$mSQL= $mSQL."where nota='$est[6]'";
				$Clet->ExecSQL($mSQL,__LINE__,true);
				$letras=$Clet->result;
				foreach ($letras as $let)
				//Seleccionar estatus
				
				if ($est[5] == '0'){
					$estatus = "Aprobado";
				}
				if ($est[5] == '1'){
					$estatus = 'Reprobado';
				}
				if ($est[5] == 'I'){
					$estatus = 'Inasistente';
				}			

				print "<tr>";
				print "<td><div class=\"inact\">$nro</div></td>";
				print "<td><div class=\"inact\">$est[0]</div></td>";
				print "<td><div class=\"inact2\">$est[1]</div></td>";
				print "<td><div class=\"inact2\">$est[2]</div></td>";
				print "<td><div class=\"inact\">$est[6]</div></td>";
				print "<td><div class=\"inact3\">$let[0]</div></td>";
				print "<td><div class=\"inact2\">$estatus</div></td>";
				
				print "</tr>";
				}
		?>
	<tr><td colspan="7" bgcolor="#000000" align="center"></td></tr>
	<tr><td colspan="7" bgcolor="#000000" align="center"></td></tr>
	<tr><td colspan="7" bgcolor="#000000" align="center"></td></tr>
	<tr><td colspan="7"><FONT SIZE="2" COLOR="#FF0000" FACE="arial"><B>ATENCION:</B><UL>
	<LI>Acta solo con fines informativos para uso docente.
	<LI>Acta original retirar por su departamento para verificaci&oacute;n y firma.
	
</UL></FONT></td></tr>
	<tr>
                    
                    <td valign="top" colspan="3"><p align="center">
                        <BR><input type="button" value="Cerrar" name="cerrar" class="boton" 
                         onclick="javascript:self.close();"></p> 
                    </td>
					<td valign="top" colspan="4"><p align="center">
                        <BR><input type="reset" value="Imprimir" name="imprimir" class="boton" onclick="window.print();"></p> 
                    </td>
                   
                </tr>
</form>
</table>
</body>
</html>