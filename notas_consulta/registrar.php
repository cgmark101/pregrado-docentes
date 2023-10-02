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
	$cedula=$_POST['cidoc'];
	/*print $acta;
	print $cedula;*/

}else echo "<script>document.location.href='../notas';</script>\n";

//NUMERO DE ACTAS
$Ccont = new ODBC_Conn("CENTURA-DACE","N","N");
$mSQL = "select distinct count(*) ";
$mSQL= $mSQL."from his_act ";
$mSQL= $mSQL."where his_ced='$cedula' and ";
$mSQL= $mSQL."his_lap='$lapsoProceso'  ";
$Ccont->ExecSQL($mSQL);
$reg=$Ccont->result;
foreach($reg as $reg1){}
$reg2=$reg1[0]-1;
//Consulta Anterior
$Cact = new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
$mSQL = "select distinct a.his_act ";
$mSQL= $mSQL."from his_act a,tblaca008 c,dace004 d ";
$mSQL= $mSQL."where a.his_cod=c.c_asigna and his_ced='$cedula' and ";
$mSQL= $mSQL."a.his_lap='$lapsoProceso' and a.his_cod=d.c_asigna and ";
$mSQL= $mSQL."a.his_lap=d.lapso and a.his_act=d.acta";
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

$fecha  = date('Y-m-d', time() - 3600*date('I'));
$hora   = date('h:i a', time() - 3600*date('I'));


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
  padding-left: 5px;
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

<?
//Consulta de notas incluidas
$Ccon = new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
$mSQL = "select a.exp_e,a.apellidos,a.nombres,b.acta,b.c_asigna,b.status,";
$mSQL= $mSQL."b.calificacion,c.asignatura,f.his_sec,e.ci,e.apellido,e.nombre,f.his_fec ";
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

//Contamos los inscritos
$Cins= new ODBC_Conn("CENTURA-DACE","N","N");
$mSQL = "select count(*) from dace004 where acta='$acta' and lapso='$lapsoProceso'";
$Cins->ExecSQL($mSQL);
$lista_i=$Cins->result;

foreach ($lista_i as $ins){}

//Contamos los retirados
$Cret= new ODBC_Conn("CENTURA-DACE","N","N");
$mSQL = "select count(*) from dace006 where acta='$acta' and lapso='$lapsoProceso' and status='2'";
$Cret->ExecSQL($mSQL);
$lista_r=$Cret->result;

foreach ($lista_r as $ret){}



?>
<title>CONSULTA DE NOTAS&nbsp;PARA&nbsp;<? print $nombdoc."  ".$apedoc." - ".$asig." - ".$lapsoProceso ?></title>

</head>
<body>
<table align="center" border="0" cellpadding="0" cellspacing="1" width="650">
	<tr>
		<td class="inact"><IMG SRC="imagenes/unex15.gif" WIDTH="75" HEIGHT="75" BORDER="0" ALT="">
		</td>
		
		<td class="inact" >Universidad Nacional Experimental Polit&eacute;cnica<BR>"Antonio Jos&eacute; de Sucre"<BR>Vicerrectorado&nbsp;<? print $vicerrectorado?><BR><? print $nombreDependencia  ?><BR> <? print $tProceso ?>&nbsp;Lapso&nbsp;<? print $lapsoProceso ?>
		</td>
		<td bgcolor="#A7A7A7">&nbsp</td>
		
		<td bgcolor="#FFFFFF" class="datosp">
			&nbsp;&nbsp;<B>Fecha:</B>&nbsp;<?echo date("d/m/Y");?>&nbsp;<B>Hora:</B>&nbsp;<? print $hora; ?>&nbsp;&nbsp;&nbsp;&nbsp;<B>Lapso</B>:&nbsp;<? print $lapsoProceso ?><BR>
			
			&nbsp;&nbsp;<B>Docente:</B>&nbsp;<? print $nombdoc?>&nbsp;&nbsp;<? print $apedoc ?>&nbsp;<B>CI:</B>&nbsp;<? print $cidoc ?><BR>

			&nbsp;<B>Secci&oacute;n:</B>&nbsp;<? print $secc?>&nbsp;&nbsp;<B>C&oacute;digo:&nbsp;</B><?print $cod?>&nbsp;&nbsp;<B>Acta:</B>&nbsp;<? print $acta ?><BR>
			&nbsp;<B>Asignatura:</B>&nbsp;<? print $asig?><BR>
			&nbsp;<B>Inscritos:</B>&nbsp;<? print $ins[0]?>&nbsp;&nbsp;&nbsp;<B>Retirados:</B>&nbsp;<? print $ret[0]?><BR>
			&nbsp;<B>Fecha de Carga:</B>&nbsp;<? print $est[12]?>
				 
		</td>
	</tr>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="1" width="660" style="border-collapse: collapse;border-color:black;">
	<tr>
		<td style="width: 20px;" class="enc_p">NRO</td>
		<td style="width: 70px;" class="enc_p">EXPEDIENTE</td>
		<td style="width: 140px;" class="enc_p">APELLIDOS</td>
		<td style="width: 140px;" class="enc_p">NOMBRES</td>
		<td style="width: 40px;" class="enc_p">NOTA</td>
		<td style="width: 120px;" class="enc_p">EN LETRAS</td>
		<td style="width: 70px;" class="enc_p">OBS</td>
       
	</tr>
	

	<form action="registrar.php" method="POST" name="notas" onsubmit = "return confirm('¿Esta seguro de incluir las notas de esta acta?\n Una vez ingresados no podran ser modificados')">
			<?php
			$nota=array();
			$nro=0;
			//Consulta de notas incluidas
			$Ccon = new ODBC_Conn("CENTURA-DACE","N","N");
				$mSQL="SELECT A.EXP_E,A.APELLIDOS,A.NOMBRES, B.CALIFICACION,";
				$mSQL= $mSQL."@DECODE(STATUS,'0','Aprobada', '1','Aplazada','I','Inasistente') ";
				$mSQL= $mSQL."FROM DACE002 A,DACE004 B ";
				$mSQL= $mSQL."WHERE A.EXP_E=B.EXP_E AND B.ACTA='$acta' and b.lapso='$lapsoProceso' ";
				$mSQL= $mSQL."UNION ";
				$mSQL= $mSQL."SELECT B.EXP_E,A.APELLIDOS,A.NOMBRES, B.CALIFICACION,";
				$mSQL= $mSQL."@DECODE(STATUS,'6','Eliminado', '2','Retirado','7','Inscrito','R','Retirado') ";
				$mSQL= $mSQL."FROM DACE002 A,DACE006 B ";
				$mSQL= $mSQL."WHERE A.EXP_E=B.EXP_E AND B.ACTA='$acta'  AND B.LAPSO='$lapsoProceso' ";
				$mSQL= $mSQL."ORDER BY 2";
			$Ccon->ExecSQL($mSQL);
			$lista_e=$Ccon->result;
			foreach ($lista_e as $reg){
				$nro++;
				//$nota[$nro]=$nro;
				$let=array();
				reset($let);
				//Buscar en la tabla el equivalente en letras
				$Clet = new ODBC_Conn("CENTURA-DACE","N","N");
				$mSQL = "select letras ";
				$mSQL= $mSQL."from letras ";
				$mSQL= $mSQL."where nota='$reg[3]'";
				$Clet->ExecSQL($mSQL);
				$letras=$Clet->result;
				foreach ($letras as $let)
			
				print "<tr>";
				print "<td><div class=\"inact\">$nro</div></td>";
				print "<td><div class=\"inact\">$reg[0]</div></td>";
				print "<td><div class=\"inact2\">$reg[1]</div></td>";
				print "<td><div class=\"inact2\">$reg[2]</div></td>";
				if(isset($reg[3]))print "<td><div class=\"inact\">$reg[3]</div></td>";
				else print "<td><div class=\"inact3\"></div></td>";
				if(isset($let[0]))print "<td><div class=\"inact3\">$let[0]</div></td>";
				else print "<td><div class=\"inact2\"></div></td>";
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