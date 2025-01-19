<?php require_once ('inc/header.php'); ?>


 <?php 
    $cart=[];


 ?>
        <?php 
        if(isset($_SESSION['UserCreatedSuccess'])): ?>
            <div class="alert alert-success rounded-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="col-auto flex-shrink-1 flex-grow-1"><?= $_SESSION['UserCreatedSuccess'] ?></div>
                        <div class="col-auto">
                            <a href="#" onclick="$(this).closest('.alert').remove()" class="text-decoration-none text-reset fw-bolder mx-3">
                                <i class="fa-solid fa-times"></i>
                            </a>
                        </div>
                </div>
            </div>
        <?php endif;
        unset($_SESSION['UserCreatedSuccess']);    ?>
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
        unset($_SESSION['Success']);    ?>
        <?php 
        if(isset($_SESSION['Cart_Added'])): ?>
            <div class="alert alert-success rounded-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="col-auto flex-shrink-1 flex-grow-1"><?= $_SESSION['Cart_Added'] ?></div>
                        <div class="col-auto">
                            <a href="#" onclick="$(this).closest('.alert').remove()" class="text-decoration-none text-reset fw-bolder mx-3">
                                <i class="fa-solid fa-times"></i>
                            </a>
                        </div>
                </div>
            </div>
        <?php endif;
        unset($_SESSION['Cart_Added']);    ?>
        <?php  
        if(!isset($_SESSION['Products'])){
            //$_GET["id"]= "getProducts";
            //echo"hi";
            header("location:web/route.php?id=getProducts");
        }

        ?>

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
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php foreach($_SESSION['Products'] as $product):?>
                        <div class="col mb-5">
                            <div class="card h-100">
                                <!-- Sale badge-->
                                <?php   if(isset($product->sale)): ?>
                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                                <?php endif;?>
                                <!-- Product image-->
                                <img class="card-img-top" style="height:200px;" src="<?php echo substr($product->image,3) ?>" alt="..." />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?= $product->name ?></h5>
                                        <!-- Product price-->
                                        <?php   if(isset($product->sale)): ?>
                                        <span class="text-muted text-decoration-line-through"><?= $product->sale_price ?></span>
                                        <?php elseif(isset($product->sale_price)):?>
                                            <?= $product->sale_price ?> - 
                                        <?php endif;?>
                                        <?= $product->basic_price ?>
                                        
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center">
                                        <a class="btn btn-outline-dark mt-auto" href="Controller/CartController.php?id=<?= $product->id ?>&type=add_to_cart">
                                            Add to cart
                                        </a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    <?php endforeach;?>
                    
                </div>
            </div>
        </section>
<?php require_once ('inc/footer.php'); ?>