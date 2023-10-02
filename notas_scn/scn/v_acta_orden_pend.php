<?php //recordar poner cada una de las asignaturas ue se quieren mostrar tanto por lapso como por fecha : solo estan: 355959, 300622
error_reporting(E_ALL);
include_once('inc/config.php');
require_once('inc/odbcss_c.php');
include('encabezado.php'); 

$boton=$_POST['B1'];
//echo $boton;
//echo '<br />';

if($boton==1):
$lapso=$_POST['lapso'];
//echo $lapso;
//echo '<br />';

?>
	<?php include("menu_opciones_pend.php")?>

<table width="700" border="0" align="center">
  <tr>
  <td colspan="6" align="center" class="sub_tabla"><div align="center">
    <p>&nbsp;</p>
	
    <p>Asignaturas que puede seleccionar: </p>
  </div></td>
  
  </tr>
   <tr> 
    <td class="enc_p" align="center"><strong>FECHA</strong></td>
    <td class="enc_p" align="center"><strong>LAPSO</strong></td>
	<td class="enc_p" align="center"><strong>C&Oacute;DIGO</strong></td>
	<td class="enc_p" align="center"><strong>ASIGNATURA</strong></td>
    <td class="enc_p" align="center"><strong>SECCI&Oacute;N </strong></td>
    <td class="enc_p2" align="center">N&Uacute;MERO DE  ACTA  </td>
  </tr>
  <?php
//Se consultan las actas de las obligatorias en tg_temp
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT a.c_asigna, a.seccion, a.acta, a.fecha, a.lapso, c.asignatura FROM sc_tg_temp a, tblaca009 b, tblaca008 c WHERE a.c_asigna=b.c_asigna and a.c_asigna=c.c_asigna and b.obligatoria='1' and a.lapso='$lapso' ORDER BY 3 ASC ";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
for($i=0; $i < count($result); $i++) {
$cod[$i]=$result[$i][0];
$sec[$i]=$result[$i][1];
$act[$i]=$result[$i][2];
$fec[$i]=$result[$i][3];
$lap[$i]=$result[$i][4];
$asigna[$i]=$result[$i][5];
?><tr>
		  <td class="datosp"><?php echo $fec[$i];?></td>
		  <td class="datosp"><?php echo $lap[$i];?></td>
		  <td class="datosp"><strong><?php echo $cod[$i]; ?></strong></td>
		  <td class="datosp"><?php echo $asigna[$i];?></td>
		  <td class="datosp"><?php  echo $sec[$i];  ?></td>
          <td class="inact2"><?php  echo $act[$i]; ?></td>
          
  </tr>
<?php } ?>

<?php
//Se consultan las actas de Servicio Comunitario en sc_temp
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT a.c_asigna, a.seccion, a.acta, a.fecha, a.lapso FROM sc_temp a WHERE a.c_asigna='300622' and a.lapso='$lapso'";     
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
for($i=0; $i < count($result); $i++) {
$cod[$i]=$result[$i][0];
$sec[$i]=$result[$i][1];
$act[$i]=$result[$i][2];
$fec[$i]=$result[$i][3];
$lap[$i]=$result[$i][4];
$asigna[$i]='SERVICIO COMUNITARIO';
?><tr>
		  <td class="datosp"><?php echo $fec[$i];?></td>
		  <td class="datosp"><?php echo $lap[$i];?></td>
		  <td class="datosp"><strong><?php echo $cod[$i]; ?></strong></td>
		  <td class="datosp"><?php echo $asigna[$i];?></td>
		  <td class="datosp"><?php  echo $sec[$i];  ?></td>
          <td class="inact2"><?php  echo $act[$i]; ?></td>
          
  </tr>
<?php } ?>
		
 

<?php
else:
$fecha=$_POST['fecha'];
//echo $fecha;
//echo '<br />';

$fecha2=$_POST['fecha2'];
//echo $fecha2;
 include("menu_opciones_pend.php")?>

<table width="700" border="0" align="center">
  <tr>
  <td colspan="6" align="center" class="sub_tabla"><div align="center">
    <p>&nbsp;</p>
	
    <p>Asignaturas que puede seleccionar: </p>
  </div></td>
  
  </tr>
   <tr> 
    <td class="enc_p" align="center"><strong>FECHA</strong></td>
    <td class="enc_p" align="center"><strong>LAPSO</strong></td>
	<td class="enc_p" align="center"><strong>C&Oacute;DIGO</strong></td>
	<td class="enc_p" align="center"><strong>ASIGNATURA</strong></td>
    <td class="enc_p" align="center"><strong>SECCI&Oacute;N </strong></td>
    <td class="enc_p2" align="center">N&Uacute;MERO DE  ACTA  </td>
  </tr>
  <?php
//Se consultan las actas de las obligatorias en his_act
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT a.c_asigna, a.seccion, a.acta, c.asignatura FROM sc_tg_temp a, tblaca009 b, tblaca008 c WHERE a.c_asigna=b.c_asigna and a.c_asigna=c.c_asigna and b.obligatoria='1' and a.fecha BETWEEN '$fecha' AND '$fecha2' ORDER BY 3 ASC";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
for($i=0; $i < count($result); $i++) {
$cod[$i]=$result[$i][0];
$sec[$i]=$result[$i][1];
$act[$i]=$result[$i][2];
$fec[$i]=$result[$i][3];
$lap[$i]=$result[$i][4];
$asigna[$i]=$result[$i][5];
?><tr>
		  <td class="datosp"><?php echo $fec[$i];?></td>
		  <td class="datosp"><?php echo $lap[$i];?></td>
		  <td class="datosp"><strong><?php echo $cod[$i]; ?></strong></td>
		  <td class="datosp"><?php echo $asigna[$i];?></td>
		  <td class="datosp"><?php  echo $sec[$i];  ?></td>
          <td class="inact2"><?php  echo $act[$i]; ?></td>
          
  </tr>
<?php } ?>

<?php
//Se consultan las actas de Servicio Comunitario en his_Act
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT a.c_asigna, a.seccion, a.acta FROM sc_temp a WHERE a.c_asigna='300622' and a.fecha BETWEEN '$fecha' AND '$fecha2'";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
for($i=0; $i < count($result); $i++) {
$cod[$i]=$result[$i][0];
$sec[$i]=$result[$i][1];
$act[$i]=$result[$i][2];
$fec[$i]=$result[$i][3];
$lap[$i]=$result[$i][4];
$asigna[$i]='SERVICIO COMUNITARIO';
?><tr>
		  <td class="datosp"><?php echo $fec[$i];?></td>
		  <td class="datosp"><?php echo $lap[$i];?></td>
		  <td class="datosp"><strong><?php echo $cod[$i]; ?></strong></td>
		  <td class="datosp"><?php echo $asigna[$i];?></td>
		  <td class="datosp"><?php  echo $sec[$i];  ?></td>
          <td class="inact2"><?php  echo $act[$i]; ?></td>
          
  </tr>
<?php }endif;?>
	</table>	


 

<table width="800" border="0" align="center">
<tr>
<td class="datospd">
<form action="v_acta_pend.php" method="post" width="570" align="rigth" name="cacta" onSubmit="return checkFields();">
           
                        INTRODUZCA EL N&Uacute;MERO DEL ACTA :&nbsp;</font>
                        <input name="actap" value="" maxlength="3" size="2" style="border-style: solid; border-width: 1px; border-color: #0000FF; text-align: left; font-family: arial; font-size: 12px; color: black; background-color: #FFFF99" onKeyUp='validarN(this);'>
               

                    
                  
                        <INPUT TYPE="submit" value="Continuar" name="cargar"
							class="boton">
							<input value="<?php echo $ced; ?>" name="ced" type="hidden"> 	                       
                   
				
      </form>
			

</td>
</tr>
</table>


			
		
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