<?php

include_once('inc/vImage.php');
include_once('inc/odbcss_c.php');
include_once ('inc/config.php');
include_once ('inc/activaerror.php');

print $noCache; 
print $noJavaScript; 

//print_r($HTTP_POST_VARS);

$doc=$_POST['docente'];
$cursos=$_POST['cursos'];


/*print $lapsoProceso;
print_r($HTTP_POST_VARS);*/

if (isset($_POST['update'])){
	$Chijos = new ODBC_Conn("FDOCENTE","N","N");
	$mSQL = "delete from dcursos where CI_D='$doc'";
	$Chijos->ExecSQL($mSQL);
}

for ($i = 1; $i <= $cursos; $i++) {
        $sw2 = '0';
		//CAPTURAMOS EL VALOR CORRESPONDIENTE DE CADA INDICE DEL ARREGLO
		$instituto=$_POST['instituto_' . $i];
		$nombre=$_POST['nombre_' . $i];
		$fecha=$_POST['fecha_' . $i];
		$ciudad=$_POST['ciudad_' . $i];
		$pais=$_POST['pais_' . $i];
		$horas=$_POST['horas_' . $i];
		
		//INSERTA LOS DATOS EN LA TABLA
		$Cmat_cur = new ODBC_Conn("FDOCENTE","N","N");
		$mSQL = "INSERT INTO DCURSOS (CI_D,INSTITUTO,NOMBRE,FECHA,CIUDAD,PAIS,HORAS_D,NUM)";
		$mSQL= $mSQL." VALUES ('$doc','$instituto','$nombre','$fecha','$ciudad','$pais','$horas','$i')";
		$Cmat_cur->ExecSQL($mSQL);

}

//Print $cursos . " registros agregados";

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