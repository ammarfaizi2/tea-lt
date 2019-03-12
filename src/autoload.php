<?php

if (!defined("MY_AUTOLOAD")):
define("MY_AUTOLOAD", true);
	
/**
 * @param string $class
 * @return void
 */
function myInternalAutoloader(string $class): void
{
	$class = str_replace("\\", "/", $class);
	require __DIR__."/classes/{$class}.php";
}

spl_autoload_register("myInternalAutoloader");

require __DIR__."/helpers.php";

endif;
