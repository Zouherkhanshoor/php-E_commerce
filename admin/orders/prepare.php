<?php


include "../../connect.php" ; 
include "../../fcm/notification2.php" ; 

 $ordersid = filterRequest("ordersid") ; 
 $usersid = filterRequest("usersid") ; 

 $type = filterRequest("ordertype") ; 
 if($type == "0"){
    $data = array(
        "orders_status" => 2 , 
        );
 }else{
    $data = array(
        "orders_status" => 4 , 
        );
 }


  
 updateData("orders" ,$data ,"orders_id = $ordersid AND orders_status = 1" ) ; 
//  sendFCM("service_account.json","users$usersid","Success","The Order Has Been Approved", "none" ,"refreshorderpending"); 
insertNotify("Success" , "The Order Has Been Approved" , $usersid , "users$usersid" , "none" , "refreshorderpending") ; 


   
if($type == "0"){
    sendfcm("warning" , "there is an orders awaiting approval" , "delivery" ,  "none" ,  "none") ;
 }
 ?>