<?php 
include_once('inc/config.php');
require_once('inc/odbcss_c.php');
include_once('user2.php');
//Generar la consulta ODBC a tg_temp para mostrarla 
$conex->iniciarTransaccion("Inicia Transaccion ".$_SESSION['ced']);
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "DELETE FROM sc_temp1 WHERE ci='".$_SESSION['ced']."'";     
$conex->ExecSQL($mSQL,__LINE__,true);
$conex->finalizarTransaccion("Finaliza Transaccion ".$_SESSION['ced']." - Salió del Sistema");

$result = $conex->result;
$fila = $conex->filas;

//header ("Location: index.php");
?>

<script type="text/javascript">
window.close();
</script>


