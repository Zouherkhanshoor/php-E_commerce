<?php

include "../../connect.php" ;


$email = filterRequest("email") ;
$verifycode = rand(10000 , 99999) ;
$stmt = $con-> prepare("SELECT * FROM users WHERE delivery_email = ? ") ;
$stmt ->execute(array($email )) ;
$count = $stmt->rowCount();

result($count) ; 
if($count > 0){
    $data = array("admin_verifycode" => $verifycode) ; 
    updateData("admin" ,$data , "admin_email = '$email' " , false ) ;
    sendEmail('to@gmail.com' , "verifycode ecommerce " , "verifycode $verifycode") ;
}