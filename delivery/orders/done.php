<?php


include "../../connect.php" ; 
include "../../fcm/notification2.php" ; 

 $ordersid = filterRequest("ordersid") ; 
 $usersid = filterRequest("usersid") ; 


 $data = array(
 "orders_status" => 4 
 ); 
 updateData("orders" ,$data ,"orders_id = $ordersid AND orders_status = 3" ) ; 
 //  sendFCM("service_account.json","users$usersid","Success","The Order Has Been Approved", "none" ,"refreshorderpending"); 
 insertNotify("Success" , "your Order has been deliverd" , $usersid , "users$usersid" , "none" , "refreshorderpending") ; 

 sendfcm("warning" , "the order has been deliverd to customer" , "services" , "none" , "none") ; 


 ?>