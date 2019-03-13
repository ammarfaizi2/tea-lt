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

$_GET["pg"] = $_GET["pg"] ?? "home";
switch ($_GET["pg"]) {
	case "home":
		require __DIR__."/../isolated/pages/piutang/{$_GET["pg"]}.php";
		break;
	default:
		http_response_code(404);
		print "Page not found!";
		exit;
		break;
}
