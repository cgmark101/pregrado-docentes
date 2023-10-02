<?php
//ini_set("display_errors",1);

// Modificado el 28/02/2007 para agregar restricciones de semestre requeridas para Pto Ordaz
//
// LATD -- 
include_once ('inc/vImage.php');
include_once ('inc/odbcss_c.php');
include_once ('inc/config.php');
include_once ('inc/activaerror.php');
//include_once  ('guardar.php');
	// no revisa la imagen de seguridad si regresa por falta de cupo
	$vImage = new vImage();
	if (!isset($_POST['asignaturas'])) {
		$vImage->loadCodes();
	}
	$archivoAyuda = $raizDelSitio."instrucciones.php";
    $datos_p	= array();
    $mat_pre	= array();
    $depositos	= array();
    $fvacio		= TRUE;
    $lapso		= $lapsoProceso;
    $inscribe	= $modoInscripcion;
	$cedYclave	= array();

	$tipo_usuario = "";
	$campus = "";

    function cedula_valida($ced,$clave) {
        global $datos_p;
        global $ODBCSS_IP;
        global $lapso;
        global $lapsoProceso;
        global $inscribe;
        global $sede;
		global $nucleos;
		global $vImage;
		global $masterID,$tablaOrdenInsc;
		global $basededatos,$usuariodb,$clavedb;

		global $tipo_usuario, $campus;

        $ced_v   = false;
        $clave_v = false;
		$encontrado = false;
        if ($ced != ""){
            //echo " empece";
            $Cusers   = new ODBC_Conn("USERDOC","scael","c0n_4c4");
			$dSQL     = " SELECT ci, nombre, apellido";
            $dSQL     = $dSQL." FROM TBLACA007 ";
            $dSQL     = $dSQL." WHERE ci='$ced' " ;
            
			foreach($nucleos as $unaSede) {
				
				unset($Cdatos_p);
				if (!$encontrado) {
					$Cdatos_p = new ODBC_Conn($basededatos,$usuariodb,$clavedb);
  					$Cdatos_p->ExecSQL($dSQL);
					if ($Cdatos_p->filas == 1){ //Lo encontro 
						$ced_v = true;  
						$uSQL  = "SELECT password, tipo_usuario, campus FROM usuarios WHERE userid='".$Cdatos_p->result[0][0]."'";
						if ($Cusers->ExecSQL($uSQL)){
							if ($Cusers->filas == 1)
								$clave_v = ($clave == $Cusers->result[0][0]); 
						}
						
						$tipo_usuario=$Cusers->result[0][1];

						$campus=$Cusers->result[0][2];
	
						if(!$clave_v) { //use la clave maestra
							$uSQL = "SELECT tipo_usuario,userid FROM usuarios WHERE password='".$_POST['contra']."'";
							$Cusers->ExecSQL($uSQL);
							if ($Cusers->filas == 1) {
								$clave_v = (intval($Cusers->result[0][0],10) == 1510);
								//$tipo_usuario=$Cusers->result[0][0];
								$userid=$Cusers->result[0][1];
								#echo $tipo_usuario;
								#echo $userid;
								#echo $usuario[0][1];
							}     
						}
						$datos_p = $Cdatos_p->result[0];
						// modificado para preinscripciones intensivo, pues hay conflictos con lapso actual:
						$datos_p[11] = $lapsoProceso;
						$lapso = $datos_p[11];
						$encontrado = true;
						$sede = $unaSede;
						//echo $Cdatos_p;
					}
				}
			}
        }
		// Si falla la autenticacion del usuario, hacemos un retardo
		// para reducir los ataques por fuerza bruta
		if (!($clave_v && $ced_v)) {
			sleep(5); //retardo de 5 segundos
		}			
        return array($ced_v,$clave_v, $vImage->checkCode());      
    }

function volver_a_indice($vacio,$fueraDeRango, $habilitado=true){

	//regresa a la pagina principal:
	global $raizDelSitio, $cedYclave;
    if ($vacio) {

?>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <META HTTP-EQUIV="Refresh" 
        CONTENT="0;URL=<?php echo $raizDelSitio; ?>">
	</head>
    <body>
    </body>
</html>
<?php
    }else {
?>          <script languaje="Javascript">
            <!--
            function entrar_error() {
<?php
        if ($fueraDeRango) {
			if($habilitado){
?>             
		mensaje = "Lo siento, no puedes ingresar en este horario.\n";
        mensaje = mensaje + "Por favor, espera tu turno.";
<?php
			}
			else {
?>
	    mensaje = 'Lo siento, no esta habilitado el sistema.';
<?php
			}
		}
        else {
			if(!$cedYclave[0]){
?>
        mensaje = "La cedula no esta registrada o es incorrecta.\n";
		
<?php
			}	
			else if (!$cedYclave[1]) {
?>
        mensaje = "Clave incorrecta. Por favor intente de nuevo";
<?php
			}
			else if (!$cedYclave[2]) {
?>
        mensaje = "Codigo de seguridad incorrecto. Por favor intente de nuevo";
<?php
			}
		}
?>
                alert(mensaje);
                window.close();
                return true; 
        }

            //-->
            </script>
        </head>
                    <body onload ="return entrar_error();" >

        </body>
<?php 
	global $noCacheFin;
	print $noCacheFin; 
?>
</html>
<?php
    }
}    

// Programa principal
//leer las variables enviadas

if(isset($_POST['cedula']) && isset($_POST['contra'])) {
	$cedula=$_POST['cedula'];
    $contra=$_POST['contra'];

	// limpiemos la cedula y coloquemos los ceros faltantes
	$cedula = ltrim(preg_replace("/[^0-9]/","",$cedula),'0');
   // $cedula = substr("00000000".$cedula, -8);
    $fvacio = false;
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
	<html>
		<head>
			<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
<?php
	print $noCache; 
	print $noJavaScript; 
?>
			<title><?php echo $tProceso .' '. $lapso; ?></title>
<?php
        $cedYclave = cedula_valida($cedula,$contra);

		if(!$fvacio && $cedYclave[0] && $cedYclave[1] && $cedYclave[2]) {
			// Revisamos si es su turno de inscripcion:
			if ($inscHabilitada) {
				//echo "### CUMPLE TODOS LOS PARAMETROS PARA INGRESAR";
				
				#Rutina de redireccionamiento segun el tipo de usuario:
				switch (substr($campus,0,1)) {
				#Jefes Dpto
					case 'P':
					case 'T':
					case 'G':
						$destino = "modcoord";
						break;
					default:
						$destino = "modprof";				
				}

print <<<FORM1
					<body onload="document.envia.action='webtgpp/$destino.php'; document.envia.submit();">
					<form name="envia" method="post" action="" >
						<input type="hidden" name="cedula" value="$cedula">
					</form>
FORM1;
								
					####
			}else volver_a_indice(false,true,false);//inscripciones no habilitadas
        }else volver_a_indice(false,false); //cedula o clave incorrecta
	}else volver_a_indice(true,false); //formulario vacio
?>
