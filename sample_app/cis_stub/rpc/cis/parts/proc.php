<?php
include_once 'log.php';

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

  outputLog('$resultData'.var_export($resultData, true));

  return $resultData;
}

function getDataUserGetUsrtyp($params){
  $dbh = connectDB();

  $userId = $params['userInfo']['userid'];

  $sqlUserSel = 'select user_type from cis_users where cis_user_id = :userid';
  $stmt = $dbh->prepare($sqlUserSel);
  $stmt->execute(array(
    ':userid' => $userId,
  ));
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($result) {
    $userType = $result['user_type'];

    $resultData = array(
      'status' => '0',
      'userType' => $userType,
    );
  } else {
    $resultData = array(
      'status' => '1',
      'userType' => null,
    );
  }

  outputLog('$resultData'.var_export($resultData, true));

  return $resultData;
}

function getDataContractGetAllAcountList($params){
  $dbh = connectDB();

  $userId = $params['userInfo']['userid'];
  $cId = $params['cid'];

  $sqlServiceUserSel = 'select cis_acc_id from cis_service_users where contents_id = :cid and cis_user_id = :userid';
  $stmt = $dbh->prepare($sqlServiceUserSel);
  $stmt->execute(array(
    ':cid' => $cId,
    ':userid' => $userId,
  ));
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($result) {
    $cisAccId = $result['cis_acc_id'];

    $resultData = array(
      'status' => 0,
      'contentInfoList' => array(
        0 => array(
          'accid' => $cisAccId,
          'cid' => $cId,
          'status' => 0,
        )
      )
    );
  } else {
    $resultData = array(
      'status' => 1,
      'userType' => array(),
    );
  }

  outputLog('$resultData'.var_export($resultData, true));

  return $resultData;
}

function getDataAuthServiceLogin($params){
  $dbh = connectDB();

  $userId = $params['userInfo']['userid'];
  $accId = $params['accid'];

  $sqlServiceUserSel = 'select cis_acc_id from cis_service_users where cis_acc_id = :accid and cis_user_id = :userid';
  $stmt = $dbh->prepare($sqlServiceUserSel);
  $stmt->execute(array(
    ':accid' => $accId,
    ':userid' => $userId,
  ));
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($result) {
    $resultData = array(
      'status' => 0,
      'result' => 0
    );
  } else {
    $resultData = array(
      'status' => 1,
      'result' => 18
    );
  }

  outputLog('$resultData'.var_export($resultData, true));

  return $resultData;
}

?>
