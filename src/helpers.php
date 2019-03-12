<?php

if (!defined("MY_HELPERS")):
define("MY_HELPERS", true);

/**
 * @param int $n
 * @param string $e
 * @return string
 */
function rstr(int $n = 32, string $e = null): string
{
	$e = is_string($e) ? $e : "1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM______.....-----";
	$r = "";
	$c = strlen($e) - 1;
	for ($i=0; $i < $n; $i++) { 
		$r .= $e[rand(0, $c)];
	}
	return $r;
}

/**
 * @return \Session
 */
function sess(): Session
{
	return Session::getInstance();
}

/**
 * @return void
 */
function load_helper(string $name): void
{
	require_once BASEPATH."/isolated/helpers/{$name}.php";
}

/**
 * @param string $str
 * @param string $key
 * @return string $key
 */
function cencrypt(string $str, string $key): string
{
	return \Encryption\Cencrypt::encrypt($str, $key);
}

/**
 * @param string $str
 * @param string $key
 * @return string $key
 */
function dencrypt(string $str, string $key): string
{
	return \Encryption\Cencrypt::decrypt($str, $key);
}

endif;
