<p>&nbsp;</p>
<table width="650" border="1" align="center"  style="border-collapse: collapse;border-color:black;">
  <tr>
    <td width="223" class="sub_tabla">PROFESOR:</td>
    <td width="175" class="sub_tabla">Nro. CEDULA </td>
    <td width="225" class="sub_tabla">FIRMA</td>
    <td width="149" class="sub_tabla">FECHA:</td>
  </tr>
  <tr>
    <td height="54" class="datos_tabla"><?php echo $nombre;?>  <?php echo $apellido;?></td>
    <td class="datos_tabla"><?php echo $ci;?></td>
    <td class="datos_tabla">&nbsp;</td>
    <td class="datos_tabla"><p><?php echo $fec;?></p>
    </td>
  </tr>
</table>

<table width="650" border="0" align="center"  style="border-collapse: collapse;border-color:black;">
  <tr>
  <td class="datos_tabla" align="center">VA SIN ENMIENDAS</td>
  </tr>  
  <tr>
  <td id="oculto" colspan="2" align="center"><input type="button" value="IMPRIMIR" onclick="imprimir()" align="center">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="SALIR" onclick="proceso()" align="center"></td>
    
  </tr>


</table>

<script type="text/javascript">
function proceso() {
     if (window.confirm("Recuerde imprimir su Acta de Evaluación Final ¿Desea Continuar?")) {
		//window.opener.location = 'index_0.php';
	    window.close(); return false;
	}
}
</script>

<SCRIPT LANGUAGE="JavaScript1.2" TYPE="text/javascript">
<!--
window.onbeforeunload = unloadMess;
function unloadMess(){
	mess = "Recuerde imprimir su Acta de Evaluación Final"
	//window.opener.location = 'index_0.php';
	return mess;
    

}
//-->

</SCRIPT>