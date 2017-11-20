<?php
session_start();

if (!isset($_COOKIE['PHPSESSID'])) {
  header("Location: login_input.php?r=2");

} else {
  $session_id = $_COOKIE['PHPSESSID'];

  $html = <<<EOF
<script type="text/javascript">
//<!--
window.onload = function() { document.mainForm.submit(); };
//-->
</script>
<form name="mainForm" method="post" action="https://XXXXXXX">
<input name="cis_sessid" type="hidden" value="$session_id">
<input name="provision" type="hidden" value="">
<input name="_c" type="hidden" value="1">
</form>
EOF;
  echo $html;
}
?>
