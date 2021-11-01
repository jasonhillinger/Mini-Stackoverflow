<?php
 include_once 'server.php';
$errors = array();

// Registering a new person to the database
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$email = mysqli_real_escape_string($db, strtolower($_POST['Email']));
	$password = mysqli_real_escape_string($db, $_POST['password']);

	//check db for existing person unique values
	$user_check_query = "SELECT * FROM users WHERE email = '$email' or username ='$username'"; // this will be an SQL querie (SELECT statement) to check if primary key already exist

	$results = mysqli_query($db, $user_check_query);
	$user = mysqli_fetch_assoc($results);

	if($user){

	  if($user['email'] === $email){array_push($errors, "Account already exists with this email!<br>");}
	  if($user['username'] === $username){array_push($errors, "Account already exists with this username!<br>");}

	}
	if(count($errors) == 0){

		$query = "INSERT INTO users (username, password, email) VALUES ('$username','$password','$email')"; //This is where the SQL querie will go (Insert statement), to add the person if no errors
		mysqli_query($db,$query);


		echo("User account created succesfully.<br>You will be redirected to the login page momentarily.<br>");
		//sleep(2);
			// redirect to home page
			// may be changed depending on html implementation
		echo("<meta http-equiv=\"refresh\" content=\"5; url=login.php\" />");

	}
	  else{
		  //Failed.php is a placeholder for an unsuccesful request
		  //May be changed depending on html implementation
		//header("Location: Failed.php");
		while(count($errors) != 0){
			echo(array_pop($errors));
		}
		echo("User account creation failed. Please try again.<br>Page will refresh momentarily.<br>");
		echo("<meta http-equiv=\"refresh\" content=\"5; url=registration.php\" />");

	}
}
?>
