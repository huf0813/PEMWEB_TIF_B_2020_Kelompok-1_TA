<div class="container" style="margin-top: 70px;">
	<div class="card border-primary mb-3 card mx-auto">
		<div class="card-header text-center">
			<img class="img-fluid mb-4"
				 src="<?php echo base_url('img/');
				 echo $campaign['thumbnail']; ?>"
				 width="900">
		</div>
		<div class="card-body">
			<h3 class="text-center mb-4">campaigner : <?= $campaign['name']; ?></h3>
			<div class="progress mb-4">
				<div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar"
					 aria-valuenow="<?php if ($campaign['collected'] == null) {
						 echo 0;
					 } else {
						 if ($campaign['collected'] > $campaign['target']) {
							 echo 100;
						 } else {
							 echo round($campaign['collected'] * 100 / $campaign['target']);
						 }
					 } ?>" aria-valuemin="0" aria-valuemax="100"
					 style="width: <?php if ($campaign['collected'] == null) {
						 echo 0;
					 } else {
						 if ($campaign['collected'] > $campaign['target']) {
							 echo 100;
						 } else {
							 echo round($campaign['collected'] * 100 / $campaign['target']);
						 }
					 } ?>%"></div>
			</div>
			<h4 class="card-title text-right">Terkumpul Rp. <?php if ($campaign['collected'] == null) {
					echo 0;
				} else {
					echo $campaign['collected'];
				} ?>,-</h4>
			<h1 class="card-title text-center"><?= $campaign['title']; ?></h1>
			<div id="data">
				<?= $campaign['body']; ?>
			</div>
			<div class="mx-auto">
				<?php if ($user == null) { ?>
					<form action="<?php echo base_url('auth/login'); ?>">
						<input type="submit" class="btn btn-primary btn-block mb-4" value="Donate Now!">
					</form>
				<?php } else { ?>
					<?php if (new DateTime($campaign['finish_at']) > new DateTime()) { ?>
						<?php if ($campaign['user_id'] != $user['id']) { ?>
							<?php if ($user['user_role_id'] == 2) { ?>
								<a href="<?php echo base_url('home/donateToCampaign/');
								echo $campaign['id']; ?>" class="btn btn-primary btn-block mb-4">Donasi Sekarang</a>
							<?php } else { ?>
								<a href="<?php echo base_url('admin/deleteCampaign/');
								echo $campaign['id']; ?>" class="btn btn-danger btn-block mb-4">Delete Campaign By
									Admin</a>
							<?php } ?>
						<?php } else { ?>
							<div class="row">
								<div class="col-md-6">
									<a href="<?php echo base_url('user/editCampaign/');
									echo $campaign['id']; ?>" class="btn btn-warning btn-block mb-4">Edit</a>
								</div>
								<div class="col-md-6">
									<a href="<?php echo base_url('user/deleteCampaignAction/');
									echo $campaign['id']; ?>" class="btn btn-danger btn-block mb-4">Hapus</a>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
				<?php } ?>
			</div>
			<h5>Donatur</h5>
			<?php foreach ($donors as $d) { ?>
				<div class="card border-default mb-3 mx-auto">
					<div class="card-body">
						<div class="row">
							<div class="col-lg-2 text-center">
								<img class="img-fluid mx-auto"
									 src="<?= base_url('img/default.png'); ?>"
									 alt="" width="100" height="40">
							</div>
							<div class="col-lg-10">
								<h4 class="card-title"><?php echo ($d->anonymous == 0) ? $d->name : 'anonymous'; ?></h4>
								<p class="card-text"><?= $d->message; ?></p>
								<p class="card-text">Rp. <?= $d->balance; ?>,-</p>
								<p class="card-text"><?= $d->created_at; ?></p>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<script>
	var editor = CKEDITOR.replace('editor1', {
		language: 'en',
// other configuration settings
// ...
		contentsCss: ['/css/mysitestyles.css', '/css/anotherfile.css']
	})
</script>
