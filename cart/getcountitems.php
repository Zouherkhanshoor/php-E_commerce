<?php

include "../connect.php" ; 

$usersid = filterRequest("usersid");
$itemsid = filterRequest("itemsid");


$stmt = $con->prepare("SELECT COUNT(cart.cart_id)AS countitems FROM `cart` WHERE cart_usersid = $usersid AND cart_itemsid = $itemsid AND cart_orders = 0") ;
$stmt->execute() ; 
$count = $stmt->rowCount() ; 

$data = $stmt->fetchColumn() ; 
// $data = strval($data) ; 



if($count > 0 ){
    echo json_encode(array("status" => "success" , "data" => $data)) ; 
} else{
    echo json_encode(array("status" => "success" , "data" => "0")) ;

}

?>