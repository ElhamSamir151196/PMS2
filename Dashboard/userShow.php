<?php  
include 'incs/dashboardSidebar.php';
?>

<div class="container mt-5 mb-5">
        <h2 class="border p-2 my-2 text-center">Show User</h2>
        
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
        <!--END of Handling Messages Form Session -->

        <?php if(isset($_SESSION['User'])):
            $User=$_SESSION['User'];?>
            <table class="table table-striped-columns">
                <thead>
                    <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">(<?php echo $User->id;  ?>)</th>
                   
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">Name</th>
                    <td><?php echo $User->name;  ?></td>
                    </tr>
                    <tr>
                    <th scope="row">E-mail</th>
                    <td><?php echo $User->email;  ?></td>
                    </tr>
                    <tr>
                    <th scope="row">Age</th>
                    <td><?php echo $User->age  ?></td>
                    </tr>
                    <th scope="row">Gender</th>
                    <td><?php echo $User->gender;  ?></td>
                    </tr>
                    
                    </tr>
                    <th scope="row">Type</th>
                    <td><?php echo $User->type;  ?></td>
                    </tr>
                    
                </tbody>

            </table>
           
            
        <?php endif;?>
        
    </div>

  
<?php  
include 'incs/dashboardFooter.php';
?>