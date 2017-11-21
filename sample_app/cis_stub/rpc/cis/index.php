<?php
include_once 'parts/proc.php';
include_once 'parts/log.php';

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
    default:
      $data = array();
  }
} else {
  $data = array();
}

returnJson($data);

function returnJson($resultArray){
  if(array_key_exists('callback', $_GET)){
    $json = $_GET['callback'] . "(" . json_encode($resultArray) . ");";
  }else{
    $json = json_encode($resultArray);
  }
//  header('Content-Type: text/html; charset=utf-8');
  header('Content-Type: application/json; charset=utf-8');
  echo  $json;
  exit(0);
}
?>
