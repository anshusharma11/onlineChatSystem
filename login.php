<?php
//session_start();

if(isset($_GET['logout'])){
$fp = fopen("log.html", 'a');
fwrite($fp, "<div class='msgln'><i>User ". $_SESSION['user'] ." has left the chat session.</i><br></div>");
fclose($fp);

session_destroy();
header("Location: index.php"); //Redirect the user
}

if($_POST){
$servername = "localhost";
$user = "root";
$pwd = "Atulp4321";
$dbname = "chat_assignment";
$name = $_POST['name'];
$password = $_POST['password'];
$conn = mysqli_connect($servername,$user,$pwd, $dbname);
// Create connection
$query1 = "select * from chatters where name='$name' and password= '$password'";
$result1= mysqli_query($conn,$query1);
if(mysqli_num_rows($result1)==1){
    
    $query3 = "select * from chatters where name='$name' and onlinestatus = 1";
    $result3= mysqli_query($conn,$query3);
    if(mysqli_num_rows($result3)==1){
        //echo 'User has already logged in through another session.';
	session_start();
	header("Location: index.php");  //Redirect the user
    }else{
	session_start();
	$_SESSION['dbassignment']= 'true';
	header('location: index.php');
        
        $query2 = "UPDATE " . $dbname . ".chatters SET onlinestatus = 1 WHERE name='$name'";	
        $result2= mysqli_query($conn, $query2);
        //while($row= mysqli_fetch_array($result2))
    }
}
else{
	echo 'Credentials not correct!';
	session_destroy();
	header("Location: login.php");  //Redirect the user
}
}


function loginForm(){
echo'

<div id="loginform">
<form action="login.php" method="post" align="center">
<center><h1>Chat Assignment</h1></center>
<center><h4>By Anshu Padha</h4></center>
<BR>
<BR>
<BR>
<h3>Login</h3>
<label for="name">Name : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
<input type="text" placeholder="Username" name="name" id="name" /><br>
<BR>
<label for="password">Password :</label>
<input type="text" placeholder="Password" name="password" id="password"/><br>
<BR>
<input type="submit" name="enter" id="enter" value="Enter" />
<BR>
<BR>
<div><a href="signup.php">Sign up</a></div>
</form>
</div>
';
}

if(isset($_POST['enter'])){
  if($_POST['name'] != ""){
     $_SESSION['user'] = stripslashes(htmlspecialchars($_POST['name']));
  }
  else{
    echo '<span class="error">Please type in a name</span>';
  }
}

?>


<!DOCTYPE html>
<html>
<head>
<title>chat</title>
<link type="text/css" rel="stylesheet" href="style.css" />
  <script type="text/javascript">
      function myfunc(){
          alert('ready');
      }
      window.onload = myfunc();
      $document.ready(function(){
          alert('ready');
      });
      $window.onload(function(){
          alert('ready');
      });
      $.ajax.({
          url: "index.php";
          success: function(result){
              alert("success loading");
          }
      });
  </script>
</head>
<?php
if(!isset($_SESSION['user'])){
loginForm();
}
else{
?>
<div id="wrapper">
<div id="menu">
<p class="welcome">Welcome, <b><?php echo $_SESSION['user']; ?></b></p>
<p class="logout"><a id="exit" href="logout.php">Logout</a></p>
<div style="clear:both"></div>
</div>

<div id="chatbox"></div>
<?php
if(file_exists("log.html") && filesize("log.html") > 0){
    $handle = fopen("log.html", "r");
    $contents = fread($handle, filesize("log.html"));
    fclose($handle);

    echo $contents;
}
?>

<form name="message" action="">
<!--<input name="usermsg" type="text" id="usermsg" size="63" />
<input name="submitmsg" type="submit"  id="submitmsg" value="Send" />-->
</form>
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js">
</script>

<script type="text/javascript">

$(document).ready(function(){
  
   $("#exit").click(function(){
       var exit = confirm("Are you sure you want to end the session?");
       if(exit==true){window.location = 'logout.php?logout=true';}
   });


   $("#submitmsg").click(function(){
      var clientmsg = $("#usermsg").val();
      $.post("post.php", {text: clientmsg});
      $("#usermsg").attr("value", "");
      return false;
   });
   
   setInterval (loadLog, 2500);
                              


function loadLog(){
    var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20;

    $.ajax({ url: "log.html",
             cache: false,
             success: function(html){
                $("#chatbox").html(html);
                var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
                if(newscrollHeight > oldscrollHeight){
                    $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); 
                }
             },
    });
}
});
</script>
<?php
}
?>


</body>
</html>