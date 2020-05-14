<div class="container" style="margin-top: 70px;">
	<h1 class="text-muted" style="text-align:center;">Histori Donasi</h1><br>
	<?php echo $this->session->flashdata('message') ?>
	<div class="row">
		<div class="col-lg-6">
			<h4>Top Up History</h4>
			<a href="<?= base_url('user/topUp');?>" class="btn btn-primary mb-4">Top Up Now!</a>
			<?php foreach ($topups as $topup) { ?>
				<ul class="list-group mb-4">
					<li class="list-group-item d-flex justify-content-between align-items-center">
						Balance
						<span class="badge badge-primary badge-pill">+ Rp.<?= $topup->balance; ?>,-</span>
					</li>
					<li class="list-group-item d-flex justify-content-between align-items-center">
						From
						<span class="badge badge-primary badge-pill"><?= $topup->payment_provider; ?></span>
					</li>
					<li class="list-group-item d-flex justify-content-between align-items-center">
						Created At
						<span class="badge badge-primary badge-pill"><?= $topup->created_at; ?></span>
					</li>
				</ul>
			<?php } ?>
		</div>
		<div class="col-lg-6">
			<h4>Debit History</h4>
			<a href="<?= base_url('home');?>" class="btn btn-danger mb-4">Donate Now!</a>
			<?php foreach ($debits as $debit) { ?>
				<ul class="list-group mb-4">
					<li class="list-group-item d-flex justify-content-between align-items-center">
						Balance
						<span class="badge badge-danger badge-pill">- Rp.<?= $debit->balance; ?>,-</span>
					</li>
					<li class="list-group-item d-flex justify-content-between align-items-center">
						Donate To
						<span class="badge badge-danger badge-pill"><?= $debit->donate_to; ?></span>
					</li>
					<li class="list-group-item d-flex justify-content-between align-items-center">
						Created At
						<span class="badge badge-danger badge-pill"><?= $debit->created_at; ?></span>
					</li>
				</ul>
			<?php } ?>
		</div>
	</div>
</div>
