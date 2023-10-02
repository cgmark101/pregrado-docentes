<?php
session_start();
include_once('conexion.php');
include ('class.ezpdf.php');
$pdf = new Cezpdf('LETTER','portrait');
$pdf->selectFont('./fonts/Times-Roman.afm');
$pdf->ezSetCmMargins(2.5,2.5,2.5,2.5);
		$sql="select APELLIDOS, NOMBRES, EXP_E, C_UNI_CA from dace002 where CI_E = '$_SESSION[cedula]'";
		$conex -> ExecSQL($sql,__LINE__,true);
		$fila1 = $conex->filas;
		if ($fila1==1)
		{
			$reg1 = $conex->result_h;
			$reg2 = $conex->result[0];
			$reg = array_combine($reg1,$reg2);
			$reg_aux[]=$reg;

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
		}
$pdf->ezImage("unexpo.jpg",'0','90','none','left','');
$pdf->ezSetY(740);
$pdf->ezText('REPÚBLICA BOLIVARIANA DE VENEZUELA',10,array('justification' => 'center','left'=> 128,'spacing' =>1.15));
$pdf->ezText('MINISTERIO DEL PODER POPULAR PARA LA EDUCACIÓN UNIVERSITARIA',10,array('justification' => 'center','left'=> 128,'spacing' =>1.15));
$pdf->ezText('UNIVERSIDAD NACIONAL EXPERIMENTAL POLITÉCNICA',10,array('justification' => 'center','left'=> 128,'spacing' =>1.15));
$pdf->ezText('"ANTONIO JOSÉ DE SUCRE"',10,array('justification' => 'center','left'=> 128,'spacing' =>1.15));
$pdf->ezText('VICE-RECTORADO PUERTO ORDAZ',10,array('justification' => 'center','left'=> 128,'spacing' =>1.15));
$pdf->ezText('DEPARTAMENTO DE ING. '.$esp[0]["ESP"],10,array('justification' => 'center','left'=> 128,'spacing' =>1.15));
$pdf->setLineStyle(2);
$pdf->line(70,650,550,650);
$pdf->line(70,645,550,645);
$pdf->ezSetY(643);
$pdf->ezText('URB VILLA ASIA - FINAL CALLE CHINA - TLF:(0286)9623821 TELEFAX 9623881-9625245 - APARTADO POSTAL 78',8,array('justification' => 'center','left'=> 0,'spacing' =>1));
$pdf->ezSetY(600);
$pdf->ezText('<b>REQUISITOS PARA LA REALIZACIÓN DE TRABAJO DE GRADO</b>',10,array('justification' => 'center','spacing' =>1));
$pdf->ezSetDy(-30);
$pdf->ezText('<b>Para la inscripción de TG:</b>',10,array('justification' => 'left','spacing' =>1.5));
switch($reg_aux[0]['C_UNI_CA'])
        {   case 2:
            $uc[0]["UC"]="170 U.C.";
            break;
           /*case 3:
            $uc[0]["UC"]="";
            break;
            case 4:
            $uc[0]["UC"]="";
            break;*/
            case 5:
            $uc[0]["UC"]="146 U.C.";
            break;
           /*case 6:
            $uc[0]["UC"]=".";
            break;*/
        }
if ($reg_aux[0]['C_UNI_CA']==2)
{
	$pdf->ezText('1. Tener aprobadas '.$uc[0]["UC"],10,array('justification' => 'left','spacing' =>1.5));
	$pdf->ezText('2. Haber aprobado las asignaturas (322939) Práctica Profesional y (322827) Proyecto de Diseño Mecánico.',10,array('justification' => 'left','spacing' =>1.5));
}
if ($reg_aux[0]['C_UNI_CA']==3)
{
	$pdf->ezText('1. Haber aprobado la asignatura (311939) Práctica Profesional.',10,array('justification' => 'left','spacing' =>1.5));
}
if ($reg_aux[0]['C_UNI_CA']==4)
{
	$pdf->ezText('1. Haber aprobado la asignatura (333939) Práctica Profesional.',10,array('justification' => 'left','spacing' =>1.5));
}
if ($reg_aux[0]['C_UNI_CA']==5)
{
	$pdf->ezText('1. Tener aprobadas '.$uc[0]["UC"],10,array('justification' => 'left','spacing' =>1.5));
	$pdf->ezText('2. Haber aprobado la asignatura (300956) Metodología de la Investigación o tenerla inscrita en paralelo con el Trabajo de Grado.',10,array('justification' => 'left','spacing' =>1.5));
}
if ($reg_aux[0]['C_UNI_CA']==6)
{
	$pdf->ezText('1. Haber aprobado la asignatura (344939) Práctica Profesional.',10,array('justification' => 'left','spacing' =>1.5));
}
$pdf->ezSetDy(-10);
$pdf->ezText('<b>Para la entrega de Anteproyecto:</b>',10,array('justification' => 'full','spacing' =>1.5));
$pdf->ezText('Hacer entrega de lo indicado al Coordinador de Trabajo de Grado:',10,array('justification' => 'full','spacing' =>1.5));
$pdf->ezText('1. Copia impresa del Anteproyecto.',10,array('justification' => 'full','spacing' =>1.5));
$pdf->ezText('2. Carta de aceptación firmada por el tutor académico.',10,array('justification' => 'full','spacing' =>1.5));
$pdf->ezText('Luego, este contenido será sometido a evaluación por parte del Comité de Trabajo de Grado para su aprobación.',10,array('justification' => 'full','spacing' =>1.5));
$pdf->ezSetDy(-10);
$pdf->ezText('<b>Para la asignación de Jurados:</b>',10,array('justification' => 'full','spacing' =>1.5));
$pdf->ezText('Hacer entrega de lo indicado al Coordinador de Trabajo de Grado:',10,array('justification' => 'full','spacing' =>1.5));
$pdf->ezText('1. Carta de aprobación/culminación de Trabajo de Grado firmada por el tutor académico.',10,array('justification' => 'full','spacing' =>1.5));
$pdf->ezText('2. Dos (2) copias impresas y encuadernadas del informe de Trabajo de Grado.',10,array('justification' => 'full','spacing' =>1.5));
$pdf->ezText('Luego, este contenido será sometido a evaluación por parte del Comité de Trabajo de Grado para la asignación
del Jurado Coordinador y Jurado Secretario.',10,array('justification' => 'full','spacing' =>1.5));
ob_end_clean();
$pdf->eZstream();
?>