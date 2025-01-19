<?php  
include 'incs/dashboardSidebar.php';
?>
    <?php  
        if(!isset($_SESSION['Orders'])){
            header("location:web/route.php?id=getOrders");
        }
    ?>
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
                    
    <!-- Table -->
    <h2 class="text-center">Orders</h2>
    <div class="card mt-4">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="card-title col-auto flex-shrink-1 flex-grow-1"><h5>Orders List</h5></div>
                
            </div>
        </div>
      <div class="card-body">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Name</th>
                <th class="text-center">E-mail</th>
                <th class="text-center">Products count</th>
                <th class="text-center">total price</th>
                <th class="text-center">Creation Date</th>
                <th class="text-center">deliver</th>
                <th class="text-center">Action</th>

            </tr>
          </thead>
          <tbody>
            
            <?php if(isset($_SESSION['Orders'])) :?>
                <?php foreach($_SESSION['Orders'] as $data): ?>
                    <tr>
                        <td class="text-center"><?= $data->id ?></td>
                        <td class="text-center"><?= $data->name ?></td>
                        <td class="text-center"><?= $data->email ?></td>
                        <td class="text-center"><?= count($data->Products); ?></td>
                        <td class="text-center"><?= $data->total_price ?></td>
                        <td class="text-center"><?= $data->creation_date ?></td>
                        <td class="text-center"><?= $data->deliver ?></td>
                        <td class="text-center">
                            <a href="../Controller/OrderController.php?type=show&id=<?= $data->id ?>" class="btn btn-sm btn-outline-info rounded-0">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                            <a href="../Controller/OrderController.php?type=edit&id=<?= $data->id ?>" class="btn btn-sm btn-outline-info rounded-0">
                                <i class="fa-solid fa-edit"></i>
                            </a>
                            <a href="../Controller/OrderController.php?type=delete&id=<?= $data->id ?>" class="btn btn-sm btn-outline-danger rounded-0" onclick="if(confirm(`Are you sure to delete <?= $data->name ?> details?`) === false) event.preventDefault();">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif;?>
          </tbody>
        </table>
      </div>
    </div>

    
<?php  
include 'incs/dashboardFooter.php';
?>
  