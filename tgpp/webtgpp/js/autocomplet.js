$(function(){
            $('#buscar_usuario').autocomplete({
                selectFirst: true,
                minLength: 2,
                source : 'ajax2.php',		
		select : function(event,ui){
                  $('#cedula').attr('value', ui.item.cedula);
               }
            });   
        });