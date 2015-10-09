var OpxDataTable = function( par ){
	var opxtable = $(par).DataTable();
	$opxBtnEdit = $('.opx_btn_edit');
    $opxBtnDelete = $('.opx_btn_delete');
    
    var row;
    
	this.getRow = function(){
		return row;
	};
    
	$opxBtnEdit.click(function(event){
		$this = $(this);
    	row = opxtable.row($this.parent().parent()).data();	
    	$this.trigger('clickEdit');
    });
    
    $opxBtnDelete.click(function(event){
    	$this = $(this);
    	row = opxtable.row($this.parent().parent()).data();
    	$this.trigger('clickDelete');
    });
   
    opxtable.on('draw',function(event){
    	
    	$opxBtnEdit = $('.opx_btn_edit');
   		$opxBtnDelete = $('.opx_btn_delete');
    	
    	$opxBtnEdit.unbind('click');
    	$opxBtnDelete.unbind('click');  
    	  	
    	$opxBtnEdit.bind('click',function(event){
    		$this = $(this);
    		row = opxtable.row($this.parent().parent()).data();
    		$this.trigger('clickEdit');
    	});
    	
    	$opxBtnDelete.click(function(event){
    		$this = $(this);
    		row = opxtable.row($this.parent().parent()).data();
    		$this.trigger('clickDelete');
    	});    	
    });
};

//OpxDataTable.prototype.get