<?php
include("config.php");
$user = $_SESSION['user'];
$friend = $_SESSION['friend'];
$msg=htmlspecialchars($_GET['msg']);
if(!isset($_SESSION['user']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest'){
 die("<script>window.location.reload()</script>");
}
if(isset($_SESSION['user']) && isset($msg)){
 //$msg=htmlspecialchars($_POST['msg']);
 if($msg!=""){
  $sql=$dbh->prepare("INSERT INTO messages (name,to_name,msg,posted) VALUES (?,?,?,NOW())");
  $sql->execute(array($user,$friend,$msg));
  
  echo "<div>Message Sent</div>";
 }else{
     echo "<div>Message is blank</div>";
 }
}else{
  echo "<div>Message could not be Sent</div>";
}
?>
