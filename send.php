<?php
include("config.php");
if(!isset($_SESSION['user']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest'){
 die("<script>window.location.reload()</script>");
}
if(isset($_SESSION['user']) && isset($_POST['msg'])){
 $msg=htmlspecialchars($_POST['msg']);
 if($msg!=""){
     if(isset($_SESSION['friend'])){
        $sql=$dbh->prepare("INSERT INTO messages (name,to_name,msg,posted,unread) VALUES (?,?,?,NOW(),1)");
        $sql->execute(array($_SESSION['user'],$_SESSION['friend'],$msg));
     }else{
        $sql=$dbh->prepare("INSERT INTO messages (name,msg,posted,unread) VALUES (?,?,NOW(),1)");
        $sql->execute(array($_SESSION['user'],$msg));
     }
 }
}
?>
