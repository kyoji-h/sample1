<?php
include '../../../common/dbaccess.php';

session_start();

if (!isset($_COOKIE['PHPSESSID'])) {

  header("Location: regist_input.php?r=nosesid");
} else {

  $dbh = connectDB();
  if (is_null($dbh)) {
    header("Location: regist_input.php?r=dbaccesserr");
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
<html>
<body>
<p>登録完了しました。</p>
<form id="mainForm" name="main" method="post" action="http://xxxx">
  <a href="javascript:document.main.submit();" class=""><span>次へ</span></a>
  <input name="cis_sessid" type="hidden" value="$sessionId">
  <input name="_c" type="hidden" value="1">
</form>
<body>
</html>
EOF;
  //$html = $userid . '  ' . $sessionId;

  echo $html;

}
?>
