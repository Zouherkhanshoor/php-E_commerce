<?php

 include "../../connect.php" ; 


 $table = "categories" ; 

 $name    = filterRequest("name") ; 
 $namear    = filterRequest("namear") ; 
 $imagename  = imageUpload("../../upload/categories" , "files") ; 


 $data = array(
    "categoires_name" =>  $name ,
    "categoires_name_ar"    =>   $namear   ,
    "categoires_image"    =>  $imagename ,
 ) ; 


 insertData($table , $data) ; 

?>