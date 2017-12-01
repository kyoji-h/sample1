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
?>
