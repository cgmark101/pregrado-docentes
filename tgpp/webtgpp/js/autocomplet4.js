$(function(){
            $('#buscar_usuario_s').autocomplete({
                selectFirst: true,
                minLength: 2,
                source : 'ajax.php',		
		select : function(event,ui){
                  $('#cedula_s').attr('value', ui.item.cedula);
               }
            });   
        });