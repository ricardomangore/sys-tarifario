<div class="row">
	<ul class="nav nav-pills">
	  <li role="presentation"><a href="<?php echo base_url();?>addflete_aereo"><i class="fa fa-plus-square"></i> Agregar</a></li>
	  <li role="presentation" class="active"><a href="<?php echo base_url();?>editflete_aereo/0"><i class="fa fa-pencil"></i> Editar</a></li>
	  <li role="presentation"><a href="<?php echo base_url();?>deleteflete_aereo/0"><i class="fa fa-trash"></i> Eliminar</a></li>
	</ul>
</div>
<div class="row">
	<div style="height:20px;"></div>
	<div class="panel panel-default">
		<div style="height:20px;"></div>
		<form class="form-horizontal" method="POST" action="<?php echo base_url();?>editflete_aereo/<?php echo $idflete_aereo; ?>" name="add_fletes_aereos_form">		
		  <input name="idflete_aereo" type="hidden" value="<?php if(isset($idflete_aereo_retrieved)) echo $idflete_aereo_retrieved; else echo set_value('idflete_aereo');?>">
		  <div class="form-group">
		  	<label for="recargos" class="col-sm-2 control-label">* Región</label>
		  	<div class="col-sm-2 <?php if(form_error('idregion')!='') echo 'has-error';?>">
			  	<select class="select_region" data-live-search="true" name="idregion">
			  		<option value="none">Seleccione una Región</option>
			  		<?php foreach($regiones as $region): ?>
			  			<?php if($region['idregion'] == $idregion_retrieved && isset($idregion_retrieved)): ?>
			  				<option value="<?php echo $region['idregion']?>" <?php echo set_select('idregion',$region['idregion']);?> selected="selected"><?php echo $region['region'];?></option>
			  			<?php else: ?>
			  				<option value="<?php echo $region['idregion']?>" <?php echo set_select('idregion',$region['idregion']);?>><?php echo $region['region'];?></option>
			  			<?php endif; ?>
			  		<?php endforeach; ?>
			  	</select>
			  	<?php echo form_error('idregion'); ?>
			</div>		  
		    <label for="aeropuerto" class="col-sm-2 control-label">* Aerolínea</label>
		    <div class="col-sm-2 <?php if(form_error('idaerolinea')!='') echo 'has-error';?>">
		      <select class="select_aerolinea" data-live-search='true' name="idaerolinea">
		      	<option value="none">Seleccione una aerolínea</option>
		      	<?php foreach($aerolineas as $aerolinea):?>
		      		<?php if($aerolinea['idaerolinea'] == $idaerolinea_retrieved && isset($idaerolinea_retrieved)): ?>
		      			<option value="<?php echo $aerolinea['idaerolinea'];?>" <?php echo set_select('idaerolinea',$aerolinea['idaerolinea']); ?> selected="selected"><?php echo $aerolinea['aerolinea'];?></option>
		      		<?php else: ?>
		      			<option value="<?php echo $aerolinea['idaerolinea'];?>" <?php echo set_select('idaerolinea',$aerolinea['idaerolinea']); ?>><?php echo $aerolinea['aerolinea'];?></option>
		      		<?php endif; ?>
		    	<?php endforeach; ?>
		      </select>
		      <?php echo form_error('idaerolinea'); ?>
		    </div>	    
		  </div>
		  
		  <div class="form-group">
		  	<label for="destino" class="col-sm-2 control-label">* Origen</label>
		  	<div class="col-sm-2 <?php if(form_error('aol')!='') echo 'has-error';?>">
			  	<select class="select_origen" data-live-search="true" name="aol">
					<option value="none">Seleccione un Origen</option>			  	
			  		<?php foreach($aeropuertos as $aeropuerto): ?>
			  			<?php if($aeropuerto['idaeropuerto'] == $aol_retrieved && isset($aol_retrieved)): ?>
			  				<option value="<?php echo $aeropuerto['idaeropuerto']?>" <?php echo set_select('aol',$aeropuerto['idaeropuerto']);?> selected="selected"><?php echo $aeropuerto['code'] .' '. $aeropuerto['aeropuerto'];?></option>
			  			<?php else: ?>
			  				<option value="<?php echo $aeropuerto['idaeropuerto']?>" <?php echo set_select('aol',$aeropuerto['idaeropuerto']);?>><?php echo $aeropuerto['code'] .' '. $aeropuerto['aeropuerto'];?></option>
			  			<?php endif; ?>
			  		<?php endforeach; ?>
			  	</select>
			  	<?php echo form_error('aol'); ?>
			</div>
		  	<label for="destino" class="col-sm-2 control-label">* Destino</label>
		  	<div class="col-sm-2 <?php if(form_error('aod')!='') echo 'has-error';?>">
			  	<select class="select_destino" data-live-search="true" name="aod">
			  		<option value="none">Seleccione un Destino</option>
			  		<?php foreach($aeropuertos as $aeropuerto): ?>
			  			<?php if($aeropuerto['idaeropuerto'] == $aod_retrieved && isset($aod_retrieved)): ?>
			  				<option value="<?php echo $aeropuerto['idaeropuerto']?>" <?php echo set_select('aod',$aeropuerto['idaeropuerto']);?> selected="selected"><?php echo $aeropuerto['code'] .' '. $aeropuerto['aeropuerto'];?></option>
			  			<?php else: ?>
			  				<option value="<?php echo $aeropuerto['idaeropuerto']?>" <?php echo set_select('aod',$aeropuerto['idaeropuerto']);?>><?php echo $aeropuerto['code'] .' '. $aeropuerto['aeropuerto'];?></option>
			  			<?php endif; ?>
			  		<?php endforeach; ?>
			  	</select>
			  	<?php echo form_error('aod'); ?>
			</div>			
		  </div> 
		  
		  <div class="form-group">
		  		<?php if(isset($has_via_retrieved)): ?>
		  			<?php if($has_via_retrieved): ?>
						<label class="control-label col-sm-3">
						  <input type="radio" name="chkbox_via" id="radioDirecto" value="directo" <?php echo set_radio('chkbox_via','directo');?>> Directo
						</label>
						<label class="control-label col-sm-1">
						  <input type="radio" name="chkbox_via" id="radioEscalas" value="escalas" <?php echo set_radio('chkbox_via','escalas');?> checked> Escalas
						</label>
					<?php else: ?>
						<label class="control-label col-sm-3">
						  <input type="radio" name="chkbox_via" id="radioDirecto" value="directo" <?php echo set_radio('chkbox_via','directo');?> checked> Directo
						</label>
						<label class="control-label col-sm-1">
						  <input type="radio" name="chkbox_via" id="radioEscalas" value="escalas" <?php echo set_radio('chkbox_via','escalas');?>> Escalas
						</label>					
					<?php endif; ?>
				<?php else: ?>
					<label class="control-label col-sm-3">
					  <input type="radio" name="chkbox_via" id="radioDirecto" value="directo" <?php echo set_radio('chkbox_via','directo');?> checked> Directo
					</label>
					<label class="control-label col-sm-1">
					  <input type="radio" name="chkbox_via" id="radioEscalas" value="escalas" <?php echo set_radio('chkbox_via','escalas');?>> Escalas
					</label>				
				<?php endif; ?>
			  	<label for="destino" class="col-sm-1 control-label">Via</label>
			  	<div class="col-sm-2  <?php if(form_error('idvias')!='') echo 'has-error';?>">
				  	<select class="select_via" data-live-search="true" name="idvias[]" multiple>
				  		<option value="none">Seleccione los transbordos</option>
				  		<?php 
				  			$idvia_array = array();
				  			foreach($via_retrieved as $value){
				  				array_push($idvia_array,$value['idaeropuerto']);
				  			}
				  		?>
				  		<?php if(isset($via_retrieved)): ?>
					  		<?php foreach($aeropuertos as $aeropuerto):?>
					  			<?php if(in_array($aeropuerto['idaeropuerto'], $idvia_array)): ?>
					  				<option value="<?php echo $aeropuerto['idaeropuerto']?>" <?php echo set_select('idvias[]',$aeropuerto['idaeropuerto']);?> selected="selected"><?php echo $aeropuerto['code'] .' '. $aeropuerto['aeropuerto'];?></option>
					  			<?php else: ?>
					  				<option value="<?php echo $aeropuerto['idaeropuerto']?>" <?php echo set_select('idvias[]',$aeropuerto['idaeropuerto']);?>><?php echo $aeropuerto['code'] .' '. $aeropuerto['aeropuerto'];?></option>
					  			<?php endif; ?>
					  		<?php endforeach; ?>				  		
				  		<?php else: ?>				  		
					  		<?php foreach($aeropuertos as $aeropuerto):?>
					  			<option value="<?php echo $aeropuerto['idaeropuerto']?>" <?php echo set_select('idvias[]',$aeropuerto['idaeropuerto']);?>><?php echo $aeropuerto['code'] .' '. $aeropuerto['aeropuerto'];?></option>
					  		<?php endforeach; ?>
					  	<?php endif; ?>
				  	</select>
				</div>				
		  </div>		  


		  <div class="form-group">
		  	<label for="recargos" class="col-sm-2 control-label">Recargos</label>
		  	<div class="col-sm-2">
			  	<select class="select_recargos" data-live-search="true" name="idrecargos[]" multiple>
			  		<option value="none">Seleccione los recargos</option>
			  		<?php
			  			$idrecargo_array = array();
						foreach($recargos_retrieved as $recargo){
							array_push($idrecargo_array,$recargo['idrecargo_aereo']);
						}  
			  		?>
			  		<?php if(isset($recargos)):?>
				  		<?php foreach($recargos as $recargo): ?>
				  			<?php if(in_array($recargo['idrecargo'], $idrecargo_array)):?>
				  				<option value="<?php echo $recargo['idrecargo_aereo']?>" <?php echo set_select('idrecargos[]',$recargo['idrecargo_aereo']);?> selected="selected"><?php echo $recargo['clave'] .' '. $recargo['costo'] .' '. $recargo['aerolinea'];?></option>
				  			<?php else: ?>
				  				<option value="<?php echo $recargo['idrecargo_aereo']?>" <?php echo set_select('idrecargos[]',$recargo['idrecargo_aereo']);?>><?php echo $recargo['clave'] .' '. $recargo['costo'] .' '. $recargo['aerolinea'];?></option>
				  			<?php endif; ?>
				  		<?php endforeach; ?>
			  		<?php else: ?>
			  			<option value="<?php echo $recargo['idrecargo_aereo']?>" <?php echo set_select('idrecargos[]',$recargo['idrecargo_aereo']);?>><?php echo $recargo['clave'] .' '. $recargo['costo'] .' '. $recargo['aerolinea'];?></option>
			  		<?php endif; ?>
			  	</select>
			</div>
			<label for="vigencia" class="col-sm-2 control-label">* Vigencia</label>
		  	<div class="col-sm-2 <?php if(form_error('vigencia')!='') echo 'has-error';?>">
				<input type="text" name="vigencia" class="form-control" value="<?php if(isset($vigencia_retrieved)) echo $vigencia_retrieved; else echo set_value('vigencia')?>">
				<?php echo form_error('vigencia'); ?>
			</div>				  	
		  </div>
		  <div class="form-group">
		  	<label for="minimo" class="col-sm-2 control-label">* Mínimo</label>
		  	<div class="col-sm-2 <?php if(form_error('minimo')!='') echo 'has-error';?>">
		  		<div class="input-group">
		  			<div class="input-group-addon">$</div>
						<input type="text" name="minimo" class="form-control" value="<?php if(isset($minimo_retrieved)) echo $minimo_retrieved; else echo set_value('minimo'); ?>">
			    </div>
			    <?php echo form_error('minimo'); ?>
			</div>
		  	<label for="normal" class="col-sm-2 control-label">* Normal</label>
		  	<div class="col-sm-2 <?php if(form_error('normal') != '') echo 'has-error'; ?>">
		  		<div class="input-group">
		  			<div class="input-group-addon">$</div>
						<input type="text" name="normal" class="form-control" value="<?php if(isset($normal_retrieved)) echo $normal_retrieved; else echo set_value('normal'); ?>">
			    </div>
			    <?php echo form_error('normal'); ?>
			</div>	
		  	<label for="normal" class="col-sm-1 control-label">* Profit Base</label>
		  	<div class="col-sm-2 <?php if(form_error('profit_base')!='') echo 'has-error';?>">
		  		<div class="input-group">
		  			<div class="input-group-addon">$</div>
						<input type="text" name="profit_base" class="form-control" value="<?php if(isset($profit_base_retrieved)) echo $profit_base_retrieved; else echo set_value('profit_base'); ?>">
			    </div>
			    <?php echo form_error('profit_base'); ?>
			</div>					
		  </div>

		  <div class="form-group">
		  	<label for="precio1" class="col-sm-2 control-label">+45Kg</label>
		  	<div class="col-sm-2 <?php if(form_error('precio1')!='') echo 'has-error';?>">
		  		<div class="input-group">
		  			<div class="input-group-addon">$</div>
					<input type="text" name="precio1" class="form-control" value="<?php if(isset($precio1_retrieved)) echo $precio1_retrieved; else echo set_value('precio1');?>">
				</div>
			</div>
		  	<label for="precio1" class="col-sm-2 control-label">Profit +45Kg</label>
		  	<div class="col-sm-2 <?php if(form_error('precio1')!='') echo 'has-error';?>">
		  		<div class="input-group">
		  			<div class="input-group-addon">$</div>
					<input type="text" name="profit45" class="form-control" value="<?php if(isset($profit45_retrieved)) echo $profit45_retrieved; else echo set_value('profit45');?>">
				</div>
			</div>
		  </div>
		  
		  <div class="form-group">			
		  	<label for="precio2" class="col-sm-2 control-label">+100Kg</label>
		  	<div class="col-sm-2 <?php if(form_error('precio2')!='') echo 'has-error';?>">
		  		<div class="input-group">
		  			<div class="input-group-addon">$</div>
						<input type="text" name="precio2" class="form-control" value="<?php if(isset($precio2_retrieved)) echo $precio2_retrieved; else echo set_value('precio2');?>">
				</div>
			</div>	
		  	<label for="precio2" class="col-sm-2 control-label">Profit +100Kg</label>
		  	<div class="col-sm-2 <?php if(form_error('precio2')!='') echo 'has-error';?>">
		  		<div class="input-group">
		  			<div class="input-group-addon">$</div>
						<input type="text" name="profit100" class="form-control" value="<?php if(isset($profit100_retrieved)) echo $profit100_retrieved; else echo set_value('profit100');?>">
				</div>
			</div>
		  </div>
		  <div class="form-group">			
		  	<label for="precio3" class="col-sm-2 control-label">+300Kg</label>
		  	<div class="col-sm-2 <?php if(form_error('precio3')!='') echo 'has-error';?>">
		  		<div class="input-group">
		  			<div class="input-group-addon">$</div>
						<input type="text" name="precio3" class="form-control" value="<?php if(isset($precio3_retrieved)) echo $precio3_retrieved; else echo set_value('precio3');?>">
				</div>
			</div>	
		  	<label for="precio3" class="col-sm-2 control-label">Profit +300Kg</label>
		  	<div class="col-sm-2 <?php if(form_error('precio3')!='') echo 'has-error';?>">
		  		<div class="input-group">
		  			<div class="input-group-addon">$</div>
						<input type="text" name="profit300" class="form-control" value="<?php if(isset($profit300_retrieved)) echo $profit300_retrieved; else echo set_value('profit300');?>">
				</div>
			</div>							
		  </div>

		  <div class="form-group">
		  	<label for="precio4" class="col-sm-2 control-label">+500Kg</label>
		  	<div class="col-sm-2 <?php if(form_error('precio4')!='') echo 'has-error';?>">
		  		<div class="input-group">
		  			<div class="input-group-addon">$</div>
						<input type="text" name="precio4" class="form-control" value="<?php if(isset($precio4_retrieved)) echo $precio4_retrieved; else echo set_value('precio4');?>">
				</div>
			</div>
		  	<label for="precio4" class="col-sm-2 control-label">Profit +500Kg</label>
		  	<div class="col-sm-2 <?php if(form_error('precio4')!='') echo 'has-error';?>">
		  		<div class="input-group">
		  			<div class="input-group-addon">$</div>
						<input type="text" name="profit500" class="form-control" value="<?php if(isset($profit500_retrieved)) echo $profit500_retrieved; else echo set_value('profit500');?>">
				</div>
			</div>			
		  </div>
		  <div class="form-group">
		  	<label for="precio5" class="col-sm-2 control-label">+1000Kg</label>
		  	<div class="col-sm-2 <?php if(form_error('precio5')!='') echo 'has-error';?>">
		  		<div class="input-group">
		  			<div class="input-group-addon">$</div>
						<input type="text" name="precio5" class="form-control" value="<?php if(isset($precio5_retrieved)) echo $precio5_retrieved; else echo set_value('precio5');?>">
				</div>
			</div>	
		  	<label for="precio5" class="col-sm-2 control-label">Profit +1000Kg</label>
		  	<div class="col-sm-2 <?php if(form_error('precio5')!='') echo 'has-error';?>">
		  		<div class="input-group">
		  			<div class="input-group-addon">$</div>
						<input type="text" name="profit1000" class="form-control" value="<?php if(isset($profit1000_retrieved)) echo $profit1000_retrieved; else echo set_value('profit1000');?>">
				</div>
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
	<!-- Catálogo de Aeropuertos -->
	<table id="opxtable" class="display table table-hover" cellspacing="0" width="100%">
	    <thead>
	        <tr>
	            <th>Región</th>
	            <th>Aerolínea</th>
	            <th>Origen</th>
	            <th>Destino</th>
	            <th>Vigencia</th>
	            <th>Via</th>
	            <th>Tarifas Base</th>
	            <th>Tarifas Rangos</th>
	            <th>Recargos</th>
	            <th>opt</th>
	        </tr>
	    </thead>
	    <tfoot>
	        <tr>
	            <th>Región</th>
	            <th>Aerolínea</th>
	            <th>Origen</th>
	            <th>Destino</th>
	            <th>Vigencia</th>
	            <th>Via</th>
	            <th>Tarifas Base</th>
	            <th>Tarifas Rangos</th>
	            <th>Recargos</th>
	            <th>opt</th>
	        </tr>
	    </tfoot>
	    	<tbody>
	    		<?php if($rows): ?>
		    		<?php foreach($rows as $row): ?>
		    			<tr>		    	
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
		    				<td>
		    					<p>Mínimo: <?php echo $row['flete_aereo']['minimo']; ?></p>
		    					<p>Normal: <?php echo $row['flete_aereo']['normal']; ?></p>
		    					<p>Profit Base: <?php echo $row['flete_aereo']['profit'];?></p>
		    				</td>
		    				<td>
		    				<?php 
		    					$rangos = array('+45 Kg','+100 Kg','+300 Kg','+500 Kg','+1000 Kg');
								$index = 0;
		    				?>
	    					<?php foreach($row['precios'] as $precio): ?>
	    								<?php 
	    									if(isset($precio['precio'])){
	    										echo "<b>".$rangos[$index++]."</b>";
	    										echo "<p>Precio: USD ". $precio['precio'] ."</p>";
	    										echo "<p>Profit: USD ".$precio['profit']."</p>";	
											}else{
												echo "-";
											}
	    								?>
	    					<?php endforeach;?>
	    					</td>
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