<?php

include_once('inc/vImage.php');
include_once('inc/odbcss_c.php');
include_once ('inc/config.php');
include_once ('inc/activaerror.php');

print $noCache; 
print $noJavaScript; 

//print_r($HTTP_POST_VARS);

$doc=$_POST['docente'];
$mat=$_POST['materias'];


/*print $lapsoProceso;
print_r($HTTP_POST_VARS);*/

if (isset($_POST['update'])){
	$Chijos = new ODBC_Conn("FDOCENTE","N","N");
	$mSQL = "delete from dmat_h where CI_D='$doc'";
	$Chijos->ExecSQL($mSQL);
}

for ($i = 1; $i <= $mat; $i++) {
        $sw2 = '0';
		//CAPTURAMOS EL VALOR CORRESPONDIENTE DE CADA INDICE DEL ARREGLO
		$codigo=$_POST['codigo_' . $i];
		$asignatura=$_POST['asignatura_' . $i];
		$lapso=$_POST['lapso_' . $i];
		$nivel=$_POST['nivel_' . $i];
		
		//INSERTA LOS DATOS EN LA TABLA
		$Cmat_ah = new ODBC_Conn("FDOCENTE","N","N");
		$mSQL = "INSERT INTO DMAT_H (CI_D,C_ASIGNA,ASIGNATURA,LAPSO,NIVEL,NUM)";
		$mSQL= $mSQL." VALUES ('$doc','$codigo','$asignatura','$lapso','$nivel','$i')";
		$Cmat_ah->ExecSQL($mSQL);

}



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