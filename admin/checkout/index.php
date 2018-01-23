 <?php
//  CONTROL AREA
include("../protection.php");
include("../../connection.php");
include("functions.php");
$c = "";
if (isset($_GET['c'])) {
  $c = $_GET['c'];
}
?>
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
            <h1><i class="fa fa-sign-out"></i> Checking Books Out</h1>
          </div>
        </div>
      </div>
    </header>

    <!-- ACTIONS -->
    <section id="action" class="py-4 mb-4 bg-light">
      <div class="container">
        <div class="row">
          <?php if (!isset($_COOKIE['user_id'])) { ?>
          <div class="col-md-6 ml-auto">
            <form action="" method="POST">
            <div class="input-group">
              <select name="opt" class="form-control">
              <option value="user_name">Name</option>
              <option value="user_id">Student Number</option>
              </select>
              <input type="text" class="form-control" name="search" placeholder="Search">
              <span class="input-group-btn">
                <button class="btn btn-primary">Search</button>
              </span>
            </div>
            </form>
          </div>
        <?php }else{ ?>
          <a class="btn btn-danger" href="cancel.php">Cancel</a>
        <?php } ?>
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
                <strong>Book checked out successfully!</strong>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>

    <?php if (isset($_POST['search'])){
             $search = $_POST['search'];
             $opt = $_POST['opt'];
    ?>
      <section id="users">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-header">
                  <h4>List of Students.</h4>
                </div>
                <?php
                $stmt = $conn -> prepare("SELECT * FROM users where user_level = 3 AND ".$opt." like '%".$search."%';");
                $stmt -> execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <table class="table table-striped">
                  <thead class="thead-inverse">
                    <tr>
                      <th>Student Number</th>
                      <th>Name</th>
                      <th>e-mail</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($rows as $row){
                      $overdue = $conn -> query("SELECT count(borrowedbook_id)
                                                 FROM borrowedbooks
                                                 WHERE user_id = ".$row['user_id']."
                                                 AND borrowedbook_avaliable = 0
                                                 AND borrowedbook_exreturn < current_timestamp();") -> fetch(PDO::FETCH_ASSOC);
                      ?>
                    <tr>
                      <td><?php echo $row['user_id']; ?></td>
                      <td><?php echo $row['user_name']; ?></td>
                      <td><?php echo $row['user_email']; ?></td>
                      <td><a class="btn btn-primary" href="addStudent.php?user_id=<?= $row['user_id']; ?>">Add</a></td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </section>
    <?php } ?>

<?php
if (isset($_COOKIE['user_id'])) {
?>

<section id="student">
  <div class="container">
    <div class="row">
      <div class="col-md-12 m-auto">
        <div class="card">
          <div class="card-header">
            <?php
            $user_id = $_COOKIE['user_id'];
            $row = $conn -> query("SELECT * FROM users WHERE user_id = ".$user_id.";") -> fetch(PDO::FETCH_ASSOC); ?>
            <span class="h3"><?php echo $row['user_name']; ?>
          </div>

          <div class="card-body">

          <?php if(isset($_COOKIE['book_id'])){ ?>
            <table class="table table-striped">
              <thead class="thead-inverse">
                <tr>
                  <th>Title</th>
                  <th>Author</th>
                  <th>Avaliable</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($_COOKIE['book_id'] as $key => $value) {
                $row =  $conn -> query("SELECT * FROM books where book_id = $value") -> fetch(PDO::FETCH_ASSOC);
                 ?>
                <tr>
                  <td><?php echo $row['book_title']; ?></td>
                  <td><?php echo $row['book_author']; ?></td>
                  <td><?php echo $row['book_author']; ?></td>
                  <td><a class="btn btn-danger" href="del.php?possition_id=<?= $key; ?>">Delete</a></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
            <a class="btn btn-success" href="create.php">Confirm Check Out</a>
          <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<br/>
<section id="books">
  <div class="container">
    <div class="row">
      <div class="col-md-12 m-auto">
        <div class="card">
          <div class="card-header">

            <div class="col-md-6 ml-auto">
              <p> Find Books: </p>
              <form action="" method="POST">
              <div class="input-group">
                <select name="opt" class="form-control">
                <option value="book_title">Name</option>
                <option value="book_id">Book ID</option>
                </select>
                <input type="text" class="form-control" name="search_book" placeholder="Search">
                <span class="input-group-btn">
                  <button class="btn btn-primary">Search</button>
                </span>
              </div>
              </form>
            </div>
          </div>

          <div class="card-body">

            <?php if(isset($_POST['search_book'])){
              $search_book = $_POST["search_book"];
              $opt = $_POST["opt"];

              $stmt = $conn -> prepare("SELECT * FROM books where ".$opt." like '%".$search_book."%';");
              $stmt -> execute();
              $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
              ?>
              <table class="table table-striped">
                <thead class="thead-inverse">
                  <tr>
                    <th>ID Book</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Avaliable</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($rows as $row){?>
                  <tr>
                    <td><?php echo $row['book_id']; ?></td>
                    <td><?php echo $row['book_title']; ?></td>
                    <td><?php echo $row['book_author']; ?></td>
                    <td><?php echo $row['book_author']; ?></td>
                    <td>
                      <?php $avaliabre = avaliable_book($row['book_id'],$conn);
                      if ($avaliabre == true) {?>
                        <a class="btn btn-success" href="add.php?book_id=<?= $row['book_id']; ?>">Add<a/>
                      <?php }else{ ?>
                        <span class="btn btn-secondary">Not Avaliable </span>
                      <?php } ?>
                    </td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php } ?>

    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

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
