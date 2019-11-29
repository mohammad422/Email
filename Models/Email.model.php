<?php
require_once "../Config/Config.php";
#define a function for send email
function sendEmail($userfrom, $message, $file_id, $date, $userto, $uname)
{
    global $connection;
    $sql = "INSERT INTO tbl_email (user_id,message,file_id,datepost,uname) VALUES ('$userfrom','$message','$file_id','$date','$uname')";
    if (mysqli_query($connection, $sql)) {
        $lastId = mysqli_insert_id($connection);
        $sql = "INSERT INTO tbl_user_has_email (user_id,email_id) VALUES ('$userto','$lastId')";
        mysqli_query($connection, $sql);
        mysqli_close($connection);
    }
}

#define a function for all sent email from a user
function sentEmails($id)
{
    global $connection;
    $sql = " SELECT  tbl_email.ID, tbl_email.message, (SELECT tbl_file.filename from tbl_email
           INNER JOIN tbl_file ON tbl_email.file_id=tbl_file.ID) as file, tbl_email.datepost, tbl_users.email,tbl_users.username,tbl_email.uname 
           FROM tbl_user_has_email 
           RIGHT JOIN tbl_email ON tbl_user_has_email.email_id = tbl_email.ID
           LEFT  JOIN tbl_users ON tbl_user_has_email.user_id  = tbl_users.ID
           WHERE tbl_email.user_id='$id'";
     $result = mysqli_query($connection, $sql);
     $emails = mysqli_fetch_all($result, MYSQLI_ASSOC);
     return $emails;
}

#define a function for all received email for a user
function inboxEmails($id)
{
    global $connection;
    $sql = "SELECT  tbl_email.ID, tbl_email.message, 
          (SELECT tbl_file.filename from tbl_email
           INNER JOIN tbl_file ON tbl_email.file_id=tbl_file.ID) as file, tbl_email.datepost ,tbl_users.email FROM tbl_email
           RIGHT JOIN tbl_user_has_email ON tbl_user_has_email.email_id = tbl_email.ID
           LEFT JOIN tbl_users ON tbl_email.user_id  = tbl_users.ID
           WHERE tbl_user_has_email.user_id = '$id'";
    $result = mysqli_query($connection, $sql);
    $inbox = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $inbox;
}