<?php
include("config.php");
//Signup and store the database input for data creation
	if(isset($_POST['username']))
	{
		//if database is not yet created
		$con = mysqli_connect($host, $user, $pass, $db);
		$query = "CREATE DATABASE IF NOT EXISTS ". $db;
		mysqli_query($con, $query);
		
		//Create tables if they dont exist
		$query = "CREATE TABLE IF NOT EXISTS " . $db . ".chatters ( name varchar(20) NOT NULL, seen varchar(20) NOT NULL, password varchar(20) NOT NULL, onlinestatus binary(1) DEFAULT '0', PRIMARY KEY (name), UNIQUE KEY name (name)) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		$result_create = mysqli_query($con, $query);
		
		$query = "CREATE TABLE IF NOT EXISTS " . $db . ".friends ( name varchar(20) NOT NULL, friend varchar(20) NOT NULL, PRIMARY KEY (name), UNIQUE KEY unique_index (name,friend), KEY friend_fk_idx (friend), CONSTRAINT friend_fk FOREIGN KEY (friend) REFERENCES chatters (name) ON DELETE NO ACTION ON UPDATE NO ACTION, CONSTRAINT name_fk FOREIGN KEY (name) REFERENCES chatters (name) ON DELETE NO ACTION ON UPDATE NO ACTION) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		$result_create = mysqli_query($con, $query);
		
		$query = "CREATE TABLE IF NOT EXISTS " . $db . ".messages ( message_id int(10) NOT NULL AUTO_INCREMENT, name varchar(20) NOT NULL, to_name varchar(20) DEFAULT NULL, msg varchar(255) NOT NULL, posted varchar(20) NOT NULL, read binary(1) DEFAULT '0', PRIMARY KEY (message_id), KEY name (name), KEY messages_fk_2 (to_name), CONSTRAINT messages_fk_1 FOREIGN KEY (name) REFERENCES chatters (name) ON DELETE CASCADE, CONSTRAINT messages_fk_2 FOREIGN KEY (to_name) REFERENCES chatters (name) ON DELETE CASCADE) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1";
		$result_create = mysqli_query($con, $query);
		
		
		//Username and others should be checked for duplicate here
		$query = "SELECT * FROM " . $db . ".chatters WHERE name='%s'";
		$query = sprintf($query, mysqli_real_escape_string($con, stripslashes($_POST['username'])));
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result) > 0){
                    //header("Location: signup.php?unamee");
                    //ob_end_flush();
                    echo "User Alredy Registered";
		}
		
		$query = "INSERT INTO " . $db . ".chatters (name, password, seen, onlinestatus) VALUES ('%s', '%s', NOW(), 0)";
		//$password = crypt($_POST['password'],'pole'); // let the salt be automatically generated
		$password = $_POST['password']; // let the salt be automatically generated
		$query = sprintf($query, mysqli_real_escape_string($con, stripslashes($_POST['username'])), $password);
		
                if($result = mysqli_query($con, $query)){
                    /*if($row = mysqli_fetch_assoc($result)){
                        //session_start();
                        $_SESSION['uid'] = $row['id'];
                        $_SESSION['username'] = $_POST['username'];
                    }*/
                        echo "Successfully Registered!<br>";
                } else {
                    echo "An error occured! <br>" . mysqli_error($con);
		}
                /*
                if(mysqli_query($con, $query))
		{
			$query = "SELECT id FROM ". $sql_database_name .".chatters WHERE username='%s'";
			$query = sprintf($query, mysqli_real_escape_string($con, stripslashes($_POST['username'])));
			$result = mysqli_query($con, $query);
			$row = mysqli_fetch_assoc($result);
			//Register the user into the online table
			$query = "INSERT INTO " . $sql_database_name . ".online (id, time) VALUES ('%s',NOW())";
			$query = sprintf($query, $row['id']);
			mysqli_query($con, $query);
			//print_r($row);
			//start the session
			session_start();
			$_SESSION['uid'] = $row['id'];
			$_SESSION['username'] = $_POST['username'];
			echo "Successfully Registered!<br>";
			
		}
		else
		{
			echo "An error occured! <br>" . mysqli_error();
		}*/
	}
	
	//none
	//$location = "Location: " . $_SERVER['HTTP_REFERER'] . "?unknown";
	//header($location);
?>