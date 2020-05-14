<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
	<a class="navbar-brand" href="#">Home</a>
</nav>
<div class="container center-block col-md-6 con-centered">
	<div class="card text-white bg-primary mb-3" style="max-width: 40rem;">
		<div class="card-header" style="text-align: center;">
			<h3>Login</h3>
		</div>
		<div class="card-body">
			<?php echo $this->session->flashdata('message') ?>
			<form action="<?= base_url('auth/login'); ?>" method="post">
				<div class="form-group">
					<label for="exampleInputEmail1">Email Address</label>
					<input type="email" name="emailInput" class="form-control" id="exampleInputEmail1"
						   aria-describedby="emailHelp"
						   placeholder="Enter your email">
					<?php echo form_error('emailInput', '<small class="text-danger">', '</small>'); ?>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<input type="password" name="passInput" class="form-control" id="exampleInputPassword1"
						   placeholder="Enter your password">
					<?php echo form_error('passInput', '<small class="text-danger">', '</small>'); ?>
				</div>
				<br>
				<div>
					<button type="submit" class="btn btn-secondary" style="float: right;">Sign in</button>
					<small>
						<a href="<?= base_url('auth/register'); ?>" id="signup" style="color: whitesmoke;">Don't have
							an
							account yet?
						</a>
					</small>
				</div>
			</form>
		</div>
	</div>
</div>
