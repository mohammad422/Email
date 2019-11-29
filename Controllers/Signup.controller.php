<?php
require_once "../Include/function.inc.php";
require_once "../Models/User.model.php";

$errors = [];
$flag = false;
#insert user in database if all fields are filled and validate
if (isset($_POST["btn"]) && fieldFill() && validateAll() && emailAndUserExist($_POST["username"], $_POST["email"])) {

    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $img = $_FILES["img"]["name"];
    insertuser($name, $email, $username, sha1($password), $img);//add user to database
    move_uploaded_file($_FILES["img"]["tmp_name"], "../Images/users/$img");//add image to folder
    header("location:Login.controller.php");
    $flag = true;
}

require "../Views/Signup.view.php";