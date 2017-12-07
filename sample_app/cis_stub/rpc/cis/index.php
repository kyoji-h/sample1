<?php
include_once 'parts/proc.php';
include_once '../../common/log.php';

outputLog('[start]rpc/cis/index.php');

$jsonString = file_get_contents('php://input');
$jsonObj = json_decode($jsonString, true);

if(isset($jsonObj["method"])) {
  $method = $jsonObj["method"];
  $params = $jsonObj["params"];

  outputLog('$method:'.$method);
  outputLog('$params:'.var_export($params, true));

  switch ($method) {
    case 'AuthSessionAvailableEx':
      $data = getDataAuthSessionAvailableEx($params);
      break;
    case 'UserGetUsrtyp':
      $data = getDataUserGetUsrtyp($params);
      break;
    case 'ContractGetAllAccountList':
      $data = getDataContractGetAllAcountList($params);
      break;
    case 'AuthServiceLogin':
      $data = getDataAuthServiceLogin($params);
      break;
    case 'ContractStartTransaction':
      $data = getDataContractStartTransaction($params);
      break;
    case 'UserGetUserBasicSlim':
      $data = getDataUserGetUserBasicSlim($params);
      break;
    default:
      $data = array();
  }
} else {
  $data = array();
}

returnJson($data);

function returnJson($resultArray){
  $json = json_encode($resultArray);
  header('Content-Type: application/json; charset=utf-8');
  echo  $json;
  exit(0);
}
?>
