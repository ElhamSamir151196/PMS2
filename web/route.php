<?php
session_start();
require_once( '../Handlers/Validation.php');
require_once("../Modules/productModule.php");
require_once( '../Modules/ContactModule.php');
require_once( '../Modules/UserModule.php');
require_once( '../Modules/OrderModule.php');
require_once( '../Modules/GoalModule.php');

$file_contact='../Storage/contacts.json';
$file_product='../Storage/products.json';
$file_goal='../Storage/goals.json';
$file_user='../Storage/users.json';
$file_order='../Storage/orders.json';


if(checkRequestMethod("GET")){
    //var_dump($_GET);
    if(isset($_GET["id"])){
        $id= $_GET["id"];
        if($id == "show_all_products"){
            $_SESSION['Products']=listProducts($file_product);
            redirection("../Dashboard/productIndex.php");
            die;
        }elseif($id == "getProducts"){
            $_SESSION['Products']=listProducts($file_product);
            redirection("../index.php");
            die;
        }elseif($id =="show_all_contacts"){
            $_SESSION['Contacts']=listContacts($file_contact);
            redirection("../Dashboard/contactIndex.php");
            die;
        }elseif($id =="show_all_goals"){
            $_SESSION['Goals']=listgoals($file_goal);
            redirection("../Dashboard/goalsIndex.php");
            die;
        }elseif($id == "getGoals"){
            $_SESSION['Goals']=listgoals($file_goal);
            redirection("../about.php");
            die;
        }elseif($id =="show_all_users"){
            $_SESSION['Users']=listUsers($file_user);
            redirection("../Dashboard/userIndex.php");
            die;
        }elseif($id =="show_all_orders"){
            $_SESSION['Orders']=listOrders($file_order);
            redirection("../Dashboard/orderIndex.php");
            die;
        }elseif($id =="dashboradHome"){
            $_SESSION['Orders']=listOrders($file_order);
            $_SESSION['Users']=listUsers($file_user);
            $_SESSION['Products']=listProducts($file_product);
            redirection("../Dashboard/dashboradHome.php");
            die;
        }
    }

}
    

?>