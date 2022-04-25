<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<title> Registration Form Using Ajax</title>
		
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		
</head>

	<body>
	<style>
		body {
            background-color: springgreen;
        }

		.container{
			width: 506px;
           border-radius: 5px;
           margin: auto;
           border: 3px solid #010008;
           background-color: #f2f2f2;
           padding: 20px;
		}

		.head{
			width: 580px;
			height: 670px;
           border-radius: 5px;
           margin: auto;
           border: 3px solid #010008;
           background-color: #000;
           padding: 20px;
		}

		h1{
			color: #FFF;
		}

		input[type=text] {
			width: 500px;
			padding: 12px 20px;
			margin: 8px 0;
			box-sizing: border-box;
			border: 2px solid green;
  			border-radius: 4px;
			}
		
		input[type=password] {
			width: 500px;
			padding: 12px 20px;
			margin: 8px 0;
			box-sizing: border-box;
			border: 2px solid green;
  			border-radius: 4px;
			}

		input[type=text]:focus {
			border: 3px solid red;
			}
		
		input[type=password]:focus {
			border: 3px solid red;
			}
		
		button{
			border-radius: 8px;
			background-color: #4CAF50; /* Green */
			border: none;
			color: white;
			padding: 15px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			width: 500px;
		}

	</style>
	
	<div class="wrapper">
	<div class="head">
	<center><h1><b><i>Registration Form</i></b></h1></center>	
	<div class="container">
		<div class="col-lg-12">
		  
			<div class= "Container">
			<form id="registraion_form" class="form-horizontal">
					
				<div class="form-group">
							
				<label class="col-sm-3 control-label"><b><i>Username</i></b></label>
				<div class="col-sm-6">
				<input type="text" id="txt_username" class="form-control" placeholder="Enter Your Username" />
				<p ><span id=""></span></p>
				</div>
				</div>
				
				<div class="form-group">
				<label class="col-sm-3 control-label"><b><i>Email ID</i></b></label>
				<div class="col-sm-6">
				<input type="text" id="txt_email" class="form-control" placeholder="Enter Your E-mail Address" />
				<p ><span id=""></span></p>
				</div>
				</div>

				<div class="form-group">
				<label class="col-sm-3 control-label"><b><i>College Name</i></b></label>
				<div class="col-sm-6">
				<input type="text" id="college" class="form-control" onkeyup="showCollege(this.value)" placeholder="Enter Your College Name" required>
				<p ><span id="txtHint"></span></p>
				<p ><span id=""></span></p>
			</div>
				</div>

				<div class="form-group">
				<label class="col-sm-3 control-label"><b><i>Password</i></b></label>
				<div class="col-sm-6">
				<input type="password" id="pwd" class="form-control" placeholder="Enter Your Password" />
				<p ><span id=""></span></p>
				</div>
				</div>
				<div class="form-group">
				<label class="col-sm-3 control-label"><b><i>Confirm Password</i></b></label>
				<div class="col-sm-6">
				<input type="password" id="txt_password" onkeyup="retypePwd(this.value)" class="form-control" placeholder="Re-Enter Your Password" />
				<p ><span id=""></span></p>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6 m-t-15">
				<button type="submit" id="btn_register" class="btn btn-success"><b><i>Register</i></b></button>
				</div>
				</div>
				
				<div class="form-group">
					<div id="message" class="col-sm-offset-3 col-sm-6 m-t-15"></div>
				</div>
			
			</form>
			</div>
		</div>
		</div>
	</div>	
	</div>

	
	<script src="js/jquery-1.12.4-jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
	<script>
		
		$(document).on('click','#btn_register',function(e){
			
			e.preventDefault();
			
			var username = $('#txt_username').val();
			var email 	 = $('#txt_email').val();
			var password = $('#pwd').val();
			var college = $('#college').val();
			
			var atpos  = email.indexOf('@');
			var dotpos = email.lastIndexOf('.com');
			
			if(username == ''){ // check username not empty
				alert('please enter username !!'); 
			}
			else if(!/^[a-z A-Z]+$/.test(username)){ // check username allowed capital and small letters 
				alert('username only capital and small letters are allowed !!'); 
			}
			else if(email == ''){ //check email not empty
				alert('please enter email address !!'); 
			}
			else if(atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length){ //check valid email format
				alert('please enter valid email address !!'); 
			}
			else if(password == ''){ //check password not empty
				alert('please enter password !!'); 
			}
			
			else{			
				$.ajax({
					url: 'process.php',
					type: 'post',
					data: 
						{newusername:username, 
						 newemail:email, 
						 newpassword:password,
						 newcollege:college
						},
					success: function(response){
						$('#message').html(response);
					}
				});
				
				$('#registraion_form')[0].reset();
			}
		});

	</script>
	<script>
			function showCollege(str) { 
			if (str.length == 0) {
				document.getElementById("txtHint").innerHTML = "College Name can't be empty";
				return;
			} else {
				var xhr = new XMLHttpRequest(); 
				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) { 
						document.getElementById("txtHint").innerHTML = this.responseText;
					}
				};
				xhr.open("GET", "gethint.php?c=" + str + "&q=''", true); xhr.send();
			}
		}

	
		</script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#btn_register").click(function () {
            var password = $("#pwd").val();
            var confirmPassword = $("#txt_password").val();
            if (password != confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        });
    });
</script>
	</body>
</html>

