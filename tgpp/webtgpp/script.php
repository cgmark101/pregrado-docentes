<?php
# codigo de conexion al a base de datos, te lo dejo a ti
include_once('inc\config.php');
$conexion = odbc_connect($DSN, $user, $pass, true, $laBitacora) or die ("Problemas en la conexión"); 	 	     	 	
$query = "SELECT CI FROM tblaca007 WHERE NOMBRE = '%".addslashes($_POST['cont'])."%'";
$resultado_sql = odbc_fetch_array(odbc_exec($query));

#ahora devolvemos el valor que nos tiro la query,. en caso de que lo haya devuelto. Si tira error, en la Caja2 veremos el error, por lo que deberemos hacer todo el manejo de errores en php. Eso te lo dejo a ti :P

echo $resultado_sql[0];
?>