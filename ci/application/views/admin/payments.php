<br>
<div style="margin-left: 30px;" class="mt-5 mb-4">
	<a href="<?= base_url('admin/createPayment'); ?>" type="button" class="btn btn-success">Create Payment</a>
</div>
<div class="container">
	<?php foreach ($payments as $s) { ?>
		<div class="card text-white bg-warning mb-3 mx-auto" style="max-width: 50rem;">
			<div class="card-body">
				<h4 class="card-title"><?= $s->bank; ?></h4>
				<p class="card-text">Bank's Code Number : <?= $s->number; ?></p>
				<div align="right">
					<a href="<?php echo base_url('admin/deletePayment/');
					echo $s->id; ?>" type="submit" class="btn btn-danger">Delete Bank</a>
					<a href="<?php echo base_url('admin/editPayment/');
					echo $s->id; ?>" type="submit" class="btn btn-primary">Edit Bank</a>
				</div>
			</div>
		</div>
	<?php } ?>
</div>
