<?php
require_once('../Handlers/fileHandling.php');

//add Order
function addOrder($filePath, $newOrder){
    $Orders = getFileContent($filePath);
    $id = array_key_last($Orders) + 1;
    if(count($Orders)==0){ $id=0;}
    $OrderID['id']=$id;
    $newOrder= $OrderID+ $newOrder;
    $Orders[]=$newOrder;
    PutFileContents($filePath, $Orders);
    return true;
}

// list Order
function listorders($filePath)  {
    $Orders =  getFileContent($filePath);
    return $Orders;
    
}

// get Order
function getOrder($filePath,$id)  {
    $Orders =  getFileContent($filePath);
    foreach($Orders as $Order){
        if($Order->id == $id){
            return $Order;
        }
    }
    return [];
    
}

// change deliver from wait to done means order delivered to customer(only admin can do this)
function update_Order($filePath,$id){
    $Orders =  getFileContent($filePath);
    
    foreach($Orders as $Order){
        if($Order->id == $id){
            $Order->deliver="done";
            $Order->deliver_date=date("Y-m-d H:i:s");

            break;
        }
    }
    //var_dump($Orders);
    //die;
    PutFileContents($filePath, $Orders);
    return "Orders deliverd Sucessfully";

}


function delete_Order($filePath,$id){
    $Orders =  getFileContent($filePath);
   
    $new_Orders=[];
    foreach($Orders as $Order){
        if($Order->id != $id){$new_Orders[]=$Order;}
    }
    PutFileContents($filePath, $new_Orders);
    return "Order Deleted Sucessfully";
}

?>