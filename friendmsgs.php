<?php
include("config.php");
$user = $_SESSION['user'];
$friend = NULL;
if(!empty($_GET)){
    if(isset($_GET['friend'])){
        $friend = $_GET['friend'];
        $_SESSION['friend'] = $_GET['friend'];
    }
} else if(isset($_SESSION['friend'])){
    $friend = $_SESSION['friend'];
} else {
    $friend = $user;
}
if ($friend != NULL){
    $sql=$dbh->prepare("SELECT * FROM chat_assignment.messages WHERE (name = '$user' AND to_name = '$friend') OR (name = '$friend' AND to_name = '$user')");
    $sql->execute();

    while($r=$sql->fetch()){
        //echo "<div class='msg' title='{$r['posted']}'><span class='name'>{$r['name']}</span> : <span class='msgc'>{$r['msg']}</span></div>";
            if($r["name"] == $_SESSION['user']){
                    echo "<div align='right' class='msg_b'>{$r['msg']} : [{$_SESSION['user']}]</div>";
            }else{
                    echo "<div class='msg_a'>[{$_SESSION['friend']}] : {$r['msg']}</div>";
            }

     /*echo '<div class='msg' title='{$r['posted']}'><span class='name'>{$r['name']}</span> : <span class='msgc'>{$r['msg']}</span></div>';*/
    }
    
    $sql2=$dbh->prepare("UPDATE chat_assignment.messages SET unread = 0 WHERE name = '$friend' AND to_name = '$user' AND unread = 1");
    $sql2->execute();
}
if(!isset($_SESSION['user']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest'){
 echo "<script>window.location.reload()</script>";
}
?>
