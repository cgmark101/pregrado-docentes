<?php include('encabezado.php'); 

if(empty($orden)):
$orden='3';
else:
$orden=$_POST['orden'];
//echo $orden;
endif;

if(empty($_POST['B1'])):
$B1='1';
$fecha=date('Y-m-d');
$fecha2=date('Y-m-d');
$boton='1';
else:
$boton=$_POST['B1'];
//echo $boton;
//echo '<br />';
endif;
if($boton==1):
$chec1='CHECKED';
$chec2=' ';
else:
$chec2='CHECKED';
$chec1=' ';
endif;
if(empty($_POST['lap'])):
$lap=$tLapso;
else:
$lap=$_POST['lap'];
endif;
//echo $lap;
//echo '<br />';
?>

<div id="midiv" style="position:absolute; left:30%; top:290px; width:380px; height:120px;">
<center>
<table border="0" align="center" cellpadding="6" cellspacing="0" style="font-family:Arial, Verdana; border: 2px solid #FFFFFF;">
<tr>
<td style="text-align:center; background-color:#FFFFFF"><IMG SRC="imagenes/loading.gif" WIDTH="80" HEIGHT="80" BORDER="0" ALT=""></td>
<td style="text-align:center; background-color:#FFFFFF">
<font style="font-size:28px; color:#000000; text-align:center;">Cargando... Por Favor Espere</font>
</td>
</tr>
</table>
</center>
</div>

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

	<?php  include("menu_opciones.php")?>



  
<?php // include("muestra_actas.php")?>			
		
<p class="titulo_tabla">
<SCRIPT LANGUAGE="javascript">
if(!document.layers)
midiv.style.visibility='hidden';
else
document.midiv.visibility='hide';
</SCRIPT> 

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

<?php

echo '';
//endif;
?>
