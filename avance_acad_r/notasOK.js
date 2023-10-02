// Esta funcion puedes utilizarla en los eventos OnKeyUp, OnKeyDown, onChange y OnKeyPress
// del campo de texto que creas para cada calificaci�n.
// Se usa para validar que solo se escriban valores num�ricos en el campo.
function validarNumero(campo) {
	var cadena = campo.value;
	// "nums" contiene los valores permitidos en el campo, el punto(.) es opcional y 
	// debes usarlo solo si se permiten valores decimales en la calificaci�n.
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
// Se usa para validar el minimo y maximo de la calificaci�n.
function validarNota(campo) {

	if (campo.value > 0 && campo.value < 1){// Esta condici�n se usa solo si se aceptan decimales
		alert("Nota no v�lida.\n\nEl valor de la calificaci�n debe ser entre 1 y 9.");
		campo.value = ""
		}
	// En esta condici�n el nueve(9) es est�tico, en tu caso debes validarlo con el porcentaje
	// de la evaluaci�n que se este cargando en ese momento.
	if (campo.value > 9){
		alert("Nota no v�lida.\n\nEl valor de la calificaci�n debe ser entre 1 y 9.");
		campo.value = ""
		}
}

// Esta funcion puedes usarla desde el evento OnClick del bot�n que utilizas para enviar el formulario 
// con las notas. 
// La funci�n recorre el formulario y verifica que cada casilla destinada para nota no est� vac�a.
function notasOK(){
	with (document.notas){// Llamada al formulario en cuesti�n, cambia "notas" por el nombre de tu formulario.
		var i=1;
		var j=0;
		while (i <= nro.value){
			// En "valor" capturo el valor del campo correspondiente.
			// El nombre del campo es "nombre_i" donde "i" corresponde a cada fila de la tabla.
			valor=eval("nota_"+i+".value");
			if (valor == ''){// Si el valor del campo es vac�o
				exp=eval("exp_"+i+".value");// Capturo el expediente del campo vac�o.(campo "hidden" en el form)
				nom=eval("nom_"+i+".value");// Capturo el nombre del campo vac�o.(campo "hidden" en el form)
				alert('El campo correspondiente a:\n\n'+nom+' Expediente N�: '+exp+' est� vacio.\n\nUbicado en la fila: '+i);
				j++;	
			}
			i++;			
		}
		if (j > 0){
			if (j > 1){// Para mas de un campo vac�o muestro mensaje en plural
				msg1=('Existen ');
				msg2=(' campos vac�os.\n\n');
			}else if (j == 1){// Para un campo vac�o muestro mensaje en singular
				msg1=('Existe ');
				msg2=(' campo vac�o.\n\n');
			}
			msg=(msg1+j+msg2+'Por favor complete todos los campos para continuar.');
			alert(msg);
		}
		else{// No hay campos vac�os.
			//notOK.value=true;// Esta es una variable de control que se envia al script siguiente, no la uses.
			// Antes de enviar el form, pregunta de nuevo si est� seguro.
			envia = confirm('�Est� seguro de incluir las notas de esta acta?\n\n - Una vez ingresadas no podr�n ser modificadas.');
			if (envia){
				// Envia el form.
				document.notas.submit();
			}
		}
	}
}