<?php

require_once "dbconfig.php";

if(isset($_POST["newusername"]) && isset($_POST["newemail"]) && isset($_POST["newpassword"]))
{	
	$username = $_POST["newusername"];
	$sql = "SELECT * FROM tbl_user WHERE username='$username'";
	$db = mysqli_connect('localhost', 'root', '', 'ajax_registration_db');
	$results = mysqli_query($db, $sql);
	
	if (mysqli_num_rows($results) > 0) {
		echo "Username taken";
		die;
	
	}
	$username = $_POST["newusername"];

	$email = $_POST["newemail"];

	$password = $_POST["newpassword"];

	$college = $_POST["newcollege"];
	
	$stmt=$db->prepare("INSERT INTO tbl_user(username, email, password, college) VALUES(?,?,?,?)"); 
	
	$stmt->bind_param("ssss", $username, $email, $password, $college);


	if($stmt->execute())
	{

		echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button> 
					Register Successfully  
			 </div>';		
	}	
	else
	{
		echo  '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button> 
					Fail to Register  
			   </div>';		
	}
	  
	
	
}

?>
