<div class="row">
	<ul class="nav nav-pills">
	  <li role="presentation" class="active"><a href="<?php echo base_url();?>addcontenedor"><i class="fa fa-plus-square"></i> Agregar</a></li>
	  <li role="presentation"><a href="<?php echo base_url();?>editdontenedor/0"><i class="fa fa-pencil"></i> Editar</a></li>
	  <li role="presentation"><a href="<?php echo base_url();?>deletecontenedor/0"><i class="fa fa-trash"></i> Eliminar</a></li>
	</ul>
</div>
<div class="row">
	<div style="height:20px;"></div>
	<div class="panel panel-default">
		<div style="height:20px;"></div>
		<?php if(isset($message)): ?>
			<div class="row">
				<div class="col-md-4 col-md-offset-2">
					<div class="alert alert-success"><?php echo $message; ?></div>
				</div>
			</div>
		<?php endif; ?>		
		<form class="form-horizontal" method="POST" action="<?php echo base_url();?>addcontenedor">
		  <div class="form-group">
		    <label for="code" class="col-sm-2 control-label">Tipo</label>
		    <div class="col-sm-2 <?php if(form_error('tipo')!='') echo 'has-error';?>">
		      <input name="tipo" type="text" class="form-control" id="tipo" placeholder="Tipo" value="<?php echo set_value('tipo'); ?>" aria-describedby="inputError2Status">
		      <?php echo form_error('tipo'); ?>
		    </div>
		    <label for="code" class="col-sm-2 control-label">Pies</label>
		    <div class="col-sm-2 <?php if(form_error('pies')!='') echo 'has-error';?>">
		      <input name="pies" type="text" class="form-control" id="pies" placeholder="Pies" value="<?php echo set_value('pies'); ?>" aria-describedby="inputError2Status">
		      <?php echo form_error('pies'); ?>
		    </div>
		  </div>
		  
		  
		  <div class="form-group">
		    <label for="code" class="col-sm-2 control-label">Capacidad</label>
		    <div class="col-sm-2 <?php if(form_error('volumen')!='') echo 'has-error';?>">
		      <div class="input-group">
		      	<input name="volumen" type="text" class="form-control" id="volumen" placeholder="Volumen" value="<?php echo set_value('volumen'); ?>" aria-describedby="inputError2Status">
		      	<div class="input-group-addon">m3</div>		 
		      </div>
		      <?php echo form_error('volumen'); ?>
		    </div>
		    <label for="code" class="col-sm-1 control-label">Max Playload</label>
		    <div class="col-sm-2 <?php if(form_error('peso')!='') echo 'has-error';?>">
		      <div class="input-group">
		      	<input name="peso" type="text" class="form-control" id="peso" placeholder="Peso" value="<?php echo set_value('peso'); ?>" aria-describedby="inputError2Status">
		      	<div class="input-group-addon">Kg</div>
		      </div>
			  <?php echo form_error('peso'); ?>		      
		    </div>
		    <label for="code" class="col-sm-1 control-label">Tare</label>
		    <div class="col-sm-2 <?php if(form_error('tare')!='') echo 'has-error';?>">
		      <div class="input-group">
		      	<input name="tare" type="text" class="form-control" id="tare" placeholder="Tare" value="<?php echo set_value('tare'); ?>" aria-describedby="inputError2Status">
		      	<div class="input-group-addon">Kg</div>
		      </div>
		      <?php echo form_error('tare'); ?>
		    </div>		    
		  </div>
		  
		  
		  <div class="form-group">
		    <label for="code" class="col-sm-2 control-label">Inside Width</label>
		    <div class="col-sm-2">
		    	<div class="input-group">
		      		<input name="inside_width" type="text" class="form-control" id="inside_width" placeholder="Inside Width" value="<?php echo set_value('inside_width'); ?>" aria-describedby="inputError2Status">
		      		<div class="input-group-addon">mm</div>
		      	</div>
		    </div>
		    <label for="code" class="col-sm-1 control-label">Inside Height</label>
		    <div class="col-sm-2">
		      <div class="input-group">
			      <input name="inside_height" type="text" class="form-control" id="inside_height" placeholder="inside_height" value="<?php echo set_value('inside_height'); ?>" aria-describedby="inputError2Status">
			      <div class="input-group-addon">mm</div>
			  </div>
		    </div>
		    <label for="code" class="col-sm-1 control-label">Inside Lenght</label>
		    <div class="col-sm-2">
		      <div class="input-group">
		      	<input name="inside_lenght" type="text" class="form-control" id="inside_lenght" placeholder="inside_lenght" value="<?php echo set_value('inside_lenght'); ?>" aria-describedby="inputError2Status">
		      	<div class="input-group-addon">mm</div>
		      </div>
		    </div>		    
		  </div>	
		  
		  
		  
		  <div class="form-group">
		    <label for="code" class="col-sm-2 control-label">Door Width</label>
		    <div class="col-sm-2">
		    	<div class="input-group">
		      		<input name="door_width" type="text" class="form-control" id="door_width" placeholder="Inside Width" value="<?php echo set_value('door_width'); ?>" aria-describedby="inputError2Status">
		      		<div class="input-group-addon">mm</div>
		      	</div>
		    </div>
		    <label for="code" class="col-sm-1 control-label">Door Height</label>
		    <div class="col-sm-2">
		      <div class="input-group">
			      <input name="door_height" type="text" class="form-control" id="door_height" placeholder="door_height" value="<?php echo set_value('door_height'); ?>" aria-describedby="inputError2Status">
			      <div class="input-group-addon">mm</div>
			  </div>
		    </div>		    
		  </div>		  	  
		  
		  
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button id="opx_btn_action" type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i> Agregar</button>
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
	            <th>Tipo</th>
	            <th>Pies</th>
	            <th>Capacity</th>
	            <th>Max playload</th>
	            <th>Inside Width</th>
	            <th>Inside Height</th>
	            <th>Inside Lenght</th>
	            <th>Door Width</th>
	            <th>Door Height</th>
	            <th>opt</th>
	        </tr>
	    </thead>
	    <tfoot>
	        <tr>
	            <th>ID</th>
	            <th>Tipo</th>
	            <th>Pies</th>
	            <th>Capacity</th>
	            <th>Max playload</th>
	            <th>Inside Width</th>
	            <th>Inside Height</th>
	            <th>Inside Lenght</th>
	            <th>Door Width</th>
	            <th>Door Height</th>
	            <th>opt</th>
	        </tr>
	    </tfoot>
	    	<tbody>
	    		<?php if($rows): ?>
		    		<?php foreach($rows as $row): ?>
		    			<tr>
		    				<td><?php echo $row['idcontenedor'] ?></td>
		    				<td><?php echo $row['tipo'] ?></td>
		    				<td><?php echo $row['pies'] ?></td>
		    				<td><?php echo $row['volumen'] ?></td>
		    				<td><?php echo $row['peso'] ?></td>
		    				<td><?php echo $row['inside_width'] ?></td>
		    				<td><?php echo $row['inside_height'] ?></td>
		    				<td><?php echo $row['inside_lenght'] ?></td>
		    				<td><?php echo $row['door_width'] ?></td>
		    				<td><?php echo $row['door_height'] ?></td>
		    				<td>
		    					<a href="<?php echo base_url();?>editcontenedor/<?php echo $row['idcontenedor'];?>" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
		    					<a href="<?php echo base_url();?>deletecontenedor/<?php echo $row['idcontenedor'];?>" class="btn btn-warning btn-xs"><i class="fa fa-trash"></i></a>
		    				</td>
		    			</tr>
		    		<?php endforeach; ?>
	    		<?php endif; ?>
	    	</tbody>
	</table>
</div>		        