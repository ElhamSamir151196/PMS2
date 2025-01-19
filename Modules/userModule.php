<?php

require_once('../Handlers/fileHandling.php');
$file='../Storage/users.json';

//add User
function addUser($filePath, $newUser){
    $Users = getFileContent($filePath);
    $id = array_key_last($Users) + 1;
    if(count($Users)==0){ $id=0;}
    //array_unshift($newUser,$id);
    $userID['id']=$id;
    $newUser= $userID+ $newUser;
    $Users[]=$newUser;
    PutFileContents($filePath, $Users);
    return  $newUser;//"Account Created Sucessfully"
}

// list Users
function listUsers($filePath)  {
    $Users =  getFileContent($filePath);
    return $Users;
    
}


function notExistEmail($filePath , $email){
    $Users = getFileContent($filePath);
    foreach($Users as $user){
        //echo " email = $email , user['email'] = ". $user->email."<br>";
        if($email == $user->email){
            return false;
        } 
    }

    return true;
}

function LoginCheck($filePath , $email , $password){
    $Users = getFileContent($filePath);
    foreach($Users as $user){
        echo " email = $email , user['email'] = ". $user->email."<br>";
        echo " check password = ".password_hash( $password,null)."<br>";
        echo " user password ". $user->password."<br>";
        if($email == $user->email && password_verify( $password, $user->password )){
            return true;
        } 
    }

    
    return false;
}

function GetUser($filePath , $email){
    $Users = getFileContent($filePath);
    foreach($Users as $user){
        if($email == $user->email ){
            return $user;
        } 
    }

    return false;
}

function get_User($filePath , $id){
    $Users = getFileContent($filePath);
    foreach($Users as $user){
        if($id == $user->id ){
            return $user;
        } 
    }

    return [];
}

//delete User
function delete_User($filePath,$id){
    $Users =  getFileContent($filePath);
   
    $new_Users=[];
    foreach($Users as $User){
        if($User->id != $id){$new_Users[]=$User;}
    }
    PutFileContents($filePath, $new_Users);
    return "User Deleted Sucessfully";
}

// change user type (only admin can do this)
function update_User_type($filePath,$id){
    $Users =  getFileContent($filePath);
    
    foreach($Users as $User){
        if($User->id == $id){
            $User->type="admin";
            PutFileContents($filePath, $Users);
            return $User;            
        }
    }

    
    return [];

}



?>
