<?php
function outputLog($msg) {
  $curDate = date('Ymd');
  $curTime = date('H:i:s');
  $logFilePath = '/opt/app/logs/apilog_'.$curDate.'.log';

  $handle = @fopen($logFilePath, 'a');
  fwrite($handle, $curTime . ' ' . $msg ."\n");
  fclose($handle);
}
?>
