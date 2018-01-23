<?php
include("../../connection.php");
function avaliable_book($book_id,$conn){
  $r;
  $row = $conn -> query("SELECT borrowedbooks.book_id FROM borrowedbooks where borrowedbooks.book_id = $book_id and borrowedbooks.borrowedbook_avaliable = 0") -> fetch(PDO::FETCH_ASSOC);
  if ($row > 0) {
    $r = false;
  } else {
    $r = true;
  }
  return $r;
}

function avaliable_member($member_id,$conn){
  $r;
  $row = $conn -> query("SELECT borrowedbooks.user_id FROM borrowedbooks where borrowedbooks.user_id = $member_id") -> fetch(PDO::FETCH_ASSOC);
  if ($row > 0) {
    $r = false;
  } else {
    $r = true;
  }
  return $r;
}


?>
