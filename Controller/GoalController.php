<?php
session_start();
require_once( '../Handlers/Validation.php');
require_once( '../Modules/GoalModule.php');
$file='../Storage/goals.json';
$errors= [];

if(checkRequestMethod("POST") ){
    $action = $_POST['action']??null;
    if($action=="add"){
        
        insertGoal($file);
    }elseif($action=="update"){
        updateGoal($file);
    }
       
}else{
    
    $operaation_type = $_GET['type'];
    $id=$_GET['id'];
    if($operaation_type=="edit"){
        editGoal($file,$id);
    }elseif($operaation_type=="delete"){
        deleteGoal($file,$id);
    }else{
         $_SESSION['msg_error'] =  "not supported Method";
         redirection("../Dashboard/goalsIndex.php");
         die;
    }
   
}

function insertGoal($file){

    // get Goal data =>  message
    foreach($_POST as $key => $value){
        $$key=sanitizeInput($value);
       
    }

    // validation message => required, min: 3,max:500 
    if(!requireVal($message)){
        $errors[]= "message is required";
    }elseif(!minVal($message, 3)){
        $errors[]= "message must be greater than 3 chars";
    }elseif(!maxVal($message, 500)){
        $errors[]=  "message must be less than 500 chars";
    }

    if(empty($errors)){
      
        // message
        $data = [ "message" => $message ];
            $confirmation=addGoal($file,$data);
            if($confirmation){
                $_SESSION['msg_success']="Goal Created Successfully";
                $_SESSION['Goals']=listgoals($file);
                redirection("../Dashboard/goalsIndex.php");
                die;
            }else{
                $_SESSION['msg_error']="Contact doesn't send Successfully";
                redirection("../Dashboard/goalCreate.php");
                die;
            }
    }else{
        $_SESSION['errors']=$errors;
        redirection("../Dashboard/goalCreate.php");
        die;
    }


}

function deleteGoal($file,$id){
    $_SESSION['msg_error']=delete_Goal($file,$id);
    $_SESSION['Goals']=listGoals($file);
    redirection("../Dashboard/goalsIndex.php");//redirect user
    die;
   
}


//show item to edit
function editGoal($file,$id){
    $Goal=getGoal($file,$id);
    if(isset($Goal)){
        $_SESSION['Goal']=(object)$Goal;
        redirection("../Dashboard/goalEdit.php");//redirect user
        die;
    }else{
        $_SESSION['Goals']=listGoals($file);
        redirection("../Dashboard/goalsIndex.php");//redirect user
        die;
    }
}

//update Goal details in file
function updateGoal($file){

    if(isset($_POST['id'])){
        echo $_POST['id'];
    }

    // Goal => message
    foreach($_POST as $key => $value){
        $$key=sanitizeInput($value);
    
    }

    // validation message => required, min: 3,max:500 
    if(!requireVal($message)){
        $errors[]= "message is required";
    }elseif(!minVal($message, 3)){
        $errors[]= "message must be greater than 3 chars";
    }elseif(!maxVal($message, 500)){
        $errors[]=  "message must be less than 500 chars";
    }


    // message
    if(empty($errors)){
        
        $data = ["message" => $message];
        $_SESSION['msg_success']=update_Goal($file,$data,$id);
        $_SESSION['Goals']=listGoals($file);
        redirection("../Dashboard/goalsIndex.php");
        die;
    }else{
        $_SESSION['errors']=$errors;
        editGoal($file,$id);
    }
}

?>
