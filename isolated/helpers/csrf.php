<?php

/**
 * @return string
 */
function getCsrf(): string
{
	$sess = sess();
	$csrf = rstr(64);
	$sess->set2("csrf", $csrf);
	return $csrf;
}

/**
 * @return bool
 */
function validate_csrf(): bool
{
	$sess = sess();
	if (isset($_POST["_csrf_token"])) {
		# code...
	}
}
