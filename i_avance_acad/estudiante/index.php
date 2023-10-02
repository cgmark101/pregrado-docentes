<?php
include_once('acceso/vImage.php'); 
include_once('odbc/config.php');

$user="usersdb";
$copy="© 2009 - UNEXPO - Vicerrectorado Puerto Ordaz. Oficina Regional de Tecnología y Servicios de Información";
$titulo=strtoupper('Sistema de avance Academico');
//$jscript=$raiz."js/funciones.js";

?>

<style type="text/css">
          <!--
#prueba {
  overflow:hidden;
}

.titulo {
  text-align: center; 
  font-family:Arial; 
  font-size: 14px; 
  font-weight: normal;
  margin-top:0;
  margin-bottom:0;	
}

  -->
          </style>  
		  
		  
		  
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
 <head>
  <title>:: Sistema Web :: UNEXPO ::</title>
  <meta name="Author" content="UNEXPO Vicerrectorado Puerto Ordaz">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link rel="stylesheet" href="estilo.css" type="text/css" media="screen">
  <script type="text/javascript" src="funciones.js"></script>
  <script type="text/javascript" src="acceso/md5.js"></script>
 </head>
 <body onload="actualizaReloj()">
	<table border="0" align="center" width="720px" style="border-collapse: collapse;border-color:black;">
			<tr>
				<td colspan="2">
					<table border="0" width="750">
		<tr>
		<td width="125">
		<p align="right" style="margin-top: 0; margin-bottom: 0">

		<img border="0" src="imagenes/unex15.gif" 
		     width="75" height="75"></p></td>
		<td width="500">
		<p class="titulo">
		Universidad Nacional Experimental Polit&eacute;cnica</p>
		<p class="titulo">
		"Antonio Jos&eacute; de Sucre"</p>
		<p class="titulo">
		Vicerrectorado <?php echo $vicerrectorado; ?></font></p>
		<p class="titulo">

		<?php echo $nombreDependencia ?></font></td></tr>
</table>
				</td>
			</tr>
			<tr>
				<td colspan="2"><p align="center" style="font-family:arial; font-weight:bold; font-size:20px;">
<?php			echo 'Sistema de consulta de Notas '. $tLapso; 
?>		  </p></td>
			</tr>
		</table>

<table id="login" width="720px" cellpadding="3" align="center">
<tbody>
<tr><td align="right" border="none"><input class="fecha" size="40" type="text" id="fecha" name="fecha" readonly="" disabled="disabled"></td></tr>
<tr><td>
<table id="table1" style="border-collapse: collapse;" border="0" cellpadding="0" cellspacing="1" width="720" class="datos">

  <tbody>
  <tr>

       <td width="720px" align="center">

	   <font style="font-size: 11px"><br>Por
favor escribe tus datos y el c&oacute;digo de seguridad, luego pulsa el bot&oacute;n "Entrar" para
          poder acceder a la preinscripci&oacute;n</font></td>
   </tr>
  <tr>
      <td width="720" align="center"  style="font-size: 12px">
      <form method="post" name="chequeo"  action="acceso/cedula_valida.php" target="nombre">
          <p class="normal">&nbsp; C&eacute;dula:&nbsp;
        <input class="datospf" name="cedula_v" size="15" tabindex="1" type="text">&nbsp; &nbsp;
		Clave:&nbsp;<input name="contra_v" size="20" tabindex="2" type="password" class="datospf">&nbsp;&nbsp;  
  &nbsp; C&oacute;digo de la derecha:&nbsp;
  <input name="vImageCodC" size="5" tabindex="3" type="text" class="datospf">&nbsp;
  <img src="acceso/img.php?size=4" height="30" style="vertical-align: middle;">
  
  <input value="x" name="cedula" type="hidden"> 
  <input value="x" name="contra" type="hidden">
  <input value="" name="vImageCodP" type="hidden">
  <input value="$user" name="user" type="hidden">
  <input value="Entrar" name="b_enviar" tabindex="3" type="submit" onclick="window.open('','nombre','left=100,top=100,width=900,height=500,scrollbars=1,resizable=1,status=1')"> 
</p>
      </form>

  </td>
    </tr>
    <tr>
      <td class ="titulo_tabla"><b>NOTAS:</b>
      <ul>
        <li>Si no posees la clave o la olvidaste, puedes solicitarla en la Unidad 
          Regional de Admisi&oacute;n y Control Estudios -URACE-
          en el siguiente horario <B>de 8:30 am a 11:00 am</B>.
Requisito indispensable: <B>C&eacute;dula de identidad ORIGINAL</B> o
<B>Carnet Estudiantil ORIGINAL</B>. No se aceptan fotocopias. </li>
       </ul>      </td>
    </tr>
	</td></tr>
  </tbody>
</table>
<table><tr><td>


<?PHP
?>