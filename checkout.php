<?php require_once('inc/header.php'); ?>

<?php 
// user must login to check out
if(!isset($_SESSION['auth'])){
    header("location:login.php");
    die;
};

?>

<?php  
        if(!isset($_SESSION['Products'])){
            header("location:web/route.php?id=getProducts");
        }else{
            $Products=$_SESSION['Products'];
        }
        if(!isset($_SESSION['cart_products'])){
            $_SESSION['cart_products']=[];
            //header("location:web/route.php?id=getCartProducts");
        }
        $sum=0;
        //array_pop($_SESSION['cart_products']);
        /*echo "<pre>";
                        var_dump($_SESSION['cart_products']);
                        echo "</pre>";
                        die;*/

?>
    
<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Checkout</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-4">
                <div class="border p-2">
                    <div class="products">
                        <ul class="list-unstyled">
                        <?php  foreach($_SESSION['cart_products'] as $index=>$product): ?>
                            <li class="border p-2 my-1">
                                
                                <?php  foreach($_SESSION['Products'] as $product_item): ?>
                                    <?php if($product_item->id ==  $product['id'] ):?>
                                        <?php echo $product_item->name ;?> (<?php echo $product['id'];?>)- 
                                        <span class="text-success mx-2 mr-auto bold">
                                        <?php  $sum+=($product_item->basic_price*$product['Quantity']) ;?>
                                        <?php echo $product['Quantity'];?>x<?php echo $product_item->basic_price ;?>$</span>
                                    <?php endif ?>
                                <?php endforeach?>
                            </li>
                        <?php endforeach?>
                            
                        </ul>
                    </div>
                    <h3>Total : <?php echo $sum;?> $</h3>
                </div>
            </div>
            <div class="col-8">
                <?php 
        if(isset($_SESSION['errorMethod'])):?>
            
            <div class="alert alert-danger text-center">
                <?php echo   $_SESSION['errorMethod'];?>
            </div>
            
        <?php endif;
        unset($_SESSION['errorMethod']);    ?>
        <?php 
        if(isset($_SESSION['failed'])):?>
            
            <div class="alert alert-danger text-center">
                <?php echo   $_SESSION['failed'];?>
            </div>
            
        <?php endif;
        unset($_SESSION['failed']);    ?>
        <?php 
        if(isset($_SESSION['errors'])):
            foreach($_SESSION['errors'] as $error): ?>
            <div class="alert alert-danger text-center">
                <?php echo   $error;?>
            </div>
            <?php endforeach;
        endif;
        unset($_SESSION['errors']);    
    ?>

                <form method="post" action="Controller/OrderController.php" class="form border my-2 p-3">
                    <input type="hidden" name="action" id="action" value="add">
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
                            <label for="">Address</label>
                            <input type="text" name="address" id="address" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Phone</label>
                            <input type="number" name="phone" id="phone" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Notes(optional)</label>
                            <input type="text" name="notes" id="notes" class="form-control">
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