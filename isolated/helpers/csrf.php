<?php

/**
 * @return string
 */
function getCsrf(): string
{
	$sess = sess();
	$csrf = $sess->get2("csrf", 0);
	if ($csrf !== 0) {
		return cencrypt($csrf, APP_KEY);
	}
	$csrf = rstr(32);
	$sess->set2("csrf", $csrf);
	return dencrypt($csrf, APP_KEY);
}

/**
 * @return bool
 */
function validate_csrf(): bool
{
	if (isset($_POST["_tea_csrf"])) {
		return sess()->get2("csrf") === $_POST["_tea_csrf"];
	}
	return false;
}
