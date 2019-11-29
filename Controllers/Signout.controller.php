<?php
#destroy and unset session and cookie
session_start();
session_unset();
session_destroy();
setcookie("remember",null,time()-3600,"/");
header("location:../Controllers/Login.controller.php");
