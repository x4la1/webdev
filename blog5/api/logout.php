<?php
session_name('auth');
session_start();
$_SESSION = [];
session_destroy();
setcookie(session_name(), '', time()-3600);
header('HTTP/1.1 200 OK');
?>