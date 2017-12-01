<?php
include_once '../../../common/validate.php';
include_once '../../../common/dbaccess.php';
include_once '../../../common/log.php';

outputLog('[start]regist_exe.php');

$id = $_POST['sqexid'];
$pw = $_POST['password'];
$email = $_POST['email'];
$birthY = $_POST['birthY'];
$birthM = $_POST['birthM'];
$birthD = $_POST['birthD'];
$postParams = array(
  'id' => $id,
  'pw' => $pw,
  'email' => $email,
  'birthY' => $birthY,
  'birthM' => $birthM,
  'birthD' => $birthD,
);

$validateResult = validateParams($postParams);
if (!is_null($validateResult)) {
  header("Location: regist_input.php?r=$validateResult");
  exit;
}

$dbh = connectDB();
if (is_null($dbh)) {
  header("Location: regist_input.php?r=dbaccesserr");
  exit;
}

$cisUserId = registUserInfo($dbh, $postParams);
if (isExist($cisUserId)) {
  session_start();
  $_SESSION['userid'] = $cisUserId;

  header("Location: regist_comp.php");
} else {
  header("Location: regist_input.php?r=processerr");
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

  $email = $postParams['email'];
  if (!isExist($email)) {
    return 'regvalmail1';
  }
  if (!isMailaddress($email)) {
    return 'regvalmail2';
  }

  $choiceBirthYear = array(
    '1980',
    '1981',
    '1982',
    '1983',
    '1984',
    '1985',
    '1986',
    '1987',
    '1988',
    '1989',
    '1990',
  );
  $choiceBirthMonth = array(
    '1',
    '2',
    '3',
    '4',
    '5',
    '6',
    '7',
    '8',
    '9',
    '10',
    '11',
    '12',
  );
  $choiceBirthDay = array(
    '1',
    '2',
    '3',
    '4',
    '5',
    '6',
    '7',
    '8',
    '9',
    '10',
    '11',
    '12',
    '13',
    '14',
    '15',
    '16',
    '17',
    '18',
    '19',
    '20',
    '21',
    '22',
    '23',
    '24',
    '25',
    '26',
    '27',
    '28',
    '29',
    '30',
    '31',
  );
  $birthY = $postParams['birthY'];
  $birthM = $postParams['birthM'];
  $birthD = $postParams['birthD'];
  if (!isExist($birthY) || !isExist($birthM) || !isExist($birthD)) {
    return 'regvalbirth1';
  }
  if (!checkChoices($birthY, $choiceBirthYear) || !checkChoices($birthM, $choiceBirthMonth) || !checkChoices($birthD, $choiceBirthDay)) {
    return 'regvalbirth2';
  }
  if (!checkdate($birthM, $birthD, $birthY)) {
    return 'regvalbirth3';
  }

  return null;
}

function registUserInfo($dbh, $postParams) {
  $id = $postParams['id'];
  $pw = $postParams['pw'];
  $email = $postParams['email'];
  $birth = $postParams['birthY'].'-'.$postParams['birthM'].'-'.$postParams['birthD'];

  outputLog('$arg insert cis_users:'.var_export(array($id,$pw,$email,$birth), true));

  $sqlUserIns = 'insert into cis_users (sqex_id,password,mail_address,user_type,birth_date) values (:id,:pw,:email,:usertype,:birth)';
  $stmt = $dbh->prepare($sqlUserIns);
  $stmt->execute(array(
    'id' => $id,
    'pw' => $pw,
    'email' => $email,
    'usertype' => 23,
    'birth' => $birth
  ));

  $sqlUserSel = 'select cis_user_id from cis_users where sqex_id = :sqexid and password = :pw';
  $stmt = $dbh->prepare($sqlUserSel);
  $stmt->execute(array(
    ':sqexid' => $id,
    ':pw' => $pw
  ));
  $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);

  $cisUserId = $userInfo['cis_user_id'];

  outputLog('$arg insert cis_service_users:'.var_export(array($cisUserId), true));

  $sqlServiceUserIns = 'insert into cis_service_users (contents_id,cis_user_id) values (:cid,:userid)';
  $stmt = $dbh->prepare($sqlServiceUserIns);
  $stmt->execute(array(
    'cid' => 39000000000,
    'userid' => $cisUserId
  ));

  return $cisUserId;
}

?>
