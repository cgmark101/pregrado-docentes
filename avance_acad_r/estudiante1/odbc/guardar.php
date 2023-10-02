<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="StyleSheet" href="estilos.css" type="text/css"> 
<?php
require_once('config.php');//este tambien esta agregado en cada funcion
require_once("odbcss_c.php");

$codigos=$_POST['codigos'];

$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);

function guardar_cantidad_evaluaciones($cantidad,$nacta,$nlapso,$nc_asigna) {
global $conex;
$fecha = date("m/d/y"); 
//require_once("inc/odbcss_c.php");
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "INSERT INTO D_TEMAS (ACTA,LAPSO,C_ASIGNA,CANT_EVA,FECHADC,UECA,CECA) VALUES ('$nacta','$nlapso','$nc_asigna','$cantidad','$fecha','0','0')";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
return $result[0][0];
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



function comprov($nacta,$nlapso,$nc_asigna) {
global $conex;
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select a.ucca,b.cant_eva from D_TEMAS b,N_ESTU a where a.acta='$nacta' and a.lapso='$nlapso' and a.C_ASIGNA='$nc_asigna' and b.acta='$nacta' and b.lapso='$nlapso' and b.C_ASIGNA='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
if($result[0][0]<$result[0][1]) return 0;
else return 1;
}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function guardar_temas_introducidos($cantidad,$nacta,$nlapso,$nc_asigna,$ntema,$nporc,$ueca,$ceca) {
$fecha = date("m/d/y"); 
global $conex;
//require_once("inc/odbcss_c.php");
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select cant_eva from D_TEMAS where acta='$nacta' and lapso='$nlapso' and c_asigna='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
if($result[0][0]!=NULL)
{
$mSQL  = "UPDATE D_TEMAS SET FECHADC='$fecha',TEMA1='$ntema[1]',TEMA2='$ntema[2]',TEMA3='$ntema[3]',TEMA4='$ntema[4]',TEMA5='$ntema[5]',TEMA6='$ntema[6]',TEMA7='$ntema[7]',TEMA8='$ntema[8]',TEMA9='$ntema[9]',TEMA10='$ntema[10]',TEMA11='$ntema[11]',TEMA12='$ntema[12]',TEMA13='$ntema[13]',TEMA14='$ntema[14]',TEMA15='$ntema[15]',TEMA16='$ntema[16]',TEMA17='$ntema[17]',TEMA18='$ntema[18]',TEMA19='$ntema[19]',TEMA20='$ntema[20]',TEMA21='$ntema[21]',TEMA22='$ntema[22]',TEMA23='$ntema[23]',TEMA24='$ntema[24]',TEMA25='$ntema[25]',TEMA26='$ntema[26]',TEMA27='$ntema[27]',TEMA28='$ntema[28]',TEMA29='$ntema[29]',TEMA30='$ntema[30]',TEMA31='$ntema[31]',TEMA32='$ntema[32]',TEMA33='$ntema[33]',TEMA34='$ntema[34]',TEMA35='$ntema[35]',PORC1='$nporc[1]',PORC2='$nporc[2]',PORC3='$nporc[3]',PORC4='$nporc[4]',PORC5='$nporc[5]',PORC6='$nporc[6]',PORC7='$nporc[7]',PORC8='$nporc[8]',PORC9='$nporc[9]',PORC10='$nporc[10]',PORC11='$nporc[11]',PORC12='$nporc[12]',PORC13='$nporc[13]',PORC14='$nporc[14]',PORC15='$nporc[15]',PORC16='$nporc[16]',PORC17='$nporc[17]',PORC18='$nporc[18]',PORC19='$nporc[19]',PORC20='$nporc[20]',PORC21='$nporc[21]',PORC22='$nporc[22]',PORC23='$nporc[23]',PORC24='$nporc[24]',PORC25='$nporc[25]',PORC26='$nporc[26]',PORC27='$nporc[27]',PORC28='$nporc[28]',PORC29='$nporc[29]',PORC30='$nporc[30]',PORC31='$nporc[31]',PORC32='$nporc[32]',PORC33='$nporc[33]',PORC34='$nporc[34]',PORC35='$nporc[35]',UECA='$ueca',CECA='$ceca',CANT_EVA='$cantidad' where ACTA='$nacta' and LAPSO='$nlapso' and C_ASIGNA='$nc_asigna'";
}
else
{
$mSQL  = "INSERT INTO D_TEMAS (ACTA,LAPSO,C_ASIGNA,CANT_EVA,FECHADC,TEMA1,TEMA2,TEMA3,TEMA4,TEMA5,TEMA6,TEMA7,TEMA8,TEMA9,TEMA10,TEMA11,TEMA12,TEMA13,TEMA14,TEMA15,TEMA16,TEMA17,TEMA18,TEMA19,TEMA20,TEMA21,TEMA22,TEMA23,TEMA24,TEMA25,TEMA26,TEMA27,TEMA28,TEMA29,TEMA30,TEMA31,TEMA32,TEMA33,TEMA34,TEMA35,PORC1,PORC2,PORC3,PORC4,PORC5,PORC6,PORC7,PORC8,PORC9,PORC10,PORC11,PORC12,PORC13,PORC14,PORC15,PORC16,PORC17,PORC18,PORC19,PORC20,PORC21,PORC22,PORC23,PORC24,PORC25,PORC26,PORC27,PORC28,PORC29,PORC30,PORC31,PORC32,PORC33,PORC34,PORC35,UECA,CECA) VALUES ('$nacta','$nlapso','$nc_asigna','$cantidad','$fecha','$ntema[1]','$ntema[2]','$ntema[3]','$ntema[4]','$ntema[5]','$ntema[6]','$ntema[7]','$ntema[8]','$ntema[9]','$ntema[10]','$ntema[11]','$ntema[12]','$ntema[13]','$ntema[14]','$ntema[15]','$ntema[16]','$ntema[17]','$ntema[18]','$ntema[19]','$ntema[20]','$ntema[21]','$ntema[22]','$ntema[23]','$ntema[24]','$ntema[25]','$ntema[26]','$ntema[27]','$ntema[28]','$ntema[29]','$ntema[30]','$ntema[31]','$ntema[32]','$ntema[33]','$ntema[34]','$ntema[35]','$nporc[1]','$nporc[2]','$nporc[3]','$nporc[4]','$nporc[5]','$nporc[6]','$nporc[7]','$nporc[8]','$nporc[9]','$nporc[10]','$nporc[11]','$nporc[12]','$nporc[13]','$nporc[14]','$nporc[15]','$nporc[16]','$nporc[17]','$nporc[18]','$nporc[19]','$nporc[20]','$nporc[21]','$nporc[22]','$nporc[23]','$nporc[24]','$nporc[25]','$nporc[26]','$nporc[27]','$nporc[28]','$nporc[29]','$nporc[30]','$nporc[31]','$nporc[32]','$nporc[33]','$nporc[34]','$nporc[35]','$ueca','$ceca')";
}
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
return $result[0][0];
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function guardar_temas($cantidad,$nacta,$nlapso,$nc_asigna,$ntema,$nporc,$ueca,$ceca) {
$fecha = date("m/d/y");
global $conex; 
//require_once("inc/odbcss_c.php");
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select cant_eva from D_TEMAS where acta='$nacta' and lapso='$nlapso' and c_asigna='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
if($result[0][0]!=NULL)
{
$mSQL  = "UPDATE D_TEMAS SET FECHADC='$fecha',TEMA1='$ntema[1]',TEMA2='$ntema[2]',TEMA3='$ntema[3]',TEMA4='$ntema[4]',TEMA5='$ntema[5]',TEMA6='$ntema[6]',TEMA7='$ntema[7]',TEMA8='$ntema[8]',TEMA9='$ntema[9]',TEMA10='$ntema[10]',TEMA11='$ntema[11]',TEMA12='$ntema[12]',TEMA13='$ntema[13]',TEMA14='$ntema[14]',TEMA15='$ntema[15]',TEMA16='$ntema[16]',TEMA17='$ntema[17]',TEMA18='$ntema[18]',TEMA19='$ntema[19]',TEMA20='$ntema[20]',TEMA21='$ntema[21]',TEMA22='$ntema[22]',TEMA23='$ntema[23]',TEMA24='$ntema[24]',TEMA25='$ntema[25]',TEMA26='$ntema[26]',TEMA27='$ntema[27]',TEMA28='$ntema[28]',TEMA29='$ntema[29]',TEMA30='$ntema[30]',TEMA31='$ntema[31]',TEMA32='$ntema[32]',TEMA33='$ntema[33]',TEMA34='$ntema[34]',TEMA35='$ntema[35]',PORC1='$nporc[1]',PORC2='$nporc[2]',PORC3='$nporc[3]',PORC4='$nporc[4]',PORC5='$nporc[5]',PORC6='$nporc[6]',PORC7='$nporc[7]',PORC8='$nporc[8]',PORC9='$nporc[9]',PORC10='$nporc[10]',PORC11='$nporc[11]',PORC12='$nporc[12]',PORC13='$nporc[13]',PORC14='$nporc[14]',PORC15='$nporc[15]',PORC16='$nporc[16]',PORC17='$nporc[17]',PORC18='$nporc[18]',PORC19='$nporc[19]',PORC20='$nporc[20]',PORC21='$nporc[21]',PORC22='$nporc[22]',PORC23='$nporc[23]',PORC24='$nporc[24]',PORC25='$nporc[25]',PORC26='$nporc[26]',PORC27='$nporc[27]',PORC28='$nporc[28]',PORC29='$nporc[29]',PORC30='$nporc[30]',PORC31='$nporc[31]',PORC32='$nporc[32]',PORC33='$nporc[33]',PORC34='$nporc[34]',PORC35='$nporc[35]',UECA='$ueca',CECA='$ceca',CANT_EVA='$cantidad' where ACTA='$nacta' and LAPSO='$nlapso' and C_ASIGNA='$nc_asigna'";
}
else
{
$mSQL  = "INSERT INTO D_TEMAS (ACTA,LAPSO,C_ASIGNA,CANT_EVA,FECHADC,TEMA1,TEMA2,TEMA3,TEMA4,TEMA5,TEMA6,TEMA7,TEMA8,TEMA9,TEMA10,TEMA11,TEMA12,TEMA13,TEMA14,TEMA15,TEMA16,TEMA17,TEMA18,TEMA19,TEMA20,TEMA21,TEMA22,TEMA23,TEMA24,TEMA25,TEMA26,TEMA27,TEMA28,TEMA29,TEMA30,TEMA31,TEMA32,TEMA33,TEMA34,TEMA35,PORC1,PORC2,PORC3,PORC4,PORC5,PORC6,PORC7,PORC8,PORC9,PORC10,PORC11,PORC12,PORC13,PORC14,PORC15,PORC16,PORC17,PORC18,PORC19,PORC20,PORC21,PORC22,PORC23,PORC24,PORC25,PORC26,PORC27,PORC28,PORC29,PORC30,PORC31,PORC32,PORC33,PORC34,PORC35,UECA,CECA) VALUES ('$nacta','$nlapso','$nc_asigna','$cantidad','$fecha','$ntema[1]','$ntema[2]','$ntema[3]','$ntema[4]','$ntema[5]','$ntema[6]','$ntema[7]','$ntema[8]','$ntema[9]','$ntema[10]','$ntema[11]','$ntema[12]','$ntema[13]','$ntema[14]','$ntema[15]','$ntema[16]','$ntema[17]','$ntema[18]','$ntema[19]','$ntema[20]','$ntema[21]','$ntema[22]','$ntema[23]','$ntema[24]','$ntema[25]','$ntema[26]','$ntema[27]','$ntema[28]','$ntema[29]','$ntema[30]','$ntema[31]','$ntema[32]','$ntema[33]','$ntema[34]','$ntema[35]','$nporc[1]','$nporc[2]','$nporc[3]','$nporc[4]','$nporc[5]','$nporc[6]','$nporc[7]','$nporc[8]','$nporc[9]','$nporc[10]','$nporc[11]','$nporc[12]','$nporc[13]','$nporc[14]','$nporc[15]','$nporc[16]','$nporc[17]','$nporc[18]','$nporc[19]','$nporc[20]','$nporc[21]','$nporc[22]','$nporc[23]','$nporc[24]','$nporc[25]','$nporc[26]','$nporc[27]','$nporc[28]','$nporc[29]','$nporc[30]','$nporc[31]','$nporc[32]','$nporc[33]','$nporc[34]','$nporc[35]','$ueca','$ceca')";
}
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
return $result[0][0];
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function guardar_calificaciones_agregadas($nacta,$nlapso,$nc_asigna,$alu,$nnota,$cantialu,$ccca,$ucca,$nporc) {
$fecha=date("m/d/y");
$fechas= array();
global $conex;
//require_once("inc/odbcss_c.php");
$exp_e = array();
for($i=0;$i<$cantialu;$i++)
	{
	$exp_e[$i]=$alu[$i][0];
	for($j=1;$j<=$ccca;$j++) $nnota[36][$i]=$nnota[36][$i]+$nnota[$j][$i];
	$nnota[37][$i]=conva9(round($nnota[36][$i]));
	}

	$naapro=array();	
	$narepro=array();	
	$naasis=array();
	$nainais=array();
	
for($j=1;$j<=$ccca;$j++){
$setpoint=$nporc[$j]/2;
for($i=0;$i<$cantialu;$i++)
	{
	if($nnota[$j][$i]>=$setpoint) $naapro[$j]++;		
	if($nnota[$j][$i]<$setpoint) $narepro[$j]++;
	if($nnota[$j][$i]>1) $naasis[$j]++;
	if($nnota[$j][$i]<=1) $nainais[$j]++;
	
	}
}	

for($j=1;$j<=$ccca;$j++){

	$porap[$j]= round((($naapro[$j]*100)/$cantialu)*100)/100;
	$porre[$j]=	round((($narepro[$j]*100)/$cantialu)*100)/100;
	$poras[$j]=	round((($naasis[$j]*100)/$cantialu)*100)/100;
	$porin[$j]=	round((($nainais[$j]*100)/$cantialu)*100)/100;
}
	
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "UPDATE D_TEMAS SET POR_ASIS1='$poras[1]',POR_ASIS2='$poras[2]',POR_ASIS3='$poras[3]',POR_ASIS4='$poras[4]',POR_ASIS5='$poras[5]',POR_ASIS6='$poras[6]',POR_ASIS7='$poras[7]',POR_ASIS8='$poras[8]',POR_ASIS9='$poras[9]',POR_ASIS10='$poras[10]',POR_ASIS11='$poras[11]',POR_ASIS12='$poras[12]',POR_ASIS13='$poras[13]',POR_ASIS14='$poras[14]',POR_ASIS15='$poras[15]',POR_ASIS16='$poras[16]',POR_ASIS17='$poras[17]',POR_ASIS18='$poras[18]',POR_ASIS19='$poras[19]',POR_ASIS20='$poras[20]',POR_ASIS21='$poras[21]',POR_ASIS22='$poras[22]',POR_ASIS23='$poras[23]',POR_ASIS24='$poras[24]',POR_ASIS25='$poras[25]',POR_ASIS26='$poras[26]',POR_ASIS27='$poras[27]',POR_ASIS28='$poras[28]',POR_ASIS29='$poras[29]',POR_ASIS30='$poras[30]',POR_ASIS31='$poras[31]',POR_ASIS32='$poras[32]',POR_ASIS33='$poras[33]',POR_ASIS34='$poras[34]',POR_ASIS35='$poras[35]',POR_IASIS1='$porin[1]',POR_IASIS2='$porin[2]',POR_IASIS3='$porin[3]',POR_IASIS4='$porin[4]',POR_IASIS5='$porin[5]',POR_IASIS6='$porin[6]',POR_IASIS7='$porin[7]',POR_IASIS8='$porin[8]',POR_IASIS9='$porin[9]',POR_IASIS10='$porin[10]',POR_IASIS11='$porin[11]',POR_IASIS12='$porin[12]',POR_IASIS13='$porin[13]',POR_IASIS14='$porin[14]',POR_IASIS15='$porin[15]',POR_IASIS16='$porin[16]',POR_IASIS17='$porin[17]',POR_IASIS18='$porin[18]',POR_IASIS19='$porin[19]',POR_IASIS20='$porin[20]',POR_IASIS21='$porin[21]',POR_IASIS22='$porin[22]',POR_IASIS23='$porin[23]',POR_IASIS24='$porin[24]',POR_IASIS25='$porin[25]',POR_IASIS26='$porin[26]',POR_IASIS27='$porin[27]',POR_IASIS28='$porin[28]',POR_IASIS29='$porin[29]',POR_IASIS30='$porin[30]',POR_IASIS31='$porin[31]',POR_IASIS32='$porin[32]',POR_IASIS33='$porin[33]',POR_IASIS34='$porin[34]',POR_IASIS35='$porin[35]',POR_APRO1='$porap[1]',POR_APRO2='$porap[2]',POR_APRO3='$porap[3]',POR_APRO4='$porap[4]',POR_APRO5='$porap[5]',POR_APRO6='$porap[6]',POR_APRO7='$porap[7]',POR_APRO8='$porap[8]',POR_APRO9='$porap[9]',POR_APRO10='$porap[10]',POR_APRO11='$porap[11]',POR_APRO12='$porap[12]',POR_APRO13='$porap[13]',POR_APRO14='$porap[14]',POR_APRO15='$porap[15]',POR_APRO16='$porap[16]',POR_APRO17='$porap[17]',POR_APRO18='$porap[18]',POR_APRO19='$porap[19]',POR_APRO20='$porap[20]',POR_APRO21='$porap[21]',POR_APRO22='$porap[22]',POR_APRO23='$porap[23]',POR_APRO24='$porap[24]',POR_APRO25='$porap[25]',POR_APRO26='$porap[26]',POR_APRO27='$porap[27]',POR_APRO28='$porap[28]',POR_APRO29='$porap[29]',POR_APRO30='$porap[30]',POR_APRO31='$porap[31]',POR_APRO32='$porap[32]',POR_APRO33='$porap[33]',POR_APRO34='$porap[34]',POR_APRO35='$porap[35]',POR_RPRO1='$porre[1]',POR_RPRO2='$porre[2]',POR_RPRO3='$porre[3]',POR_RPRO4='$porre[4]',POR_RPRO5='$porre[5]',POR_RPRO6='$porre[6]',POR_RPRO7='$porre[7]',POR_RPRO8='$porre[8]',POR_RPRO9='$porre[9]',POR_RPRO10='$porre[10]',POR_RPRO11='$porre[11]',POR_RPRO12='$porre[12]',POR_RPRO13='$porre[13]',POR_RPRO14='$porre[14]',POR_RPRO15='$porre[15]',POR_RPRO16='$porre[16]',POR_RPRO17='$porre[17]',POR_RPRO18='$porre[18]',POR_RPRO19='$porre[19]',POR_RPRO20='$porre[20]',POR_RPRO21='$porre[21]',POR_RPRO22='$porre[22]',POR_RPRO23='$porre[23]',POR_RPRO24='$porre[24]',POR_RPRO25='$porre[25]',POR_RPRO26='$porre[26]',POR_RPRO27='$porre[27]',POR_RPRO28='$porre[28]',POR_RPRO29='$porre[29]',POR_RPRO30='$porre[30]',POR_RPRO31='$porre[31]',POR_RPRO32='$porre[32]',POR_RPRO33='$porre[33]',POR_RPRO34='$porre[34]',POR_RPRO35='$porre[35]' where ACTA='$nacta' and LAPSO='$nlapso' and C_ASIGNA='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$mSQL  = "select FECHA_1,FECHA_2,FECHA_3,FECHA_4,FECHA_5,FECHA_6,FECHA_7,FECHA_8,FECHA_9,FECHA_10,FECHA_11,FECHA_12,FECHA_13,FECHA_14,FECHA_15,FECHA_16,FECHA_17,FECHA_18,FECHA_19,FECHA_20,FECHA_21,FECHA_22,FECHA_23,FECHA_24,FECHA_25,FECHA_26,FECHA_27,FECHA_28,FECHA_29,FECHA_30,FECHA_31,FECHA_32,FECHA_33,FECHA_34,FECHA_35 from FECHAS_AV where acta='$nacta' and lapso='$nlapso' and c_asigna='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
$counter=0;
$counterr=1;
while($result[0][$counter]!=NULL)
							{
							$fechas[$counterr]=$result[0][$counter];
							$counter++;
							$counterr++;
							}
echo $ucca;							
for($j=$counterr;$j<=$ucca;$j++) $fechas[$j]=$fecha;
if($result[0][0]!=NULL)
{
$mSQL  = "UPDATE FECHAS_AV SET FECHA_1='".$fechas[1]."',FECHA_2='".$fechas[2]."',FECHA_3='".$fechas[3]."',FECHA_4='".$fechas[4]."',FECHA_5='".$fechas[5]."',FECHA_6='".$fechas[6]."',FECHA_7='".$fechas[7]."',FECHA_8='".$fechas[8]."',FECHA_9='".$fechas[9]."',FECHA_10='".$fechas[10]."',FECHA_11='".$fechas[11]."',FECHA_12='".$fechas[12]."',FECHA_13='".$fechas[13]."',FECHA_14='".$fechas[14]."',FECHA_15='".$fechas[15]."',FECHA_16='".$fechas[16]."',FECHA_17='".$fechas[17]."',FECHA_18='".$fechas[18]."',FECHA_19='".$fechas[19]."',FECHA_20='".$fechas[20]."',FECHA_21='".$fechas[21]."',FECHA_22='".$fechas[22]."',FECHA_23='".$fechas[23]."',FECHA_24='".$fechas[24]."',FECHA_25='".$fechas[25]."',FECHA_26='".$fechas[26]."',FECHA_27='".$fechas[27]."',FECHA_28='".$fechas[28]."',FECHA_29='".$fechas[29]."',FECHA_30='".$fechas[30]."',FECHA_31='".$fechas[31]."',FECHA_32='".$fechas[32]."',FECHA_33='".$fechas[33]."',FECHA_34='".$fechas[34]."',FECHA_35='".$fechas[35]."' where ACTA='$nacta' and LAPSO='$nlapso' and C_ASIGNA='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
}
else{
$mSQL  = "INSERT INTO FECHAS_AV (ACTA,LAPSO,C_ASIGNA,FECHA_1,FECHA_2,FECHA_3,FECHA_4,FECHA_5,FECHA_6,FECHA_7,FECHA_8,FECHA_9,FECHA_10,FECHA_11,FECHA_12,FECHA_13,FECHA_14,FECHA_15,FECHA_16,FECHA_17,FECHA_18,FECHA_19,FECHA_20,FECHA_21,FECHA_22,FECHA_23,FECHA_24,FECHA_25,FECHA_26,FECHA_27,FECHA_28,FECHA_29,FECHA_30,FECHA_31,FECHA_32,FECHA_33,FECHA_34,FECHA_35) VALUES ('$nacta','$nlapso','$nc_asigna','".$fechas[1]."','".$fechas[2]."','".$fechas[3]."','".$fechas[4]."','".$fechas[5]."','".$fechas[6]."','".$fechas[7]."','".$fechas[8]."','".$fechas[9]."','".$fechas[10]."','".$fechas[11]."','".$fechas[12]."','".$fechas[13]."','".$fechas[14]."','".$fechas[15]."','".$fechas[16]."','".$fechas[17]."','".$fechas[18]."','".$fechas[19]."','".$fechas[20]."','".$fechas[21]."','".$fechas[22]."','".$fechas[23]."','".$fechas[24]."','".$fechas[25]."','".$fechas[26]."','".$fechas[27]."','".$fechas[28]."','".$fechas[29]."','".$fechas[30]."','".$fechas[31]."','".$fechas[32]."','".$fechas[33]."','".$fechas[34]."','".$fechas[35]."')";
$conex->ExecSQL($mSQL,__LINE__,true);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
//$conex = new ODBC_Conn("dace9","jose","nacho",TRUE,"avance_academico.log");
$mSQL  = "select EXP_E from N_ESTU where acta='$nacta' and lapso='$nlapso' and c_asigna='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
if($result[0][0]!=NULL)
{
for($k=0;$k<$cantialu;$k++)
{
$mSQL  = "UPDATE N_ESTU SET UCCA='$ucca',CCCA='$ccca',NOTA1='".$nnota[1][$k]."',NOTA2='".$nnota[2][$k]."',NOTA3='".$nnota[3][$k]."',NOTA4='".$nnota[4][$k]."',NOTA5='".$nnota[5][$k]."',NOTA6='".$nnota[6][$k]."',NOTA7='".$nnota[7][$k]."',NOTA8='".$nnota[8][$k]."',NOTA9='".$nnota[9][$k]."',NOTA10='".$nnota[10][$k]."',NOTA11='".$nnota[11][$k]."',NOTA12='".$nnota[12][$k]."',NOTA13='".$nnota[13][$k]."',NOTA14='".$nnota[14][$k]."',NOTA15='".$nnota[15][$k]."',NOTA16='".$nnota[16][$k]."',NOTA17='".$nnota[17][$k]."',NOTA18='".$nnota[18][$k]."',NOTA19='".$nnota[19][$k]."',NOTA20='".$nnota[20][$k]."',NOTA21='".$nnota[21][$k]."',NOTA22='".$nnota[22][$k]."',NOTA23='".$nnota[23][$k]."',NOTA24='".$nnota[24][$k]."',NOTA25='".$nnota[25][$k]."',NOTA26='".$nnota[26][$k]."',NOTA27='".$nnota[27][$k]."',NOTA28='".$nnota[28][$k]."',NOTA29='".$nnota[29][$k]."',NOTA30='".$nnota[30][$k]."',NOTA31='".$nnota[31][$k]."',NOTA32='".$nnota[32][$k]."',NOTA33='".$nnota[33][$k]."',NOTA34='".$nnota[34][$k]."',NOTA35='".$nnota[35][$k]."',TOTAL100='".$nnota[36][$k]."',TOTAL9='".$nnota[37][$k]."',STATUS='".$alu[$k][2]."' where ACTA='$nacta' and LAPSO='$nlapso' and C_ASIGNA='$nc_asigna' and EXP_E='$exp_e[$k]'";
$conex->ExecSQL($mSQL,__LINE__,true);
}
}
else
{
for($k=0;$k<$cantialu;$k++)
{
$mSQL  = "INSERT INTO N_ESTU (ACTA,LAPSO,C_ASIGNA,EXP_E,NOTA1,NOTA2,NOTA3,NOTA4,NOTA5,NOTA6,NOTA7,NOTA8,NOTA9,NOTA10,NOTA11,NOTA12,NOTA13,NOTA14,NOTA15,NOTA16,NOTA17,NOTA18,NOTA19,NOTA20,NOTA21,NOTA22,NOTA23,NOTA24,NOTA25,NOTA26,NOTA27,NOTA28,NOTA29,NOTA30,NOTA31,NOTA32,NOTA33,NOTA34,NOTA35,TOTAL100,TOTAL9,CCCA,UCCA,FECHA1,FECHA2,FECHA3,FECHA4,FECHA5,FECHA6,FECHA7,FECHA8,FECHA9,FECHA10,FECHA11,FECHA12,FECHA13,FECHA14,FECHA15,FECHA16,FECHA17,FECHA18,FECHA19,FECHA20,FECHA21,FECHA22,FECHA23,FECHA24,FECHA25,FECHA26,FECHA27,FECHA28,FECHA29,FECHA30,FECHA31,FECHA32,FECHA33,FECHA34,FECHA35) VALUES ('$nacta','$nlapso','$nc_asigna','$exp_e[$k]','".$nnota[1][$k]."','".$nnota[2][$k]."','".$nnota[3][$k]."','".$nnota[4][$k]."','".$nnota[5][$k]."','".$nnota[6][$k]."','".$nnota[7][$k]."','".$nnota[8][$k]."','".$nnota[9][$k]."','".$nnota[10][$k]."','".$nnota[11][$k]."','".$nnota[12][$k]."','".$nnota[13][$k]."','".$nnota[14][$k]."','".$nnota[15][$k]."','".$nnota[16][$k]."','".$nnota[17][$k]."','".$nnota[18][$k]."','".$nnota[19][$k]."','".$nnota[20][$k]."','".$nnota[21][$k]."','".$nnota[22][$k]."','".$nnota[23][$k]."','".$nnota[24][$k]."','".$nnota[25][$k]."','".$nnota[26][$k]."','".$nnota[27][$k]."','".$nnota[28][$k]."','".$nnota[29][$k]."','".$nnota[30][$k]."','".$nnota[31][$k]."','".$nnota[32][$k]."','".$nnota[33][$k]."','".$nnota[34][$k]."','".$nnota[35][$k]."','".$nnota[36][$k]."','".$nnota[37][$k]."','$ccca','$ucca')";
$conex->ExecSQL($mSQL,__LINE__,true);
}
}
$result = $conex->result;
return $result[0][0];
/*$conex = new ODBC_Conn("dace9","jose","nacho",TRUE,"avance_academico.log");
$mSQL  = "select FECHA1,FECHA2,FECHA3,FECHA4,FECHA5,FECHA6,FECHA7,FECHA8,FECHA9,FECHA10,FECHA11,FECHA12,FECHA13,FECHA14,FECHA15,FECHA16,FECHA17,FECHA18,FECHA19,FECHA20,FECHA21,FECHA22,FECHA23,FECHA24,FECHA25,FECHA26,FECHA27,FECHA28,FECHA29,FECHA30,FECHA31,FECHA32,FECHA33,FECHA34,FECHA35 from N_ESTU where acta='$nacta' and lapso='$nlapso' and c_asigna='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
$resulter = $conex->result;
$cant=0;
$c=1;
while($resulter[0][$cant]!=NULL)
{
	$fechas[$c]=$resulter[0][$cant];
	$cant++;
	$c++;
}

for($i=$c;$i<=$ccca;$i++)	$fechas[$i]= $fecha;*/
}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function guardar_calificaciones($nacta,$nlapso,$nc_asigna,$alu,$nnota,$cantialu,$ccca,$ucca,$nporc) {
//require_once("inc/odbcss_c.php");
global $conex;
/*$conex = new ODBC_Conn("dace9","jose","nacho",TRUE,"avance_academico.log");
$mSQL  = "select FECHA1,FECHA2,FECHA3,FECHA4,FECHA5,FECHA6,FECHA7,FECHA8,FECHA9,FECHA10,FECHA11,FECHA12,FECHA13,FECHA14,FECHA15,FECHA16,FECHA17,FECHA18,FECHA19,FECHA20,FECHA21,FECHA22,FECHA23,FECHA24,FECHA25,FECHA26,FECHA27,FECHA28,FECHA29,FECHA30,FECHA31,FECHA32,FECHA33,FECHA34,FECHA35 from N_ESTU where acta='$nacta' and lapso='$nlapso' and c_asigna='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
$resulter = $conex->result;
$cant=0;
$c=1;
while($resulter[0][$cant]!=NULL)
{
	$fechas[$c]=$resulter[0][$cant];
	$cant++;
	$c++;
}
$fecha=date("m/d/y");
for($i=$c;$i<=$ccca;$i++)	$fechas[$i]= $fecha;*/
	$naapro=array();	
	$narepro=array();	
	$naasis=array();
	$nainais=array();
	
for($j=1;$j<=$ccca;$j++){
$setpoint=$nporc[$j]/2;
for($i=0;$i<$cantialu;$i++)
	{
	if($nnota[$j][$i]>=$setpoint) $naapro[$j]++;		
	if($nnota[$j][$i]<$setpoint) $narepro[$j]++;
	if($nnota[$j][$i]>1) $naasis[$j]++;
	if($nnota[$j][$i]<=1) $nainais[$j]++;
	
	}
}	
	
for($j=1;$j<=$ccca;$j++){

	$porap[$j]= round((($naapro[$j]*100)/$cantialu)*100)/100;
	$porre[$j]=	round((($narepro[$j]*100)/$cantialu)*100)/100;
	$poras[$j]=	round((($naasis[$j]*100)/$cantialu)*100)/100;
	$porin[$j]=	round((($nainais[$j]*100)/$cantialu)*100)/100;
}	

$mSQL  = "UPDATE D_TEMAS SET POR_ASIS1='$poras[1]',POR_ASIS2='$poras[2]',POR_ASIS3='$poras[3]',POR_ASIS4='$poras[4]',POR_ASIS5='$poras[5]',POR_ASIS6='$poras[6]',POR_ASIS7='$poras[7]',POR_ASIS8='$poras[8]',POR_ASIS9='$poras[9]',POR_ASIS10='$poras[10]',POR_ASIS11='$poras[11]',POR_ASIS12='$poras[12]',POR_ASIS13='$poras[13]',POR_ASIS14='$poras[14]',POR_ASIS15='$poras[15]',POR_ASIS16='$poras[16]',POR_ASIS17='$poras[17]',POR_ASIS18='$poras[18]',POR_ASIS19='$poras[19]',POR_ASIS20='$poras[20]',POR_ASIS21='$poras[21]',POR_ASIS22='$poras[22]',POR_ASIS23='$poras[23]',POR_ASIS24='$poras[24]',POR_ASIS25='$poras[25]',POR_ASIS26='$poras[26]',POR_ASIS27='$poras[27]',POR_ASIS28='$poras[28]',POR_ASIS29='$poras[29]',POR_ASIS30='$poras[30]',POR_ASIS31='$poras[31]',POR_ASIS32='$poras[32]',POR_ASIS33='$poras[33]',POR_ASIS34='$poras[34]',POR_ASIS35='$poras[35]',POR_IASIS1='$porin[1]',POR_IASIS2='$porin[2]',POR_IASIS3='$porin[3]',POR_IASIS4='$porin[4]',POR_IASIS5='$porin[5]',POR_IASIS6='$porin[6]',POR_IASIS7='$porin[7]',POR_IASIS8='$porin[8]',POR_IASIS9='$porin[9]',POR_IASIS10='$porin[10]',POR_IASIS11='$porin[11]',POR_IASIS12='$porin[12]',POR_IASIS13='$porin[13]',POR_IASIS14='$porin[14]',POR_IASIS15='$porin[15]',POR_IASIS16='$porin[16]',POR_IASIS17='$porin[17]',POR_IASIS18='$porin[18]',POR_IASIS19='$porin[19]',POR_IASIS20='$porin[20]',POR_IASIS21='$porin[21]',POR_IASIS22='$porin[22]',POR_IASIS23='$porin[23]',POR_IASIS24='$porin[24]',POR_IASIS25='$porin[25]',POR_IASIS26='$porin[26]',POR_IASIS27='$porin[27]',POR_IASIS28='$porin[28]',POR_IASIS29='$porin[29]',POR_IASIS30='$porin[30]',POR_IASIS31='$porin[31]',POR_IASIS32='$porin[32]',POR_IASIS33='$porin[33]',POR_IASIS34='$porin[34]',POR_IASIS35='$porin[35]',POR_APRO1='$porap[1]',POR_APRO2='$porap[2]',POR_APRO3='$porap[3]',POR_APRO4='$porap[4]',POR_APRO5='$porap[5]',POR_APRO6='$porap[6]',POR_APRO7='$porap[7]',POR_APRO8='$porap[8]',POR_APRO9='$porap[9]',POR_APRO10='$porap[10]',POR_APRO11='$porap[11]',POR_APRO12='$porap[12]',POR_APRO13='$porap[13]',POR_APRO14='$porap[14]',POR_APRO15='$porap[15]',POR_APRO16='$porap[16]',POR_APRO17='$porap[17]',POR_APRO18='$porap[18]',POR_APRO19='$porap[19]',POR_APRO20='$porap[20]',POR_APRO21='$porap[21]',POR_APRO22='$porap[22]',POR_APRO23='$porap[23]',POR_APRO24='$porap[24]',POR_APRO25='$porap[25]',POR_APRO26='$porap[26]',POR_APRO27='$porap[27]',POR_APRO28='$porap[28]',POR_APRO29='$porap[29]',POR_APRO30='$porap[30]',POR_APRO31='$porap[31]',POR_APRO32='$porap[32]',POR_APRO33='$porap[33]',POR_APRO34='$porap[34]',POR_APRO35='$porap[35]',POR_RPRO1='$porre[1]',POR_RPRO2='$porre[2]',POR_RPRO3='$porre[3]',POR_RPRO4='$porre[4]',POR_RPRO5='$porre[5]',POR_RPRO6='$porre[6]',POR_RPRO7='$porre[7]',POR_RPRO8='$porre[8]',POR_RPRO9='$porre[9]',POR_RPRO10='$porre[10]',POR_RPRO11='$porre[11]',POR_RPRO12='$porre[12]',POR_RPRO13='$porre[13]',POR_RPRO14='$porre[14]',POR_RPRO15='$porre[15]',POR_RPRO16='$porre[16]',POR_RPRO17='$porre[17]',POR_RPRO18='$porre[18]',POR_RPRO19='$porre[19]',POR_RPRO20='$porre[20]',POR_RPRO21='$porre[21]',POR_RPRO22='$porre[22]',POR_RPRO23='$porre[23]',POR_RPRO24='$porre[24]',POR_RPRO25='$porre[25]',POR_RPRO26='$porre[26]',POR_RPRO27='$porre[27]',POR_RPRO28='$porre[28]',POR_RPRO29='$porre[29]',POR_RPRO30='$porre[30]',POR_RPRO31='$porre[31]',POR_RPRO32='$porre[32]',POR_RPRO33='$porre[33]',POR_RPRO34='$porre[34]',POR_RPRO35='$porre[35]' where ACTA='$nacta' and LAPSO='$nlapso' and C_ASIGNA='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$exp_e= array();
for($i=0;$i<$cantialu;$i++)
	{
	$exp_e[$i]=$alu[$i][0];
	for($j=1;$j<=$ccca;$j++) $nnota[36][$i]=$nnota[36][$i]+$nnota[$j][$i];
	$nnota[37][$i]=conva9(round($nnota[36][$i]));
	}
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select EXP_E from N_ESTU where acta='$nacta' and lapso='$nlapso' and c_asigna='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
	if($result[0][0]!=NULL)
	{
		for($k=0;$k<$cantialu;$k++)
		{
$mSQL  = "UPDATE N_ESTU SET UCCA='$ucca',CCCA='$ccca',NOTA1='".$nnota[1][$k]."',NOTA2='".$nnota[2][$k]."',NOTA3='".$nnota[3][$k]."',NOTA4='".$nnota[4][$k]."',NOTA5='".$nnota[5][$k]."',NOTA6='".$nnota[6][$k]."',NOTA7='".$nnota[7][$k]."',NOTA8='".$nnota[8][$k]."',NOTA9='".$nnota[9][$k]."',NOTA10='".$nnota[10][$k]."',NOTA11='".$nnota[11][$k]."',NOTA12='".$nnota[12][$k]."',NOTA13='".$nnota[13][$k]."',NOTA14='".$nnota[14][$k]."',NOTA15='".$nnota[15][$k]."',NOTA16='".$nnota[16][$k]."',NOTA17='".$nnota[17][$k]."',NOTA18='".$nnota[18][$k]."',NOTA19='".$nnota[19][$k]."',NOTA20='".$nnota[20][$k]."',NOTA21='".$nnota[21][$k]."',NOTA22='".$nnota[22][$k]."',NOTA23='".$nnota[23][$k]."',NOTA24='".$nnota[24][$k]."',NOTA25='".$nnota[25][$k]."',NOTA26='".$nnota[26][$k]."',NOTA27='".$nnota[27][$k]."',NOTA28='".$nnota[28][$k]."',NOTA29='".$nnota[29][$k]."',NOTA30='".$nnota[30][$k]."',NOTA31='".$nnota[31][$k]."',NOTA32='".$nnota[32][$k]."',NOTA33='".$nnota[33][$k]."',NOTA34='".$nnota[34][$k]."',NOTA35='".$nnota[35][$k]."',TOTAL100='".$nnota[36][$k]."',TOTAL9='".$nnota[37][$k]."' where ACTA='$nacta' and LAPSO='$nlapso' and C_ASIGNA='$nc_asigna' and EXP_E='$exp_e[$k]'";
		$conex->ExecSQL($mSQL,__LINE__,true);
		}
	}
	else
	{
		for($k=0;$k<$cantialu;$k++)
		{
$mSQL  = "INSERT INTO N_ESTU (ACTA,LAPSO,C_ASIGNA,EXP_E,NOTA1,NOTA2,NOTA3,NOTA4,NOTA5,NOTA6,NOTA7,NOTA8,NOTA9,NOTA10,NOTA11,NOTA12,NOTA13,NOTA14,NOTA15,NOTA16,NOTA17,NOTA18,NOTA19,NOTA20,NOTA21,NOTA22,NOTA23,NOTA24,NOTA25,NOTA26,NOTA27,NOTA28,NOTA29,NOTA30,NOTA31,NOTA32,NOTA33,NOTA34,NOTA35,TOTAL100,TOTAL9,CCCA,UCCA) VALUES ('$nacta','$nlapso','$nc_asigna','$exp_e[$k]','".$nnota[1][$k]."','".$nnota[2][$k]."','".$nnota[3][$k]."','".$nnota[4][$k]."','".$nnota[5][$k]."','".$nnota[6][$k]."','".$nnota[7][$k]."','".$nnota[8][$k]."','".$nnota[9][$k]."','".$nnota[10][$k]."','".$nnota[11][$k]."','".$nnota[12][$k]."','".$nnota[13][$k]."','".$nnota[14][$k]."','".$nnota[15][$k]."','".$nnota[16][$k]."','".$nnota[17][$k]."','".$nnota[18][$k]."','".$nnota[19][$k]."','".$nnota[20][$k]."','".$nnota[21][$k]."','".$nnota[22][$k]."','".$nnota[23][$k]."','".$nnota[24][$k]."','".$nnota[25][$k]."','".$nnota[26][$k]."','".$nnota[27][$k]."','".$nnota[28][$k]."','".$nnota[29][$k]."','".$nnota[30][$k]."','".$nnota[31][$k]."','".$nnota[32][$k]."','".$nnota[33][$k]."','".$nnota[34][$k]."','".$nnota[35][$k]."','".$nnota[36][$k]."','".$nnota[37][$k]."','$ccca','$ucca')";
$conex->ExecSQL($mSQL,__LINE__,true);
		}
	}
$result = $conex->result;
return $result[0][0];
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////

function con_ex_eva_car($nacta,$nlapso,$nc_asigna) {
//require_once("inc/odbcss_c.php");
global $conex;
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select CANT_EVA,UECA from D_TEMAS where ACTA='$nacta' and LAPSO='$nlapso' and C_ASIGNA='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
if($result[0][0]==NULL) return 0;
if($result[0][0]==$result[0][1]) return 2;
if($result[0][0]>$result[0][1]) return 1;
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function con_ex_temas_car($nacta,$nlapso,$nc_asigna) {
//require_once("inc/odbcss_c.php");
global $conex;
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select UECA,TEMA1,TEMA2,TEMA3,TEMA4,TEMA5,TEMA6,TEMA7,TEMA8,TEMA9,TEMA10,TEMA11,TEMA12,TEMA13,TEMA14,TEMA15,TEMA16,TEMA17,TEMA18,TEMA19,TEMA20,TEMA21,TEMA22,TEMA23,TEMA24,TEMA25,TEMA26,TEMA27,TEMA28,TEMA29,TEMA30,TEMA31,TEMA32,TEMA33,TEMA34,TEMA35,PORC1,PORC2,PORC3,PORC4,PORC5,PORC6,PORC7,PORC8,PORC9,PORC10,PORC11,PORC12,PORC13,PORC14,PORC15,PORC16,PORC17,PORC18,PORC19,PORC20,PORC21,PORC22,PORC23,PORC24,PORC25,PORC26,PORC27,PORC28,PORC29,PORC30,PORC31,PORC32,PORC33,PORC34,PORC35,CANT_EVA from D_TEMAS where ACTA='$nacta' and LAPSO='$nlapso' and C_ASIGNA='$nc_asigna' order by FECHADC desc, UECA desc";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
return $result;
}


/////////////////////////////////////////////////////////////////////////////////////////////
function sacanotas($nacta,$nlapso,$nc_asigna) {
//require_once("inc/odbcss_c.php");
global $conex;
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select b.apellidos||',  '||nombres,a.exp_e,a.NOTA1,a.nota2,a.nota3,a.nota4,a.nota5,a.nota6,a.nota7,a.nota8,a.nota9,a.nota10,a.nota11,a.nota12,a.nota13,a.nota14,a.nota15,a.nota16,a.nota17,a.nota18,a.nota19,a.nota20,a.NOTA21,a.NOTA22,a.NOTA23,a.NOTA24,a.NOTA25,a.NOTA26,a.NOTA27,a.NOTA28,a.NOTA29,a.NOTA30,a.NOTA31,a.NOTA32,a.NOTA33,a.NOTA34,a.NOTA35,a.total100,a.total9,c.status from N_ESTU a,dace002 b,dace006 c where a.acta='$nacta' and a.lapso='$nlapso' and a.C_ASIGNA='$nc_asigna' and a.EXP_E=b.EXP_E and c.acta='$nacta' and c.lapso='$nlapso' and c.C_ASIGNA='$nc_asigna' and a.EXP_E=c.EXP_E order by b.apellidos asc";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
return $result;
}



/////////////////////////////////////////////////////////////////////////////////////////////
function sacanotasindi($nacta,$nlapso,$nc_asigna,$exp) {
//require_once("inc/odbcss_c.php");
global $conex;
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select b.apellidos||',  '||nombres,a.exp_e,a.NOTA1,a.nota2,a.nota3,a.nota4,a.nota5,a.nota6,a.nota7,a.nota8,a.nota9,a.nota10,a.nota11,a.nota12,a.nota13,a.nota14,a.nota15,a.nota16,a.nota17,a.nota18,a.nota19,a.nota20,a.NOTA21,a.NOTA22,a.NOTA23,a.NOTA24,a.NOTA25,a.NOTA26,a.NOTA27,a.NOTA28,a.NOTA29,a.NOTA30,a.NOTA31,a.NOTA32,a.NOTA33,a.NOTA34,a.NOTA35,a.total100,a.total9,c.status from N_ESTU a,dace002 b,dace006 c where a.acta='$nacta' and a.lapso='$nlapso' and a.C_ASIGNA='$nc_asigna' and a.EXP_E=b.EXP_E and c.acta='$nacta' and c.lapso='$nlapso' and c.C_ASIGNA='$nc_asigna' and a.EXP_E='$exp' and a.EXP_E=c.EXP_E order by b.apellidos asc";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
return $result;
}


/////////////////////////////////////////////////////////////////////////////////////////////
function con_ex_no_car($nacta,$nlapso,$nc_asigna) {
//require_once("inc/odbcss_c.php");
global $conex;
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select a.UCCA,b.UECA from D_TEMAS b,N_ESTU a where a.ACTA='$nacta' and a.LAPSO='$nlapso' and a.C_ASIGNA='$nc_asigna' and b.ACTA='$nacta' and b.LAPSO='$nlapso' and b.C_ASIGNA='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
if($result[0][0]==NULL) return 0;
if($result[0][0]==$result[0][1] || $result[0][0]>$result[0][1]) return 1;
if($result[0][0]<$result[0][1]) return 2;
}

/////////////////////////////////////////////////////////////////////////////////////////////////

function con_ex_ca_car($nacta,$nlapso,$nc_asigna) {
//require_once("inc/odbcss_c.php");
global $conex;
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select a.exp_e,a.nota1,a.nota2,a.nota3,a.nota4,a.nota5,a.nota6,a.nota7,a.nota8,a.nota9,a.nota10,a.nota11,a.nota12,a.nota13,a.nota14,a.nota15,a.nota16,a.nota17,a.nota18,a.nota19,a.nota20,a.nota21,a.nota22,a.nota23,a.nota24,a.nota25,a.nota26,a.nota27,a.nota28,a.nota29,a.nota30,a.nota31,a.nota32,a.nota33,a.nota34,a.nota35 from N_ESTU a,dace002 b where a.acta='$nacta' and a.lapso='$nlapso' and a.c_asigna='$nc_asigna' and a.EXP_E=b.EXP_E order by b.apellidos asc";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
return $result;
}

/////////////////////////////////////////////////////////////////////////////////////////////

function canteva($nacta,$nlapso,$nc_asigna) {
//require_once("inc/odbcss_c.php");
global $conex;
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select CANT_EVA from D_TEMAS where ACTA='$nacta' and LAPSO='$nlapso' and C_ASIGNA='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
return $result;
}


////////////////////////////////////////////////////////////////////////////////////////

function primeravez($nacta,$nlapso,$nc_asigna) {
//require_once("inc/odbcss_c.php");
global $conex;
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select EXP_E from N_ESTU where ACTA='$nacta' and LAPSO='$nlapso' and C_ASIGNA='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
if($result[0][0]!=NULL) return false;
if($result[0][0]==NULL) return true;
}


////////////////////////////////////////////////////////////////////////////////////////

function ucca($nacta,$nlapso,$nc_asigna) {
//require_once("inc/odbcss_c.php");
global $conex;
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select ucca from N_ESTU where ACTA='$nacta' and LAPSO='$nlapso' and C_ASIGNA='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
return $result;
}


/////////////////////////////////////////////////////////////////////////


function guardar_modct($nacta,$nlapso,$nc_asigna,$rmo,$cant_ae,$cant_ace,$tema_e,$tema_a,$porc_e,$porc_a,$n_tm) {
$fecha = date("m/d/y");
global $conex;
//require_once("inc/odbcss_c.php");
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "INSERT INTO MODCT (ACTA,LAPSO,C_ASIGNA,R_MO,CANT_AE,CANT_ACE,TEMA_E,TEMA_A,PORC_E,PORC_A,N_TM,FECHA_DMCT) VALUES ('$nacta','$nlapso','$nc_asigna','$rmo','$cant_ae','$cant_ace','$tema_e','$tema_a','$porc_e','$porc_a','$n_tm','$fecha')";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
return $result;
}



/////////////////////////////////////////////////////////////////////////



function guardar_modt($nacta,$nlapso,$nc_asigna,$rmo,$tema_a,$tema_ac,$n_tm) {
$fecha = date("m/d/y");
global $conex;
//require_once("inc/odbcss_c.php");
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "INSERT INTO MODT (ACTA,LAPSO,C_ASIGNA,R_MO,TEMA_A,TEMA_AC,N_TM,FECHA_DMT) VALUES ('$nacta','$nlapso','$nc_asigna','$rmo','$tema_a','$tema_ac','$n_tm','$fecha')";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
return $result;
}



/////////////////////////////////////////////////////////////////////////




function guardar_modp($nacta,$nlapso,$nc_asigna,$rmo,$porc_a,$porc_ac,$n_tm) {
$fecha = date("m/d/y");
global $conex;
//require_once("inc/odbcss_c.php");
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "INSERT INTO MODP (ACTA,LAPSO,C_ASIGNA,R_MO,PORC_A,PORC_AC,N_TM,FECHA_DMP) VALUES ('$nacta','$nlapso','$nc_asigna','$rmo','$porc_a','$porc_ac','$n_tm','$fecha')";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
return $result;
}



/////////////////////////////////////////////////////////////////////////

function guardar_modc($nacta,$nlapso,$nc_asigna,$rmo,$esta_ann,$esta_acn,$exp_e,$n_tm) {
$fecha = date("m/d/y");
global $conex;
//require_once("inc/odbcss_c.php");
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "INSERT INTO MODN (ACTA,LAPSO,C_ASIGNA,R_MO,ESTA_ANN,ESTA_ACN,EXP_E,N_TM,FECHA_DMN) VALUES ('$nacta','$nlapso','$nc_asigna','$rmo','$esta_ann','$esta_acn','$exp_e','$n_tm','$fecha')";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
return $result;
}


/////////////////////////////////////////////////////////////////////////




function saca_modn($nacta,$nlapso,$nc_asigna) {
//require_once("inc/odbcss_c.php");
global $conex;
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select R_MO,ESTA_ANN,ESTA_ACN,N_TM,EXP_E,FECHA_DMN from MODN where ACTA='$nacta' and LAPSO='$nlapso' and C_ASIGNA='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
return $result;
}


/////////////////////////////////////////////////////////////////////////

function saca_modp($nacta,$nlapso,$nc_asigna) {
$fecha = date("m/d/y");
global $conex;
//require_once("inc/odbcss_c.php");
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select R_MO,PORC_A,PORC_AC,N_TM,FECHA_DMP from MODP where ACTA='$nacta' and LAPSO='$nlapso' and C_ASIGNA='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
return $result;
}


/////////////////////////////////////////////////////////////////////////


function saca_modt($nacta,$nlapso,$nc_asigna) {
$fecha = date("m/d/y");
global $conex;
//require_once("inc/odbcss_c.php");
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select R_MO,TEMA_A,TEMA_AC,N_TM,FECHA_DMT from MODT where ACTA='$nacta' and LAPSO='$nlapso' and C_ASIGNA='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
return $result;
}


/////////////////////////////////////////////////////////////////////////


function sacafecha($nacta,$nlapso,$nc_asigna) {
//$fecha = date("m/d/y");
//require_once("inc/odbcss_c.php");
global $conex;
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select FECHA_1,FECHA_2,FECHA_3,FECHA_4,FECHA_5,FECHA_6,FECHA_7,FECHA_8,FECHA_9,FECHA_10,FECHA_11,FECHA_12,FECHA_13,FECHA_14,FECHA_15,FECHA_16,FECHA_17,FECHA_18,FECHA_19,FECHA_20,FECHA_21,FECHA_22,FECHA_23,FECHA_24,FECHA_25,FECHA_26,FECHA_27,FECHA_28,FECHA_29,FECHA_30,FECHA_31,FECHA_32,FECHA_33,FECHA_34,FECHA_35 from FECHAS_AV where acta='$nacta' and lapso='$nlapso' and c_asigna='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
return $result;
}


/////////////////////////////////////////////////////////////////////////


function saca_modct($nacta,$nlapso,$nc_asigna) {
$fecha = date("m/d/y");
global $conex;
//require_once("inc/odbcss_c.php");
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select R_MO,CANT_AE,CANT_ACE,TEMA_E,TEMA_A,PORC_E,PORC_A,N_TM,FECHA_DMCT from MODCT where ACTA='$nacta' and LAPSO='$nlapso' and C_ASIGNA='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
return $result;
}


/////////////////////////////////////////////////////////////////////////

function sacainfo($nacta,$nlapso,$nc_asigna){

//require_once("inc/odbcss_c.php");
global $conex;
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select b.apellido||',  '||nombre,a.seccion,c.asignatura,a.inscritos from tblaca007 b,tblaca004 a,tblaca008 c where a.acta='$nacta' and a.lapso='$nlapso' and a.c_asigna='$nc_asigna' and a.CI=b.CI and a.c_asigna=c.c_asigna";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
return $result;
}

/////////////////////////////////////////////////////////////////////////

function sacaasistentes($nacta,$nlapso,$nc_asigna) {
//require_once("inc/odbcss_c.php");
global $conex;
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select POR_ASIS1,POR_ASIS2,POR_ASIS3,POR_ASIS4,POR_ASIS5,POR_ASIS6,POR_ASIS7,POR_ASIS8,POR_ASIS9,POR_ASIS10,POR_ASIS11,POR_ASIS12,POR_ASIS13,POR_ASIS14,POR_ASIS15,POR_ASIS16,POR_ASIS17,POR_ASIS18,POR_ASIS19,POR_ASIS20,POR_ASIS21,POR_ASIS22,POR_ASIS23,POR_ASIS24,POR_ASIS25,POR_ASIS26,POR_ASIS27,POR_ASIS28,POR_ASIS29,POR_ASIS30,POR_ASIS31,POR_ASIS32,POR_ASIS33,POR_ASIS34,POR_ASIS35 from D_TEMAS where acta='$nacta' and lapso='$nlapso' and C_ASIGNA='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
return $result;
}


/////////////////////////////////////////////////////////////////////////////////////////////

function sacainasistentes($nacta,$nlapso,$nc_asigna) {
//require_once("inc/odbcss_c.php");
global $conex;
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select POR_IASIS1,POR_IASIS2,POR_IASIS3,POR_IASIS4,POR_IASIS5,POR_IASIS6,POR_IASIS7,POR_IASIS8,POR_IASIS9,POR_IASIS10,POR_IASIS11,POR_IASIS12,POR_IASIS13,POR_IASIS14,POR_IASIS15,POR_IASIS16,POR_IASIS17,POR_IASIS18,POR_IASIS19,POR_IASIS20,POR_IASIS21,POR_IASIS22,POR_IASIS23,POR_IASIS24,POR_IASIS25,POR_IASIS26,POR_IASIS27,POR_IASIS28,POR_IASIS29,POR_IASIS30,POR_IASIS31,POR_IASIS32,POR_IASIS33,POR_IASIS34,POR_IASIS35 from D_TEMAS where acta='$nacta' and lapso='$nlapso' and C_ASIGNA='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
return $result;
}


/////////////////////////////////////////////////////////////////////////////////////////////

function sacaaprobados($nacta,$nlapso,$nc_asigna) {
//require_once("inc/odbcss_c.php");
global $conex;
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select POR_APRO1,POR_APRO2,POR_APRO3,POR_APRO4,POR_APRO5,POR_APRO6,POR_APRO7,POR_APRO8,POR_APRO9,POR_APRO10,POR_APRO11,POR_APRO12,POR_APRO13,POR_APRO14,POR_APRO15,POR_APRO16,POR_APRO17,POR_APRO18,POR_APRO19,POR_APRO20,POR_APRO21,POR_APRO22,POR_APRO23,POR_APRO24,POR_APRO25,POR_APRO26,POR_APRO27,POR_APRO28,POR_APRO29,POR_APRO30,POR_APRO31,POR_APRO32,POR_APRO33,POR_APRO34,POR_APRO35 from D_TEMAS where acta='$nacta' and lapso='$nlapso' and C_ASIGNA='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
return $result;
}


/////////////////////////////////////////////////////////////////////////////////////////////


function sacareprobados($nacta,$nlapso,$nc_asigna) {
//require_once("inc/odbcss_c.php");
global $conex;
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select POR_RPRO1,POR_RPRO2,POR_RPRO3,POR_RPRO4,POR_RPRO5,POR_RPRO6,POR_RPRO7,POR_RPRO8,POR_RPRO9,POR_RPRO10,POR_RPRO11,POR_RPRO12,POR_RPRO13,POR_RPRO14,POR_RPRO15,POR_RPRO16,POR_RPRO17,POR_RPRO18,POR_RPRO19,POR_RPRO20,POR_RPRO21,POR_RPRO22,POR_RPRO23,POR_RPRO24,POR_RPRO25,POR_RPRO26,POR_RPRO27,POR_RPRO28,POR_RPRO29,POR_RPRO30,POR_RPRO31,POR_RPRO32,POR_RPRO33,POR_RPRO34,POR_RPRO35 from D_TEMAS where acta='$nacta' and lapso='$nlapso' and C_ASIGNA='$nc_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;
return $result;
}




/////////////////////////////////////////////////////////////////////////////////////////////


function ex_agregados($nacta,$nlapso,$nc_asigna) {
$agregados=array();	
global $conex;
$mSQL  = "select c.EXP_E,b.apellidos||',  '||nombres,c.status from dace006 c,dace002 b where c.acta='$nacta' and c.lapso='$nlapso' and c.c_asigna='$nc_asigna' and c.EXP_E=b.EXP_E and not exists (select a.EXP_E,a.status from N_ESTU a where c.exp_e=a.exp_e)";

$conex->ExecSQL($mSQL,__LINE__,true);
$todos = $conex->result;
return $todos;
}
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////
//---------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------
function conva9($numero)
{
if($numero==0)	return 0.0;
if($numero==1)	return 1.0;
if($numero==2)	return 1.1;
if($numero==3 || $numero==4)	return 1.2;
if($numero==5)	return 1.3;
if($numero==6 || $numero==7)	return 1.4;
if($numero==8)	return 1.6;
if($numero==9 || $numero==10)	return 1.7;
if($numero==11)	return 1.8;
if($numero==12)	return 1.9;
if($numero==13)	return 2.0;
if($numero==14)	return 2.1;
if($numero==15 || $numero==16)	return 2.2;
if($numero==17)	return 2.3;
if($numero==18)	return 2.4;
if($numero==19)	return 2.5;
if($numero==20)	return 2.6;
if($numero==21 || $numero==22)	return 2.7;
if($numero==23)	return 2.8;
if($numero==24)	return 2.9;
if($numero==25)	return 3.0;
if($numero==26)	return 3.1;
if($numero==27 || $numero==28)	return 3.2;
if($numero==29)	return 3.3;
if($numero==30)	return 3.4;
if($numero==31)	return 3.5;
if($numero==32)	return 3.6;
if($numero==33 || $numero==34)	return 3.7;
if($numero==35)	return 3.8;
if($numero==36)	return 3.9;
if($numero==37)	return 4.0;
if($numero==38)	return 4.1;
if($numero==39)	return 4.2;
if($numero==40)	return 4.2;
if($numero==41)	return 4.3;
if($numero==42)	return 4.4;
if($numero==43 || $numero==44)	return 4.5;
if($numero==45)	return 4.6;
if($numero==46)	return 4.7;
if($numero==47)	return 4.8;
if($numero==48)	return 4.8;
if($numero==49)	return 4.9;
if($numero==50)	return 5.0;
if($numero==51)	return 5.1;
if($numero==52)	return 5.2;
if($numero==53)	return 5.3;
if($numero==54)	return 5.4;
if($numero==55)	return 5.5;
if($numero==56)	return 5.5;
if($numero==57)	return 5.6;
if($numero==58)	return 5.7;
if($numero==59)	return 5.8;
if($numero==60)	return 5.9;
if($numero==61)	return 6.0;
if($numero==62)	return 6.1;
if($numero==63)	return 6.2;
if($numero==64)	return 6.3;
if($numero==65)	return 6.4;
if($numero==66)	return 6.5;
if($numero==67)	return 6.6;
if($numero==68)	return 6.7;
if($numero==69)	return 6.8;
if($numero==70)	return 6.9;
if($numero==71)	return 7.0;
if($numero==72)	return 7.1;
if($numero==73)	return 7.2;
if($numero==74)	return 7.3;
if($numero==75)	return 7.4;
if($numero==76)	return 7.5;
if($numero==77)	return 7.6;
if($numero==78)	return 7.7;
if($numero==79)	return 7.8;
if($numero==80)	return 7.9;
if($numero==81)	return 8.0;
if($numero==82)	return 8.1;
if($numero==83)	return 8.2;
if($numero==84)	return 8.3;
if($numero==85)	return 8.4;
if($numero==86)	return 8.5;
if($numero==87)	return 8.6;
if($numero==88)	return 8.7;
if($numero==89)	return 8.8;
if($numero==90)	return 8.9;
if($numero>=91 && $numero<=100)	return 9.0;
}
//---------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------



if($codigos==234)//fajax para mostrar eliminar de un tema
{			
			$valor=$_POST['valor'];
			$acta=$_POST['acta'];
			$lapso=$_POST['lapso'];
			$c_asigna=$_POST['c_asigna'];
			$resultado=con_ex_temas_car($acta,$lapso,$c_asigna);
			for($i=1;$i<=35;$i++) $tema[$i]=$resultado[0][$i];
			for($i=36,$j=1;$i<=70;$i++,$j++)	$porc[$j]=$resultado[0][$i];

if($valor!=NULL){			
echo '
<table align="center" width="100%">
  	<tr>
    <td width="38%" class="datosp"><strong>DESCRIPCION DE TEMA:</strong>&nbsp;&nbsp;</td><td class="datosp">'.$tema[$valor].'</td>
 	</tr>
	<tr>
    <td width="38%" class="datosp"><strong>VALOR:</strong>&nbsp;</td><td class="datosp">'.$porc[$valor].'%</td>
 	</tr>
</table>
';}
}



//recordar modificar lo del acta y todo eso que sea la que se busca
/////////////////////////////////////////////////////////////////////////



if($codigos==333)//cuando se va a guardar la eliminacion de un tema
{
	$acta=$_POST['acta'];
	$lapso=$_POST['lapso'];
	$c_asigna=$_POST['c_asigna'];
	$razeli=$_POST['razeli'];
	$selecta=$_POST['selecta'];
	$resultado=con_ex_temas_car($acta,$lapso,$c_asigna);
	$canteva=canteva($acta,$lapso,$c_asigna);
	$canae=$canteva[0][0];
	$cantee=$canteva[0][0]-1;
	$cont=0;
	for($i=1;$i<=35;$i++)
	{
		if($i!=$selecta)	
		{
		$cont++;
		$tema[$cont]=$resultado[0][$i];
		}
		else $temae=$resultado[0][$i];
	}
	$cont=0;
	for($j=1,$i=36;$j<=35;$j++,$i++)
	{	
		if($j!=$selecta)	
		{
		$cont++;
		$porc[$cont]=$resultado[0][$i];
		}
		else $porce=$resultado[0][$i];
	}

	$respuesta1=guardar_modct($acta,$lapso,$c_asigna,$razeli,$canae,$cantee,$temae,NULL,$porce,NULL,$selecta);
	$respuesta=guardar_temas($cantee,$acta,$lapso,$c_asigna,$tema,$porc,$cantee,$cantee);
	/*$ucca=ucca($acta,$lapso,$c_asigna);
	if($selecta<=$ucca[0][0])
	{
	require_once("inc/odbcss_c.php");
	$conex = new ODBC_Conn("dace9","jose","nacho",TRUE,"avance_academico.log");
	$mSQL  = "select a.EXP_E,b.apellidos||',  '||nombres from dace006 a,dace002 b where a.acta='$acta' and a.lapso='$lapso' and 	a.EXP_E=b.EXP_E and C_ASIGNA='$c_asigna' order by b.apellidos asc";
	$conex->ExecSQL($mSQL,__LINE__,true);
	$result = $conex->result;
	$cont=$ucca[0][0]-1;	
	$resultad=con_ex_ca_car($acta,$lapso,$c_asigna);
	$cantalu=0;
	while($resultad[$cantalu][0]!=NULL)
			{
			$contt=0;
			for($i=1;$i<=35;$i++) 
			{
			
			if($i!=$selecta)
			{
			$contt++;
			$nota[$contt][$cantalu]=$resultad[$cantalu][$i];
			}
			}
			$cantalu++;
			}	
	$respuesta2=guardar_calificaciones($acta,$lapso,$c_asigna,$result,$nota,$cantalu,$cont,$cont);		
	}
			echo '<table >
  				<tr>
    			<td width="893" height="88" class="act"><p align="center">Universidad Nacional Experimental Polit&eacute;cnica<br>
				"Antonio Jos&eacute; de Sucre"<br>
				Vicerrectorado Puerto Ordaz<br>
				Unidad Regional de Admisi&oacute;n y Control de Estudios</p>    </td>
  				</tr>
  				<tr>
  				<td height="22" class="enc_p">SISTEMA DE AVANCE ACADEMICO</td>
  				</tr>
  				<tr><td class="datosp">
					<br><br>
    				<p>Se han modificado los datos correctamente</p>
					<form name="form" method="post" action="cante.php">
					 <input type="hidden" name="acta" value="'.$acta.'">
	  				 <input type="hidden" name="lapso" value="'.$lapso.'">
	 				 <input type="hidden" name="c_asigna" value="'.$c_asigna.'">
					 <input type="submit" name="submit" value="Regresar" class="boton">
					 </form>
					</td>
  				</tr>
				</table>';*/
			?>	
			<body Onload="document.form2.action='cante.php'; document.form2.submit(); alert('Se ha modificado correctamente'); ">
				<form name="form2" method="post" action="" >
	 				<input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					 </form>					 
			<?PHP
		
}



//recordar modificar lo del acta y todo eso que sea la que se busca
/////////////////////////////////////////////////////////////////////////



if($codigos==235) //fajax para mostrar cuando se va a modificar la descripcion de un tema
{			
			$valor=$_POST['valor'];
			$acta=$_POST['acta'];
			$lapso=$_POST['lapso'];
			$c_asigna=$_POST['c_asigna'];
			$resultado=con_ex_temas_car($acta,$lapso,$c_asigna);
			for($i=1;$i<=35;$i++) $tema[$i]=$resultado[0][$i];
			for($i=36,$j=1;$i<=70;$i++,$j++)	$porc[$j]=$resultado[0][$i];

			
echo '
<table width="100%" align="centre">
  	<tr>
    <td width="100%" class="datosp">'.$tema[$valor].'</td>
 	</tr>
</table>
';
}




//recordar modificar lo del acta y todo eso que sea la que se busca
/////////////////////////////////////////////////////////////////////////




if($codigos==444)//cuando se va a guardar modificacion de descripcion de un tema
{
	$acta=$_POST['acta'];
	$lapso=$_POST['lapso'];
	$c_asigna=$_POST['c_asigna'];
	$razmodt=$_POST['razmodt'];
	$ndt=$_POST['ndt'];
	$selecta=$_POST['selecta'];
	$resultado=con_ex_temas_car($acta,$lapso,$c_asigna);
	$canteva=canteva($acta,$lapso,$c_asigna);
	$cantee=$canteva[0][0];
	$cont=$resultado[0][0];
	for($i=1;$i<=35;$i++) $tema[$i]=$resultado[0][$i];
	for($i=36,$j=1;$i<=70;$i++,$j++)	$porc[$j]=$resultado[0][$i];
	$temaa=$tema[$selecta];
	$tema[$selecta]=$ndt;
	$respuesta1=guardar_modt($acta,$lapso,$c_asigna,$razmodt,$temaa,$ndt,$selecta);
	$respuesta=guardar_temas($cantee,$acta,$lapso,$c_asigna,$tema,$porc,$cont,$cont);
			/*echo '<table >
  				<tr>
    			<td width="893" height="88" class="act"><p align="center">Universidad Nacional Experimental Polit&eacute;cnica<br>
				"Antonio Jos&eacute; de Sucre"<br>
				Vicerrectorado Puerto Ordaz<br>
				Unidad Regional de Admisi&oacute;n y Control de Estudios</p>    </td>
  				</tr>
  				<tr>
  				<td height="22" class="enc_p">SISTEMA DE AVANCE ACADEMICO</td>
  				</tr>
  				<tr><td class="datosp">
					<br><br>
    				<p>Se han modificado los datos correctamente</p>
					 <form name="form" method="post" action="cante.php">
					 <input type="hidden" name="acta" value="'.$acta.'">
	  				 <input type="hidden" name="lapso" value="'.$lapso.'">
	 				 <input type="hidden" name="c_asigna" value="'.$c_asigna.'">
					 <input type="submit" name="submit" value="Regresar" class="boton">
					 </form>
					</td>
  				</tr>
				</table>';*/
						?>	
			<body Onload="document.form2.action='cante.php'; document.form2.submit(); alert('Se ha modificado correctamente'); ">
				<form name="form2" method="post" action="" >
	 				<input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					 </form>					 
			<?PHP
}



//recordar modificar lo del acta y todo eso que sea la que se busca
/////////////////////////////////////////////////////////////////////////


if($codigos==555)//cuando se va a guardar modificacion de porcentaje de un tema
{
	$acta=$_POST['acta'];
	$lapso=$_POST['lapso'];
	$c_asigna=$_POST['c_asigna'];
	$razmodp=$_POST['razmodp'];
	$np=$_POST['np'];
	$selecta=$_POST['selecta'];
	$resultado=con_ex_temas_car($acta,$lapso,$c_asigna);
	$canteva=canteva($acta,$lapso,$c_asigna);
	$cantee=$canteva[0][0];
	$cont=$resultado[0][0];
	for($i=1;$i<=35;$i++) $tema[$i]=$resultado[0][$i];
	for($i=36,$j=1;$i<=70;$i++,$j++)	$porc[$j]=$resultado[0][$i];
	$porca=$porc[$selecta];
	$porc[$selecta]=$np;
	$respuesta1=guardar_modp($acta,$lapso,$c_asigna,$razmodp,$porca,$np,$selecta);
	$respuesta=guardar_temas($cantee,$acta,$lapso,$c_asigna,$tema,$porc,$cont,$cont);
			/*echo '<table >
  				<tr>
    			<td width="893" height="88" class="act"><p align="center">Universidad Nacional Experimental Polit&eacute;cnica<br>
				"Antonio Jos&eacute; de Sucre"<br>
				Vicerrectorado Puerto Ordaz<br>
				Unidad Regional de Admisi&oacute;n y Control de Estudios</p>    </td>
  				</tr>
  				<tr>
  				<td height="22" class="enc_p">SISTEMA DE AVANCE ACADEMICO</td>
  				</tr>
  				<tr><td class="datosp">
					<br><br>
    				<p>Se han modificado los datos correctamente</p>
					<form name="form" method="post" action="cante.php">
					 <input type="hidden" name="acta" value="'.$acta.'">
	  				 <input type="hidden" name="lapso" value="'.$lapso.'">
	 				 <input type="hidden" name="c_asigna" value="'.$c_asigna.'">
					 <input type="submit" name="submit" value="Regresar" class="boton">
					 </form>
					</td>
  				</tr>
				</table>';*/
				
						?>	
			<body Onload="document.form2.action='cante.php'; document.form2.submit(); alert('Se ha modificado correctamente'); ">
				<form name="form2" method="post" action="" >
	 				<input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					 </form>					 
			<?PHP
				
}


//recordar modificar lo del acta y todo eso que sea la que se busca
/////////////////////////////////////////////////////////////////////////




if($codigos==236) //fajax para mostrar cuando se va a modificar la de un estudiante
{	
		
			$valor=$_POST['valor'];
			$acta=$_POST['acta'];
			$lapso=$_POST['lapso'];
			$c_asigna=$_POST['c_asigna'];
			$alu=$_POST['alu'];
			$eva=$_POST['eva'];
			$resultado4=con_ex_temas_car($acta,$lapso,$c_asigna);
			if($resultado4!=NULL)
			{	
				//$temp=ucca($acta,$lapso,$c_asigna);
				//$cont=$temp[0][0];
				//$conte=$cont;
				//for($i=1;$i<=35;$i++) $tema[$i]=$resultado4[0][$i];
				for($i=36,$j=1;$i<=70;$i++,$j++)	$porc[$j]=$resultado4[0][$i];
			}
			$resulta=con_ex_ca_car($acta,$lapso,$c_asigna);
		
			
	if($eva>=1 && $alu!=NULL){					
	echo '
	<table width="100%" align="center">
  	<tr>
    <td width="38%" align="right" class="datosp"><strong>CALIFICACION ACTUAL:</strong>&nbsp;&nbsp;</td><td  class="datosp">'.$resulta[$alu][$eva].'</td>
 	</tr>
	<tr>
    <td width="38%"  class="datosp"><strong>VALOR DE LA EVALUACION:</strong>&nbsp;&nbsp;</td><td  class="datosp">'.$porc[$eva].'</td>
 	</tr>
	</table>
	';
	}
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


if($codigos=='1agreg') //cargando los estudiantes agregados al sistema
{
	global $conex;
	echo 'entre';
	$acta=$_POST['acta'];
	$lapso=$_POST['lapso'];
	$c_asigna=$_POST['c_asigna'];
	//$agregado=ex_agregados($acta,$lapso,$c_asigna);
	$nueva=array();
	$nota=array();
	$status=array();
$ult=ucca($acta,$lapso,$c_asigna);
$ulti=$ult[0][0];
$mSQL  = "select a.EXP_E,b.apellidos||',  '||nombres,a.status from dace006 a,dace002 b where a.acta='$acta' and a.lapso='$lapso' and a.EXP_E=b.EXP_E and a.c_asigna='$c_asigna' order by b.apellidos asc";
$conex->ExecSQL($mSQL,__LINE__,true);
$todos = $conex->result;	
$mSQL  = "select a.exp_e,b.apellidos||',  '||nombres,a.NOTA1,a.nota2,a.nota3,a.nota4,a.nota5,a.nota6,a.nota7,a.nota8,a.nota9,a.nota10,a.nota11,a.nota12,a.nota13,a.nota14,a.nota15,a.nota16,a.nota17,a.nota18,a.nota19,a.nota20,a.NOTA21,a.NOTA22,a.NOTA23,a.NOTA24,a.NOTA25,a.NOTA26,a.NOTA27,a.NOTA28,a.NOTA29,a.NOTA30,a.NOTA31,a.NOTA32,a.NOTA33,a.NOTA34,a.NOTA35,a.total100,a.total9 from N_ESTU a,dace002 b,dace006 c where a.acta='$acta' and a.lapso='$lapso' and a.C_ASIGNA='$c_asigna' and a.EXP_E=b.EXP_E and c.acta='$acta' and c.lapso='$lapso' and c.C_ASIGNA='$c_asigna' and a.EXP_E=c.EXP_E order by b.apellidos asc";	
$conex->ExecSQL($mSQL,__LINE__,true);
$existentes = $conex->result;	


				$cantalu=0;
				$num=0;
				while($todos[$cantalu][0]!=NULL)
				{	
					if($todos[$cantalu][0]!=$existentes[$num][0])
						{						
						for($k=1;$k<=$ulti;$k++)
								{
								$nota[$cantalu][$k]=0;
								}							
						}
					if($todos[$cantalu][0]==$existentes[$num][0])
						{
							for($j=2,$k=1;$j<=$ulti+1;$j++,$k++)
								{
								$nota[$cantalu][$k]=$existentes[$num][$j];
								}
						$num++;
						}
				$cantalu++;
				}


				

$resultado4=con_ex_temas_car($acta,$lapso,$c_asigna);
			if($resultado4!=NULL)
			{	
				for($i=36,$j=1;$i<=70;$i++,$j++)	$porc[$j]=$resultado4[0][$i];
			}
			
/////comenzando a guardar todos los cambios

	$naapro=array();	
	$narepro=array();	
	$naasis=array();
	$nainais=array();
	
for($j=1;$j<=$ulti;$j++){
$setpoint=$porc[$j]/2;
for($i=0;$i<$cantalu;$i++)
	{
	if($nota[$i][$j]>=$setpoint) $naapro[$j]++;		
	if($nota[$i][$j]<$setpoint) $narepro[$j]++;
	if($nota[$i][$j]>1) $naasis[$j]++;
	if($nota[$i][$j]<=1) $nainais[$j]++;
	
	}
}	
	
for($j=1;$j<=$ulti;$j++){

	$porap[$j]= round((($naapro[$j]*100)/$cantalu)*100)/100;
	$porre[$j]=	round((($narepro[$j]*100)/$cantalu)*100)/100;
	$poras[$j]=	round((($naasis[$j]*100)/$cantalu)*100)/100;
	$porin[$j]=	round((($nainais[$j]*100)/$cantalu)*100)/100;
}	

$mSQL  = "UPDATE D_TEMAS SET POR_ASIS1='$poras[1]',POR_ASIS2='$poras[2]',POR_ASIS3='$poras[3]',POR_ASIS4='$poras[4]',POR_ASIS5='$poras[5]',POR_ASIS6='$poras[6]',POR_ASIS7='$poras[7]',POR_ASIS8='$poras[8]',POR_ASIS9='$poras[9]',POR_ASIS10='$poras[10]',POR_ASIS11='$poras[11]',POR_ASIS12='$poras[12]',POR_ASIS13='$poras[13]',POR_ASIS14='$poras[14]',POR_ASIS15='$poras[15]',POR_ASIS16='$poras[16]',POR_ASIS17='$poras[17]',POR_ASIS18='$poras[18]',POR_ASIS19='$poras[19]',POR_ASIS20='$poras[20]',POR_ASIS21='$poras[21]',POR_ASIS22='$poras[22]',POR_ASIS23='$poras[23]',POR_ASIS24='$poras[24]',POR_ASIS25='$poras[25]',POR_ASIS26='$poras[26]',POR_ASIS27='$poras[27]',POR_ASIS28='$poras[28]',POR_ASIS29='$poras[29]',POR_ASIS30='$poras[30]',POR_ASIS31='$poras[31]',POR_ASIS32='$poras[32]',POR_ASIS33='$poras[33]',POR_ASIS34='$poras[34]',POR_ASIS35='$poras[35]',POR_IASIS1='$porin[1]',POR_IASIS2='$porin[2]',POR_IASIS3='$porin[3]',POR_IASIS4='$porin[4]',POR_IASIS5='$porin[5]',POR_IASIS6='$porin[6]',POR_IASIS7='$porin[7]',POR_IASIS8='$porin[8]',POR_IASIS9='$porin[9]',POR_IASIS10='$porin[10]',POR_IASIS11='$porin[11]',POR_IASIS12='$porin[12]',POR_IASIS13='$porin[13]',POR_IASIS14='$porin[14]',POR_IASIS15='$porin[15]',POR_IASIS16='$porin[16]',POR_IASIS17='$porin[17]',POR_IASIS18='$porin[18]',POR_IASIS19='$porin[19]',POR_IASIS20='$porin[20]',POR_IASIS21='$porin[21]',POR_IASIS22='$porin[22]',POR_IASIS23='$porin[23]',POR_IASIS24='$porin[24]',POR_IASIS25='$porin[25]',POR_IASIS26='$porin[26]',POR_IASIS27='$porin[27]',POR_IASIS28='$porin[28]',POR_IASIS29='$porin[29]',POR_IASIS30='$porin[30]',POR_IASIS31='$porin[31]',POR_IASIS32='$porin[32]',POR_IASIS33='$porin[33]',POR_IASIS34='$porin[34]',POR_IASIS35='$porin[35]',POR_APRO1='$porap[1]',POR_APRO2='$porap[2]',POR_APRO3='$porap[3]',POR_APRO4='$porap[4]',POR_APRO5='$porap[5]',POR_APRO6='$porap[6]',POR_APRO7='$porap[7]',POR_APRO8='$porap[8]',POR_APRO9='$porap[9]',POR_APRO10='$porap[10]',POR_APRO11='$porap[11]',POR_APRO12='$porap[12]',POR_APRO13='$porap[13]',POR_APRO14='$porap[14]',POR_APRO15='$porap[15]',POR_APRO16='$porap[16]',POR_APRO17='$porap[17]',POR_APRO18='$porap[18]',POR_APRO19='$porap[19]',POR_APRO20='$porap[20]',POR_APRO21='$porap[21]',POR_APRO22='$porap[22]',POR_APRO23='$porap[23]',POR_APRO24='$porap[24]',POR_APRO25='$porap[25]',POR_APRO26='$porap[26]',POR_APRO27='$porap[27]',POR_APRO28='$porap[28]',POR_APRO29='$porap[29]',POR_APRO30='$porap[30]',POR_APRO31='$porap[31]',POR_APRO32='$porap[32]',POR_APRO33='$porap[33]',POR_APRO34='$porap[34]',POR_APRO35='$porap[35]',POR_RPRO1='$porre[1]',POR_RPRO2='$porre[2]',POR_RPRO3='$porre[3]',POR_RPRO4='$porre[4]',POR_RPRO5='$porre[5]',POR_RPRO6='$porre[6]',POR_RPRO7='$porre[7]',POR_RPRO8='$porre[8]',POR_RPRO9='$porre[9]',POR_RPRO10='$porre[10]',POR_RPRO11='$porre[11]',POR_RPRO12='$porre[12]',POR_RPRO13='$porre[13]',POR_RPRO14='$porre[14]',POR_RPRO15='$porre[15]',POR_RPRO16='$porre[16]',POR_RPRO17='$porre[17]',POR_RPRO18='$porre[18]',POR_RPRO19='$porre[19]',POR_RPRO20='$porre[20]',POR_RPRO21='$porre[21]',POR_RPRO22='$porre[22]',POR_RPRO23='$porre[23]',POR_RPRO24='$porre[24]',POR_RPRO25='$porre[25]',POR_RPRO26='$porre[26]',POR_RPRO27='$porre[27]',POR_RPRO28='$porre[28]',POR_RPRO29='$porre[29]',POR_RPRO30='$porre[30]',POR_RPRO31='$porre[31]',POR_RPRO32='$porre[32]',POR_RPRO33='$porre[33]',POR_RPRO34='$porre[34]',POR_RPRO35='$porre[35]' where ACTA='$acta' and LAPSO='$lapso' and C_ASIGNA='$c_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$exp_e= array();
for($i=0;$i<$cantalu;$i++)
	{
	$exp_e[$i]=$todos[$i][0];
	//echo $exp_e[$i].'---';
	for($j=1;$j<=$ulti;$j++) $nota[$i][36]=$nota[$i][36]+$nota[$i][$j];
	$nota[$i][37]=conva9(round($nota[$i][36]));
	}

$mSQL  ="DELETE FROM N_ESTU WHERE acta='$acta' and lapso='$lapso' and C_ASIGNA='$c_asigna'";
$conex->ExecSQL($mSQL,__LINE__,true);
		for($k=0;$k<$cantalu;$k++)
		{
$mSQL  = "INSERT INTO N_ESTU (ACTA,LAPSO,C_ASIGNA,EXP_E,NOTA1,NOTA2,NOTA3,NOTA4,NOTA5,NOTA6,NOTA7,NOTA8,NOTA9,NOTA10,NOTA11,NOTA12,NOTA13,NOTA14,NOTA15,NOTA16,NOTA17,NOTA18,NOTA19,NOTA20,NOTA21,NOTA22,NOTA23,NOTA24,NOTA25,NOTA26,NOTA27,NOTA28,NOTA29,NOTA30,NOTA31,NOTA32,NOTA33,NOTA34,NOTA35,TOTAL100,TOTAL9,CCCA,UCCA) VALUES ('$acta','$lapso','$c_asigna','".$exp_e[$k]."','".$nota[$k][1]."','".$nota[$k][2]."','".$nota[$k][3]."','".$nota[$k][4]."','".$nota[$k][5]."','".$nota[$k][6]."','".$nota[$k][7]."','".$nota[$k][8]."','".$nota[$k][9]."','".$nota[$k][10]."','".$nota[$k][11]."','".$nota[$k][12]."','".$nota[$k][13]."','".$nota[$k][14]."','".$nota[$k][15]."','".$nota[$k][16]."','".$nota[$k][17]."','".$nota[$k][18]."','".$nota[$k][19]."','".$nota[$k][20]."','".$nota[$k][21]."','".$nota[$k][22]."','".$nota[$k][23]."','".$nota[$k][24]."','".$nota[$k][25]."','".$nota[$k][26]."','".$nota[$k][27]."','".$nota[$k][28]."','".$nota[$k][29]."','".$nota[$k][30]."','".$nota[$k][31]."','".$nota[$k][32]."','".$nota[$k][33]."','".$nota[$k][34]."','".$nota[$k][35]."','".$nota[$k][36]."','".$nota[$k][37]."','$ulti','$ulti')";
		$conex->ExecSQL($mSQL,__LINE__,true);
		}
?>	
	<body Onload="document.form2.action='cante.php'; document.form2.submit(); alert('Se han cargado los alumnos al sistema');">
				<form name="form2" method="post" action="">
	 				<input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				<input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				<input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
				</form>					 
<?PHP
	
}

//recordar modificar lo del acta y todo eso que sea la que se busca
/////////////////////////////////////////////////////////////////////////

if($codigos==666) //cuando se va a guardar modificacion de la calificacion de un estudiante
{
			
			$valor=$_POST['valor'];
			$acta=$_POST['acta'];
			$lapso=$_POST['lapso'];
			$c_asigna=$_POST['c_asigna'];
			$alu=$_POST['selecta'];
			$eva=$_POST['selectne'];
			$nc=$_POST['nc'];
			$razomoca=$_POST['razomoca'];
			$resultado4=con_ex_temas_car($acta,$lapso,$c_asigna);
			if($resultado4!=NULL)
			{	
				//$temp=ucca($acta,$lapso,$c_asigna);
				//$cont=$temp[0][0];
				//$conte=$cont;
				//for($i=1;$i<=35;$i++) $tema[$i]=$resultado4[0][$i];
				for($i=36,$j=1;$i<=70;$i++,$j++)	$porc[$j]=$resultado4[0][$i];
			}
			$resultad=con_ex_ca_car($acta,$lapso,$c_asigna);
			$cont=ucca($acta,$lapso,$c_asigna);
			$cont1=$cont[0][0];
			$cantalu=0;
			while($resultad[$cantalu][0]!=NULL)
				{
				for($i=1,$j=1;$i<=$cont[0][0];$i++,$j++) 
				{
				$nota[$i][$cantalu]=$resultad[$cantalu][$j];
				//echo $resultad[$cantalu][$j].'--';
				//echo $i.'-'.$j.'-'.$cantalu.'.';
				}
				$cantalu++;
				}
	$caant=$nota[$eva][$alu];
	$nota[$eva][$alu]=$nc;
	$exp_te=$resultad[$alu][0];
	$resultado1=guardar_calificaciones($acta,$lapso,$c_asigna,$resultad,$nota,$cantalu,$cont1,$cont1,$porc);
	$resultado2=guardar_modc($acta,$lapso,$c_asigna,$razomoca,$caant,$nc,$exp_te,$eva);

			/*echo '<table >
  				<tr>
    			<td width="893" height="88" class="act"><p align="center">Universidad Nacional Experimental Polit&eacute;cnica<br>
				"Antonio Jos&eacute; de Sucre"<br>
				Vicerrectorado Puerto Ordaz<br>
				Unidad Regional de Admisi&oacute;n y Control de Estudios</p>    </td>
  				</tr>
  				<tr>
  				<td height="22" class="enc_p">SISTEMA DE AVANCE ACADEMICO</td>
  				</tr>
  				<tr><td class="datosp">
					<br><br>
    				<p>Se han modificado los datos correctamente</p>
					 <form name="form" method="post" action="cante.php">
					 <input type="hidden" name="acta" value="'.$acta.'">
	  				 <input type="hidden" name="lapso" value="'.$lapso.'">
	 				 <input type="hidden" name="c_asigna" value="'.$c_asigna.'">
					 <input type="submit" name="submit" value="Regresar" class="boton">
					 </form>
					</td>
  				</tr>
				</table>';*/
				
				?>	
			<body Onload="document.form2.action='cante.php'; document.form2.submit(); alert('Se ha modificado correctamente'); ">
				<form name="form2" method="post" action="" >
	 				<input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					 </form>					 
			<?PHP
				
}




//recordar modificar lo del acta y todo eso que sea la que se busca 					
/////////////////////////////////////////////////////////////////////////

if($codigos==277) //cargando estudiantes al sistema
{	

			//$valor=$_POST['valor'];
			$acta=$_POST['acta'];
			$lapso=$_POST['lapso'];
			$c_asigna=$_POST['c_asigna'];
			//$alu=$_POST['alu'];
			//$eva=$_POST['eva'];
			//require_once("inc/odbcss_c.php");
			//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
			$mSQL  = "select a.EXP_E,b.apellidos||',  '||nombres,a.status from dace006 a,dace002 b where a.acta='$acta' and a.lapso='$lapso' and a.EXP_E=b.EXP_E and a.c_asigna='$c_asigna' order by b.apellidos asc";
			$conex->ExecSQL($mSQL,__LINE__,true);
			$result = $conex->result;
			
$cantalu=0;
			while($result[$cantalu][0]!=NULL)
				{
$mSQL  = "INSERT INTO N_ESTU (ACTA,LAPSO,C_ASIGNA,EXP_E,STATUS) VALUES ('$acta','$lapso','$c_asigna','".$result[$cantalu][0]."','".$result[$cantalu][2]."')";
$conex->ExecSQL($mSQL,__LINE__,true);
			$cantalu++;
				}
		?>	
			<body Onload="document.form2.action='cante.php'; document.form2.submit(); alert('Se ha cargado correctamente'); ">
				<form name="form2" method="post" action="" >
	 				<input type="hidden" name="acta" value="<?PHP echo $acta; ?>">
	  				 <input type="hidden" name="lapso" value="<?PHP echo $lapso; ?>">
	 				 <input type="hidden" name="c_asigna" value="<?PHP echo $c_asigna; ?>">
					 </form>					 
			<?PHP
}



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//CODIOS PARA LA PARTE DE VER TODOS LOS AVANCES ACADEMICOS(JEFES)...

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



if($codigos==112232) //fajax para mostrar la seleccion de una seccion
{	
$carrera=$_POST['carrera'];
$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
			if($carrera==1) $mSQL  = "select distinct c.asignatura,a.c_asigna,b.pensum from tblaca004 a,tblaca009 b,tblaca008 c where a.c_asigna like '300%' and b.pensum='5' and c.c_asigna=a.c_asigna order by c.asignatura asc";
			
			if($carrera==2) $mSQL  = "select distinct c.asignatura,a.c_asigna,b.pensum from tblaca004 a,tblaca009 b,tblaca008 c where a.c_asigna like '311%' and b.pensum='5' and c.c_asigna=a.c_asigna order by c.asignatura asc";
			
			if($carrera==3) $mSQL  = "select distinct c.asignatura,a.c_asigna,b.pensum from tblaca004 a,tblaca009 b,tblaca008 c where a.c_asigna like '355%' and b.pensum='5' and c.c_asigna=a.c_asigna order by c.asignatura asc";
			
			if($carrera==4) $mSQL  = "select distinct c.asignatura,a.c_asigna,b.pensum from tblaca004 a,tblaca009 b,tblaca008 c where a.c_asigna like '322%' and b.pensum='5' and c.c_asigna=a.c_asigna order by c.asignatura asc";
			
			if($carrera==5) $mSQL  = "select distinct c.asignatura,a.c_asigna,b.pensum from tblaca004 a,tblaca009 b,tblaca008 c where a.c_asigna like '333%' and b.pensum='5' and c.c_asigna=a.c_asigna order by c.asignatura asc";
			
			if($carrera==6) $mSQL  = "select distinct c.asignatura,a.c_asigna,b.pensum from tblaca004 a,tblaca009 b,tblaca008 c where a.c_asigna like '340%' and b.pensum='5' and c.c_asigna=a.c_asigna order by c.asignatura asc";
						
			
			$conex->ExecSQL($mSQL,__LINE__,true);
			$result = $conex->result;
			?>	
			<select name="selectma" id="selectma" class="select.peq" OnChange=	"fajax('guardar.php','secciones','codigos=112233&c_asigna='+this.value+'','post','0');">
            <option value="" selected="selected">&lt;&lt; Materias &gt;&gt;</option>
			<?PHP 
			$cantalu=0;
			while($result[$cantalu][0]!=NULL)
				{
				echo '<option value="'.$result[$cantalu][1].'">'.$result[$cantalu][0].'</option>'; 
				$cantalu++;
				} 
			?>
          </select><br><br><div id="secciones">
</div><br><br><?PHP
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($codigos==112233) //fajax para mostrar la seleccion de una seccion
{	
		
			$c_asigna=$_POST['c_asigna'];
			$mSQL  = "select seccion from tblaca004 where c_asigna='$c_asigna' order by seccion asc";
			$conex->ExecSQL($mSQL,__LINE__,true);
			$resulta = $conex->result;
	if($resulta[0][0]!=NULL){	
	?> 
	<select name="selectsec" id="selectsec" class="select.peq" OnChange="fajax('guardar.php','opcion','codigos=112234&seccion='+this.value+'&c_asigna=<?PHP echo $c_asigna; ?>','post','0');">
            <option value="" selected="selected">&lt;&lt; Materias &gt;&gt;</option> <?PHP				
	$cant=0;
			while($resulta[$cant][0]!=NULL)
				{
				echo '<option value="'.$resulta[$cant][0].'">'.$resulta[$cant][0].'</option>'; 
				$cant++;
				} 
	echo ' </select><br><br><div id="opcion">
</div><br>';
	}else echo 'Esta materia no esta activa actualmente';
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($codigos==112234) //fajax para mostrar la seleccion de una seccion
{	
		
		$c_asigna=$_POST['c_asigna'];
		$seccion=$_POST['seccion'];
		$mSQL  = "select acta from tblaca004 where c_asigna='$c_asigna' and lapso='$lapsoProceso' and seccion='$seccion'";
			$conex->ExecSQL($mSQL,__LINE__,true);
			$resul = $conex->result;
		$acta=$resul[0][0];
	?> 
	
	<select name="selectsec" id="selectsec" class="select.peq" OnChange="fajax('guardar.php','visual','codigos=112235&opcion='+this.value+'&c_asigna=<?PHP echo $c_asigna; ?>&acta=<?PHP echo $acta; ?>&lapso=<?PHP echo $lapsoProceso; ?>','post','0');">
            <option value="" selected="selected">&lt;&lt; Opciones a consultar &gt;&gt;</option> 
			<option value="1">Avance Academico</option> 
			<option value="2">Tabla de Modificaciones</option>
			</select>
			<?PHP				
	
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($codigos==112235) //fajax para mostrar la seleccion de una seccion
{	
$c_asigna=$_POST['c_asigna'];
		$acta=$_POST['acta'];
		$lapso=$_POST['lapso'];
		$opcion=$_POST['opcion'];
		if($opcion==2){
		$modn=saca_modn($acta,$lapso,$c_asigna);
$modp=saca_modp($acta,$lapso,$c_asigna);
$modt=saca_modt($acta,$lapso,$c_asigna);
$modct=saca_modct($acta,$lapso,$c_asigna);
$info=sacainfo($acta,$lapso,$c_asigna);
?>
<table>
  <tr><td><?PHP include("datosdemateria.php"); ?></td></tr>
  <tr>
    <td height="32"  colspan="8" class="datosp">
	<p>Los datos que se encuentran en el sistema sosn los siguientes:</p>
	<table border="2" width="100%" class="datotabla">
	<tr><td class="datona">
	<p class="encna"><strong>TEMAS AGREGADOS</strong></p>
	<hr size="1">
		<?php
		$cont=0;
		while($modct[$cont][8]!=NULL){
		if($modct[$cont][4]!=NULL){
		echo '<u>Se realizo en la evaluacion Nro</u> :&nbsp;'.$modct[$cont][7].'<br>';
		//echo '<u>Razon de el cambio</u> :&nbsp;'.$modct[$cont][0].'<br>';
		echo '<u>La cantidad anterior de evaluaciones era</u> :&nbsp;'.$modct[$cont][1].'<br>';
		echo '<u>La cantidad actual de evaluaciones es</u> :&nbsp;'.$modct[$cont][2].'<br>';
		echo '<u>La evaluacion agregada es</u> :&nbsp;'.$modct[$cont][4].'<br>';
		echo '<u>Que tiene un valor de</u> :&nbsp;'.$modct[$cont][6].'<br>';
		echo '<u>Fecha en que se agrego la evaluacion</u> :&nbsp;'.implode("/",array_reverse(explode("-",$modct[$cont][8]))).'<br>';
		echo '<hr size="1">';
		}
		$cont++;
		}
	?>
	</td></tr>
	<tr><td class="datona" >
	<p class="encna"><strong>TEMAS ELIMINADOS</strong></p>
	<hr size="1">
		<?php
		$cont=0;
		while($modct[$cont][8]!=NULL){
		if($modct[$cont][3]!=NULL){
		echo '<u>Se realizo en la evaluacion Nro</u> :&nbsp;'.$modct[$cont][7].'<br>';
		echo '<u>Razon de por que se elimino</u> :&nbsp;'.$modct[$cont][0].'<br>';
		echo '<u>La cantidad anterior de evaluaciones era</u> :&nbsp;'.$modct[$cont][1].'<br>';
		echo '<u>La cantidad actual de evaluaciones es</u> :&nbsp;'.$modct[$cont][2].'<br>';
		echo '<u>La evaluacion eliminada fue</u> :&nbsp;'.$modct[$cont][3].'<br>';
		echo '<u>Que tiene un valor de</u> :&nbsp;'.$modct[$cont][5].'<br>';
		echo '<u>Fecha en que se elimino la evaluacion</u> :&nbsp;'.implode("/",array_reverse(explode("-",$modct[$cont][8]))).'<br>';
		echo '<hr size="1">';
		}
		$cont++;
		}
	?>
	</td></tr>
	<tr><td class="datona">
	<p class="encna"><strong>MODIFICACIONES A LA DESCRIPCION DE LOS TEMAS</strong></p>
	<hr size="1">
		<?php
		//require_once("inc/odbcss_c.php");
		$cont=0;
		while($modt[$cont][4]!=NULL){
		echo '<u>Se realizo en la evaluacion Nro</u> :&nbsp;'.$modt[$cont][3].'<br>';
		echo '<u>Razon de el cambio</u> :&nbsp;'.$modt[$cont][0].'<br>';
		echo '<u>Descripcion original</u> :&nbsp;'.$modt[$cont][1].'<br>';
		echo '<u>Descripcion modificada</u> :&nbsp;'.$modt[$cont][2].'<br>';
		echo '<u>Fecha de modificacion</u> :&nbsp;'.implode("/",array_reverse(explode("-",$modt[$cont][4]))).'<br>';
		echo '<hr size="1">';
		$cont++;
		}
	?>
	</td></tr>
	<tr><td class="datona">
	<p class="encna"><strong>MODIFICACIONES AL PORCENTAJE DE LOS TEMAS</strong></p>
	<hr size="1">
		<?php
		//require_once("inc/odbcss_c.php");
		$cont=0;
		while($modp[$cont][4]!=NULL){
		echo '<u>Se realizo en la evaluacion Nro</u> :&nbsp;'.$modp[$cont][3].'<br>';
		echo '<u>Razon de el cambio</u> :&nbsp;'.$modp[$cont][0].'<br>';
		echo '<u>Porcentaje original</u> :&nbsp;'.$modp[$cont][1].'<br>';
		echo '<u>Porcentaje modificada</u> :&nbsp;'.$modp[$cont][2].'<br>';
		echo '<u>Fecha de modificacion</u> :&nbsp;'.implode("/",array_reverse(explode("-",$modp[$cont][4]))).'<br>';
		echo '<hr size="1">';
		$cont++;
		}
	?>
	</td></tr>
	<tr><td  class="datona">
	<p class="encna"><strong>MODIFICACIONES A LAS CALIFICACIONES DE ESTUDIANTES</strong></p>
	<hr size="1">
	<?php
	//require_once("inc/odbcss_c.php");
	//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
	$cont=0;
	while($modn[$cont][4]!=NULL){
	$mSQL  = "select apellidos||',  '||nombres from dace002 where EXP_E='".$modn[$cont][4]."'";
	$conex->ExecSQL($mSQL,__LINE__,true);
	$result = $conex->result;
	echo '<u>Nombre de alumno</u> :&nbsp;'.$result[0][0].'&nbsp;&nbsp;&nbsp;<u>C.I</u>:&nbsp;&nbsp;'.$modn[$cont][4].'<br>';
	echo '<u>Razon de el cambio</u> :&nbsp;'.$modn[$cont][0].'<br>';
	echo '<u>Calificacion original</u> :&nbsp;'.$modn[$cont][1].'<br>';
	echo '<u>Calificacion modificada</u> :&nbsp;'.$modn[$cont][2].'<br>';
	echo '<u>Se realizo en la evaluacion Nro</u> :&nbsp;'.$modn[$cont][3].'<br>';
	echo '<u>Fecha de modificacion</u> :&nbsp;'.implode("/",array_reverse(explode("-",$modn[$cont][5]))).'<br>';
	echo '<hr size="1">';
	$cont++;
	}
	?>
	</td></tr>
	</table>
	</td>
  	</tr>
	</table>
	<?php	
		}
	if($opcion==1){	
	
	$datos=sacanotas($acta,$lapso,$c_asigna);
///////////////////////en observacion este codigo
$porc= array();
$tema= array();
			$resultado=con_ex_temas_car($acta,$lapso,$c_asigna);
			if($resultado!=NULL)
			{	
				//$cantee=$resultado[0][41];
				$cantee=$resultado[0][0];
				for($i=1;$i<=35;$i++) $tema[$i]=$resultado[0][$i];
				for($i=36,$j=1;$i<=70;$i++,$j++)	$porc[$j]=$resultado[0][$i];
			}
			
$asistentes=sacaasistentes($acta,$lapso,$c_asigna);
$inasistentes=sacainasistentes($acta,$lapso,$c_asigna);
$aprobados=sacaaprobados($acta,$lapso,$c_asigna);
$reprobados=sacareprobados($acta,$lapso,$c_asigna);
$fechas=sacafecha($acta,$lapso,$c_asigna);	
$info=sacainfo($acta,$lapso,$c_asigna);
///////////////////////////////////hasta aqui
//////////sacando todos los datos del ancabezado
?>
<script language="javascript" src="funciones.js" type="text/javascript"></script>
<table >
<tr><td><?PHP include("datosdemateria.php"); ?></td></tr>
  <tr>
    <td height="40" class="datosp" colspan="8">
	<p>Los datos que se encuentran en el sistema sosn los siguientes:</p>
	
	
	<?php
	echo  '<table border="1" cellspacing="1" class="datotabla">
					<tr><th rowspan="3" colspan="4">COMENTARIOS DE TEMAS</th></tr>
					<tr>';
					
					for($i=1;$i<=$cantee;$i++) echo'<td align="center" ><strong>EVALUACION&nbsp;'.$i.'</strong></td>';
					
	echo			'</tr>
					<tr>';
					
					for($i=1;$i<=$cantee;$i++) echo'<td align="center" width="200">'.$tema[$i].'</td>';
					
					echo'<td align="center" width="200" ><strong>TOTAL 100</strong></td><td align="center" width="200" ><strong>TOTAL 9</strong></td>';
					
	echo			'</tr>
					<tr>					
					<td align="center"  colspan="4"><strong>PORCENTAJES</strong></td>';
					
					for($i=1;$i<=$cantee;$i++) echo'<td align="center" >'.$porc[$i].'</td>';
					echo'<td align="center" width="200" ><strong>100%</strong></td><td align="center" width="200" ><strong>9</strong></td>';
					
	echo            '</tr>
					<tr><td align="center"><strong>NUM</strong></td><td align="center"><strong>STATUS</strong></td><td align="center"><strong>ALUMNOS</strong></td><td align="center" ><strong>C.I</strong></td></tr>';
					
				//recuerda obtener la longitud del vector
			
			
			if($datos[0][0]!=NULL){	
				$cantalu=0;
				$num=1;
			while($datos[$cantalu][0]!=NULL)
				{
			echo '<tr><td align="center">'.$num.'</td>';
			if($datos[$cantalu][39]!=7){
			if($datos[$cantalu][39]=='R') echo	'<td><strong>Ret. Reglam</strong></td>';
			if($datos[$cantalu][39]=='A') echo	'<td><strong>Agregado</strong></td>';
			if($datos[$cantalu][39]==2) echo	'<td><strong>Retirado</strong></td>';
			}
			else echo	'<td><strong></strong></td>';
				for($i=0;$i<=$cantee+1;$i++) echo '<td align="center">'.$datos[$cantalu][$i].'</td>';
				echo '<td align="center">'.$datos[$cantalu][37].'</td><td align="center">'.$datos[$cantalu][38].'</td>';
			echo '</tr>';
				$cantalu++;
				$num++;
				}
			echo '<tr><td colspan="4"><strong>%ASISTENTES</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$asistentes[0][$i].'</td>';
				echo '</tr>';
			echo '<tr><td colspan="4"><strong>%INASISTENTES</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$inasistentes[0][$i].'</td>';
				echo '</tr>';
			echo '<tr><td colspan="4"><strong>%APROBADOS</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$aprobados[0][$i].'</td>';
				echo '</tr>';
			echo '<tr><td colspan="4"><strong>%REPROBADOS</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$reprobados[0][$i].'</td>';
				echo '</tr>';
			echo '<tr><td colspan="4"><strong>FECHAS DE CARGA</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.implode("/",array_reverse(explode("-",$fechas[0][$i]))).'</td>';
				echo '</tr>';
				echo '</table>';}	
						
			else{
			//require_once("inc/odbcss_c.php");
//$conex = new ODBC_Conn($basededatos,$usuariodb,$clavedb,TRUE,$laBitacora);
$mSQL  = "select b.apellidos||',  '||nombres,a.EXP_E from dace006 a,dace002 b where a.acta='$acta' and a.lapso='$lapso' and a.EXP_E=b.EXP_E order by apellidos asc";
$conex->ExecSQL($mSQL,__LINE__,true);
$result = $conex->result;				
				$cantalu=0;
			while($result[$cantalu][0]!=NULL)
				{
			echo '<tr>';
				for($i=0;$i<=$cantee+1;$i++) echo '<td align="center">'.$result[$cantalu][$i].'</td>';
				echo '<td align="center">'.$result[$cantalu][22].'</td><td align="center">'.$result[$cantalu][23].'</td>';
			echo '</tr>';
				$cantalu++;
				}

			echo '<tr><td colspan="4"><strong>%ASISTENTES</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$asistentes[0][$i].'</td>';
				echo '</tr>';
			echo '<tr><td colspan="4"><strong>%INASISTENTES</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$inasistentes[0][$i].'</td>';
				echo '</tr>';
			echo '<tr><td colspan="4"><strong>%APROBADOS</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$aprobados[0][$i].'</td>';
				echo '</tr>';
			echo '<tr><td colspan="4"><strong>%REPROBADOS</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$reprobados[0][$i].'</td>';
				echo '</tr>';
			echo '<tr><td colspan="4"><strong>FECHAS DE CARGA</strong></td>';	
				for($i=0;$i<$cantee;$i++) echo '<td align="center">'.$fechas[0][$i].'</td>';
				echo '</tr>';
				echo '</table>';
			}

?>	
</td>
</tr>
</table>
<?php
	
	
	}			
	
}



/*$nota= array();
$porc= array();

	$desicion3=$_POST['desicion3'];
	if($desicion3=='si') ///////////////SI LA SE QUERIA .quiere guardar todos los datos despues de cargar todo
		{
		
		$cantee=$_POST['cantee'];
		$cantalu=$_POST['cantalu'];
		for($i=1;$i<=$cantee;$i++)
			{
			for($j=0;$j<$cantalu;$j++)
				{
				$nota[$i][$j]=$_POST['nota'.$i.'-'.$j];
				}
			}

		echo $nota[1][0].'---'.$nota[2][4];
	
		
		}
	else
		{
		//si dijo que no a guardar despues de cargar todos los datos
		}
*/


?>
</html>
