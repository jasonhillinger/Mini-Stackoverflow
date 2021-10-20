<?php
include_once 'server.php';
//session_start();
$errors = array();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// Registering a new person to the database
//title, questionText, asker, views, voteCount, bestAnswer
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $user = $_SESSION["userID"];


	if(isset($_POST['submitQuestion'])){ 	//if this is true then its a question post
	   $title = mysqli_real_escape_string($db, $_POST['title']);
	   $questionText = mysqli_real_escape_string($db, $_POST['userQuestion']);

	//do sql querie for question
  	if(count($errors) == 0){

  		$query = "INSERT INTO questions (title, questionText, asker) VALUES ('$title','$questionText','$user')"; //This is where the SQL querie will go (Insert statement)
  		mysqli_query($db,$query);


  		echo("Question posted successfully");
  		echo("<meta http-equiv=\"refresh\" content=\"1; url=index.php\" />");

  	}
  	  else{
  		while(count($errors) != 0){
  			echo(array_pop($errors));
  		}
  		echo("Question posting failed!");
  		echo("<meta http-equiv=\"refresh\" content=\"5; url=index.php\" />");

  	}
  }


	else if(isset($_POST['submitAnswer'])){
    $refQuestion = mysqli_real_escape_string($db, $_POST['refQuestion']);
    $answerText = mysqli_real_escape_string($db, $_POST['userAnswer']);
		if(count($errors) == 0){
      //do answer sql querie
			$query = "INSERT INTO answers (refQuestion, answerText, answerer) VALUES ('$refQuestion','$answerText','$user')"; //This is where the SQL querie will go (Insert statement), to add the person if no errors
			mysqli_query($db,$query);


			echo("Answer posted successfully");
			echo("<meta http-equiv=\"refresh\" content=\"1; url=index.php\" />");

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
