<?php
require_once "../Models/User.model.php";
require_once "../Models/Email.model.php";

session_start();
/*if (isset($_COOKIE['remember'])) {
    echo $_COOKIE["remember"];
}*/
require "../Views/Dashboard.view.php";

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $from = $_POST["from"];
    $user1 = getusername("email", $from);//get  a user from database by email for sending
    $user_id1 = $user1["ID"];

    $message = $_POST["message"];
    $file = $_FILES["file"]["name"];

    if (!empty($file["name"])) {
        $checksum = md5_file($file["tmp_name"]);
        ## check if file exists in database
        $file_id = getFileByChecksum($checksum);
        ## move file to server if it does not exist in database
        if(empty($file_id)) {
            move_uploaded_file($_FILES["file"]["tmp_name"], "../Images/sent/$file");//upload file in folder image
            $file_id = addFile($file,$checksum);// get the id of new file in data base
        }

    } else {

        $file_id = null;
    }

    $date = date("Y-m-d h:i:sa");//time of sent email
    $to = $_POST["to"];
    $user2 = getusername("email", $to);//get a user from database by email for receiving
    if (isset($user2)) {
        $user_id2 = $user2["ID"];
        sendEmail($user_id1, $message, $file_id, $date, $user_id2, $to);//sent email to a user

    } else {
        $user_id2 = "";
        sendEmail($user_id1, $message, $file_id, $date, $user_id2, $to);//sent email to a user

    }
}