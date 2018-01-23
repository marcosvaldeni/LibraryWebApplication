<?php
include("connection.php");

if ($_POST) {

	$user_name = $_POST['user_name'];
	$user_login = $_POST['user_login'];
	$user_email = $_POST['user_email'];
	$user_pass = $_POST['user_pass'];
	$user_pass2 = $_POST['user_pass2'];

	$msg;
	if ($user_pass == $user_pass2) {

		if ($user_name == "" || $user_login == "" || $user_pass == "") {
				$msg = "Same fields could be empty!";
		}else{
			$user_pass = password_hash($user_pass2,PASSWORD_DEFAULT);

			$sql = "INSERT INTO users (user_name, user_login, user_email, user_pass) VALUES (?, ?, ?, ?);";
			$sth = $conn -> prepare($sql);

			$sth -> bindParam(1, $user_name, PDO::PARAM_STR);
			$sth -> bindParam(2, $user_login, PDO::PARAM_STR);
			$sth -> bindParam(3, $user_email, PDO::PARAM_STR);
			$sth -> bindParam(4, $user_pass, PDO::PARAM_STR);

			$sth -> execute();
			header("Location: index.php?r=ok");
		}

	}else {
		$msg = "The passwords does not match!";
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
					<a href="index.php" class="btn btn-light btn-block">
						<i class="fa fa-arrow-left"></i> Back 
					</a>
				</div>
      </div>
    </div>
  </section>

  <!-- BOOK REGISTER -->
  <?php if (isset($_GET['r'])) {?>
  <section id="info">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-success alert-dismissible fade show">
              <button class="close" data-dismiss="alert" type="button">
                  <span>&times;</span>
              </button>
              <strong>Successful registration!</strong>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php } ?>
  <?php if (isset($msg)) { ?>
  <section id="info">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-danger alert-dismissible fade show">
              <button class="close" data-dismiss="alert" type="button">
                  <span>&times;</span>
              </button>
              <strong><?php echo $msg; ?></strong>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php } ?>
  <section id="profile">
    <div class="container">
      <div class="row">
        <div class="col-md-6 m-auto">
          <div class="card">
            <div class="card-header">
              <h4>Create account</h4>
            </div>
            <div class="card-body">
              <form action="" method="POST">
                <div class="form-group">
                  <label for="name">Nome:</label>
                  <input type="text" class="form-control" name="user_name" <?php if(isset($user_name)){ echo "value='".$user_name."'";} ?>>
                </div>
                <div class="form-group">
                  <label for="name">Login:</label>
                  <input type="text" class="form-control" name="user_login" <?php if(isset($user_login)){ echo "value='".$user_login."'";} ?>>
                </div>
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="text" class="form-control" name="user_email" <?php if(isset($user_email)){ echo "value='".$user_email."'";} ?>>
                </div>
                <div class="form-group">
                  <label for="email">Password:</label>
                  <input type="text" class="form-control" name="user_pass" placeholder="At least six characters">
                </div>
                <div class="form-group">
                  <label for="email">Repeat Password:</label>
                  <input type="text" class="form-control" name="user_pass2">
                </div>
                <div class="form-group">
                  <br/>
                  <button class="btn btn-success" type="submit">Register</button>
                  <a href="index.php" class="btn btn-secondary">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

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
