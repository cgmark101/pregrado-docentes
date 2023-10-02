<?php //formulario fechas
error_reporting(E_ALL);
include_once('inc/config.php');
require_once('inc/odbcss_c.php');

 //consultamos los lapsos que existen en his_act
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT his_lap FROM his_act GROUP BY his_lap ASC";     
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
           $("#datepicker").datepicker({dateFormat:"yy-mm-dd"});
		   $("#datepicker2").datepicker({minDate: new Date(y, m, d), dateFormat:"yy-mm-dd"});
        });
    </script>
	
 <script language="JavaScript"> 

function habilita1(){ 
    document.rango.lapso.disabled = false; 
   } 

function deshabilita1(){ 
    document.rango.lapso.disabled = true; 
    document.rango.lapso.value = ""; 
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
<form action="v_acta_orden_pend.php" name="rango" method="post">
<tr>
<td class="datospn"><input id="" type="radio" name="B1" value="1" checked="checked" onclick="habilita1() || deshabilita2()"/>
<label for=""><a class=Ntooltip>Por Lapso<span>Muestra las actas por el orden de lapso en el que fueron cargadas </span>
</a></label></td>

<td class="datospn"><select name="lapso" id="lapso" onclick="habilita1() || deshabilita2()">
<?php for($i=0; $i < count($result); $i++) { ?>
  <option value""><?php echo $result[$i][0];?></option>
 
 <?php }?>

</select></td>
<td colspan="3" class="datospn"></td>
</tr>
<tr>
<td class="datospn"><span class=""><input id="" type="radio" name="B1" value="2" onclick="habilita2() || deshabilita1()"/><a class=Ntooltip>Por Rango<span>Muestra las actas por el rango de fecha seleccionado </span>
</a></label></td>
<td class="datospn">Desde:</td>
<td class="datospn">
<input name="fecha" type="text" value="" maxlength="10" id="datepicker" readonly="readonly" onclick="habilita2() || deshabilita1()">
<td class="datospn">Hasta:</td>
<td class="datospn">
<input name="fecha2" type="text" value="" maxlength="10" id="datepicker2" readonly="readonly" onclick="habilita2() || deshabilita1()"></tr>
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



