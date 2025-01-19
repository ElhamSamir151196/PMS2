<?php
session_start();
require_once( '../Handlers/Validation.php');
require_once( '../Modules/userModule.php');
require_once( '../Modules/orderModule.php');
require_once( '../Modules/ProductModule.php');
$file_products='../Storage/products.json';
$file_user= '../Storage/users.json';
$file='../Storage/orders.json';
$errors= [];

if(checkRequestMethod("POST") ){
    $action = $_POST['action']??null;
    
    if($action=="add"){
        insertOrder($file , $file_products);
    }elseif($action=="update"){
        updateOrder($file);
    }
       
}else{
    
    $operaation_type = $_GET['type'];
    $id=$_GET['id'];
    if($operaation_type=="edit"){
        editOrder($file,$id);
    }elseif($operaation_type=="delete"){
        deleteOrder($file,$id);
    }elseif($operaation_type=="show"){
        showOrder($file,$id, $file_user);
    }else{
         $_SESSION['msg_error'] =  "not supported Method";
         redirection("../Dashboard/orderIndex.php");
         die;
    }
   
}

function insertOrder($file, $file_products){
    
    // Validation user
    if(!isset($_SESSION['auth']->id)){
        $_SESSION['errors'] =  "user must login";
        redirection("../cart.php");
        die;
    }

    // validation product cart exist
    if(!isset($_SESSION['cart_products'])){
        $_SESSION['errors'] =  "can't make empty order";
        redirection("../cart.php");
        die;
    }
     
    $Products=listProducts($file_products);
    // validation Products empty
    if(empty($_SESSION['Products'])){
        $_SESSION['errors'] =  "no products exist ";
        redirection("../index.php");
        die;
    }
     
    // get order data => name , email , address , phone , notes
    foreach($_POST as $key => $value){
        $$key=sanitizeInput($value);
       
    }

    
    /*echo("<pre>");
    print_r($_POST);
    echo("</pre>");
    die;*/

    
    // validation name => required, min: 3,max:25 
    if(!requireVal($name)){
        $errors[]= "name is required";
    }elseif(!minVal($name, 3)){
        $errors[]= "name must be greater than 3 chars";
    }elseif(!maxVal($name, 25)){
        $errors[]=  "name must be less than 25 chars";
    }

    
    // validation e-mail => required, email , not-exist
    if(!requireVal($email)){
        $errors[]= "email is required";
    }elseif(!emailVal($email)){
        $errors[]= "please type a vaild email";
    }


    // validation address => required, min: 3,max:150 
    if(!requireVal($address)){
        $errors[]= "address is required";
    }elseif(!minVal($address, 3)){
        $errors[]= "address must be greater than 3 chars";
    }elseif(!maxVal($address, 150)){
        $errors[]=  "address must be less than 150 chars";
    }
    

    // validation notes => optional, max:300 
    if(!isset($notes)){
       $notes=null;
    }elseif(!maxVal($notes, 150)){
        $errors[]=  "notes must be less than 300 chars";
    }
    
    // validation phone => required, format 
    if(!requireVal($phone)){
        $errors[]= "phone is required";
    }elseif(!preg_match('/^[0-9]{11}+$/', $phone)) {
        $errors[]=  "Invalid Phone Number";
    }

    //die;

    $sum=0;
    $Products_order=[];
    foreach($_SESSION['cart_products'] as $index=>$product){
        foreach($Products as $product_item){
            if($product_item->id ==  $product['id'] ){
                $Products_order[]=[
                    "product_id"=> $product_item->id  , 
                    "product_name"=> $product_item->name,
                    "product_price" => $product_item->basic_price, 
                    "qty"=> $product['Quantity']
                ];
                $sum+=($product_item->basic_price*$product['Quantity']) ;
            }
        }
    }

           

    if(empty($errors)){
      
        //name , email , address , phone , notes
        $data = [
            "user_id" =>  $_SESSION['auth']->id,
            "name" => $name,
            "email" =>$email,
            "address" => $address,
            "phone" =>$phone ,
            "notes" => $notes ,
            "total_price" => $sum ,
            "deliver" => "wait",
            "creation_date"=> date("Y-m-d H:i:s"),
            "deliver_date" =>"",
            "Products" => $Products_order ];
            $confirmation=addOrder($file,$data);
            if($confirmation){
                $_SESSION['cart_products']=[];
                $_SESSION['Success']="Order added Successfully";
                redirection("../index.php");
                die;
            }else{
                $_SESSION['failed']="Order has something wrong";
                redirection("../checkout.php");
                die;
            }
    }else{
        $_SESSION['errors']=$errors;
        redirection("../checkout.php");
        die;
    }
}


function deleteOrder($file,$id){
    $_SESSION['msg_error']=delete_Order($file,$id);
    $_SESSION['Orders']=listOrders($file);
    redirection("../Dashboard/orderIndex.php");//redirect user
    die;
   
}


//show item to edit
function editOrder($file,$id){
    $Order=getOrder($file,$id);
    if(isset($Order)){
        $_SESSION['Order']=(object)$Order;
        redirection("../Dashboard/orderEdit.php");//redirect user
        die;
    }else{
        $_SESSION['Orders']=listOrders($file);
        redirection("../Dashboard/orderIndex.php");//redirect user
        die;
    }
}

//show item 
function showOrder($file,$id, $file_user){
    $Order=getOrder($file,$id);
    
    if(isset($Order)){
        
        $user=get_User($file_user,$Order->user_id);
        $_SESSION['Order']=(object)$Order;
        $_SESSION['Order_User']=(object)$user;
        redirection("../Dashboard/ordershow.php");//redirect user
        die;
    }else{
        $_SESSION['Orders']=listOrders($file);
        redirection("../Dashboard/orderIndex.php");//redirect user
        die;
    }
}

//update Goal details in file
function updateOrder($file){


    $id= $_POST['id'];

    foreach($_POST as $key => $value){
        $$key=sanitizeInput($value);
    
    }

    
    if($delivery =="checked"){
       
            $_SESSION['msg_success']= update_Order($file,$id);
            $_SESSION['Orders']=listOrders($file);
            redirection("../Dashboard/OrderIndex.php");
            die;
    }else{
       
        editOrder($file,$id);
    }
    


   
    
}





?>