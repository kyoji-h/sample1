<?php
include '../../../common/dbaccess.php';

$dbh = connectDB();
if (is_null($dbh)) {
  print('Error:'.$e->getMessage());
  header("Location: login_input.php?r=2");

} else {
  $userInfo = getUserInfo($dbh);

  if ($userInfo) {
    session_start();
    $_SESSION['userid'] = $userInfo['cis_user_id'];

    header("Location: login_comp.php");

  } else {
    header("Location: login_input.php?r=1");
  }
}

exit;

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
