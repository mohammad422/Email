<?php
require_once "../Models/User.model.php";
require_once "../Models/Email.model.php";
session_start();
if (!isset($_SESSION["user_id"])) {
    header("location:Login.controller.php");

} else {
    $inbox = inboxEmails($_SESSION["user_id"]);//get all received emails for a user
}
require "../Views/Inbox.view.php";