<?php
function outputLog($msg) {
  $curDate = date('Ymd');
  $logFileDir = '/opt/app/logs/cis_stub/';
  $logFilePath = $logFileDir.'log_'.$curDate.'.log';

  writeLog($logFileDir, $logFilePath, $msg);
}

function outputApiLog($msg) {
  $curDate = date('Ymd');
  $logFileDir = '/opt/app/logs/cis_stub/';
  $logFilePath = $logFileDir.'apilog_'.$curDate.'.log';

  writeLog($logFileDir, $logFilePath, $msg);
}

function writeLog($logFileDir, $logFilePath, $msg) {
  if (!file_exists($logFileDir)) {
    mkdir($logFileDir, 0777);
  }

  $curTime = date('H:i:s');

  $handle = @fopen($logFilePath, 'a');
  fwrite($handle, $curTime . ' ' . $msg ."\n");
  fclose($handle);
}
?>
