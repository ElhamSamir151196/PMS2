<?php  
include 'incs/dashboardSidebar.php';
?>

<?php
  if(!isset($_SESSION['Orders'])&& !isset($_SESSION['Users']) && !isset($_SESSION['Products'])){
    header("location:web/route.php?id=dashboradHome");
  }

?>

    <!-- Dashboard Cards -->
    <div class="row">
      <div class="col-md-4">
        <div class="card text-white bg-primary">
          <div class="card-body">
            <h5 class="card-title">Total Users</h5>
            <p class="card-text"><?php echo count($_SESSION['Users']);?></p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-white bg-success">
          <div class="card-body">
            <h5 class="card-title">Total Orders</h5>
            <p class="card-text"><?php echo count($_SESSION['Orders']);?></p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-white bg-warning">
          <div class="card-body">
            <h5 class="card-title">Total Products </h5>
            <p class="card-text"><?php echo count($_SESSION['Products']);?></p></p>
          </div>
        </div>
      </div>
    </div>

   
  
  <?php  
include 'incs/dashboardFooter.php';
?>
  

