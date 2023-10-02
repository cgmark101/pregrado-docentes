<?php
include_once ('../odbc/vImage.php');
include_once ('../odbc/odbcss_c.php');
include_once ('../odbc/config.php');


function cedula_valida($ced,$clave,$db,$usuar,$pass) {
		global $ODBCSS_IP;
        $vImage = new vImage();
		$vImage->loadCodes();
		$coo=$vImage->checkCode();
		$ced_v   = false;
        $clave_v = false;
		$encontrado = false;

        if ($ced != "")
			{
				
					
			$dSQL = "SELECT ci_e, exp_e, nombres, apellidos, lapso_in FROM DACE002 WHERE ci_e='$ced'";
					
            $Cusers   = new ODBC_Conn("USERSDB","scael","c0n_4c4");

				if (!$encontrado) {
				//echo 'entre despues';
					$Cdatos_p = new ODBC_Conn($db,$usuar,$pass);
  					$Cdatos_p->ExecSQL($dSQL);
					if ($Cdatos_p->filas == 1)
					{ //Lo encontro en orden_inscripcion
						//echo 'entre despues';
						$ced_v = true;
						$ced=$Cdatos_p->result[0][1];
						$uSQL  = "SELECT password, tipo_usuario FROM usuarios WHERE userid='$ced'";
						//echo $ced;
						if ($Cusers->ExecSQL($uSQL))
							{	
								//echo 'entre despues';
								if ($Cusers->filas == 1)
								$clave_v = ($clave == $Cusers->result[0][0]); 
								//echo $clave.'----'.$Cusers->result[0][0];
							}
						if(!$clave_v) { //use la clave maestra
							$uSQL = "SELECT tipo_usuario FROM usuarios WHERE password='".$clave."'";
							$Cusers->ExecSQL($uSQL);
							if ($Cusers->filas == 1) {
								$clave_v = (intval($Cusers->result[0][0],10) > 1000);
							}     
						}
						$datos_p = $Cdatos_p->result[0];
						// modificado para preinscripciones intensivo, pues hay conflictos con lapso actual:
						$datos_p[11] = $lapsoProceso;
						$lapso = $datos_p[11];
						$encontrado = true;
						//$sede = $unaSede;
					}
				}
			//}
        }
		
		// Si falla la autenticacion del usuario, hacemos un retardo
		// para reducir los ataques por fuerza bruta
		if (!($clave_v && $ced_v)) {
			sleep(5); //retardo de 5 segundos
		}			
        return array($ced_v,$clave_v,$coo,$Cdatos_p->result[0][1] );      
}


$cedula=$_POST['cedula_v'];
$cla=$_POST['contra_v'];
$contra=md5($cla);
$cedYclave =cedula_valida($cedula,$contra,$basededatos,$usuariodb,$clavedb);

echo $cedYclave[2];

		if($cedYclave[0]!=NULL && $cedYclave[1]!=NULL)   
			{
			?>
			
<body Onload="document.form2.action='../visucal.php'; document.form2.submit();">
				<form name="form2" method="post" action="" >
	 				<input type="hidden" name="exp_e" value="<?PHP echo $cedYclave[3]; ?>">
					 </form>
				
				
				<?PHP		
					
			}
		else	volver_a_indice(false,false); //cedula o clave incorrecta

	

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
    }
    else {
?>          <script languaje="Javascript">
            <!--
            function entrar_error() {
<?php
        if ($fueraDeRango) {
			if($habilitado){
?>             
		mensaje = "Lo siento, no puedes inscribirte en este horario.\n";
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
		//mensaje = mensaje + "Es posible que usted deba solicitar REINGRESO\n";
		//mensaje = mensaje + "si se retiro en el semestre anterior.";
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

		
	
	
	
	
	
?>