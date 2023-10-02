function mensaje(id) {
    if (window.confirm("Aviso:\n¿Está conforme con las notas ingresadas? al ACEPTAR no podrá deshacer los cambios")) {
		window.open(href="procesar2.php", target="_blank",'width=810,height=1000,scrollbars=yes'); return false;

	}
	
}

function mensaje1(id) {
    if (window.confirm("Aviso:\n¿Está conforme con los alumnos seleccionados para cargarle la nota?")) {
        window.location = "procesar_nota.php";   
    }
}

function mensaje_sc(id) {
    if (window.confirm("Aviso:\n¿Está conforme con los cambios realizados? al ACEPTAR no podrá deshacer los cambios")) {
		window.open(href="procesar_sc.php", target="_blank",'width=810,height=1000,scrollbars=yes'); return false;

	}
	
}

function mensaje_pp(id) {
    if (window.confirm("Aviso:\n¿Está conforme con los alumnos seleccionados para cargarle la nota?")) {
        window.location = "procesar_nota_pp.php";   
    }
}

function mensaje2_pp(id) {
    if (window.confirm("Aviso:\n¿Está conforme con las notas ingresadas? al ACEPTAR no podrá deshacer los cambios")) {
		window.open(href="procesar2_pp.php", target="_blank",'width=810,height=1000,scrollbars=yes'); return false;

	}
	
}

function mensaje_exp(id) {
     if (window.confirm("Aviso:\n¿Está conforme con la acreditacion por experiencia a este estudiante?")) {
		resol = document.acredita.resol_acredita.value;
		empresa = document.acredita.empresa_acredita.value;

		window.open(href="procesar_exp.php?r="+resol+"&e="+empresa, target="_blank",'width=810,height=1000,scrollbars=yes'); 
		return false;

	}
	
}
function mensaje_eq(id) {
    if (window.confirm("Aviso:\n¿Está conforme con los cambios realizados? al ACEPTAR no podrá deshacer los cambios")) {

	}
	
}
 
 

 // Esta funcion puedes utilizarla en los eventos OnKeyUp, OnKeyDown, onChange y OnKeyPress
// del campo de texto que creas para cada calificación.
// Se usa para validar que solo se escriban valores numéricos en el campo.
function validarNumero(campo) {
	var cadena = campo.value;
	// "nums" contiene los valores permitidos en el campo, el punto(.) es opcional y 
	// debes usarlo solo si se permiten valores decimales en la calificación.
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

// Esta funcion puedes utilizarla en varios eventos igual que la anterior, pero recomiendo
// usarla en el evento onBlur del campo de texto.
// Se usa para validar el minimo y maximo de la calificación.
function validarNota(campo) {

	if (campo.value > 0 && campo.value < 1){// Esta condición se usa solo si se aceptan decimales
		alert("Nota no válida.\n\nEl valor de la calificación debe ser entre 1 y 9.");
		campo.value = ""
		}
	// En esta condición el nueve(9) es estático, en tu caso debes validarlo con el porcentaje
	// de la evaluación que se este cargando en ese momento.
	if (campo.value > 9){
		alert("Nota no válida.\n\nEl valor de la calificación debe ser entre 1 y 9.");
		campo.value = ""
		}
}




function show5(){
 if (!document.layers&&!document.all&&!document.getElementById)
 return
 var Digital=new Date()
 var hours=Digital.getHours()
 var minutes=Digital.getMinutes()
 var seconds=Digital.getSeconds()
 var dn="AM" 
 if (hours>12){
 dn="PM"
 hours=hours-12
 }
 if (hours==0)
 hours=12
 if (minutes<=9)
 minutes="0"+minutes
 if (seconds<=9)
 seconds="0"+seconds
//change font size here to your desire
myclock="<font size='3' face='Arial' >"+hours+":"+minutes+":"
 +seconds+" "+dn+"</b></font>"
if (document.layers){
document.layers.liveclock.document.write(myclock)
document.layers.liveclock.document.close()
}
else if (document.all)
liveclock.innerHTML=myclock
else if (document.getElementById)
document.getElementById("liveclock").innerHTML=myclock
setTimeout("show5()",1000)
 }


function validarN(campo) {

			var cadena = campo.value;
			var nums="1234567890";
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

function ver_acta(f){
	//alert(f.name);
	window.open("","reporte_acta",'width=810,height=1000,scrollbars=yes');
	f.submit();
}


function validarNota(f){
	errores=0;
	with (f){
		//alert(cont.value);
		for(i=0;i<cont.value;i++){
			campo=eval("nota"+i);
			//alert("nota "+i+": "+campo.value);
			if(campo.value==''){
				//alert("campos vacios")
				errores++;
			}
				
		}
	}
	
	if(errores > 0){
		alert("Existen Campos Vacios, por favor verificar");
	} else {
		envia=confirm('Esta seguro que desea cargar las notas?');
		if(envia){
		f.submit();
		}
	}
}