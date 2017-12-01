<?php
setcookie(session_name(), '', time() - 1800, '/');

$url = 'regist_input.php';
header("Location: {$url}");
exit;
?>
