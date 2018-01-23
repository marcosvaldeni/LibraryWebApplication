<?php

$book_id = $_GET['book_id'];

if (!isset($_COOKIE['possition'])) {
  $number = 0;
} else {
  $number = count($_COOKIE['possition']);
}

setcookie('possition['.$number.']', $number, time()+86400);

setcookie('book_id['.$number.']', $book_id, time()+3600);

header("Location: index.php");
?>
