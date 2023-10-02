<?php

include_once('inc/vImage.php');
include_once('inc/odbcss_c.php');
include_once ('inc/config.php');
include_once ('inc/activaerror.php');

print $noCache; 
print $noJavaScript; 

//print_r($HTTP_POST_VARS);

$doc=$_POST['docente'];
$inves=$_POST['inves'];


/*print $lapsoProceso;
print_r($HTTP_POST_VARS);*/

if (isset($_POST['update'])){
	$Chijos = new ODBC_Conn("FDOCENTE","N","N");
	$mSQL = "delete from dinvest where CI_D='$doc'";
	$Chijos->ExecSQL($mSQL);
}

for ($i = 1; $i <= $inves; $i++) {
        $sw2 = '0';
		//CAPTURAMOS EL VALOR CORRESPONDIENTE DE CADA INDICE DEL ARREGLO
		$nombre=$_POST['nombre_' . $i];
		$fecha=$_POST['fechai_' . $i];
		$linea=$_POST['linea_' . $i];
		$rol=$_POST['rol_' . $i];
		
		//INSERTA LOS DATOS EN LA TABLA
		$Cmat_con = new ODBC_Conn("FDOCENTE","N","N");
		$mSQL = "INSERT INTO DINVEST (CI_D,NOMBRE,FECHA_INICIO,LINEA,ROL,NUM)";
		$mSQL= $mSQL." VALUES ('$doc','$nombre','$fecha','$linea','$rol','$i')";
		$Cmat_con->ExecSQL($mSQL);

}

//Print $inves . " registros agregados";

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
