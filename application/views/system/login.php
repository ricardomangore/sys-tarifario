<section class="section-login">
	<div class="container">
		<div class="row">
			<div class="col-xs-6 col-xs-offset-6 col-sm-6 col-sm-offset-6 col-md-4 col-md-offset-8">
				<div class="panel panel-info">
					<div class="panel-heading">
						<i class="fa fa-sign-in"></i> &nbsp; Login
					</div>
					<div class="panel-body">
						<?php if(isset($error_login_message)){
							echo "<div class='alert alert-warning'>".$this->lang->line('error_login_auth')."</div>";
						}?>
						<?php if(form_error('username') != '' && form_error('password') !=''){
							echo "<div class='alert alert-warning'>".$this->lang->line('error_required_username_password')."</div>";
						}?>
						<?php if(form_error('username') != '' && form_error('password') == ''){
							echo form_error('username','<div class="alert alert-warning">','</div>');
						}elseif(form_error('username') == '' && form_error('password') != ''){
							echo form_error('password','<div class="alert alert-warning">','</div>');
						} ?>
						<form action="<?php echo base_url();?>login" method="post">
							<div class="form-group <?php if(form_error('username') != '') echo 'has-error';?>">
								<label for="opxInputUserName">Nombre de Usuario</label>
								<input name="username" type="text" class="form-control" id="opxInputUserName" placeholder="Nombre de Usuario" value="<?php echo set_value('username');?>">
							</div>
							<div class="form-group <?php if(form_error('password') != '') echo 'has-error';?>">
								<label for="opxInputPassword">Password</label>
								<input name="password" type="password" class="form-control" id="opxInputPassword" placeholder="xxxxxxxxxxx">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-default btn-success">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>