<?php
function connectDB(){
  $dsn = 'mysql:host=127.0.0.1:3306;dbname=cisdb';
  $user = 'cisuser';
  $password = 'password';

  try {
    $dbh = new PDO($dsn, $user, $password);
  } catch(PDOException $e) {
    $dbh = null;
  }
  return $dbh;
}

function getDataW(){
  $dataW = array(
    'kakegoe' => 'oraa!',
    'level' => 'B',
  );
  return  $dataW;
}

function getDataAuthSessionAvailableEx($params){
  $dbh = connectDB();

  $sessionId = $params['sessionId'];

  $sqlUserSel = 'select cis_user_id from cis_users where session_id = :sesid';
  $stmt = $dbh->prepare($sqlUserSel);
  $stmt->execute(array(
    ':sesid' => $sessionId,
  ));
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($result) {
    $cisUserId = $result['cis_user_id'];

    $userInfo = array(
      'userid' => $cisUserId,
      'usrrgn' => '1',
      'paycur' => '1',
      'lang' => 'ja-jp',
      'sessionId' => $sessionId,
    );
    $resultData = array(
      'status' => '0',
      'userInfo' => $userInfo,
    );
  } else {
    $resultData = array(    
      'status' => '1',
      'userInfo' => array(),
    );
  }

  return $resultData;
}

?>
