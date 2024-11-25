<?php

include "connect.php" ;

$usersid = filterRequest("usersid") ;
$itemsid = filterRequest("itemsid") ;

$count = getData("cart","cart_itemsid = $itemsid AND cart_usersid = $usersid"); 


if($count > 0){
    $data = array(
        "cart_usersid" => $usersid ,
    );
       updateData("cart" ,$data , "cart_itemsid = '$itemsid' ") ; 
}else{
    $data = array(
        "cart_usersid" => $usersid ,
        "cart_itemsid" => $itemsid
    );
    insertData("cart" ,$data ) ; 
}