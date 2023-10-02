<?php
session_start();
include_once('conexion.php');
include ('class.ezpdf.php');
$pdf = new Cezpdf('LETTER','portrait');
$pdf->selectFont('./fonts/Times-Roman.afm');
$pdf->ezSetCmMargins(2.5,1,2.5,2.5);
	$sql="select CI_E, empresa, n_proyecto, TIPO_PASANTIA, cedula_TI, nombre_TI, apellido_TI, telefono_TI, correo_TI, fecha_i, fecha_c, id_estatus, cedula_TA, cedula_JS, cedula_JC from sol_tgpp where CI_E = '$_REQUEST[id]'and TIPO_PASANTIA='$_SESSION[TIPO_PASANTIA]'";
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
		$asi[0]["TIPO"]="PRÁCTICA PROFESIONAL";
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
	if($reg_aux[0]['C_UNI_CA']==5 && $_SESSION['TIPO_PASANTIA']==2)
	{	$cadena[0]["palabras"]=".";
	}	else
	{	$cadena[0]["palabras"]=", ".$ART[0]["ARTI"]." CUAL ESTÁ DESARROLLAD".$ART[0]["LETRA"]." BAJO LA TUTORÍA INDUSTRIAL DEL ING. ".$tablaaux[0]['apellido_TI'].", ".$tablaaux[0]['apellido_TI'].".";
	}
	$diasemana[]=array("LUNES","MARTES","MIÉRCOLES","JUEVES","VIERNES","SÁBADO","DOMINGO");
	$meses[] = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
$pdf->ezImage("unexpo.jpg",'0','90','none','left','');
$pdf->ezSetY(750);
$pdf->ezText('REPÚBLICA BOLIVARIANA DE VENEZUELA',10,array('justification' => 'center','left'=> 128,'spacing' =>1.15));
$pdf->ezText('MINISTERIO DEL PODER POPULAR PARA LA EDUCACIÓN UNIVERSITARIA',10,array('justification' => 'center','left'=> 128,'spacing' =>1.15));
$pdf->ezText('UNIVERSIDAD NACIONAL EXPERIMENTAL POLITÉCNICA',10,array('justification' => 'center','left'=> 128,'spacing' =>1.15));
$pdf->ezText('"ANTONIO JOSÉ DE SUCRE"',10,array('justification' => 'center','left'=> 128,'spacing' =>1.15));
$pdf->ezText('VICE-RECTORADO PUERTO ORDAZ',10,array('justification' => 'center','left'=> 128,'spacing' =>1.15));
$pdf->ezText('DEPARTAMENTO DE INGENIERÍA '.$esp[0]["ESP"],10,array('justification' => 'center','left'=> 128,'spacing' =>1.15));
$pdf->setLineStyle(2);
$pdf->line(55,660,575,660);
$pdf->line(55,655,575,655);
$pdf->ezSetY(655);
$pdf->ezText('URB VILLA ASIA - FINAL CALLE CHINA - TLF:(0286)9623821 TELEFAX 9623881-9625245 - APARTADO POSTAL 78',8,array('justification' => 'center','left'=> 0,'spacing' =>1));
$pdf->ezSetDy(-15);
$pdf->ezText('<b>ACTA DE EVALUACIÓN DE TRABAJO DE GRADO</b>',10,array('justification' => 'center','spacing' =>1));
$pdf->ezSetDy(-10);
$pdf->ezText('LUGAR Y FECHA:___________________________________________________________',10,array('justification' => 'full','spacing' =>1.5));
$pdf->ezText('NOMBRE DEL ESTUDIANTE: <b>'.$reg_aux[0]["APELLIDOS"].', '.$reg_aux[0]["NOMBRES"].'</b>, C.I.: '.$tablaaux[0]["CI_E"].'.',10,array('justification' => 'full','spacing' =>1.5));
$pdf->ezText('TUTOR DEL TRABAJO DE GRADO: '.$prof_aux3[0]["NOMBRE"].' '.$prof_aux3[0]["APELLIDO"],10,array('justification' => 'full','spacing' =>1.5));
$pdf->ezText('TÍTULO: '.$tablaaux[0]["n_proyecto"].'.',10,array('justification' => 'full','spacing' =>1.5));

$data = array(
array('NUM'=>'1', 'ASPECTO'=>'ORIGINALIDAD',					'MAX'=>'5', 'CALIFICACION'=>''),
array('NUM'=>'2', 'ASPECTO'=>'DEMOSTRACIÓN DE CONOCIMIENTOS',			'MAX'=>'5', 'CALIFICACION'=>''),
array('NUM'=>'3', 'ASPECTO'=>'DEMOSTRACIÓN DE DESTREZA Y CREATIVIDAD',		'MAX'=>'5', 'CALIFICACION'=>''), 
array('NUM'=>'4', 'ASPECTO'=>'CALIDAD EN LA PRESENTACIÓN DEL TRABAJO ESCRITO',	'MAX'=>'9', 'CALIFICACION'=>''), 
array('NUM'=>'5', 'ASPECTO'=>'CALIDAD DE LA DEFENSA',				'MAX'=>'10','CALIFICACION'=>'')
);
$cols = array('NUM'=>'','ASPECTO'=>'ASPECTO DE LA EVALUACIÓN','MAX'=>'MÁXIMO','CALIFICACION'=>'CALIFICACIÓN');
$options= array('rowGap' => 1,'showLines'=>2,'showHeadings' =>1,'xPos'=>318,'shaded'=>0,'titleFontSize' => 10,
'cols'=>array('MAX'=>array('justification'=>'center','width'=>49)));
$data1 = array(
array('NUM'=>'1', 'ASPECTO'=>'ORIGINALIDAD',					'MAX'=>'5', 'CALIFICACION'=>''),
array('NUM'=>'2', 'ASPECTO'=>'DEMOSTRACIÓN DE CONOCIMIENTOS',			'MAX'=>'5', 'CALIFICACION'=>''),
array('NUM'=>'3', 'ASPECTO'=>'DEMOSTRACIÓN DE DESTREZA Y CREATIVIDAD',		'MAX'=>'5', 'CALIFICACION'=>''), 
array('NUM'=>'4', 'ASPECTO'=>'CALIDAD EN LA PRESENTACIÓN DEL TRABAJO ESCRITO',	'MAX'=>'9', 'CALIFICACION'=>''), 
array('NUM'=>'5', 'ASPECTO'=>'CALIDAD DE LA DEFENSA',				'MAX'=>'9', 'CALIFICACION'=>'')
);
$pdf->ezSetDy(-10);
$pdf->ezTable($data,$cols,'JURADO PRESIDENTE',$options);
$pdf->ezSetDy(-5);
$pdf->ezTable($data1,$cols,'JURADO SECRETARIO',$options);
$pdf->ezSetDy(-5);
$pdf->ezTable($data1,$cols,'JURADO TUTOR',$options);
$data2 = array(array('ASPECTO'=>'<b>TOTAL GENERAL</b>',					'MAX'=>'', 'CALIFICACION'=>''));
$data3 = array(array('ASPECTO'=>'<b>CALIFICACIÓN DEFINITIVA (ESCALA DEL 1 AL 9)</b>',	'CALIFICACION'=>''));
$options2= array('rowGap' => 1,'showLines'=>2,'showHeadings' =>0,'xPos'=>318,'shaded'=>0,'titleFontSize' => 10,
'cols'=>array('ASPECTO'=>array('width'=>288),'MAX'=>array('justification'=>'center','width'=>49),'CALIFICACION'=>array('width'=>74)));
$options3= array('rowGap' => 1,'showLines'=>2,'showHeadings' =>0,'xPos'=>318,'shaded'=>0,'titleFontSize' => 10,
'cols'=>array('ASPECTO'=>array('width'=>337),'MAX'=>array('justification'=>'center','width'=>49),'CALIFICACION'=>array('width'=>74)));
$pdf->ezSetDy(-5);
$pdf->ezTable($data2,'','',$options2);
$pdf->ezSetDy(-5);
$pdf->ezTable($data3,'','',$options3);
$pdf->ezSetY(145);
$pdf->ezText('JURADO CALIFICADOR :',10,array('justification' => 'full','spacing' =>1.15));
$pdf->ezSetY(130);
$pdf->ezText('JURADO PRESIDENTE',10,array('justification' => 'full','spacing' =>1.15));
$pdf->ezText('NOMBRE: '.$prof_aux[0]["NOMBRE"].' '.$prof_aux[0]["APELLIDO"],10,array('justification' => 'full','spacing' =>1.15));
$pdf->ezText('C.I.: '.$prof_aux[0]["CI"],10,array('justification' => 'full','spacing' =>1.15));
$pdf->ezText('FIRMA: ________________',10,array('justification' => 'full','spacing' =>1.15));
$pdf->ezSetY(130);
$pdf->ezText('JURADO SECRETARIO',10,array('justification' => 'full','spacing' =>1.15,'left'=>160));
$pdf->ezText('NOMBRE: '.$prof_aux2[0]["NOMBRE"].' '.$prof_aux2[0]["APELLIDO"],10,array('justification' => 'full','spacing' =>1.15,'left'=>160));
$pdf->ezText('C.I.: '.$prof_aux2[0]["CI"],10,array('justification' => 'full','spacing' =>1.15,'left'=>160));
$pdf->ezText('FIRMA: ________________',10,array('justification' => 'full','spacing' =>1.15,'left'=>160));
$pdf->ezSetY(130);
$pdf->ezText('TUTOR',10,array('justification' => 'full','spacing' =>1.15,'left'=>330));
$pdf->ezText('NOMBRE: '.$prof_aux3[0]["NOMBRE"].' '.$prof_aux3[0]["APELLIDO"],10,array('justification' => 'left','spacing' =>1.15,'left'=>330));
$pdf->ezText('C.I.: '.$prof_aux3[0]["CI"],10,array('justification' => 'left','spacing' =>1.15,'left'=>330));
$pdf->ezText('FIRMA: ________________',10,array('justification' => 'left','spacing' =>1.15,'left'=>330));
ob_end_clean();
$pdf->eZstream();
?>