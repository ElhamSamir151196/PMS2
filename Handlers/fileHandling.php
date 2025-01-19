<?php  

//to get data as array from file
function getFileContent($filePath){
    if(!file_exists($filePath)){
        return [];
    }
    $Emplyees = file_get_contents($filePath);
    if(empty($Emplyees)){
        return [];
    }
    return json_decode($Emplyees);
}


// to put array of data to file
function PutFileContents($filePath, $data){
    file_put_contents($filePath, json_encode($data),JSON_PRETTY_PRINT);

}


?>