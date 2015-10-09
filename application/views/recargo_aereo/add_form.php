<div class="row">
	<ul class="nav nav-pills">
	  <li role="presentation" class="active"><a href="<?php echo base_url();?>addarecargo_aereo"><i class="fa fa-plus-square"></i> Agregar</a></li>
	  <li role="presentation"><a href="<?php echo base_url();?>editrecargo_aereo/0"><i class="fa fa-pencil"></i> Editar</a></li>
	  <li role="presentation"><a href="<?php echo base_url();?>deleterecargo_aereo/0"><i class="fa fa-trash"></i> Eliminar</a></li>
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
		<form class="form-horizontal" method="POST" action="<?php echo base_url();?>addrecargo_aereo">
		  <div class="form-group <?php if(form_error('clave')!='') echo 'has-error';?>">
		    <label for="clave" class="col-sm-2 control-label">Clave</label>
		    <div class="col-sm-4">
		      <input name="clave" type="text" class="form-control" id="clave" placeholder="Clave" value="<?php echo set_value('clave'); ?>" aria-describedby="inputError2Status">
		    </div>
		  </div>
		  <div class="form-group <?php if(form_error('descripcion')!='') echo 'has-error';?>">
		    <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
		    <div class="col-sm-4">
		      <input name="descripcion" type="text" class="form-control" id="descripcion" placeholder="Descripción" value="<?php echo set_value('descripcion'); ?>" aria-describedby="inputError2Status">
		    </div>
		  </div>
		  <div class="form-group <?php if(form_error('costo')!='') echo 'has-error';?>">
		    <label for="costo" class="col-sm-2 control-label">Costo</label>
		    <div class="col-sm-4">
		      <input name="costo" type="text" class="form-control" id="costo" placeholder="Costo" value="<?php echo set_value('costo'); ?>" aria-describedby="inputError2Status">
		    </div>
		  </div>		  		
		  <div class="form-group <?php if(form_error('idaerolinea')!='') echo 'has-error';?>">
		    <label for="aeropuerto" class="col-sm-2 control-label">Aerolínea</label>
		    <div class="col-sm-4">
		      <select class="select_aerolinea" data-live-search='true' name="idaerolinea">
		      	<option value="none">Seleccione una aerolínea</option>
		      	<?php foreach($aerolineas as $aerolinea):?>
		      		<option value="<?php echo $aerolinea['idaerolinea'];?>" <?php echo set_select('idaerolinea',$aerolinea['idaerolinea']); ?>><?php echo $aerolinea['aerolinea'];?></option>
		    	<?php endforeach; ?>
		      </select>
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
		    				<td><?php echo $row['idrecargo_aereo'] ?></td>
		    				<td><?php echo $row['clave'] ?></td>
		    				<td><?php echo $row['costo'] ?></td>
		    				<td><?php echo $row['descripcion'] ?></td>
		    				<td><?php echo $row['aerolinea'] ?></td>
		    				<td>
		    					<a href="<?php echo base_url();?>editrecargo_aereo/<?php echo $row['idrecargo_aereo'];?>" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
		    					<a href="<?php echo base_url();?>deleterecargo_aereo/<?php echo $row['idrecargo_aereo'];?>" class="btn btn-warning btn-xs"><i class="fa fa-trash"></i></a>
		    				</td>
		    			</tr>
		    		<?php endforeach; ?>
	    		<?php endif; ?>
	    	</tbody>
	</table>
</div>		        