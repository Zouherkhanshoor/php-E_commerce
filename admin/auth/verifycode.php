<?php
 
 include "../../connect.php" ; 

 $email = filterRequest("email") ; 
 $verify = filterRequest("verifycode") ; 
 


 $stmt = $con-> prepare("SELECT * FROM users WHERE delivery_email = '$email' AND delivery_verifycode = '$verify'") ;
 $stmt->execute() ; 

 $count = $stmt->rowCount() ;

 if($count > 0 ){
    $data = array("admin_approve" => '1' ) ; 

    updateData("admin" , $data , "admin_email = '$email'") ; 

 }else{
     
    printfailure("Verifycode not Correct") ; 
 }
 
 
?> 