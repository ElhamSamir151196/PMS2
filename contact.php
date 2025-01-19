<?php require_once('inc/header.php'); ?>

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-8 mx-auto">
            <?php 
                if(isset($_SESSION['Success'])): ?>
                    <div class="alert alert-success rounded-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="col-auto flex-shrink-1 flex-grow-1"><?= $_SESSION['Success'] ?></div>
                                <div class="col-auto">
                                    <a href="#" onclick="$(this).closest('.alert').remove()" class="text-decoration-none text-reset fw-bolder mx-3">
                                        <i class="fa-solid fa-times"></i>
                                    </a>
                                </div>
                        </div>
                    </div>
            <?php endif;
                unset($_SESSION['Success']);    
            ?>
            <?php 
            if(isset($_SESSION['failed'])):?>
                
                <div class="alert alert-danger text-center">
                    <?php echo   $_SESSION['failed'];?>
                </div>
                
            <?php endif;
            unset($_SESSION['failed']);    ?>
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
                <form method="post" action="Controller/ContactController.php" class="form border my-2 p-3">
                    <input type="hidden" value="add" name="action" id="action">
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Message</label>
                            <textarea name="message" id="message" class="form-control" rows="7"></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Send" id="" class="btn btn-success">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php require_once('inc/footer.php'); ?>