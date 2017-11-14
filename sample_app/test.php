<html>
<body>
<h1>Pemer!</h1>
<p>Hey!Good Job!!</p>
<p>
<?php
if(isset($_GET["func"])) {
  $func = $_GET["func"];
} else {
  $func = 'pao!';
}
echo $func;
?>
</p>
<body>
</html>

