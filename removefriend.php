<?php
include("config.php");
$user = $_SESSION['user'];
$friend=htmlspecialchars($_GET['friend']);
if(!isset($_SESSION['user']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest'){
    die("<script>window.location.reload()</script>");
}
if(isset($user) && isset($friend)){
    if($friend!=""){
        $sql=$dbh->prepare("DELETE FROM friends WHERE name = ? AND friend = ?");
        $sql->execute(array($user,$friend));
        $sql->execute(array($friend,$user));

        echo "<div>Friend removed</div>";
    }else{
        echo "<div>User does not exist</div>";
    }
}else{
    echo "<div>Friend could not be removed</div>";
}
?>
