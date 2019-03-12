<?php

require_once __DIR__."/../init.php";

if (!isset($sess)) {
	$sess = sess();
	if (!$sess->get("login")) {
		header("Location: login.php?w=".urlencode(rstr(64)));
		exit;
	}
}

$uid = &$sess->get("user");
$username = &$sess->get("username");


?><!DOCTYPE html>
<html>
<head>
	<title>Welcome <?php print htmlspecialchars($username, ENT_QUOTES, "UTF-8"); ?>!</title>
	<link rel="stylesheet" type="text/css" href="assets/css/home.css"/>
</head>
<body>
	<center>
		<a href="piutang.php?w=<?php print htmlspecialchars(urlencode(rstr(64))); ?>"><h2>Daftar Piutang</h2></a>
	</center>
</body>
</html>