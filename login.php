<?php require_once ('inc/header.php'); ?>
<?php 
if(isset($_SESSION['auth'])){
    header("location:index.php");
    die;
};

?>

<div class="container mt-5 mb-5">
        <h2>Login</h2>
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
        <?php  if(isset($_SESSION['LoginError'])):?>   
        <div class="alert alert-danger text-center"> <?php echo   $_SESSION['LoginError'];?></div>
        <?php  endif;
        unset($_SESSION['LoginError']); ?>
        <form method="post" action="Controller/LoginController.php" class="border p-3">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="text" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" >
            </div>
           
            <button type="submit" class="btn btn-primary">Login</button>
            
        </form>
    </div>



<?php require_once ('inc/footer.php'); ?>