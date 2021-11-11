<?php
  include_once 'server.php';
  session_start();
  $errors = array();
  $response = [];

  $best = $_POST['best'];

  $questionID = $_POST['questionID'];
  $OP = $_POST['userID'];


  //fetch questionID of reference question for the answer
  $fetchRefQuestionQuery = "SELECT answers.refQuestion FROM answers WHERE answers.answerID = $answerID;";
  $questionRes = mysqli_query($db, $fetchRefQuestionQuery);
  $refQuestion = mysqli_fetch_assoc($questionRes);
  $questionID = $refQuestion['refQuestion'];
  mysqli_free_result($questionRes);

  //fetch the data from the database for this question to check if it already has a best answer
  $fetchBestQuery = "SELECT bestAnswer FROM questions WHERE questionID = $questionID;";
  $bestRes = mysqli_query($db, $fetchBestQuery);
  $bestAns = mysqli_fetch_assoc($bestRes);
  mysqli_free_result($bestRes);

  function setBest($aID, $qID, $Best, $db){
  // Best can be either 0 or 1
  // the user who is logged in must have the same userID as the poster to be able to set best answer
  //this fucntion sets the answer as bestanswer for corresponding question and for answer itself

      if ($Best == 1){
        $isBestQuery = "UPDATE answers SET isBest = 1 WHERE answerID = $aID";
        $bestAQuery = "UPDATE questions SET bestAnswer = $aID WHERE questionID = $qID";
        mysqli_query($db,$isBestQuery);
        mysqli_query($db,$bestAQuery);
      }
      elseif($Best == 0){
        $isBestQuery = "UPDATE answers SET isBest = 0 WHERE answerID = $aID";
        $bestAQuery = "UPDATE questions SET bestAnswer = NULL WHERE questionID = $qID";
        mysqli_query($db,$isBestQuery);
        mysqli_query($db,$bestAQuery);
      }

  }

  if (is_null($bestAns['bestAnswer'])){
    setBest($answerID, $questionID, $best, $db);
    $response['status'] = "Marked answer as best answer.";

  }
  elseif ($best==0){
    setBest($answerID, $questionID, $best, $db);
    $response['status'] = "Unmarked best answer.";
  }
  else{
    $response['status'] = "Cannot mark two answers as best answer for same question.";
  }
  header('Content-type: application/json');
  echo (json_encode($response));

