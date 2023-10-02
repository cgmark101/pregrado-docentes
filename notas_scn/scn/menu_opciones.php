<?php //formulario fechas
error_reporting(E_ALL);
include_once('inc/config.php');
require_once('inc/odbcss_c.php');

//seleccionar siempre los 3 años anteriores al lapsoo actual
$rLapso=$tLapso-2; // aqui se cambia el rango de lapsos que se quieren mostrar 
 //consultamos los lapsos que existen en his_act
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT his_lap FROM his_act WHERE his_lap BETWEEN '$rLapso' AND '$tLapso' GROUP BY his_lap ORDER BY his_lap DESC";     
//echo $mSQL;
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;

?><head>
    <link rel="stylesheet" type="text/css" href="css/Ntooltip.css" />
    <link rel="stylesheet" href= "css/estilo.css"  type="text/css" media="screen">
	<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
 	<script type="text/javascript">


jQuery(function($){
	$.datepicker.regional['es'] = {
		closeText: 'Cerrar',
		prevText: '&#x3c;Ant',
		nextText: 'Sig&#x3e;',
		currentText: 'Hoy',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
		'Jul','Ago','Sep','Oct','Nov','Dic'],
		dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
		dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
		weekHeader: 'Sm',
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['es']);
});    

        $(document).ready(function() {
		  // obtenemos la fecha actual
    var date = new Date();
    var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
		
   	//inicializamos un datapicker por cada input
           $("#datepicker").datepicker({dateFormat:"yy-mm-dd",changeYear: true});
		   $("#datepicker2").datepicker({dateFormat:"yy-mm-dd",changeYear: true});
        });
    </script>
	
 <script language="JavaScript"> 

function habilita1(){ 
    document.rango.lap.disabled = false; 
   } 

function deshabilita1(){ 
    document.rango.lap.disabled = true; 
    document.rango.lap.value = ""; 
	}
	
function habilita2(){ 
    document.rango.fecha.disabled = false; 
	document.rango.fecha2.disabled = false;
   } 
   
function deshabilita2(){ 
    document.rango.fecha.disabled = true; 
    document.rango.fecha.value = ""; 
	document.rango.fecha2.disabled = true; 
    document.rango.fecha2.value = ""; 
   } 

  </script> 
</head>

<table width="720" border="0" align="center">
<tr>
<td colspan="5" class="legend">Elegir Actas para Visualizar</td>
</tr>
<form action="v_acta_orden.php" name="rango" method="POST">
<tr>
<td class="datospn"><input id="" type="radio" name="B1" value="1" onclick="habilita1() || deshabilita2()" <?php echo $chec1; ?>/>
<label for=""><a class=Ntooltip>Por Lapso<span>Muestra las actas por el orden de lapso en el que fueron cargadas </span>
</a></label></td>

<td class="datospn"><select name="lap" id="lap" onclick="habilita1() || deshabilita2()">
<?php 


for($i=0; $i < count($result); $i++) {
	if($lap==$result[$i][0]):
$sel='SELECTED';
else:
$sel=' ';
endif;?>
  <option <?php echo $sel; ?> ><?php echo $result[$i][0];?></option>
 
 <?php }?>

</select></td>
<td colspan="3" class="datospn"></td>
</tr>
<tr>
<td class="datospn"><span class="">
<input id="" type="radio" name="B1" value="2" onclick="habilita2() || deshabilita1()" <?php echo $chec2; ?>/><a class=Ntooltip>Por Rango<span>Muestra las actas por el rango de fecha seleccionado </span>
</a></label></td>
<td class="datospn">Desde:</td>
<td class="datospn">
<input name="fecha" class=":required :only_on_submit" type="text" value="" maxlength="10" id="datepicker" readonly="readonly" onclick="habilita2() || deshabilita1()">
<td class="datospn">Hasta:</td>
<td class="datospn">
<input name="fecha2" class=":required :only_on_submit" type="text" value="" maxlength="10" id="datepicker2" readonly="readonly" onclick="habilita2() || deshabilita1()"></tr>
<tr>
<td class="datospn" colspan="2"></td>
<td class="datospn">(AÑO-MES-DIA)</td>
<td class="datospn"></td>
<td class="datospn">(AÑO-MES-DIA)</td>
</tr>

<tr>
<td class="datospn" colspan="5" style="white-space:nowrap;text-align:center">
<input type="submit" name="" value="Consultar">&nbsp;</td>
</tr>
</form>
</table>



