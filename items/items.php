<?php
include "../connect.php" ;

$categoryid = filterRequest("id") ; 
// getAllData("itemsview" , "categoires_id = $categoryid") ; 
$userid = filterRequest("usersid") ; 


$stmt = $con->prepare("SELECT items1view.*, 1 as favorite ,(items_price - (items_price * items_discount / 100)) as itemspricediscount  FROM items1view
INNER JOIN favorite ON favorite.favorite_itemsid = items1view.items_id AND favorite.favorite_usersid = $userid
WHERE categoires_id = $categoryid
UNION
SELECT * , 0 as favorite , (items_price - (items_price * items_discount / 100)) as itemspricediscount FROM items1view
WHERE categoires_id = $categoryid AND items_id NOT IN(SELECT items1view.items_id FROM items1view
INNER JOIN favorite ON favorite.favorite_itemsid = items1view.items_id AND favorite.favorite_usersid = $userid )") ; 

$stmt->execute() ; 
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count  = $stmt->rowCount();
$data = convertNumbersToString($data) ; 
if($count > 0){
    echo json_encode(array("status" => "success" , "data" => $data)); 
}else{
    echo json_encode(array("status" => "failure"));
}