<?php
include("config.php");
$user = $_SESSION['user'];
if (isset($_SESSION['friend'])) {
    $friend = $_SESSION['friend'];
}
if(isset($_SESSION['user'])){
?>
 <!--<a style="left: 20px;top: 20px;position: absolute;cursor: pointer;" href="logout.php">Log Out</a>-->
 <div align="right"><h4>User : <?php echo "\"{$user}\""; ?></h4></div>
 <div class='msgs' id='friendmsgsbox'>
  <?php include("friendmsgs.php"); ?>
 </div>
 <form id="msg_form" align="right">
    <input placeholder="Type your message here" name="msg" size="30" type="text"/>
    <button>Send</button> 
 </form>
<?php
}
?>