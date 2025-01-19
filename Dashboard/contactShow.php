<?php  
include 'incs/dashboardSidebar.php';
?>

<div class="container mt-5 mb-5">
        <h2 class="border p-2 my-2 text-center">Contact</h2>
        
        <?php if(isset($_SESSION['Contact'])):
            $Contact=$_SESSION['Contact'];?>
            <table class="table table-striped-columns">
                <thead>
                    <tr>
                    <th scope="col">Contact ID</th>
                    <th scope="col">(<?php echo $Contact->id;  ?>)</th>
                   
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">Name</th>
                    <td><?php echo $Contact->name;  ?></td>
                    </tr>
                    <tr>
                    <th scope="row">E-mail</th>
                    <td><?php echo $Contact->email;  ?></td>
                    </tr>
                    <tr>
                    <th scope="row">Message</th>
                    <td><?php echo $Contact->message;  ?></td>
                    </tr>
                </tbody>

            </table>
        <?php endif;?>
    </div>

  
<?php  
include 'incs/dashboardFooter.php';
?>