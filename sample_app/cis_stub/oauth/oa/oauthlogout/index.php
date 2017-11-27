<?php
setcookie(session_name(), '', time() - 1800, '/');

$url = 'http://XXXXXX';
header("Location: {$url}");
exit;
?>
