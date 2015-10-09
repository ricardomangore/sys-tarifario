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
		<form class="form-horizontal" method="POST" action="<?php echo base_url();?>addflete_aereo">		

		  <div class="form-group">
		  	<label for="destino" class="col-sm-2 control-label">Origen</label>
		  	<div class="col-sm-2 <?php if(form_error('aol')!='') echo 'has-error';?>">
			  	<select class="select_origen" data-live-search="true" name="aol">
					<option value="none">Seleccione un Origen</option>			  	
			  		<?php foreach($aeropuertos as $aeropuerto): ?>
			  			<option value="<?php echo $aeropuerto['idaeropuerto']?>"><?php echo $aeropuerto['code'] .' '. $aeropuerto['aeropuerto'];?></option>
			  		<?php endforeach; ?>
			  	</select>
			</div>
		  	<label for="destino" class="col-sm-1 control-label">Destino</label>
		  	<div class="col-sm-2 <?php if(form_error('aod')!='') echo 'has-error';?>">
			  	<select class="select_destino" data-live-search="true" name="aod">
			  		<option value="none">Seleccione un Destino</option>
			  		<?php foreach($aeropuertos as $aeropuerto): ?>
			  			<option value="<?php echo $aeropuerto['idaeropuerto']?>"><?php echo $aeropuerto['code'] .' '. $aeropuerto['aeropuerto'];?></option>
			  		<?php endforeach; ?>
			  	</select>
			</div>			
		  </div>

		  <div class="form-group">
		    <label for="aeropuerto" class="col-sm-2 control-label">Aerolínea</label>
		    <div class="col-sm-2 <?php if(form_error('idaerolinea')!='') echo 'has-error';?>">
		      <select class="select_aerolinea" data-live-search='true' name="idaerolinea">
		      	<option value="none">Seleccione una aerolínea</option>
		      	<?php foreach($aerolineas as $aerolinea):?>
		      		<option value="<?php echo $aerolinea['idaerolinea'];?>" <?php echo set_select('idaerolinea',$aerolinea['idaerolinea']); ?>><?php echo $aerolinea['aerolinea'];?></option>
		    	<?php endforeach; ?>
		      </select>
		    </div>
		  	<label for="recargos" class="col-sm-1 control-label">Recargos</label>
		  	<div class="col-sm-2">
			  	<select class="select_recargos" data-live-search="true" name="idrecargos[]" multiple>
			  		<option value="none">Seleccione los recargos</option>
			  		<?php foreach($recargos as $recargo): ?>
			  			<option value="<?php echo $recargo['idrecargo_aereo']?>"><?php echo $recargo['clave'] .' '. $recargo['costo'] .' '. $recargo['aerolinea'];?></option>
			  		<?php endforeach; ?>
			  	</select>
			</div>
		  	<label for="recargos" class="col-sm-1 control-label">Región</label>
		  	<div class="col-sm-2 <?php if(form_error('idregion')!='') echo 'has-error';?>">
			  	<select class="select_region" data-live-search="true" name="idregion">
			  		<option value="none">Seleccione una Región</option>
			  		<?php foreach($regiones as $region): ?>
			  			<option value="<?php echo $region['idregion']?>"><?php echo $region['region'];?></option>
			  		<?php endforeach; ?>
			  	</select>
			</div>		    
		  </div>		  
		  
		  <div class="form-group">
				<label class="control-label col-sm-3">
				  <input type="radio" name="chkbox_via" id="inlineRadio1" value="directo" checked> Directo
				</label>
				<label class="control-label col-sm-2">
				  <input type="radio" name="chkbox_via" id="inlineRadio2" value="escalas"> Con Escalas
				</label>
			  	<label for="destino" class="col-sm-1 control-label">Via</label>
			  	<div class="col-sm-2">
				  	<select class="select_via" data-live-search="true" name="idvias[]" multiple disabled>
				  		<option value="none">Seleccione los transbordos</option>
				  		<?php foreach($aeropuertos as $aeropuerto): ?>
				  			<option value="<?php echo $aeropuerto['idaeropuerto']?>"><?php echo $aeropuerto['code'] .' '. $aeropuerto['aeropuerto'];?></option>
				  		<?php endforeach; ?>
				  	</select>
				</div>				
		  </div>		  



		  <div class="form-group">
		  	<label for="vigencia" class="col-sm-2 control-label">Vigencia</label>
		  	<div class="col-sm-2 <?php if(form_error('vigencia')!='') echo 'has-error';?>">
				<input type="text" name="vigencia" class="form-control">
			</div>
		  	<label for="minimo" class="col-sm-1 control-label">Mínimo</label>
		  	<div class="col-sm-2">
		  		<div class="input-group">
		  			<div class="input-group-addon">$</div>
						<input type="text" name="minimo" class="form-control">
			    </div>
			</div>
		  	<label for="normal" class="col-sm-1 control-label">Normal</label>
		  	<div class="col-sm-2">
		  		<div class="input-group">
		  			<div class="input-group-addon">$</div>
						<input type="text" name="normal" class="form-control">
			    </div>
			</div>			
		  </div>




		  <div class="form-group">
		  	<label for="precio1" class="col-sm-2 control-label">+45Kg</label>
		  	<div class="col-sm-2 <?php if(form_error('precio1')!='') echo 'has-error';?>">
		  		<div class="input-group">
		  			<div class="input-group-addon">$</div>
					<input type="text" name="precio1" class="form-control">
				</div>
			</div>
		  	<label for="precio2" class="col-sm-1 control-label">+100Kg</label>
		  	<div class="col-sm-2 <?php if(form_error('precio2')!='') echo 'has-error';?>">
		  		<div class="input-group">
		  			<div class="input-group-addon">$</div>
						<input type="text" name="precio2" class="form-control">
				</div>
			</div>	
		  	<label for="precio3" class="col-sm-1 control-label">+300Kg</label>
		  	<div class="col-sm-2 <?php if(form_error('precio3')!='') echo 'has-error';?>">
		  		<div class="input-group">
		  			<div class="input-group-addon">$</div>
						<input type="text" name="precio3" class="form-control">
				</div>
			</div>					
		  </div>




		  <div class="form-group">
		  	<label for="precio4" class="col-sm-2 control-label">+500Kg</label>
		  	<div class="col-sm-2 <?php if(form_error('precio4')!='') echo 'has-error';?>">
		  		<div class="input-group">
		  			<div class="input-group-addon">$</div>
						<input type="text" name="precio4" class="form-control">
				</div>
			</div>
		  	<label for="precio5" class="col-sm-1 control-label">+1000Kg</label>
		  	<div class="col-sm-2 <?php if(form_error('precio5')!='') echo 'has-error';?>">
		  		<div class="input-group">
		  			<div class="input-group-addon">$</div>
						<input type="text" name="precio5" class="form-control">
				</div>
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
	            <th>Aerolínea</th>
	            <th>Origen</th>
	            <th>Destino</th>
	            <th>Vigencia</th>
	            <th>Via</th>
	            <th>Mínimo</th>
	            <th>Normal</th>
	            <th>+45Kg</th>
	            <th>+100Kg</th>
	            <th>+300Kg</th>
	            <th>+500Kg</th>
	            <th>+1000Kg</th>
	            <th>Recargos</th>
	            <th>opt</th>
	        </tr>
	    </thead>
	    <tfoot>
	        <tr>
	            <th>ID</th>
	            <th>Región</th>
	            <th>Aerolínea</th>
	            <th>Origen</th>
	            <th>Destino</th>
	            <th>Vigencia</th>
	            <th>Via</th>
	            <th>Mínimo</th>
	            <th>Normal</th>
	            <th>+45Kg</th>
	            <th>+100Kg</th>
	            <th>+300Kg</th>
	            <th>+500Kg</th>
	            <th>+1000Kg</th>
	            <th>Recargos</th>
	            <th>opt</th>
	        </tr>
	    </tfoot>
	    	<tbody>
	    		<?php if($rows): ?>
		    		<?php foreach($rows as $row): ?>
		    			<tr>		    	
		    				<td><?php echo $row['flete_aereo']['idflete_aereo']; ?></td>
		    				<td><?php echo $row['flete_aereo']['region']; ?></td>
		    				<td><?php echo $row['flete_aereo']['aerolinea']; ?></td>
		    				<td><?php echo $row['aol']['code'] .' - '. $row['aol']['aeropuerto'];?></td>
		    				<td><?php echo $row['aod']['code'] .' - '. $row['aod']['aeropuerto'];?></td>
		    				<td><?php echo $row['flete_aereo']['vigencia']; ?></td>
		    				<td>
		    					<?php foreach($row['via'] as $value){
		    						echo $value['code'] .' '.  $value['pais']. '<br/>';	
		    					};?>
		    				</td>
		    				<td><?php echo $row['flete_aereo']['minimo']; ?></td>
		    				<td><?php echo $row['flete_aereo']['normal']; ?></td>
	    					<?php foreach($row['precios'] as $precio): ?>
	    							<td>
	    								<?php 
	    									if(isset($precio['precio']))
	    										echo $precio['precio'];
											else{
												echo "-";
											}
	    								?>
	    							</td>
	    					<?php endforeach;?>
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
		    					<a href="<?php echo base_url();?>editflete_aereo/<?php echo $row['flete_aereo']['idflete_aereo'];?>" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
		    					<a href="<?php echo base_url();?>deleteflete_aereo/<?php echo $row['flete_aereo']['idflete_aereo'];?>" class="btn btn-warning btn-xs"><i class="fa fa-trash"></i></a>
		    				</td>
		    			</tr>
		    		<?php endforeach; ?>
	    		<?php endif; ?>
	    	</tbody>
	</table>
</div>		        