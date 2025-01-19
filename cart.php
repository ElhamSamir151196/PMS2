<?php require_once('inc/header.php'); ?>

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
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  foreach($_SESSION['cart_products'] as $index=>$product): ?>
                        <tr>
                            <th scope="row"><?php echo $product['id'];?></th>
                            <?php  foreach($_SESSION['Products'] as $product_item): ?>
                                <?php if($product_item->id ==  $product['id'] ):?>
                                    <td><?php echo $product_item->name ;?></td>
                                    <td><?php echo $product_item->basic_price ;?></td>
                                    <td>
                                        <input type="number" value="<?php echo $product['Quantity'];?>">
                                    </td>
                                    <?php  $sum+=($product_item->basic_price*$product['Quantity']) ;?>
                                    <td> <?php echo ($product_item->basic_price*$product['Quantity']) ;?></td>
                                    <td>
                                        <a href="Controller/CartController.php?index=<?= $index ?>&type=delete" class="btn btn-danger">Delete</a>
                                    </td>
                                <?php endif ?>
                            <?php endforeach?>
                        </tr>
                    <?php endforeach?>
                    <tr>
                            <td colspan="2">
                                Tatal Price
                            </td>
                            <td colspan="3">
                                <h3><?php echo $sum; ?> $</h3>
                            </td>
                            <td>
                                <a href="checkout.php" class="btn btn-primary">Checkout</a>
                            </td>
                        </tr>
                </table>
            </div>
        </div>
    </div>
</section>
<?php require_once('inc/footer.php'); ?>