<?php  
include 'incs/dashboardSidebar.php';
?>

<div class="container mt-5 mb-5">
        <h2 class="border p-2 my-2 text-center">Create Product</h2>
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
        <form method="post" action="../Controller/ProductController.php" class="border p-3" enctype="multipart/form-data">
            <input type="hidden" value="add" name="action">
            <div class="mb-3">
              <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" name="name" id="name" >
            </div>
            <div class="mb-3">
                <label for="basic_price" class="form-label">Price($)</label>
                <input type="number" class="form-control" name="basic_price" id="basic_price" >
            </div>            
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="sale" name="sale" id="sale" checked>
                <label class="form-check-label" for="sale">
                    Sale Activation
                </label>
            </div>
            <div class="mb-3">
                <label for="sale_price" class="form-label">Sale Price ($) (Optional)</label>
                <input type="number" class="form-control" name="sale_price" id="sale_price" >
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Choose Image</label>
                <input class="form-control" type="file" id="image" name="image" accept="image/*">
            </div>
           
            <button type="submit" class="btn btn-primary ">Save</button>
        </form>
    </div>

  
<?php  
include 'incs/dashboardFooter.php';
?>