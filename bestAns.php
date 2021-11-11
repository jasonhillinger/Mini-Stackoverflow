<?php
  include_once 'server.php';
  session_start();
  $errors = array();

  // $best = $_POST['best'];
  // $questionID = $_POST['questionID'];
  // $OP = $_POST['userID'];

  //might need error checking
  function isBestFunc($currentUser,$questionID,$OP,$best){
  // best can be either best or not best
  // the user who is logged in must have the same userID as the poster to be able to set best answer
  if(isset($_SESSION['userID'])){
    $currentUser = $_SESSION['userID'];

    if ($best === "best" && $currentUser == $OP){
      $bestQuery = "UPDATE answers SET isBest = 1 WHERE answerID = $answerID";
    }
    elseif($best === "notbest" && $currentUser == $OP){
        $bestQuery = "UPDATE answers SET isBest = 0 WHERE answerID = $answerID";
    }
    mysqli_query($db,$bestQuery);
  }
}
