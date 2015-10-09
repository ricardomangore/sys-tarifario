<div class="row">
	<ul class="nav nav-pills">
	  <li role="presentation" class="active"><a href="<?php echo base_url();?>addaeropuerto"><i class="fa fa-plus-square"></i> Agregar</a></li>
	  <li role="presentation"><a href="<?php echo base_url();?>editaeropuerto/0"><i class="fa fa-pencil"></i> Editar</a></li>
	  <li role="presentation"><a href="<?php echo base_url();?>deleteaeropuerto/0"><i class="fa fa-trash"></i> Eliminar</a></li>
	</ul>
</div>
<div class="row">
	<div style="height:20px;"></div>
	<div class="panel panel-default">
		<div style="height:20px;"></div>
		<div class="row">
			<div class="col-sm-4 col-sm-offset-2">
			<?php echo validation_errors('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ','</div>'); ?>
			</div>
		</div>
		<form class="form-horizontal" method="POST" action="<?php echo base_url();?>addaeropuerto">
		  <div class="form-group <?php if(form_error('code')!='') echo 'has-error';?>">
		    <label for="code" class="col-sm-2 control-label">Code</label>
		    <div class="col-sm-4">
		      <input name="code" type="text" class="form-control" id="code" placeholder="Code" value="<?php echo set_value('code'); ?>" aria-describedby="inputError2Status">
		    </div>
		  </div>
		  <div class="form-group <?php if(form_error('pais')!='') echo 'has-error';?>">
		    <label for="pais" class="col-sm-2 control-label">País</label>
		    <div class="col-sm-4">
		      <input name="pais" type="text" class="form-control" id="pais" placeholder="País" value="<?php echo set_value('pais'); ?>" aria-describedby="inputError2Status">
		    </div>
		  </div>
		  <div class="form-group <?php if(form_error('ciudad')!='') echo 'has-error';?>">
		    <label for="ciudad" class="col-sm-2 control-label">Ciudad</label>
		    <div class="col-sm-4">
		      <input name="ciudad" type="text" class="form-control" id="ciudad" placeholder="Ciudad" value="<?php echo set_value('ciudad'); ?>" aria-describedby="inputError2Status">
		    </div>
		  </div>		  		
		  <div class="form-group <?php if(form_error('aeropuerto')!='') echo 'has-error';?>">
		    <label for="aeropuerto" class="col-sm-2 control-label">Aeropuerto</label>
		    <div class="col-sm-4">
		      <input name="aeropuerto" type="text" class="form-control" id="aeropuerto" placeholder="Aeropuerto" value="<?php echo set_value('aeropuerto'); ?>" aria-describedby="inputError2Status">
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button id="opx_btn_action" type="submit" class="btn btn-primary">Agregar</button>
		    </div>			    
		  </div>
		</form>
	</div>
	<div style="height: 30px;"></div>
	<!-- Catálogo de Aeropuertos -->
	<table id="opxtable" class="display table table-hover" cellspacing="0" width="100%">
	    <thead>
	        <tr>
	            <th>ID</th>
	            <th>Code</th>
	            <th>País</th>
	            <th>Ciudad</th>
	            <th>Aeropuerto</th>
	            <th>opt</th>
	        </tr>
	    </thead>
	    <tfoot>
	        <tr>
	            <th>ID</th>
	            <th>Code</th>
	            <th>País</th>
	            <th>Ciudad</th>
	            <th>Aeropuerto</th>
	            <th>opt</th>
	        </tr>
	    </tfoot>
	    	<tbody>
	    		<?php if($rows): ?>
		    		<?php foreach($rows as $row): ?>
		    			<tr>
		    				<td><?php echo $row['idaeropuerto'] ?></td>
		    				<td><?php echo $row['code'] ?></td>
		    				<td><?php echo $row['pais'] ?></td>
		    				<td><?php echo $row['ciudad'] ?></td>
		    				<td><?php echo $row['aeropuerto'] ?></td>
		    				<td>
		    					<a href="<?php echo base_url();?>editaeropuerto/<?php echo $row['idaeropuerto'];?>" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
		    					<a href="<?php echo base_url();?>deleteaeropuerto/<?php echo $row['idaeropuerto'];?>" class="btn btn-warning btn-xs"><i class="fa fa-trash"></i></a>
		    				</td>
		    			</tr>
		    		<?php endforeach; ?>
	    		<?php endif; ?>
	    	</tbody>
	</table>
</div>		        