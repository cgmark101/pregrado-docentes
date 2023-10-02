<?php
function getParam($param, $default) {
	$result = $default;
	if (isset($param)) {
  		$result = (get_magic_quotes_gpc()) ? $param : addslashes($param);
	}
	return $result;
}

function sqlValue($value, $type) {
  $value = get_magic_quotes_gpc() ? stripslashes($value) : $value;
  $value = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($value) : mysql_escape_string($value);
  switch ($type) {
    case "text":
      $value = ($value != "") ? "'" . $value . "'" : "NULL";
      break;
    case "int":
      $value = ($value != "") ? intval($value) : "NULL";
      break;
    case "double":
      $value = ($value != "") ? "'" . doubleval($value) . "'" : "NULL";
      break;
    case "date":
      $value = ($value != "") ? "'" . $value . "'" : "NULL";
      break;
  }
  return $value;
}

function generar_acta($a,$b,$c){

//el Nro nuevo de acta sera el incremento del mayor

	$new_acta=$a;
	if($b > $new_acta)
	$new_acta=$b;
	if($c > $new_acta)
	$new_acta=$c;
	$new_acta=$new_acta+1;
	return $new_acta;
} 

function generar_acta5($a,$b,$c,$d,$e){

//el Nro nuevo de acta sera el incremento del mayor

$new_acta=$a;
if($b > $new_acta)
$new_acta=$b;
if($c > $new_acta)
$new_acta=$c;
if($d > $new_acta)
$new_acta=$d;
if($e > $new_acta)
$new_acta=$e;
$new_acta=$new_acta+1;
return $new_acta;
}

?>

<script language=javascript>

function imprimir(){
var ocul;
botones=document.getElementById("oculto");
botones.style.visibility='hidden';
window.print();
setTimeout("botones.style.visibility='visible'",5000);
}
</script>

