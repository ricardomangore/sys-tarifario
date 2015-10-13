(function($){


$(document).ready(function() {
    
    $('.select_aerolinea').selectpicker();
    $('.select_recargos').selectpicker();
    $('.select_origen').selectpicker();
    $('.select_destino').selectpicker();
    $('.select_region').selectpicker();
    $('.select_via').selectpicker();
    $('.select_naviera').selectpicker();
    $('.select_contenedor').selectpicker();
   	$btnRdDirecto = $('#radioDirecto');
   	$btnRdEscalas = $('#radioEscalas');

 
    /*$('[name=chkbox_via]').change(function(event){
    	var value = $(this).val();
    	if(value == 'directo'){
    		$('.select_via').prop('disabled',true);
    		$('.select_via').selectpicker('refresh');
    	}
    	if(value == 'escalas'){
			$('.select_via').prop('disabled',false);
			$('.select_via').selectpicker('refresh');
    	}	
    });*/
    
    $('[name=chkbox_carga]').change(function(event){
    	var value = $(this).val();
    	if(value == 'contenedor'){
    		$('.select_contenedor').prop('disabled',false);
    		$('.select_contenedor').selectpicker('refresh');
			$('[name=peso]').prop('disabled',true);
			$('[name=volumen]').prop('disabled',true);    		
    	}
    	if(value == 'consolidado'){
    		$('.select_contenedor').prop('disabled',true);
    		$('.select_contenedor').selectpicker('refresh');    	
			$('[name=peso]').prop('disabled',false);
			$('[name=volumen]').prop('disabled',false);
    	}
    });
    
    var opxtable = $('#opxtable').DataTable();
    
} );

})(jQuery);