<?php

include "./fcm/notification2.php" ;
include "./connect.php" ;

echo 
sendfcm("From Admin", "hi" , "users" , "none" , "none") ; 

// sendDcm("hi", "zoher" ,"delivery",  "none" , "none") ; 


?>
