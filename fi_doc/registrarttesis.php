<?php

include_once('inc/vImage.php');
include_once('inc/odbcss_c.php');
include_once ('inc/config.php');
include_once ('inc/activaerror.php');

print $noCache; 
print $noJavaScript; 

//print_r($HTTP_POST_VARS);

$doc=$_POST['docente'];
$ttg=$_POST['ttg'];


/*print $lapsoProceso;
print_r($HTTP_POST_VARS);*/

if (isset($_POST['update'])){
	$Chijos = new ODBC_Conn("FDOCENTE","N","N");
	$mSQL = "delete from dtutorias where CI_D='$doc'";
	$Chijos->ExecSQL($mSQL);
}

for ($i = 1; $i <= $ttg; $i++) {
        $sw2 = '0';
		//CAPTURAMOS EL VALOR CORRESPONDIENTE DE CADA INDICE DEL ARREGLO
		$nombre=$_POST['nombre_' . $i];
		$estudiante=$_POST['estudiante_' . $i];
		$fecha=$_POST['fecha_' . $i];
		$especialidad=$_POST['especialidad_' . $i];
		$mencion=$_POST['mencion_' . $i];
		
		
		//INSERTA LOS DATOS EN LA TABLA
		$Cmat_con = new ODBC_Conn("FDOCENTE","N","N");
		$mSQL = "INSERT INTO DTUTORIAS (CI_D,NOMBRE,ESTUDIANTE,FECHA,ESPECIALIDAD,MENCION,NUM)";
		$mSQL= $mSQL." VALUES ('$doc','$nombre','$estudiante','$fecha','$especialidad','$mencion','$i')";
		$Cmat_con->ExecSQL($mSQL);

}

//Print $ttg . " registros agregados";

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