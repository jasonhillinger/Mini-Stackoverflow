<?php
  include_once 'server.php';
  session_start();
  $response = [];
  $answerID = $_POST['answerID'];
  //fetch questionID of reference question for the answer
  $fetchRefQuestionQuery = "SELECT answers.refQuestion FROM answers WHERE answers.answerID = $answerID;";
  $questionRes = mysqli_query($db, $fetchRefQuestionQuery);
  $refQuestion = mysqli_fetch_assoc($questionRes);
  $questionID = $refQuestion['refQuestion'];
  mysqli_free_result($questionRes);

  //fetch the data from the database for this question to check asker
  $fetchAskerQuery = "SELECT asker FROM questions WHERE questionID = $questionID;";
  $askerRes = mysqli_query($db, $fetchAskerQuery);
  $asker = mysqli_fetch_assoc($askerRes);
  mysqli_free_result($askerRes);
  $asker = $asker['asker'];

  if (isset($_SESSION['userID'])){
    if ($_SESSION["userID"]==$asker){
      $response['status'] = "OP";
    }
    else{
      $response['status'] = "notOP";
    }
  }

  header('Content-type: application/json');
  echo (json_encode($response));

?>
