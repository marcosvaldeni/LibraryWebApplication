 <?php
//  CONTROL AREA
include("protection.php");
include("../connection.php");

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    	<title>CCT Library</title>
      <link rel="stylesheet" href="../css/font-awesome.min.css">
      <link rel="stylesheet" href="../css/bootstrap.css">
      <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
      <div class="container">
        <a href="index.php" class="navbar-brand">CCT Library</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item px-2">
              <a href="index.php" class="nav-link active">Dashboard</a>
            </li>
            <li class="nav-item px-2">
              <a href="book/" class="nav-link">Books</a>
            </li>
            <li class="nav-item px-2">
              <a href="member/" class="nav-link">Users</a>
            </li>
            <li class="nav-item px-2">
              <a href="staff/" class="nav-link">Staffs</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown mr-3">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user"></i> Welcome <?php echo $_SESSION["user_name"]; ?>
              </a>
              <div class="dropdown-menu">
                <a href="profile.php" class="dropdown-item">
                  <i class="fa fa-user-circle"></i> Profile
                </a>
                <a href="pass.php" class="dropdown-item">
                  <i class="fa fa-lock"></i> Password
                </a>
              </div>
            </li>
            <li class="nav-item">
              <a href="../logout.php" class="nav-link">
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
            <h1><i class="fa fa-gear"></i> Dashboard</h1>
          </div>
        </div>
      </div>
    </header>

    <!-- ACTIONS -->
    <section id="action" class="py-4 mb-4 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-2">
            <a href="book/register.php" class="btn btn-primary btn-block">
              <i class="fa fa-plus"></i> Add Book
            </a>
          </div>
          <div class="col-md-2">
            <a href="staff/register.php" class="btn btn-primary btn-block">
              <i class="fa fa-plus"></i> Add Staff
            </a>
          </div>
          <div class="col-md-2">
            <a href="checkin/" class="btn btn-primary btn-block">
              <i class="fa fa-sign-in"></i> Check In
            </a>
          </div>
          <div class="col-md-2">
            <a href="checkout/" class="btn btn-primary btn-block">
              <i class="fa fa-sign-out"></i> Check Out
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- POSTS -->
    <section id="posts">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <div class="card">
              <div class="card-header">
                <h4>Latest Cheked Out</h4>
              </div>
              <?php
              $stmt = $conn -> prepare("SELECT users.user_id, users.user_name, books.book_title, borrowedbooks.borrowedbook_checkout, borrowedbooks.borrowedbook_exreturn FROM borrowedbooks
                                     inner join users
                                     on borrowedbooks.user_id = users.user_id
                                     and borrowedbooks.borrowedbook_avaliable = 0
                                     inner join books
                                     on borrowedbooks.book_id = books.book_id
                                     order by borrowedbooks.borrowedbook_checkout DESC");
              $stmt -> execute();
              $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
              ?>
              <table class="table table-striped">
                <thead class="thead-inverse">
                  <tr>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Date Checked Out</th>
                    <th>Date Back In</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($rows as $row){ ?>
                  <tr>
                    <td><?php echo $row['user_name']; ?></td>
                    <td><?php echo $row['book_title']; ?></td>
                    <td><?php echo date( "d F, Y", strtotime($row['borrowedbook_checkout'])); ?></td>
                    <td><?php echo date( "d F, Y", strtotime($row['borrowedbook_exreturn'])); ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-center bg-danger text-white mb-3">
              <div class="card-body">
                <h3>Over Due</h3>
                <h1 class="display-4">
                  <?php $row = $conn -> query("SELECT count(borrowedbook_id) FROM borrowedbooks WHERE borrowedbook_avaliable = 0 AND borrowedbook_exreturn < current_timestamp();") -> fetch(PDO::FETCH_ASSOC); ?>
                  <i class="fa fa-warning"></i> <?php echo $row['count(borrowedbook_id)']; ?>
                </h1>
                <a href="overdue.php" class="btn btn-outline-light btn-sm">View</a>
              </div>
            </div>

            <div class="card text-center bg-success text-white mb-3">
              <div class="card-body">
                <h3>Books</h3>
                <h1 class="display-4">
                  <?php $row = $conn -> query("SELECT count(books.book_id) FROM books") -> fetch(PDO::FETCH_ASSOC); ?>
                  <i class="fa fa-book"></i> <?php echo $row['count(books.book_id)']; ?>
                </h1>
                <a href="book/" class="btn btn-outline-light btn-sm">View</a>
              </div>
            </div>

            <div class="card text-center bg-warning text-white mb-3">
              <div class="card-body">
                <h3>Users</h3>
                <h1 class="display-4">
                  <?php $row = $conn -> query("SELECT count(users.user_id) FROM users") -> fetch(PDO::FETCH_ASSOC); ?>
                  <i class="fa fa-users"></i> <?php echo $row['count(users.user_id)']; ?>
                </h1>
                <a href="member/" class="btn btn-outline-light btn-sm">View</a>
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

    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
