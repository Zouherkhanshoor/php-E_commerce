<?php
require 'vendor/autoload.php';

use Google\Client as GoogleClient;

function  sendfcm($title, $body , $topic ,  $pageid , $pagename)
{

    $url = "https://fcm.googleapis.com/v1/projects/projectecommerce-7c191/messages:send";

    $credentialsFilePath = 'C:\xampp\htdocs\ecommerce\service_account.json'; // this file  uplade is loaded from google cloud  generate key in your projects 

    $client = new GoogleClient();

    $client->setAuthConfig($credentialsFilePath);


    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    $client->fetchAccessTokenWithAssertion();

    $token = $client->getAccessToken();

    $access_token = $token['access_token'];


    $headers = [
        "Authorization: Bearer "." $access_token",
        "Content-Type: application/json"
    ];

    // $token = "fWBlQSW4TpSMMswvtV1LzV:APA91bFH-Dz_7pVUpzLiK9a6brtTyyjm8lPLy8m7d59JKggxvhKdJhp4XNpGGOUbzYeGs2ZXwsufdfI0CV7XLshNn62g2TYZwWv-tF3MfbhDqoLSVB36A3TsYFN11t6UToVMOa7cDGuf" ; 
    $data = [
        "message" => [
            "topic" => $topic,
            "notification" => [
                "title" => $title,
                "body" => $body
            ],
            "android" => [
                "priority" => "high",
                "notification" => [
                    "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                    "sound" => "default"
                ]
            ],
            "data" => [
                "pageid" => $pageid,
                "pagename" => $pagename , 
                "click_action"=> "FLUTTER_NOTIFICATION_CLICK"
            //this your data send in notification 
            ]
        ]
    ];
    $payload = json_encode($data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_VERBOSE, true);

    $response = curl_exec($ch);
    $err = curl_error($ch);

    curl_close($ch);

    if ($err) {
        return $err;
    } else {
        return $response;
    }
}

function  sendDcm($title, $body ,$topic,  $pageid , $pagename)
{

    $url = "https://fcm.googleapis.com/v1/projects/ecommerce-80185/messages:send";

    $credentialsFilePath = 'C:\xampp\htdocs\ecommerce\fcm\service_account2.json'; // this file  uplade is loaded from google cloud  generate key in your projects 

    $client = new GoogleClient();

    $client->setAuthConfig($credentialsFilePath);


    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    $client->fetchAccessTokenWithAssertion();

    $token = $client->getAccessToken();

    $access_token = $token['access_token'];


    $headers = [
        "Authorization: Bearer "." $access_token",
        "Content-Type: application/json"
    ];

    // $token = "cCuTdgjPQd-qVBteFBGlv0:APA91bG53EEEKkGdTSct9XVqr5p6FVPv2LRNMwXyI-HPSwLYH4cpNteO00QJOBEy8aVmIpWB0ZC7BUC50Y70L0jvVxa6rlAM50WK5KwsfiH8b7eJFZiElQY" ; 
    $data = [
        "message" => [
            "topic" => $topic,
            "notification" => [
                "title" => $title,
                "body" => $body
            ],
            "android" => [
                "priority" => "high",
                "notification" => [
                    "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                    "sound" => "default"
                ]
            ],
            "data" => [
                "pageid" => $pageid,
                "pagename" => $pagename , 
                "click_action"=> "FLUTTER_NOTIFICATION_CLICK"
            //this your data send in notification 
            ]
        ]
    ];
    $payload = json_encode($data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_VERBOSE, true);

    $response = curl_exec($ch);
    $err = curl_error($ch);

    curl_close($ch);

    if ($err) {
        return $err;
    } else {
        return $response;
    }
}


function insertNotify($title , $body , $usersid , $topic , $pageid , $pagename)
{
  global $con ; 
$stmt = $con->prepare("INSERT INTO `notification`(`notification_title`, `notification_body`, `notification_userid`) VALUES (? , ? , ? )") ;
$stmt->execute(array($title , $body , $usersid)) ;
sendfcm($title , $body , $topic ,  $pageid ,  $pagename) ; 

$count = $stmt->rowCount() ;
return $count ; 

}
