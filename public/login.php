<?php

require_once __DIR__."/../init.php";

load_helper("csrf");

if (!isset($sess)) {
	$sess = sess();
	if ($sess->get("login")) {
		header("Location: home.php?w=".urlencode(rstr(64)));
		exit;
	}
}

if (
	isset(
		$_GET["action"],
		$_GET["w"],
		$_POST["login"],
		$_POST["username"],
		$_POST["password"],
		$_POST["_tea_csrf"]
	) && 
	is_string($_POST["username"]) && 
	is_string($_POST["password"])
) {

	if (!validate_csrf()) {
		$sess->set("login_alert", "Invalid CSRF Token");
		$sess->flush();
		header("Location: ?w=".urlencode(rstr(64)));
		exit;
	}

	$_POST["username"] = trim(strtolower($_POST["username"]));

	if (filter_var($_POST["username"], FILTER_VALIDATE_EMAIL)) {
		$where = "`email` = :username";
	} else {
		$where = "`username` = :username";
	}

	$pdo = DB::pdo();
	$st = $pdo->prepare("SELECT `id`,`password`,`created_at`,`username` FROM `users` WHERE {$where} LIMIT 1;");
	$st->execute([":username" => $_POST["username"]]);
	if ($st = $st->fetch(PDO::FETCH_NUM)) {
		if (dencrypt($st[1], $st[2]) === $_POST["password"]) {
			$sess->set("login", 1);
			$sess->set("user", $st[0]);
			$sess->set("username", $st[3]);
			$sess->flush();
			header("Location: home.php?ref=login&w=".urlencode(rstr(64)));
			exit;
		}
	}

	$st = $pdo = null;
	DB::close();
	$sess->set("login_alert", "Invalid username or password");
	$sess->flush();
	header("Location: ?w=".urlencode(rstr(64)));
	exit;
}

$msg = $sess->get("login_alert");
$csrf = getCsrf();
if (is_string($msg)) {
	$sess->unset("login_alert");
} else {
	unset($msg);
}
$sess->flush();

?><!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<?php headd(); ?>
	<link rel="stylesheet" type="text/css" href="assets/css/login.css"/>
<?php if (isset($msg)): ?>
	<script type="text/javascript">alert("<?php print stripslashes($msg); ?>");</script>
<?php endif; ?>
</head>
<body>
	<center>
		<div class="fcg">
			<div>
				<h2>Login</h2>
			</div>
			<form method="post" action="?action=1&amp;w=<?php print urlencode(rstr(64)); ?>">
				<div class="if">
					<div>
						<label>Username:</label>
					</div>
					<div>
						<input type="text" name="username" required/>
					</div>
				</div>
				<div class="if">
					<div>
						<label>Password:</label>
					</div>
					<div>
						<input type="password" name="password" required/>
					</div>
				</div>
				<div class="ib">
					<input type="hidden" name="_tea_csrf" value="<?php print htmlspecialchars($csrf, ENT_QUOTES, "UTF-8"); ?>"/>
					<button type="submit" name="login">Login</button>
				</div>
			</form>
		</div>
	</center>
</body>
</html>