<?php
require_once('../Handlers/fileHandling.php');

//add Contact
function addContact($filePath, $newContact){
    $Contacts = getFileContent($filePath);
    $id = array_key_last($Contacts) + 1;
    if(count($Contacts)==0){ $id=0;}
    $ContactID['id']=$id;
    $newContact= $ContactID+ $newContact;
    $Contacts[]=$newContact;
    PutFileContents($filePath, $Contacts);
    return true;
}

// list Contact
function listContacts($filePath)  {
    $Contacts =  getFileContent($filePath);
    return $Contacts;
    
}

// get Contact
function getContact($filePath,$id)  {
    $Contacts =  getFileContent($filePath);
    foreach($Contacts as $Contact){
        if($Contact->id == $id){
            return $Contact;
        }
    }
    return [];
    
}

// change statues from not readed  to readed means admin see this message(only admin can do this)
function show_Contact($filePath,$id){
    $Contacts =  getFileContent($filePath);
    
    foreach($Contacts as $Contact){
        if($Contact->id == $id){
            $Contact->statues="Readed";
            PutFileContents($filePath, $Contacts);
            return $Contact;            
        }
    }

    
    return [];

}


function delete_Contact($filePath,$id){
    $Contacts =  getFileContent($filePath);
   
    $new_Contacts=[];
    foreach($Contacts as $Contact){
        if($Contact->id != $id){$new_Contacts[]=$Contact;}
    }
    PutFileContents($filePath, $new_Contacts);
    return "Contact Deleted Sucessfully";
}

?>