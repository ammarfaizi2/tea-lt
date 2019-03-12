<?php

require __DIR__."/../init.php";

$sess = sess();

if ($sess->get("login")) {
	require __DIR__."/home.php";
} else {
	require __DIR__."/login.php";
}
