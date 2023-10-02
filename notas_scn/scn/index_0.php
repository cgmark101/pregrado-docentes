<?php
include("encabezado.php");
include_once('inc/config.php');
require_once('inc/odbcss_c.php');
require('funciones.php');

//print_r($_SESSION);

 //Buscamos usuario en tblaca007
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL = "SELECT nombre,apellido FROM tblaca007 WHERE ci='$ced' ";     
$conex->ExecSQL($mSQL,__LINE__,false);

if ($conex->filas > 0) {
	$result = $conex->result;
	$nombre=$result[0][0];
	$apellido=$result[0][1];
} else {
	$conex = new ODBC_Conn("FDOCENTE",$usuario_db,$password_db,TRUE,$log);
	$mSQL = "SELECT nombres,apellidos FROM dpersonales WHERE ci='$ced' "; 

	$conex->ExecSQL($mSQL,__LINE__,false);

	if ($conex->filas > 0){
		$result = $conex->result;
		$nombre=$result[0][0];
		$apellido=$result[0][1];
	}
}



?>
<link href="css/estilo.css" rel="stylesheet" type="text/css" />

<table width="700" border="0" align="center">
  <tr>
    <td class="enc_materias" align="center"><p>&nbsp;</p>
    <p><font style="font-size: 14px"><?php echo $nombre.' '.$apellido; ?> </p></td>
  </tr>
 <tr> <td class="sugerencia"> <div align="left"> - Seleccione una opción en el menú desplegable, ubicado en la parte superior de la página<br />
    - Si necesita consultar el manual de usuario, ubique la sección de Ayuda en el menú <br />
    - Si no desee realizar más operaciones ubique Salir en el menú </div></td>
<?php 
// include_once('gen_acta.php');?> 
</tr>
</table>





<?php
include("pie.php");

//consulta Nro de acta mayor en his_act
/*$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT MAX(@VALUE(his_act)) FROM his_act WHERE his_lap='$tLapso'";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;
$acta_m1=$result[0][0];
//incializo sc_temp1
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "INSERT INTO sc_temp1 (acta,lapso) VALUES ('$acta_m1','$tLapso')";     
$conex->ExecSQL($mSQL,__LINE__,false);*/

//consulta Nro de acta mayor en his_act
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT MAX(@VALUE(his_act)) FROM his_act WHERE his_lap='$tLapso'";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;
$acta_m1=$result[0][0];

//incializo sc_temp1

/*$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "UPDATE sc_temp1 SET acta='$acta_m1'";     
$conex->ExecSQL($mSQL,__LINE__,true);*/

//consulto Nro de acta mayor en tblaca004
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT MAX(@VALUE(ACTA)) FROM TBLACA004 WHERE LAPSO='$tLapso'";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;
$acta_m2=$result[0][0];

//consulto Nro de acta mayor en sc_temp1
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT MAX(@VALUE(acta)) FROM sc_temp1";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;
$acta_m3=$result[0][0];

$nacta = generar_acta($acta_m1,$acta_m2,$acta_m3);

/*echo "his_act: ".$acta_m1."<br>";
echo "tblaca004: ".$acta_m2."<br>";
echo "sc_temp1: ".$acta_m1."<br>";*/

//ingreso el Nro nuevo de acta en sc_temp1
$conex->iniciarTransaccion("Inicia Transaccion ".$_SESSION['ced']." - Acta: ".$nacta);
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
//$mSQL  = "INSERT INTO sc_temp1 (acta,ci) VALUES ('".$nacta."','".$_SESSION['ced']."') ";
$conex->ExecSQL($mSQL,__LINE__,true);
$conex->finalizarTransaccion("Finaliza Transaccion ".$_SESSION['ced']);

?>
