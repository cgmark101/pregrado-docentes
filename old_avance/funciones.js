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
			alert('Solo se permite introducir numeros en este campo');
		}
        i++;
    }
}


function maximaLongitud(texto,maxlong) {
  var tecla, in_value, out_value;
  if (texto.value.length > maxlong) {
    in_value = texto.value;
    out_value = in_value.substring(0,maxlong);
    texto.value = out_value;
    return false;
  }
document.getElementById('contador').innerHTML = "Caracteres restantes : "+ (maxlong - texto.value.length);
  return true;
}

//<textarea name="nombre_textarea" cols="50" rows="5" onKeyUp="return maximaLongitud(this,254)"> 

// Esta funcion puedes utilizarla en varios eventos igual que la anterior, pero recomiendo
// usarla en el evento onBlur del campo de texto.
// Se usa para validar el minimo y maximo de la calificación.
function validarNota(campo) {

	if (campo.value > 0 && campo.value < 1){// Esta condición se usa solo si se aceptan decimales
		alert("Nota no válida.\n\nEl valor de la calificación debe ser entre 1 y "+porcentaje+".");
		campo.value = ""
		}
	// En esta condición el nueve(9) es estático, en tu caso debes validarlo con el porcentaje
	// de la evaluación que se este cargando en ese momento.
	if (campo.value > porcentaje){
		alert("Nota no válida.\n\nEl valor de la calificación debe ser entre 1 y "+porcentaje+".");
		campo.value = ""
		}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
function validarNota1(campo) {
valorcampo=eval(campo.value);
numeva=document.form1.selectne.value;
valoreva=eval("document.getElementById('porc"+numeva+"').value");
		if (valorcampo > 0 && campo.value < 1){// Esta condición se usa solo si se aceptan decimales
		alert("Nota no válida.\n\nEl valor de la calificación debe serppp entre 1 y "+valoreva+".");
		campo.value = ""
		}
	// En esta condición el nueve(9) es estático, en tu caso debes validarlo con el porcentaje
	// de la evaluación que se este cargando en ese momento.
	if (valorcampo > valoreva){
		alert("Nota no válida.\n\nEl valor de la calificación debe ser entre 1 y "+valoreva+".");
		campo.value = ""
		}
}

// Esta funcion puedes usarla desde el evento OnClick del botón que utilizas para enviar el formulario 
// con las notas. 
// La función recorre el formulario y verifica que cada casilla destinada para nota no esté vacía.
function notasOK(){
	with (document.formnotas){// Llamada al formulario en cuestión, cambia "notas" por el nombre de tu formulario.
		var i=0;
		var j=0;
		var k=1;
		
		while (i < nro.value){
			//alert("hola");
			// En "valor" capturo el valor del campo correspondiente.
			// El nombre del campo es "nombre_i" donde "i" corresponde a cada fila de la tabla.
			valor=eval("document.getElementById('nota"+i+"').value");
			if (valor == ''){// Si el valor del campo es vacío
				exp=eval("exp_"+i+".value");// Capturo el expediente del campo vacío.(campo "hidden" en el form)
				nom=eval("nom_"+i+".value");// Capturo el nombre del campo vacío.(campo "hidden" en el form)
				alert('El campo correspondiente a:\n\n'+nom+' Expediente N°: '+exp+' está vacio.\n\nUbicado en la fila: '+k);
				j++;	
			}
			i++;
			k++;
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
			return false;
		}
		else{// No hay campos vacíos.
			//notOK.value=true;// Esta es una variable de control que se envia al script siguiente, no la uses.
			// Antes de enviar el form, pregunta de nuevo si está seguro.
			envia = confirm('¿Está seguro de incluir las notas de esta acta?\n\n - Una vez ingresadas no podrán ser modificadas.');
			if (envia){
				// Envia el form.
				return true;
			}
			else return false;
		}
	}
}

function notasOKg(){
	with (document.formnotas){// Llamada al formulario en cuestión, cambia "notas" por el nombre de tu formulario.
		var i=0;
		var j=0;
		var k=1;
		while (i < nro.value){
			// En "valor" capturo el valor del campo correspondiente.
			// El nombre del campo es "nombre_i" donde "i" corresponde a cada fila de la tabla.
			valor=eval("document.getElementById('nota"+i+"').value");
			if (valor == ''){// Si el valor del campo es vacío
				exp=eval("exp_"+i+".value");// Capturo el expediente del campo vacío.(campo "hidden" en el form)
				nom=eval("nom_"+i+".value");// Capturo el nombre del campo vacío.(campo "hidden" en el form)
				alert('El campo correspondiente a:\n\n'+nom+' Expediente N°: '+exp+' está vacio.\n\nUbicado en la fila: '+k);
				j++;	
			}
			k++;
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
				return false;
		}
		else{// No hay campos vacíos.
			//notOK.value=true;// Esta es una variable de control que se envia al script siguiente, no la uses.
			// Antes de enviar el form, pregunta de nuevo si está seguro.
			envia = confirm('¿Está seguro de incluir las notas de esta acta?\n\n - Una vez ingresadas no podrán ser modificadas.');
			if (envia){
				// Envia el form.
				return true;
			}
			else return false;
		}
	}
}

//validarintrot(document.form1.tema'.$cont.'.value,document.form1.porc'.$cont.'.value)


function validaropcion() {
var opcion=document.getElementById('selectop').value;
	
	if(opcion==55){
	envia = confirm('En esta seccion usted agregara un tema extra a los que ya tenia en el plan de evaluacion\n\n¿Está seguro que desea sagregar el tema?');
			if (envia) return true;
			else return false;
	}
	else{
	if(opcion!=0){
	return true;
	}
	else 
	{
	alert('Seleccione una operacion');
	return false;
	}
	}
}



function confirmasalir(){
envia = confirm('¿Está seguro que desea salir del sistema?');
			if (envia){
				javascript:self.close();
			}
}


function validarcantidadeva() {
var opcion=document.getElementById('cantee').value;
	if(opcion>0){
	return true;
	}
	else 
	{
	//alert('Primero diga un numero de evaluaciones');
	return false;
	}
}



function validarintrot(textarea,porcentaje) {
	
        if( vacio(textarea) == false && porcentaje=="") {
                alert("Llene los campos Descripcion y Porcentaje antes de continuar")
                return false
        } 
		    if( vacio(textarea) != false && porcentaje=="") {
                alert("Llene el campo Porcentaje antes de continuar")
                return false
        } 
		    if( vacio(textarea) == false && porcentaje!="") {
                alert("Llene el campo Descripcion antes de continuar")
                return false
        } 
		if( vacio(textarea) != false && porcentaje!="") {
                //alert("OK")
                //cambiar la linea siguiente por return true para que ejecute la accion del formulario
                return true
		}
}


function validacontinuarintrot(textarea,porcentaje) {
	

v=validarintrot(textarea,porcentaje);

if(v==true){
document.form1.action='introt.php'; document.form1.desicions.value='no';   document.form1.submit(); 
}

}



function validaregresointrot(textarea,porcentaje) {
envia = confirm('¿Está seguro que desea ir a la pantalla principal?');
	if (envia){			
        if( vacio(textarea) == false && porcentaje=="") {
			
			document.formsalir.action='cante.php'; 
			document.formsalir.submit();	
         //alert("LLene todos los campos antes de continuar")
		 //return false
        } 
		 if(vacio(textarea) != false && porcentaje=="")
		{
                alert("Ha escrito en el campo Descripcion de temas.\n\n Para regresar sin guardar elimine lo escrito o si no complete el campo porcentaje para regresar guardando.");
		}
		 if(porcentaje!="" && vacio(textarea) == false)
		{
               alert("Ha escrito en el campo Porcentaje de temas.\n\n Para regresar sin guardar elimine lo escrito o si no complete el campo descripcion para regresar guardando.");
		}
		
		if( vacio(textarea) != false && porcentaje!="") {
		document.form1.action='introt.php';
		document.form1.onsubmit='return true';
		document.form1.desicions.value='no';  
		document.form1.trama.value='regresar'; 
		//alert("los dos estan llenos");
		document.form1.submit();
		
        } 
		
	}
}


function validarcontinuarcargac() {
v=notasOK();
if(v==true){
document.formnotas.action='cargac.php'; 
document.formnotas.desicionss.value='no';   
document.formnotas.submit();
}
}


function regresarmodides(seleccion,nuevades,razonmo) {
	
	if( vacio(nuevades) == false && seleccion!="" && vacio(razonmo) != false) {
                alert("Ha seleccionado la evaluacion y ha escrito la razon por la cual se modifica, borre estos datos para salir sin guardar, o complete los datos para salir y guardar");
        }
		if( vacio(nuevades) != false && seleccion=="" && vacio(razonmo) != false) {
                alert("Ha colocado una nueva descripcion y ha escrito la razon por la cual se modifica, borre estos datos para salir sin guardar, o complete los datos para salir y guardar");
                return false;
        }
		if( vacio(nuevades) != false && seleccion!="" && vacio(razonmo) == false) {
                alert("Ha seleccionado la evaluacion y ha escrito la nueva descripcion, borre estos datos para salir sin guardar, o complete los datos para salir y guardar");
                return false;
        }
		if( vacio(nuevades) == false && seleccion=="" && vacio(razonmo) == false) {
                
				//salir normal
				document.formsalir.action='cante.php'; 
				document.formsalir.submit();
        }
		if( vacio(nuevades) == false && seleccion!="" && vacio(razonmo) == false) {
                alert("Ha seleccionado la evaluacion, borre estos datos para salir sin guardar, o complete los datos para salir y guardar");
                return false;
        }
		
		if( vacio(nuevades) != false && seleccion=="" && vacio(razonmo) == false) {
                alert("Ha escrito la nueva descripcion, borre estos datos para salir sin guardar, o complete los datos para salir y guardar");
                return false;
        }
		
		if( vacio(nuevades) == false && seleccion=="" && vacio(razonmo) != false) {
                alert("Ha escrito la razon por la cual se modifica, borre estos datos para salir sin guardar, o complete los datos para salir y guardar");
                return false;
        }
		if( vacio(nuevades) != false && seleccion!="" && vacio(razonmo) != false){
                
                //guardar
				document.form1.action='guardar.php'; 
				document.form1.submit();
		}
}



function validaregresocargac(){
	envia = confirm('¿Está seguro que desea ir a la pantalla principal?');
	if (envia){	
				var nombre = new Array();
				var expediente= new Array();
	with (document.formnotas){// Llamada al formulario en cuestión, cambia "notas" por el nombre de tu formulario.
		var i=0;
		var k=0,p=0;
		while (i < nro.value && k < nro.value ){

			valor=eval("document.getElementById('nota"+k+"').value");
			activa=eval("document.getElementById('activareritado"+k+"').value");
			if (valor != '' && activa==0)
			{// Si el valor del campo es vacío
				exp1=eval("exp_"+k+".value");// Capturo el expediente del campo vacío.(campo "hidden" en el form)
				nom=eval("nom_"+k+".value");// Capturo el nombre del campo vacío.(campo "hidden" en el form)
			nombre[i]=nom;
			expediente[i]=exp1;
			i++;
			}
			if(activa==1) p++;
		k++;
		}
		if(i==0){// No hay campos vacíos.
			//notOK.value=true;// Esta es una variable de control que se envia al script siguiente, no la uses.
			// Antes de enviar el form, pregunta de nuevo si está seguro.
				document.formsalir.action='cante.php'; 
				document.formsalir.submit();

		}
		if((i+p)==nro.value) {
			
			//alert("guarda todo");
			document.formnotas.action='cargac.php'; 
			document.formnotas.desicionss.value='no';  
			document.formnotas.trama.value='regresarc'; 
			document.formnotas.submit();
			//alert("todo esta lleno");
		
		}
		
		if((i+p)!=nro.value && (i+p)!=0)
		{	
			//alert(i);
			mensaje2=('');
			mensaje1=("Ha introducido la calificacion de "+i+" alumnos:\n\n");
			for(j=0;j<i;j++) 
			{
				
				mensaje2+=(nombre[j]+' Expediente N°: '+expediente[j]+'\n');
				
			}
	mensaje3=("\nPara regresar sin guardar elimine lo escrito o si no complete el resto de los campos para regresar guardando.");
			mensajeultimo=mensaje1+mensaje2+mensaje3;
			alert(mensajeultimo);
		}
		   	   
	}
	} 
}

function vacio(q) {
	
		//alert('hola');		
        for ( i = 0; i < q.length; i++ ) {
                if ( q.charAt(i) != " " ) {
                        return true
                }
        }
        return false
}

function validareliminar(selecta,razeli) {
	
	if( vacio(razeli) == false && selecta!="") {
                alert("Especifique una razon antes de continuar");
                return false;
        } 
		if( vacio(razeli) != false && selecta=="") {
                
				alert("Seleccione la evaluacion antes de continuar");
                return false;
        } 
		if( vacio(razeli) == false && selecta=="") {
                alert("Seleccione la evaluacion y especifique una razon antes de continuar");
                return false;
        } 
		if( vacio(razeli) != false && selecta!=""){
                //alert("OK")
                //cambiar la linea siguiente por return true para que ejecute la accion del formulario
                return true;
		}
}

function validarcontinuarcante() {
	
	v=validarcantidadeva();
	if( v == true) {
               document.form1.action='introt.php'; 
			   document.form1.desicion.value='no'; 
			   document.form1.submit();
        }
	else alert("Primero introduzca la cantidad de evaluaciones.");
	
}

function validaregresocante() {
envia = confirm('¿Está seguro que desea ir a la pantalla principal?');
	if (envia){			
       v=validarcantidadeva();
	   if( v == true) {
               document.form1.action='introt.php'; 
			   document.form1.desicion.value='no'; 
			   document.form1.trama.value='regresar'; 
			   document.form1.submit();
        }
		else{
			document.formsalir.action='cante.php';
			document.formsalir.submit();
			
		}
	}
}


function valieliminar(selecta,razeli) {
envia = confirm('¿Está seguro que desea eliminar esta evaluacion?');
	if (envia){			
       v=validareliminar(selecta,razeli);
	   if( v == true) {
		   
               document.form1.action="guardar.php";
			   document.form1.submit();
			   
        }
	}
}


function regresareliminar(selecta,razeli) {
envia = confirm('¿Está seguro que desea salir a la pantalla principal?');
	if (envia){	
	
       if( vacio(razeli) == false && selecta!="") {
		   
                alert("A seleccionado el tema a eliminar.\n\n Para regresar sin guardar quite la seleccion o si no complete el campo de Razon para regresar guardando.");
                //return false;
				
        } 
		if( vacio(razeli) != false && selecta=="") {
                
				alert("Ha escrito en el campo Razon de modificacion.\n\n Para regresar sin guardar elimine lo escrito o si no seleccione una evaluacion a eliminar para regresar guardando.");
               // return false;
				
        } 
		if( vacio(razeli) == false && selecta=="") {
			
                //alert("Seleccione la evaluacion y especifique una razon antes de continuar");
                //return false;
				document.formsalir.action='cante.php'; 
				document.formsalir.submit();
				
        } 
		if( vacio(razeli) != false && selecta!=""){

                document.form1.action="guardar.php";
			   document.form1.submit();
				
		}
        }
	}

function validardescripcion(selecta,ndt,razmodt) {
envia = confirm('¿Está seguro que desea modificar la descripcion de esta evaluacion?');
	if (envia){			
       v=validarmodificardescripcion(selecta,ndt,razmodt);
	   if( v == true) {
               document.form1.action="guardar.php";
			   document.form1.submit(); 
        }
	}
}



function confirmacargar() {
envia = confirm('¿Está seguro que desea cargar los alumnos al sistema?');
	if (envia){			
   document.form1.action='guardar.php'; 
   document.form1.submit();
	}
}



function validaregresocante() {
envia = confirm('¿Está seguro que desea ir a la pantalla principal?');
	if (envia){			
       v=validarcantidadeva();
	   if( v == true) {
               document.form1.action='introt.php'; 
			   document.form1.desicion.value='no'; 
			   document.form1.trama.value='regresar'; 
			   document.form1.submit();
        }
		else{
			document.formsalir.action='cante.php';
			document.formsalir.submit();
			
		}
	}
}



function validarmodpor(selecta,np,razop) {
envia = confirm('¿Está seguro que desea realizar la modificacion de porcentaje?');
	if (envia){			
       v=validarmodificarporcentaje(selecta,np,razop);
	   if( v == true) {
			   document.form1.submit();
        }
	}
}


function validamodcali(selecta,selectne,nc,razmodca) {
envia = confirm('¿Está seguro que desea realizar la modificacion de esta calificacion?');
	if (envia){			
       v=validarmodificarcalificacion(selecta,selectne,nc,razmodca);
	   if( v == true) {
			   document.form1.submit();
        }
	}
}





function validarmodificardescripcion(seleccion,nuevades,razonmo) {
	
	if( vacio(nuevades) == false && seleccion!="" && vacio(razonmo) != false) {
                alert("Por favor coloque la nueva descripcion antes de continuar");
                return false;
        }
		if( vacio(nuevades) != false && seleccion=="" && vacio(razonmo) != false) {
                alert("Por favor seleccione una evaluacion antes de continuar");
                return false;
        }
		if( vacio(nuevades) != false && seleccion!="" && vacio(razonmo) == false) {
                alert("Por favor escriba una razon por la cual se modifica antes de continuar");
                return false;
        }
		if( vacio(nuevades) == false && seleccion=="" && vacio(razonmo) == false) {
                alert("Por favor seleccione una evaluacion, coloque la nueva descripcion y escriba una razon por la cual se modifica antes de continuar");
                return false;
        }
		if( vacio(nuevades) == false && seleccion!="" && vacio(razonmo) == false) {
                alert("Por favor coloque la nueva descripcion y una razon de por que se modifica antes de continuar");
                return false;
        }
		
		if( vacio(nuevades) != false && seleccion=="" && vacio(razonmo) == false) {
                alert("Por favor seleccione una evaluacion y escriba una razon de por que se modifica antes de continuar");
                return false;
        }
		
		if( vacio(nuevades) == false && seleccion=="" && vacio(razonmo) != false) {
                alert("Por favor seleccione una evaluacion y escriba la nueva descripcion antes de continuar");
                return false;
        }
		if( vacio(nuevades) != false && seleccion!="" && vacio(razonmo) != false){
                //alert("OK")
                //cambiar la linea siguiente por return true para que ejecute la accion del formulario
                return true;
		}
}


function validarmodificarporcentaje(seleccion,nuevades,razonmo) {
	
	if(seleccion=="") {
                alert("Seleccione una evaluacion antes de continuar")
                return false
        }
	if( vacio(nuevades) == false) {
                alert("Coloque un nuevo porcentaje antes de continuar")
                return false
        }
	if(vacio(razonmo) == false) {
                alert("Escriba una razon antes de continuar")
                return false
        } 
	if( vacio(nuevades) != false && seleccion!="" && vacio(razonmo) != false) {
                //alert("LLene todos los campos antes de continuar")
                return true
        }
}

function validarregresomodpor(seleccion,nuevades,razonmo) {
envia=confirm("Esta seguro que desea regresar a la pantalla principal?");
if(envia){
	if(seleccion=="" && vacio(nuevades) == false && vacio(razonmo) == false) {
                //cuando sale normal
				document.formsalir.action='cante.php'; 
				document.formsalir.submit();
        }
	if( seleccion!="" && vacio(nuevades) == false && vacio(razonmo) == false) {
                alert("Ha seleccionado una evaluacion, para salir sin guardar elimine la seleccion, o complete los campos para salir guardando.")
                //return false
        }
	if( seleccion=="" && vacio(nuevades) != false && vacio(razonmo) == false) {
                alert("Ha colocado el nuevo porcentaje, para salir sin guardar borre lo que escribio, o complete los campos para salir guardando")
                //return false
        }
	if( seleccion=="" && vacio(nuevades) == false && vacio(razonmo) != false) {
                alert("Ha escrito una razon por la cual se modifica, para salir sin guardar borre lo escrito, o complete los campos para salir guardando")
                //return false
        }
	if( seleccion!="" && vacio(nuevades) != false && vacio(razonmo) == false) {
                alert("Ha seleccionado una evaluacion y ha colocado un nuevo porcentaje, para salir sin guardar borre estos dos campos o complete los campos para salir guardando")
                //return false
        }
	if( seleccion!="" && vacio(nuevades) == false && vacio(razonmo) != false) {
                alert("Ha seleccionado una evaluacion y ha colocado la razon por la cual se modifica, para salir sin guardar borre estos dos campos o complete los campos para salir guardando")
                //return false
        }
	if( seleccion=="" && vacio(nuevades) != false && vacio(razonmo) != false) {
                
				alert("Ha colocado un nuevo porcentaje y ha escrito la razon por la cual se modifica, para salir sin guardar borre estos dos campos o complete los campos para salir guardando")
				
        }
	if( seleccion!="" && vacio(nuevades) != false && vacio(razonmo) != false) {
               //guardar normal
			   //alert("guardarnormal");
			   document.form1.submit();
        }
}
}


function validarmodificarcalificacion(selecciona,seleccionc,nuevaca,razon) {
	
	
	if( selecciona=="") {
                alert("Seleccione una alumno antes de continuar")
                return false
        }
	if(seleccionc=="") {
                alert("Seleccione una calificacion antes de continuar")
                return false
        }
	if( vacio(nuevaca) == false) {
                alert("Ingrese una calificacion antes de continuar")
                return false
        } 
	if( vacio(razon) == false) {
                alert("Indique una razon por la cual se modifica antes de continuar")
                return false
        }
	if( vacio(nuevaca) != false || selecciona!="" || vacio(razon) != false || seleccionc!=""){
                //alert("OK")
                //cambiar la linea siguiente por return true para que ejecute la accion del formulario
                return true
		}
}



function regresarmodcali(selecciona,seleccionc,nuevaca,razon) {
envia=confirm("Esta seguro que desea ir a la pantalla principal?");
if(envia){

	if( vacio(nuevaca) == false && selecciona=="" && vacio(razon) == false && seleccionc=="") {   
			document.formsalir.action='cante.php'; 
			document.formsalir.submit();
        }
	if( vacio(nuevaca) == false && selecciona=="" && vacio(razon) == false && seleccionc!="") {
                alert("Ha seleccionado una calificacion, para salir sin guardar quite esta seleccion o complete los campos para salir guardando")
                //return false
        }
	if( vacio(nuevaca) == false && selecciona=="" && vacio(razon) != false && seleccionc=="") {
                alert("Ha escrito una razon por la cual se modifica, para salir sin guardar borre lo escrito o complete los campos para salir guardando")
                //return false
        }
	if( vacio(nuevaca) == false && selecciona=="" && vacio(razon) != false && seleccionc!="") {
                alert("Ha seleccionado una calificacion y ha escrito una razon por la cual se modifica, para salir sin guardar quite esta seleccion o complete los campos para salir guardando")
                //return false
        }
	if( vacio(nuevaca) == false && selecciona!="" && vacio(razon) == false && seleccionc=="") {
                alert("Ha seleccionado a un alumno, para salir sin guardar elimine la seleccion o complete los campos para salir guardando")
               // return false
        }
	if( vacio(nuevaca) == false && selecciona!="" && vacio(razon) == false && seleccionc!="") {
                alert("Ha seleccionado a un alumno y ha seleccionado una evaluacion, para salir sin guardar elimine la seleccion o complete los campos para salir guardando")
                //return false
        }
	if( vacio(nuevaca) == false && selecciona!="" && vacio(razon) != false && seleccionc=="") {
                alert("Ha seleccionado a un alumno y ha escrito una razon por la cual se modifica, para salir sin guardar elimine la seleccion y borre lo escrito o complete los campos para salir guardando")
                //return false
        }
	if( vacio(nuevaca) == false && selecciona!="" && vacio(razon) != false && seleccionc!="") {
                alert("Ha seleccionado a un alumno, ha seleccionado una evaluacion y ha escrito una razon por la cual se modifica, para salir sin guardar elimine las selecciones y borre lo escrito o complete los campos para salir guardando")
                //return false
        }
	if( vacio(nuevaca) != false && selecciona=="" && vacio(razon) == false && seleccionc=="") {
                alert("Ha escrito la nueva calificacion, para salir sin guardar elimine lo escrito o complete los campos para salir guardando")
                //return false
        }
	if( vacio(nuevaca) != false && selecciona=="" && vacio(razon) == false && seleccionc!="") {
                alert("Ha seleccionado una calificacion y ha escrito la nueva calificacion, para salir sin guardar elimine la seleccion y borre lo escrito o complete los campos para salir guardando")
                //return false
        }
	if( vacio(nuevaca) != false && selecciona=="" && vacio(razon) != false && seleccionc=="") {
                alert("Ha colocado la nueva calificacion y ha escrito la razon, para salir sin guardar borre lo escrito o complete los campos para salir guardando")
                //return false
        }
	if( vacio(nuevaca) != false && selecciona=="" && vacio(razon) != false && seleccionc!="") {
                alert("Ha seleccionado una calificacion, ha escrito la nueva evaluacion y ha escrito una razon, para salir sin guardar elimine la seleccion y borre lo escrito o complete los campos para salir guardando")
                //return false
        }
	if( vacio(nuevaca) != false && selecciona!="" && vacio(razon) == false && seleccionc=="") {
                alert("Ha seleccionado a un alumno y ha escrito la nueva calificacion, para salir sin guardar elimine la seleccion y borre lo escrito o complete los campos para salir guardando")
                //return false
        }
	if( vacio(nuevaca) != false && selecciona!="" && vacio(razon) == false && seleccionc!="") {
                alert("Ha seleccionado a un alumno, ha seleccionado una calificacion y ha escrito la nueva calificacion, para salir sin guardar elimine la seleccion y borre lo escrito o complete los campos para salir guardando")
               // return false
        }
	if( vacio(nuevaca) != false && selecciona!="" && vacio(razon) != false && seleccionc=="") {
                alert("Ha seleccionado a un alumno, ha escrito la nueva calificacion y ha colocado la razon, para salir sin guardar elimine la seleccion y borre lo escrito o complete los campos para salir guardando")
                //return false
        }
	if( vacio(nuevaca) != false && selecciona!="" && vacio(razon) != false && seleccionc!="") {
               // alert("todo lleno")
               // return false
			   document.form1.submit();
        }
}

}




function validarcantidad(cantidad) {
	if(cantidad.value>35){
	alert('El maximo es 35 evaluaciones');
	cantidad.value="";
	}
	if(cantidad.value<4){
	alert('El Minimo es 4 evaluaciones');
	cantidad.value="";
	}
}

function validarporcentajes(cantidad) {
	if(cantidad.value>30){
	alert('El maximo es 30% para una evaluacion');
	cantidad.value="";
	}
	if(cantidad.value==0 && cantidad.value!=""){
	alert('El valor no puede ser "0"');
	cantidad.value="";
	}
	var restante=eval("document.getElementById('restante').value");
	cantidad1=eval(cantidad.value);
	if(cantidad1 > restante)
	{
		//alert(cantidad1);
	alert('El maximo valor que puede tomar esta evaluacion es '+restante+'%, ya que del resto estaria sobrepasando el total de 100%');
	cantidad.value="";
	}
}

function validarloquefalta(cantidad) {
	
	var restante=eval("document.getElementById('restante').value");
	var cantee=eval("document.getElementById('cantee').value");
	var evaintro=eval("document.getElementById('cont').value");
	
	//minimo=Math.ceil(restante/(cantee-evaintro));
	
	minimo=Math.ceil(100-(((cantee-evaintro)*30)+(100-restante)));
if((cantee-evaintro)>0){
	if(cantidad.value<minimo ){
	alert('El valor minimo que puede tomar esta evaluacion es '+minimo+'%, ya que si coloca menos, con las evaluaciones siguientes no podra alcanzar el 100% tomando en cuenta que ninguna evaluacion puede valer mas de 30%');
	cantidad.value="";
	}
}
else {if(cantidad.value!=minimo ){
		alert("El valor de esta evaluacion debe ser "+minimo+"% para poder completar el 100%");
		cantidad.value="";//alert("holasadasd");	
		}
}
}


function modifical(acta,lapso0,lapso1,c_asigna)
{
var lapso=lapso0+"-"+lapso1;
//alert(lapso);
var alu=document.getElementById('selecta').value;
var eva=document.getElementById('selectne').value;
fajax('guardar.php','temas','codigos=236&alu='+alu+'&eva='+eva+'&acta='+acta+'&lapso='+lapso+'&c_asigna='+c_asigna+'','post','0');
}



function actualizaReloj(){ 

/* Capturamos la Hora, los minutos y los segundos */
marcacion = new Date() 

/* Capturamos la Hora */
Hora = marcacion.getHours() 

/* Capturamos los Minutos */
Minutos = marcacion.getMinutes() 

var dn;
dn = "  AM";
if (Hora > 12) {dn = "  PM"; Hora = Hora - 12; }
if (Hora == 0) { Hora = 12; }

/* Capturamos los Segundos */
Segundos = marcacion.getSeconds() 

/* Si la Hora, los Minutos o los Segundos
Son Menores o igual a 9, le añadimos un 0 */

if (Hora<=9)
Hora = "0" + Hora

if (Minutos<=9)
Minutos = "0" + Minutos

if (Segundos<=9)
Segundos = "0" + Segundos

/* Termina el Script del Reloj */

/* Coemienza eñ Script de la Fecha */

var Dia = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
var Mes = new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
var Hoy = new Date();
var Anio = Hoy.getFullYear();
var Fecha = Dia[Hoy.getDay()] + ", " + Hoy.getDate() + " de " + Mes[Hoy.getMonth()] + " de " + Anio + "\n\ A las ";

/* Termina el script de la Fecha */


/* Creamos 4 variables para darle formato a nuestro Script */
var Inicio, Script, Final, Total

/*En Inicio le indicamos un color de fuente  y un tamaño */
Inicio = ""

/* En Reloj le indicamos la Hora, los Minutos y los Segundos */
Script = Fecha + Hora + ":" + Minutos + ":" + Segundos + dn

/* En final cerramos el tag de la fuente */
Final = ""

/* En total Finalizamos el Reloj uniendo las variables */
Total = Inicio + Script + Final

/* Capturamos una celda para mostrar el Reloj */
document.getElementById('Fecha_Reloj').innerHTML = Total

/* Indicamos que nos refresque el Reloj cada 1 segundo */
setTimeout("actualizaReloj()",1000)
}

/*
function totalizarpor()
{
var total=0;
for(i=1;i<=canteej;i++)
{
var fila=document.getElementById('por'+i);
var valor=fila.childNodes[0];
total = total + parseInt(valor.value);
}
if(total>100)	alert('El Total de Porcentaje es mayor que 100%');
var tit=document.getElementById('total');
tit.childNodes[0].nodeValue='Total de porcentaje '+total+'%';
}

function totalizar(info){
var fila=document.getElementById(info);
var total=0;
for(i=1;i<fila.childNodes.length-2;i++)
{
var valor=fila.childNodes[i];
total = total + parseFloat(valor.childNodes[0].value);
}
var eltotal=fila.childNodes[fila.childNodes.length-2];
var redondeado=Math.round(total);
eltotal.childNodes[0].value=redondeado;
var base9=conva9(redondeado);
var total9=fila.lastChild;
total9.childNodes[0].value=base9;

}

function conva9(numero)
{
if(numero==0)	return 0.0;
if(numero==1)	return 1.0;
if(numero==2)	return 1.1;
if(numero==3 || numero==4)	return 1.2;
if(numero==5)	return 1.3;
if(numero==6 || numero==7)	return 1.4;
if(numero==8)	return 1.6;
if(numero==9 || numero==10)	return 1.7;
if(numero==11)	return 1.8;
if(numero==12)	return 1.9;
if(numero==13)	return 2.0;
if(numero==14)	return 2.1;
if(numero==15 || numero==16)	return 2.2;
if(numero==17)	return 2.3;
if(numero==18)	return 2.4;
if(numero==19)	return 2.5;
if(numero==20)	return 2.6;
if(numero==21 || numero==22)	return 2.7;
if(numero==23)	return 2.8;
if(numero==24)	return 2.9;
if(numero==25)	return 3.0;
if(numero==26)	return 3.1;
if(numero==27 || numero==28)	return 3.2;
if(numero==29)	return 3.3;
if(numero==30)	return 3.4;
if(numero==31)	return 3.5;
if(numero==32)	return 3.6;
if(numero==33 || numero==34)	return 3.7;
if(numero==35)	return 3.8;
if(numero==36)	return 3.9;
if(numero==37)	return 4.0;
if(numero==38)	return 4.1;
if(numero==39)	return 4.2;
if(numero==40)	return 4.2;
if(numero==41)	return 4.3;
if(numero==42)	return 4.4;
if(numero==43 || numero==44)	return 4.5;
if(numero==45)	return 4.6;
if(numero==46)	return 4.7;
if(numero==47)	return 4.8;
if(numero==48)	return 4.8;
if(numero==49)	return 4.9;
if(numero==50)	return 5.0;
if(numero==51)	return 5.1;
if(numero==52)	return 5.2;
if(numero==53)	return 5.3;
if(numero==54)	return 5.4;
if(numero==55)	return 5.5;
if(numero==56)	return 5.5;
if(numero==57)	return 5.6;
if(numero==58)	return 5.7;
if(numero==59)	return 5.8;
if(numero==60)	return 5.9;
if(numero==61)	return 6.0;
if(numero==62)	return 6.1;
if(numero==63)	return 6.2;
if(numero==64)	return 6.3;
if(numero==65)	return 6.4;
if(numero==66)	return 6.5;
if(numero==67)	return 6.6;
if(numero==68)	return 6.7;
if(numero==69)	return 6.8;
if(numero==70)	return 6.9;
if(numero==71)	return 7.0;
if(numero==72)	return 7.1;
if(numero==73)	return 7.2;
if(numero==74)	return 7.3;
if(numero==75)	return 7.4;
if(numero==76)	return 7.5;
if(numero==77)	return 7.6;
if(numero==78)	return 7.7;
if(numero==79)	return 7.8;
if(numero==80)	return 7.9;
if(numero==81)	return 8.0;
if(numero==82)	return 8.1;
if(numero==83)	return 8.2;
if(numero==84)	return 8.3;
if(numero==85)	return 8.4;
if(numero==86)	return 8.5;
if(numero==87)	return 8.6;
if(numero==88)	return 8.7;
if(numero==89)	return 8.8;
if(numero==90)	return 8.9;
if(numero>=91 && numero<=100)	return 9.0;
}*/
// JavaScript Document