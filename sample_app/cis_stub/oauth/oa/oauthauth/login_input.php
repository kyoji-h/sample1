<html>
<body>
<h1>(開発)スクエニメンバーズ</h1>
<p>ログイン</p>
<?php
if (isset($_GET['r'])) {
  $result = $_GET['r'];
  switch ($result) {
    case 'regvalid1':
      echo "<span style=\"color: red;\">IDが入力されていません</span>";
      break;
    case 'regvalid2':
      echo "<span style=\"color: red;\">IDは半角英数字で入力してください</span>";
      break;
    case 'regvalid3':
      echo "<span style=\"color: red;\">IDは10桁以内で入力してください</span>";
      break;
    case 'regvalpw1':
      echo "<span style=\"color: red;\">PWが入力されていません</span>";
      break;
    case 'regvalpw2':
      echo "<span style=\"color: red;\">PWは半角英数字記号で入力してください</span>";
      break;
    case 'regvalpw3':
      echo "<span style=\"color: red;\">PWは20桁以内で入力してください</span>";
      break;
    case 'nouser':
      echo "<span style=\"color: red;\">IDまたはPWに誤りがあります</span>";
      break;
    default:
      echo "<span style=\"color: red;\">エラーが発生しました</span>";
  }
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
<a href="http://XXXX">メンバーズトップへ</a>
<body>
</html>

