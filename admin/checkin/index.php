 <?php
//  CONTROL AREA
include("../protection.php");
include("../../connection.php");
$c = "";
if (isset($_GET['c'])) {
  $c = $_GET['c'];
}
$search;
if (isset($_GET['search'])) {
	$search = $_GET['search'];
	$opt = $_GET['opt'];
	$stmt = $conn -> prepare("SELECT * FROM books WHERE ".$opt." like '%".$search."%';");
	$stmt -> execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
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
              <a href="../" class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item px-2">
              <a href="../book/" class="nav-link">Books</a>
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
                  <i class="fa fa-gear"></i> Password
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
            <h1><i class="fa fa-sign-in"></i> Check In</h1>
          </div>
        </div>
      </div>
    </header>

    <!-- ACTIONS -->
    <section id="action" class="py-4 mb-4 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ml-auto">
            <form action="" method="GET">
              <div class="input-group">
                <select name="opt" class="form-control">
                <option value="book_title">Title</option>
                <option value="book_author">Author</option>
                <option value="book_ISBN">ISBN</option>
                </select>
                <input type="text" class="form-control" name="search" placeholder="Search">
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="submit">Search</button>
                </span>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>


  	<?php if ($c == "ok" ) {?>
    <section id="info">
      <div class="container">
        <div class="row">
          <div class="col-md-5 m-auto">
            <div class="alert alert-success alert-dismissible fade show">
                <button class="close" data-dismiss="alert" type="button">
                    <span>&times;</span>
                </button>
                <strong>Book checked in successfully!</strong>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>

    <?php if(isset($search)){ ?>
    <!-- POSTS -->
    <section id="posts">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h4>Books Search</h4>
              </div>
              <table class="table table-striped">
                <thead class="thead-inverse">
                  <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN-10</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>

                  <?php foreach($rows as $row){ ?>
                  <tr>
                    <td><?php echo $row['book_title']; ?></td>
                    <td><?php echo $row['book_author']; ?></td>
                    <td><?php echo $row['book_ISBN']; ?></td>
                    <td><a href="#" class="btn btn-success" data-toggle="modal" data-target="#<?= $row['book_id']; ?>"><i class="fa fa-sign-in"></i> Check In</a></td>
                  </tr>
                <?php } ?>

                </tbody>
              </table>
            </nav>
          </div>
        </div>
      </div>
    </div>
    </section>

    <?php }else{ ?>

    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

    <?php } ?>


    <footer id="main-footer" class="bg-dark text-white mt-5 p-5">
      <div class="conatiner">
        <div class="row">
          <div class="col">
            <p class="lead text-center">Copyright &copy; 2017 CCT Library</p>
          </div>
        </div>
      </div>
    </footer>

    <!-- MODAL -->
    <?php if(isset($search)){
            foreach($rows as $row){ ?>
    <div class="modal fade" id="<?= $row['book_id']; ?>">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-warning text-white">
            <h5 class="modal-title"><i class="fa fa-sign-in"></i> Check In</h5>
            <button class="close" data-dismiss="modal"><span>&times;</span></button>
          </div>
          <div class="modal-body">
                <p class="h6 text-secondary">Title</p>
                <p><?= $row['book_title']; ?></p>
                <p class="h6 text-secondary">Author</p>
                <p><?= $row['book_author']; ?></p>
                <p class="h6 text-secondary">ISBN</p>
                <p><?= $row['book_ISBN']; ?></p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a href="checkin.php?book_id=<?= $row['book_id']; ?>" class="btn btn-warning">Confirm Check In</a>
          </div>
        </div>
      </div>
    </div>
    <?php
      }
    } ?>

    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
  </body>
</html>
