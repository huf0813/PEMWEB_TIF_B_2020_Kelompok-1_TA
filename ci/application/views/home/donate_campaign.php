<div class="container" style="margin-top: 70px;">
	<div class="card border-success mb-3" mx-auto
	">
	<div class="card-header">
		<h1 class="text-center">Form Donasi</h1>
	</div>
	<form action="<?php echo base_url('home/donateToCampaignAction/');
	echo $campaign['id']; ?>" method="post">
		<div class="card-body">
			<div class="form-group">
				<div class="custom-control custom-switch">
					<input name="inputAnon" type="checkbox" class="custom-control-input" id="customSwitch1" checked="">
					<label class="custom-control-label" for="customSwitch1">Donasi Anonim</label>
				</div>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Nominal Donasi</label>
				<input name="inputMoney" type="number" class="form-control" id="exampleInputEmail1"
					   aria-describedby="emailHelp"
					   placeholder="Rp">
			</div>
			<div class="form-group">
				<label for="exampleTextarea">Pesan dan Dukungan</label>
				<textarea name="inputMessage" class="form-control" rows="2"
						  placeholder="tulis pesan dan dukunganmu disini"></textarea>
				<small id="emailHelp" class="form-text text-muted">**bersifat opsional</small>
			</div>
			<div align="right">
				<button type="submit" class="btn btn-primary" align="right" id="donasi_now">Donasi Sekarang</button>
			</div>
		</div>
	</form>
</div>
</script>

