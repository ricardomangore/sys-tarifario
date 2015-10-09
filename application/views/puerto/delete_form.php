<div class="row">
	<ul class="nav nav-pills">
	  <li role="presentation"><a href="<?php echo base_url();?>addpuerto"><i class="fa fa-plus-square"></i> Agregar</a></li>
	  <li role="presentation"><a href="<?php echo base_url();?>editpuerto/0"><i class="fa fa-pencil"></i> Editar</a></li>
	  <li role="presentation class="active"><a href="<?php echo base_url();?>deletepuerto/0"><i class="fa fa-trash"></i> Eliminar</a></li>
	</ul>
</div>
<div class="row">
	<div style="height:20px;"></div>
	<div class="panel panel-default">
		<div style="height:20px;"></div>
		<div class="row">
			<?php echo validation_errors('<div class="col-sm-4 col-sm-offset-2"><div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ','</div></div>'); ?>
			<?php if(isset($message)){
				echo '<div class="col-sm-4 col-sm-offset-2"><div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <strong>No se puede eliminar el recargo</strong><p>'.$message.'</p></div></div>';
			}?>
		</div>
		<form class="form-horizontal" method="POST" action="<?php echo base_url();?>deletepuerto/0">
		  <div class="form-group">
		    <label for="code" class="col-sm-2 control-label">Locoode</label>
		    <div class="col-sm-4">
		      <input name="locode" type="text" class="form-control" id="locode" placeholder="Loode" value="<?php if(isset($locode)) echo $locode; ?>" aria-describedby="inputError2Status">
		      <input name="idpuerto" type="hidden" class="form-control" value="<?php if(isset($idpuerto)) echo $idpuerto; ?>">
		    </div>
		  </div>
		  <div class="form-group <?php if(form_error('puerto')!='') echo 'has-error';?>">
		    <label for="pais" class="col-sm-2 control-label">Puerto</label>
		    <div class="col-sm-4">
		      <input name="puerto" type="text" class="form-control" id="puerto" placeholder="Puerto" value="<?php if(isset($puerto)) echo $puerto; ?>" aria-describedby="inputError2Status">
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
	<!-- Catálogo de Aeropuertos -->
	<table id="opxtable" class="display table table-hover" cellspacing="0" width="100%">
	    <thead>
	        <tr>
	            <th>ID</th>
	            <th>Locode</th>
	            <th>Puerto</th>
	            <th>opt</th>
	        </tr>
	    </thead>
	    <tfoot>
	        <tr>
	            <th>ID</th>
	            <th>Locode</th>
	            <th>Puerto</th>
	            <th>opt</th>
	        </tr>
	    </tfoot>
	    	<tbody>
	    		<?php if($rows): ?>
		    		<?php foreach($rows as $row): ?>
		    			<tr>
		    				<td><?php echo $row['idpuerto'] ?></td>
		    				<td><?php echo $row['locode'] ?></td>
		    				<td><?php echo $row['puerto'] ?></td>
		    				<td>
		    					<a href="<?php echo base_url();?>editpuerto/<?php echo $row['idpuerto'];?>" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
		    					<a href="<?php echo base_url();?>deletepuerto/<?php echo $row['idpuerto'];?>" class="btn btn-warning btn-xs"><i class="fa fa-trash"></i></a>
		    				</td>
		    			</tr>
		    		<?php endforeach; ?>
	    		<?php endif; ?>
	    	</tbody>
	</table>
</div>		        