<?php
session_start();
require_once( '../Handlers/Validation.php');
require_once( '../Modules/ContactModule.php');
$file='../Storage/contacts.json';
$errors= [];

if(checkRequestMethod("POST") ){
    $action = $_POST['action']??null;
    if($action=="add"){
        insertContact($file);
    }
}else{
    
    $operaation_type = $_GET['type'];//explode(",",$_GET['id']);
    $id=$_GET['id'];
    if($operaation_type=="show"){
        showContact($file,$id);
    }elseif($operaation_type=="delete"){
        deleteContact($file,$id);
    }else{
         $_SESSION['msg_error'] =  "not supported Method";
         redirection("../Dashboard/contactIndex.php");
         die;
    }
   
}

function insertContact($file){

    // get contact data => name , email , message
    foreach($_POST as $key => $value){
        $$key=sanitizeInput($value);
       
    }

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


    // validation message => required, min: 3,max:300 
    if(!requireVal($message)){
        $errors[]= "message is required";
    }elseif(!minVal($message, 3)){
        $errors[]= "message must be greater than 3 chars";
    }elseif(!maxVal($message, 300)){
        $errors[]=  "message must be less than 300 chars";
    }

           

    if(empty($errors)){
      
        //name , email , message
        $data = [
            "name" => $name,
            "email" =>$email,
            "message" => $message,
            "statues" => "NotReaded" ];
            $confirmation=addContact($file,$data);
            if($confirmation){
                $_SESSION['Success']="Contact send Successfully";
                redirection("../contact.php");
                die;
            }else{
                $_SESSION['failed']="Contact doesn't send Successfully";
                redirection("../contact.php");
                die;
            }
    }else{
        $_SESSION['errors']=$errors;
        redirection("../contact.php");
        die;
    }


}



function deleteContact($file,$id){
    $_SESSION['msg_error']=delete_Contact($file,$id);
    $_SESSION['Contacts']=listContacts($file);
    redirection("../Dashboard/contactIndex.php");//redirect user
    die;
   
}

function showContact($file,$id){
    $Contact=show_Contact($file,$id);
    if(isset($Contact)){
        $_SESSION['Contact']=(object)$Contact;
        redirection("../Dashboard/contactShow.php");//redirect user
        die;
    }else{
        $_SESSION['Contacts']=listContacts($file);
        redirection("../Dashboard/ContactIndex.php");//redirect user
        die;
    }
}


?>