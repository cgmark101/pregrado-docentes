<?php
session_start();
include_once('conexion.php');
include ('class.ezpdf.php');
$pdf = new Cezpdf('LETTER','portrait');
$pdf->selectFont('./fonts/Times-Roman.afm');
$pdf->ezSetCmMargins(2.5,1,2.5,2.5);
	$sql="select CI_E, empresa, n_proyecto, TIPO_PASANTIA, cedula_TI, nombre_TI, apellido_TI, telefono_TI, correo_TI, fecha_i, fecha_c, id_estatus, cedula_TA, cedula_JS, cedula_JC from sol_tgpp where CI_E = '$_REQUEST[id]' and TIPO_PASANTIA='$_SESSION[TIPO_PASANTIA]'";
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
			
			$sql2="select APELLIDO, NOMBRE, CI from tblaca007 where CI = $tab[cedula_JC]";
			$conex -> ExecSQL($sql2,__LINE__,true);
			$fila2 = $conex->filas;
			if ($fila2==1)
		    	{
			$pro1 = $conex->result_h;
			$pro2 = $conex->result[0];
			$prof = array_combine($pro1,$pro2);
			$prof_aux[] =$prof;
			}
			$sql3="select APELLIDO, NOMBRE, CI from tblaca007 where CI = $tab[cedula_JS]";
            $conex -> ExecSQL($sql3,__LINE__,true);
			$fila3 = $conex->filas;
			if ($fila3==1)
		    	{
			$pro1 = $conex->result_h;
			$pro2 = $conex->result[0];
			$prof2 = array_combine($pro1,$pro2);
			$prof_aux2[] =$prof2;
			}
			$sql4="select APELLIDO, NOMBRE, CI from tblaca007 where CI = $tab[cedula_TA]";
                        $conex -> ExecSQL($sql4,__LINE__,true);
			$fila4 = $conex->filas;
			if ($fila4==1)
		    	{
			$pro1 = $conex->result_h;
			$pro2 = $conex->result[0];
			$prof3 = array_combine($pro1,$pro2);
			$prof_aux3[] =$prof3;
			}
		}
	}
	if ($_SESSION["TIPO_PASANTIA"]==1)
		$asi[0]["TIPO"]="PRACTICA PROFESIONAL";
		$ART[0]["ART"]=" LA";
		$ART[0]["LETRA"]="A";
		$ART[0]["ARTI"]="LA";
	if ($_SESSION["TIPO_PASANTIA"]==2)
		$asi[0]["TIPO"]="TRABAJO DE GRADO";
		$ART[0]["ART"]="L";
		$ART[0]["LETRA"]="O";
		$ART[0]["ARTI"]="EL";
        switch($reg_aux[0]['C_UNI_CA'])
        {   case 2:
            $esp[0]["ESP"]="MECANICA";
            break;
            case 3:
            $esp[0]["ESP"]="ELECTRICA";
            break;
            case 4:
            $esp[0]["ESP"]="METALURGICA";
            break;
            case 5:
            $esp[0]["ESP"]="ELECTRONICA";
            break;
            case 6:
            $esp[0]["ESP"]="INDUSTRIAL";
            break;            
        }
	if($reg_aux[0]['C_UNI_CA']==5 && $_SESSION['TIPO_PASANTIA']==2){
		$cadena[0]["palabras"]=".";
	} else {
		$cadena[0]["palabras"]=".";
		//$cadena[0]["palabras"]=", ".$ART[0]["ARTI"]." CUAL ESTA DESARROLLAD".$ART[0]["LETRA"]." BAJO LA TUTORIA INDUSTRIAL DEL ING. ".$tablaaux[0]['apellido_TI'].", ".$tablaaux[0]['apellido_TI'].".";
	}
	$diasemana[]=array("LUNES","MARTES","MIERCOLES","JUEVES","VIERNES","SABADO","DOMINGO");
	$meses[] = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
$pdf->ezImage("unexpo.jpg",'0','90','none','left','');
$pdf->ezSetY(740);
$pdf->ezText('REPUBLICA BOLIVARIANA DE VENEZUELA',10,array('justification' => 'center','left'=> 128,'spacing' =>1.15));
$pdf->ezText('MINISTERIO DEL PODER POPULAR PARA LA EDUCACION UNIVERSITARIA',10,array('justification' => 'center','left'=> 128,'spacing' =>1.15));
$pdf->ezText('UNIVERSIDAD NACIONAL EXPERIMENTAL POLITECNICA',10,array('justification' => 'center','left'=> 128,'spacing' =>1.15));
$pdf->ezText('"ANTONIO JOSE DE SUCRE"',10,array('justification' => 'center','left'=> 128,'spacing' =>1.15));
$pdf->ezText('VICE-RECTORADO PUERTO ORDAZ',10,array('justification' => 'center','left'=> 128,'spacing' =>1.15));
$pdf->ezText('DEPARTAMENTO DE INGENIERIA '.$esp[0]["ESP"],10,array('justification' => 'center','left'=> 128,'spacing' =>1.15));
$pdf->setLineStyle(2);
$pdf->line(70,650,550,650);
$pdf->line(70,645,550,645);
$pdf->ezSetY(643);
$pdf->ezText('URB VILLA ASIA - FINAL CALLE CHINA - TLF:(0286)9623821 TELEFAX 9623881-9625245 - APARTADO POSTAL 78',8,array('justification' => 'center','left'=> 0,'spacing' =>1));
$pdf->ezSetY(615);
$pdf->ezText('<b>ACTA DE EVALUACION FINAL DE '.$asi[0]["TIPO"].'</b>',10,array('justification' => 'center','spacing' =>1));
$pdf->ezSetY(590);
$pdf->ezText('HOY,_______________________, REUNIDOS EN________________________________, PRESIDIDO POR EL(LA) PROFESOR(A): '.$prof_aux[0]["NOMBRE"].' '.$prof_aux[0]["APELLIDO"].
             ', SE DIO INICIO AL ACTO DE PRESENTACION ORAL PUBLICA DE'.$ART[0]["ART"].' '.$asi[0]["TIPO"].' TITULAD'.$ART[0]["LETRA"].': '.$tablaaux[0]["n_proyecto"].'.',10,array('justification' => 'full','spacing' =>1.5));
$pdf->ezSetDy(-5);
$pdf->ezText('PRESENTADO POR EL(LA) BACHILLER: <b>'.$reg_aux[0]["APELLIDOS"].', '.$reg_aux[0]["NOMBRES"].'</b>, C.I.: '.$tablaaux[0]["CI_E"].'.',10,array('justification' => 'full','spacing' =>1.5));
$pdf->ezSetDy(-5);
$pdf->ezText('UNA VEZ REALIZADA LA PRESENTACION ORAL Y CONCLUIDO EL CICLO DE PREGUNTAS, EL JURADO EVALUADOR EMITIO SU VEREDICTO DE ___________ CON UNA CALIFICACION DE: ________ PUNTOS EN LA ESCALA DEL 1 AL 9, DE ACUERDO A LA SIGUIENTE DISTRIBUCION: 
',10,array('justification' => 'full','spacing' =>1.5));

$data = array(
	array('MIEMBROS'=>'COORDINADOR',     'INFORME'=>'MAXIMO (25)','NOTA1'=>'','PRESENTACION'=>'MAXIMO (10)','NOTA2'=>'','NOTAJ'=>'MAXIMO (35)','NOTA3'=>''),
	array('MIEMBROS'=>'SECRETARIO',      'INFORME'=>'MAXIMO (25)','NOTA1'=>'','PRESENTACION'=>'MAXIMO (10)','NOTA2'=>'','NOTAJ'=>'MAXIMO (35)','NOTA3'=>''),
	array('MIEMBROS'=>'TUTOR ACADEMICO  ', 'INFORME'=>'MAXIMO (20)','NOTA1'=>'','PRESENTACION'=>'MAXIMO (10)', 'NOTA2'=>'','NOTAJ'=>'MAXIMO (30)','NOTA3'=>''),
);	




$cols = array('MIEMBROS'=>'<b>MIEMBROS</b>','INFORME'=>'<b>INFORME</b>','NOTA1'=>'<b>NOTA</b>','PRESENTACION'=>'<b>PRESENTACION</b>','NOTA2'=>'<b>NOTA</b>','NOTAJ'=>'<b>NOTA POR JURADO</b>','NOTA3'=>'<b>NOTA</b>');
$options= array('showLines'=>2,'showHeadings' =>1,'xPos'=>318,'shaded'=>0,
                'cols'=>array('PRESENTACION'=>array('justification'=>'left','width'=>90)));
$data1 = array(
array('DEF'=>'NOTA DEFINITIVA (MAXIMA 100 PUNTOS)','NOTA'=>''),
array('DEF'=>'NOTA DEFINITIVA (ESCALA DEL 1 AL 9)','NOTA'=>'')
);
$cols1 = array('DEF'=>'DEF','NOTA'=>'NOTA');
$options1= array('showLines'=>2,'showHeadings' =>0,'xPos'=>318,'shaded'=>0,
                 'cols'=>array('DEF'=>array('justification'=>'center','width'=>344),'NOTA'=>array('justification'=>'left','width'=>146)));
$pdf->ezTable($data,$cols,'',$options);
$pdf->ezTable($data1,$cols1,'',$options1);
$pdf->ezSetDy(-5);
$pdf->ezText('SE EMITE LA PRESENTE ACTA, QUEDANDO ASENTADA EN EL DEPARTAMENTO DE ING. '.$esp[0]["ESP"].', A LOS _________ DIAS DEL MES DE _______________ DE ____________.',10,array('justification' => 'full','spacing' =>1.15));
$pdf->ezText('OBSERVACIONES: ____________________________________________________________________________',10,array('justification' => 'full','spacing' =>1.15));
$pdf->ezText(' _____________________________________________________________________________________________',10,array('justification' => 'full','spacing' =>1.15));


$data2 = array(
	array('MIEMBROS'=>'COORDINADOR',     'NYA'=>$prof_aux[0]["NOMBRE"].' '.$prof_aux[0]["APELLIDO"],'CI'=>$prof_aux[0]["CI"],'FIRMA'=>''),
	array('MIEMBROS'=>'SECRETARIO',      'NYA'=>$prof_aux2[0]["NOMBRE"].' '.$prof_aux2[0]["APELLIDO"],'CI'=>$prof_aux2[0]["CI"],'FIRMA'=>''),
	array('MIEMBROS'=>'TUTOR ACADEMICO', 'NYA'=>$prof_aux3[0]["NOMBRE"].' '.$prof_aux3[0]["APELLIDO"],'CI'=>$prof_aux3[0]["CI"],'FIRMA'=>'')
);																			




$cols2 = array('MIEMBROS'=>'<b>MIEMBROS</b>','NYA'=>'<b>NOMBRE Y APELLIDO</b>','CI'=>'<b>C.I.</b>','FIRMA'=>'<b>FIRMA</b>');
$options2= array('showLines'=>2,'showHeadings' =>1,'xPos'=>318,'shaded'=>0,'titleFontSize' => 10,
                'cols'=>array('MIEMBROS'=>array('justification'=>'left','width'=>120),'NYA'=>array('justification'=>'left','width'=>172),
                'CI'=>array('justification'=>'center','width'=>100),'FIRMA'=>array('justification'=>'center','width'=>100)));
$pdf->ezSetDy(-5);
$pdf->ezTable($data2,$cols2,'<b>FIRMAN LOS MIEMBROS DEL JURADO</b>',$options2);
$pdf->ezText('AVALADO POR EL COORDINADOR DEL COMITE DE '.$asi[0]["TIPO"].'.',10,array('justification' => 'full','spacing' =>1.5));
$pdf->setLineStyle(1);
//$pdf->line(210,100,410,100);
$pdf->ezSetY(100);
	$sql1="select APELLIDO, NOMBRE, DEPARTAMENTO from tblaca007 where CI = '$_SESSION[coor]'";
        $conex -> ExecSQL($sql1,__LINE__,true);
	$fila = $conex->filas;
	if ($fila!=0)
	    {
	    $reg1 = $conex->result_h;
	    $reg2 = $conex->result[0];
	    $reg = array_combine($reg1,$reg2);
//$pdf->ezText($reg["NOMBRE"].' '.$reg["APELLIDO"],10,array('justification' => 'center','right'=> 0,'spacing' =>1.15));
$pdf->ezSetY(120);
//$pdf->ezText($reg["NOMBRE"].' '.$reg["APELLIDO"],10,array('justification' => 'center','right'=> 0,'spacing' =>1.15));
$pdf->ezText("NOMBRE Y APELLIDO: ".$reg["NOMBRE"].' '.$reg["APELLIDO"],10,array('justification' => 'left','right'=> 0,'spacing' =>1.15));
$pdf->ezText("CI: ".$_SESSION[coor],10,array('justification' => 'left','right'=> 0,'spacing' =>1.15));
$pdf->ezSetY(75);
$pdf->ezText("FIRMA: _________________________________",10,array('justification' => 'left','right'=> 0,'spacing' =>1.15));
	    }

		
ob_end_clean();
$pdf->eZstream();
?>