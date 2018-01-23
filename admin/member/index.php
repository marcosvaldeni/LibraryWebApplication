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
               <h4>Latest Members Registered</h4>
             </div>
             <?php
             $stmt = $conn -> prepare("SELECT * FROM users where user_level = 3 ORDER BY user_id DESC;");
             $stmt -> execute();
             $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
             ?>
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
                 <?php foreach($rows as $row){ ?>
                 <tr>
                   <td scope="row"><?php echo $row['user_id']; ?></td>
                   <td><?php echo $row['user_name']; ?></td>
                   <td><?php echo $row['user_email']; ?></td>
                   <td>July 12, 2017</td>
                   <td><a href="historic.php?user_id=<?php echo $row['user_id']; ?>" class="btn btn-secondary">
                     <i class="fa fa-angle-double-right"></i> Historic
                   </a></td>
                 </tr>
               <?php } ?>
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
  </body>
</html>
