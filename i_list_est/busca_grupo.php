<?php
include_once('inc/odbcss_c.php');
include_once ('inc/config.php');

$c_asigna = $_POST['c_asigna'];
$seccion = $_POST['seccion'];
$grupo = $_POST['grupo'];


//Lista de Estudiantes
$Cmat = new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
$mSQL = "SELECT a.exp_e,apellidos||' '||apellidos2,nombres||' '||nombres2,status,incluye ";
$mSQL.= "FROM dace002 a,dace006 b ";
$mSQL.= "WHERE b.lapso='".$lapsoProceso."' and a.exp_e=b.exp_e ";
$mSQL.= "AND b.c_asigna='".$c_asigna."' AND b.seccion='".$seccion."' ";

if($grupo != "123"){
	$mSQL.= " AND incluye='".$grupo."' ";
}

$mSQL.= "AND (b.status='7' or b.status='A' or b.status='2' or b.status='R') order by 2";
$Cmat->ExecSQL($mSQL,__LINE__,true);
$lista_e=$Cmat->result;

?>

<table align="center" border="1" cellpadding="0" cellspacing="1" width="660" style="border-collapse: collapse;border-color:black;">

<?php if($grupo != "123"){?>
	<tr bgcolor="#FFFFFF" class="enc_p2">
		<td colspan="6">ESTUDIANTES PERTENECIENTES AL GRUPO <?php echo $grupo; ?></td>
	</tr>
<?php }?>


	<tr bgcolor="#FFFFFF" class="enc_p2">
		<td style="width: 30px;">NRO</td>
		<td style="width: 30px;">GRUPO</td>
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
				print "<td><div class=\"inact\">$est[4]</div></td>";
				print "<td><div class=\"inact\">$est[0]</div></td>";
				print utf8_encode("<td><div class=\"inact2\">$est[1]</div></td>");
				print utf8_encode("<td><div class=\"inact2\">$est[2]</div></td>");
				if ($est[3] == 'A'){
					print "<td><div class=\"inact\">AGREGADO(A)</div></td>";
				}elseif ($est[10] == '2'){
					print "<td><div class=\"inact\">RETIRADO(A)</div></td>";
				}elseif ($est[10] == 'R'){
					print "<td><div class=\"inact\">RETIRADO(A) POR REGLAMENTO</div></td>";
				}
				print "</tr>";
			}
		?>
<tr><td colspan="7" bgcolor="#000000" align="center"></td></tr></table>

<?php 

//Lista de Estudiantes EN COLA
$Cmat = new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
$mSQL = "SELECT a.exp_e,apellidos||' '||apellidos2,nombres||' '||nombres2,status,incluye ";
$mSQL.= "FROM dace002 a,dace006 b ";
$mSQL.= "WHERE b.lapso='".$lapsoProceso."' and a.exp_e=b.exp_e ";
$mSQL.= "AND b.c_asigna='".$c_asigna."' AND b.seccion='".$seccion."' AND incluye='".$grupo."' ";
$mSQL.= "and b.status='Y' ORDER BY nro_prof";
$Cmat->ExecSQL($mSQL,__LINE__,true);
$lista_e=$Cmat->result;


//Lista de Estudiantes en COLA
/*$Cmat = new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
$mSQL = "select a.exp_e,a.apellidos,a.apellidos2,a.nombres,a.nombres2,b.status ";
$mSQL.= "from dace002 a,dace006 b ";
$mSQL.= "where b.lapso='$lapsoProceso' and a.exp_e=b.exp_e and b.acta ='$acta' ";
$mSQL.= "and b.status='Y' ORDER BY nro_prof";
$Cmat->ExecSQL($mSQL,__LINE__,true);
$lista_e=$Cmat->result;
$total=$Cmat->filas;*/

if($total > 0){
	?>

<BR>
<table align="center" border="1" cellpadding="0" cellspacing="1" width="660" style="border-collapse: collapse;border-color:black;">
	<tr bgcolor="#FFFF99" class="enc_p2">
		<td style="width: 650px;" colspan="6">ESTUDIANTES EN COLA (<?=$total?>)</td>
	</tr>

	<tr bgcolor="#99CCFF" class="enc_p2">
		<!-- <td style="width: 30px;">AGREGAR</td> -->
		<td style="width: 30px;">NRO</td>
		<td style="width: 100px;">EXPEDIENTE</td>
		<td style="width: 150px;">APELLIDOS</td>
		<td style="width: 150px;">NOMBRES</td>
		<td style="width: 130px;">ESTATUS</td>
	</tr>
		<?
			$nota=array();
			$nro=0;
			foreach ($lista_e as $est){
				$nro++;
				$nota[$nro]=$nro;
				print "<tr>";
				/*print "<td>
						<div class=\"inact\">
							<input type=\"checkbox\" name=\"$nro\" value=\"$est[0]\" disabled=\"disabled\">
						</div>
					   </td>";*/
				print "<td><div class=\"inact\">$nro</div></td>";
				print "<td><div class=\"inact\">$est[0]</div></td>";
				print "<td><div class=\"inact2\">$est[1] $est[2]</div></td>";
				print "<td><div class=\"inact2\">$est[3] $est[4]</div></td>";
				if ($est[3] == 'Y'){
					print "<td><div class=\"inact\">EN COLA</div></td>";
				}
				print "</tr>";
			}
}
?>
<tr><td colspan="7" bgcolor="#000000" align="center"></td></tr></table>

<table align="center" border="0" cellpadding="0" cellspacing="1" width="660" style="border-collapse: collapse;border-color:black;">
	<tr>
                    
                     <td valign="top" colspan="3"><p align="center">
                        <BR><input type="button" value="Cerrar" name="cerrar" id="exit" class="boton" 
                         onClick="window.close();"></p> 
                    </td>
					<td valign="top" colspan="3"><p align="center">
                        <BR><input type="reset" value="Imprimir" name="imprimir" class="boton" onclick="window.print();"></p> 
                    </td>
                </tr>
</table>