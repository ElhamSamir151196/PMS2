<?php  
include 'incs/dashboardSidebar.php';
?>

<div class="container mt-5 mb-5">
        <h2 class="border p-2 my-2 text-center">Show Order</h2>
        
        <!-- Handling Messages Form Session -->
        <?php if(isset($_SESSION['msg_success']) || isset($_SESSION['msg_error'])): ?>
                        <?php if(isset($_SESSION['msg_success'])): ?>
                            <div class="alert alert-success rounded-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="col-auto flex-shrink-1 flex-grow-1"><?= $_SESSION['msg_success'] ?></div>
                                    <div class="col-auto">
                                        <a href="#" onclick="$(this).closest('.alert').remove()" class="text-decoration-none text-reset fw-bolder mx-3">
                                            <i class="fa-solid fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php unset($_SESSION['msg_success']); ?>
                        <?php endif; ?>
                        <?php if(isset($_SESSION['msg_error'])): ?>
                            <div class="alert alert-danger rounded-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="col-auto flex-shrink-1 flex-grow-1"><?= $_SESSION['msg_error'] ?></div>
                                    <div class="col-auto">
                                        <a href="#" onclick="$(this).closest('.alert').remove()" class="text-decoration-none text-reset fw-bolder mx-3">
                                            <i class="fa-solid fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php unset($_SESSION['msg_error']); ?>
                        <?php endif; ?>
        <?php endif; ?>
                   
        <?php if(isset($_SESSION['errors'])):
                foreach($_SESSION['errors'] as $error): ?>
                <div class="alert alert-danger text-center">
                    <?php echo   $error;?>
                </div>
                <?php endforeach;
           
            unset($_SESSION['errors']); ?>   
        <?php endif;?>
        <!--END of Handling Messages Form Session -->
        <?php if(isset($_SESSION['Order'])):
            $Order=$_SESSION['Order'];?>
            <table class="table table-striped-columns">
                <thead>
                    <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">(<?php echo $Order->id;  ?>)</th>
                   
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">Name</th>
                    <td><?php echo $Order->name;  ?></td>
                    </tr>
                    <tr>
                    <th scope="row">E-mail</th>
                    <td><?php echo $Order->email;  ?></td>
                    </tr>
                    <tr>
                    <th scope="row">Address</th>
                    <td><?php echo $Order->address;  ?></td>
                    </tr>
                    <th scope="row">Phone</th>
                    <td><?php echo $Order->phone;  ?></td>
                    </tr>
                    <th scope="row">Notes</th>
                    <td><?php echo $Order->notes;  ?></td>
                    </tr>
                    <th scope="row">Order Total Price</th>
                    <td><?php echo $Order->total_price;  ?></td>
                    </tr>
                    <th scope="row">Creation Time</th>
                    <td><?php echo $Order->creation_date;  ?></td>
                    </tr>
                    <th scope="row">Deliver Time</th>
                    <?php if(!empty($Order->deliver_date)): ?>
                        <td><?php echo $Order->deliver_date;  ?></td>
                    <?php else: ?>
                        <td>not delivered yet</td>
                    <?php endif; ?>
                    </tr>
                    <th scope="row">Deliver</th>
                    <td><?php echo $Order->deliver;  ?></td>
                    </tr>
                    
                    <th scope="row">Order Owner</th>
                    <?php if(isset($_SESSION['Order_User']->name)):?>
                       
                        <td><?php echo $_SESSION['Order_User']->name;  ?> (<?php echo $_SESSION['Order_User']->id;  ?>)</td>
                    <?php else: ?> <!-- if user deleted from system -->
                        <td><?php echo $Order->user_id;  ?> (but not exist user now)</td>
                    <?php endif;  ?>
                    </tr>
                    
                </tbody>

            </table>
            <div class="card-body">
        <table class="table table-striped table-bordered">
            <h3>Order Products</h3>
          <thead>
            <tr>
                <th class="text-center">Product ID</th>
                <th class="text-center">Product Name</th>
                <th class="text-center">Product Price</th>
                <th class="text-center">Product Quantity</th>
                

            </tr>
          </thead>
          <tbody>
            
            <?php if(isset($_SESSION['Order']->Products)) :?>
                <?php foreach($_SESSION['Order']->Products as $data): ?>
                    <tr>
                        <td class="text-center"><?= $data->product_id ?></td>
                        <td class="text-center"><?= $data->product_name ?></td>
                        <td class="text-center"><?= $data->product_price ?></td>
                        <td class="text-center"><?= $data->qty ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif;?>
          </tbody>
        </table>
      </div>
            
        <?php endif;?>
    </div>

  
<?php  
include 'incs/dashboardFooter.php';
?>