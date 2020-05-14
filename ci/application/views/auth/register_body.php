<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
	<a class="navbar-brand" href="#">Home</a>
</nav>
<div class="container center-block col-md-6 con-centered">
	<div class="card text-white bg-info mb-3" style="max-width: 40rem;">
		<div class="card-header" style="text-align: center;">
			<h3>Register New Account</h3>
		</div>
		<div class="card-body">
			<form action="<?= base_url('auth/register'); ?>" method="post">
				<div class="form-group">
					<label for="exampleInputName1">Full Name</label>
					<input type="text" name="nameInput" class="form-control" id="exampleInputName1"
						   placeholder="Enter your full Name">
					<?php echo form_error('nameInput', '<small class="text-danger">', '</small>'); ?>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Email Address</label>
					<input type="email" name="emailInput" class="form-control" id="exampleInputEmail1"
						   aria-describedby="emailHelp"
						   placeholder="Enter your email">
					<?php echo form_error('emailInput', '<small class="text-danger">', '</small>'); ?>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<input type="password" name="passInput1" class="form-control" id="exampleInputPassword1"
						   placeholder="Enter your password">
					<?php echo form_error('passInput1', '<small class="text-danger">', '</small>'); ?>
					<small class="form-text text-muted-white" style="float: right;">Make sure your password is strong
						enough</small>
				</div>
				<div class="form-group">
					<label for="exampleConfirmPassword2">Confirm Password</label>
					<input type="password" name="passInput2" class="form-control" id="exampleConfirmPassword2"
						   placeholder="Re-type your password">
					<?php echo form_error('passInput2', '<small class="text-danger">', '</small>'); ?>
				</div>
				<br>
				<div>
					<button type="submit" class="btn btn-secondary" style="float: right;">Sign up</button>
					<small><a href="<?= base_url('auth/login'); ?>" id="signin" style="color: whitesmoke;">Already have
							an
							account?</a></small>
				</div>
			</form>
		</div>
	</div>
</div>
