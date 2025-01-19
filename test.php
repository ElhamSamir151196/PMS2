<?php require_once ('inc/header.php'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
 

<div class="alert alert-success rounded-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="col-auto flex-shrink-1 flex-grow-1">Hello</div>
                        <div class="col-auto">
                            <a href="#" onclick="$(this).closest('.alert').remove()" class="text-decoration-none text-reset fw-bolder mx-3">
                                <i class="fa-solid fa-times"></i>
                            </a>
                        </div>
                </div>
            </div>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--<table>
        <tr>
            <th>Name</th>
            <th>E-mail</th>
            <th>Password</th>
        </tr>
<?php $emps= listusers($file)  ?>
        <?php foreach($emps as $emp):?>
            <tr>
                <td> <?php  echo $emp->name ?></td>
                <td> <?php  echo $emp->email ?></td>
                <td> <?php  echo $emp->password ?></td>
            </tr>
        <?php endforeach?>
    </table>-->
</body>
</html>