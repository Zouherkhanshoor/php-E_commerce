<?php


include "./connect.php" ; 
 
$usersid = filterRequest("id") ;

getAllData("notification" , "notification_userid = $usersid") ;


?>