<?php

include "../../connect.php" ;

$email = filterRequest("email") ;
$password = sha1($_POST['password']) ;

// $stmt = $con-> prepare("SELECT * FROM users WHERE users_email = ? AND users_password = ? AND users_approve = 1 ") ;
// $stmt ->execute(array($email , $password)) ;
// $count = $stmt->rowCount();
// result($count) ; 

getData("admin" , "admin_email = ? AND admin_password = ?" , array($email , $password)) ; 