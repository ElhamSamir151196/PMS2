<?php
session_start();
require_once( '../Handlers/Validation.php');
require_once( '../Modules/ProductModule.php');
$file='../Storage/products.json';
$errors= [];

if(checkRequestMethod("POST")){
     
     $action = $_POST['action']??null;

    switch($action ){
        case 'add' : 
            insertProduct($file);
            break;
        case 'update' :
            updateProduct($file);
            break;
        default:
            echo  "Wrong Inquire";
            break;
    }
   
}else{
    
    $operaation_type = explode(",",$_GET['id']);
    if($operaation_type[0]=="edit"){
        editProduct($file,$operaation_type[1]);
    }elseif($operaation_type[0]=="delete"){
        deleteProduct($file,$operaation_type[1]);
    }else{
        $_SESSION['errorMethod'] =  "not supported Method";
    redirection("../Dashboard/productCreate.php");
    die;
    }
   
}

function insertProduct($file){
    
   foreach($_POST as $key => $value){
        $$key=sanitizeInput($value);
    
    }

    // product => name , basic_price , sale_price , image

    // validation name => required, min: 3,max:25 
    if(!requireVal($name)){
        $errors[]= "name is required";
    }elseif(!minVal($name, 3)){
        $errors[]= "name must be greater than 3 chars";
    }elseif(!maxVal($name, 30)){
        $errors[]=  "name must be less than 30 chars";
    }


    // validation basic_price => required, number 
    if(!requireVal($basic_price)){
        $errors[]= "Price is required";
    }elseif($basic_price<=0){
        $errors[]= "Price must be number greater than zero";
    }elseif(!is_numeric($basic_price)){
        $errors[]= "Price must be number";
    }

    if(isset($sale)){
        //
        if(!requireVal($sale_price)){
            $errors[]= "as you activate sale check box must set sale price number";
        }elseif(!is_numeric($sale_price)){
            $errors[]= "Sale Price must be number";
        }elseif($sale_price<=$basic_price){
            $errors[]= "sale Price must be number greater than price";
        }
    }else{
        $sale=null;
        // validation sale_price => required, number 
        if(!requireVal($sale_price)){
            $sale_price=null;
        }elseif(!is_numeric($sale_price)){
            $errors[]= "Sale Price must be number";
        }elseif($sale_price<0){
            $errors[]= "Sale Price must be greater than zero";
        }
    }



    //validation image Exit if file uploaded
    if (isset($_FILES["image"])) {

        $image_file = $_FILES["image"];// Get reference to uploaded image

        // Exit if image file is zero bytes
        if (filesize($image_file["tmp_name"]) <= 0) {
            $errors[]='Uploaded file has no contents.';
        }else{
            // Exit if is not a valid image file
            $image_type = exif_imagetype($image_file["tmp_name"]);
            if (!$image_type) {
                $errors[]='Uploaded file is not an image.';
            }else{
                // Get file extension based on file type, to prepend a dot we pass true as the second parameter
                $image_extension = image_type_to_extension($image_type, true);

                // Create a unique image name
                $image_name = bin2hex(random_bytes(16)) . $image_extension;

                $path = '../Upload/'.$image_name;
                // Move the temp image file to the images directory
                // (Temp image location , New image location
                $result= move_uploaded_file( $image_file["tmp_name"],$path);

                if (!$result) {
                    $errors[]= 'failed to upload';
                }
            } 
        }

        


    }

    // name , basic_price , sale_price , image , sale
    if(empty($errors)){
        
        $data = [
            "name" => $name,
            "basic_price" =>$basic_price,
            "sale_price" => $sale_price,
            "image" =>$path ,
            "sale" => $sale];
        $_SESSION['ProductCreatedSuccess']=addProduct($file,$data);
        $_SESSION['Products']=listProducts($file);
        //var_dump($_SESSION['Products']);
        //die;
        //redirect user
        redirection("../Dashboard/productIndex.php");
        die;
    }else{
        $_SESSION['errors']=$errors;
        redirection("../Dashboard/productCreate.php");
        die;
    }
}

function deleteProduct($file,$id){
    $_SESSION['msg_error']=delete_Product($file,$id);
    $_SESSION['Products']=listProducts($file);
    redirection("../Dashboard/productIndex.php");//redirect user
    die;
   
}

function editProduct($file,$id){
    $product=getProduct($file,$id);
    if(isset($product)){
        $_SESSION['product']=(object)$product;
        redirection("../Dashboard/productEdit.php");//redirect user
        die;
    }else{
        $_SESSION['Products']=listProducts($file);
        redirection("../Dashboard/productIndex.php");//redirect user
        die;
    }
}

function updateProduct($file){

    if(isset($_POST['id'])){
        echo $_POST['id'];
    }

    foreach($_POST as $key => $value){
        $$key=sanitizeInput($value);
    
    }

    // product => name , basic_price , sale_price , image

    // validation name => required, min: 3,max:25 
    if(!requireVal($name)){
        $errors[]= "name is required";
    }elseif(!minVal($name, 3)){
        $errors[]= "name must be greater than 3 chars";
    }elseif(!maxVal($name, 30)){
        $errors[]=  "name must be less than 30 chars";
    }


    // validation basic_price => required, number 
    if(!requireVal($basic_price)){
        $errors[]= "Price is required";
    }elseif($basic_price<=0){
        $errors[]= "Price must be number greater than zero";
    }elseif(!is_numeric($basic_price)){
        $errors[]= "Price must be number";
    }

    if(isset($sale)){
        //
        if(!requireVal($sale_price)){
            $errors[]= "as you activate sale check box must set sale price number";
        }elseif(!is_numeric($sale_price)){
            $errors[]= "Sale Price must be number";
        }elseif($sale_price<=$basic_price){
            $errors[]= "sale Price must be number greater than price";
        }
    }else{
        $sale=null;
        // validation sale_price => required, number 
        if(!requireVal($sale_price)){
            $sale_price=null;
        }elseif(!is_numeric($sale_price)){
            $errors[]= "Sale Price must be number";
        }elseif($sale_price<0){
            $errors[]= "Sale Price must be greater than zero";
        }
    }



    //validation image Exit if file uploaded
    if (isset($_FILES["image"])) {

        $image_file = $_FILES["image"];// Get reference to uploaded image

        // Exit if image file is zero bytes
        if (filesize($image_file["tmp_name"]) <= 0) {
            //$errors[]='Uploaded file has no contents.'; //will take old image
            $path=null;
        }else{
            // Exit if is not a valid image file
            $image_type = exif_imagetype($image_file["tmp_name"]);
            if (!$image_type) {
                $errors[]='Uploaded file is not an image.';
            }else{
                // Get file extension based on file type, to prepend a dot we pass true as the second parameter
                $image_extension = image_type_to_extension($image_type, true);

                // Create a unique image name
                $image_name = bin2hex(random_bytes(16)) . $image_extension;

                $path = '../Upload/'.$image_name;
                // Move the temp image file to the images directory
                // (Temp image location , New image location
                $result= move_uploaded_file( $image_file["tmp_name"],$path);

                if (!$result) {
                    $errors[]= 'failed to upload';
                }
            } 
        }

        


    }

    // name , basic_price , sale_price , image , sale
    if(empty($errors)){
        
        $data = [
            "name" => $name,
            "basic_price" =>$basic_price,
            "sale_price" => $sale_price,
            "image" =>$path ,
            "sale" => $sale];
        $_SESSION['msg_success']=update_Product($file,$data,$id);
        $_SESSION['Products']=listProducts($file);
        //var_dump($_SESSION['Products']);
        //die;
        //redirect user
        redirection("../Dashboard/productIndex.php");
        die;
    }else{
        $_SESSION['errors']=$errors;
        editProduct($file,$id);
    }
}
?>
