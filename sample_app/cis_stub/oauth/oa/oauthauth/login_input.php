<html>
<body>
<h1>スクエニメンバーズ</h1>
<p>ログイン</p>
<?php
$result = $_GET['r'];
if ($result == '1') {
  echo "<span style=\"color: red;\">ID、PWに誤りがあります</span>";
} elseif ($result == '2') {
  echo "<span style=\"color: red;\">処理に失敗しました</span>";
}
?>
<p>
<form id="loginForm" name="login" method="post" action="login_exe.php">
  <input type="text" name="sqexid" id="sqexid" value="" class="" placeholder="ID(またはメールアドレス)">
  <br/>
  <input type="password" name="password" id="password" class="" placeholder="パスワード">
  <br/>
  <button type="submit" id="login-button" class="">ログイン</button>
  <br/>
  <input type="hidden" id="wfp" name="wfp" value="1">
</form>
</p>
<body>
</html>

