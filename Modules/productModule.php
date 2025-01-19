<?php
require_once('../Handlers/fileHandling.php');
//$file='../Storage/products.json';

//add Product
function addProduct($filePath, $newProduct){
    $Products = getFileContent($filePath);
    $id = array_key_last($Products) + 1;
    if(count($Products)==0){ $id=0;}
    $productID['id']=$id;
    //array_unshift($newProduct,$id);
    $newProduct= $productID+ $newProduct;
    $Products[]=$newProduct;
    PutFileContents($filePath, $Products);
    return "Product Added Sucessfully";
}

// list Products
function listProducts($filePath)  {
    $Products =  getFileContent($filePath);
    return $Products;
    
}

// get Product
function getProduct($filePath,$id)  {
    $Products =  getFileContent($filePath);
    foreach($Products as $product){
        if($product->id == $id){
            return $product;
        }
    }
    return [];
    
}


function update_Product($filePath,$data,$id){
    $Products =  getFileContent($filePath);
    
    foreach($Products as $product){
        if($product->id == $id){
            $product->name=$data['name'];
            $product->basic_price=$data['basic_price'];
            $product->sale_price=$data['sale_price'];
            $product->sale=$data['sale'];

            if(isset($data['image'])){
                $product->image=$data['image'];//if changed will change else will be old image
            }
           
        }

    }

    
    PutFileContents($filePath, $Products);
    return "Product Updated Sucessfully";
}

function delete_Product($filePath,$id){
    $Products =  getFileContent($filePath);
   
    $new_products=[];
    foreach($Products as $product){
        if($product->id != $id){$new_products[]=$product;}
    }
    PutFileContents($filePath, $new_products);
    return "Product Deleted Sucessfully";
}

?>