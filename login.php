<?php
include_once "server.php";

session_start(); //start a new session if not already started
include "fetchProfile.php";
$errors = [];

// Verifying data entered is correct (with data in database) and logging in the user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //this condition means the following php code will only execute after data is stored using POST in the html form
    $email = strtolower(mysqli_real_escape_string($db, $_POST["Email"]));
    $password = mysqli_real_escape_string($db, $_POST["password"]);
    $password_from_db = "";
    //check db for existing person using unique email
    $email_check_query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($db, $email_check_query);
    $user = mysqli_fetch_assoc($result); //retrieves all user data stored in the result from SQL query
    mysqli_free_result($result);
    $password_from_db = $user["password"]; //get the password stored in db

    if (!$user) {
        //if not user is found for this email address
        array_push($errors, "No account with this email can be found.<br>");
    }
    elseif ($password_from_db != $password) {
        //if password entered does not match password stored in db
        array_push($errors, "Wrong password.<br>");
    }
    else {
        //Login the user by saving the logged in user data (profile) to the _SESSION
        //array by calling the fetchProfile function.
        fetchProfile($email);
    }
    if (count($errors) != 0) {
        //If any errors were caught, print out the corresponding error messages, and refresh page
        while (count($errors) != 0) {
            echo array_pop($errors);
        }
        echo "<b>User login failed.</b> Please try again.<br>Page will refresh momentarily.<br>";
        echo "<meta http-equiv=\"refresh\" content=\"5; url=login.php\" />";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<link href=".css/login.css" rel="stylesheet">
	</head>
	</div>
	<div class="header">
		<img src="tech2.jpg" alt="logo" class="src">
	</div>
	<div class="navbar">
		<a href="index.php">Home</a> <?php
      		if (isset($_SESSION["userID"])){
      			echo("
			<a href=\"logout.php\" class=\"right\">Logout</a>");
      			echo("
			<a href=\"#\" class=\"right\">". $_SESSION["username"] ."</a>");
      		}
      		else{
            echo("
			<a href=\"registration.php\" class=\"right\" >Register</a>");
            echo("
			<a href=\"login.php\" class=\"right\">Login</a>");
          }
		    ?>
	</div>
	<body>
		<div class="container text-center">
			<div class="row">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-6">
							<div class="panel panel-default text-left">
								<form action="#" method="post">
									<div class="center">
										<h2>Login to Your Account!</h2>
										<p>
											<label for="Email" class="floatLabel">Email: </label>
											<input id="Email" name="Email" type="text" required>
										</p>
										<p>
											<label for="password" class="floatLabel">Password: </label>
											<input id="password" name="password" type="password" required autocomplete="current-password">
										</p>
										<p>
											<input type="submit" value="Login to My Account" id="submit">
										</p>
										<p> Dont't have an account? <a href="registration.php">Click here to create an account</a>
										</p>
										<p>
                      <?php
                      //Check if user is logged in, if so display welcome text and redirect to homepage
                      if (isset($_SESSION["username"])) {
                          echo "Login successful.<br>Welcome <strong>" . $_SESSION["username"] . "</strong>!  You will be redirected to the homepage momentarily.<br>";
                          echo "<meta http-equiv=\"refresh\" content=\"5; url=index.php\" />";
                      }
                      ?>
                    </p>
									</div>
									<footer class="footer">
										<h5></h5>
									</footer>
									<footer class="footer">
										<p>Project by Team 01 for SOEN 341 <a>https://github.com/jasonhillinger/soen341project</a>
										</p>
									</footer>
								</form>
  </body>
</html>
