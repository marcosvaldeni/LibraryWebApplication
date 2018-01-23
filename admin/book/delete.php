<?php
include("../protection.php");
include_once("../../connection.php");

if ($_GET) {

	if (isset($_GET['delete_book_id'])) {
		$delete_book_id = $_GET['delete_book_id'];
		$dlt = $conn -> prepare("DELETE FROM books WHERE books.book_id = :bid");
		$dlt->bindValue(':bid', $delete_book_id);
		$dlt->execute();
		header("Location: index.php?d=ok");
	}

	if (isset($_GET['book_id'])) {
		$book_id = $_GET['book_id'];
		$row =  $conn -> query("SELECT * FROM books where book_id = $book_id") -> fetch(PDO::FETCH_ASSOC);
		if ($row == 0) {
				//header("Location: index.php");
		}
	}else {
		//header("Location: index.php");
	}

}else{
	//header("Location: index.php");
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

  <!-- BOOK DELETE -->
	<section id="info">
		<div class="container">
			<div class="row">
				<div class="col-md-8 m-auto">
					<div class="alert alert-danger alert-dismissible fade show">
							<button class="close" data-dismiss="alert" type="button">
									<span>&times;</span>
							</button>
							<center>
								<strong>Are you sure, you want to delete this book?</strong>
							</center>
					</div>
				</div>
			</div>
		</div>
	</section>
  <section id="delete">
    <div class="container">
      <div class="row">
        <div class="col-md-8 m-auto">
          <div class="card">
            <div class="card-header">
              <h4>Delete Book</h4>
            </div>
            <div class="card-body">
              <form action="" method="POST">
                <div class="form-group">
                  <p class="h6">Title</p>
                  <p><?= $row['book_title']; ?></p>
                </div>
								<div class="form-group">
									<p class="h6">Author</p>
									<p><?= $row['book_author']; ?></p>
								</div>
                <div class="form-group">
                  <p class="h6">ISBN</p>
                  <p><?= $row['book_ISBN']; ?></p>
                </div>
								<div class="form-group">
                  <br/>
									<a href="delete.php?delete_book_id=<?= $book_id; ?>" class="btn btn-danger">Delete</a>
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
