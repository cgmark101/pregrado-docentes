<?php

include_once('inc/vImage.php');
include_once('inc/odbcss_c.php');
include_once ('inc/config.php');
include_once ('inc/activaerror.php');

print $noCache; 
print $noJavaScript; 

//print_r($HTTP_POST_VARS);

$doc=$_POST['docente'];
$publi=$_POST['publi'];


/*print $lapsoProceso;
print_r($HTTP_POST_VARS);*/

if (isset($_POST['update'])){
	$Chijos = new ODBC_Conn("FDOCENTE","N","N");
	$mSQL = "delete from dpublica where CI_D='$doc'";
	$Chijos->ExecSQL($mSQL);
}

for ($i = 1; $i <= $publi; $i++) {
        $sw2 = '0';
		//CAPTURAMOS EL VALOR CORRESPONDIENTE DE CADA INDICE DEL ARREGLO
		$tipo=$_POST['tipo_' . $i];
		$casae=$_POST['casae_' . $i];
		$titulo=$_POST['nombre_' . $i];
		$fechapub=$_POST['fechapub_' . $i];
		$ciudad=$_POST['ciudad_' . $i];
		$pais=$_POST['pais_' . $i];
		
		//INSERTA LOS DATOS EN LA TABLA
		$Cmat_pub = new ODBC_Conn("FDOCENTE","N","N");
		$mSQL = "INSERT INTO DPUBLICA (CI_D,TIPO,CASA_E,TITULO_PUB,FECHA_PUB,CIUDAD,PAIS,NUM)";
		$mSQL= $mSQL." VALUES ('$doc','$tipo','$casae','$titulo','$fechapub','$ciudad','$pais','$i')";
		$Cmat_pub->ExecSQL($mSQL);

}

//Print $publi . " registros agregados";

?>

<html>
<head>
<title><?echo $tProceso;?> > Datos Almacenados con &eacute;xito</title>
</head>
<body>
<TABLE id="datos_hijos" align="center" border="0" cellpadding="0" cellspacing="1" width="600" style="border-collapse:collapse;border-color: blue; border-style:solid; background:#FFFFFF;">
<TR>
	<TD align="center"><IMG SRC="imagenes/img.jpg" WIDTH="540" HEIGHT="380" BORDER="0" ALT="EXITO"></TD>
</TR>
</TABLE>
</body>
</html>