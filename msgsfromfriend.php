<?php
include("config.php");
$user = $_SESSION['user'];
$friend = htmlspecialchars($_GET['friend']);

$sql=$dbh->prepare("SELECT count(*) FROM messages where name = ? AND to_name = ?");
$sql->execute(array($friend,$user));
//$count = 0;
while($r=$sql->fetch()){
    echo "{$r['count']}";
    //echo "<div class='msg' title='{$r['posted']}'><span class='name'>{$r['name']}</span> : <span class='msgc'>{$r['msg']}</span></div>";
}
if(!isset($_SESSION['user']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest'){
 echo "<script>window.location.reload()</script>";
}
?>
