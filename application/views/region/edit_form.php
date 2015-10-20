<div class="row">
	<ul class="nav nav-pills">
	  <li role="presentation"><a href="<?php echo base_url();?>addregion"><i class="fa fa-plus-square"></i> Agregar</a></li>
	  <li role="presentation" class="active"><a href="<?php echo base_url();?>editregion/0"><i class="fa fa-pencil"></i> Editar</a></li>
	  <li role="presentation"><a href="<?php echo base_url();?>deleteregion/0"><i class="fa fa-trash"></i> Eliminar</a></li>
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
		<form class="form-horizontal" method="POST" action="<?php echo base_url();?>editregion/<?php if(isset($idregion)) echo $idregion; else echo 0;?>">
		  <div class="form-group <?php if(form_error('region')!='') echo 'has-error';?>">
		    <label for="region" class="col-sm-2 control-label">Región</label>
		    <div class="col-sm-4">
		      <input name="region" type="text" class="form-control" id="region" placeholder="Región" value="<?php if(isset($region)) echo $region; ?>" aria-describedby="inputError2Status">
		      <input name="idregion" type="hidden" class="form-control" value="<?php if(isset($idregion)) echo $idregion; ?>">
		      <?php echo form_error('region'); ?>
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button id="opx_btn_action" type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Editar</button>
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
	            <th>Región</th>
	            <th>opt</th>
	        </tr>
	    </thead>
	    <tfoot>
	        <tr>
	            <th>ID</th>
	            <th>Región</th>
	            <th>opt</th>
	        </tr>
	    </tfoot>
	    	<tbody>
	    		<?php if($rows): ?>
		    		<?php foreach($rows as $row): ?>
		    			<tr>
		    				<td><?php echo $row['idregion'] ?></td>
		    				<td><?php echo $row['region'] ?></td>
		    				<td>
		    					<a href="<?php echo base_url();?>editregion/<?php echo $row['idregion'];?>" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
		    					<a href="<?php echo base_url();?>deleteregion/<?php echo $row['idregion'];?>" class="btn btn-warning btn-xs"><i class="fa fa-trash"></i></a>
		    				</td>
		    			</tr>
		    		<?php endforeach; ?>
	    		<?php endif; ?>
	    	</tbody>
	</table>
</div>