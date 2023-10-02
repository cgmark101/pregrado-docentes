<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script language="javascript" src="funciones.js" type="text/javascript"></script>
<body onLoad="actualizaReloj()">
</head>
<table border="0" width="100%">
<tr><td class="datosp" colspan="5" height="50" ><strong>NOMBRE DEL PROFESOR :</strong>&nbsp;&nbsp;&nbsp;<?php echo $info[0][0]; ?></td><td class="datosp" width="50" colspan="3"><strong>FECHA </strong><div id="Fecha_Reloj"></div></td></tr>
<tr><td class="enc_p" width="75" >CODIGO </td><td class="enc_p" width="170">ASIGNATURA</td><td class="enc_p" width="70"> SECCION</td><td class="enc_p" width="150">NUMERO DE ACTA</td><td class="enc_p" width="60">LAPSO</td><td class="enc_p" width="100">INSCRITOS</td><td width="100" class="enc_p">AGREGADOS</td><td width="100" class="enc_p">RETIRADOS</td></tr>
<tr><td class="datosp"><?PHP echo $c_asigna; ?></td><td class="datosp"><?php echo $info[0][2]; ?></td><td class="datosp"><?php echo $info[0][1]; ?></td><td class="datosp"><?PHP echo $acta; ?></td><td class="datosp"><?PHP echo $lapso; ?></td><td class="datosp"><?php echo $info[0][3]; ?></td><td class="datosp"><?php echo $info[0][4]; ?></td><td class="datosp"><?php echo $info[0][5]; ?></td>
</html>
