<?php

include_once('inc/vImage.php');
include_once('inc/odbcss_c.php');
include_once ('inc/config.php');
include_once ('inc/activaerror.php');


print $noCache; 
print $noJavaScript; 

//print_r($HTTP_POST_VARS);

$padre=$_POST['padre'];
$hijos=$_POST['hijos'];
$update=$_POST['update'];

//print $padre; print "<BR>";
//print $hijos;
//print_r($HTTP_POST_VARS);

if (isset($_POST['update'])){
	$Chijos = new ODBC_Conn("FDOCENTE","N","N");
	$mSQL = "delete from dhijos where CI_P='$padre'";
	$Chijos->ExecSQL($mSQL);
}


for ($i = 1; $i <= $hijos; $i++) {
        $sw2 = '0';
		//CAPTURAMOS EL VALOR CORRESPONDIENTE DE CADA INDICE DEL ARREGLO
		$cedula=$_POST['cedula_' . $i];
		$nombres=$_POST['nombres_' . $i];
		$apellidos=$_POST['apellidos_' . $i];
		$fnac=$_POST['fnac_' . $i];
		$estudio=$_POST['estudio_' . $i];
		$nivel=$_POST['nivel_' . $i];
		
		//INSERTA LOS DATOS EN LA TABLA
		$Chijos = new ODBC_Conn("FDOCENTE","N","N");
		$mSQL = "INSERT INTO DHIJOS (CI_P,CI,NOMBRES,APELLIDOS,F_NAC,ESTUDIO,NIVEL,NUM)";
		$mSQL= $mSQL." VALUES  ('$padre','$cedula','$nombres','$apellidos','$fnac','$estudio','$nivel','$i')";
		$Chijos->ExecSQL($mSQL);

}

?>

<html>
<head>
<title><?php echo $tProceso;?> > Datos Almacenados con &eacute;xito</title>
</head>
<body>
<TABLE id="datos_hijos" align="center" border="0" cellpadding="0" cellspacing="1" width="740" style="border-collapse:collapse;border-color: blue; border-style:solid; background:#FFFFFF;">
<TR>
	<TD align="center"><IMG SRC="imagenes/img.jpg" WIDTH="540" HEIGHT="380" BORDER="0" ALT="EXITO"></TD>
</TR>
</TABLE>
</body>
</html>
