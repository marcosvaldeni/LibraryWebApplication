<?php
include("../protection.php");
include_once("../../connection.php");

if ($_POST) {

	$book_title = $_POST['book_title'];
	$book_author = $_POST['book_author'];
	$book_isbn = $_POST['book_isbn'];

	$msg;
	if ($book_title == "" || $book_author == "" || $book_isbn == "") {
			$msg = "Same fields could be empty!";
	}else{

		$sql = "INSERT INTO books (book_title, book_author, book_isbn) VALUES (?, ?, ?);";
		$sth = $conn -> prepare($sql);

		$sth -> bindParam(1, $book_title, PDO::PARAM_STR);
		$sth -> bindParam(2, $book_author, PDO::PARAM_STR);
		$sth -> bindParam(3, $book_isbn, PDO::PARAM_STR);

		$sth->execute();
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
  <link rel="stylesheet" href="../../css/font-awesome.min.css">
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

	<!-- NAVBAR -->
	<nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
		<div class="container">
			<a href="../" class="navbar-brand">CCT Library</a>
			<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item px-2">
						<a href="index.php" class="nav-link">Dashboard</a>
					</li>
					<li class="nav-item px-2">
						<a href="index.php" class="nav-link active">Books</a>
					</li>
					<li class="nav-item px-2">
						<a href="../member/" class="nav-link">Users</a>
					</li>
					<li class="nav-item px-2">
						<a href="../staff/" class="nav-link">Staffs</a>
					</li>
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item dropdown mr-3">
						<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-user"></i> Welcome <?php echo $_SESSION["user_name"]; ?>
						</a>
						<div class="dropdown-menu">
							<a href="../profile.php" class="dropdown-item">
								<i class="fa fa-user-circle"></i> Profile
							</a>
							<a href="../pass.php" class="dropdown-item">
								<i class="fa fa-lock"></i> Password
							</a>
						</div>
					</li>
					<li class="nav-item">
						<a href="../../logout.php" class="nav-link">
							<i class="fa fa-user-times"></i> Logout
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

  <header id="main-header" class="py-2 bg-primary text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1><i class="fa fa-book"></i> Books</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- ACTIONS -->
  <section id="action" class="py-4 mb-4 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-3 mr-auto">
          <a href="../" class="btn btn-light btn-block">
            <i class="fa fa-arrow-left"></i> Back To Dashboard
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- BOOK REGISTER -->
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
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>Register Book</h4>
            </div>
            <div class="card-body">
              <form action="" method="POST">
                <div class="form-group">
                  <label for="name">Title</label>
                  <input type="text" class="form-control" name="book_title" value="<?php if(isset($book_title)){ echo $book_title;} ?>">
                </div>
								<div class="form-group">
									<label for="name">Author</label>
									<input type="text" class="form-control" name="book_author" value="<?php if(isset($book_author)){ echo $book_author;} ?>">
								</div>
                <div class="form-group">
                  <label for="email">ISBN</label>
                  <input type="text" class="form-control" name="book_isbn" value="<?php if(isset($book_isbn)){ echo $book_isbn;} ?>">
                </div>
								<div class="form-group">
                  <br/>
									<button class="btn btn-primary" name="save_btn" type="submit">Save</button>
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

  <script src="../../js/jquery.min.js"></script>
  <script src="../../js/popper.min.js"></script>
  <script src="../../js/bootstrap.min.js"></script>
</body>
</html>
