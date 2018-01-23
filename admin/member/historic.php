<?php
//  CONTROL MEMBERS
include("../protection.php");
include("../../connection.php");
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
             <a href="../user/" class="nav-link active">Users</a>
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
 					<h1><i class="fa fa-users"></i> Users</h1>
 				</div>
 			</div>
 		</div>
 	</header>

  <section id="action" class="py-4 mb-4 bg-light">
   <div class="container">
     <div class="row">
       <div class="col-md-6 ml-auto">
         <div class="input-group">
           <input type="text" class="form-control" placeholder="Search">
           <span class="input-group-btn">
             <button class="btn btn-primary">Search</button>
           </span>
         </div>
       </div>
     </div>
   </div>
 </section>

   <!-- POSTS -->
   <section id="posts">
     <div class="container">
       <div class="row">
         <div class="col">
           <div class="card">
             <div class="card-header">
               <?php
               $user_id = $_GET["user_id"];
               $row = $conn -> query("SELECT * FROM users where user_id = $user_id and user_level = 3") -> fetch(PDO::FETCH_ASSOC);
               echo "<h4>".$row['user_name']." Historic</h4>";

               $stmt = $conn -> prepare("SELECT books.book_title, books.book_author, borrowedbooks.borrowedbook_checkout, borrowedbooks.borrowedbook_checkin, borrowedbooks.borrowedbook_exreturn FROM books inner join borrowedbooks on borrowedbooks.book_id = books.book_id where borrowedbooks.user_id = $user_id order by borrowedbooks.borrowedbook_checkout");
               $stmt -> execute();
               $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
               ?>
             </div>
             <table class="table table-striped">
               <thead class="thead-inverse">
                 <tr>
                   <th>Title</th>
                   <th>Author</th>
                   <th>Taken Data</th>
                   <th>Expected Return</th>
                  <th>Returned Date </th>
                 </tr>
               </thead>
               <tbody>
                 <?php foreach($rows as $row){ ?>
                 <tr>
                   <td><?php echo $row['book_title']; ?></td>
                   <td><?php echo $row['book_author']; ?></td>
                   <td><?php echo $row['borrowedbook_checkout']; ?></td>
                   <td><?php echo $row['borrowedbook_exreturn']; ?></td>
                   <td><?php echo $row['borrowedbook_checkin']; ?></td>
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
