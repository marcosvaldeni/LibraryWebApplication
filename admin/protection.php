<?php
// CONTROL AREA
session_start();

if ($_SESSION["user_level"] >= 3 || $_SESSION["user_level"] <= 0) {
  header("Location: ../index.php");
}
?>
