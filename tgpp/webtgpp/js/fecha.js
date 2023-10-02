function Fecha()
{
meses = new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
data = new Date();
index = data.getMonth();
diasemana=new Array("Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo");
indexday =  data.getDay();
if (indexday == 0)
indexday = 7;
any = data.getYear();
if (any < 1900)
	any = 1900 + any;
document.write(diasemana[indexday-1]+ "," + ' '+data.getDate()+ " de " + meses[index] + " de " + any);
}