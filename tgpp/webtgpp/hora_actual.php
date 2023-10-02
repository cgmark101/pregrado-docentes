<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Reloj con Javascript</title>
<script language="JavaScript">
var m="AM";
function mueveReloj(){
    momentoActual = new Date();
    hora = momentoActual.getHours();
    minuto = momentoActual.getMinutes();
    segundo = momentoActual.getSeconds();

if(hora==12)
{
    m="PM";
}
if(hora==13)
{
    hora="0"+1;
    m="PM";
}
if(hora==14)
{
    hora="0"+2;
    m="PM";
}
if(hora==15)
{
    hora="0"+3;
    m="PM";
}
if(hora==16)
{
    hora="0"+4;
    m="PM";
}
if(hora==17)
{
    hora="0"+5;
    m="PM";
}
if(hora==18)
{
    hora="0"+6;
    m="PM";
}
if(hora==19)
{
    hora="0"+7;
    m="PM";
}
if(hora==20)
{
    hora="0"+8;
    m="PM";
}
if(hora==21)
{
    hora="0"+9;
    m="PM";
}
if(hora==22)
{
    hora=10;
    m="PM";
}
if(hora==23)
{
    hora=11;
    m="PM";
}
if((hora==0)||(hora==24))
{
    hora=12;
    m="AM";
}

    str_segundo = new String (segundo)
    if (str_segundo.length == 1)
       segundo = "0" + segundo;

    str_minuto = new String (minuto)
    if (str_minuto.length == 1)
       minuto = "0" + minuto;

    str_hora = new String (hora)
    if (str_hora.length == 1)
       hora = "0" + hora;

    horaImprimible = hora + ":" + minuto + ":" + segundo+" "+m;

    cl.innerHTML = horaImprimible;//cl=clock=reloj

    setTimeout("mueveReloj()",1000);
}
</script>
</head>

<body onload="mueveReloj()">

<table style="border-collapse: collapse; width="120" border="0" cellpadding="0" cellspacing="1"align="left" bgcolor="#254B72">
    <tr height="10">
    
    <th width="114"style="font-family:arial; scope="col"><font id="cl" align="left" color="#ffffff"><strong>0</strong></font></th>
    </tr>
</table>
</body>
</html> 