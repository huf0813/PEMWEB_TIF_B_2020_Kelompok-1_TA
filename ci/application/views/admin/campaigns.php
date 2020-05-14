<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
<h1>campaigns</h1>
<?php foreach ($campaigns as $c) { ?>
	<tr>
		<td><?= $c->title; ?></td>
		<td>
			<a href="<?php echo base_url('admin/deleteCampaign/');
			echo $c->id; ?>">hapus</a>
		</td>
	</tr>
<?php } ?>
</body>
</html>
