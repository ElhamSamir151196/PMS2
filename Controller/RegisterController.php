<?php
session_start();
require_once( '../Handlers/Validation.php');
require_once( '../Modules/userModule.php');
$file='../Storage/users.json';
$errors= [];

if(checkRequestMethod("POST") && checkPostInput('name')){
    
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
    }elseif(!notExistEmail($file,$email)){
        $errors[]= "please type other email , this email already exist";
    }
//die;
    // validation age => required, number 
    if(!requireVal($age)){
        $errors[]= "Age is required";
    }elseif(!is_numeric($age)){
        $errors[]= "Age must be number";
    }

     // validation gender => required
     if(!requireVal($gender)){
        $errors[]= "Gender is required";
    }

    // validation password => required, min: 6,max:25 
    if(!requireVal($password)){
        $errors[]= "password is required";
    }elseif(!minVal($password, 6)){
        $errors[]= "password must be greater than 6 chars";
    }elseif(!maxVal($password, 20)){
        $errors[]=  "password must be less than 25 chars";
    }


    if(empty($errors)){
        $type = "user";
        $data = [
            "name" => $name,
            "email" =>$email,
            "password" => password_hash( $password,null),
            "gender" =>$gender ,
            "age" => $age ,
            "type" => $type ];
        $_SESSION['UserCreatedSuccess']="Account Created Sucessfully";
        //echo addUser($file,$data);
        //redirect user
        $_SESSION['auth']=(object)addUser($file,$data);;
        redirection("../index.php");
       // redirection("../test.php");
        die;
    }else{
        $_SESSION['errors']=$errors;
        redirection("../register.php");
        die;
    }
}else{
    $_SESSION['errorMethod'] =  "not supported Method";
    redirection("../register.php");
    die;
}




?>