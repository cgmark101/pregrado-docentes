<?php
include_once('inc\config.php');
$conexion1 = odbc_connect($DSN2, $user, $pass, true, $laBitacora) or die ("Problemas en la conexión"); 	
if(isset($_GET['cedula'])){
$sql="select * from sol_tgpp where cedula='{$_GET['cedula']}'";
$qry=odbc_exec($conexion1, $sql);
$row=mysql_fetch_assoc($qry);
$cant=mysql_num_rows($qry);
}
?>
<html>
<head>
<title>ejemplo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script>
function enviar(valor){
if(valor!=''){
window.location="<?php echo $_SERVER['PHP_SELF'] ?>?cedula="+valor;
}
}
</script>
</head>
 
<body><form name="form1" id="form1">
<table width="713" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="199"><input name="cedula" type="text" id="cedula" size="60" onblur="enviar(this.value)"> </td>
      <?php if(isset($_GET['cedula']) && !empty($cant)){ ?><td width="514"><table width="500" border="1" cellspacing="0" cellpadding="0">
          <tr>
            <td><?php echo $row['nombre'];?></td>
            <td><?php echo $row['apellido'];?></td>
          </tr>
        </table></td><?php } ?>
  </tr>
</table></form>
</body>
</html>