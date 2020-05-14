<?php if ($campaign == null) { ?>
	<form action="<?= base_url('user/createCampaignAction') ?>" method="post" enctype="multipart/form-data">
		<div class="container" style="margin-top: 70px;">
			<h1 class="text-muted" style="text-align:center;">Create Campaign</h1>
			<div class="form-group">
				<label for="inputTitle">Judul Campaign</label>
				<input type="nama" name="inputTitle" class="form-control" id="inputTitle" placeholder="ex: Prank Gagal">
			</div>
			<div class="form-group">
				<label for="inputBody">Deskripsi Campaign</label>
				<!--<textarea name="inputBody" class="form-control" id="inputBody" rows="3"></textarea>-->
				<textarea name="inputBody" class="form-control" id="inputBody" rows="3">
				</textarea>
			</div>
			<div class="form-group">
				<label for="inputTarget">Target Donasi</label>
				<input name="inputTarget" type="number" class="form-control" id="inputTarget" placeholder="">
			</div>
			<div class="form-group">
				<label for="inputDate">Batas Waktu Donasi</label>
				<input name="inputDate" type="date" class="form-control" id="inputDate" placeholder="">
			</div>
			<div class="form-group">
				<label for="inputThumbnail">Thumbnail</label>
				<input type="file" name="inputThumbnail" class="form-control-file" id="inputThumbnail"
					   aria-describedby="fileHelp">
				<input type="hidden" name="inputUniqueID" value="<?php echo uniqid(); ?>">
				<small id="fileHelp" class="form-text text-muted">Extension file foto PNG, size maksimal 50mb</small>
			</div>
			<button type="submit" class="btn btn-primary">Buat Campaign</button>
		</div>
	</form>
	<script>
		CKEDITOR.replace('inputBody');
	</script>
<?php } else { ?>
	<form action="<?= base_url('user/editCampaignAction') ?>" method="post" enctype="multipart/form-data">
		<div class="container" style="margin-top: 70px;">
			<h1 class="text-muted" style="text-align:center;">Edit Campaign</h1>
			<?php echo $this->session->flashdata('message') ?>
			<div class="form-group">
				<label for="inputTitle">Judul Campaign</label>
				<input type="text" value="<?= $campaign['title']; ?>" name="inputTitle" class="form-control"
					   id="inputTitle"
					   placeholder="ex: Prank Gagal">
			</div>
			<div class="form-group">
				<label for="inputBody">Deskripsi Campaign</label>
				<textarea name="inputBody" class="form-control" id="inputBody"
						  rows="3"><?= $campaign['body']; ?></textarea>
			</div>
			<div class="form-group">
				<label for="inputTarget">Target Donasi</label>
				<input name="inputTarget" value="<?= $campaign['target']; ?>" type="number" class="form-control"
					   id="inputTarget" placeholder="">
			</div>
			<div class="form-group">
				<label for="inputDate">Batas Waktu Donasi</label>
				<input name="inputDate" value="<?= $campaign['finish_at']; ?>" type="date" class="form-control"
					   id="inputDate" placeholder="">
			</div>
			<div class="form-group">
				<label for="inputThumbnail">Thumbnail</label>
				<input type="file" name="inputThumbnail" class="form-control-file" id="inputThumbnail"
					   aria-describedby="fileHelp">
				<small id="fileHelp" class="form-text text-muted">Extension file foto PNG, size maksimal 50mb</small>
			</div>
			<input type="hidden" name="inputUserID" id="inputTarget" placeholder="target"
				   value="<?= $campaign['user_id']; ?>">
			<input type="hidden" name="inputCampaignID" id="inputCampaignID" placeholder="target"
				   value="<?= $campaign['id']; ?>">
			<input type="hidden" name="inputUniqueID" value="<?php echo uniqid(); ?>">
			<button type="submit" class="btn btn-primary">Edit Campaign</button>
		</div>
	</form>
	<script>
		CKEDITOR.replace('inputBody');
	</script>
<?php } ?>
