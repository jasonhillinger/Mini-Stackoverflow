<?php
 include_once 'server.php';
session_start(); //start a new session if not already started
$errors = array();

// Verifying data entered is correct (with data in database) and logging in the user
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$email = mysqli_real_escape_string($db, $_POST['Email']);
	$password = mysqli_real_escape_string($db, $_POST['password']);
	$password_from_db =  "";
	//check db for existing person unique values
	$email_check_query = "SELECT * FROM users WHERE email = '$email'"; 
	
	$result = mysqli_query($db, $email_check_query);
	$user = mysqli_fetch_assoc($result);
	$password_from_db = $user['password'];

	if(!$user){
		array_push($errors, "No account with this email can be found.<br>");
	}
	else if ($password_from_db != $password){
		array_push($errors, "Wrong password.<br>");
	}
	else{
		$_SESSION["userID"] = $user['userID'];
		$_SESSION["username"] = $user['username'];
		$_SESSION["email"] = $user['email'];
		
		
		echo("User logged in succesfully.<br>Welcome!<br>You will be redirected to the homepage momentarily.<br>");
		sleep(2);
			// redirect to home page
			// may be changed depending on html implementation
		echo("<meta http-equiv=\"refresh\" content=\"0; url=index.php\" />");
	}
	if(count($errors) != 0){
		  //Failed.php is a placeholder for an unsuccesful request
		  //May be changed depending on html implementation
		//header("Location: Failed.php");
		while(count($errors) != 0){
			echo(array_pop($errors));
		}
		echo("User login failed. Please try again.<br>Page will refresh momentarily.<br>");
		echo("<meta http-equiv=\"refresh\" content=\"5; url=login.php\" />");

	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
.center {
  margin: 0;
  position: absolute;
  top: 50%;
  left: 45%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}
</style>
  <title>Login Page</title>
</head>

<body>
  <form action="#" method="post">
    <div class="center">
      <h2>Login to Your Account!</h2>
      <p>
        <label for="Email" class="floatLabel">Email: </label>
        <input id="Email" name="Email" type="text" required>
      </p>
      <p>
        <label for="password" class="floatLabel">Password: </label>
        <input id="password" name="password" type="password">
      </p>
      <p>
        <input type="submit" value="Login to My Account" id = "submit">
      </p>
      <p>
        <a href="registration.php">Create an Account</a>
      </p>
    </div>
  </form>
  </body>
</html>

