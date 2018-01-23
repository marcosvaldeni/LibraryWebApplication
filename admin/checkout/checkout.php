<?php
//  CHECKOUT
include("protection.php");
include("../connection.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    	<title>CCT Library</title>
  </head>
  <body>
    <span>Hello, <?php echo $_SESSION["user_name"]; ?></span><br/>
    <a href="../user/profile.php">Profile</a> | <a href="../logout.php">Logout</a>
    <center>
      <h1>::..Control Area..::</h1>
      Home | <a href="book/">Books</a> | <a href="user/">Users</a> | <a href="site/">Site</a>
      <br><br></br>
      <h2>Check out</h2>

      <form class="form-signin" action="" method="GET">
        <button class="btn btn-lg btn-primary btn-block" type="submit">
          Search
        </button>
        <input type="text" class="form-control" name="user_id" placeholder="Member ID" required autofocus>
      </form>

      <?php
        if (isset($_GET['user_id'])) {
          $user_id = $_GET['user_id'];

          $row =  $conn -> query("SELECT * FROM users where user_id = $user_id and user_level = 3") -> fetch(PDO::FETCH_ASSOC);
          ?>
        <?php
        if ($row > 0) {
          echo $row['user_name']."<br/>";
          echo '<a href="create.php?user_id='.$user_id.'">Check Out</a>';
        } else {
          echo "None users was found!...";
        }
         ?>

          <?php } ?>


    </center>

  </body>
</html>
