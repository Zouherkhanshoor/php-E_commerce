<?php

 include "../../connect.php" ; 


 $table = "categories" ; 


 $id = filterRequest("id") ; 
 $name    = filterRequest("name") ; 
 $namear    = filterRequest("namear") ; 
 $imageold    = filterRequest("imageold") ; 

 $res = imageUpload("../../upload/categories" , "files") ; 
   
 if($res == 'empty'){
    $data = array(
        "categoires_name" =>  $name ,
        "categoires_name_ar"    =>   $namear  ,
     ) ; 
 }else{
    deleteFile("../../upload/categories" , $imageold) ; 
    $data = array(
        "categoires_name"      =>  $name ,
        "categoires_name_ar"   =>   $namear  ,
        "categoires_image"     =>   $res  ,
     ) ; 
 }

 updateData($table , $data , "categoires_id  = $id") ; 

?>