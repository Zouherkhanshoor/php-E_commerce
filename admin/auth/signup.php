<?php

include "../../connect.php" ;

$username = filterRequest("username") ;
$password = sha1($_POST["password"]) ;
$email = filterRequest("email") ;
$phone = filterRequest("phone") ;
$verifycode = rand(10000 , 99999) ; 


$stmt = $con-> prepare("SELECT * FROM users WHERE delivery_email = ? OR delivery_phone = ? ") ;
$stmt ->execute(array($email , $phone)) ;

$count = $stmt->rowCount();
if($count >0){
    printfailure("PHONE OR EMAIL") ;
 }else{ 
     $data = array(
        "admin_name" => $username , 
        "admin_password" => $password , 
        "admin_email" => $email , 
        "admin_phone" => $phone , 
        "admin_verifycode" => $verifycode , 
        ) ;
        sendEmail('to@gmail.com' , "verifycode ecommerce " , "verifycode $verifycode") ;
        insertData("admin" , $data) ; 
 }