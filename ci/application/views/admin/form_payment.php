<?php if ($create_payment) { ?>
	<form action="<?= base_url('admin/createPaymentAction'); ?>" method="post">
		<div class="container" style="margin-top: 70px;">
			<h1 class="text-muted" style="text-align:center;"><?= $title; ?></h1>
			<div class="form-group">
				<label for="inputPihak">Pihak Ketiga</label>
				<input type="text" name="inputBank" class="form-control" id="inputPihak" placeholder="ex: BCA">
			</div>
			<div class="form-group">
				<label for="inputBody">Nomer Rekening</label>
				<input type="number" name="inputNumber" class="form-control" id="inputTitle"
					   placeholder="ex: 180****">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</form>
<?php } else { ?>
	<form action="<?php echo base_url('admin/editPaymentAction/');
	echo $payment['id']; ?>" method="post">
		<div class="container" style="margin-top: 70px;">
			<h1 class="text-muted" style="text-align:center;"><?= $title; ?></h1>
			<div class="form-group">
				<label for="inputPihak">Pihak Ketiga</label>
				<input value="<?= $payment['bank']; ?>" type="text" name="inputBank" class="form-control"
					   id="inputPihak" placeholder="ex: BCA">
			</div>
			<div class="form-group">
				<label for="inputBody">Nomer Rekening</label>
				<input value="<?= $payment['number']; ?>" type="number" name="inputNumber" class="form-control"
					   id="inputTitle"
					   placeholder="ex: 180****">
			</div>
			<input value="<?= $payment['id']; ?>" type="hidden" name="inputId" class="form-control" id="inputTitle"
				   placeholder="ex: 180****">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</form>
<?php } ?>
