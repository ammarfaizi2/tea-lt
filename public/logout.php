<?php

require_once __DIR__."/../init.php";

$sess = sess();
$sess->destroy();
header("Location: login.php?w=".urlencode(rstr(64)));
$sess->flush();
exit;
