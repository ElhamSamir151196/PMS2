<?php  
        
        if(!isset($_SESSION['cart_products'])){
            $_SESSION['cart_products']=[];
            //header("location:web/route.php?id=getCartProducts");
        }

?>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">EraaSoft PMS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    </ul>
                    <form class="d-flex" action="cart.php">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill"><?php  echo count($_SESSION['cart_products']); ?></span>
                        </button>
                    </form>
                    <?php if(!isset($_SESSION['auth'])):?>
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="register.php"><span class="fas fa-user"></span> Sign Up</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php"><span class="fas fa-sign-in-alt"></span> Login</a>
                            </li>
                        </ul>
                    <?php else:?>
                        <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                            <?php if($_SESSION['auth']->type == "admin"):?>
                                <li class="nav-item">
                                    <a class="nav-link" href="web/route.php?id=dashboradHome">Dashboard</a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="fas fa-user"></span> <?php echo $_SESSION['auth']->name; ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </nav>