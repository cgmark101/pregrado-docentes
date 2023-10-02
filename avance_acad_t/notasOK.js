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

// Esta funcion puedes usarla desde el evento OnClick del botón que utilizas para enviar el formulario 
// con las notas. 
// La función recorre el formulario y verifica que cada casilla destinada para nota no esté vacía.
function notasOK(){
	with (document.notas){// Llamada al formulario en cuestión, cambia "notas" por el nombre de tu formulario.
		var i=1;
		var j=0;
		while (i <= nro.value){
			// En "valor" capturo el valor del campo correspondiente.
			// El nombre del campo es "nombre_i" donde "i" corresponde a cada fila de la tabla.
			valor=eval("nota_"+i+".value");
			if (valor == ''){// Si el valor del campo es vacío
				exp=eval("exp_"+i+".value");// Capturo el expediente del campo vacío.(campo "hidden" en el form)
				nom=eval("nom_"+i+".value");// Capturo el nombre del campo vacío.(campo "hidden" en el form)
				alert('El campo correspondiente a:\n\n'+nom+' Expediente N°: '+exp+' está vacio.\n\nUbicado en la fila: '+i);
				j++;	
			}
			i++;			
		}
		if (j > 0){
			if (j > 1){// Para mas de un campo vacío muestro mensaje en plural
				msg1=('Existen ');
				msg2=(' campos vacíos.\n\n');
			}else if (j == 1){// Para un campo vacío muestro mensaje en singular
				msg1=('Existe ');
				msg2=(' campo vacío.\n\n');
			}
			msg=(msg1+j+msg2+'Por favor complete todos los campos para continuar.');
			alert(msg);
		}
		else{// No hay campos vacíos.
			//notOK.value=true;// Esta es una variable de control que se envia al script siguiente, no la uses.
			// Antes de enviar el form, pregunta de nuevo si está seguro.
			envia = confirm('¿Está seguro de incluir las notas de esta acta?\n\n - Una vez ingresadas no podrán ser modificadas.');
			if (envia){
				// Envia el form.
				document.notas.submit();
			}
		}
	}
}