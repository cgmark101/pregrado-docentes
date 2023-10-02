<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	
<?php




include_once ('inc/vImage.php');
include_once ('inc/odbcss_c.php');
include_once ('inc/config.php');
include_once ('inc/activaerror.php');

if(@$_SERVER['HTTP_REFERER']!=$raizDelSitio.'visual.php') die ("<script languaje=\"javascript\"> alert('ACCESO PROHIBIDO!'); </script>");

$lista_e = array();

$fecha  = date('Y-m-d', time() - 3600*date('I'));
$hora   = date('h:i a', time() - 3600*date('I'));

?>

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
.boton {
  text-align: center; 
  font-family:Arial; 
  font-size: 11px;
  font-weight: normal;
  background-color:#e0e0e0; 
  font-variant: small-caps;
  height: 20px;
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
  color:#000000;
  text-align: center; 
  font-family:Helvetica; 
  font-size: 11px; 
  font-weight: bold;
  height:20px;
  font-variant: small-caps;
}
.inact {
  text-align: center; 
  font-family:Arial; 
  font-size: 11px; 
  font-weight: normal;
  
}
.inact2 {
  text-align: left; 
  font-family:Arial; 
  font-size: 11px; 
  font-weight: normal;
  padding-left: 10px;
 
}
.inact3 {
  text-align: left; 
  font-family:Arial; 
  font-size: 9px; 
  font-weight: normal;
  background-color:#F0F0F0;
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
.datosp {
  text-align: left; 
  font-family:Arial; 
  font-size: 11px;
  font-weight: normal;
  font-variant: small-caps;
}

-->
</style>



<?php

if(isset($_GET['acta']) && isset($_GET['cedula'])) {
	
	$acta=$_GET['acta'];
	$cedula=$_GET['cedula'];
	$nombre=$_GET['nombre'];

	/*print $acta;
	print $cedula;*/

}ELSE echo "<script>document.location.href='../list_est';</script>\n";
//NUMERO DE ACTAS
$Ccont = new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
$mSQL = "select distinct count(*) ";
$mSQL= $mSQL."from tblaca004 a ";
$mSQL= $mSQL."where ci='$cedula' and ";
$mSQL= $mSQL."a.lapso='$lapsoProceso'  ";
$Ccont->ExecSQL($mSQL,__LINE__,true);
$reg=$Ccont->result;
foreach($reg as $reg1){}
$reg2=$reg1[0]-1;

//Consulta Anterior
$Cact = new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
$mSQL = "select distinct a.acta ";
$mSQL= $mSQL."from tblaca004 a,tblaca008 c,dace006 d ";
$mSQL= $mSQL."where a.c_asigna=c.c_asigna and ci='$cedula' and ";
$mSQL= $mSQL."a.lapso='$lapsoProceso' and a.c_asigna=d.c_asigna and ";
$mSQL= $mSQL."a.lapso=d.lapso and a.acta=d.acta and (d.status='7' or d.status='A') ";
$Cact->ExecSQL($mSQL,__LINE__,true);
$actass=$Cact->result;

//if ($reg2 == -1){echo "<script>document.location.href='error.php';</script>\n";}

$sw='0';
for ($i=0;$i<=$reg2;$i++){
	//print $actass[$i][0];
	if ($acta == $actass[$i][0]){
		$sw='0';break;
	}else $sw='1';
	
}
//print $acta;
//print $sw;
if ($sw == '1') { 
	print "ERROR";
	echo "<script>document.location.href='../notas/error.php';</script>\n";
}

/*foreach ($actass as $n){
		for ($i=1;$i<=2;$i++){
			
			
		}
	}*/


//print_r($HTTP_POST_VARS);

//Lista de Estudiantes
$Cmat = new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
$mSQL = "select a.exp_e,a.apellidos,a.nombres,b.acta,b.c_asigna,";
$mSQL= $mSQL."c.asignatura,b.seccion,e.ci,e.apellido,e.nombre,b.status,a.apellidos2,a.nombres2 ";
$mSQL= $mSQL."from dace002 a,dace006 b,tblaca008 c,tblaca007 e,tblaca004 f ";
$mSQL= $mSQL."where b.lapso='$lapsoProceso' and a.exp_e=b.exp_e ";
$mSQL= $mSQL."and  b.acta ='$acta' and b.c_asigna=c.c_asigna and f.ci='$cedula' ";
$mSQL= $mSQL."and b.c_asigna=f.c_asigna and b.lapso=f.lapso and b.seccion=f.seccion ";
$mSQL= $mSQL."and b.acta=f.acta and f.ci=e.ci and (b.status='7' or b.status='A' or b.status='2' or b.status='R') order by 2";
$Cmat->ExecSQL($mSQL,__LINE__,true);
$lista_e=$Cmat->result;

foreach ($lista_e as $est){
	$secc = $est[6];
	$acta = $est[3];
	$cidoc = $est[7];
	$nombdoc = $est[9];
	$apedoc = $est[8];
	$asig = $est[5];
	$cod = $est[4];
}


?>
<title><? print $nombdoc."  ".$apedoc." - ".$asig." - ".$lapsoProceso ?></title>
<script type="text/javascript" src="jquery.js"></script>
</head>
<body <?=$botonDerecho?>>



<SCRIPT LANGUAGE="JavaScript">
<!--
function validarN(campo) {

	var cadena = campo.value;
    var nums="1234567890.";
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

function validarNota(campo) {

	if (campo.value > 0 && campo.value < 1){
		alert("NOTA NO VALIDA")
		campo.value = ""
		}
	if (campo.value > 9)
		{alert("NOTA NO VALIDA")
		campo.value = ""
		}
	if (campo.value == '')
		{alert("DEBE INTRODUCIR UNA NOTA")
		}
}

function AJAXCrearObjeto(){ 
 var obj; 
 
 if(window.XMLHttpRequest) 
 	{ // no es IE 
 	obj = new XMLHttpRequest(); 
 	} 
	else 
	{ // Es IE o no tiene el objeto 
 		try { 
			 obj = new ActiveXObject("Microsoft.XMLHTTP"); 
		    } 
 		catch (e) { 
 					alert('El navegador utilizado no está soportado'); 
 				  } 
 	} 
 //alert ("objeto creado");
 return obj; 
} 

function fajax(url,capa,valores,metodo,xml) //xml=1 (SI) xml=0 (NO)
{
	//alert('capa: '+capa);
	
	var ajax=AJAXCrearObjeto();
	var capaContenedora = document.getElementById(capa);
	
	//alert('capa contenedora: '+capaContenedora);
	
	if (capaContenedora.type == "text"){
		texto = true;
	}else{
		texto = false;
	}
	//texto = true;
	var contXML;
	/* Creamos y ejecutamos la instancia si el metodo elegido es POST */
	if (metodo.toUpperCase()=='POST')
	{

		ajax.open ('POST', url, true);
		ajax.onreadystatechange = function() 
		{
			if (ajax.readyState==1) 
			{
				capaContenedora.innerHTML="cargando <img src='loader.gif'>";
			}
			else if (ajax.readyState==4)
			{
				if (ajax.status==200)
				{
					if (xml==0)
					{	
						if (texto){
							document.getElementById(capa).value=ajax.responseText;
						}
						document.getElementById(capa).innerHTML=ajax.responseText;
					}
					if (xml==1)
					{

     					var Contxml  = ajax.responseXML.documentElement;
	   					var items = Contxml.getElementsByTagName('nota')[0];
       					var txt = items.getElementsByTagName('destinatario')[0].firstChild.data; 
						document.getElementById(capa).innerHTML=txt;
						
						
					}
				}
				else if (ajax.readyState=404)
				{
					capaContenedora.innerHTML = "cargando... <img src='loader.gif'>";
				}
				else
				{
					capaContenedora.innerHTML="Error: "+ajax.status;
				}
			}
		}
	
		ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		ajax.send(valores);
		return;
	}
	/* Creamos y ejecutamos la instancia si el metodo elegido es GET */
	if (metodo.toUpperCase()=='GET')
	{
		ajax.open ('GET', url, true);
		ajax.onreadystatechange = function() 
		{
			if (ajax.readyState==1) 
			{
				capaContenedora.innerHTML="<img src='loader.gif'>";
			}
			else if (ajax.readyState==4)
			{
				if (ajax.status==200)
				{
					if (xml==0)
					{
						document.getElementById(capa).innerHTML=ajax.responseText;
					}
					if (xml==1)
					{
						alert(ajax.responseXML.getElementsByTagName("nota")[0].childNodes[1].nodeValue); 
					}
				}
				else if (ajax.readyState=404)
				{
					capaContenedora.innerHTML = "La direccion no existe";
				}
				else
				{
					capaContenedora.innerHTML="Error: "+ajax.status;
				}
			}
		}
	
		ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		ajax.send(null);
		return;
	}
}

function busca_grupo(c_asigna,seccion,grupo) {
	fajax('busca_grupo.php','lista','c_asigna='+c_asigna+'&seccion='+seccion+'&grupo='+grupo,'post','0');
}

//-->
</SCRIPT>

<script language="javascript">
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
});
</script>


<table align="center" border="0" cellpadding="0" cellspacing="1" width="760"> 
	<tr>
		<td class="inact"><IMG SRC="../imagenes/unex15.gif" WIDTH="75" HEIGHT="75" BORDER="0" ALT="">
		</td>
		
		<td class="inact">Universidad Nacional Experimental Polit&eacute;cnica<BR>"Antonio Jos&eacute; de Sucre"<BR>Vicerrectorado&nbsp;<? print $vicerrectorado?><BR><? print $nombreDependencia  ?><BR> <? print $tProceso ?>&nbsp;Lapso&nbsp;<? print $lapsoProceso ?>
		</td>
		<td bgcolor="#A7A7A7">&nbsp</td>
		
		<td class="datosp">
			<B>Fecha:</B>&nbsp;<?echo date("d/m/Y");?>&nbsp;<?echo $hora?><BR>
			<B>Lapso</B>:&nbsp;<? print $lapsoProceso ?><BR>
			<B>Docente:</B>&nbsp;<? print $nombdoc?>&nbsp;&nbsp;<? print $apedoc ?>&nbsp;<B>CI:</B>&nbsp;<? print $cidoc ?><BR>
			<B>Asignatura:</B>&nbsp;<? print $asig?>&nbsp;&nbsp;<B>C&oacute;digo:&nbsp;</B><?print $cod?><BR>
			<B>Secci&oacute;n:</B>&nbsp;<? print $secc?>&nbsp;&nbsp;
			<B>Acta:</B>&nbsp;<? print $acta ?>	 <BR>
			<B>Generado por:</B>&nbsp;<? print $nombre ?>	 <BR>
		</td>
	</tr>
</table><br>
<div align="center" style="font-family:arial;padding-left:0px;">
<?php

//grupos de lab
$conex = new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
$mSQL = "SELECT grupo ";
$mSQL.= "FROM tblaca004_lab ";
$mSQL.= "WHERE lapso='$lapsoProceso' AND c_asigna='$cod' AND seccion='$secc' AND inscritos>0 ";
$conex->ExecSQL($mSQL,__LINE__,true);
$grupos = $conex->result;

//echo "grupos ".count($grupos);
//$total=$Cmat->filas;

if (count($grupos) > 0){
	echo "Listado por Grupos: <input type=\"button\" value=\"TODOS\" onclick=\"busca_grupo('$cod','$secc','123');\">&nbsp;&nbsp;";

for($i=0;$i<count($grupos);$i++){

print <<<GRUPO_LAB
	<input type="button" value="GRUPO {$grupos[$i][0]}" onclick="busca_grupo('$cod','$secc','{$grupos[$i][0]}');">&nbsp;&nbsp;
GRUPO_LAB;

	
}

}


	
?>
</div>

<BR>
<div align="center">
<form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
<input type="button" value="Exportar a Excel" class="botonExcel"><br>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>
</div>
<table id="Exportar_a_Excel" align="center"><tr><td>
<div id="lista">
<table align="center" border="1" cellpadding="0" cellspacing="1" width="800" style="border-collapse: collapse;border-color:black;">


	<tr bgcolor="#FFFFFF" class="enc_p2">
		<td style="width: 30px;">NRO</td>
		<td style="width: 100px;">EXPEDIENTE</td>
		<td style="width: 150px;">APELLIDOS</td>
		<td style="width: 150px;">NOMBRES</td>
		<td style="width: 100px;">ESTATUS</td>
		<td style="width: 230px;">CORREO</td>
	</tr>
			<?php
			$nota=array();
			$nro=0;
			foreach ($lista_e as $est){
				$nro++;
				$nota[$nro]=$nro;
				print "<tr>";
				print "<td><div class=\"inact\">$nro</div></td>";
				print "<td><div class=\"inact\">$est[0]</div></td>";//expediente
				print utf8_encode("<td><div class=\"inact2\">$est[1] $est[11]</div></td>");
				print utf8_encode("<td><div class=\"inact2\">$est[2] $est[12]</div></td>");
				if ($est[10] == 'A'){
					print "<td><div class=\"inact\">AGREGADO(A)</div></td>";
				}elseif ($est[10] == '2'){
					print "<td><div class=\"inact\">RETIRADO(A)</div></td>";
				}elseif ($est[10] == 'R'){
					print "<td><div class=\"inact\">RETIRADO(A) POR REGLAMENTO</div></td>";
				}else{
					print "<td><div class=\"inact\">&nbsp;</div></td>";
				}
			
				$mSQL = "SELECT correo_inst ";
				$mSQL.= "FROM dace002 ";
				$mSQL.= "WHERE exp_e='$est[0]' ";
				$conex->ExecSQL($mSQL,__LINE__,true);
				
				$correo = $conex->result[0][0];

				print "<td><div class=\"inact2\">$correo</div></td>";

				print "</tr>";
			}
		?>
	<tr><td colspan="7" bgcolor="#000000" align="center"></td></tr></table>


<?php 

//Lista de Estudiantes en COLA
$Cmat = new ODBC_Conn("CENTURA-DACE","N","N",$ODBCC_conBitacora, $laBitacora);
$mSQL = "select a.exp_e,a.apellidos,a.apellidos2,a.nombres,a.nombres2,b.status ";
$mSQL.= "from dace002 a,dace006 b ";
$mSQL.= "where b.lapso='$lapsoProceso' and a.exp_e=b.exp_e and b.acta ='$acta' ";
$mSQL.= "and b.status IN ('Y','E') ORDER BY nro_prof";
$Cmat->ExecSQL($mSQL,__LINE__,true);
$lista_e=$Cmat->result;
$total=$Cmat->filas;

if($total > 0){
	?>

<BR>
<table align="center" border="1" cellpadding="0" cellspacing="1" width="660" style="border-collapse: collapse;border-color:black;">
	<tr bgcolor="#FFFF99" class="enc_p2">
		<td style="width: 650px;" colspan="6">ESTUDIANTES EN COLA (<?=$total?>)</td>
	</tr>

	<tr bgcolor="#99CCFF" class="enc_p2">
		<!-- <td style="width: 30px;">AGREGAR</td> -->
		<td style="width: 30px;">NRO</td>
		<td style="width: 100px;">EXPEDIENTE</td>
		<td style="width: 150px;">APELLIDOS</td>
		<td style="width: 150px;">NOMBRES</td>
		<td style="width: 130px;">ESTATUS</td>
	</tr>
		<?
			$nota=array();
			$nro=0;
			foreach ($lista_e as $est){
				$nro++;
				$nota[$nro]=$nro;
				print "<tr>";
				/*print "<td>
						<div class=\"inact\">
							<input type=\"checkbox\" name=\"$nro\" value=\"$est[0]\" disabled=\"disabled\">
						</div>
					   </td>";*/
				print "<td><div class=\"inact\">$nro</div></td>";
				print "<td><div class=\"inact\">$est[0]</div></td>";
				print "<td><div class=\"inact2\">$est[1] $est[2]</div></td>";
				print "<td><div class=\"inact2\">$est[3] $est[4]</div></td>";
				switch ($est[5]) {
					case 'Y':
						print "<td><div class=\"inact\">NO INSCRITO - EN COLA</div></td>";
						break;
					case 'E':
						print "<td><div class=\"inact\">INSCRITO - EN ESPERA POR CAMBIO DE SECCION</div></td>";
						break;
				}
				/*if (($est[5] == 'Y') || ($est[5] == 'E')){
					
				}*/
				print "</tr>";
			}
		?>
	<tr><td colspan="7" bgcolor="#000000" align="center"></td></tr></table>
</div>
</td></tr></table><!-- fin exportar -->


<table align="center" border="0" cellpadding="0" cellspacing="1" width="660" style="border-collapse: collapse;border-color:black;">
	<tr>
		<td valign="top" colspan="3">
			<p align="center">
				<BR><input type="button" value="Cerrar" name="cerrar" id="exit" class="boton" onClick="window.close();">
			</p> 
        </td>
		<td valign="top" colspan="3"><p align="center">
                        <BR><input type="reset" value="Imprimir" name="imprimir" class="boton" onclick="window.print();"></p> 
                    </td>
                </tr>
</table>
<?
}else {						 
?>
<table align="center" border="0" cellpadding="0" cellspacing="1" width="660" style="border-collapse: collapse;border-color:black;">
	<tr>
                    
                     <td valign="top" colspan="3"><p align="center">
                        <BR><input type="button" value="Cerrar" name="cerrar" id="exit" class="boton" 
                         onClick="window.close();"></p>
                    </td>
					<td valign="top" colspan="3"><p align="center">
                        <BR><input type="reset" value="Imprimir" name="imprimir" class="boton" onclick="window.print();"></p> 
                    </td>
                </tr>
</table>
<?
}					 
?>



</body>
</html>