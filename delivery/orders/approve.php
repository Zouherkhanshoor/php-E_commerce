<?php


include "../../connect.php" ; 
include "../../fcm/notification2.php" ; 

 $ordersid = filterRequest("ordersid") ; 
 $usersid = filterRequest("usersid") ; 
 $deliveryid = filterRequest("deliveryid") ; 

 $data = array(
 "orders_status"   => 3  ,
 "orders_delivery" => $deliveryid , 
 ); 
 updateData("orders" ,$data ,"orders_id = $ordersid AND orders_status = 2" ) ; 
 
 insertNotify("Success" , "your Order is on the way" , $usersid , "users$usersid" , "none" , "refreshorderpending") ; 

 sendDcm("hi admin" , "the order has been approved  by delivery" , "admin" , "none" , "none") ;

 sendDcm("hi delivery" , "the order has been approved  by delivery" . $deliveryid , "delivery" , "none" , "none") ; 

 ?>