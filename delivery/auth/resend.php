<?php

include "../../connect.php" ;


$email = filterRequest("email") ;
$verify = rand(10000 , 99999) ;

$data = array(
    "delivery_verifycode" => $verify
);

updateData("delivery" , $data , "delivery_email = '$email'")  ; 
sendEmail('to@gmail.com' , "verifycode ecommerce " , "verifycode $verify") ;
