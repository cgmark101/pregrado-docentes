$(function(){
            $('#buscar_usuario_c').autocomplete({
                selectFirst: true,
                minLength: 2,
                source : 'ajax.php',		
		select : function(event,ui){
                  $('#cedula_c').attr('value', ui.item.cedula);
               }
            });   
        });