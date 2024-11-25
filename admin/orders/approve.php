<?php


include "../../connect.php" ; 
include "../../fcm/notification2.php" ; 

 $ordersid = filterRequest("ordersid") ; 
 $usersid = filterRequest("usersid") ; 


 $data = array(
 "orders_status" => 1 , 
 ); 
 updateData("orders" ,$data ,"orders_id = $ordersid AND orders_status = 0" ) ;
 //  sendfcm("Success" , "The Order Has Been Approved" , "users$usersid" ,  "none" ,  "refreshorderpending") ; 
 insertNotify("Success" , "The Order Has Been Approved" , $usersid , "users$usersid" , "none" , "refreshorderpending") ; 


 ?>