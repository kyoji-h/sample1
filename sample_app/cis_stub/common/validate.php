<?php
function isExist($value) {
  if (isset($value) && $value !== '') {
    return true;
  } else {
    return false;
  }
}

function isAlphanum($value) {
  if (preg_match("/^[a-zA-Z0-9]+$/", $value)) {
    return true;
  } else {
    return false;
  }
}

function isAlphanumsymbol($value) {
  if (preg_match("/^[[:graph:]|[:space:]]+$/i", $value)) {
    return true;
  } else {
    return false;
  }
}

function checkMaxLength($value, $maxNum, $isMb = true) {
  if ($isMb) {
    $strLength = mb_strlen($value);
  } else {
    $strLength = strlen($value);
  }

  if ($strLength <= $maxNum) {
    return true;
  } else {
    return false;
  }
}

function isMailaddress($value) {
  if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
    return true;
  } else {
    return false;
  }
}

function checkChoices($value, $choiceArray) {
  if (in_array($value, $choiceArray, true)) {
    return true;
  } else {
    return false;
  }
}

?>
