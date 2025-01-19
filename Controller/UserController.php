<?php
session_start();
require_once( '../Handlers/Validation.php');
require_once( '../Modules/userModule.php');
$file='../Storage/users.json';

if(checkRequestMethod("POST")){
     
    $action = $_POST['action']??null;

    if($action = "update" && isset($_POST['id'])){
        updateUser($file, $_POST['id']);
    }
   
}else{
    
    $operaation_type = $_GET['type'];
    $id=$_GET['id'];
    if($operaation_type=="edit" && isset($_GET['id'])){
        editUser($file,$id);
    }elseif($operaation_type=="delete"  && isset($_GET['id'])){
        deleteUser($file,$id);
    }elseif($operaation_type=="show" && isset($_GET['id'])){
        showUser($file,$id);
    }else{
        $_SESSION['errorMethod'] =  "not supported Method";
    redirection("../Dashboard/userIndex.php");
    die;
    }
   
}

function deleteUser($file,$id){
    $_SESSION['msg_error']=delete_User($file,$id);
    $_SESSION['Users']=listUsers($file);
    redirection("../Dashboard/userIndex.php");//redirect user
    die;
   
}

function editUser($file,$id){
    $User=get_User($file,$id);
    if(isset($User)){
        $_SESSION['User']=(object)$User;
        redirection("../Dashboard/UserEdit.php");//redirect user
        die;
    }else{
        $_SESSION['Users']=listProducts($file);
        redirection("../Dashboard/userIndex.php");//redirect user
        die;
    }
}

function updateUser($file,$id){

    foreach($_POST as $key => $value){
        $$key=sanitizeInput($value);
    }

    
    if($type =="admin"){
            $User=update_User_type($file,$id);
           
            if(isset($User)){
                $_SESSION['msg_success']= "User $id become admin now";
                $_SESSION['Users']=listUsers($file);
                redirection("../Dashboard/userIndex.php");
                die;
            }else{
                editUser($file,$id);
            }
            
    }else{
       
        editUser($file,$id);
    }
    
}

function showUser($file,$id){
    $User=get_User($file,$id);
    if(isset($User)){
        $_SESSION['User']=(object)$User;
        redirection("../Dashboard/userShow.php");//redirect user
        die;
    }else{
        $_SESSION['Users']=listUsers($file);
        redirection("../Dashboard/userIndex.php");//redirect user
        die;
    }
}
?>
