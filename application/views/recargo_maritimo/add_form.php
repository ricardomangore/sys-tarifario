<div class="row">
	<ul class="nav nav-pills">
	  <li role="presentation" class="active"><a href="<?php echo base_url();?>addarecargo_maritimo"><i class="fa fa-plus-square"></i> Agregar</a></li>
	  <li role="presentation"><a href="<?php echo base_url();?>editrecargo_maritimo/0"><i class="fa fa-pencil"></i> Editar</a></li>
	  <li role="presentation"><a href="<?php echo base_url();?>deleterecargo_maritimo/0"><i class="fa fa-trash"></i> Eliminar</a></li>
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
		<form class="form-horizontal" method="POST" action="<?php echo base_url();?>addrecargo_maritimo">
		  <div class="form-group <?php if(form_error('clave')!='') echo 'has-error';?>">
		    <label for="clave" class="col-sm-2 control-label">Clave</label>
		    <div class="col-sm-4">
		      <input name="clave" type="text" class="form-control" id="clave" placeholder="Clave" value="<?php echo set_value('clave'); ?>" aria-describedby="inputError2Status">
		      <?php echo form_error('clave'); ?>
		    </div>
		  </div>
		  <div class="form-group <?php if(form_error('descripcion')!='') echo 'has-error';?>">
		    <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
		    <div class="col-sm-4">
		      <input name="descripcion" type="text" class="form-control" id="descripcion" placeholder="Descripción" value="<?php echo set_value('descripcion'); ?>" aria-describedby="inputError2Status">
		      <?php echo form_error('descripcion'); ?>
		    </div>
		  </div>
		  <div class="form-group <?php if(form_error('costo')!='') echo 'has-error';?>">
		    <label for="costo" class="col-sm-2 control-label">Costo</label>
		    <div class="col-sm-4">
		      <input name="costo" type="text" class="form-control" id="costo" placeholder="Costo" value="<?php echo set_value('costo'); ?>" aria-describedby="inputError2Status">
		      <?php echo form_error('costo'); ?>
		    </div>
		  </div>		  		
		  <div class="form-group <?php if(form_error('idnaviera')!='') echo 'has-error';?>">
		    <label for="aeropuerto" class="col-sm-2 control-label">Naviera</label>
		    <div class="col-sm-4">
		      <select class="select_aerolinea" data-live-search='true' name="idnaviera">
		      	<option value="none">Seleccione una naviera</option>
		      	<?php foreach($navieras as $naviera):?>
		      		<option value="<?php echo $naviera['idnaviera'];?>" <?php echo set_select('idnaviera',$naviera['idnaviera']); ?>><?php echo $naviera['naviera'];?></option>
		    	<?php endforeach; ?>
		      </select>
		      <?php echo form_error('idnaviera'); ?>
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
	<!-- Catálogo de Recargos Marítimos -->
	<table id="opxtable" class="display table table-hover" cellspacing="0" width="100%">
	    <thead>
	        <tr>
	            <th>ID</th>
	            <th>Clave</th>
	            <th>Costo</th>
	            <th>Descripción</th>
	            <th>Aerolínea</th>
	            <th>opt</th>
	        </tr>
	    </thead>
	    <tfoot>
	        <tr>
	            <th>ID</th>
	            <th>Clave</th>
	            <th>Costo</th>
	            <th>Descripción</th>
	            <th>Aerolínea</th>
	            <th>opt</th>
	        </tr>
	    </tfoot>
	    	<tbody>
	    		<?php if($rows): ?>
		    		<?php foreach($rows as $row): ?>
		    			<tr>
		    				<td><?php echo $row['idrecargo_maritimo'] ?></td>
		    				<td><?php echo $row['clave'] ?></td>
		    				<td><?php echo $row['costo'] ?></td>
		    				<td><?php echo $row['descripcion'] ?></td>
		    				<td><?php echo $row['naviera'] ?></td>
		    				<td>
		    					<a href="<?php echo base_url();?>editrecargo_maritimo/<?php echo $row['idrecargo_maritimo'];?>" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
		    					<a href="<?php echo base_url();?>deleterecargo_maritimo/<?php echo $row['idrecargo_maritimo'];?>" class="btn btn-warning btn-xs"><i class="fa fa-trash"></i></a>
		    				</td>
		    			</tr>
		    		<?php endforeach; ?>
	    		<?php endif; ?>
	    	</tbody>
	</table>
</div>		        