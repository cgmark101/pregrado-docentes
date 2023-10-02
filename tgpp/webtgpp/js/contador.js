//creo una clase para conseguir que un textarea tenga un contador de caracteres
var TextareaContador = new Class({
   //defino un constructor, que recibe el id del textarea
   initialize: function(idTextarea){
      //recupero el elemento textarea con la función dolar
      this.textarea = $(idTextarea);
      //creo un elemento SPAN para mostrar el contador
      this.campoContador = new Element ("span", {"class": "estilocontador"});
      //inyecto el contador después del textarea
      this.campoContador.inject(this.textarea, "after");
      
      //creo un evento para el textarea, keyup, para cuando el usuario suelta la tecla
      this.textarea.addEvent("keyup", function(){
         //simplemente llamo a un método de esta clase que cuenta caracteres
         this.cuentaCaracteres();
      }.bind(this)
      );
      
      //llamo al método que cuenta caracteres, para inicializar el contador
      this.cuentaCaracteres();
   },
   
   //creo un método para contar los caracteres
   cuentaCaracteres: function(){
      //simplemente escribo en el campo contador el número de caracteres actual del textarea
      this.campoContador.set("html", "Número caracteres: " + this.textarea.value.length);
   }
});   

//creo un evento para cuando está listo el DOM de la página
window.addEvent("domready", function(){
   //creo el objeto TextareaContador, pasando el identificador del textarea que se pretende contar caracteres.
   texto = new TextareaContador("textocontador");
   otro = new TextareaContador("otro");
});
