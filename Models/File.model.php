<?php
require_once "../Config/Config.php";
function addFile($filename,$checksum){

    global $connection;

    $sql = "INSERT INTO tbl_file VALUES ('$filename','$checksum')";
    mysqli_query($connection,$sql);
    return mysqli_insert_id($connection);
}

function getFileByChecksum($checksum){

    global $connection;

    $sql = "SELECT ID FROM tbl_file WHERE checksum = '$checksum'";
    $result = mysqli_query($connection,$sql);
    $row = mysqli_fetch_all($result);

    if(reset($row)){
        $file_id = reset($row);
    }else{
        $file_id = null;
    }
    mysqli_free_result($result);
    return $file_id[0];
}