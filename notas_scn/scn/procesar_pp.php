<?php 
include_once('user2.php');
error_reporting(E_ALL);
include_once('inc/config.php');
require_once('inc/odbcss_c.php');
setlocale(LC_ALL,"es_ES@euro","es_ES","esp"); 

$cont=$_POST['cont'];
$nota= array();
$letras= array();
$obs= array();

for($i=0; $i < $cont; $i++)
	{
	$nota[$i]=$_POST['nota'.$i];
	if(($nota[$i] >= '1') and ($nota[$i] <= '4.9')){
		$status[$i]='1';
		$obs[$i]='APLAZADO';
	}
	if(($nota[$i] >= '5') and ($nota[$i] <= '9')){
		$status[$i]='0';
		$obs[$i]='APROBADO';
	}
	if($nota[$i]== '0'){
		$nota[$i]='1';
		$obs[$i]='INASISTENTE';
		$status[$i]='I';
	}
	//Se consulta la nota en letras  
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT letras FROM letras WHERE nota='$nota[$i]'";     
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
$letras[$i]=$result[0][0];

}





 
/*
//Se consulta el lapso  
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT lapso FROM sc_temp1 ORDER BY lapso DESC";     
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
$lapso=$result[0][0];

//Busco acta en sc_temp1 para mostrarla 
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT acta FROM sc_temp1 ORDER BY acta DESC";     
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
$acta=$result[0][0];*/
?>
<script type="text/javascript" src="js/funciones.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo1 {font-size: 14px}
.Estilo2 {font-size: 16}
.Estilo3 {font-size: 16px}
.Estilo4 {font-size: 12px}
-->
</style>
<head>
<title>:: Acta de Evaluación Final :: <?php $title ?> :: Sistema Web URACE :: UNEXPO <?php $poz ?>  </title>
<table width="800" border="0" align="center">
  <tr>
    <td width="167"><img src="imagenes/unexpo.jpeg" width="133" height="110" /></td>
    <td width="517"><div align="center" class="enc_materias">
      <p><strong>Universidad  Nacional Experimental Polit&eacute;nica<br />
      &quot;Antonio Jos&eacute; de Sucre&quot;<br /> 
        Vicerrectorado Puerto Ordaz<br />
      Unidad Regional de Admisi&oacute;n y Control de Estudios</strong></p>
      <p class="Estilo3">ACTA DE EVALUACI&Oacute;N FINAL </p>
    </div></td>
    <td width="102"><p align="left" class="datos_tabla Estilo2"><span class="Estilo4">Fecha:<strong> <?php echo date("d/m/Y");?></strong></span><br />
    </p>
      <p class="datos_tabla"><br />
    </p></td>
  </tr>
  <tr>
    <td class="datos_tabla"><div align="left"><strong></strong></div></td>
    <td><div align="center" class="enc_materias Estilo1">TRABAJO DE GRADO </div></td>
    <td class="datos_tabla"><div align="left"><strong></strong></div></td>
  </tr>
  <tr>
    <td class="datos_tabla"><div align="left"><strong></strong></div></td>
    <td>&nbsp;</td>
    <td class="datos_tabla"><div align="left"><strong></strong></div></td>
  </tr>
</table>

<?php //Generar la consulta ODBC a pp_temp para mostrarla 
include_once('inc/config.php');
require_once('inc/odbcss_c.php');
require("funciones.php");

$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT exp_e,apellidos,apellidos2,nombres,nombres2,ci_e FROM sc_pp_temp ORDER BY lapso ASC";     
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
$fila = $conex->filas;
if($fila==0):
echo "<script languaje='javascript'>
alert('ALERTA: Debe ingresar al menos 1 alumno para poder procesar');
window.opener.location = 'index.php';
window.close();
</script>";
//elimino campos sc_temp1
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "DELETE FROM sc_temp1";     
$conex->ExecSQL($mSQL,__LINE__,true);
$ok=$conex->fmodif;
else:?>
<table width="800" border="1" align="center" style="border-collapse: collapse;border-color:black;">

    <tr><td height="20" colspan="3" class="datos_tabla"><strong> </strong></div>      </div></td>
    <td colspan="2" class="datos_tabla"><strong>NOTA DEFINITIVA </strong></td>
	<td class="datos_tabla">&nbsp;</td>
    </tr>


		<tr>
		<td class="datospd">&nbsp;</td>
	    <td class="datospd"><span class="datos_tabla"><strong>EXPEDIENTE</strong></span></td>
	    <td class="datospd"><span class="datos_tabla"><strong>APELLIDOS Y NOMBRES </strong></span></td>
		<td class="datospd"><strong>EN NUMERO </strong></td>
        <td class="datospd"><span class="datos_tabla"><strong>EN LETRAS </strong></span></td>
        <td class="datospd"><span class="datos_tabla"><strong>OBSERVACION</strong></span></td>
  </tr>
  <?php for($i=0; $i < count($result); $i++) { ?>
		<tr>
		  <td class="datospd"><strong><?php echo $i+1; ?></strong></td>
		  <td class="datospd"><?php echo $result[$i][0]; ?></td>
		  <td class="datospd"><div align="left">   <?php echo $result[$i][1]; echo ' ';?><?php echo $result[$i][2]; echo ' '; ?><?php echo $result[$i][3]; echo ' '; ?><?php echo $result[$i][4]; echo ' '; ?> </div></td>
		  <td class="datospd"><?php  echo $nota[$i]; ?></td>
          <td class="datospd"><?php  echo $letras[$i]; ?></td>
          <td class="datospd"><?php echo $obs[$i]; ?></td>
  </tr>
 
 <?php //Actualizo regsitro de pp_temp con notas, letras y observacion 

$ci_e=$result[$i][5]; 
$conex->iniciarTransaccion("Inicia Transaccion ".$_SESSION['ced']." - Cédula Estudiante: ".$ci_e);
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "UPDATE sc_pp_temp SET calificacion='$nota[$i]', observacion='$obs[$i]', letras='$letras[$i]', status='$status[$i]' WHERE ci_e='$ci_e'";     
$conex->ExecSQL($mSQL,__LINE__,true);
$conex->finalizarTransaccion("Finaliza Transaccion ".$_SESSION['ced']." - Cédula Estudiante: ".$ci_e);

 

$ins=$i+1;} ?>
</table>



<p>&nbsp;</p>
<table width="800" border="1" align="center"  style="border-collapse: collapse;border-color:black;">
  <tr>
    <td width="223" class="sub_tabla">PROFESOR:</td>
    <td width="175" class="sub_tabla">Nro. CEDULA </td>
    <td width="225" class="sub_tabla">FIRMA</td>
    <td width="149" class="sub_tabla">FECHA:</td>
  </tr>
  <tr>
    <td height="54" class="datos_tabla"><?php echo $nombre;?>  <?php echo $apellido;?></td>
    <td class="datos_tabla"><?php echo $ced;?></td>
    <td class="datos_tabla">&nbsp;</td>
    <td class="datos_tabla"><p><?php echo date("d/m/Y");?></p>
    </td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<table width="800" border="0" align="center"  style="border-collapse: collapse;border-color:black;">
  <tr>
  <td class="alert2" align="left"> - El Acta de Evaluación Final presentada en esta página no tiene validez<br />
 - Revise cada una de las notas ingresadas, si está 100% conforme, a continuación haga clic en “PROCESAR”, si no, regrese a la pagina anterior haciendo clic en "REGRESAR"<br />
 - Puede que uno o más alumnos hayan sido ingresados en actas diferentes de acuerdo al lapso en donde inscribieron la asignatura<br />
 - Luego de Procesar, para consultar las actas cargadas, diríjase al menú principal, luego a la pestaña de “Visualizar Actas” </td>
  </tr>
  <tr>
    <td class="sub_tabla"><input name="button" type="button" onclick="mensaje2_pp(this);" value="Procesar" />    
    <input name="button2" type="button" onclick="history.back()" value="Regresar" />    </tr>
</table>
<?php endif; ?>
