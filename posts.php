<?php
 include_once 'server.php';
$errors = array();

// Registering a new person to the database
//title, questionText, asker, views, voteCount, bestAnswer
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user = $_SESSION["username"];
	$questionText = mysqli_real_escape_string($db, $_POST['userquestion']);
	$refQuestion = mysqli_real_escape_string($db, $_POST['refQuestion']);
	$isAsking = mysqli_real_escape_string($db, $_POST['submitButtonForQuestion']);
	$isResponding = mysqli_real_escape_string($db, $_POST['submitButtonForAnswer']);

	//if this is true then its a question post
	if($isAsking){
	$title = mysqli_real_escape_string($db, $_POST['title']);
	
	

	//do sql querie for question
	if(count($errors) == 0){

		$query = "INSERT INTO questions (title, questionText, asker) VALUES ('$title','$questionText','$user')"; //This is where the SQL querie will go (Insert statement), to add the person if no errors
		mysqli_query($db,$query);


		echo("Question posted successfully");
		//sleep(2);
			// redirect to home page
			// may be changed depending on html implementation
		echo("<meta http-equiv=\"refresh\" content=\"5; url=index.php\" />");

	}
	  else{
		  //Failed.php is a placeholder for an unsuccesful request
		  //May be changed depending on html implementation
		//header("Location: Failed.php");
		while(count($errors) != 0){
			echo(array_pop($errors));
		}
		echo("Question posting failed!");
		echo("<meta http-equiv=\"refresh\" content=\"5; url=index.php\" />");

	}

	
	else if($isResponding){
		//do answer sql querie
		if(count($errors) == 0){
			
			$query = "INSERT INTO answers (refQuestion, answerText, answerer) VALUES ('$refQuestion','$questionText','$user')"; //This is where the SQL querie will go (Insert statement), to add the person if no errors
			mysqli_query($db,$query);
	
	
			echo("Answer posted successfully");
			//sleep(2);
				// redirect to home page
				// may be changed depending on html implementation
			echo("<meta http-equiv=\"refresh\" content=\"5; url=index.php\" />");
	
		}
		  else{
			  //Failed.php is a placeholder for an unsuccesful request
			  //May be changed depending on html implementation
			//header("Location: Failed.php");
			while(count($errors) != 0){
				echo(array_pop($errors));
			}
			echo("Answer posting failed!");
			echo("<meta http-equiv=\"refresh\" content=\"5; url=index.php\" />");
	
		}

	}


	//check db for existing person unique values
	//$user_check_query = "SELECT * FROM users WHERE email = '$email' or username ='$username'"; // this will be an SQL querie (SELECT statement) to check if primary key already exist

	// $results = mysqli_query($db, $user_check_query);
	// $user = mysqli_fetch_assoc($results);

	// if($user){

	//   if($user['email'] === $email){array_push($errors, "Account already exists with this email!<br>");}
	//   if($user['username'] === $username){array_push($errors, "Account already exists with this username!<br>");}

	// }
	
?>
