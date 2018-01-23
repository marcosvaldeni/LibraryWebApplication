<?php

$possition_id = $_GET['possition_id'];

if (isset($_COOKIE['book_id'])) {
  setcookie('book_id['.$possition_id.']', "", time() - 3600);
}

header("Location: index.php");
?>
