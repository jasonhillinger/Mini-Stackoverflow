<?php
include_once 'addRegistration.php';
?>

<!DOCTYPE html>
<html lang="en">
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
<form id="form" action="#" method="post">
  <h2>Sign Up</h2>
  <p>
	<label for="username" class="floatLabel">Username</label>
	<input id="username" name="username" type="text" required>
</p>
		<p>
			<label for="Email" class="floatLabel">Email</label>
			<input id="Email" name="Email" type="text" required>
		</p>
		<p>
			<label for="password" class="floatLabel">Password</label>
			<input id="password" name="password" type="password" onkeyup="check();" autocomplete="current-password" minlength="8" required>
			<span>Please enter a password at least 8 characters long.</span>
		</p>
		<p>
			<label for="confirm_password" class="floatLabel">Confirm Password</label>
			<input id="confirm_password" name="confirm_password" type="password" onkeyup="check();" required>
			<span id="match"></span>
		</p>
		<p>
			<button id="submit" type="button" >Create My Account</button>
		</p>
	</form>
</html>
