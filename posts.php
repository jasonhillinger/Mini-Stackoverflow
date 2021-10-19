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
		echo("<meta http-equiv=\"refresh\" content=\"5; url=index.php\" />");

	}
	  else{
		while(count($errors) != 0){
			echo(array_pop($errors));
		}
		echo("Question posting failed!");
		echo("<meta http-equiv=\"refresh\" content=\"5; url=index.php\" />");

	}
}

	
	else if($isResponding){
		//do answer sql querie
		if(count($errors) == 0){
			
			$query = "INSERT INTO answers (refQuestion, answerText, answerer) VALUES ('$refQuestion','$questionText','$user')"; //This is where the SQL querie will go (Insert statement), to add the person if no errors
			mysqli_query($db,$query);
	
	
			echo("Answer posted successfully");
			echo("<meta http-equiv=\"refresh\" content=\"5; url=index.php\" />");
	
		}
		  else{
			while(count($errors) != 0){
				echo(array_pop($errors));
			}
			echo("Answer posting failed!");
			echo("<meta http-equiv=\"refresh\" content=\"5; url=index.php\" />");
	
		}

	}

}
?>
