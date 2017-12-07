<?php
include_once '../../../common/validate.php';
include '../../../common/dbaccess.php';

$id = $_POST['sqexid'];
$pw = $_POST['password'];
$postParams = array(
  'id' => $id,
  'pw' => $pw,
);

$validateResult = validateParams($postParams);
if (!is_null($validateResult)) {
  header("Location: login_input.php?r=$validateResult");
  exit;
}

$dbh = connectDB();
if (is_null($dbh)) {
  header("Location: login_input.php?r=dbaccesserr");
  exit;
}

$userInfo = getUserInfo($dbh);
if ($userInfo) {
  session_start();
  $_SESSION['userid'] = $userInfo['cis_user_id'];

  header("Location: login_comp.php");
} else {
  header("Location: login_input.php?r=nouser");
}

exit;

function validateParams($postParams) {

  $id = $postParams['id'];
  if (!isExist($id)) {
    return 'regvalid1';
  }
  if (!isAlphanum($id)) {
    return 'regvalid2';
  }
  if (!checkMaxLength($id, 10, true)) {
    return 'regvalid3';
  }

  $pw = $postParams['pw'];
  if (!isExist($pw)) {
    return 'regvalpw1';
  }
  if (!isAlphanumsymbol($pw)) {
    return 'regvalpw2';
  }
  if (!checkMaxLength($pw, 20, true)) {
    return 'regvalpw3';
  }

  return null;
}

function getUserInfo($dbh) {
  $id = $_POST['sqexid'];
  $pw = $_POST['password'];

  $sqlUserSel = 'select cis_user_id from cis_users where sqex_id = :sqexid and password = :pw';
  $stmt = $dbh->prepare($sqlUserSel);
  $stmt->execute(array(
    ':sqexid' => $id,
    ':pw' => $pw
  ));
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  return $result;
}

?>
