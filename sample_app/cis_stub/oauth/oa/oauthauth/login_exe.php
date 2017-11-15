<?php
$id = $_POST['sqexid'];
$pw = $_POST['password'];

$dsn = 'mysql:host=127.0.0.1:3306;dbname=cisdb';
//$user = 'cisuser';
$user = 'root';
//$password = 'password';
$password = 'root';

try{
    $dbh = new PDO($dsn, $user, $password);
    print('success');
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
}

?>
