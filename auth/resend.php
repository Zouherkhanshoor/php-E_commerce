<?php

include "../connect.php" ;


$email = filterRequest("email") ;
$verify = rand(10000 , 99999) ;

$data = array(
    "users_verifycode" => $verify
);

updateData("users" , $data , "users_email = '$email'")  ; 
sendEmail('to@gmail.com' , "verifycode ecommerce " , "verifycode $verify") ;
