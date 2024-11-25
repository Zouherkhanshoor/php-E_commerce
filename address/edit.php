<?php

 include "../connect.php" ;

  $table = "address" ; 


 $addressid = filterRequest("addressid") ;  
 $city      = filterRequest("city") ; 
 $street    = filterRequest("street") ; 
 $lat       = filterRequest("lat") ; 
 $lang      = filterRequest("lang") ; 
 $name      = filterRequest("name") ; 


    $data = array(
    "address_city"    =>  $city  ,
    "address_street"  =>  $street ,
    "address_lat"     =>  $lat   ,
    "address_lang"    =>  $lang  ,
    "address_name"    =>  $name ,

 ) ; 


 updateData($table , $data , "address_id = $addressid") ; 

?>