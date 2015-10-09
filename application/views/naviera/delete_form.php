<div class="row">
	<ul class="nav nav-pills">
	  <li role="presentation"><a href="<?php echo base_url();?>addnaviera"><i class="fa fa-plus-square"></i> Agregar</a></li>
	  <li role="presentation"><a href="<?php echo base_url();?>editnaviera/0"><i class="fa fa-pencil"></i> Editar</a></li>
	  <li role="presentation"  class="active"><a href="<?php echo base_url();?>deletenaviera/0"><i class="fa fa-trash"></i> Eliminar</a></li>
	</ul>
</div>
<div class="row">
	<div style="height:20px;"></div>
	<div class="panel panel-default">
		<div style="height:20px;"></div>
		<div class="row">
			<?php echo validation_errors('<div class="col-sm-4 col-sm-offset-2"><div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ','</div></div>'); ?>
		</div>
		<form class="form-horizontal" method="POST" action="<?php echo base_url();?>deletenaviera/0">
		  <div class="form-group <?php if(form_error('naviera')!='') echo 'has-error';?>">
		    <label for="naviera" class="col-sm-2 control-label">Naviera</label>
		    <div class="col-sm-4">
		      <input name="naviera" type="text" class="form-control" id="naviera" placeholder="Naviera" value="<?php if(isset($naviera)) echo $naviera;?>" aria-describedby="inputError2Status">
		      <input name="idnaviera" type="hidden" class="form-control" value="<?php if(isset($idnaviera)) echo $idnaviera; ?>">
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button id="opx_btn_action" type="submit" class="btn btn-primary"><i class="fa fa-trash"></i> Eliminar</button>
		    </div>			    
		  </div>
		</form>
	</div>
	<div style="height: 30px;"></div>
	<!-- Catálogo de Naviera -->
	<table id="opxtable" class="display table table-hover" cellspacing="0" width="100%">
	    <thead>
	        <tr>
	            <th>ID</th>
	            <th>Naviera</th>
	            <th>opt</th>
	        </tr>
	    </thead>
	    <tfoot>
	        <tr>
	            <th>ID</th>
	            <th>Naviera</th>
	            <th>opt</th>
	        </tr>
	    </tfoot>
	    	<tbody>
	    		<?php if($rows): ?>
		    		<?php foreach($rows as $row): ?>
		    			<tr>
		    				<td><?php echo $row['idnaviera'] ?></td>
		    				<td><?php echo $row['naviera'] ?></td>
		    				<td>
		    					<a href="<?php echo base_url();?>editnaviera/<?php echo $row['idnaviera'];?>" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
		    					<a href="<?php echo base_url();?>deletenaviera/<?php echo $row['idnaviera'];?>" class="btn btn-warning btn-xs"><i class="fa fa-trash"></i></a>
		    				</td>
		    			</tr>
		    		<?php endforeach; ?>
	    		<?php endif; ?>
	    	</tbody>
	</table>
</div>
		        