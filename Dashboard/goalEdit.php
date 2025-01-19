<?php  
include 'incs/dashboardSidebar.php';
?>

<div class="container mt-5 mb-5">
    <h2 class="border p-2 my-2 text-center">Edit Goal</h2>
        
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
        endif; unset($_SESSION['errors']);    
    ?>
    <!--END of Handling Messages Form Session -->


        <?php if(isset($_SESSION['Goal'])):
            $Goal=$_SESSION['Goal'];?>
            <form method="post" action="../Controller/GoalController.php" class="border p-3" >
                <input type="hidden" value="update" name="action">
                <input type="hidden" value="<?php  echo $Goal->id?>" name="id">
                <div class="mb-3">
                    <label for="">Goal Message</label>
                    <textarea name="message" id="message" class="form-control" rows="7"><?php  echo $Goal->message?></textarea>
                </div>
                <button type="submit" class="btn btn-primary ">Save</button>
            </form>
        <?php endif;?>
    </div>

  
<?php  
include 'incs/dashboardFooter.php';
?>