<?php

// ==========================================================
//  Copyright Reserved Wael Wael Abo Hamza (Course Ecommerce)
// ==========================================================

// date_default_timezone_set("Asia/Damascus") ; 

define("MB", 1048576);

function filterRequest($requestname)
{
  return  htmlspecialchars(strip_tags($_POST[$requestname]));
}

function convertNumbersToString($data)
{
   foreach($data as &$item){
    foreach($item as $key => $value){
        if(is_numeric($value)){
            $item[$key] = strval($value) ; 
        }
    }
   }
   return $data ; 
}

function getAllData($table, $where = null, $values = null , $json = true)
{
    global $con;
    $data = array();
    if($where == null){

        $stmt = $con->prepare("SELECT  * FROM $table ");
    }else{
        
 $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
    }

    $stmt->execute($values);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    $data = convertNumbersToString($data) ; 

    if($json == true){
        if ($count > 0){
            echo json_encode(array("status" => "success" , "data" => $data));
        } else {
            echo json_encode(array("status" => "failure"));
        }
        return $count;
    }else{
      if($count > 0 ){
         return array("status" => "success" , "data" => $data )  ;
      }else{
        return array("status" => "failure");

      }
    }
    
}
function getData($table, $where = null, $values = null , $json = true)
{
    global $con;
    $data = array();
    $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
    $stmt->execute($values);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount(); 
    if($json == true){
    if ($count > 0){
        echo json_encode(array("status" => "success" , "data" => $data));
    } else {
        echo json_encode(array("status" => "failure"));
    }
     }else{
        return $count;
     }
   
}

function insertData($table, $data, $json = true)
{
    global $con;
    foreach ($data as $field => $v)
        $ins[] = ':' . $field;
    $ins = implode(',', $ins);
    $fields = implode(',', array_keys($data));
    $sql = "INSERT INTO $table ($fields) VALUES ($ins)";

    $stmt = $con->prepare($sql);
    foreach ($data as $f => $v) {
        $stmt->bindValue(':' . $f, $v);
    }
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
    if ($count > 0) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "failure"));
    }
  }
    return $count;
}


function updateData($table, $data, $where, $json = true)
{
    global $con;
    $cols = array();
    $vals = array();

    foreach ($data as $key => $val) {
        $vals[] = "$val";
        $cols[] = "`$key` =  ? ";
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";

    $stmt = $con->prepare($sql);
    $stmt->execute($vals);
    $count = $stmt->rowCount();
    // $data = convertNumbersToString($data) ; 
    if ($json == true) {
    if ($count > 0) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "failure"));
    }
    }
    return $count;
}

function deleteData($table, $where, $json = true)
{
    global $con;
    $stmt = $con->prepare("DELETE FROM $table WHERE $where");
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    return $count;
}

function imageUpload( $dir , $imageRequest)
{
  global $msgError;
  if(isset($_FILES[$imageRequest])) {
    $imagename  = rand(1000, 10000) . $_FILES[$imageRequest]['name'];
    $imagetmp   = $_FILES[$imageRequest]['tmp_name'];
    $imagesize  = $_FILES[$imageRequest]['size'];
    $allowExt   = array("jpg", "png", "gif", "mp3", "pdf" , "svg");
    $strToArray = explode(".", $imagename);
    $ext        = end($strToArray);
    $ext        = strtolower($ext);
  
    if (!empty($imagename) && !in_array($ext, $allowExt)) {
      $msgError = "EXT";
    }
    if ($imagesize > 2 * MB) {
      $msgError = "size";
    }
    if (empty($msgError)) {
      move_uploaded_file($imagetmp,  $dir . "/" . $imagename);
      return $imagename;
    } else {
      return "fail";
    }
  }else{
    return 'empty' ; 
  }
 
}



function deleteFile($dir, $imagename)
{
    if (file_exists($dir . "/" . $imagename)) {
        unlink($dir . "/" . $imagename);
    }
}

function checkAuthenticate()
{
    if (isset($_SERVER['PHP_AUTH_USER'])  && isset($_SERVER['PHP_AUTH_PW'])) {
        if ($_SERVER['PHP_AUTH_USER'] != "zoher" ||  $_SERVER['PHP_AUTH_PW'] != "zoher12345") {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Page Not Found';
            exit;
        }
    } else {
        exit;
    }

    // End 
}

function printfailure($message = "none"){
    echo json_encode(array("status" => "failure" , "message" => $message));
}
function printSuccess($message = "none"){
    echo json_encode(array("status" => "success" , "message" => $message));
}

function result($count){
   if($count > 0 ){
    printSuccess();
   }else{
    printfailure() ;
   }
}


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php_mailer/PHPMailer-master/src/Exception.php';
require 'php_mailer/PHPMailer-master/src/PHPMailer.php';
require 'php_mailer/PHPMailer-master/src/SMTP.php';

function sendEmail($to , $subject , $body){
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'sandbox-smtp.mailcatch.app'; // Specify main and backup SMTP servers
$mail->SMTPAuth = 'PLAIN'; // Enable SMTP authentication
$mail->Username = '9379b273d48f'; // SMTP username
$mail->Password = '048fe95dc768'; // SMTP password
// $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
$mail->Port = 2525;

$mail->setFrom('zouher.khanshoor91@gmail.com', 'First Last');
// $mail->addReplyTo('towho@example.com', 'John Doe');
$mail->addAddress($to, 'Recipient Name'); // Specify the recipient

$mail->isHTML(true);
$mail->Subject = $subject;
// $mail->addEmbeddedImage('path/to/image_file.jpg', 'image_cid'); // Specify the path to your image and a CID
$mail->Body =$body; // Use the CID as the src attribute in your img tag
$mail->AltBody = 'This is the plain text version of the email content';

if(!$mail->send()){
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}else{
    // echo 'Message has been sent';
}
}



  

?>




