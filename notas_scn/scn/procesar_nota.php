<?php
include_once('inc/config.php');
require_once('inc/odbcss_c.php');
include("encabezado.php");
include("gen_acta2.php");

?>


<table width="720" border="0" align="center" style="border-collapse: collapse;border-color:black;">
  <tr>
    <td class="titulo_tabla"><div align="center">ACTA DE EVALUACION FINAL </div></td>
  </tr>
  <tr>
    
</div></td>
  </tr>
<table width="720" border="0" align="center" style="border-collapse: collapse;border-color:black;">
 <tr>

 </tr>
</table>

<?php
if($user=='0'):
$dSQL="SELECT exp_e,apellidos,apellidos2,nombres,nombres2,ci_e,lapso,acta,c_asigna FROM sc_tg_temp ORDER BY lapso ASC";
else:
$dSQL="SELECT exp_e,apellidos,apellidos2,nombres,nombres2,ci_e,lapso,acta,c_asigna FROM sc_tg_temp WHERE c_asigna='$c_asignad' ORDER BY lapso ASC";
endif;

//Generar la consulta ODBC a tg_temp para mostrarla 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = $dSQL;     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
?>
<table width="720" border="1" align="center" style="border-collapse: collapse;border-color:black;">
<form action="procesar.php" method="post" name="form1" class="datospd" id="form1">

    <tr><td height="20" colspan="3" class="datos_tabla"><strong> </strong></div>      </div></td>
   <td class="datos_tabla"></td>
    
	<td></td>
	<td class="datos_tabla"><strong>NOTA DEFINITIVA </strong></td>
	
	</tr>


		<tr>
		<td class="datospd">&nbsp;</td>
	    <td class="datospd"><span class="datos_tabla"><strong>ACTA</strong></span></td>
	    <td class="datospd"><span class="datos_tabla"><strong>EXPEDIENTE</strong></span></td>
		<td class="datospd"><span class="datos_tabla"><strong>LAPSO</strong></span></td>
		<td class="datospd"><span class="datos_tabla"><strong>C�DIGO</strong></span></td>
	    <td class="datospd"><span class="datos_tabla"><strong>APELLIDOS Y NOMBRES </strong></span></td>
		<td class="datospd"><strong>EN NUMERO </strong></td>
  </tr>
  <?php for($i=0; $i < count($result); $i++) { ?>
		<tr>
		  <td class="datospd"><strong><?php echo $i+1; ?></strong></td>
		  <td class="datospd"><?php echo $result[$i][7]; ?></td>
		  <td class="datospd"><?php echo $result[$i][0]; ?></td>
		  <td class="datospd"><?php echo $result[$i][6]; ?></td>
		  <td class="datospd"><?php echo $result[$i][8]; ?></td>
		  <td class="datospd"><div align="left">���<?php echo $result[$i][1]; echo ' ';?><?php echo $result[$i][2]; echo ' '; ?><?php echo $result[$i][3]; echo ' '; ?><?php echo $result[$i][4]; ?>�</div></td>
		  <td class="datospd"> <input name="nota<?php echo $i;?>" type="text" size="3" maxlength="3" class="datospf :required" OnKeyUp="validarNumero(this); validarNota(this);">
		  
		  </td>
  </tr>
  
  
<?php $ins=$i+1;} ?>
<tr>
<td colspan="6"></td>
<td class="datospd" align="left"> 
   <input type="button" value="Procesar" class="boton" onclick="validarNota(this.form)" />
<input type="hidden" name="cont" value="<?PHP echo count($result); ?>">
<input type="hidden" name="c_asignad" value="<?PHP echo $c_asignad; ?>">

</td>

</tr> 

</form>


</table>
 


<script type="text/javascript">
function delEst(id) {
    if (window.confirm("Aviso:\nDesea eliminar el alumno seleccionado?")) {
        window.location = "borrar_est.php?action=del&id="+id;   
    }
}
</script>


<?php

include("pie.php");
?>