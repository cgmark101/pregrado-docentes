<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
   
</head>
<body>
    <?php
     
include_once('inc\config.php');
	session_start();
		$conexion = odbc_connect($DSN, $user, $pass, true, $laBitacora) or die ("Problemas en la conexión"); 	
		$sql="select CI_E, APELLIDOS, NOMBRES, EXP_E, C_UNI_CA from dace002 where CI_E = '$_SESSION[cedula]'";
		$registros = odbc_exec($conexion, $sql)or die ("Problemas en el select");
	if ($reg = odbc_fetch_array($registros))
	    {
		    $conexion1 = odbc_connect($DSN2, $user, $pass, true, $laBitacora) or die ("Problemas en la conexión"); 	
		    $sql1="select cedula_e, asignatura from sol_tgpp where cedula_e = '$_SESSION[cedula]'";
		    $asd= odbc_exec($conexion1, $sql1)or die ("Problemas en el select");
		    if ($rego = odbc_fetch_array($asd))
			{
			 if($rego['cedula_e']==$_SESSION['cedula'] && $rego['asignatura']=="PRÁCTICA PROFESIONAL")
			    {
				$_SESSION['cedula']=$rego['cedula_e'];
				header ("Location: modest.php"); 
			    }
			else {
			    
			    echo "joder";
			    echo"$rego[asignatura]";
			    echo"$rego[cedula_e]";
			    header ("Location: planillap.php"); 
			}
		}	
	    }
    ?>
</body>
</html>