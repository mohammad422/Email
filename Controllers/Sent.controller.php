<?php
require_once "../Models/User.model.php";
require_once "../Models/Email.model.php";
session_start();
if (!isset($_SESSION["user_id"])){
    header("location:Login.controller.php");

}else{
    $emails = sentEmails($_SESSION["user_id"]);// get all sent emails from a user
}
require "../Views/Sent.view.php";