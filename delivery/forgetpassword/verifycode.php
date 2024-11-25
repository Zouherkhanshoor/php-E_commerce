<?php
 
 include "../../connect.php" ; 

 $email = filterRequest("email") ; 
 $verify = filterRequest("verifycode") ; 
 


 $stmt = $con-> prepare("SELECT * FROM users WHERE delivery_email = '$email' AND delivery_verifycode = '$verify'") ;
 $stmt->execute() ; 

 $count = $stmt->rowCount() ;

 result($count) ; 
 
 
?> 