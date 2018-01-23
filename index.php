<?php
include("connection.php");
$msg = "";
if (isset($_GET['r'])) {
  $msg = "ok";
}
if ($_POST) {

  $user_login = $_POST["login"];
  $user_pass = $_POST["pass"];

  if (!empty($user_login) || !empty($user_pass)) {


    $sql = "SELECT * FROM users WHERE user_login = :login";
    $stmt = $conn -> prepare($sql);
    $stmt -> bindValue(':login', $user_login, PDO::PARAM_STR);
    $stmt -> execute();
    $result = $stmt->fetchAll();
    foreach($result as $row) {

      if(password_verify($user_pass,$row['user_pass'])){
        session_start();

            $_SESSION["user_id"] = $row['user_id'];
            $_SESSION["user_name"] = $row['user_name'];
            $_SESSION["user_level"] = $row['user_level'];

            if ($_SESSION["user_level"] == 1 || $_SESSION["user_level"] == 2) {
                  header("Location: admin/");
            }else {
                  header("Location: home/");
            }

      }else{
          $msg = "error";
      }

    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CCT Library</title>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
    <div class="container">
      <a href="index.html" class="navbar-brand">CCT</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
      </div>
    </div>
  </nav>

  <header id="main-header" class="py-2 bg-primary text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1><i class="fa fa-user"></i> CCT Library</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- ACTIONS -->
  <section id="action" class="py-4 mb-4 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-3 mr-auto">
          <a class="btn btn-success btn-block" href="register.php">Register</a>
        </div>
      </div>
    </div>
  </section>

  <!-- LOGIN -->
  <br/><br/>
  <?php if ($msg == "error") {?>
  <section id="info">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-danger alert-dismissible fade show">
              <button class="close" data-dismiss="alert" type="button">
                  <span>&times;</span>
              </button>
              <strong>Invalid username or password.</strong>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php } ?>
  <?php if ($msg == "ok") {?>
  <section id="info">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-success alert-dismissible fade show">
              <button class="close" data-dismiss="alert" type="button">
                  <span>&times;</span>
              </button>
              <strong>Congratulations You're Registered!</strong>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php } ?>
  <section id="login">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="card">
            <div class="card-header">
              <h4>Account Login</h4>
            </div>
            <div class="card-body">
              <form action="" method="POST">
                <div class="form-group">
                  <br/>
                  <input type="text" name="login" class="form-control" placeholder="Login" autofocus <?php if (isset($user_login)) { echo "value='".$user_login."'";} ?>>
                </div>
                <div class="form-group">
                  <br/>
                  <input type="password" name="pass" class="form-control" placeholder="Password">
                </div>
                <br/>
                <input type="submit" class="btn btn-primary btn-block" value="Login">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <br/><br/>

  <footer id="main-footer" class="bg-dark text-white mt-5 p-5">
    <div class="conatiner">
      <div class="row">
        <div class="col">
          <p class="lead text-center">Copyright &copy; 2017 CCT Library</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
