<?php

include_once('inc/vImage.php');
include_once('inc/odbcss_c.php');
include_once ('inc/config.php');
include_once ('inc/activaerror.php');

print $noCache; 
print $noJavaScript; 

//print_r($HTTP_POST_VARS);

$doc=$_POST['docente'];
$concur=$_POST['concur'];


/*print $lapsoProceso;
print_r($HTTP_POST_VARS);*/

if (isset($_POST['update'])){
	$Chijos = new ODBC_Conn("FDOCENTE","N","N");
	$mSQL = "delete from dconcursos where CI_D='$doc'";
	$Chijos->ExecSQL($mSQL);
}

for ($i = 1; $i <= $concur; $i++) {
        $sw2 = '0';
		//CAPTURAMOS EL VALOR CORRESPONDIENTE DE CADA INDICE DEL ARREGLO
		$nombrec=$_POST['nombrec_' . $i];
		$nombret=$_POST['nombret_' . $i];
		$fecha=$_POST['fechap_' . $i];
		$ciudad=$_POST['ciudad_' . $i];
		$pais=$_POST['pais_' . $i];
		$galardon=$_POST['galardon_' . $i];
		
		//INSERTA LOS DATOS EN LA TABLA
		$Cmat_con = new ODBC_Conn("FDOCENTE","N","N");
		$mSQL = "INSERT INTO DCONCURSOS (CI_D,NOMBRE_CON,NOMBRE_TRA,FECHA,CIUDAD,PAIS,GALARDON,NUM)";
		$mSQL= $mSQL." VALUES ('$doc','$nombrec','$nombret','$fecha','$ciudad','$pais','$galardon','$i')";
		$Cmat_con->ExecSQL($mSQL);

}

//Print $concur . " registros agregados";

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