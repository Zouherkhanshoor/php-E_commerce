<?php

include "../../connect.php" ;


$email = filterRequest("email") ;
$verify = rand(10000 , 99999) ;

$data = array(
    "admin_verifycode" => $verify
);

updateData("admin" , $data , "admin_email = '$email'")  ; 
sendEmail('to@gmail.com' , "verifycode ecommerce " , "verifycode $verify") ;
