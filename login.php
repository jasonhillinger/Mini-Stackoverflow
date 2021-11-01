<?php
 include_once 'server.php';
 session_start(); //start a new session if not already started
$errors = array();

// Verifying data entered is correct (with data in database) and logging in the user
if($_SERVER["REQUEST_METHOD"] == "POST"){ //this condition means the following php code will only execute after data is stored using POST in the html form
	$email = strtolower(mysqli_real_escape_string($db, $_POST['Email']));
	$password = mysqli_real_escape_string($db, $_POST['password']);
	$password_from_db =  "";
	//check db for existing person using unique email
	$email_check_query = "SELECT * FROM users WHERE email = '$email'";
	$result = mysqli_query($db, $email_check_query);
	$user = mysqli_fetch_assoc($result); //retrieves all user data stored in the result from SQL query
	$password_from_db = $user['password']; //get the password stored in db

	if(!$user){ //if not user is found for this email address
		array_push($errors, "No account with this email can be found.<br>");
	}
	else if ($password_from_db != $password){ //if password entered does not match password stored in db
		array_push($errors, "Wrong password.<br>");
	}
	else{
    //Login the user by saving the logged in user data to the _SESSION array
		$_SESSION["userID"] = $user['userID'];
		$_SESSION["username"] = $user['username'];
		$_SESSION["email"] = $user['email'];
	}
	if(count($errors) != 0){
    //If any errors were caught, print out the corresponding error messages, and refresh page
		while(count($errors) != 0){
			echo(array_pop($errors));
		}
		echo("<b>User login failed.</b> Please try again.<br>Page will refresh momentarily.<br>");
		echo("<meta http-equiv=\"refresh\" content=\"5; url=login.php\" />");
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
  body{
		background-color: black;

	}
	.container{
		border: 3px solid #303030;
        padding: 20px;
        width: 350 px;
        text-align: center;
        border-radius: 4px;
        position: relative;
		background: rgb(255,255,255);

	}

 
	.header img {
		width: 1000px;
        height: 200px;
        background: no-repeat;
        background-size: cover;
        border: 6px solid #333;
        margin: 20px;
        display: block;
        margin-left: auto;
        margin-right: auto;
        color: #ddd;
        text-align: center;
           
    }
   
        /* Style the top navigation bar */

    .navbar {
        overflow: hidden;
        background-color: rgb(15, 184, 23);
    }
        /* Style the navigation bar links */

    .navbar a {
        float: left;
        display: block;
        color: white;
        text-align: center;
        padding: 14px 20px;
        text-decoration: none;
    }
        /* Right-aligned link */

    .navbar a.right {
        float: right;
    }
        /* Change color on hover */

    .navbar a:hover {
        background-color: #ddd;
        color: black;
    }
	div {
		margin-bottom: 10px;
	}

    label {
        display: inline-block;
        width: 150px;
        text-align: right;
    }
    
		
	input {
		display: inline;
        font-family: "Montserrat";
        font-size: 1.05;
        border: 2px solid green;
        border-radius: 5px;
        width: 15%;
        height: 1.5em;
    }
		

        

	footer {
		position: fixed;
        bottom: 0;
        width: 100%;
        height: 40px;
        text-align: center;
        background-color: rgb(15, 184, 23);
        color: white;
    }


</style>
  
</head>
    </div>
	 <div class="header">
        <img src="tech2.jpg" alt="logo" class="src">
 

    </div>


 <div class="navbar">
        <a href="index.php">Home</a>
        <?php
      		if (isset($_SESSION["userID"])){
      			echo("<a href=\"logout.php\" class=\"right\">Logout</a>");
      			echo("<a href=\"#\" class=\"right\">". $_SESSION["username"] ."</a>");
      		}
      		else{
            echo("<a href=\"registration.php\" class=\"right\" >Register</a>");
            echo("<a href=\"login.php\" class=\"right\">Login</a>");
          }
		    ?>
    </div>

<body>
   <div class="container text-center">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-2">
                    </div>
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
        <input type="submit" value="Login to My Account" id = "submit">
      </p>
      <p>
        Dont't have an account? <a href="registration.php">Click here to create an account</a>
      </p>
      <p>
        <?php
        //Check if user is logged in, if so display welcome text and redirect to homepage
        if (isset($_SESSION["username"])) {
          echo("Login successful.<br>Welcome <strong>" . $_SESSION["username"] . "</strong>!  You will be redirected to the homepage momentarily.<br>");
          echo("<meta http-equiv=\"refresh\" content=\"5; url=index.php\" />");
        }
        ?>
      </p>

	
    </div>
	<footer class="footer">
        <h5></h5>
    </footer>
    <footer class="footer">
        <p>Project by Team 01 for SOEN 341  <a>https://github.com/jasonhillinger/soen341project</a></p>
    </footer>
  </form>
  
 </body>
</html>
