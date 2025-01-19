<?php
require_once('../Handlers/fileHandling.php');

//add Goal
function addGoal($filePath, $newGoal){
    $Goals = getFileContent($filePath);
    $id = array_key_last($Goals) + 1;
    if(count($Goals)==0){ $id=0;}
    $GoalID['id']=$id;
    $newGoal= $GoalID+ $newGoal;
    $Goals[]=$newGoal;
    PutFileContents($filePath, $Goals);
    return "Goal Added Sucessfully";
}

// list Goals
function listGoals($filePath)  {
    $Goals =  getFileContent($filePath);
    return $Goals;
    
}

// get Goal
function getGoal($filePath,$id)  {
    $Goals =  getFileContent($filePath);
    foreach($Goals as $Goal){
        if($Goal->id == $id){
            return $Goal;
        }
    }
    return [];
    
}


function update_Goal($filePath,$data,$id){
    $Goals =  getFileContent($filePath);
    
    foreach($Goals as $Goal){
        if($Goal->id == $id){
            $Goal->message=$data['message'];
        }

    }

    
    PutFileContents($filePath, $Goals);
    return "Goal Updated Sucessfully";
}

function delete_Goal($filePath,$id){
    $Goals =  getFileContent($filePath);
   
    $new_Goals=[];
    foreach($Goals as $Goal){
        if($Goal->id != $id){$new_Goals[]=$Goal;}
    }
    PutFileContents($filePath, $new_Goals);
    return "Goal Deleted Sucessfully";
}

?>