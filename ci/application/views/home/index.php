<div class="container" style="margin-top: 70px;">
	<h1 class="text-muted" style="text-align:center;"><?= $title; ?></h1>
	<?php echo $this->session->flashdata('message') ?>
	<?php if ($create_campaign) { ?>
		<a href="<?= base_url('user/createCampaign'); ?>" class="btn btn-success">Create Campaign</a>
	<?php } ?>
	<div class="row">
		<?php foreach ($campaigns as $c) { ?>
			<div class="col-md-6 mb-3">
				<div class="card border-primary" style="margin-top: 30px;">
					<div class="card-header">
						<h6><?= $c->title; ?></h6>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-6 d-flex align-items-center">
								<img class="img-fluid"
									 src="<?php echo base_url('img/');
									 echo $c->thumbnail; ?>"
									 alt="Card image">
							</div>
							<div class="col-md-6">
								<small class="card-subtitle text-muted"
									   style="float: right;"><?= $c->name; ?></small>
								<br>
								<div class="card-body">
									<h6>Terkumpul</h6>
									<div class="progress">
										<div class="progress-bar progress-bar-striped progress-bar-animated"
											 role="progressbar"
											 aria-valuenow="<?php if ($c->collected == null) {
												 echo 0;
											 } else {
												 if ($c->collected > $c->target) {
													 echo 100;
												 } else {
													 echo round($c->collected * 100 / $c->target);
												 }
											 } ?>"
											 aria-valuemin="0"
											 aria-valuemax="100"
											 style="width: <?php if ($c->collected == null) {
												 echo 0;
											 } else {
												 if ($c->collected > $c->target) {
													 echo 100;
												 } else {
													 echo round($c->collected * 100 / $c->target);
												 }
											 } ?>%"></div>
									</div>
								</div>
								<div>
									<h6 style="float: right;">
										Rp <?php echo ($c->collected == null) ? 0 : $c->collected; ?></h6>
								</div>
								<br><br>
								<?php if ($create_campaign) { ?>
									<a href="<?= base_url('user/myCampaignBy/');
									echo $c->id; ?>" class="card-link" style="float: right;">Detail</a>
								<?php } else { ?>
									<?php if ($user != null and $user['user_role_id'] == 1) { ?>
										<a href="<?php echo base_url('admin/campaignBy/');
										echo $c->id; ?>" class="card-link" style="float: right;">Detail</a>
									<?php } else { ?>
										<a href="<?php echo base_url('home/campaign/');
										echo $c->id; ?>" class="card-link" style="float: right;">Detail</a>
									<?php } ?>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
