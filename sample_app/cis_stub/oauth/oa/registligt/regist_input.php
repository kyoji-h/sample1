<html>
<body>
<h1>(開発)スクエニメンバーズ</h1>
<p>アカウント基本情報の入力</p>
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
    case 'regvalid3';
      echo "<span style=\"color: red;\">IDは10桁以内で入力してください</span>";
      break;
    case 'regvalpw1';
      echo "<span style=\"color: red;\">PWが入力されていません</span>";
      break;
    case 'regvalpw2';
      echo "<span style=\"color: red;\">PWは半角英数字記号で入力してください</span>";
      break;
    case 'regvalpw3';
      echo "<span style=\"color: red;\">PWは20桁以内で入力してください</span>";
      break;
    case 'regvalmail1';
      echo "<span style=\"color: red;\">メールアドレスが入力されていません</span>";
      break;
    case 'regvalmail2';
      echo "<span style=\"color: red;\">メールアドレスの形式で入力してください</span>";
      break;
    case 'regvalbirth1';
      echo "<span style=\"color: red;\">生年月日が入力されていません</span>";
      break;
    case 'regvalbirth2';
      echo "<span style=\"color: red;\">生年月日は選択肢より選んでください</span>";
      break;
    case 'regvalbirth3';
      echo "<span style=\"color: red;\">生年月日は正しい日付ではありません</span>";
      break;
    default:
      echo "<span style=\"color: red;\">エラーが発生しました</span>";
  }
}
?>
<p>
<form id="mainForm" name="main" method="post" action="regist_exe.php">
  <span>ID：</span><input type="text" name="sqexid" id="sqexid" value="" class="">
  <br/>
  <span>PW：</span><input type="password" name="password" id="password" class="">
  <br/>
  <span>メールアドレス：</span><input type="text" name="email" id="email" class="">
  <br/>
  <span>生年月日：</span>
  <select name="birthY" id="birthY" class="">
    <option value="1980">1980</option>
    <option value="1981">1981</option>
    <option value="1982">1982</option>
    <option value="1983">1983</option>
    <option value="1984">1984</option>
    <option value="1985">1985</option>
    <option value="1986">1986</option>
    <option value="1987">1987</option>
    <option value="1988">1988</option>
    <option value="1989">1989</option>
  </select>
  年
  <select name="birthM" id="birthM" class="">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
  </select>
  月
  <select name="birthD" id="birthD" class="">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16">16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    <option value="19">19</option>
    <option value="20">20</option>
    <option value="21">21</option>
    <option value="22">22</option>
    <option value="23">23</option>
    <option value="24">24</option>
    <option value="25">25</option>
    <option value="26">26</option>
    <option value="27">27</option>
    <option value="28">28</option>
    <option value="29">29</option>
    <option value="30">30</option>
    <option value="31">31</option>
  </select>
  日
  <br/>
  <button type="submit" id="regist-button" class="">登録</button>
</form>
</p>
<body>
</html>

