<?php

$dsn = 'mysql:host=127.0.0.1:3306;dbname=cisdb';
//$user = 'cisuser';
$user = 'root';
//$password = 'password';
$password = 'root';

try{
  $dbh = new PDO($dsn, $user, $password);
  $user_info = get_user_info($dbh);

  if ($user_info) {
    session_start();

    header("Location: login_comp.php");

  } else {
    header("Location: login_input.php?r=1");
  }
  exit;

}catch (PDOException $e){
  print('Error:'.$e->getMessage());
  exit;
}

function get_user_info($dbh) {
  $id = $_POST['sqexid'];
  $pw = $_POST['password'];

  //print($id.' '.$pw);
  $sql = 'select id from cis_users where sqex_id = :sqexid and password = :pw';
  $stmt = $dbh->prepare($sql);
  $stmt->execute(array(
    ':sqexid' => $id,
    ':pw' => $pw
  ));
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($result) {
    $result = true;
  }
  return $result;
}

?>
