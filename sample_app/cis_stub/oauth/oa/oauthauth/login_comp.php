<?php
session_start();

if (!isset($_COOKIE['PHPSESSID'])) {
  header("Location: login_input.php?r=2");

} else {

  $dsn = 'mysql:host=127.0.0.1:3306;dbname=cisdb';
  $user = 'cisuser';
  $password = 'password';

  try{
    $dbh = new PDO($dsn, $user, $password);

    $sessionId = $_COOKIE['PHPSESSID'];
    $id = $_SESSION['id'];

    //$dbh->beginTransaction();
    $sqlSesUpd = 'update cis_users set session_id = :sesid where id = :id';
    $stmt = $dbh->prepare($sqlSesUpd);
    $stmt->execute(array(
      'sesid' => $sessionId,
      'id' => $id
    ));
    //$dbh->commit();

//  $html = <<<EOF
//<script type="text/javascript">
////<!--
//window.onload = function() { document.mainForm.submit(); };
////-->
//</script>
//<form name="mainForm" method="post" action="https://XXXXX">
//<input name="cis_sessid" type="hidden" value="$sessionId">
//<input name="provision" type="hidden" value="">
//<input name="_c" type="hidden" value="1">
//</form>
//EOF;
    $html = $id . '  ' . $sessionId;

    echo $html;

  }catch (PDOException $e){
    print('Error:'.$e->getMessage());
    exit;
  }

}
?>
