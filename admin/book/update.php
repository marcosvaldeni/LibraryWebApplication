<?php
include("../protection.php");
include_once("../../connection.php");

if ($_GET && $_GET['book_id']) {
	$book_id = $_GET['book_id'];
}else {
	header("Location: index.php");
}

$row =  $conn -> query("SELECT * FROM books where book_id = $book_id") -> fetch(PDO::FETCH_ASSOC);

if ($row == 0) {
		header("Location: index.php");
}

if ($_POST) {
	$book_id = $_POST['book_id'];
	$book_title = $_POST['book_title'];
	$book_author = $_POST['book_author'];
	$book_isbn = $_POST['book_ISBN'];
	$msg;
	if ($book_title == "" || $book_author == "" || $book_isbn == "" || $book_id == "") {
			$msg = "Same fields could be empty!";
	}else{

		$upd = $conn -> prepare("UPDATE books SET book_title = :book_title, book_author = :book_author, book_ISBN = :book_ISBN WHERE book_id = :book_id");

		$upd -> bindValue(":book_title", $book_title);
		$upd -> bindValue(":book_author", $book_author);
		$upd -> bindValue(":book_ISBN", $book_isbn);
		$upd -> bindValue(":book_id", $book_id);
		$upd -> execute();
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
						<span class="btn btn-danger btn-block"><?php echo $msg; ?></span>
				</div>
			</div>
		</div>
	</section>
	<br/>
	<?php } ?>
  <section id="profile">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>Edit Book</h4>
            </div>
            <div class="card-body">
              <form action="" method="POST">
                <div class="form-group">
                  <label for="name">Title</label>
                  <input type="text" class="form-control" name="book_title" value="<?php if(isset($book_title)){ echo $book_title;}else{ echo $row['book_title'];} ?>">
                </div>
								<div class="form-group">
									<label for="name">Author</label>
									<input type="text" class="form-control" name="book_author" value="<?php if(isset($book_author)){ echo $book_author;}else{echo $row['book_author'];} ?>">
								</div>
                <div class="form-group">
                  <label for="email">ISBN</label>
                  <input type="text" class="form-control" name="book_ISBN" value="<?php if(isset($book_isbn)){ echo $book_isbn;}else{echo $row['book_ISBN'];} ?>">
                </div>
								<div class="form-group">
                  <br/>
									<button class="btn btn-primary" name="book_id" type="submit" value="<?php echo $book_id; ?>">Save</button>
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
