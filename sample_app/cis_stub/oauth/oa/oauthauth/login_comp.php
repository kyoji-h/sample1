<?php
include '../../../common/dbaccess.php';

session_start();

if (!isset($_COOKIE['PHPSESSID'])) {

  header("Location: login_input.php?r=2");
} else {

  $dbh = connectDB();
  if (is_null($dbh)) {
    header("Location: login_input.php?r=2");
    exit;
  }

  $sessionId = $_COOKIE['PHPSESSID'];
  $userid = $_SESSION['userid'];

  $sqlSesUpd = 'update cis_users set session_id = :sesid where cis_user_id = :userid';
  $stmt = $dbh->prepare($sqlSesUpd);
  $stmt->execute(array(
    'sesid' => $sessionId,
    'userid' => $userid
  ));

  $html = <<<EOF
<script type="text/javascript">
//<!--
window.onload = function() { document.mainForm.submit(); };
//-->
</script>
<form name="mainForm" method="post" action="https://XXXXXX">
<input name="cis_sessid" type="hidden" value="$sessionId">
<input name="provision" type="hidden" value="">
<input name="_c" type="hidden" value="1">
</form>
EOF;
  //$html = $id . '  ' . $sessionId;

  echo $html;

}
?>
