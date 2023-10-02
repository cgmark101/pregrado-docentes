<?php include('encabezado.php'); 


?>
<link rel="stylesheet" type="text/css" href="css/Ntooltip.css" />
<link href="css/estilo.css" rel="stylesheet" type="text/css"><table width="720" border="0" align="center">
  <tr>
  <td colspan="4" align="center" class="titulo_tabla"><div align="center">Datos del Funcionario URACE</div></td>
  </tr>
   <tr> 
	<td class="datosp" align="center"><strong>Apellidos:</strong></td>
	
    <td class="datosp" align="center"><strong>Nombres:</strong></td>
    <td class="datosp" align="center"><strong>Cedula</strong> </td>
    <td class="datosp" align="center"><strong>ID Usuario</strong> </td>
  </tr>
   <tr>
     <td class="datosp" align="center"><?php echo $apellido; ?></td>
     <td class="datosp" align="center"><?php echo $nombre; ?></td>
     <td class="datosp" align="center"><?php echo $ced; ?></td>
     <td class="datosp" align="center"><?php echo $ced; ?></td>
   </tr>
  </table>

	<?php //include("menu_opciones_pend.php")?>


<table width="700" border="0" align="center">
  <tr>
  <FORM METHOD=POST ACTION="v_acta_pend.php">
	
  
  <td colspan="4" align="center" class="sub_tabla"><div align="center">
    <p>&nbsp;</p>
	
    <p>Actas Pendientes <br />
      Asignaturas que puede seleccionar: </p>
  </div></td>
  </tr>
  
   <tr> 
   	<td align="center" class="enc_p">C&Oacute;DIGO</td>
	<td class="enc_p" align="center">ASIGNATURA</td>
    <td class="enc_p" align="center">SECCI&Oacute;N </td>
    <td class="enc_p2" align="center">OPCIÓN</td>
  </tr>
  

<?php
if($user=='0'):
$dSQL="SELECT DISTINCT a.c_asigna, a.seccion, c.asignatura FROM sc_tg_temp a, tblaca009 b, tblaca008 c WHERE a.c_asigna=b.c_asigna and a.c_asigna=c.c_asigna and b.obligatoria='1'   
UNION 
SELECT DISTINCT a.c_asigna, a.seccion, c.asignatura FROM sc_pp_temp a, tblaca009 b, tblaca008 c WHERE a.c_asigna=b.c_asigna and a.c_asigna=c.c_asigna and b.obligatoria='1' 
UNION
SELECT DISTINCT a.c_asigna, a.seccion, c.asignatura FROM sc_temp a, tblaca009 b, tblaca008 c WHERE a.c_asigna=b.c_asigna and a.c_asigna=c.c_asigna and a.c_asigna='300622'";
elseif($user=='75'):
$dSQL="SELECT DISTINCT a.c_asigna, a.seccion, c.asignatura 
FROM sc_temp a, tblaca009 b, tblaca008 c
WHERE 
a.c_asigna='300622' and
a.c_asigna=b.c_asigna and 
a.c_asigna=c.c_asigna 
ORDER BY 1";
elseif($user=='700'):
$dSQL="SELECT DISTINCT a.c_asigna, a.seccion, c.asignatura FROM sc_pp_temp a, tblaca009 b, tblaca008 c WHERE a.c_asigna=b.c_asigna and a.c_asigna=c.c_asigna  GROUP BY a.c_asigna, a.seccion,c.asignatura ORDER BY 3 ASC";
else:
$dSQL="SELECT DISTINCT a.c_asigna, a.seccion, c.asignatura FROM sc_tg_temp a, tblaca009 b, tblaca008 c WHERE a.c_asigna=b.c_asigna and a.c_asigna=c.c_asigna and a.c_asigna='$c_asignad' ORDER BY 3 ASC";
endif;
//Se consultan las actas de las obligatorias en tg_temp
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = $dSQL;     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;
for($i=0; $i < count($result); $i++) {
	$cod[$i]=$result[$i][0];
	$sec[$i]=$result[$i][1];
	//$act[$i]=$result[$i][2];
	$asigna[$i]=$result[$i][2];
?>
	<tr>
  		<td class="datosp"><strong><?php echo $cod[$i]; ?></strong></td>
		<td class="datosp"><?php echo $asigna[$i];?></td>
		<td class="datosp"><?php  echo $sec[$i];  ?></td>
        <td class="inact2"><INPUT TYPE="radio" NAME="actap" VALUE="<?php  echo $asigna[$i]; ?>"></td>
	</tr>
<?php 

} 

?>


	
 </table>
 




<table width="800" border="0" align="center">
<tr>
<td class="datospd">
                                        
      <?php 
if($fila >= '1'): 	
	echo "<INPUT TYPE='submit' value='Continuar' class='boton'>";

	echo "<input value='$ced' name='ced' type='hidden'>";
else:
echo  ' ';
endif;
?>
                   
			

 
</td>

</tr>

</table>
</FORM>	
 
			
		
<p class="titulo_tabla">
  <SCRIPT LANGUAGE="JavaScript">
<!--

	function validarN(campo) {

			var cadena = campo.value;
			var nums="1234567890";
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

	function checkFields() {
		missinginfo = "";
		if (document.cacta.acta.value == "") {
			missinginfo += "\n     -  Acta";
		}
		if (missinginfo != "") {
			missinginfo ="EL NÚMERO DE ACTA ES REQUERIDO PARA CONTINUAR";
			alert(missinginfo);
			return false;
		}
		else return true;
		}
//-->
</SCRIPT>
</p>
<?php

echo '';
//endif;
?>