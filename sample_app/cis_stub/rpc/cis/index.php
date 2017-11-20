<?php
include 'parts/proc.php';

if(isset($_POST["method"])) {
  $method = $_POST["method"];
  $params = $_POST["params"];

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
