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
	<title>Daftar Piutang</title>
	<link rel="stylesheet" type="text/css" href="assets/css/piutang.css"/>
</head>
<body>
	<center>
		
	</center>
</body>
</html>