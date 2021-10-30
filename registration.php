<?php
include_once 'addRegistration.php';
?>

<!DOCTYPE html>
<html lang="en">
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
<head>
<script type = "text/javascript">
function check(){ //checks if password and confirm password values match, if so notifies user by indicating passwords match
    if ((document.getElementById("password").value.length >= 8) && (document.getElementById('confirm_password').value.length >= 8)){
      if (document.getElementById("password").value == document.getElementById('confirm_password').value) {
        document.getElementById("match").style.color = "green";
        document.getElementById("match").innerHTML = "Passwords match.";
        document.getElementById("submit").type = "submit"; //only if passwords match, submit button will submit the form
      }
      else {
        document.getElementById("match").style.color = "red";
        document.getElementById("match").innerHTML = "Passwords do not match.";
        document.getElementById("submit").type = "button";
      }
    }
}

</script>

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
<form id="form" action="#" method="post">
 <div class="center">
  <h2>Sign Up</h2>
  <p>
	<label for="username" class="floatLabel">Username:</label>
	<input id="username" name="username" type="text" required>
  </p>
		<p>
			<label for="Email" class="floatLabel">Email:</label>
			<input id="Email" name="Email" type="text" required>
		</p>
		<p>
			<label for="password" class="floatLabel">Password (8 characters minimun):</label>
			<input id="password" name="password" type="password" onkeyup="check();" autocomplete="current-password" minlength="8" required>
		</p>
		<p>
			<label for="confirm_password" class="floatLabel">Confirm Password:</label>
			<input id="confirm_password" name="confirm_password" type="password" onkeyup="check();" required>
			<span id="match"></span>
		</p>
		<p>
			<button id="submit" type="button" >Create My Account</button>
		</p>
		</body>
		</div>

    <footer class="footer">
        <h5></h5>
    </footer>
    <footer class="footer">
        <p>Project by Team 01 for SOEN 341  <a>https://github.com/jasonhillinger/soen341project</a></p>
    </footer>
	</form>
</html>

