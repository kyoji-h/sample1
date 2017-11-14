<?php
include 'parts/proc.php';

if(isset($_GET["method"])) {
  $method = $_GET["method"];

  switch ($method) {
    case 'w':
      $data = getDataW();
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
