<?php
session_start();
include_once('conexion.php');
include ('class.ezpdf.php');
$pdf = new Cezpdf('LETTER','portrait');
$pdf->selectFont('./fonts/Times-Roman.afm');
$pdf->ezSetCmMargins(2.5,2.5,2.5,2.5);
	$sql="select CI_E, empresa, n_proyecto, TIPO_PASANTIA, cedula_TI, nombre_TI, apellido_TI, telefono_TI, correo_TI, fecha_i, fecha_c, id_estatus, cedula_TA, cedula_JC, cedula_JS from sol_tgpp where CI_E = '$_REQUEST[id]'and TIPO_PASANTIA='$_SESSION[TIPO_PASANTIA]'";
	$conex1 -> ExecSQL($sql,__LINE__,true);
	$fila = $conex1->filas;
	if ($fila==1)
	{	$tab1 = $conex1->result_h;
		$tab2 = $conex1->result[0];
		$tab = array_combine($tab1,$tab2);
		$tablaaux[]=$tab;
		
		$sql1="select APELLIDOS, NOMBRES, EXP_E, C_UNI_CA from dace002 where CI_E = '$tab[CI_E]'";
		$conex -> ExecSQL($sql1,__LINE__,true);
		$fila1 = $conex->filas;
		if ($fila1==1)
		{
			$reg1 = $conex->result_h;
			$reg2 = $conex->result[0];
			$reg = array_combine($reg1,$reg2);
			$reg_aux[]=$reg;
			
			$sql2="select APELLIDO, NOMBRE, CI from tblaca007 where CI = $tab[cedula_JC]" ;
			$conex -> ExecSQL($sql2,__LINE__,true);
			$fila2 = $conex->filas;
			if ($fila2==1)
		    	{
			$pro1 = $conex->result_h;
			$pro2 = $conex->result[0];
			$prof = array_combine($pro1,$pro2);
			$prof_aux[] =$prof;
			}
		}
	}
	switch($reg_aux[0]['C_UNI_CA'])
        {   case 2:
            $esp[0]["ESP"]="MECÁNICA";
            break;
            case 3:
            $esp[0]["ESP"]="ELÉCTRICA";
            break;
            case 4:
            $esp[0]["ESP"]="METALÚRGICA";
            break;
            case 5:
            $esp[0]["ESP"]="ELECTRÓNICA";
            break;
            case 6:
            $esp[0]["ESP"]="INDUSTRIAL";
            break;            
        }
	if ($_SESSION["TIPO_PASANTIA"]==1)
		$asi[0]["TIPO"]="PRÁCTICA PROFESIONAL";
		$ART[0]["ART"]=" LA";
		$ART[0]["LETRA"]="A";
		$ART[0]["ARTI"]="LA";
	if ($_SESSION["TIPO_PASANTIA"]==2)
		$asi[0]["TIPO"]="TRABAJO DE GRADO";
		$ART[0]["ART"]="L";
		$ART[0]["LETRA"]="O";
		$ART[0]["ARTI"]="EL";
	if($reg_aux[0]['C_UNI_CA']==5 && $_SESSION['TIPO_PASANTIA']==2)
	{	$cadena[0]["palabras"]=".";
	}	else
	{	$cadena[0]["palabras"]=", ".$ART[0]["ARTI"]." CUAL ESTÁ DESARROLLAD".$ART[0]["LETRA"]." BAJO LA TUTORÍA INDUSTRIAL DEL ING. ".$tablaaux[0]['nombre_TI']." ".$tablaaux[0]['apellido_TI'].".";
	}
	$diasemana[]=array("LUNES","MARTES","MIÉRCOLES","JUEVES","VIERNES","SÁBADO","DOMINGO");
	$meses[] = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
$pdf->ezImage("unexpo.jpg",'0','90','none','left','');
$pdf->ezSetY(740);
$pdf->ezText('REPÚBLICA BOLIVARIANA DE VENEZUELA',10,array('justification' => 'center','left'=> 128,'spacing' =>1.15));
$pdf->ezText('MINISTERIO DEL PODER POPULAR PARA LA EDUCACIÓN UNIVERSITARIA',10,array('justification' => 'center','left'=> 128,'spacing' =>1.15));
$pdf->ezText('UNIVERSIDAD NACIONAL EXPERIMENTAL POLITÉCNICA',10,array('justification' => 'center','left'=> 128,'spacing' =>1.15));
$pdf->ezText('"ANTONIO JOSÉ DE SUCRE"',10,array('justification' => 'center','left'=> 128,'spacing' =>1.15));
$pdf->ezText('VICE-RECTORADO PUERTO ORDAZ',10,array('justification' => 'center','left'=> 128,'spacing' =>1.15));
$pdf->ezText('DEPARTAMENTO DE INGENIERÍA '.$esp[0]["ESP"],10,array('justification' => 'center','left'=> 128,'spacing' =>1.15));
$pdf->setLineStyle(2);
$pdf->line(70,650,550,650);
$pdf->line(70,645,550,645);
$pdf->ezSetY(643);
$pdf->ezText('URB VILLA ASIA - FINAL CALLE CHINA - TLF:(0286)9623821 TELEFAX 9623881-9625245 - APARTADO POSTAL 78',8,array('justification' => 'center','left'=> 0,'spacing' =>1));
$pdf->ezSetY(580);
$pdf->ezText('PUERTO ORDAZ, '.$diasemana[0][date('N')-1].' '.date('d').' DE '.$meses[0][date('n')-1].' DE '.date('Y').'.',10,array('justification' => 'right','spacing' =>1));
$pdf->ezSetY(540);
$pdf->ezText('PARA: '.$prof_aux[0]["APELLIDO"].', '.$prof_aux[0]["NOMBRE"],10,array('justification' => 'left','right'=> 150,'spacing' =>1.15));
$pdf->ezText('DE: COORDINADOR DE '.$asi[0]["TIPO"],10,array('justification' => 'left','right'=> 0,'spacing' =>1.15));
$pdf->ezSetY(500);
$pdf->ezText('ASUNTO: EN EL TEXTO.',10,array('justification' => 'left','right'=> 0,'spacing' =>1.15));
$pdf->ezText('ESTIMADO.',10,array('justification' => 'left','right'=> 150,'spacing' =>1.15));
$pdf->ezSetY(440);
$pdf->ezText('SIRVA LA PRESENTE PARA INFORMARLE FORMALMENTE QUE HA SIDO DESIGNADO <b>COORDINADOR DEL JURADO EVALUADOR</b> DE'.$ART[0]["ART"].' '.
	     $asi[0]["TIPO"].' DEL BACHILLER <b>'.$reg_aux[0]["APELLIDOS"].', '.$reg_aux[0]["NOMBRES"].'</b>, C.I.: '.$tablaaux[0]["CI_E"].
	     '. TITULAD'.$ART[0]["LETRA"].': '.$tablaaux[0]["n_proyecto"].$cadena[0]["palabras"],10,array('justification'=>'full','right'=>0,'spacing'=>1.5));
$pdf->ezSetY(300);
$pdf->ezText('AGRADECIENDO CONTAR CON SU VALIOSA COLABORACIÓN.',10,array('justification' => 'left','right'=> 0,'spacing' =>1.15));
$pdf->ezSetY(270);
$pdf->ezText('QUEDA DE USTED.',10,array('justification' => 'left','right'=> 0,'spacing' =>1.15));
$pdf->setLineStyle(1);
$pdf->line(210,180,410,180);
$pdf->ezSetY(180);
	$sql1="select APELLIDO, NOMBRE, DEPARTAMENTO from tblaca007 where CI = '$_SESSION[coor]'";
        $conex -> ExecSQL($sql1,__LINE__,true);
	$fila = $conex->filas;
	if ($fila!=0)
	    {
	    $reg1 = $conex->result_h;
	    $reg2 = $conex->result[0];
	    $reg = array_combine($reg1,$reg2);
$pdf->ezText($reg["NOMBRE"].' '.$reg["APELLIDO"],10,array('justification' => 'center','right'=> 0,'spacing' =>1.15));
	    }
$pdf->ezText('COORDINADOR DE '.$asi[0]["TIPO"],10,array('justification' => 'center','right'=> 0,'spacing' =>1.15));
ob_end_clean();
$pdf->eZstream();
?>