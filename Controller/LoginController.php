<?php
session_start();
require_once( '../Handlers/Validation.php');
require_once( '../Modules/userModule.php');
$file='../Storage/users.json';
$errors= [];

if(checkRequestMethod("POST") ){
    
    foreach($_POST as $key => $value){
        $$key=sanitizeInput($value);
       
    }

    // validation e-mail => required, email , not-exist
    if(!requireVal($email)){
        $errors[]= "email is required";
    }elseif(!emailVal($email)){
        $errors[]= "please type a vaild email";
    }elseif(notExistEmail($file,$email)){
        $errors[]= " email not exist exist";
    }

    // validation password => required, min: 6,max:25 
    if(!requireVal($password)){
        $errors[]= "password is required";
    }


    if(empty($errors)){
       
        
        if(LoginCheck($file,$email , $password)){

            $_SESSION['auth']=GetUser($file,$email );
            //redirect user
            redirection("../index.php");
            die;
        }else{
            $_SESSION['LoginError']="Wrong username or Password";
            //redirect user
            redirection("../login.php");
            die;
        }
        
       
    }else{
        $_SESSION['errors']=$errors;
        //redirect user
        redirection("../login.php");
        die;
    }
}else{
    $_SESSION['errorMethod'] =  "not supported Method";
}




?>