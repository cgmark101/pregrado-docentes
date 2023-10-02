<table width="700" border="0" align="center">
  <tr>
  <td colspan="7"><a class=inact2><span>LAS ACTAS DE PRÁCTICA PROFESIONAL CARGADAS POR EXPERIENCIA PROFESIONAL TIENEN UN ASTERISO (*) PARA IDENTIFICARLAS.</span></td>
   </tr>
  <tr>
  <td colspan="6" class="sub_tabla" ><p>&nbsp;</p>
	
    <p>Actas Cargadas <br />
      Asignaturas que puede seleccionar: </p>
  </div></td>
  <FORM METHOD=POST ACTION="v_acta_fun.php">
	
  
  <td class="datosp" WIDTH="20"><strong>ORDENAR POR:<br /><SELECT name="orden">
	<OPTION VALUE="1" SELECTED>ESPECIALIDAD</OPTION>
	<OPTION VALUE="2">SECCIÓN</OPTION>
	<OPTION VALUE="3">ACTA</OPTION>
	<OPTION VALUE="4">ASIGNATURA</OPTION>
    <OPTION VALUE="5">LAPSO</OPTION>
	<OPTION VALUE="7">FECHA</OPTION>
  </SELECT></strong><br /><INPUT TYPE="submit" value="Ordenar" class="boton"></FORM></td>
  </tr>
<tr> 
   <FORM METHOD=POST NAME="MOSTRAR" ACTION="v_acta.php" target="reporte_acta">
	<td class="enc_p" align="center"><strong>FECHA</strong></td>
    <td class="enc_p" align="center"><strong>LAPSO</strong></td>
	<td align="center" class="enc_p">C&Oacute;DIGO</td>
	<td align="center" class="enc_p">ESPECIALIDAD</td>
    <td class="enc_p" align="center">ASIGNATURA</td>
    <td class="enc_p" align="center">SECCI&Oacute;N </td>
    <td class="enc_p2" align="center">N&Uacute;MERO DE  ACTA  </td>
  </tr>
  

<?php
//verifico user para declarar sentencias SQL
if($user=='0'): //super_usuario
$dSQL="SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,a.status,d.his_fec,e.carrera1  
FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
WHERE d.his_lap BETWEEN '$rLapso' AND '$tLapso' and a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and e.c_uni_ca=b.c_uni_ca
UNION
SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,a.status,d.his_fec,e.carrera1    
FROM dace004 a,tblaca009 b,tblaca008 c,his_act d,tblaca010 e
WHERE d.his_lap BETWEEN '$rLapso' AND '$tLapso' and a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and a.c_asigna='300622' and b.c_asigna=c.c_asigna AND e.c_uni_ca='5' ORDER BY $orden DESC";

elseif($user=='7'): //entrenamiento industrial

$dSQL="SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,a.status,d.his_fec,e.carrera1 
FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and b.c_asigna='322939' and e.c_uni_ca=b.c_uni_ca
UNION
SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,a.status,d.his_fec,e.carrera1
FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and a.c_asigna='311939' and e.c_uni_ca=b.c_uni_ca
UNION
SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,a.status,d.his_fec,e.carrera1 
FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and a.c_asigna='333939' and e.c_uni_ca=b.c_uni_ca
UNION
SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,a.status,d.his_fec,e.carrera1 
FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and a.c_asigna='355069' and e.c_uni_ca=b.c_uni_ca
UNION
SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,a.status,d.his_fec,e.carrera1
FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and a.c_asigna='344939' and e.c_uni_ca=b.c_uni_ca
ORDER BY $orden DESC";

elseif($user=='1'): // servicio comunitario

$dSQL="SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,a.status,d.his_fec,e.carrera1 FROM dace004 a,tblaca009 b,tblaca008 c,his_act d,tblaca010 e
WHERE d.his_lap BETWEEN '$rLapso' AND '$tLapso' and a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and a.c_asigna='300622' and b.c_asigna=c.c_asigna AND e.c_uni_ca='5' ORDER BY $orden DESC";

else: // trabajo de grado 

$dSQL="SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,a.status,d.his_fec,e.carrera1 
FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and b.c_asigna='322040' and e.c_uni_ca=b.c_uni_ca
UNION
SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,a.status,d.his_fec,e.carrera1
FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and a.c_asigna='311040' and e.c_uni_ca=b.c_uni_ca
UNION
SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,a.status,d.his_fec,e.carrera1 
FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and a.c_asigna='333040' and e.c_uni_ca=b.c_uni_ca
UNION
SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,a.status,d.his_fec,e.carrera1 
FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and a.c_asigna='355959' and e.c_uni_ca=b.c_uni_ca
UNION
SELECT DISTINCT a.c_asigna,d.his_sec,a.acta ,c.asignatura,a.lapso,a.status,d.his_fec,e.carrera1
FROM dace004 a,tblaca009 b,tblaca008 c,his_act d, tblaca010 e
WHERE a.acta=d.his_act and a.lapso=d.his_lap and a.c_asigna=d.his_cod and a.c_asigna=b.c_asigna and b.pensum='5' and b.obligatoria='1' and b.c_asigna=c.c_asigna and a.c_asigna='344040' and e.c_uni_ca=b.c_uni_ca
ORDER BY $orden DESC";

endif;

//Se consultan las actas de las obligatorias en his_act
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = $dSQL;
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
for($i=0; $i < count($result); $i++) {
$cod[$i]=$result[$i][0];
$sec[$i]=$result[$i][1];
$act[$i]=$result[$i][2];
$asigna[$i]=$result[$i][3];
$lapso[$i]=$result[$i][4];
$fec[$i]=$result[$i][6];
$especial[$i]=$result[$i][7];
$fec[$i]=implode('/',array_reverse(explode('-',$fec[$i])));
if($user=='0'):
	$status[$i]=$result[$i][5];
if($status[$i]=='3'):
	$status[$i]='(*)';
else:
	$status[$i]=' ';
endif;
else:
	$status[$i]=' ';
endif;
if($cod[$i]=='300622'):
	$especial[$i]='COMÚN';
else:
	$especial[$i]=$result[$i][7];
endif;

?><tr>
		  <td class="datosp"><?php echo $fec[$i];?></td>
		  <td class="datosp"><?php echo $lapso[$i];?></td>
		  <td class="datosp"><strong><?php echo $cod[$i]; ?></strong></td>
		  <td class="datosp"><?php echo $especial[$i];?></td>
		  <td class="datosp"><span class="alert2"><a class=Ntooltip><?php echo $status[$i]; ?><span>ACTA CARGADA POR EXPERIENCIA PROFESIONAL</span></span><?php echo $asigna[$i];?></td>
		  <td class="datosp"><?php  echo $sec[$i];  ?></td>
          <td class="inact2"><INPUT TYPE="radio" NAME="acta" VALUE="<?php  echo $act[$i];echo '_'; echo $lapso[$i]; echo '_'; echo $cod[$i]; ?>"><?php  echo $act[$i]; ?></td>
          
  </tr>
<?php } ?>


		
 
 




<table width="800" border="0" align="center">
<tr>
<td class="datospd">
         
                                   
      
                                    
                        <INPUT TYPE="button" value="Ver Acta" name="MOSTRAR" class="boton" onclick="ver_acta(this.form)">
							<input value="<?php echo $ced; ?>" name="ced" type="hidden"> 	                       
                   
				
      
			

</td>
</tr>
</table>
</FORM>
