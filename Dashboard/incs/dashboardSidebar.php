<?php session_start(); ?>
<?php 
if(!isset($_SESSION['auth'])){
    header("location:index.php");
    die;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Template</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="../css/dashboardStyle.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h2 class="text-white text-center p-4">
        <a class="nav-link active" aria-current="page" href="../index.php">EraaSoft PMS</a>
    </h2>
    <a href="../web/route.php?id=dashboradHome" class="text-white"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="../web/route.php?id=show_all_users" class="text-white"><i class="fas fa-users"></i> Users</a>
    <a href="../web/route.php?id=show_all_goals" class="text-white"><i class="fas fa-cogs"></i> Goals</a>
    <a href="../web/route.php?id=show_all_products" class="text-white"><i class="fas fa-cogs"></i> Poducts</a>
    <a href="../web/route.php?id=show_all_contacts" class="text-white"><i class="fas fa-cogs"></i> Contacts</a>
    <a href="../web/route.php?id=show_all_orders" class="text-white"><i class="fas fa-cogs"></i> Orders</a>
    

  </div>

  <!-- Main Content -->
  <div class="content">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <div class="d-flex">
        <a class="nav-link btn-primary" href="../logout.php">Logout</a>
        </div>
      </div>
    </nav>

    <!-- Dashboard Body -->
  


