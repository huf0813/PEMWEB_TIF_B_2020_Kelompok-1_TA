<div class="container" style="margin-top: 70px;">
	<h1 class="text-muted"
		style="text-align:center;"><?= ($is_suspended == 0) ? 'User List' : 'Suspended User List'; ?></h1>
	<table class="table table-hover">
		<thead>
		<tr class="<?= ($is_suspended == 0) ? 'table-primary' : 'table-danger'; ?> text-center">
			<th scope="col">Username</th>
			<th scope="col">Email</th>
			<th scope="col">Action</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($users as $s) { ?>
			<tr>
				<td class="align-middle"><?= $s->name; ?></td>
				<td class="align-middle text-center"><?= $s->email; ?></td>
				<?php if ($is_suspended == 0) { ?>
					<td><a href="<?php echo base_url('admin/suspendUserAction/');
						echo $s->id; ?>" type="button" class="btn btn-link btn-sm btn-block">Suspend</a></td>
				<?php } else { ?>
					<td><a href="<?php echo base_url('admin/unsuspendUserAction/');
						echo $s->id; ?>" type="button" class="btn btn-link btn-sm btn-block">Unsuspend User</a></td>
				<?php } ?>
			</tr>
		<?php } ?>
		</tbody>
</div>
