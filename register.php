<?php require_once ('inc/header.php'); ?>

<?php 
if(isset($_SESSION['auth'])){
    header("location:index.php");
    die;
}

?>

<div class="container mt-5 mb-5">
        <h2 class="border p-2 my-2 text-center">Register</h2>
        <?php 
        if(isset($_SESSION['errorMethod'])):?>
            
            <div class="alert alert-danger text-center">
                <?php echo   $_SESSION['errorMethod'];?>
            </div>
            
        <?php endif;
        unset($_SESSION['errorMethod']);    ?>
        <?php 
        if(isset($_SESSION['errors'])):
            foreach($_SESSION['errors'] as $error): ?>
            <div class="alert alert-danger text-center">
                <?php echo   $error;?>
            </div>
            <?php endforeach;
        endif;
        unset($_SESSION['errors']);    ?>
        <form method="post" action="Controller/RegisterController.php" class="border p-3">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="name" id="name" >
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="text" class="form-control" name="email" id="email" >
            </div>            
           
            <label for="email" class="form-label">Gender:</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="flexRadioDisabled" value="male">
                <label class="form-check-label" for="flexRadioDisabled">
                    Male
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="flexRadioCheckedDisabled"  value="female" checked>
                <label class="form-check-label" for="flexRadioCheckedDisabled">
                    Female
                </label>
            </div>
            <div class="mb-3">
                <label for="Age" class="form-label">Age</label>
                <input type="number" class="form-control" name="age" id="age" >
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" >
            </div>
           
            <button type="submit" class="btn btn-primary ">Register</button>
        </form>
    </div>

<?php require_once ('inc/footer.php'); ?>