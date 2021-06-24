<?php
require('database_connection/connection.inc.php');

$msg="";
$msg_r="";
if(isset($_POST['submit'])){

   $username=$_POST['e-mail'];
   $password=$_POST['password'];
   $sql_query=" select * from userdata where user_email='$username' and user_password='$password'";
   $result = mysqli_query($connection,$sql_query);
   $count=mysqli_num_rows($result);
   if($count>0){
	session_start();
	$_SESSION['USER_LOGIN']='yes';
    $_SESSION['USER_NAME']=$username;

    header('location:feeds.php');
    die();
   }
   else{

      $msg="Please Enter Correct Username/Password";
   }
}

if(isset($_POST['submit_register'])){

   $username=$_POST['name'];
   $email=$_POST['email'];
   $password=$_POST['password'];
   $cpassword=$_POST['cpassword'];
   $sql_query_r="select user_email from userdata where user_email='$email'";
   $result = mysqli_query($connection,$sql_query_r);
   $count=mysqli_num_rows($result);
   if($count>0){
	
		$msg_r="This E-mail already register.You can login with this email.";
		
	}
	elseif ($password != $cpassword) {
		
		$msg_r="Password Not Matched";
		
	}
	else{

      $sql_query_register="insert into userdata (user_name,user_email,user_password) values('$username','$email','$password')";
      mysqli_query($connection,$sql_query_register);
      $msg_r="User Registered Succesfully";
   }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/login.css">

    

</head>
<body>
		
		<div class="container">
			<h2 style="margin-bottom: 30px;">Already Registerd Login here</h2>
			<form method="POST">
			    <div class="mb-3">
			      <label for="exampleInputEmail1" class="form-label">Email address</label>
			      <input type="email" name="e-mail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email here." required>
			      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
			    </div>
			    <div class="mb-3">
			      <label for="exampleInputPassword1" class="form-label">Password</label>
			      <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter your password here." required>
			    </div>
			    <div class="mb-3 form-check">
			      <input type="checkbox" class="form-check-input" id="exampleCheck1">
			      <label class="form-check-label" for="exampleCheck1">Check me out</label>
			    </div>
			    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
			    <?php echo $msg; ?>
		  	</form>
		</div>
    

		<div class="container two" id="register_form">
			<h2 style="margin-bottom: 30px;">New User Register here</h2>
			<form method="POST" action="#register_form">
				<div class="form-row">
				   	<div class="form-group ">
					      <label for="inputUsername4">Username</label>
					      <input type="text" class="form-control" name="name" placeholder="Shubham">
					</div>
					<div class="form-group ">
					      <label for="inputEmail4">Email</label>
					      <input type="email" class="form-control" name="email" placeholder="Email@email.com">
					</div>
			  	</div>
			  	<div class="form-group">
						   <label for="inputPassword">Password</label>
						   <input type="Password" class="form-control" name="password" >
			  	</div>
			  	<div class="form-group">
						    <label for="inputCPassword">Confirm Password</label>
						    <input type="Password" class="form-control" name="cpassword" >
			  	</div>
			  	<div class="form-group">
				    <div class="form-check">
					      <input class="form-check-input" type="checkbox" id="gridCheck">
					      <label class="form-check-label" for="gridCheck">
					        Check me out
					      </label>
				    </div>
			  	</div>
			  			<button type="submit" name="submit_register" class="btn btn-primary">Register</button>
			  			<?php echo $msg_r ?>
			</form>
		</div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>
</html>