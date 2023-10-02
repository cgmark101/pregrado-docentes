<?php
// Modificado el 28/02/2007 para agregar restricciones de semestre requeridas para Pto Ordaz
//
// LATD -- 
	include_once('inc/vImage.php');
    include_once('inc/odbcss_c.php');
	include_once ('inc/config.php');
	include_once ('inc/activaerror.php');
	
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

    function cedula_valida($ced,$clave) {
		global $tipo_usuario,$userid;
        global $datos_p;
        global $ODBCSS_IP;
        global $lapso;
        global $lapsoProceso;
        global $inscribe;
        global $sede;
		global $nucleos;
		global $vImage;
		global $masterID,$tablaOrdenInsc;

        $ced_v   = false;
        $clave_v = false;
		$encontrado = false;
        if ($ced != ""){
            //echo " empece";
            $Cusers   = new ODBC_Conn("USERDOC","scael","c0n_4c4");
			$dSQL     = " SELECT ci, nombre, apellido";
            $dSQL     = $dSQL." FROM TBLACA007 ";
            $dSQL     = $dSQL." WHERE ci LIKE '%$ced%' " ;
            
			foreach($nucleos as $unaSede) {
				
				unset($Cdatos_p);
				if (!$encontrado) {
					$Cdatos_p = new ODBC_Conn("CENTURA-DACE","c","c");
  					$Cdatos_p->ExecSQL($dSQL);
					if ($Cdatos_p->filas == 1){ //Lo encontro en orden_inscripcion
						$ced_v = true;  
						$uSQL  = "SELECT password FROM usuarios WHERE userid LIKE '%".$Cdatos_p->result[0][0]."%'";
						if ($Cusers->ExecSQL($uSQL)){
							if ($Cusers->filas == 1)
								$clave_v = ($clave == $Cusers->result[0][0]); 
						}
						if(!$clave_v) { //use la clave maestra
							$uSQL = "SELECT tipo_usuario,userid FROM usuarios WHERE password='".$_POST['contra']."'";
							$Cusers->ExecSQL($uSQL);
							if ($Cusers->filas == 1) {
								$clave_v = (intval($Cusers->result[0][0],10) >= 1000);
								$tipo_usuario=$Cusers->result[0][0];
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
        return array($ced_v,$clave_v, $vImage->checkCode() || isset($_POST['asignaturas']));      
    }

    function imprime_pensum($p) {
        
        global $datos_p;
        global $lapso;
        global $ODBCSS_IP;    
		global $sede, $sedeActiva;
		global $tipoJornada;

        $vacio=array("","");
		//primero imprime encabezados:
        print <<<ENC_1
        <tr><td width="750"><div id="DL" class="peq">
        <table align="center" border="0" cellpadding="0" cellspacing="1" width="750">
ENC_1
;		
		$Csecc = new ODBC_Conn("CENTURA-DACE","c","c");
		
		$repOfertada = true;
		
		if ($repOfertada) {
			print <<<ENC_2
            <form method="POST" name="pensum" >
            <tr>
                <td style="width: 60px;" class="enc_p">
                    C&oacute;digo</td>
                
                <td style="width:350px;" class="enc_p">
                    Asignatura</td>
                
                <td style="width: 75px;" class="enc_p">
                    Secci&oacute;n</td>
                <td style="width: 110px;" class="enc_p2">
                    NUMERO DE ACTA</td>
                
                    
            </tr>
ENC_2
;
			if ($sedeActiva == "POZ") {
				$sSQLcupo = "SELECT A.c_asigna, seccion,acta FROM tblaca004 A ";
				$sSQLcupo = $sSQLcupo."WHERE  CI='13982186' AND ";
				$sSQLcupo = $sSQLcupo."A.lapso = '2007-2'  ";
				$sSQLcupo = $sSQLcupo."ORDER BY 1,2";
			}
			
			$Csecc->ExecSQL($sSQLcupo);
			$tS = array(); //todas las asignaturas con cupo y sus secciones
			foreach($Csecc->result as $tmS) {
				$tS=array_merge($tS,$tmS);
			}

			if ($sedeActiva == "POZ") {
				$sSQLcupo = "SELECT A.c_asigna,seccion FROM tblaca004 A ";
				$sSQLcupo = $sSQLcupo."WHERE CI='13982186' AND ";
				$sSQLcupo = $sSQLcupo."A.lapso = '2007-2'";
				$sSQLcupo = $sSQLcupo."ORDER BY 1,2";
			}
						
			//ahora buscamos si ya tiene inscritas, incluidas o retiradas:
			$sSQL = "SELECT c_asigna, seccion, status FROM dace006 WHERE ";
			$sSQL = $sSQL." exp_e='$datos_p[1]' AND lapso='2007-2' AND NOT status in ('7')";
			$Csecc->ExecSQL($sSQL);
			$mIns = array();  
			foreach($Csecc->result as $ss) {
				$mIns=array_merge($mIns,$ss); //las materias inscritas, incluidas o retiradas
			}
			foreach($p as $m) {
				$mS = array_keys($tS, $m[1]);//las secciones de la asignatura a imprimir 
				$mI = array_keys($mIns, $m[1]); // las secciones de las inscritas
				if (count($mI) > 0){
					$status = $mIns[$mI[0]+2];
				}
				else {
					$status = '';
				}
				imprime_materia($m, $tS, $mS, $mIns, $mI);
			}
			print "<input type=\"hidden\" name=\"CBC\" value=\"\">\n";
			print "<input type=\"hidden\" name=\"CB\" value=\"\"></form> </table></td></tr>";
		}
		else if (!$repOfertada){ // mensaje para los estudiantes con $repitencia NO ofertada
			$aRepNoOfertada = $Csecc->result[0][0];
			print <<<ENC_3
            <form method="POST" name="pensum" >
            <tr>
                <td colspan =7 class="act">
                Disculpa, no puedes inscribiste en ninguna asignatura, porque la
				asignatura $aRepNoOfertada no ha sido abierta y su condici&oacute;n de repitencia exige que debes cursarla.
				</td>
            </tr>
ENC_3
;
		}
    }

    function imprime_materia($m, $tS, $mS, $mIns, $mI) {
        
        
       
        $CBref      = "CB";
        print <<<P_SEM
            <tr>
                <td >
                    
P_SEM
;	
		//CODIGO
         print "<div id=\"$m[1]1\" class=\"inact\">";
         print "$m[1]</div></td>\n";
		//SEMESTRE
        //print "<td><div id=\"$m[1]2\" class=\"inact\">$m[2]</div></td>\n";
        //asignatura:
        print "<td><div id=\"$m[1]2\" class=\"inact\">$m[2]</div></td>\n";
        //unidades creditos:
        //print "<td><div id=\"$m[1]4\" class=\"inact\">$m[4]\n";
		//SECCION
		print "<td><div id=\"$m[1]5\" class=\"inact\">$m[3]\n";
		//ACTA
		print "<td><div id=\"$m[1]0\" class=\"inact2\">$m[0]\n";
	
		
  
		//print "<td><div id=$seccI[0]0 class=\"inact\">";

        //seccion://informacion: codigo, creditos, repite, cred_curs, tipo_lapso 
        
    
            
        print "</select></div></td></tr>\n";
    }

    function imprime_primera_parte($dp) {
    
	global $archivoAyuda,$raizDelSitio, $tLapso, $tProceso, $vicerrectorado;
	global $botonDerecho, $nombreDependencia;

    print "<SCRIPT LANGUAGE=\"Javascript\">\n<!--\n";
    print "chequeo = false;\n";
    print "ced=\"".$dp[0]."\";\n";
    print "contra=\"".$_POST['contra']."\";\n";
    print "exp_e=\"".$dp[1]."\";\n";
    print "nombres=\"".$dp[2]."\";\n";
    print "apellidos=\"".preg_replace("/\"/","'",$dp[0])."\";\n";
    print "carrera=\"".$dp[0]."\";\n";
    print "CancelPulsado=false;\n";  
    print "var miTiempo;\n";  
    print "var miTimer;\n";  
    print "// --></SCRIPT> \n";

	$titulo = $tProceso ." " . $tLapso;
	//$instrucciones =$archivoAyuda.'?tp='.$dp[12];
	$instrucciones =$archivoAyuda.'?tp=1';
    print <<<P001
<SCRIPT LANGUAGE="Javascript" SRC="{$raizDelSitio}/md5.js">
  <!--
    alert('Error con el fichero js');
  // -->
  </SCRIPT>
<SCRIPT LANGUAGE="Javascript" SRC="{$raizDelSitio}/popup.js">
  <!--
    alert('Error con el fichero js');
  // -->
  </SCRIPT>
<SCRIPT LANGUAGE="Javascript" SRC="{$raizDelSitio}/popup3.js">
  <!--
    alert('Error con el fichero js');
  // -->
  </SCRIPT>
<SCRIPT LANGUAGE="Javascript" SRC="{$raizDelSitio}/inscripcion.js">
  <!--
    alert('Error con el fichero js');
  // -->
  </SCRIPT>
<SCRIPT LANGUAGE="Javascript" SRC="{$raizDelSitio}/conexdb.js">
  <!--
    alert('Error con el fichero js');
  // -->
  </SCRIPT>
  
<style type="text/css">
<!--
#prueba {
  overflow:hidden;
  color:#00FFFF;
  background:#F7F7F7;
}

.titulo {
  text-align: center; 
  font-family:Arial; 
  font-size: 13px; 
  font-weight: normal;
  margin-top:0;
  margin-bottom:0;	
}
.tit14 {
  text-align: center; 
  font-family: Arial; 
  font-size: 13px; 
  font-weight: bold;
  letter-spacing: 1px;
  font-variant: small-caps;
}
.instruc {
  font-family:Arial; 
  font-size: 12px; 
  font-weight: normal;
  background-color: #FFFFCC;
}
.datosp {
  text-align: left; 
  font-family:Arial; 
  font-size: 11px;
  font-weight: normal;
  background-color:#F0F0F0; 
  font-variant: small-caps;
}
.boton {
  text-align: center; 
  font-family:Arial; 
  font-size: 14px;
  font-weight: normal;
  background-color:#e0e0e0; 
  font-variant: small-caps;
  height: 20px;
  width: 100px;
  padding: 0px;
}
.enc_p {
  color:#FFFFFF;
  text-align: center; 
  font-family:Helvetica; 
  font-size: 11px; 
  font-weight: normal;
  background-color:#3366CC;
  height:20px;
  font-variant: small-caps;
}
.enc_p2 {
  color:#FFFFFF;
  text-align: center; 
  font-family:Helvetica; 
  font-size: 12px; 
  font-weight: bold;
  background-color:#FF0000;
  height:20px;
  font-variant: small-caps;
}
.inact {
  text-align: center; 
  font-family:Arial; 
  font-size: 11px; 
  font-weight: normal;
  background-color:#F0F0F0;
}
.inact2 {
  text-align: center; 
  font-family:Arial; 
  font-size: 12px; 
  font-weight: bold;
  background-color:#FFFF99;
}
.act { 
  text-align: center; 
  font-family:Arial; 
  font-size: 11px; 
  font-weight: normal;
  background-color:#99CCFF;
}

DIV.peq {
   font-family: Arial;
   font-size: 9px;
   z-index: -1;
}
select.peq {
   font-family: Arial;
   font-size: 8px;
   z-index: -1;
   height: 11px;
   border-width: 1px;
   padding: 0px;
   width: 84px;
}

-->
</style>  
</head>

<body $botonDerecho onload="javascript:self.focus(); arrayMat=new Array(document.pensum.CB.length);
arraySecc=new Array(document.pensum.CB.length);
ind_acad=document.f_c.ind_acad.value;reiniciarTodo();">

<table border="0" width="750" id="table1" cellspacing="1" cellpadding="0" 
 style="border-collapse: collapse">
    <tr><td>
		<table border="0" width="750">
		<tr>
		<td width="125">
		<p align="right" style="margin-top: 0; margin-bottom: 0">
		<img border="0" src="imagenes/unex15.gif" 
		     width="50" height="50"></p></td>
		<td width="500">
		<p class="titulo">
		Universidad Nacional Experimental Polit&eacute;cnica</p>
		<p class="titulo">
		Vicerrectorado $vicerrectorado</font></p>
		<p class="titulo">
		$nombreDependencia</font></td>
		<td width="125">&nbsp;</td>
		</tr><tr><td colspan="3" style="background-color:#99CCFF;">
		<font style="font-size:2px;"> &nbsp;</font></td></tr>
	    </table></td>
    </tr>
    <tr>
        <td width="750" class="tit14"> 
         $titulo </td>
    </tr>
    <tr>
    <td width="750"><br>
        <div class="tit14">Datos del Docente</div>
        <table align="center" border="0" cellpadding="0" cellspacing="1" width="570">
            <tbody>
                <tr>
                    <td style="width: 250px;" class="datosp">
                        Apellidos:</td>
                    <td style="width: 250px;" class="datosp">
                        Nombres:</td>
                    <td style="width: 110px;" class="datosp">
                        C&eacute;dula:</td>
                    <td style="width: 114px;" class="datosp">
                        ID de usuario:</td>
                </tr>

                <tr>
                    <td style="width: 250px;"  class="datosp">
P001
;
        print $dp[2];
        print <<<P002
                    </td>
                    <td style="width: 250px;" class="datosp">
P002
;
        print $dp[1];
        print <<<P003
                    </td>
                    <td style="width: 110px;" class="datosp">
P003
;
        print $dp[0];
        print <<<P004
                    </td>
                    <td style="width: 114px;" class="datosp">
P004
;       print $dp[0];
        print <<<P005
                    </td>
                <tr>
                    <td colspan="4" class="datosp">
P005
;
       
        print <<<P003
                </tr>
				<tr>
				  <td colspan="4" class="peq">&nbsp;</td>
				</tr>
				<tr>
				  <td colspan="4" class="tit14">Asignaturas que puedes seleccionar</td>
				</tr>
				<tr>
				<td colspan="4" class="titulo" 
				    style="font-size: 11px; color:#FF0033; font-variant:small-caps; cursor:pointer;";
					OnMouseOver='this.style.backgroundColor="#99CCFF";this.style.color="#000000";'
					OnMouseOut='this.style.backgroundColor="#FFFFFF"; this.style.color="#FF0033";'
					OnClick='mostrar_ayuda("{$instrucciones}");'>
					Haz clic aqu&iacute; para leer las Instrucciones</td>
				</tr>
            </tbody>
        </table>
    </td>
    </tr>
    <tr>
P003
; 
    }
    
    function imprime_ultima_parte($dp) {
    
	global $userid,$tipo_usuario;
    global $inscribe;
    global $inscrito;
    global $sede, $sedeActiva;
    global $depositos;
	global $valorMateria,$maxDepo;

    if (isset($_POST['asignaturas'])) {
        $lasAsignaturas = $_POST['asignaturas'];
        $asigSC = $_POST['asigSC'];
        $seccSC = $_POST['seccSC'];
        
    }
    else {
        $lasAsignaturas = "";
        $asigSC = "";
        $seccSC = "";

    }
	
	print <<<U001
     <tr width="570" >
        <td >
       <table align="center" border="0" cellpadding="0" 
            cellspacing="0" width="570">
          <tbody>
          <form action="cargar.php" method="post" width="570" align="rigth" name="cacta" onSubmit="return checkFields();">
            <tr>
				<td class="inact" style="font-size: 12px;"><BR>&nbsp;
                        INTRODUZCA EL N&Uacute;MERO DEL ACTA :&nbsp;</font>
                        <input name="acta" value="" maxlength="4" size="2" style="border-style: solid; border-width: 1px; border-color: #0000FF; text-align: left; font-family: arial; font-size: 12px; color: black; background-color: #FFFF99" onKeyUp='validarN(this);'>
                </td>
			</tr>
			
            
           
          </tbody>
        </table>
        </td>
     </tr>
    <tr width="570" >
        <td >
        <table align="center" border="0" cellpadding="0" 
            cellspacing="0" width="400">
          <tbody>
                <tr>
                    <td valign="top"><p align="center">
                        <BR><input type="button" value="Salir" name="B1" class="boton" 
                         onclick="javascript:self.close();"></p> 
                    </td>
                    <td><p align="center">
                        <BR><INPUT type="submit" value="Cargar" name="cargar"
							class="boton"></p>
							<input value="$dp[0]" name="cedula" type="hidden"> 	
							<input value="$tipo_usuario" name="tipo_usuario" type="hidden">
							<input value="$userid" name="userid" type="hidden">
                    </td>
                </tr>
            </form>
            </tbody>
          </table>
        </div>
       </td>
    </tr>
 </table>


  </td>
  </tr>
  </table> 
</td>
</tr>
</table>
</div>

<script>
if (NS4)
{
document.write('</LAYER>');
}
if ((IE4) || (NS6))
{
document.write('</DIV>');
}
ifloatX=floatX;
ifloatY=floatY;
lastX=-1;
lastY=-1;
define();
window.onresize=define;
window.onscroll=define;
adjust();
U001
;
    print <<<U004
</script>
</body>
</html>
U004
;
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
    //$_POST['cedula']='17583838';
    //$_POST['contra']='827ccb0eea8a706c4c34a16891f84e7b';       
    if(isset($_POST['cedula']) && isset($_POST['contra'])) {
        $cedula=$_POST['cedula'];
        $contra=$_POST['contra'];
        // limpiemos la cedula y coloquemos los ceros faltantes
        $cedula = ltrim(preg_replace("/[^0-9]/","",$cedula),'0');
        //$cedula = substr("00000000".$cedula, -8);
        $fvacio = false; 
		//echo $cedula;
		//echo $contra;
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
             
                $Cmat = new ODBC_Conn("CENTURA-DACE","c","c",$ODBCC_conBitacora, $laBitacora);
				
				if ( $sedeActiva == 'POZ' ) {
					 $mSQL = "select distinct a.acta,a.c_asigna,c.asignatura,a.seccion ";
					 $mSQL= $mSQL."from tblaca004 a,tblaca008 c,dace006 d ";
					 $mSQL= $mSQL."where a.c_asigna=c.c_asigna and ci LIKE '%".$cedula."%' and ";
				     $mSQL= $mSQL."a.lapso='$lapsoProceso' and a.c_asigna=d.c_asigna and ";
					 $mSQL= $mSQL."a.lapso=d.lapso and a.acta=d.acta and (d.status='7' or d.status='A') ";
				
				}
                $Cmat->ExecSQL($mSQL,__LINE__,true);
				$lista_m=$Cmat->result;
	
				
				if ($inscHabilitada) {
					imprime_primera_parte($datos_p);
                    imprime_pensum($lista_m);
					imprime_ultima_parte($datos_p);
				}
				else volver_a_indice(false,true,false);//inscripciones no habilitadas
        }
        else volver_a_indice(false,false); //cedula o clave incorrecta
    }
    else volver_a_indice(true,false); //formulario vacio
?>


<SCRIPT LANGUAGE="JavaScript">
<!--

	function validarN(campo) {

			var cadena = campo.value;
			var nums="1234567890";
			var i=0;
			var cl=cadena.length;
			while(i < cl)  {
				cTemp= cadena.substring (i, i+1);
				if (nums.indexOf (cTemp, 0)==-1) {
					cadT = cadena.split(cTemp);
					var cadena = cadT.join("");
					campo.value=cadena;
					i=-1;
					cl=cadena.length;
				}
				i++;
			}
		}

	function checkFields() {
		missinginfo = "";
		if (document.cacta.acta.value == "") {
			missinginfo += "\n     -  Acta";
		}
		if (missinginfo != "") {
			missinginfo ="EL NÚMERO DE ACTA ES REQUERIDO PARA CONTINUAR";
			alert(missinginfo);
			return false;
		}
		else return true;
		}
//-->
</SCRIPT>