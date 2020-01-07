<?php
require_once  "../Config/Dbconnection.config.php";
// check the health of the db connection
if (mysqli_connect_errno()) {

    die('can not connect to db');

}
