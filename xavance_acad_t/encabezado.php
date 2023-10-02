<?php
$titulo=strtoupper($title);
$css=$raiz."css/estilo.css";
$jscript=$raiz."funciones.js";
print <<<ENC
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
 <head>
  <title>:: $title :: Sistema Web URACE :: UNEXPO $poz ::</title>
  <meta name="Author" content="UNEXPO Vicerrectorado Puerto Ordaz">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link rel="stylesheet" href="$css" type="text/css" media="screen">
  <script type="text/javascript" src="$jscript"></script>
		<table border="0" width="100%">
		<tr>
		<td width="125">
		<p align="right" style="margin-top: 0; margin-bottom: 0">
		<img border="0" src="imagenes/unex15.gif" 
		     width="50" height="50"></p></td>
		<td width="500">
		<p class="titulo">
		Universidad Nacional Experimental Polit&eacute;cnica</p>
		<p class="titulo">
		Vicerrectorado Puerto Ordaz</font></p>

		<p class="titulo">
		Unidad Regional de Admisi&oacute;n y Control de Estudios</font></td>
		<td width="125">&nbsp;</td>
		</tr><tr><td colspan="3" style="background-color:#99CCFF;">
		<font style="font-size:2px;"> &nbsp;</font></td></tr>
	    </table>	
			</tr>
			<tr>
				<td class="enc_p" colspan="2">SISTEMA DE AVANCE ACADEMICO</td>
			</tr>
ENC;

?>