<?php
include("../protection.php");
include("../../connection.php");

$book_id = $_GET['book_id'];

$time = time();
$ftime = date('Y/m/d H:i:s', $time);

$upd = $conn -> prepare("UPDATE borrowedbooks SET borrowedbook_avaliable = :borrowedbook_avaliable, borrowedbook_checkin = :borrowedbook_checkin WHERE book_id = :book_id");
$upd -> bindValue(":borrowedbook_avaliable", 1);
$upd -> bindValue(":borrowedbook_checkin", $ftime);
$upd -> bindValue(":book_id", $book_id);
$upd -> execute();

$upd = $conn -> prepare("UPDATE books SET book_avaliable = :book_avaliable WHERE book_id = :book_id");
$upd -> bindValue(":book_avaliable", 1);
$upd -> bindValue(":book_id", $book_id);
$upd -> execute();

header("Location: index.php?c=ok");

?>
