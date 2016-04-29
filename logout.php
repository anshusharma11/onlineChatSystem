<?php
//session_start();
include("config.php");
$sql=$dbh->prepare("UPDATE chat_assignment.chatters SET onlinestatus = 0 WHERE name=?");
$sql->execute(array($_SESSION['user']));
session_destroy();
header("Location: index.php");
?>
