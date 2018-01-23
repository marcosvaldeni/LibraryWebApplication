<?php
//  CONTROL MEMBERS
include("../protection.php");
include("../../connection.php");
//include("../functions.php");
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
             <a href="../../staff/" class="nav-link active">Staffs</a>
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
 					<h1><i class="fa fa-users"></i> Users</h1>
 				</div>
 			</div>
 		</div>
 	</header>

  <section id="action" class="py-4 mb-4 bg-light">
   <div class="container">
     <div class="row">
       <div class="col-md-2">
         <a href="register.php" class="btn btn-primary btn-block">
           <i class="fa fa-plus"></i> Add Staff
         </a>
       </div>
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
               <h4>Latest Staffs Registered</h4>
             </div>
             <table class="table table-striped">
               <thead class="thead-inverse">
                 <tr>
                   <th>#</th>
                   <th>Name</th>
                   <th>e-Mail</th>
                   <th>Joined</th>
                   <th></th>
                 </tr>
               </thead>
               <tbody>
                 <tr>
                   <td scope="row">1</td>
                   <td>Post One</td>
                   <td>Web Development</td>
                   <td>July 12, 2017</td>
                   <td><a href="details.html" class="btn btn-secondary">
                     <i class="fa fa-angle-double-right"></i> Historic
                   </a></td>
                 </tr>
                 <tr>
                   <td scope="row">2</td>
                   <td>Post Two</td>
                   <td>Tech Gadgets</td>
                   <td>July 13, 2017</td>
                   <td><a href="details.html" class="btn btn-secondary">
                     <i class="fa fa-angle-double-right"></i> Historic
                   </a></td>
                 </tr>
                 <tr>
                   <td scope="row">3</td>
                   <td>Post Three</td>
                   <td>Web Development</td>
                   <td>July 14, 2017</td>
                   <td><a href="details.html" class="btn btn-secondary">
                     <i class="fa fa-angle-double-right"></i> Historic
                   </a></td>
                 </tr>
                 <tr>
                   <td scope="row">4</td>
                   <td>Post Four</td>
                   <td>Business</td>
                   <td>July 14, 2017</td>
                   <td><a href="details.html" class="btn btn-secondary">
                     <i class="fa fa-angle-double-right"></i> Historic
                   </a></td>
                 </tr>
                 <tr>
                   <td scope="row">5</td>
                   <td>Post Five</td>
                   <td>Web Development</td>
                   <td>July 15 2017</td>
                   <td><a href="details.html" class="btn btn-secondary">
                     <i class="fa fa-angle-double-right"></i> Historic
                   </a></td>
                 </tr>
                 <tr>
                   <td scope="row">6</td>
                   <td>Post Six</td>
                   <td>Health & Wellness</td>
                   <td>July 16, 2017</td>
                   <td><a href="details.html" class="btn btn-secondary">
                     <i class="fa fa-angle-double-right"></i> Historic
                   </a></td>
                 </tr>
               </tbody>
             </table>

           </div>
         </div>
       </div>
     </div>
   </section>



     <?php
     if (isset($_GET['user_id'])) {
       $user_id = $_GET["user_id"];
       $row = $conn -> query("SELECT * FROM users where user_id = $user_id and user_level = 3") -> fetch(PDO::FETCH_ASSOC);
       if ($row > 0) {
         echo $row['user_name']."<br?>";
         ?>
         <a href="historic.php?user_id=<?= $user_id; ?>">Historic</a>
         <?php
       } else {
         echo "Member not found.";
       }
     }
     ?>

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
   <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
   <script>
       CKEDITOR.replace( 'editor1' );
   </script>
  </body>
</html>
