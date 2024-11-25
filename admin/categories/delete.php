<?php

include "../../connect.php" ; 
$id =  filterRequest("id") ; 
$imagename =  filterRequest("imagename") ; 
deleteFile("../../upload/categories" , $imagename) ; 

deleteData("categories" , "categoires_id = $id") ; 


?>