<?php

$user_id = $_GET['user_id'];

setcookie('user_id', $user_id, time()+600);

header("Location: index.php");
?>
