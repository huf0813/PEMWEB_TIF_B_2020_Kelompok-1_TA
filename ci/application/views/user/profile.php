<div class="container" style="margin-top: 70px;">
	<?php echo $this->session->flashdata('message') ?>
	<a href="<?= base_url('user/editProfile'); ?>" class="btn btn-success mb-4">Edit Profile</a>
	<h1>My Profile</h1>
	<hr>
	<p class="text-muted">Nama</p>
	<h5 id="namaAPI"></h5>
	<p class="text-muted">Alamat Email</p>
	<h5 id="emailAPI"></h5>
	<p class="text-muted">Nomor Handphone</p>
	<h5 id="phoneAPI"></h5>
	<p class="text-muted">Jumlah Saldo</p>
	<h5 id="balanceAPI"></h5>
</div>
<script>
	$(document).ready(function () {
		$.ajax({
			url: "<?php echo base_url('user/profileAPI')?>",
			type: "get",
			success: function (data) {
				var d = JSON.parse(data);
				document.getElementById('namaAPI').innerText = d.user.name;
				document.getElementById('emailAPI').innerText = d.user.email;
				document.getElementById('phoneAPI').innerText = d.user.phone;
				document.getElementById('balanceAPI').innerText = 'Rp. ' + d.balance + ',-';
			}
		});
	});
</script>
