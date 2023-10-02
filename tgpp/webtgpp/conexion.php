<?php
        $aBitacora = $_SERVER[DOCUMENT_ROOT].'/log/pregrado/docentes/tgpp/tgpp_'.date('m-Y').'.log';
        $inscHabilitada = true; /* esto es para habilitar los procesos*/;
        $DSN = "CENTURA-DACE"; /*nombre de origen de datos*/
        $DSN1 = "TGPP"; /*nombre de origen de datos*/
		$DSN2 = "USERDOC"; /*nombre de origen de datos*/
        $Susuario = "c"; /* nombre de usuario en base de datos*/
        $Sclave = "c"; /* clave de base de datos*/
        $habBitacora = "true";
        
        include_once('inc/odbcss_c.php');
	$conex1 = new ODBC_conn($DSN1, $Susuario, $Sclave, $habBitacora, $aBitacora);
	$conex = new ODBC_conn($DSN, "c", "c", $habBitacora, $aBitacora);
    $conex2 = new ODBC_conn($DSN2, "c", "c", $habBitacora, $aBitacora);
	$conex3 = new ODBC_conn($DSN, "c", "c", $habBitacora, $aBitacora);
?>