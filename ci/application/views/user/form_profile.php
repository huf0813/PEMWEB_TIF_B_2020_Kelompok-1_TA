<div class="container center-block col-md-6 con-centered" style="margin-top: 70px;">
	<h1 class="text-muted">Edit Profile</h1>
	<?php echo $this->session->flashdata('message') ?>
	<form action="<?= base_url('user/editProfileAction'); ?>" method="post">
		<div class="form-group">
			<label for="exampleInputPassword1">Nama</label>
			<input name="inputName" value="<?= $user['name']; ?> " type="text" class="form-control"
				   id="exampleInputNama1"
				   placeholder="ex: Yusuf Ulum Chrisyuono">
			<?php echo form_error('inputName', '<small class="text-danger">', '</small>'); ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Email address</label>
			<input name="inputEmail" value="<?= $user['email']; ?>" type="email" class="form-control"
				   id="exampleInputEmail1"
				   aria-describedby="emailHelp" placeholder="email@example.com">
			<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
			<?php echo form_error('inputEmail', '<small class="text-danger">', '</small>'); ?>
		</div>
		<div class="form-group">
			<label for="exampleInputPassword1">No HP</label>
			<input name="inputPhone" value="<?= $user['phone']; ?>" type="number" class="form-control"
				   id="exampleInputHP"
				   placeholder="08102*****">
			<?php echo form_error('inputPhone', '<small class="text-danger">', '</small>'); ?>
		</div>
		<div class="form-group">
			<label for="exampleInputPassword1">Password</label>
			<input type="password" name="passInput1" class="form-control" id="exampleInputPassword1"
				   placeholder="password">
			<?php echo form_error('passInput1', '<small class="text-danger">', '</small>'); ?>
		</div>
		<div class="form-group">
			<label for="exampleConfirmPassword2">Confirm Password</label>
			<input type="password" name="passInput2" class="form-control" id="exampleConfirmPassword2"
				   placeholder="Re-type your password">
			<?php echo form_error('passInput2', '<small class="text-danger">', '</small>'); ?>
		</div>
		<input type="hidden" name="inputUserID" value="<?= $user['id']; ?>">
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>
