<?php
setcookie(session_name(), '', time() - 1800, '/');

$redirectUri = $_GET['redirect_uri'];
header("Location: {$redirectUri}");
exit;
?>
