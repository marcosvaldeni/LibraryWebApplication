<?php
//  CONTROL BOOKS
include("../protection.php");
include("../../connection.php");

$stmt = $conn -> prepare("SELECT * FROM books ORDER BY book_id DESC");
$stmt -> execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
           <div class="col-md-2">
             <a href="register.php" class="btn btn-primary">
               <i class="fa fa-plus"></i> Add Book
             </a>
           </div>
           <div class="col-md-6 ml-auto">
             <form action="" method="GET">
             <div class="input-group">
               <select name="opt" class="form-control">
 							 <option value="book_title">Title</option>
 							 <option value="book_author">Author</option>
 							 <option value="book_ISBN">ISBN</option>
 							 </select>
               <input type="text" class="form-control" placeholder="Search">
               <span class="input-group-btn">
                 <button class="btn btn-primary">Search</button>
               </span>
             </div>
             </form>
           </div>
         </div>
       </div>
     </section>

     <!-- BOOKS -->
     <?php if (isset($_GET['d'])) { ?>
     <section id="info">
       <div class="container">
         <div class="row">
           <div class="col-md-12">
             <div class="alert alert-success alert-dismissible fade show">
                 <button class="close" data-dismiss="alert" type="button">
                     <span>&times;</span>
                 </button>
                 <center><p class="h4">Book deleted with success.</p></center>
             </div>
           </div>
         </div>
       </div>
     </section>
     <?php } ?>
     <section id="posts">
       <div class="container">
         <div class="row">
           <div class="col">
             <div class="card">
               <div class="card-header">
                 <h4>Latest Registred Books</h4>
               </div>
               <table class="table table-striped">
                 <thead class="thead-inverse">
                   <tr>
                     <th>Title</th>
                     <th>Author</th>
                     <th>ISBN</th>
                     <th>Status</th>
                     <?php if ($_SESSION["user_level"] == 1) { ?>
                     <th>Action</th>
                     <?php } ?>
                   </tr>
                 </thead>
                 <tbody>

                   <?php foreach($rows as $row){	?>
                   <tr>
                     <td><a href="update.php?book_id=<?= $row['book_id']; ?>"><?php echo $row['book_title']; ?></a></td>
                     <td><?php echo $row['book_author']; ?></td>
                     <td><?php echo $row['book_ISBN']; ?></td>
                     <td>
                     <?php if ($row['book_avaliable']){ ?>
                       <span class="btn btn-success">Avaliable</span>
                     <?php }else { ?>
                       <span class="btn btn-danger">Not Avaliable</span>
                     <?php } ?>
                     <?php if ($_SESSION["user_level"] == 1) { ?>
                     <td><a href="delete.php?book_id=<?= $row['book_id']; ?>">Delete</a></td>
                     <?php } ?>
                     </td>
                   </tr>
                   <?php } ?>
                 </tbody>
               </table>
             </div>
           </div>
         </div>
       </div>
     </section>

    <footer id="main-footer" class="bg-dark text-white mt-5 p-5">
      <div class="conatiner">
        <div class="row">
          <div class="col">
            <p class="lead text-center">Copyright &copy; 2017 Blogen</p>
          </div>
        </div>
      </div>
    </footer>

    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'editor1' );
    </script>
  </body>
  </html>
