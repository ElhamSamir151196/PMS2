<?php
session_start();
require_once( '../Handlers/Validation.php');
require_once( '../Modules/ProductModule.php');
$file='../Storage/products.json';
$cart_products=[];

if(checkRequestMethod("GET")){
   // var_dump($_GET);
    if(isset($_GET["type"])){
        
        if($_GET["type"] == "add_to_cart"){
            
            if(isset($_GET["id"])){
                $id= $_GET["id"];
                
                
                if(isset($_SESSION['cart_products'])){
                    
                    if(empty($_SESSION['cart_products'])){
                        $product_cart=[
                            "id"=>  $id,
                            "Quantity" => 1
                        ];
                        $cart_products[]=$product_cart;
                    }else{
                        $cart_products=$_SESSION['cart_products'];
                                
                        foreach($cart_products as $key=> $productCart){
                           // echo "id => $id , $key => ".$productCart['id'].", Quantity".$productCart['Quantity']."<br>";
                            if($productCart["id"]==$id){
                                $cart_products[$key]["Quantity"]=$productCart["Quantity"]+1;
                               break;
                            }elseif($key==count($cart_products)-1){
                                //echo "************ last item  add new ****************";

                                $product_cart=[
                                    "id"=>  $id,
                                    "Quantity" => 1
                                ];
                                $cart_products[]=$product_cart;
                            }
                        }

                        //die;
                                
                    }
                    
                }else{
                    
                    $product_cart=[
                        "id"=>  $id,
                        "Quantity" => 1
                    ];
                    $cart_products[]=$product_cart;

                }
                $_SESSION['cart_products']=$cart_products;
                /*echo "<pre>";
                        var_dump($_SESSION['cart_products']);
                        echo "</pre>";
                        die;*/
                $_SESSION['Cart_Added']="Product Added to Cart";
                $_SESSION['Products']=listProducts($file);
                redirection("../index.php");//redirect user
                die;
                
            }
            
        }elseif($_GET["type"] == "delete"){
            if(isset($_GET["index"])){
                $index= $_GET["index"];
                
                
                if(isset($_SESSION['cart_products'])){
                           
                unset($_SESSION['cart_products'][$index]);
                //$_SESSION['Cart_Added']="Product Added to Cart";
                $_SESSION['Products']=listProducts($file);
                redirection("../cart.php");//redirect user
                die;
                }
            }
        }
    }

}
    

?>