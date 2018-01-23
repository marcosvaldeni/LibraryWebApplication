<?php
//     CHECKOUT
include("../protection.php");
include("../../connection.php");
$user_id = $_COOKIE['user_id'];
$staff_id = $_SESSION['user_id'];
$book_id;

$nextWeek = time() + (7 * 24 * 60 * 60);
$fnextWeek = date('Y/m/d H:i:s', $nextWeek);

if (isset($_COOKIE['book_id'])) {
  foreach ($_COOKIE['book_id'] as $key => $value) {
    $book_id = $value;

    $sql = "INSERT INTO borrowedbooks (user_id, book_id, borrowedbook_exreturn, staff_id) VALUES (?, ?, ?, ?);";
    $sth = $conn -> prepare($sql);
    $sth -> bindParam(1, $user_id, PDO::PARAM_STR);
    $sth -> bindParam(2, $book_id, PDO::PARAM_STR);
    $sth -> bindParam(3, $fnextWeek, PDO::PARAM_STR);
    $sth -> bindParam(4, $staff_id, PDO::PARAM_STR);
    $sth -> execute();

    $upd = $conn -> prepare("UPDATE books SET book_avaliable = :book_avaliable WHERE book_id = :book_id");
    $upd -> bindValue(":book_avaliable", 0);
    $upd -> bindValue(":book_id", $book_id);
    $upd -> execute();

    setcookie('book_id['.$key.']', "", time() - 3600);

  }
}

setcookie('user_id', "", time() - 3600);
header("Location: index.php?c=ok");
?>
