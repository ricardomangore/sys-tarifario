<div class="row">
	<ul class="nav nav-pills">
	  <li role="presentation" class="active"><a href="<?php echo base_url();?>addflete_maritimo"><i class="fa fa-plus-square"></i> Agregar</a></li>
	  <li role="presentation"><a href="<?php echo base_url();?>editflete_maritimo/0"><i class="fa fa-pencil"></i> Editar</a></li>
	  <li role="presentation"><a href="<?php echo base_url();?>deleteflete_maritimo/0"><i class="fa fa-trash"></i> Eliminar</a></li>
	</ul>
</div>
<div class="row">
	<div style="height:20px;"></div>
	<div class="panel panel-default">
		<div style="height:20px;"></div>
		<form class="form-horizontal" method="POST" action="<?php echo base_url();?>addflete_maritimo">		

		  <div class="form-group">
		  	<label for="destino" class="col-sm-2 control-label">Origen</label>
		  	<div class="col-sm-2 <?php if(form_error('pol')!='') echo 'has-error';?>">
			  	<select class="select_origen" data-live-search="true" name="pol">
					<option value="none">Seleccione un Origen</option>			  	
			  		<?php foreach($puertos as $puerto): ?>
			  			<option value="<?php echo $puerto['idpuerto']?>" <?php echo set_select('pol',$puerto['idpuerto']);?>><?php echo $puerto['locode'] .' '. $puerto['puerto'];?></option>
			  		<?php endforeach; ?>
			  	</select>
			  	<?php echo form_error('pol'); ?>
			</div>
		  	<label for="destino" class="col-sm-2 control-label">Destino</label>
		  	<div class="col-sm-2 <?php if(form_error('pod')!='') echo 'has-error';?>">
			  	<select class="select_destino" data-live-search="true" name="pod">
			  		<option value="none">Seleccione un Destino</option>
			  		<?php foreach($puertos as $puerto): ?>
			  			<option value="<?php echo $puerto['idpuerto']?>" <?php echo set_select('pod',$puerto['idpuerto']); ?>><?php echo $puerto['locode'] .' '. $puerto['puerto'];?></option>
			  		<?php endforeach; ?>
			  	</select>
			  	<?php echo form_error('pod'); ?>
			</div>			
		  </div>

		  <div class="form-group">
		    <label for="naviera" class="col-sm-2 control-label">Naviera</label>
		    <div class="col-sm-2 <?php if(form_error('idnaviera')!='') echo 'has-error';?>">
		      <select class="select_naviera" data-live-search='true' name="idnaviera">
		      	<option value="none">Seleccione una Naviera</option>
		      	<?php foreach($navieras as $naviera):?>
		      		<option value="<?php echo $naviera['idnaviera'];?>" <?php echo set_select('idnaviera',$naviera['idnaviera']); ?> <?php echo set_select('idnaviera',$naviera['idnaviera']);?>><?php echo $naviera['naviera'];?></option>
		    	<?php endforeach; ?>
		      </select>
		      <?php echo form_error('idnaviera'); ?>
		    </div>
		  	<label for="recargos" class="col-sm-2 control-label">Recargos</label>
		  	<div class="col-sm-2">
			  	<select class="select_recargos" data-live-search="true" name="idrecargos[]" multiple>
			  		<option value="none">Seleccione los recargos</option>
			  		<?php foreach($recargos as $recargo): ?>
			  			<option value="<?php echo $recargo['idrecargo_maritimo']?>" <?php echo set_select('idrecargos[]',$recargo['idrecargo_maritimo']);?>><?php echo $recargo['clave'] .' '. $recargo['costo'] .' '. $recargo['naviera'];?></option>
			  		<?php endforeach; ?>
			  	</select>
			</div>
		  	<label for="recargos" class="col-sm-1 control-label">Región</label>
		  	<div class="col-sm-2 <?php if(form_error('idregion')!='') echo 'has-error';?>">
			  	<select class="select_region" data-live-search="true" name="idregion">
			  		<option value="none">Seleccione una Región</option>
			  		<?php foreach($regiones as $region): ?>
			  			<option value="<?php echo $region['idregion']?>" <?php echo set_select('idregion',$region['idregion']); ?>><?php echo $region['region'];?></option>
			  		<?php endforeach; ?>
			  	</select>
			  	<?php echo form_error('idregion'); ?>
			</div>		    
		  </div>		  
		  
		  <div class="form-group">
				<label class="control-label col-md-3">
				  <input type="radio" name="chkbox_via" id="inlineRadio1" value="directo" checked> Directo
				</label>
				<label class="control-label col-md-2">
				  <input type="radio" name="chkbox_via" id="inlineRadio2" value="escalas"> Con Escalas
				</label>
			  	<label for="destino" class="col-sm-1 control-label">Via</label>
			  	<div class="col-sm-2">
				  	<select class="select_via" data-live-search="true" name="idvias[]" multiple>
				  		<option value="none">Seleccione los transbordos</option>
				  		<?php foreach($puertos as $puerto): ?>
				  			<option value="<?php echo $puerto['idpuerto']?>" <?php echo set_select('idvias[]',$puerto['idpuerto']);?>><?php echo $puerto['locode'] .' '. $puerto['puerto'];?></option>
				  		<?php endforeach; ?>
				  	</select>
				</div>				
		  </div>
		  
		  <div class="form-group">
		  	<label class="control-label col-md-3">
		  		<input type="radio" name="tipo" value="exportacion" checked> Exportación
		  	</label>
		  	<label class="control-label col-md-2">
		  		<input type="radio" name="tipo" value="importacion"> Importación
		  	</label>
		  </div>		  
		  <div class="form-group">
				<label class="control-label col-md-3">
				  <input type="radio" name="chkbox_carga" id="inlineRadio1" value="contenedor" checked> Contenedor
				</label>
				<label class="control-label col-md-2">
				  <input type="radio" name="chkbox_carga" id="inlineRadio2" value="consolidado"> Consolidado
				</label>				
		  </div>
		  
		  <div class="form-group">
		  		<label for="contenedor" class="col-sm-2 control-label">Contenedor</label>
			  	<div class="col-sm-2">
				  	<select class="select_contenedor" data-live-search="true" name="idcontenedor">
				  		<option value="none">Seleccione los transbordos</option>
				  		<?php foreach($contenedores as $contenedor): ?>
				  			<option value="<?php echo $contenedor['idcontenedor'].'_'.$contenedor['idcarga']?>" <?php echo set_select('idcontenedor',$contenedor['idcontenedor']); ?>><?php echo $contenedor['tipo'] . "  " . $contenedor['pies'];?></option>
				  		<?php endforeach; ?>
				  	</select>
				</div>
			  	<label for="precio" class="col-sm-2 control-label">Mínimo</label>
			  	<div class="col-sm-2">
			  		<div class="input-group">
			  			<div class="input-group-addon">$</div>
			  			<input type="text" name="minimo" class="form-control" value="<?php echo set_value('minimo');?>">
				    </div>
				</div>				
		  </div>
		  			  

		  <div class="form-group">
		  	<label for="vigencia" class="col-sm-2 control-label">Vigencia</label>
		  	<div class="col-sm-2 <?php if(form_error('vigencia')!='') echo 'has-error';?>">
				<input type="text" name="vigencia" class="form-control" value="<?php echo set_value('vigencia');?>">
				<?php echo form_error('vigencia');?>
			</div>
		  	<label for="minimo" class="col-sm-1 control-label">Tiepo de Transito</label>
		  	<div class="col-sm-2">
		  		<div class="input-group">
		  			<input type="text" name="tt" class="form-control" value="<?php echo set_value('tt');?>">
		  			<div class="input-group-addon">Días</div>
			    </div>
			</div>			
		  </div>
		  
		  <div class="form-group">
		  	<label for="normal" class="col-sm-2 control-label">Precio</label>
		  	<div class="col-sm-2">
		  		<div class="input-group">
		  			<div class="input-group-addon">$</div>
						<input type="text" name="precio" class="form-control" value="<?php echo set_value('precio');?>">
			    </div>
			    <?php echo form_error('precio');?>
			</div>	
		  	<label for="normal" class="col-sm-1 control-label">Profit</label>
		  	<div class="col-sm-2">
		  		<div class="input-group">
		  			<div class="input-group-addon">$</div>
						<input type="text" name="profit" class="form-control" value="<?php echo set_value('profit');?>">
			    </div>
			    <?php echo form_error('profit');?>
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
	            <th>Región</th>
	            <th>Naviera</th>
	            <th>Origen</th>
	            <th>Destino</th>
	            <th>Vigencia</th>
	            <th>Via</th>
	            <th>TT</th>
	            <th>Precio</th>
	            <th>Recargos</th>
	            <th>opt</th>
	        </tr>
	    </thead>
	    <tfoot>
	        <tr>
	            <th>ID</th>
	            <th>Región</th>
	            <th>Naviera</th>
	            <th>Origen</th>
	            <th>Destino</th>
	            <th>Vigencia</th>
	            <th>Via</th>
	            <th>TT</th>
	            <th>Precio</th>
	            <th>Recargos</th>
	            <th>opt</th>
	        </tr>
	    </tfoot>
	    	<tbody>
	    	
	    		<?php if($rows): ?>
		    		<?php foreach($rows as $row): ?>
		    			<tr>		    	
		    				<td><?php echo $row['flete_maritimo']['idflete_maritimo']; ?></td>
		    				<td><?php echo $row['flete_maritimo']['region']; ?></td>
		    				<td><?php echo $row['flete_maritimo']['naviera']; ?></td>
		    				<td><?php echo $row['pol']['locode'] .' - '. $row['pol']['puerto'];?></td>
		    				<td><?php echo $row['pod']['locode'] .' - '. $row['pod']['puerto'];?></td>
		    				<td><?php echo $row['flete_maritimo']['vigencia']; ?></td>
		    				<td>
		    					<?php foreach($row['via'] as $value){
		    						echo $value['locode'] .' '.  $value['puerto']. '<br/>';	
		    					};?>
		    				</td>
		    				<th><?php echo $row['flete_maritimo']['tt']; ?></th>
		    				<th><?php echo $row['flete_maritimo']['precio']; ?></th>
	    					<td>
	    						<?php 
	    							foreach($row['recargos'] as $recargo){
	    								echo "Clave: " . $recargo['clave'] . "<br/>";
										echo "Descripción: " . $recargo['descripcion'] . "<br/>";
										echo "Precio: $ " . $recargo['costo'] . "<hr><br/>";								
	    							}
	    						?>
	    					</td>
		    				<td>
		    					<a href="<?php echo base_url();?>editflete_aereo/<?php echo $row['flete_maritimo']['idflete_maritimo'];?>" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
		    					<a href="<?php echo base_url();?>deleteflete_aereo/<?php echo $row['flete_maritimo']['idflete_maritimo'];?>" class="btn btn-warning btn-xs"><i class="fa fa-trash"></i></a>
		    				</td>
		    			</tr>
		    		<?php endforeach; ?>
	    		<?php endif; ?>
	    	</tbody>
	</table>
</div>		        