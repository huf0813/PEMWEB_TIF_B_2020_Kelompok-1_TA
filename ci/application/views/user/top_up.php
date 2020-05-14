<div class="container" style="margin-top: 70px;">
	<?php echo $this->session->flashdata('message') ?>
	<form action="<?= base_url('user/topUpAction'); ?>" method="post">
		<fieldset>
			<h2>Top Up Your Balance</h2>
			<hr>
			<div class="form-group">
				<label for="exampleSelect1">Select Your Bank</label>
				<select class="form-control" id="exampleSelect1" name="inputPayment">
					<?php foreach ($payments as $payment) { ?>
						<option value="<?= $payment->id; ?>">
							<?= $payment->bank; ?> / No. rek : <?= $payment->number; ?>
						</option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label class="control-label">Input your Balance</label>
				<div class="form-group">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">Rp</span>
						</div>
						<input type="number" name="inputBalance" class="form-control" placeholder="Masukkan balance"
							   aria-label="Amount (to the nearest dollar)">
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-primary" id="top_up_now">Top Up Sekarang</button>
		</fieldset>
	</form>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
