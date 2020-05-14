<nav class="navbar navbar-expand-lg navbar-dark bg-dark"
	 style="position: fixed; top: 0; width: 100%; transition: top 0.3s; z-index: 99; float: right" id="navbar">
	<a class="navbar-brand mr-auto" href="<?= base_url('home'); ?>">Home</a>
	<div class="btn-group">
		<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
				aria-expanded="false">
			<?php if ($user == null) { ?>
				Donate Now!
			<?php } else {
				echo $user['name'];
			} ?>
		</button>
		<div class="dropdown-menu dropdown-menu-right">
			<?php if ($user == null) { ?>
				<a href="<?= base_url('auth/login'); ?>" type="submit" class="dropdown-item">Sign In</a>
				<a href="<?= base_url('auth/register'); ?>" type="submit" class="dropdown-item">Register</a>
			<?php } else { ?>
				<?php if ($user['user_role_id'] == '1') { ?>
					<a href="<?= base_url('admin/users'); ?>" type="submit" class="dropdown-item">See Users</a>
					<a href="<?= base_url('admin/campaigns'); ?>" type="submit" class="dropdown-item">See Campaigns</a>
					<a href="<?= base_url('admin/payments'); ?>" type="submit" class="dropdown-item">See Payments</a>
					<a href="<?= base_url('admin/logout'); ?>" type="submit" class="dropdown-item">Sign Out</a>
				<?php } else { ?>
					<a href="<?= base_url('user/profile'); ?>" type="submit" class="dropdown-item">Profile</a>
					<a href="<?= base_url('user/myCampaigns'); ?>" type="submit" class="dropdown-item">My Campaigns</a>
					<a href="<?= base_url('user/invoice'); ?>" type="submit" class="dropdown-item">My Invoices</a>
					<a href="<?= base_url('user/logout'); ?>" type="submit" class="dropdown-item">Sign Out</a>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
</nav>
