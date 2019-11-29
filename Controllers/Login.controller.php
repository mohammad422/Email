<?php
require "../Models/User.model.php";
session_start();
// try to authenticate user by cookie
if (isset($_COOKIE['remember']) && !isset($_SESSION['user_id'])) {
    authenticateUserByCookie();
    //echo $_COOKIE["remember"];
}

// redirect to dashboard if user has been authenticated
if (isset($_SESSION['user_id'])) {
    header('location: Dashboard.controller.php');
    exit();
}
if (isset($_POST["username"]) && isset($_POST["password"])){
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $password = sha1($pass);
// check correctness of username and password
    $credentialIsCorrect = login($username, $password);

// redirect to login page if username or password is wrong
    if (!isset($credentialIsCorrect)) {
        $_SESSION['error'] = 'Username Or Password Is Incorrect';
        echo "ok";
        header('location:../Controllers/Login.controller.php');
        exit();
    }else{
        header('location:../Controllers/Dashboard.controller.php');
    }
}

require "../Views/Login.view.php";


