<?php

include_once('inc/vImage.php');
include_once('inc/odbcss_c.php');
include_once ('inc/config.php');
include_once ('inc/activaerror.php');

print $noCache; 
print $noJavaScript; 

//print_r($HTTP_POST_VARS);

$doc=$_POST['docente'];
$comu=$_POST['comu'];


/*print $lapsoProceso;
print_r($HTTP_POST_VARS);*/

if (isset($_POST['update'])){
	$Chijos = new ODBC_Conn("FDOCENTE","N","N");
	$mSQL = "delete from dcomuni where CI_D='$doc'";
	$Chijos->ExecSQL($mSQL);
}


for ($i = 1; $i <= $comu; $i++) {
	$sw2 = '0';
	//CAPTURAMOS EL VALOR CORRESPONDIENTE DE CADA INDICE DEL ARREGLO
	$titulo=$_POST['titulo_' . $i];
	$ciudad=$_POST['ciudad_' . $i];
	$pais=$_POST['pais_' . $i];
	$anio=$_POST['anio_' . $i];
	
		
		
	//INSERTA LOS DATOS EN LA TABLA
	$Cmat_preg = new ODBC_Conn("FDOCENTE","N","N");
	$mSQL = "INSERT INTO DCOMUNI (CI_D,TITULO,CIUDAD,PAIS,ANIO,NUM)";
	$mSQL= $mSQL." VALUES ('$doc','$titulo','$ciudad','$pais','$anio','$i')";
	$Cmat_preg->ExecSQL($mSQL);

}

//Print $comu . " registros agregados";

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