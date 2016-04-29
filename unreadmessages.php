<?php
include("config.php");
$user = NULL;
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}
?>
<!DOCTYPE html>
<html>
 <head>
	<script>
	$(document).ready(function(){

		$('.chat_head').click(function(){
			$('.chat_body').slideToggle('slow');
		});
		$('.msg_head').click(function(){
			$('.msg_wrap').slideToggle('slow');
		});
	
		$('.close').click(function(){
			$('.msg_box').hide();
		});
	
		$('.user').click(function(){

			$('.msg_wrap').show();
			$('.msg_box').show();
		});
	
		$('textarea').keypress(
	    function(e){
	        if (e.keyCode == 13) {
	            var msg = $(this).val();
				$(this).val('');
				if(msg!='')
				$('<div align="right" class="msg_b">'+msg+' </div>').insertBefore('.msg_push');
				$('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
                                alert("1");
                                //$('#msg_body').load('friendmsgs.php?friend=bbb');
                                $('#resultMsg').load('send.php?msg='+msg);
                                alert("2");
                                
	        }
	    });
	
	});
	</script>
	<style>

	body{
		background:#16a085;
		margin:0px;
		height:900px;
		font-family: sans-serif;
	}

	.chat_box{
		position:fixed;
		right:20px;
		bottom:0px;
		width:250px;
	}
	.chat_body{
		background:white;
		height:400px;
		padding:5px 0px;
	}

	.chat_head,.msg_head{
		background:#f39c12;
		color:white;
		padding:15px;
		font-weight:bold;
		cursor:pointer;
		border-radius:5px 5px 0px 0px;
	}

	.msg_box{
		position:fixed;
		bottom:-5px;
		width:250px;
		background:white;
		border-radius:5px 5px 0px 0px;
	}

	.msg_head{
		background:#3498db;
	}

	.msg_body{
		background:white;
		height:200px;
		font-size:12px;
		padding:15px;
		overflow:auto;
		overflow-x: hidden;
	}
	.msg_input{
		width:100%;
		border: 1px solid white;
		border-top:1px solid #DDDDDD;
		-webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
		-moz-box-sizing: border-box;    /* Firefox, other Gecko */
		box-sizing: border-box;  
	}

	.close{
		float:right;
		cursor:pointer;
	}
	.minimize{
		float:right;
		cursor:pointer;
		padding-right:5px;
	
	}

	.user{
		position:relative;
		padding:10px 30px;
	}
	.user:hover{
		background:#f8f8f8;
		cursor:pointer;

	}
	.user:before{
		content:'';
		position:absolute;
		background:#2ecc71;
		height:10px;
		width:10px;
		left:10px;
		top:15px;
		border-radius:9px;
	}

	.msg_a{
		position:relative;
		background:#FDE4CE;
		padding:10px;
		min-height:10px;
		margin-bottom:5px;
		margin-right:10px;
		border-radius:5px;
	}
	.msg_a:before{
		content:"";
		position:absolute;
		width:0px;
		height:0px;
		border: 10px solid;
		border-color: transparent #FDE4CE transparent transparent;
		left:-20px;
		top:7px;
	}


	.msg_b{
		background:#EEF2E7;
		padding:10px;
		min-height:15px;
		margin-bottom:5px;
		position:relative;
		margin-left:10px;
		border-radius:5px;
	}
	.msg_b:after{
		content:"";
		position:absolute;
		width:0px;
		height:0px;
		border: 10px solid;
		border-color: transparent transparent transparent #EEF2E7;
		right:-20px;
		top:7px;
	}
	</style>
        <style>
            @media only screen and (max-width : 540px) 
            {
                .chat-sidebar
                {
                    display: none !important;
                }
                
                .chat-popup
                {
                    display: none !important;
                }
            }
            
            body
            {
                background-color: #e9eaed;
            }
            
            .chat-sidebar
            {
                width: 200px;
                position: fixed;
                height: 100%;
                right: 0px;
                top: 0px;
                padding-top: 10px;
                padding-bottom: 10px;
                border: 1px solid rgba(29, 49, 91, .3);
            }
            
            .sidebar-name 
            {
                padding-left: 10px;
                padding-right: 10px;
                margin-bottom: 4px;
                font-size: 12px;
            }
            
            .sidebar-name span
            {
                padding-left: 5px;
            }
            
            .sidebar-name a
            {
                display: block;
                height: 100%;
                text-decoration: none;
                color: inherit;
            }
            
            .sidebar-name:hover
            {
                background-color:#e1e2e5;
            }
            
            .sidebar-name img
            {
                width: 32px;
                height: 32px;
                vertical-align:middle;
            }
            
            .popup-box
            {
                display: none;
                position: fixed;
                bottom: 0px;
                right: 220px;
                height: 285px;
                background-color: rgb(237, 239, 244);
                width: 300px;
                border: 1px solid rgba(29, 49, 91, .3);
            }
            
            .popup-box .popup-head
            {
                background-color: #6d84b4;
                padding: 5px;
                color: white;
                font-weight: bold;
                font-size: 14px;
                clear: both;
            }
            
            .popup-box .popup-head .popup-head-left
            {
                float: left;
            }
            
            .popup-box .popup-head .popup-head-right
            {
                float: right;
                opacity: 0.5;
            }
            
            .popup-box .popup-head .popup-head-right a
            {
                text-decoration: none;
                color: inherit;
            }
            
            .popup-box .popup-messages
            {
                height: 100%;
                overflow-y: scroll;
            }
            


        </style>
        
        <script>
            //this function can remove a array element.
            Array.remove = function(array, from, to) {
                var rest = array.slice((to || from) + 1 || array.length);
                array.length = from < 0 ? array.length + from : from;
                return array.push.apply(array, rest);
            };
        
            //this variable represents the total number of popups can be displayed according to the viewport width
            var total_popups = 0;
            
            //arrays of popups ids
            var popups = [];
        
            //this is used to close a popup
            function close_popup(id)
            {
                for(var iii = 0; iii < popups.length; iii++)
                {
                    if(id == popups[iii])
                    {
                        Array.remove(popups, iii);
                        
                        document.getElementById(id).style.display = "none";
                        
                        calculate_popups();
                        
                        return;
                    }
                }   
            }
        
            //displays the popups. Displays based on the maximum number of popups that can be displayed on the current viewport width
            function display_popups()
            {
                var right = 220;
                
                var iii = 0;
                for(iii; iii < total_popups; iii++)
                {
                    if(popups[iii] != undefined)
                    {
                        var element = document.getElementById(popups[iii]);
                        element.style.right = right + "px";
                        right = right + 320;
                        element.style.display = "block";
                    }
                }
                
                for(var jjj = iii; jjj < popups.length; jjj++)
                {
                    var element = document.getElementById(popups[jjj]);
                    element.style.display = "none";
                }
            }
            
            //calculate the total number of popups suitable and then populate the toatal_popups variable.
            function calculate_popups()
            {
                var width = window.innerWidth;
                if(width < 540)
                {
                    total_popups = 0;
                }
                else
                {
                    width = width - 200;
                    //320 is width of a single popup box
                    total_popups = parseInt(width/320);
                }
                
                display_popups();
                
            }
            
            //add friend
            function add_friend(name)
            {
                $('#addfriend').load('addfriend.php?friend='+name);
            }
            
            //remove friend
            function remove_friend(name)
            {
                $('#removefriend').load('removefriend.php?friend='+name);
            }
            
            //msgs from friend
            function msgsfromfriend(name)
            {
                alert('Inside msgsfromfriend()..');
                $('#msgsfromfriend').load('msgsfromfriend.php?friend='+name);
            }
            
            //creates markup for a new popup. Adds the id to popups array.
            function register_popup(id, name)
            {
                
                for(var iii = 0; iii < popups.length; iii++)
                {   
                    //already registered. Bring it to front.
                    if(id == popups[iii])
                    {
                        Array.remove(popups, iii);
                    
                        popups.unshift(id);
                        
                        calculate_popups();
                        
                        
                        return;
                    }
                }               
                
                var 	  element = '<div class="popup-box chat-popup" id="'+ id +'">';
                //var 	  element = '<div class="popup-box chat-popup" id="chatbox">';
                	element = element + '<div class="popup-head">';
                		element = element + '<div class="popup-head-left">'+ name +'</div>';
                		element = element + '<div class="popup-head-right"><a href="javascript:close_popup(\''+ id +'\');">&#10005;</a></div>';
                                //element = element + '<div class="popup-head-right"><a href="javascript:close_popup(\''+ id +'\');">&#10005;</a></div>';
                		element = element + '<div style="clear: both"></div>';
                	element = element + '</div>';
                	/*element = element + '<div class="popup-messages"></div>';*/

 				    /*(element = element + '<div class='msgs'>';
  				  		element = element + 'Hiiiiii';
				   	element = element + '</div>';*/
					
	            	element = element + '<div class="msg_wrap">';
		            	element = element + '<div class="msg_body" id="msg_body">';
			            	//element = element + '<div class="msg_a">This is from A	</div>';
			            	//element = element + '<div class="msg_b">This is from B, and its amazingly kool nah... i know it even i liked it :)</div>';
			            	//element = element + '<div class="msg_a">Wow, Thats great to hear from you man </div>';
			            	element = element + '<div id="msg_all"></div>';
			            	element = element + '<div class="msg_push" id="msg_push"></div>';
		            	element = element + '</div>';
		            	element = element + '<div class="msg_footer"><textarea class="msg_input" rows="4"></textarea></div>';
	            	element = element + '</div>';
					
                element = element + '</div>';
				
				
                document.getElementsByTagName("body")[0].innerHTML = document.getElementsByTagName("body")[0].innerHTML + element;  
        
                popups.unshift(id);
                        
                calculate_popups();
				//alert("asdasd");
				//document.getElementById('msg_body').innerHTML = '<?php echo "asdasda111";?>';
				//document.getElementById('msg_body').innerHTML = '<?php echo "asdasda111";?>';
				$('#msg_all').load('friendmsgs.php?friend='+name);
				
				/*$.ajax({
				  url: 'friendmsgs.php?friend='+name,
				  success: function(data) {
				    //$('.result').html(data);
                                    $('#msg_all').load(data);
				  }
				});*/
                
            }
            
            //recalculate when window is loaded and also when window is resized.
            window.addEventListener("resize", calculate_popups);
            window.addEventListener("load", calculate_popups);
            
        </script>
 </head>
<?php
echo "<h4>Unread Messages</h4>";
echo "<div id='resultMsg'></div>";
$sql=$dbh->prepare("SELECT friend FROM " . $db . ".friends WHERE name = ? AND friend IN (SELECT name FROM " . $db . ".chatters where onlinestatus = 1)");
$sql->execute(array($_SESSION['user']));
$sql->execute();
while($r=$sql->fetch()){
    if($r['friend'] != $_SESSION['user']){
        echo   "<div class='user'>
                        <!--<div id = \"msgsfromfriend\" onload=\"msgsfromfriend('')\"></div>-->
	 		<a href=\"javascript:register_popup('{$r['friend']}', '{$r['friend']}');\">
 				{$r['friend']}
			</a>
                </div>";
        if(!isset($_SESSION['friend'])){
            $_SESSION['friend'] = stripslashes(htmlspecialchars($r['friend']));
        }
    }
}

echo "<div id='addfriend'></div>";
echo "<div id='removefriend'></div>";
?>
</html>