<?php

// $pdo = DB::pdo();
// $st = $pdo->prepare("SELECT `name` FROM `piutang`;");

?><!DOCTYPE html>
<html>
<head>
	<title>Daftar Piutang</title>
	<?php headd(); ?>
	<link rel="stylesheet" type="text/css" href="assets/css/piutang_home.css"/>
</head>
<body>
	<center>
<?php require __DIR__."/../navd.php"; ?>
		<div>
			<table border="1" style="border-collapse:collapse;">
				<thead>
					<tr><th>ID</th><th>Name of Person</th><th>Piutang Name</th><th>Description</th><th>Amount</th><th>Status</th><th>Issued At</th><th>Created At</th><th>Updated At</th><th>Action</th></tr>
				</thead>
				<tbody>
<?php 
	// $ptr = 0;
	// while ($r = $st->fetch(PDO::FETCH_ASSOC)) {
		
	// }
?>
				</tbody>
			</table>
		</div>
	</center>
</body>
</html>