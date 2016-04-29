<?php
include("config.php");
$user = $_SESSION['user'];
$friend=htmlspecialchars($_GET['friend']);
if(!isset($_SESSION['user']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest'){
    die("<script>window.location.reload()</script>");
}
if(isset($_SESSION['user']) && isset($friend)){
    if($friend!=""){
        $sql=$dbh->prepare("INSERT INTO friends (name,friend) VALUES (?,?)");
        $sql->execute(array($user,$friend));
        $sql->execute(array($friend,$user));

        echo "<div>Friend added</div>";
    }else{
        echo "<div>User does not exist</div>";
    }
}else{
    echo "<div>Friend could not be added</div>";
}
?>
