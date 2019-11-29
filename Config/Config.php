<?php
require_once  "../Config/Dbconnection.config.php";
// check the health of the db connection
/*if (mysqli_connect_errno()) {
    $msg = "can not connect to db";
    // die('can not connect to db');

  //  error_log($msg, 0);
//error_log($msg,1,'');
    error_log($msg, 3, 'C:\xampp\htdocs\email2\Images/error.log');
}*/
function throwException($message = null,$code=null){
    throw new Exception($message,$code);
}
try{
    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME)
    or throwException("error");
}
catch ( Exception $e){
    echo 'Caught exception:' .$e->getMessage();
    echo 'Online:' .$e->getLine();
    echo 'stack Trace:' .print_r($e->getTrace());

}finally{
    mysqli_close($connection);
}